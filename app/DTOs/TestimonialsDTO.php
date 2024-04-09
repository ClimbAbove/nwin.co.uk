<?php

namespace App\DTOs;

use App\DTOs\Abstracts\AbstractDTO;
use Illuminate\Support\Collection;

class TestimonialsDTO extends AbstractDTO
{
    protected $testimonials;

    public function __construct()
    {
        $this->testimonials = new Collection();
    }

    public function addTestimonial(TestimonialDTO $testimonial_dto)
    {
        $this->testimonials->add($testimonial_dto);

        return $this;
    }

    public function getTestimonials(): Collection
    {
        return $this->testimonials;
    }

}
