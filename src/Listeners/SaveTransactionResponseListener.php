<?php

namespace TelrGateway\Listeners;

use TelrGateway\Events\TelrSuccessTransactionEvent;
use TelrGateway\Events\TelrFailedTransactionEvent;

class SaveTransactionResponseListener
{
    /**
     * @param TelrSuccessTransactionEvent|TelrFailedTransactionEvent $event
     */
    public function handle($event)
    {
        $event->transaction->fill(['response' => $event->response, 'status' => 1])->save();
    }
}

