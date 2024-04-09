<?php

namespace App\Http\Livewire\Abstracts;

use Livewire\Component;

abstract class AbstractComponent extends Component
{
    public $questionnaire;
    public $_form_fields = [];
    public $_custom_validation_messages = [];

    /**
     * createFormFieldProperties
     *
     * @param  array  $form_field_names  - array of form field names that are elevated from the dynamically added forms.
     *
     * @return void
     */
    public function createFormFieldProperties(array $form_field_names)
    {
        foreach(array_filter($form_field_names) as $name) {
            $this->createFormFieldProperty($name);
        }
    }

    /**
     * createFormFieldProperty
     *
     * @param string  $name
     * @param $value
     *
     * @return void
     */
    public function createFormFieldProperty(string $name, $value = null)
    {
        $this->_form_fields[$name] = $value;
    }
}
