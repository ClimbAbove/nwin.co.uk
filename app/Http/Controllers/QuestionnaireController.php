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

        if($data['email']['answer'] == 'mailspringie@gmail.com') {

            $recipient = 'mailspringie@gmail.com';

            Mail::to($recipient)
                ->bcc([
                ])
                ->send(
                    new ContactUs([
                        'product_type'     => $data['product_type']['answer'],
                        'name'             => $data['name']['answer'],
                        'email'            => $data['email']['answer'],
                        'telephone_number' => $data['telephone']['answer'],
                        'postcode'         => $data['postcode']['answer'],
                    ])
                );

        } else {


            $recipient = 'info@ecotechconservatories.co.uk';

            Mail::to($recipient)
                ->bcc([
                    'accounts@climbabove.co.uk',
                    'mailspringie@gmail.com'
                ])
                ->send(
                    new ContactUs([
                        'product_type'     => $data['product_type']['answer'],
                        'name'             => $data['name']['answer'],
                        'email'            => $data['email']['answer'],
                        'telephone_number' => $data['telephone']['answer'],
                        'postcode'         => $data['postcode']['answer'],
                    ])
                );
        }
        //dd($questionnaire_element->getData());

    }

}
