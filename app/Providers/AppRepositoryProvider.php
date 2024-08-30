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

        // Grab the request domain.
        $domain = parse_url(request()->root())['host'];

        switch($domain) {
            case 'localwindowfitter.local':
            case 'localwindowfitter.co.uk':
            case 'www.localwindowfitter.co.uk':

                $this->app->bind(\App\Repositories\Interfaces\WindowQuoteRepositoryInterface::class, \App\Repositories\Implementations\LocalWindowFitter\WindowQuoteRepository::class);
                $this->app->bind(\App\Repositories\Interfaces\ContentRepositoryInterface::class, \App\Repositories\Implementations\LocalWindowFitter\ContentRepository::class);

                break;

            case 'ecotechconservatories.local':
            case 'ecoconservatories.local':
            case 'ecoconservatories.co.uk':
            case 'www.ecoconservatories.co.uk':
die('Maintence');
                $this->app->bind(\App\Repositories\Interfaces\WindowQuoteRepositoryInterface::class, \App\Repositories\Implementations\EcoTechConservatories\WindowQuoteRepository::class);
                $this->app->bind(\App\Repositories\Interfaces\ContentRepositoryInterface::class, \App\Repositories\Implementations\EcoTechConservatories\ContentRepository::class);

                break;

            case 'profitinstallations.local':
            case 'pro-installation.co.uk':
            case 'www.pro-installation.co.uk':

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
