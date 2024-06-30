<?php

namespace App\Forms;

use Modules\FormBuilder\Classes\Form;

class InlineForm extends Form
{
    public function build()
    {
        $this->input('name')->label('Name');
        $this->input('telephone_number')->label('Telephone Number');
        $this->input('email')->label('Email');
        $this->hidden('liame');
        $this->button('send')->value('Send')->class('primary');

        return $this;
    }

    public function setValidation()
    {
        $this->setRule('name')->required('Please tell us your name');
        $this->setRule('telephone_number')->required('Please tell us your telephone number');
        $this->setRule('email')->required('Please provide your email address');
    }
}
