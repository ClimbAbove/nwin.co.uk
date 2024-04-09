<?php

namespace Modules\FormBuilder\Controllers;

use App\Http\Controllers\Abstracts\AbstractController;
use Modules\Asset\Classes\CSS;
use Modules\Asset\Classes\JS;

class FormBuilderController extends AbstractController
{
    public function loadJS($path)
    {
        $js = new JS();
        $js->setBasePath(base_path('modules/FormBuilder/public'));

        return $js->load($path);
    }

    public function loadCSS($path)
    {
        $css = new CSS();
        $css->setBasePath(base_path('modules/FormBuilder/public'));

        return $css->load($path);
    }
}

