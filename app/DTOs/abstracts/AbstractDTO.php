<?php

namespace App\DTOs\Abstracts;

use Illuminate\Support\Str;

abstract class AbstractDTO
{
    public function __construct($bulk_assignments = [])
    {
        foreach($bulk_assignments as $key => $value) {
            $this->__set($key, $value);
        }

        return $this;
    }

    public function __set($property, $value)
    {
        $fqns_class = get_called_class();
        $method = 'set' . Str::studly($property);

        if(method_exists($fqns_class, $method))
        {
            $this->$method($value);

            return $this;
        }
    }

    public function __get($property)
    {
        $fqns_class = get_called_class();
        $method = 'get' . Str::studly($property);

        if(method_exists($fqns_class, $method))
        {
            return $this->$method();
        }
    }
}
