<?php

namespace App\Http\Controllers;

use App\Classes\Elements\Questionnaire\QuestionnaireElement;
use App\Http\Controllers\Abstracts\AbstractController;
use App\Mail\ContactUs;
use App\Repositories\Interfaces\ContentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuestionnaireController extends AbstractController
{
    public $opening_hours_logic = true;

    public function save(QuestionnaireElement $questionnaire_element)
    {

        session()->forget('quote_type');
        session()->forget('data');
        session()->push('quote_type', 'default');
        session()->push('data', $questionnaire_element->getData());

        $data = $questionnaire_element->getData();
        $gclid = null;
        $msclkid = null;

        if(session()->get('_ppc') !== null) {
            $ppc_dto = unserialize(session()->get('_ppc'));
            if($ppc_dto->isPPC) {
                if($ppc_dto->isBingPPC) {
                    $this->opening_hours_logic = false;
                    $msclkid = ($ppc_dto->msclkid ?? null);
                }
                if($ppc_dto->isGooglePPC) {
                    $gclid = ($ppc_dto->gclid ?? null);
                }
            }
        }


        if(in_array($data['email']['answer'],['mailspringie@gmail.com','test@test.com'])) {

            if($data['email']['answer'] == 'mailspringie@gmail.com') {
                $recipient = 'mailspringie@gmail.com';
            } else {
                $recipient = 'hello@climbabove.co.uk';
            }

            Mail::to($recipient)
                ->bcc([
                ])
                ->send(
                    new ContactUs([
                        'product_type'     => $data['product_type']['answer'],
                        'name'             => $data['name']['answer'],
                        'email'            => $data['email']['answer'],
                        'telephone_number' => $data['telephone']['answer'],
                        'postcode'         => '',
                        'gclid'            => $gclid,
                        'msclkid'          => $msclkid,
                    ])
                );

        } else {

            $content_repository = app()->make(ContentRepositoryInterface::class);
            $data['config']  = $content_repository->getConfig();

            $recipient = $data['config']['company_email'];

            Mail::to($recipient)
                ->bcc([
                    'hello@climbabove.co.uk',
                    'mailspringie@gmail.com'
                ])
                ->send(
                    new ContactUs([
                        'product_type'     => $data['product_type']['answer'],
                        'name'             => $data['name']['answer'],
                        'email'            => $data['email']['answer'],
                        'telephone_number' => $data['telephone']['answer'],
                        'postcode'         => '',
                        'gclid'            => $gclid,
                        'msclkid'          => $msclkid,
                    ])
                );
        }


    }

    public function saveConservatoryQuote(QuestionnaireElement $questionnaire_element)
    {

        session()->push('quote_type', 'conservatory');
        session()->push('data', $questionnaire_element->getData());

        $data = $questionnaire_element->getData();
        $gclid = null;
        $msclkid = null;
        $qs = [];

        if(session()->get('_ppc') !== null) {
            $ppc_dto = unserialize(session()->get('_ppc'));
            if($ppc_dto->isPPC) {
                if($ppc_dto->isBingPPC) {
                    $this->opening_hours_logic = false;
                    $msclkid = ($ppc_dto->msclkid ?? null);
                }
                if($ppc_dto->isGooglePPC) {
                    $gclid = ($ppc_dto->gclid ?? null);
                }
                $qs = $ppc_dto->queryString;
            }
        }


        if(in_array($data['email']['answer'],['mailspringie@gmail.com','test@test.com'])) {

            if($data['email']['answer'] == 'mailspringie@gmail.com') {
                $recipient = 'mailspringie@gmail.com';
            } else {
                $recipient = 'hello@climbabove.co.uk';
            }

            Mail::to($recipient)
                ->bcc([
                ])
                ->send(
                    new ContactUs([
                        'product_type'     => $data['product_type']['answer'],
                        'name'             => $data['name']['answer'],
                        'email'            => $data['email']['answer'],
                        'telephone_number' => $data['telephone']['answer'],
                        'postcode'         => '',
                        'gclid'            => $gclid,
                        'msclkid'          => $msclkid,
                        'qs'               => ($qs !== null ? http_build_query($qs) : '')
                    ])
                );

        } else {

            $content_repository = app()->make(ContentRepositoryInterface::class);
            $data['config']  = $content_repository->getConfig();

            $recipient =  $data['config']['company_email'];

            Mail::to($recipient)
                ->bcc([
                    'hello@climbabove.co.uk',
                    'mailspringie@gmail.com'
                ])
                ->send(
                    new ContactUs([
                        'product_type'     => $data['product_type']['answer'],
                        'name'             => $data['name']['answer'],
                        'email'            => $data['email']['answer'],
                        'telephone_number' => $data['telephone']['answer'],
                        'postcode'         => '',
                        'gclid'            => $gclid,
                        'msclkid'          => $msclkid,
                    ])
                );
        }
        //dd($questionnaire_element->getData());

    }

}
