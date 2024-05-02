<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $domain = parse_url(request()->root())['host'];

        switch($domain) {
            case 'nwin.localx':

                $this->app->bind(\App\Repositories\Interfaces\WindowQuoteRepositoryInterface::class, \App\Repositories\Implementations\EcoTechConservatories\WindowQuoteRepository::class);
                $this->app->bind(\App\Repositories\Interfaces\ContentRepositoryInterface::class, \App\Repositories\Implementations\EcoTechConservatories\ContentRepository::class);

                break;

            case 'nwin.local':
            case 'nwin.co.uk':

                $this->app->bind(\App\Repositories\Interfaces\WindowQuoteRepositoryInterface::class, \App\Repositories\Implementations\WindowQuoteRepository::class);
                $this->app->bind(\App\Repositories\Interfaces\ContentRepositoryInterface::class, \App\Repositories\Implementations\Nwin\ContentRepository::class);

            break;
        }


    }
}
