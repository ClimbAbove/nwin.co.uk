<?php

namespace App\Classes\Elements\Question;

use App\Classes\Elements\Abstracts\AbstractQuestionnaireElement;
use App\Classes\Elements\Answer\AnswerElement;
use App\Classes\Elements\QuestionHelp\QuestionHelpElement;

class QuestionElement extends AbstractQuestionnaireElement
{
    public string $id;                       // Unique ID
    public string $text;                     // Main title
    protected string|array $sub_text = [];   // Sub title, paragraph
    public QuestionHelpElement $help;
    public string|null $type = null;                     // Type: tile, text

    protected string $enum;
    public $_sets = [];

    public bool $answered = false;
    public int $min_answers = 1;
    public array $answers = [];
    public $next_step_enabled = false;

    public function setEnum($value)
    {
        $value .= time();
        $this->enum = $value;

        $this->_sets['enum'] = $this->enum;
    }

    public function getEnum()
    {
        return $this->enum;
    }
    public function setSubText(string|array $value)
    {
        $this->sub_text = $value;
        $this->_sets['sub_text'] = $this->sub_text;
    }

    public function getSubText()
    {
        return $this->castToArray($this->sub_text);
    }

    public function pushAnswer(AnswerElement $answer)
    {
        $this->answers = array_merge($this->answers, [$answer]);

        return $this;
    }

    public function setAnswers(Array $answers)
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * answer
     *
     * answers this question.
     *
     * marks question as answered and sets the answer as answered as well as the answer value.
     *
     * @param string $answer_id
     * @param        $answer_value
     *
     * @return $this|void
     */
    public function answer($answer_id, $answer_value = null)
    {
        // Load the answer object.
        $answer = $this->getAnswerById($answer_id);

        if($answer !== null) {

            $answer->answer($answer_value);

            $this->answered = true;

            return $this;
        }

        return null;
        dd('Error: QuestionElement->answer() - no answer set.' . $answer_id . '- '. $answer_value);
    }

    public function getAnswerById($answer_id)
    {
        foreach(($this->answers ?? []) as $answer) {
            if($answer->id == $answer_id) {
                return $answer;
            }
        }

        return null;
    }

    public function getAnswer()
    {

        switch($this->type) {
            case 'text':

                foreach(($this->answers ?? []) as $answer) {
                    if ($answer->answered === true) {
                        return $answer;
                    }
                }

            break;

            default:

                foreach(($this->answers ?? []) as $answer) {
                    if ($answer->answered === true) {
                        return $answer;
                    }
                }

            break;
        }


        return null;
    }


    public function setRules(array $rules)
    {
        $this->rules = $rules;

        foreach($rules as $field_name => $rule) {
            $this->_sets['rules']['_form_fields.' . $field_name] = $rule;
        }

        return $this;
    }

    public function setRulesMessages(array $custom_messages = [])
    {
        $this->rules_messages = $custom_messages;

        foreach($custom_messages as $field_name => $message) {
            $this->_sets['rules_messages']['_form_fields.' . $field_name] = $message;
        }

        return $this;
    }

    public function getRules()
    {
        return ($this->rules ?? []);
    }


    public function getRulesMessages()
    {
        return ($this->rules_messages ?? []);
    }
}
