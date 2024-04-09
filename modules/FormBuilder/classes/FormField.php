<?php
/**
 * FormField
 *
 * Form Builer Form Field Class
 */
namespace Modules\FormBuilder\Classes;

use Modules\FormBuilder\Traits\CommonAttributesTrait;

class FormField
{
    use CommonAttributesTrait;

    public $parent_form;

    public $name;
    public $id;
    public $type;
    public $value;
    public $selected_value;
    public $selected_index;
    public $label;
    public $placeholder;
    public $name_singular;
    public $name_arrayed;
    public $options;
    public $validation_rules;

    /**
     * __construct
     *
     * @param  Form  $parent_form
     *
     * @return none
     */
    public function __construct(Form $parent_form = null)
    {
        // Copy the form info to the field (for a bit).
        if($parent_form !== null) {
            $this->parent_form = $parent_form;
            if(method_exists($this->parent_form, 'setValidation')) {
                $this->parent_form->setValidation();
            }
        }
    }

    /**
     * __call
     *
     * magic method that handles calls to input type; e.g. text, checkbox, select ....
     *
     * @param string    $type
     * @param array     $params
     *
     * @return $this
     */
    public function __call(string $type, array $params)
    {
        $name = array_shift($params);
        $this->name_singular = $name;

        // Check if name is an array ... if so split into 2.
        if(preg_match('/([^\[]+)([^\]]+)\]/', $name, $matches)) {
            $this->name_arrayed = $name;
            $this->name_singular = $matches[1];
        }

        $this->id = $this->name_singular;

        if(($this->parent_form ?? null) !== null) {
            if((($rule = $this->parent_form->getRule($this->name_singular) ?? null) !== null)) {
                $this->validation_rules = $rule;
            }
            unset($this->parent_form);
        }



        switch($type)
        {
            case 'select':
            case 'checkbox':
            case 'radio':
                $this->multiInput($type, $name);
            break;
            default:
                $this->input($type, $name);
            break;
        }

        if(!in_array($type, ['button','submit'])) {
            $this->class(['input', 'input_' . $type, 'input_' . $this->name_singular]);
        }

        if($this->validation_rules !== null) {

            if($rule = $this->validation_rules) {

                // Copy validation rules to field.
                $this->validation_rules = $rule;

                if($rule->required) {
                    $this->attr('required');

                    if($rule->errors['required'] ?? false) {
                        $this->data('pristine-required-message', $rule->errors['required']);
                    }
                }

                if($rule->min) {
                    $this->attr('minlength', $rule->min);

                    if($rule->errors['min'] ?? false) {
                        $this->data('pristine-minlength-message', $rule->errors['min']);
                    }
                }

                if($rule->max) {
                    $this->attr('maxlength', $rule->max);

                    if($rule->errors['max'] ?? false) {
                        $this->data('pristine-maxlength-message', $rule->errors['max']);
                    }
                }

                if($rule->gte) {
                    $this->attr('min', $rule->gte);

                    if($rule->errors['gte'] ?? false) {
                        $this->data('pristine-min-message', $rule->errors['gte']);
                    }
                }
                elseif($rule->gt) {
                    $this->attr('min', $rule->gt + 1);

                    if($rule->errors['gt'] ?? false) {
                        $this->data('pristine-min-message', $rule->errors['gt']);
                    }
                }

                if($rule->lte) {
                    $this->attr('max', $rule->lte);

                    if($rule->errors['lte'] ?? false) {
                        $this->data('pristine-max-message', $rule->errors['lte']);
                    }
                }
                elseif($rule->lt) {
                    $this->attr('max', $rule->lt - 1);

                    if($rule->errors['lt'] ?? false) {
                        $this->data('pristine-max-message', $rule->errors['lt']);
                    }
                }

                if($rule->int) {
                    $this->data('pristine-type', 'integer');

                    if($rule->errors['int'] ?? false) {
                        $this->data('pristine-type-message', $rule->errors['int']);
                    }
                }

                if($rule->numeric) {
                    $this->data('pristine-type', 'number');

                    if($rule->errors['number'] ?? false) {
                        $this->data('pristine-type-message', $rule->errors['number']);
                    }
                }

                if($rule->between) {
                    $this->attr('min', $rule->between[0]);
                    $this->attr('max', $rule->between[1]);

                    if($rule->errors['required'] ?? false) {
                        $this->data('pristine-min-message', $rule->errors['between']);
                        $this->data('pristine-max-message', $rule->errors['between']);
                    }
                }

                if($rule->in) {
                    $ins = array_map(function($in) {
                        return addslashes($in);
                    }, $rule->in);

                    $this->data('pristine-pattern', '/^(' . implode($ins) . ')$/');

                    if($rule->errors['in'] ?? false) {
                        $this->data('pristine-pattern-message', $rule->errors['in']);
                    }
                }

                if($rule->not_in) {
                    $not_ins = array_map(function($not_in) {
                        return addslashes($not_in);
                    }, $rule->not_in);

                    $this->data('pristine-pattern', '/^(^(' . implode($not_ins) . '))$/');

                    if($rule->errors['not_in'] ?? false) {
                        $this->data('pristine-pattern-message', $rule->errors['not_in']);
                    }
                }

                if($rule->same) {
                    $this->data('pristine-equals', $rule->same);

                    if($rule->errors['required'] ?? false) {
                        $this->data('pristine-equals-message', $rule->errors['same']);
                    }
                }

                if($rule->regex) {
                    $this->data('pristine-pattern', addslashes($rule->regex));

                    if($rule->errors['regex'] ?? false) {
                        $this->data('pristine-pattern-message', $rule->errors['regex']);
                    }
                }
            }

        }

        return $this;
    }

