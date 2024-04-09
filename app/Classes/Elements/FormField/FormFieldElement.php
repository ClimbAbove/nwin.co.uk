<?php

namespace App\Classes\Elements\FormField;

use App\Classes\Elements\Abstracts\AbstractQuestionnaireElement;
use Modules\FormBuilder\Classes\FormField;

class FormFieldElement extends AbstractQuestionnaireElement
{
    public string $name = '';
    public string $label = '';
    public string $type = 'text';
    public bool $answered = false;
    public $next_step_id = null;
    public $data = [];

    public function answer($value)
    {
        $this->value = $value;
        $this->answered = true;
    }

    public function pushDataAttr($name, $value)
    {
        $this->data = array_merge($this->data, ['data-' . $name => $value]);
    }


    public function getDataAttrs()
    {
        return $this->data;
    }

}
