<?php

namespace A3020\Sitemap;

use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'sitemap.client',
            \A3020\Sitemap\Client\Sitemap::class
        );

        $this->app->bind(
            'sitemap.validator',
            \A3020\Sitemap\Validator\Sitemap::class
        );
    }
}
