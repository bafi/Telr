<?php

namespace TelrGateway;

use Illuminate\Support\ServiceProvider;

class TelrServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(EventServiceProvider::class);
        $this->publishes([__DIR__.'/config/telr.php' => config_path('telr.php'),]);
        $timestamp = date('Y_m_d_His', time());
        // Check if telr transaction table is migrated
        if (! class_exists('CreateTelrTransactionsTable')) {
            $this->publishes([
                __DIR__.'/migrations/create_telr_transactions_table.php.stub' => $this->app->databasePath()."/migrations/{$timestamp}_create_telr_transactions_table.php",
            ], 'migrations');
        }
    }
}
