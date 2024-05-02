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

        $session = session()->get('data');

        $data['data'] = $session[0];
        $data['config']  = $content_repository->getConfig();
        return $this->render('pages/results', $data);
    }
}
