<?php

namespace App\Classes\Elements\Questionnaire;

use App\Classes\Elements\Abstracts\AbstractQuestionnaireElement;
use App\Classes\Elements\Answer\AnswerElement;
use App\Classes\Elements\Form\FormElement;
use App\Classes\Elements\Question\QuestionElement;
use App\DTOs\DispatchDTO;
use Illuminate\Support\Facades\Cookie;


class QuestionnaireElement extends AbstractQuestionnaireElement
{
    public int $current_step_index = 0;
    public int $progress = 0;

    public string $current_step_id;

    public QuestionElement|FormElement|null $current_step = null;
    public int $total_steps_count = 0;

    public array $steps = [];

    public array $history = [];
    public array $form_field_names = [];
    protected array $save_action;

    protected array $integration_config;

    public function __construct($bulk_assignments = [])
    {
        parent::__construct($bulk_assignments);
    }

    public function setIntegrationConfig($integration_key)
    {
        $this->integration_config = $integration_key;

        $this->_sets['integration_config'] =  $this->integration_config;

        return $this;
    }

    public function getIntegrationConfig($key = null)
    {

        if($key !== null) {
            return ($this->integration_config[$key] ?? '');
        }

        return ($this->integration_config ?? []);
    }

    public function setSaveAction(array $class_method)
    {
        $this->save_action = [
            'class'  => ($class_method['class'] ?? $class_method[0]),
            'method' => ($class_method['method'] ?? $class_method[1]),
        ];

        $this->_sets['save_action'] = $this->save_action;
    }

    public function getSaveAction()
    {
        return $this->save_action;
    }
    /**
     * setSteps
     *
     * Assign an array of elements to steps. Any existing step will be overwritten.
     *
     * @param  array[QuestionElement|FormElement] $steps
     *
     * @return void
     */
    public function setSteps(array $element): QuestionnaireElement
    {
        $this->steps = $this->questions;

        $this->total_steps_count = count($this->steps);

        return $this;
    }

    /**
     * pushStep
     *
     * Push a single element to the steps array.
     *
     * @param  QuestionElement|FormElement $step
     *
     * @return $this
     */
    public function pushStep(QuestionElement|FormElement $element): QuestionnaireElement
    {
        $this->steps = array_merge($this->steps, [$element]);

        $this->total_steps_count = count($this->steps);

        foreach($this->steps as $step) {
            if($step instanceof FormElement) {
                foreach($step->fields ?? [] as $field) {
                    $this->form_field_names[$field->name] = $field->name;
                }
            }
            elseif($step instanceof QuestionElement) {

                if($step->type === 'text') {
                    $this->form_field_names[$step->id] = $step->id;
                }

            }
        }

        return $this;
    }

    /**
     * setCurrentStep
     *
     * Set the current step to the provided element.
     *
     * QuestionElement|FormElement $step
     */
    public function setCurrentStep(QuestionElement|FormElement $element): QuestionnaireElement
    {

        if(($guard = $element->getGuard()) !== null) {

            $class = array_shift($guard);
            $method = array_shift($guard);
            $params = ($guard ?? []);

            $element = call_user_func_array([$class, $method], array_merge([$this, $this->getGuard()], $params));

        }


        $this->current_step = $element;
        $this->current_step_id = $this->current_step->id;

        $this->setProgress();

        return $this;
    }


    /**
     * setProgress
     *
     * @return void
     */
    public function setProgress()
    {
        $this->current_step_index = 0;

        foreach($this->steps as $step) {
            $this->current_step_index++;

            if($step->id === $this->getCurrentStep()->id) {
                break;
            }
        }

        $this->progress = (($this->current_step_index / (count($this->steps) + 1)) * 100);

        return $this;
    }

    /**
     * getCurrentStep
     *
     * @return mixed
     */
    public function getCurrentStep(): QuestionElement|FormElement|null
    {
        if(($this->current_step->id ?? null) === null) {
            $this->current_step = $this->steps[0];
            $this->current_step_id = $this->current_step->id;
        }
        else {
            $this->current_step = $this->getStepById($this->current_step_id);
        }

        return $this->current_step;
    }

    public function answerCurrentMultiStep($answer_id, $answer_value): QuestionElement|FormElement|null
    {

        $answered_step = $this->current_step->answer($answer_id, $answer_value);

        $answered_count = 0;
        // Update the questionnaire steps array with the new answered step. This is so we can keep track of the answered steps.
        foreach(($this->steps ?? []) as $step_index => $step) {

            if($step->answered === true) {
                $answered_count++;
            }

            if($step->id === $answered_step->id) {
                $this->steps[$step_index] = $answered_step;
            }
        }

        if($this->current_step->min_answers == $answered_count) {
            $this->current_step->next_step_enabled = true;
        }

       //@TODO: could check is a coutn matches then auto next.

        return $answered_step;
    }

