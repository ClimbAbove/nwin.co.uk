<?php

namespace App\Http\Controllers;

use App\Classes\Elements\Questionnaire\QuestionnaireElement;
use App\Http\Controllers\Abstracts\AbstractController;
use Illuminate\Http\Request;

class QuestionnaireController extends AbstractController
{

    public function save(QuestionnaireElement $questionnaire_element)
    {
        session()->push('data', $questionnaire_element->getData());
    }

}
