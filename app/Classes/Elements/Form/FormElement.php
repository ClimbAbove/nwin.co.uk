<?php

namespace App\Classes\Elements\Form;

use App\Classes\Elements\Abstracts\AbstractQuestionnaireElement;
use App\Classes\Elements\FormElementGroup\FormElementGroup;
use App\Classes\Elements\FormField\FormFieldElement;
use App\Http\Livewire\FormFieldComponent;
use Modules\FormBuilder\Classes\FormField;

class FormElement extends AbstractQuestionnaireElement
{
    public string $name = 'leadform';
    public $next_step_id = null;
    public array $fields = [];

    public $current_form_group_id = null;
    public $current_form_group_index = 0;
    public $current_form_group_name_stack = [];

    protected $rules = [];
    protected $rules_messages = [];


    public function __construct($bulk_assignments = [])
    {
        parent::__construct($bulk_assignments);
    }
    public function setFields(Array $fields)
    {
        $this->fields = $fields;
    }
    public function pushField(FormFieldElement|FormElementGroup|FormFieldComponent $field)
    {
        $this->fields[] = $field;
    }

    public function getFields()
    {
        return $this->fields;
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
        return $this->rules;
    }


    public function getRulesMessages()
    {
        return $this->rules_messages;
    }

    public function zanswer($field_id, $field_value)
    {
        foreach ($this->fields as $field) {
            if ($field->id === $field_id) {
                $field->answer($field_value);
            }
        }

        return $this;
    }

    public function getFieldById($field_id)
    {
        foreach(($this->fields ?? []) as $field) {

            if($field instanceof FormElementGroup) {
                foreach($field->fields as $form_group_field) {
                    if($form_group_field->name == $field_id) {
                        return $form_group_field;
                    }
                }
            }
            else {
                if($field->name == $field_id) {
                    return $field;
                }
            }



        }

        return null;
    }

    public function answer($field_id, $field_value = null)
    {
        // Load the answer object.
        $field = $this->getFieldById($field_id);

        if($field !== null) {
            $field->answer($field_value);
            $this->answered = true;

            return $this;
        }

        dd('Error: QuestionElement->answer() - no answer set.' . $field_id . '- '. $field_value);
    }

    public function getAnswer()
    {

        if($this instanceof FormElementGroup) {
            return null;
        }
        else {
            switch ($this->type) {
                case 'text':

                    foreach (($this->fields ?? []) as $field) {
                        if ($field->answered === true) {
                            return $field;
                        }
                    }

                    break;

                default:

                    foreach (($this->fields ?? []) as $field) {
                        if ($field->answered === true) {
                            return $field;
                        }
                    }

                    break;
            }
        }

        return null;
    }


    public function hasFormGroups()
    {
        foreach(($this->fields ?? []) as $field) {
            if($field instanceof FormElementGroup) {
                return true;
            }
        }
    }

    public function setCurrentFormGroupByID($form_group_id)
    {
        foreach(($this->fields ?? []) as $field_index => $field) {
            if($field instanceof FormElementGroup) {
                if($field->id == $form_group_id) {
                    $this->fields[$field_index]->is_current = true;
                    $this->current_form_group_id = $form_group_id;
                }
            }
        }

        dd('Errro1');

    }
}
