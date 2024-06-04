<?php

namespace App\Http\Controllers;

use App\Classes\Elements\Questionnaire\QuestionnaireElement;
use App\Http\Controllers\Abstracts\AbstractController;
use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuestionnaireController extends AbstractController
{

    public function save(QuestionnaireElement $questionnaire_element)
    {
        session()->push('quote_type', 'default');
        session()->push('data', $questionnaire_element->getData());
    }

    public function saveConservatoryQuote(QuestionnaireElement $questionnaire_element)
    {
        session()->push('quote_type', 'conservatory');
        session()->push('data', $questionnaire_element->getData());

        $data = $questionnaire_element->getData();
          $recipient = 'hello@climbabove.co.uk';
        // $recipient = 'mailspringie@gmail.com';
        //$recipient = 'info@southerndrainageandwater.co.uk';

        Mail::to($recipient)
            ->bcc([
                'mailspringie@gmail.com'
            ])
            ->send(new ContactUs([
                'product_type' => $data['product_type']['answer'],
                'name' => $data['name']['answer'],
                'email' =>$data['email']['answer'],
                'telephone_number' => $data['telephone']['answer'],
                'postcode' => $data['postcode']['answer'],
            ]));


        //dd($questionnaire_element->getData());

    }

}
