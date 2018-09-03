<?php

namespace payment\telr\Listeners;

use \payment\telr\Events\TelrSuccessTransactionEvent;
use \payment\telr\Events\TelrFailedTransactionEvent;

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

