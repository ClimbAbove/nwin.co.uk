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

        if($p = request()->input('p') !== null) {
            if($p == 1) {
                $domain = 'ecotechconservatories.local';
            }
            if($p == 2) {
                $domain = 'profitinstallations.local';
            }
        }

        switch($domain) {
            case 'ecotechconservatories.local':
            case 'ecoconservatories.local':
            case 'ecoconservatories.co.uk':
            case 'www.ecoconservatories.co.uk':

                $this->app->bind(\App\Repositories\Interfaces\WindowQuoteRepositoryInterface::class, \App\Repositories\Implementations\EcoTechConservatories\WindowQuoteRepository::class);
                $this->app->bind(\App\Repositories\Interfaces\ContentRepositoryInterface::class, \App\Repositories\Implementations\EcoTechConservatories\ContentRepository::class);

                break;

            case 'profitinstallations.local':
            case 'pro-installations..co.uk':

                $this->app->bind(\App\Repositories\Interfaces\WindowQuoteRepositoryInterface::class, \App\Repositories\Implementations\ProFitInstallations\WindowQuoteRepository::class);
                $this->app->bind(\App\Repositories\Interfaces\ContentRepositoryInterface::class, \App\Repositories\Implementations\ProFitInstallations\ContentRepository::class);

            break;
            case 'nwin.local':
            case 'nwin.co.uk':
            case 'www.nwin.co.uk':

                $this->app->bind(\App\Repositories\Interfaces\WindowQuoteRepositoryInterface::class, \App\Repositories\Implementations\WindowQuoteRepository::class);
                $this->app->bind(\App\Repositories\Interfaces\ContentRepositoryInterface::class, \App\Repositories\Implementations\Nwin\ContentRepository::class);

            break;
        }


    }
}
