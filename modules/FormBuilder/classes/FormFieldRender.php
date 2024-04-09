<?php

namespace Modules\FormBuilder\Classes;

class FormFieldRender
{
    public static function render($form_field, $template = null)
    {

        if($template !== null) {
            return view( $template, ['form_field' => $form_field]);
        }

        switch($form_field->type) {
            case 'button':
                return view( 'form/default/button', ['form_field' => $form_field]);
            break;
            case 'select':
                return view( 'form/default/select', ['form_field' => $form_field]);
            break;
            case 'radio':
                return view( 'form/default/radio', ['form_field' => $form_field]);
            break;
            case 'checkbox':
                return view( 'form/default/checkbox', ['form_field' => $form_field]);
            break;
            case 'password':
                return view( 'form/default/password', ['form_field' => $form_field]);
            break;
            case 'textarea':
                return view( 'form/default/textarea', ['form_field' => $form_field]);
            break;
            default:
                if($form_field === null) {
                    return;
                }

                return view( 'form/default/input', ['form_field' => $form_field]);
            break;
        }
    }

}
