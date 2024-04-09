<?php

namespace App\Forms;

use Modules\FormBuilder\Classes\Form;

class ContactForm extends Form
{
    public function build()
    {
        $this->input('name')->label('Name');
        $this->input('email')->label('Email');
        $this->input('telephone_number')->label('Telephone Number');
        $this->hidden('liame');
        $this->textarea('message')->label('Message');
        $this->button('send')->value('Send Message')->class('primary');

        return $this;
    }

    public function setValidation()
    {
        $this->setRule('name')->required('Please tell us your name');
        $this->setRule('email')->required('Please provide your email address');
        $this->setRule('message')->required('Please enter a message');
    }
}
