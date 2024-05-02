<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Abstracts\AbstractController;;

use App\Repositories\Interfaces\ContentRepositoryInterface;
use App\Repositories\Interfaces\WindowQuoteRepositoryInterface;


class QuoteController extends AbstractController
{
    public function index(WindowQuoteRepositoryInterface $window_quote_repository, ContentRepositoryInterface $content_repository)
    {
        $data = [];
        $data['config']  = $content_repository->getConfig();
        $data['questionnaire_element'] = $window_quote_repository->getQuestionnaire();

        return $this->render('pages/quote' ,$data);

    }
}
