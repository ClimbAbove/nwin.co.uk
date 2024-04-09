<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Abstracts\AbstractComponent;
use App\Services\CookieService;

class QuestionnaireRestoreComponent extends AbstractComponent
{
    public $questionnaire;
    public function mount($data)
    {
   //     $this->createFormFieldProperties($data['questionnaire_element']->form_field_names);
        $this->questionnaire = $data['questionnaire_element'];
    }

    /**
     * answer
     *
     * answer a step.
     *
     * @param string $step_id
     * @param $step_value
     *
     * @return void
     */
    public function answer(string $step_id = null, $step_value = null)
    {
// dd([$this->questionnaire->steps], $this->questionnaire->current_step_index);
        if($this->questionnaire->steps[$this->questionnaire->current_step_index]->type === 'text') {
            $answer = $this->questionnaire->answerCurrentStep($this->questionnaire->current_step->elements[0]->id, $this->current_step);
            $this->current_step = null;
        }
        else {
            $answer = $this->questionnaire->answerCurrentStep($step_id, $step_value);
        }

        $answered_answer = $answer->getAnswer();

        setcookie('__quote_tool', json_encode($this->questionnaire->history), time() + (20), "/");

        if(($answered_answer->next_step_id ?? null) !== null) {
            $next_step = $this->questionnaire->getNextStep($answered_answer->next_step_id);
            $this->questionnaire->setCurrentStep($next_step);
        }
        elseif(($answer->next_step_id ?? null) !== null) {
            $next_step = $this->questionnaire->getNextStep($answer->next_step_id);

            if($next_step == null) {
                dd('Did you push question?');
            }
            $this->questionnaire->setCurrentStep($next_step);
        }
        else {

            $cookie_service = app()->make(CookieService::class);
            if($answered_answer->id = 'restore_yes' && $answered_answer->value == 'yes') {
                $cookie = $cookie_service->getCookie('__quote_tool_history');
                if($cookie !== null) {
                    session()->push('__quote_tool_history', $cookie);
                }
            }

            $cookie_service->deleteCookie('__quote_tool_history');

            return redirect()->route('page-index', []);

        }

    }
}
