<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Abstracts\AbstractController;;

use App\Repositories\Interfaces\ContentRepositoryInterface;
use App\Repositories\QuoteQuestionnaires\WindowQuoteRepository;

class ResultsQuoteController extends AbstractController
{
    public function index(WindowQuoteRepository $window_quote_repository, ContentRepositoryInterface $content_repository)
    {
        $data = [];

        $session    = session()->get('data');
        $quote_type = session()->get('quote_type');

        $data['data']    = $session[0];
        $data['config']  = $content_repository->getConfig();
        $data['address'] = $content_repository->getAddress();

        $data['contact_mode'] = $data['config']['contact_mode'];
        $data['telephone']['international'] = $data['config']['telephone']['international'];
        $data['telephone']['number'] = $data['config']['telephone']['number'];

        $data['tracking_send_to'] = null;

        switch($data['config']['tracking_product']) {
            case 'windows_and_doors':
                $data['tracking_send_to'] = 'AW-16506920005/qaNYCMnT17AZEMW4jr89';
            break;
            case 'conservatory':
                $data['tracking_send_to'] = 'AW-16506920005/8LA2CMzT17AZEMW4jr89';
            break;
        }

        return $this->render('pages/results', $data);
    }
}
