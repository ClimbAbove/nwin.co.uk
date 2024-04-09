<?php

namespace App\Classes\Elements\Answer;

use App\Classes\Elements\Abstracts\AbstractQuestionnaireElement;
use App\Classes\Elements\AnswerHelp\AnswerHelpElement;

class AnswerElement extends AbstractQuestionnaireElement
{
    public string $text;
    public string $type = 'tile';
    public string $label;
    public $value;
    public AnswerHelpElement $help;
    public bool $answered = false;
    public string $icon;

    /**
     * answer
     *
     * @param $value
     *
     * @return $this
     */
    public function answer($value) {
        $this->answered = true;

        if($value === true) {
            $value = "true";
        }
        elseif($value === false) {
            $value = "false";
        }

        $this->value = $value;

        return $this;
    }
}
