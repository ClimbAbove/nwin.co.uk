<?php

namespace App\Http\Livewire;

use App\Classes\Elements\Form\FormElement;
use App\Classes\Elements\Question\QuestionElement;
use App\DTOs\DispatchDTO;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Livewire\Abstracts\AbstractComponent;
use Illuminate\Support\Facades\Validator;

class QuestionnaireComponent extends AbstractComponent
{
    public $questionnaire;

    /**
     * mount
     *
     * Runs one time on a components initialization. Like a constructor.
     *
     * @param   array  $data
     *
     * @return  void
     */
    public function mount(array $data)
    {
        // Add all child form fields to as properties of this class. This is data binding and validation.
        $this->createFormFieldProperties($data['questionnaire_element']->form_field_names);

        // Questionnaire element. Normally loaded from a repository.
        $this->questionnaire = $data['questionnaire_element'];

        if($data['quote_tool_history'] ?? false) {
            $this->questionnaire->history = $data['quote_tool_history'];
        }

    }

    /**
     * rendered
     *
     * Method run after the component has been rendered.
     *
     * @return  void
     */
    public function rendered()
    {
        $this->dispatch('stepTaken', $this->questionnaire->getCurrentStep()->id);
    }

    /**
     * back
     *
     * refreshes questionnaire back to previous question.
     *
     * @return void
     */
    public function back()
    {
        $this->questionnaire->getPreviousStep();
    }

    /**
     * nextStep
     *
     * method that should be use on click of the next button
     *
     * @param $step_id_or_closure
     *
     * @return void
     */

    public function nextStep()
    {

        $this->validateForms();

        foreach($this->questionnaire->steps as $step_index => $step) {

            if ($step instanceof FormElement) {
                foreach ($step->fields as $field_index => $field) {
                    $this->questionnaire->steps[$step_index]->fields[$field_index]->value = $this->_form_fields[$field->name];
                }
            } elseif ($step instanceof QuestionElement) {
                foreach ($step->answers as $answer_index => $answer) {
                    if ($answer->type === 'text' && $answer->answered === true) {
                        $this->questionnaire->steps[$step_index]->answers[$answer_index]->value = $this->_form_fields[$answer->name];
                    }
                }
            }

        }

        $current_step = $this->questionnaire->getCurrentStep();

        if($current_step->id === null) {
            dd('Current step has no id');
        }

        if($current_step instanceof FormElement) {
           foreach($current_step->fields as $field) {
               $this->questionnaire->answerCurrentStep($field->name, $this->_form_fields[$field->name]);
           }
        }

        $next_step = null;

        if($current_step->next_step === null) {
            dd('No next step!');
        }

        $this->questionnaire->history[] = [
            'step_id'     => $this->questionnaire->getCurrentStep()->id,
        ];

        $next_step = $this->questionnaire->loadNextStep($current_step);

        if($next_step == null) {
          dd('Did you push a next step?');
        }

        $this->questionnaire->setCurrentStep($next_step);

    }



    /**
     * answer
     *
     * answer a step (non-form).
     *
     * @param string $answer_id
     * @param $answer_value
     *
     * @return void
     */
    public function answer(string $answer_id = null, $answer_value = null)
    {

        if($this->questionnaire->steps[$this->questionnaire->current_step_index]->type === 'text') {

            if($this->questionnaire->steps[$this->questionnaire->current_step_index] instanceof QuestionElement)
            {

                foreach($this->questionnaire->current_step->answers as $answers)  {

                    if($answers->id === $answer_id) {

                        $this->validateForms();

                        $answer = $this->questionnaire->answerCurrentStep($answer_id, $this->_form_fields[$answer_id]);

                    }

                }

            }
            else {

                $answer = $this->questionnaire->answerCurrentStep($this->questionnaire->current_step->elements[0]->id, $this->current_step);
                $this->current_step = null;

            }
        }
        elseif($this->questionnaire->steps[$this->questionnaire->current_step_index]->type === 'multi_tile') {

            $answer = $this->questionnaire->answerCurrentMultiStep($answer_id, $answer_value);

            return $this->questionnaire->steps[$this->questionnaire->current_step_index];
        }
        else {

            $answer = $this->questionnaire->answerCurrentStep($answer_id, $answer_value);


        }

        $answered_answer = $answer->getAnswer();
        //dd([$answered_answer]);
        setcookie('__quote_tool', json_encode($this->questionnaire->history), time() + (20), "/");

        if(($answered_answer->next_step ?? null) !== null) {
            $next_step = $this->questionnaire->loadNextStep($answered_answer);

            if($next_step == null) {
                dd('Did you push question?');
            }
            elseif(is_string($next_step)) {
                return $this->getStepByID($next_step);
            }
            elseif($next_step instanceof DispatchDTO) {
                return $this->dispatch($next_step->event, ...$next_step->data);
            }

            $this->questionnaire->setCurrentStep($next_step);
        }
        elseif(($answer->next_step ?? null) !== null) {

            $next_step = $this->questionnaire->loadNextStep($answer);

            if($next_step == null) {
                dd('Did you push question?');
            }
            elseif(is_string($next_step)) {
                return $this->getStepByID($next_step);
            }
            elseif($next_step instanceof DispatchDTO) {
                return $this->dispatch($next_step->event, ...$next_step->data);
            }

            $this->questionnaire->setCurrentStep($next_step);
        }

    }

