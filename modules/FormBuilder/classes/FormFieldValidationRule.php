<?php

namespace Modules\FormBuilder\Classes;

class FormFieldValidationRule
{
    public $field_name;
    public $required = false;
    public $mimes    = null;
    public $min      = null;
    public $max      = null;
    public $gte      = null;
    public $gt       = null;
    public $lte      = null;
    public $lt       = null;
    public $int      = null;
    public $numeric  = null;
    public $between  = null;
    public $in       = null;
    public $not_in   = null;
    public $same     = null;
    public $regex    = null;

    public $errors   = null;

    public function __construct($field_name)
    {
        $this->field_name = $field_name;

        return $this;
    }

    public function required($error = null)
    {
        $this->required = true;

        if($error !== null) {
            $this->errors['required'] = $error;
        }

        return $this;
    }

    // ['pdf','doc','txt]
    public function mimes(array $mimes, $error = null)
    {
        $this->mimes = $mimes;

        if($error !== null) {
            $this->errors['mimes'] = $error;
        }

        return $this;
    }

    public function min($min, $error = null)
    {
        $this->min = $min;

        if($error !== null) {
            $this->errors['min'] = $error;
        }

        return $this;
    }

    public function max($max, $error = null)
    {
        $this->max = $max;

        if($error !== null) {
            $this->errors['max'] = $error;
        }

        return $this;
    }

    public function lte($value, $error = null)
    {
        $this->lte = $value;

        if($error !== null) {
            $this->errors['lte'] = $error;
        }

        return $this;
    }

    public function lt($value, $error = null)
    {
        $this->lt = $value;

        if($error !== null) {
            $this->errors['lt'] = $error;
        }

        return $this;
    }

    public function gte($value, $error = null)
    {
        $this->gte = $value;

        if($error !== null) {
            $this->errors['gte'] = $error;
        }

        return $this;
    }

    public function gt($value, $error = null)
    {
        $this->gt = $value;

        if($error !== null) {
            $this->errors['gt'] = $error;
        }

        return $this;
    }

    public function int($error = null)
    {
        $this->int = true;

        if($error !== null) {
            $this->errors['int'] = $error;
        }

        return $this;
    }

    public function numeric($error = null)
    {
        $this->numeric = true;

        if($error !== null) {
            $this->errors['numeric'] = $error;
        }

        return $this;
    }

    public function between($floor, $ceiling, $error)
    {
        $this->between = [$floor, $ceiling];

        if($error !== null) {
            $this->errors['between'] = $error;
        }

        return $this;
    }

    public function in($in, $error = null)
    {
        $this->in = $in;

        if($error !== null) {
            $this->errors['in'] = $error;
        }

        return $this;
    }

    public function notIn($not_in, $error = null)
    {
        $this->not_in = $not_in;

        if($error !== null) {
            $this->errors['not_in'] = $error;
        }

        return $this;
    }

    public function same($field_name, $error = null)
    {
        $this->same = $field_name;

        if($error !== null) {
            $this->errors['gt'] = $error;
        }

        return $this;
    }

    public function regex($regex, $error = null)
    {
        $this->regex = $regex;

        if($error !== null) {
            $this->errors['regex'] = $error;
        }

        return $this;
    }
}
