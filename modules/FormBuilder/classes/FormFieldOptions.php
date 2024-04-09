<?php

namespace Modules\FormBuilder\Classes;

class FormFieldOptions
{
    private $dataset;
    public $label_key = 'label';
    public $value_key = 'value';

    public function __construct($dataset)
    {
        $this->dataset = $dataset;

        return $this;
    }

    public function labelKey($label_key)
    {
        $this->label_key = $label_key;
    }

    public function valueKey($value_key)
    {
        $this->value_key = $value_key;
    }

    public function getOptions()
    {
        $options = [];

        foreach($this->dataset as $data) {

            $options[] = new FormFieldOption($data[$this->value_key], $data[$this->label_key]);
            //foreach($datum as $data) {
              //  $options[] = new FormFieldOption($data[$this->value_key], $data[$this->label_key]);
            //}
        }

        return $options;
    }
}
