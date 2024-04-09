<?php

namespace App\DTOs;

use App\DTOs\Abstracts\AbstractDTO;
use Illuminate\Support\Collection;

class FAQsDTO extends AbstractDTO
{
    protected $faqs;

    public function __construct()
    {
        $this->faqs = new Collection();
    }

    public function addFAQ(FAQDTO $faq_dto)
    {
       $this->faqs->add($faq_dto);

       return $this;

    }

    public function getFAQs(): Collection
    {
        return $this->faqs;
    }

}
