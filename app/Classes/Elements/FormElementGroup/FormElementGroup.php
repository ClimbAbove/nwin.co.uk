<?php

namespace App\Classes\Elements\FormElementGroup;

use App\Classes\Elements\Abstracts\AbstractQuestionnaireElement;

class FormElementGroup extends AbstractQuestionnaireElement
{
    public $fields = [];
    public $next_form_element_group_id = null;
    public function pushField($element)
    {
        $this->fields[] = $element;

        return $this;
    }
}
