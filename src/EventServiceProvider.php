<?php

namespace payment\telr;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use payment\telr\Events\TelrCreateRequestEvent;
use payment\telr\Events\TelrRecieveTransactionResponseEvent;
use payment\telr\Listeners\CreateTransactionListener;
use payment\telr\Listeners\SaveTransactionResponseListener;

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