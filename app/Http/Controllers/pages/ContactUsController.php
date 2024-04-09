<?php

namespace App\Http\Controllers\Pages;

use App\Forms\ContactForm;
use App\Http\Controllers\Abstracts\AbstractController;
use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends AbstractController
{
    public function index()
    {
        $data = [];

        $form = new ContactForm();
        $data['form'] = $form->build();

        return $this->render('pages/contact_us', $data);
    }

    public function send(Request $request)
    {
        Mail::to('mailspringie@gmail.com')
            ->send(new ContactUs($request));
    }
}