    /**
     * input
     *
     * method for standard 'singlular' inputs.
     *
     * @param string    $type
     * @param string    $name
     *
     * @return $this
     */
    private function input(string $type, string $name)
    {
        $this->type = $type;
        $this->name = $name;

        return $this;
    }

    /**
     * multiInput
     *
     * method for 'multiple' inputs.
     *
     * @param string    $type
     * @param string    $name
     *
     * @return $this
     */
    private function multiInput($type, $name)
    {
        $this->type = $type;
        $this->name = $name;

        return $this;
    }

    /**
     * value
     *
     * set value
     *
     * @param  $value
     *
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * selectedValue
     *
     * set a selected svalue
     *
     * @param  $value
     *
     * @return $this
     */
    public function selectedValue($value)
    {
        $this->selected_value = $value;

        return $this;
    }


    /**
     * selectedIndex
     *
     * set a selected idnex
     *
     * @param  $index
     *
     * @return $this
     */
    public function selectedIndex($index)
    {
        $this->selected_index = $index;

        return $this;
    }


    /**
     * label
     *
     * set label
     *
     * @param string $label
     * @param string $location - before | after : placement of label
     *
     * @return $this
     */
    public function label(string $label, $location = 'before', $escape = true)
    {
        $this->label = new FormFieldLabel($label, $location, $escape);

        return $this;
    }

    /**
     * placeholder
     *
     * set the fields placeholder (if applicable)
     *
     * @param string $placeholder
     *
     * @return $this
     */
    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * readonly
     *
     * set a field as readonly
     *
     * @param  bool  $value
     *
     * @return $this
     */
    public function readonly(bool $value = true)
    {
        if ($value === true) {
            $this->attr('readonly', $this->stroolean($value));
        }

        return $this;
    }

    /**
     * disabled
     *
     * set a field as disabled
     *
     * @param $value
     *
     * @return $this
     */
    public function disabled(bool $value = true)
    {
        $this->attr('disabled', $this->stroolean($value));

        return $this;
    }

    /**
     * options
     *
     * set the field's options. Only (should be) used my multi field types.
     *
     * @param FormFieldOptions $options
     *
     * @return $this
     */
    public function options(FormFieldOptions $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * multiple
     *
     * sets selectbox as multiple
     *
     * @param bool $value
     *
     * @return $this
     */
    public function multiple(bool $value = true)
    {
        if ($this->type == 'select' && $value === true) {
            $this->attr('multiple', $this->stroolean($value));
        }

        return $this;
    }

    /**
     * render
     *
     * helper for easier syntax in templates
     *
     * @param string $template - path to template
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(string $template = null)
    {
        return FormFieldRender::render($this, $template);
    }

}
