<?php

namespace App\Http\Controllers\Pages;

use App\Forms\ContactForm;
use App\Http\Controllers\Abstracts\AbstractController;
use App\Mail\ContactUs;
use App\Repositories\Implementations\Nwin\ContentRepository;
use App\Repositories\Interfaces\ContentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends AbstractController
{
    public bool $opening_hours_logic = true;

    public function index(ContentRepositoryInterface $content_repository)
    {
        $data = [];

        if(session()->get('_ppc') !== null) {
            $ppc_dto = unserialize(session()->get('_ppc'));
            if($ppc_dto->isPPC) {
                if($ppc_dto->isBingPPC) {
                    $this->opening_hours_logic = false;
                }
            }
        }

        $form = new ContactForm();
        $data['form'] = $form->build();
        $data['config']  = $content_repository->getConfig();

        if($this->opening_hours_logic === false) {
            $data['contact_mode'] = 'form';
            $data['telephone']['international'] = $data['config']['telephone']['international'];
            $data['telephone']['number']        = $data['config']['telephone']['number'];
        } else {
            $data['contact_mode']               = $data['config']['contact_mode'];
            $data['telephone']['international'] = $data['config']['telephone']['international'];
            $data['telephone']['number']        = $data['config']['telephone']['number'];
        }

        $recipient = 'mailspringie@gmail.com';

        Mail::to($recipient)
            ->bcc([
            ])
            ->send(new ContactUs([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'telephone_number' => $request->input('telephone_number'),
            ]));

        $data['name'] = trim($request->input('name'));

        $untidy_email = $request->input('email');
        $untidy_email = strtolower($untidy_email);
        $untidy_email = $this->removeAccents($untidy_email);
        $untidy_email = preg_replace('/\s+/','', $untidy_email);
        list($email, $domain) = explode('@', $untidy_email);
        $untidy_email = preg_replace('/\./','', $email) . '@'. preg_replace('/\.$/','',$domain);
        $untidy_email = preg_replace('/\+([^\@]+)/','', $untidy_email);

        $data['tidy_email'] = $untidy_email;
        $data['tidy_phone'] = trim($request->input('telephone_number'));

        return $this->render('pages/contact_us', $data);
    }

    public function send(Request $request)
    {
        Mail::to('mailspringie@gmail.com')
            ->send(new ContactUs($request));
    }
}
