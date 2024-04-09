<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Abstracts\AbstractController;
use App\Repositories\Content\Nwin\ContentRepository;
use App\Repositories\QuoteQuestionnaires\WindowQuoteRepository;

class HomepageController extends AbstractController
{
    public function index(WindowQuoteRepository $window_quote_repository, ContentRepository $content_respository)
    {
        $data = [];
        $data['faqs'] = $content_respository->getFAQs();

        $data['questionnaire_element'] = $window_quote_repository->getQuestionnaire();

        return $this->render('pages/homepage', $data);
    }
}
