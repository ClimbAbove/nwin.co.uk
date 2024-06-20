<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Abstracts\AbstractController;;

use App\Repositories\Interfaces\ContentRepositoryInterface;
use App\Repositories\QuoteQuestionnaires\WindowQuoteRepository;

class ResultsQuoteController extends AbstractController
{
    public bool $opening_hours_logic = true;

    public function index(WindowQuoteRepository $window_quote_repository, ContentRepositoryInterface $content_repository)
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

        $session    = session()->get('data');
        $quote_type = session()->get('quote_type');

        $data['data']    = $session[0];
        $data['config']  = $content_repository->getConfig();
        $data['address'] = $content_repository->getAddress();

        if($this->opening_hours_logic === false) {
            $data['contact_mode'] = 'form';
            $data['telephone']['international'] = $data['config']['telephone']['international'];
            $data['telephone']['number']        = $data['config']['telephone']['number'];
        } else {
            $data['contact_mode']               = $data['config']['contact_mode'];
            $data['telephone']['international'] = $data['config']['telephone']['international'];
            $data['telephone']['number']        = $data['config']['telephone']['number'];
        }

        $data['tracking_send_to'] = null;

        switch($data['config']['tracking_product']) {
            case 'windows_and_doors':
                $data['tracking_send_to'] = 'AW-16506920005/qaNYCMnT17AZEMW4jr89';
            break;
            case 'conservatory':
                $data['tracking_send_to'] = 'AW-16506920005/8LA2CMzT17AZEMW4jr89';
            break;
        }


        $untidy_email = $data['email']['answer'] ;
        $untidy_email = strtolower($untidy_email);
        $untidy_email = $this->removeAccents($untidy_email);
        $untidy_email = preg_replace('/\s+/','', $untidy_email);
        list($email, $domain) = explode('@', $untidy_email);
        $untidy_email = preg_replace('/\./','', $email) . '@'. preg_replace('/\.$/','',$domain);
        $untidy_email = preg_replace('/\+([^\@]+)/','', $untidy_email);

        $data['tidy_email'] = $untidy_email;
        $data['tidy_phone'] = $data['telephone']['answer'];

        return $this->render('pages/results', $data);
    }
}
