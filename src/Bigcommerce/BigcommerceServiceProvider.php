<?php

namespace Oseintow\Bigcommerce;

use Illuminate\Support\ServiceProvider;
use Oseintow\Bigcommerce\Facades\Bigcommerce;

class BigcommerceServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/bigcommerce.php' => config_path('bigcommerce.php'),
        ]);

        $this->app->alias('Bigcommerce', Bigcommerce::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bigcommerce', function ($app) {
            return new Bigcommerce();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [];
    }
}
