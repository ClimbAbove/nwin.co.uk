<?php

namespace App\Providers;

use App\Classes\Elements\Answer\AnswerElementSynthesizer;
use App\Classes\Elements\AnswerHelp\AnswerHelpElementSynthesizer;
use App\Classes\Elements\Form\FormElementSynthesizer;
use App\Classes\Elements\FormField\FormFieldElementSynthesizer;
use App\Classes\Elements\Question\QuestionElementSynthesizer;
use App\Classes\Elements\QuestionHelp\QuestionHelpElementSynthesizer;
use App\Classes\Elements\Questionnaire\QuestionnaireElementSynthesizer;
use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Livewire::propertySynthesizer(AnswerElementSynthesizer::class);
        Livewire::propertySynthesizer(AnswerHelpElementSynthesizer::class);
        Livewire::propertySynthesizer(FormElementSynthesizer::class);
        Livewire::propertySynthesizer(FormFieldElementSynthesizer::class);
        Livewire::propertySynthesizer(QuestionElementSynthesizer::class);
        Livewire::propertySynthesizer(QuestionHelpElementSynthesizer::class);
        Livewire::propertySynthesizer(QuestionnaireElementSynthesizer::class);
    }
}
