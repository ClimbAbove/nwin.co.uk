<?php
namespace App\Repositories;


use App\Repositories\Abstracts\AbstractRepository;
use App\DTOs\TestimonialsDTO;
use App\DTOs\TestimonialDTO;

class TestimonialsRepository extends AbstractRepository
{
    public function getTestimonials()
    {
        $testimonials_dto = new TestimonialsDTO();

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->caption = "We have been looking for a lead generation company for a while, we tried a few but they never worked out. After the first meeting I had with their team, I knew these guys knew their stuff. We have been able to scale our business from being local to regional and hoping to take this operation nationwide. Our CPA is the lowest it's ever been, which is driving profits for us, even while growing and investing back into the Business";
        $testimonial_dto->author = "SW Drains";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->caption = "Climb Above have given us great and honest advice for our PPC Adverts, what we do is quite nechie their team has been able to generate high quality leads for people looking to sell their homes or land. The Volume has been low, but so has the CPA, We. have secured some very lucrative property acquisitions through our Google and BING adverts. We look forward to growing with them for many years to come. Thank you!";
        $testimonial_dto->author = "SWE HOMES";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->caption = "I was recommended to Climb above and it was a great investment to start what they call a partnership! Before talking with them I knew nothing about PPC and still don't! They explained everything in a simple way, no Jargon, no contracts or commitments each day in how many leads I take. We have increased our revenue by the various house extensions and building projects we have won!";
        $testimonial_dto->author = "BARTS Building contractors";
        $testimonials_dto->addTestimonial($testimonial_dto);

        return $testimonials_dto;

    }
}
