<?php

namespace Modules\FormBuilder\Classes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FormValidator
{
    private $form;
    private $errors;

    public function __construct($form)
    {
        $this->form = $form;
    }

    public function validate(Request $request)
    {
        // Call the setValidation method
        if(method_exists($this->form, 'setValidation') === false) {
            return true;
        }

        $this->form->setValidation();

        $form_rules    = $this->form->getValidationRules();

        $laravel_custom_messages = [];
        $laravel_rule = [];

        foreach($form_rules as $field_name => $rule) {

            if($rule->required ?? false) {
                $laravel_rule[$field_name] = 'required';
                $custom_messages[$field_name . '.required'] = $rule->errors['required'] ?? null;
            }

            if($rule->min ?? false) {
                $laravel_rule[$field_name] = 'min:' . $rule->min;
                $custom_messages[$field_name . '.min'] = $rule->errors['min'] ?? null;
            }

            if($rule->max ?? false) {
                $laravel_rule[$field_name] = 'max:' . $rule->max;
                $custom_messages[$field_name . '.max'] = $rule->errors['max'] ?? null;
            }

            if($rule->lte ?? false) {
                $laravel_rule[$field_name] = 'lte:' . $rule->lte;
                $custom_messages[$field_name . '.lte'] = $rule->errors['lte'] ?? null;
            }
            elseif($rule->lt ?? false) {
                $laravel_rule[$field_name] = 'lt:' . $rule->le;
                $custom_messages[$field_name . '.lt'] = $rule->errors['lt'] ?? null;
            }

            if($rule->gte ?? false) {
                $laravel_rule[$field_name] = 'gte:' . $rule->lte;
                $custom_messages[$field_name . '.gte'] = $rule->errors['gte'] ?? null;
            }
            elseif($rule->gt ?? false) {
                $laravel_rule[$field_name] = 'gt:' . $rule->le;
                $custom_messages[$field_name . '.gt'] = $rule->errors['gt'] ?? null;
            }

            if($rule->int ?? false) {
                $laravel_rule[$field_name] = 'integer';
                $custom_messages[$field_name . '.int'] = $rule->errors['int'] ?? null;
            }

            if($rule->numeric ?? false) {
                $laravel_rule[$field_name] = 'numeric';
                $custom_messages[$field_name . '.numeric'] = $rule->errors['numeric'] ?? null;
            }

            if($rule->between ?? false) {
                $laravel_rule[$field_name] = 'between:' . implode(',', $rule->between);
                $custom_messages[$field_name . '.between'] = $rule->errors['between'] ?? null;
            }

            if($rule->in ?? false) {
                $laravel_rule[$field_name] = 'in:' . implode(',', $rule->in);
                $custom_messages[$field_name . '.in'] = $rule->errors['in'] ?? null;
            }

            if($rule->not_in ?? false) {
                $laravel_rule[$field_name] = 'not-in:' . implode(',', $rule->not_in);
                $custom_messages[$field_name . '.not-in'] = $rule->errors['not_in'] ?? null;
            }

            if($rule->same ?? false) {
                $laravel_rule[$field_name] = 'same:' . $rule->same;
                $custom_messages[$field_name . '.same'] = $rule->errors['same'] ?? null;
            }

            if($rule->mimes ?? false) {
                $laravel_rule[$field_name] = 'mimes:' . implode(',', $rule->mimes);
                $custom_messages[$field_name . '.mimes'] = $rule->errors['mimes'] ?? null;
            }

            // Always leave after the implode, as regexs with a pipe need to be added in array syntax.
            if($rule->regex ?? false) {
                $laravel_rule[$field_name] = 'regex:' . $rule->regex;
                $custom_messages[$field_name . '.regex'] = $rule->errors['regex'] ?? null;
            }

        }

        $validator = Validator::make($request->all(), $laravel_rule, $laravel_custom_messages);

        $validator->validate();

        $this->form->clearSessionFormFieldValues();

        $this->errors = $validator->errors();

        return $this;
    }

    public function isValid()
    {
        return ($this->errors === null);
    }

    public function isInvalid()
    {
        return ($this->errors !== null);
    }

    public function getErrors($field_name = null)
    {
        if($field_name !== null) {
            return $this->errors->get($field_name) ?? null;
        }

        return $this->errors;
    }


}
