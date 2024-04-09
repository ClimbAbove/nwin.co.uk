<?php

namespace App\Providers;

use App\Repositories\QuoteQuestionnaires\WindowQuoteRepository;
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
        $this->app->bind(WindowQuoteRepository::class, function() {
           return new WindowQuoteRepository();
        });
    }
}
