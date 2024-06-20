<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Abstracts\AbstractController;


use App\Repositories\Interfaces\ContentRepositoryInterface;
use App\Repositories\Interfaces\WindowQuoteRepositoryInterface;
use Illuminate\Http\Request;

class HomepageController extends AbstractController
{
    public bool $opening_hours_logic = true;

    public function index(Request $request, WindowQuoteRepositoryInterface $window_quote_repository, ContentRepositoryInterface $content_repository)
    {
        $domain = parse_url(request()->root())['host'];

        $data                          = [];

        if(session()->get('_ppc') !== null) {
            $ppc_dto = unserialize(session()->get('_ppc'));
            if($ppc_dto->isPPC) {
                if($ppc_dto->isBingPPC) {
                    $this->opening_hours_logic = false;
                }
            }
        }

        $data['config']                = $content_repository->getConfig();
        $data['address']               = $content_repository->getAddress();

        $data['hero']                  = $content_repository->getHero();
        $data['masonry']               = $content_repository->getMasonry();
        $data['faqs']                  = $content_repository->getFAQs();
        $data['testimonials']          = $content_repository->getTestimonials();
        $data['questionnaire_element'] = $window_quote_repository->getQuestionnaire();

        if($this->opening_hours_logic === false) {
            $data['contact_mode'] = 'form';
            $data['telephone']['international'] = $data['config']['telephone']['international'];
            $data['telephone']['number']        = $data['config']['telephone']['number'];

        } else {
            $data['contact_mode']               = $data['config']['contact_mode'];
            $data['telephone']['international'] = $data['config']['telephone']['international'];
            $data['telephone']['number']        = $data['config']['telephone']['number'];
        }
     //   return $this->render('pages/round/index', $data);
        return $this->render('pages/homepage', $data);
    }

    public function alt()
    {

    }
}
