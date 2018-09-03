<?php

namespace TelrGateway\Events;

use TelrGateway\Transaction;

class TelrRecieveTransactionResponseEvent
{
    /**
     * @var Transaction
     */
    public $transaction;

    /**
     * @var \stdClass
     */
    public $response;

    /**
     * SuccessTransactionEvent constructor.
     *
     * @param Transaction $transaction
     * @param \stdClass $response
     */
    public function __construct(Transaction $transaction, \stdClass $response)
    {
        $this->transaction = $transaction;
        $this->response = $response;
    }
}
