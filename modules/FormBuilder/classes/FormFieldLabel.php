<?php

namespace Modules\FormBuilder\Classes;

class FormFieldLabel
{
    private $label;
    private $location;

    public function __construct($label, $location = 'before', $escape = true)
    {
        $this->label    = $label;
        $this->location = $location;
        $this->escape   = $escape;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
