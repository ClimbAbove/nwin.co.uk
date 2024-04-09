<?php

namespace App\Classes\Elements\QuestionHelp;

use App\Classes\Elements\Abstracts\AbstractQuestionnaireElement;

class QuestionHelpElement extends AbstractQuestionnaireElement
{
    public string $icon = 'question_mark';   // Icon
    public string $text = '';   // Label
    protected string|array $help = '';  // Contents

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

