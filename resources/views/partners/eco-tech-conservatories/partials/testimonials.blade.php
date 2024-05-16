<a id="testimonials"></a>
<script src="/js/glide.js"></script>
<div class="slant top">
</div>
<section class="testimonials">
    <div class="testimonials_glide">
        <h2 class="text-center">What Our Clients Are Saying</h2>
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                @foreach($testimonials->getTestimonials() as $index => $testimonial_dto)
                    <li class="glide__slide">
                        <div class="testimonial_card">
                            <div class="flare">
                                <div class="circle">
                                    <div class="flare_{{$index}}"></div>
                                </div>
                            </div>
                            @if(($testimonial_dto->title ?? null) !== null)
                            <div class="title">{{$testimonial_dto->title}}</div>
                            @endif
                            <div class="testimonial">
                                <p>{{ $testimonial_dto->caption }}</p>
                            </div>
                            <div class="star_container">
                                <div class="starbox">
                                    <img src="/images/star_gold.svg">
                                </div>
                                <div class="starbox">
                                    <img src="/images/star_gold.svg">
                                </div>
                                <div class="starbox">
                                    <img src="/images/star_gold.svg">
                                </div>
                                <div class="starbox">
                                    <img src="/images/star_gold.svg">
                                </div>
                                <div class="starbox">
                                    <img src="/images/star_gold.svg">
                                </div>
                            </div>
                            <p class="author">
                                {{$testimonial_dto->author}}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
<div class="slant bottom">
</div>
{!! $page->addCSS('<link rel="stylesheet" href="/assets/css/partials/testimonials.min.css">','bottom') !!}
{!! $page->addJS('<script src="/assets/js/partials/testimonials.min.js"></script>','bottom') !!}