    /**
     * answerCurrentStep
     *
     * set the answer for the current step.
     *
     * @param $step_id
     * @param $step_value
     *
     * @return QuestionElement|null
     */
    public function answerCurrentStep($answer_id, $answer_value): QuestionElement|FormElement|null
    {


        $p = $this->current_step;
        $answered_step = $this->current_step->answer($answer_id, $answer_value);

        if($answered_step === null) {
            dd(
                [
                    'nope ' . $answer_id,
                    $this->getLastStep(),
                    $answered_step,
                    $this->current_step,
                    $this,


            ]);
            return null;
        }

        $this->history[] = [
            'question_id' => $answered_step->id,
            'answer_id'   => $answered_step->getAnswer()->id,
            'value'       => $answered_step->getAnswer()->value,
        ];

        // Update the questionnaire steps array with the new answered step. This is so we can keep track of the answered steps.
        foreach(($this->steps ?? []) as $step_index => $step) {
            if($step->id === $answered_step->id) {
                $this->steps[$step_index] = $answered_step;
            }
        }

        // Set the current step to the new answered step.
        $this->setCurrentStep($answered_step);

        return $answered_step;
    }

    /**
     * getPreviousStep
     *
     * returns the previous step, if available or null.
     *
     * @return QuestionElement|FormElement|null
     */

    public function getPreviousStep()
    {
        if($this->hasHistory() === false) {
            return null;
        }

        $this->unAnswerLastStep();

        $past = array_pop($this->history);

        $this->setCurrentStep($this->getStepById($past['question_id'] ?? $past['step_id']));

        return $this->getCurrentStep();
    }

    public function unAnswerLastStep()
    {
        $last_step = $this->getLastStep();

        foreach($this->steps as $step_index => $step)
        {

            if($last_step !== null) {
                if($step->id === $last_step->id) {

                    foreach($step->answers as $answer_index => $answer) {
                        $this->steps[$step_index]->answered = false;
                        $this->steps[$step_index]->answers[$answer_index]->answered = false;
                        $this->steps[$step_index]->answers[$answer_index]->value = null;

                    }

                    $this->steps[$step_index]->answered = false;


                    return true;

                }
            } else {
                $this->steps[$step_index]->answered = false;
                return true;
            }
        }




    }

    /**
     * hasHistory
     *
     * true is has history, or in simple terms has answered at least 1 question.
     *
     * @param   none
     *
     * @return  bool
     */
    public function hasHistory()
    {
        if(count($this->history) == 0) {
            return false;
        }

        return true;
    }


    /**
     * loadNextStep
     *
     * return the next step.
     *
     * @param string|callable $element_id_or_closure
     *
     * @return mixed
     */
    public function loadNextStep(string|callable|array|AnswerElement|QuestionElement|FormElement $element_id_or_callback)
    {

        if (is_array($element_id_or_callback)) {

            $class = array_shift($element_id_or_callback);
            $method = array_shift($element_id_or_callback);
            $params = ($element_id_or_callback ?? []);

            $callback_result = call_user_func_array([$class, $method], array_merge([$this, $this->getCurrentStep()], $params));

            return $callback_result;
        }
        elseif(
            $element_id_or_callback instanceof QuestionElement ||
            $element_id_or_callback instanceof AnswerElement ||
            $element_id_or_callback instanceof FormElement
        ) {
            if (is_array($element_id_or_callback->next_step ?? null)) {

                $class = array_shift($element_id_or_callback->next_step);
                $method = array_shift($element_id_or_callback->next_step);
                $params = ($element_id_or_callback->next_step ?? []);

                $callback_result = call_user_func_array([$class, $method], array_merge([$this, $this->getCurrentStep()], $params));

                return $callback_result;

            }
            else {

                return $this->getStepByID($element_id_or_callback->next_step);

            }
        }
        elseif(is_string($element_id_or_callback)) {

            return $this->getStepByID($element_id_or_callback->next_step);

        } else {
            dd('no next');
        }

    }


    /**
     * getStepById
     *
     * return a step by a given id.
     *
     * @param string $element_id
     *
     * @return QuestionElement|FormElement|null
     */
    public function getStepById(string $element_id): QuestionElement|FormElement|null
    {

        foreach($this->steps as $step) {
            if($step->id == $element_id) {
                return $step;
            }
        }

        return null;
    }


    public function getLastStep()
    {
        foreach(array_reverse($this->steps) ?? [] as $step) {
            if($step->answered === true) {
                return ($step);
            }
        }

        return null;
    }

    public function getLastAnswer()
    {
        foreach(array_reverse($this->steps) ?? [] as $step) {
            if($step->answered === true) {
                return ($step->getAnswer());
            }
        }

        return null;
    }

    public function getData(): array|null
    {

        $data = [];

        foreach($this->steps as $step) {

            $this_step = [
                'id' => $step->id,
                'answer' => null,
            ];

            if($step instanceof FormElement) {

                foreach($step->fields as $field) {

                    $this_step = [
                        'id'     => $field->name,
                        'answer' => $questionnaire_element->_form_fields[$field->name] ?? $field->value,
                    ];

                    $data[$field->name ?? $field->id] = $this_step;
                }

            }
            else {

                if($step->answered == true) {

                    foreach($step->answers as $answer) {

                        if($answer->answered == true) {

                            $this_step['answer'] = $answer->value;

                        }
                    }
                }

                $data[$step->id] = $this_step;
            }
        }

        return $data;


    }
}
