<?php

namespace Modules\FormBuilder\Classes;

class FormFieldOption
{
    private $value;
    private $label;

    public function __construct($value, $label)
    {
        $this->value = $value;
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getValue()
    {
        return $this->value;
    }
}
