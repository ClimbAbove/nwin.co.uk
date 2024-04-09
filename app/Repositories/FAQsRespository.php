<?php

namespace App\Repositories;

use App\DTOs\FAQDTO;
use App\DTOs\FAQsDTO;
use App\Repositories\Abstracts\AbstractRepository;

class FAQsRespository extends AbstractRepository
{
    public function getFaqs()
    {

        $faqs = new FAQsDTO();

        $faq = new FAQDTO();
        $faq->question = 'Is there a minimum term?';
        $faq->answer = 'No, you can cancel at any time, we will not send you any further invoices or cancellation fee, should you wish to cancel.';
        $faqs->addFAQ($faq);

        $faq = new FAQDTO();
        $faq->question = 'What makes ClimbAbove different from an agency?';
        $faq->answer = 'We specialize in 1 service, lead generation. It\'s what we do, and do this well. While other agencies will try and sell you other services, we drive results to your bottom line. By providing a lead generation service, different to others.';
        $faqs->addFAQ($faq);

        $faq = new FAQDTO();
        $faq->question = 'What do ClimbAbove charge?';
        $faq->answer = 'There is no set up cost (unless you need something bespoke!), no monthly management fee or no charges depending on the spend. You pay us on results. We only charge for conversion from traffic to leads (CPL). We have a shared interest to generate you as many high quality leads for your agreed spend.';
        $faqs->addFAQ($faq);

        $faq = new FAQDTO();
        $faq->question = 'Is there a minimum amount of leads I need to take per day or week';
        $faq->answer = 'No, It\'s a pay as you go service. You can start and stop when and if you need to. We find we become an important arm to our clients business and we are growing with them rather than pausing. Our model is based on order of 200 leads.';
        $faqs->addFAQ($faq);

        $faq = new FAQDTO();
        $faq->question = 'Do I need to use your landing pages?';
        $faq->answer = 'In most cases yes. Our landing pages are designed to capture leads and drive page conversion, your website might be more information based. Our landing pages will be custom to your colours, so it will look and feel as if someone was on your site!';
        $faqs->addFAQ($faq);

        return $faqs;
    }
}






