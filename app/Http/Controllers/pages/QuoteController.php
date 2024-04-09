<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Abstracts\AbstractController;;
use App\Repositories\QuoteQuestionnaires\WindowQuoteRepository;

class QuoteController extends AbstractController
{
    public function index(WindowQuoteRepository $window_quote_repository)
    {
        $data = [];

        $data['questionnaire_element'] = $window_quote_repository->getQuestionnaire();

        return $this->render('pages/quote' ,$data);

    }
}
