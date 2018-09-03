<?php

namespace TelrGateway;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use TelrGateway\Events\TelrCreateRequestEvent;
use TelrGateway\Events\TelrRecieveTransactionResponseEvent;
use TelrGateway\Listeners\CreateTransactionListener;
use TelrGateway\Listeners\SaveTransactionResponseListener;

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