    /**
     * render
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('livewire.questionnaire');
    }


    /**
     * validateForms
     *
     * Validate the form fields.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateForms()
    {

        // Check if the current step is a form element, if it's not, then there is no point in validating.
        if($this->questionnaire->getCurrentStep() instanceof FormElement) {

            // Livewire - reset just in case.
            $this->resetErrorBag();
            $this->resetValidation();

            $all_customer_validation_messages  = [];  // Array to store ALL our validation messages.
            $this->_custom_validation_messages = []; // Array to hold the errors we will then output to page.

            // Get the rules.
            $cleaned_validator_form_field_rules = [];
            foreach ($this->questionnaire->getCurrentStep()->rules as $field => $rule) {
                $cleaned_field_name                                      = str_replace('_form_fields.', '', $field);
                $cleaned_validator_form_field_rules[$cleaned_field_name] = $rule;
            }

            // Get the messages.
            foreach (
            ($this->questionnaire->getCurrentStep()->rules_messages ?? []) as $field_name_and_rule => $message
            ) {
                $cleaned_field_name                                    = str_replace(
                    '_form_fields.',
                    '',
                    $field_name_and_rule
                );
                $all_customer_validation_messages[$cleaned_field_name] = $message;
            }

            $validator = Validator::make(
                $this->_form_fields,
                $cleaned_validator_form_field_rules,
                $all_customer_validation_messages
            );

            $validator->validate();
        }
        elseif($this->questionnaire->getCurrentStep() instanceof QuestionElement) {

            // Livewire - reset just in case.
            $this->resetErrorBag();
            $this->resetValidation();

            $all_customer_validation_messages  = [];  // Array to store ALL our validation messages.
            $this->_custom_validation_messages = []; // Array to hold the errors we will then output to page.

            // Get the rules.
            $cleaned_validator_form_field_rules = [];
            foreach (($this->questionnaire->getCurrentStep()->rules ?? []) as $field => $rule) {
                $cleaned_field_name                                      = str_replace('_form_fields.', '', $field);
                $cleaned_validator_form_field_rules[$cleaned_field_name] = $rule;
            }

            // Get the messages.
            foreach (
            ($this->questionnaire->getCurrentStep()->rules_messages ?? []) as $field_name_and_rule => $message
            ) {
                $cleaned_field_name = str_replace(
                    '_form_fields.',
                    '',
                    $field_name_and_rule
                );
                $all_customer_validation_messages[$cleaned_field_name] = $message;
            }

            $validator = Validator::make(
                $this->_form_fields,
                $cleaned_validator_form_field_rules,
                $all_customer_validation_messages
            );

            $validator->validate();

        }

    }

    /**
     * save
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save()
    {

      $this->validateForms();

        // Assign the values to the fields as we are on the last step.
/*$fields = $this->questionnaire->getCurrentStep()->fields;

        foreach($fields as $key => $field) {
            $fields[$key]->value = $this->_form_fields[$field->name];
        }
*/


        foreach($this->questionnaire->steps as $step_index => $step) {
            if($step instanceof FormElement) {
                foreach($step->fields as $field_index => $field) {
                    if($this->questionnaire->steps[$step_index]->fields[$field_index]->name === $field->name) {
                        $this->questionnaire->steps[$step_index]->fields[$field_index]->value = $this->_form_fields[$field->name];
                    }
                }
            } elseif($step instanceof QuestionElement) {
                foreach($step->answers as $answer_index => $answer) {
                    if($answer->type === 'text' && $answer->answered === true) {
                        $this->questionnaire->steps[$step_index]->answers[$answer_index]->value = $this->_form_fields[$answer->name];
                    }
                }
            }
        }

        $save_action = $this->questionnaire->getSaveAction();

        $class = app()->make(QuestionnaireController::class);
        $method = $save_action['method'];

        $result = $class->$method($this->questionnaire);

        if($result instanceof DispatchDTO) {
            return $this->dispatch($result->event, ...$result->data);
        }

        return redirect()->route('page-quotes-index');

    }



    public function selectQuestion($select_index) {

        foreach($this->questions as $index => $question) {
            $this->questions[$index]->current = false;
            if($select_index === $index) {

                $this->questions[$index]->current = true;

                return;
            }
        }

    }


}
