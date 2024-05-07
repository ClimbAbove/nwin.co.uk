<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Abstracts\AbstractController;


use App\Repositories\Interfaces\ContentRepositoryInterface;
use App\Repositories\Interfaces\WindowQuoteRepositoryInterface;
use Illuminate\Http\Request;

class HomepageController extends AbstractController
{
    public function index(Request $request, WindowQuoteRepositoryInterface $window_quote_repository, ContentRepositoryInterface $content_repository)
    {
        $domain = parse_url(request()->root())['host'];

        $data                          = [];
        $data['config']                = $content_repository->getConfig();
        $data['address']               = $content_repository->getAddress();

        $data['hero']                  = $content_repository->getHero();
        $data['masonry']               = $content_repository->getMasonry();
        $data['faqs']                  = $content_repository->getFAQs();
        $data['testimonials']          = $content_repository->getTestimonials();
        $data['questionnaire_element'] = $window_quote_repository->getQuestionnaire();

        return $this->render('pages/homepage', $data);
    }
}
