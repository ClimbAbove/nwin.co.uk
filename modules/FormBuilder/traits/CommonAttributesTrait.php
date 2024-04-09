<?php

namespace Modules\FormBuilder\Traits;

trait CommonAttributesTrait
{
    private $classes;

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    public function id($id)
    {
        $this->id = $id;

        return $this;
    }

    public function class($class)
    {
        if(!is_array($class)) {
            $class = explode(' ', $class);
        }

        $this->classes = array_unique(array_merge(($this->classes ?? []), $class));

        return $this;
    }

    public function getClassList()
    {
        return implode(' ', $this->classes ?? []);
    }


    public function data($data_tags, $data_value = null)
    {

        $data_tags = $this->forceToArray($data_tags, $data_value);

        $parsed_data_tags = [];

        foreach($data_tags as $data_key => $data_value) {
            $parsed_data_tags['data-' . preg_replace('/^data-/', '', $data_key)] = ($data_value ?? null);
        }

        $this->data = array_filter(array_unique(array_merge(($this->data ?? []), $parsed_data_tags))) ?? null;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }


    public function attr($attributes, $attribute_value = null)
    {
        $attributes = (array_unique(array_merge(($this->attributes ?? []), $this->forceToArray($attributes, $attribute_value))));

        $this->attributes = count($attributes) ? $attributes : null;

        return $this;
    }

    public function removeAttr($name)
    {
        if($this->attributes[$name] ?? false) {
            unset($this->attributes[$name]);
        }

        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes ?? [];
    }

    public function getAttribute($name)
    {
        return $this->attributes['name'] ?? false;
    }


    private function forceToArray($var_or_array, $default_value = null)
    {
        if(is_array($var_or_array)) {
            return array_filter($var_or_array);
        }

        return ([$var_or_array => $default_value]);
    }

    private function stroolean($value)
    {
        if($value === true) {
            return 'true';
        }
        elseif($value === false) {
            return 'false';
        }
        else {
            return $value;
        }
    }


}
