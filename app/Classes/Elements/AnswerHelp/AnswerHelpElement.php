<?php

namespace App\Classes\Elements\AnswerHelp;

use App\Classes\Elements\Abstracts\AbstractQuestionnaireElement;

class AnswerHelpElement extends AbstractQuestionnaireElement
{
    public string $icon = 'question_mark';   // Icon
    public string $text = '';   // Label
    protected $help = '';   // Label

    public function setHelp(string|array $value)
    {
        $this->help = $value;
        $this->_sets['help'] = $this->help;
    }

    public function getHelp()
    {
        return $this->castToArray($this->help);
    }

}

