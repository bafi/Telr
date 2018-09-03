<?php

namespace payment\telr;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use payment\telr\Events\TelrCreateRequestEvent;
use payment\telr\Events\TelrFailedTransactionEvent;
use payment\telr\Events\TelrRecieveTransactionResponseEvent;
use payment\telr\Events\TelrSuccessTransactionEvent;

class TelrManager
{
    /**
     * Prepare create request
     *
     * @param $orderId
     * @param $amount
     * @param $description
     * @param array $billingParams
     * @return \payment\telr\CreateTelrRequest
     */
    public function prepareCreateRequest($orderId, $amount, $description, array $billingParams = [])
    {
        $createTelrRequest = (new CreateTelrRequest($orderId, $amount))->setDesc($description);

        // Associate billing params to fields
        foreach ($billingParams as $key => $value) {
            $methodName = ('setBilling'.studly_case($key));
            if (method_exists($createTelrRequest, $methodName)) {
                $createTelrRequest->$methodName($value);
            }
        }

        return $createTelrRequest;
    }

    /**
     * Initiate create request on telr
     *
     * @param $orderId
     * @param $amount
     * @param $description
     * @param array $billingParams
     * @return \payment\telr\TelrURL
     * @throws \Exception
     */
    public function pay($orderId, $amount, $description, array $billingParams = [])
    {
        $createRequest = $this->prepareCreateRequest($orderId, $amount, $description, $billingParams);
        $result = $this->callTelrServer($createRequest->getEndPointURL(), $createRequest->toArray());

        // Validate if response has error messages
        if (isset($result->error)) {
            throw new \Exception($result->error->message.'. Note: '.$result->error->note);
        }
        // Dispatch event
        event(new TelrCreateRequestEvent($createRequest, $result));

        return new TelrURL($result->order->url);
    }

    /**
     * Fetch the transaction result
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\ModelNotFoundException|Transaction|void
     * @throws \Exception
     */
    public function handleTransactionResponse(Request $request)
    {
        $transaction = Transaction::findOrFail($request->cart_id);
        $trxResultRequest = new TelrTransactionResultRequest($transaction);

        $result = $this->callTelrServer($trxResultRequest->getEndPointURL(), $trxResultRequest->toArray());

        // Validate if response has error messages
        if (isset($result->error)) {
            throw new \Exception($result->error->message.'. Note: '.$result->error->note);
        }

        // Dispatch event for after receiving telr response
        event(new TelrRecieveTransactionResponseEvent($transaction, $result));

        // Is success transaction
        if (3 === $result->order->status->code && 'paid' === strtolower($result->order->status->text)) {
            // Mark the transaction as approved
            $transaction->approve();

            // Dispatch success transaction
            event(new TelrSuccessTransactionEvent($transaction, $result));

            return;
        }

        // Mark the transaction as failed
        $transaction->failed();

        // Dispatch failed transaction
        event(new TelrFailedTransactionEvent($transaction, $result));

        return $transaction;
    }

    /**
     * Call the telr server
     *
     * @param $endPoint
     * @param $formParams
     * @return mixed
     */
    protected function callTelrServer($endPoint, $formParams)
    {
        $client = new Client();
        $result = $client->post($endPoint, ['form_params' => $formParams]);

        // Validate if response is equal 200
        if (200 != $result->getStatusCode()) {
            throw new ClientException('The response is '.$result->getStatusCode());
        }

        // Convert json response into object
        return \GuzzleHttp\json_decode($result->getBody()->getContents());
    }
}