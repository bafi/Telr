<?php

namespace Mubarakismail\TelrPayment;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Mubarakismail\TelrPayment\Events\TelrCreateRequestEvent;
use Mubarakismail\TelrPayment\Events\TelrRecieveTransactionResponseEvent;
use Mubarakismail\TelrPayment\Listeners\CreateTransactionListener;
use Mubarakismail\TelrPayment\Listeners\SaveTransactionResponseListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TelrCreateRequestEvent::class => [
            CreateTransactionListener::class,
        ],
        // Register listener after receive response from telr
        TelrRecieveTransactionResponseEvent::class => [
            SaveTransactionResponseListener::class
        ],
    ];
}