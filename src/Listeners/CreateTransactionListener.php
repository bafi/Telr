<?php

namespace TelrGateway\Listeners;

use TelrGateway\Events\TelrCreateRequestEvent;
use TelrGateway\Transaction;

class CreateTransactionListener
{
    /**
     * @var \TelrGateway\Transaction
     */
    protected $model;

    /**
     * CreateTransactionListener constructor.
     *
     * @param \TelrGateway\Transaction $model
     */
    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the event.
     *
     * @param  TelrCreateRequestEvent $event
     * @return void
     */
    public function handle(TelrCreateRequestEvent $event)
    {
        $this->model->create([
            'cart_id' => $event->telrRequest->getCartId(),
            'order_id' => $event->telrRequest->getOrderId(),
            'test_mode' => $event->telrRequest->isTestMode(),
            'store_id' => $event->telrRequest->getStoreId(),
            'amount' => $event->telrRequest->getAmount(),
            'description' => $event->telrRequest->getDesc(),
            'success_url' => $event->telrRequest->getSuccessURL(),
            'canceled_url' => $event->telrRequest->getCancelURL(),
            'declined_url' => $event->telrRequest->getDeclinedURL(),
            'billing_fname' => $event->telrRequest->getBillingFirstName(),
            'billing_sname' => $event->telrRequest->getBillingSurName(),
            'billing_address_1' => $event->telrRequest->getBillingAddress1(),
            'billing_address_2' => $event->telrRequest->getBillingAddress2(),
            'billing_city' => $event->telrRequest->getBillingCity(),
            'billing_region' => $event->telrRequest->getBillingRegion(),
            'billing_zip' => $event->telrRequest->getBillingZip(),
            'billing_country' => $event->telrRequest->getBillingCountry(),
            'billing_email' => $event->telrRequest->getBillingEmail(),
            'lang_code' => $event->telrRequest->getLangCode(),
            'trx_reference' => $event->response->order->ref,
        ]);
    }
}

