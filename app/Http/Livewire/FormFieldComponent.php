<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormFieldComponent extends Component
{
    public $name;
    public $value;
    public $thisisacomponent;
    public function mount()
    {
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:3',
        ]);

    }

    public function render()
    {
        return view('livewire.form_field');
    }

}
