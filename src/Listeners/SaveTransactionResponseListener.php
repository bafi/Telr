<?php

namespace Mubarakismail\TelrPayment\Listeners;

use Mubarakismail\TelrPayment\Events\TelrSuccessTransactionEvent;
use Mubarakismail\TelrPayment\Events\TelrFailedTransactionEvent;

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

