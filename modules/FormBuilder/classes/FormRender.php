<?php

namespace Modules\FormBuilder\Classes;

class FormRender
{
    public static function open($form)
    {
        return view( 'form/default/form_open', ['form' => $form]);
    }

    public static function close($form)
    {
        return view( 'form/default/form_close', ['form' => $form]);
    }
}
