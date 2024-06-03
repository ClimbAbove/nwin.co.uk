<a id="testimonials"></a>
<script src="/js/glide.js"></script>

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
                                <p class="preview">
                                    @if(strlen($testimonial_dto->caption) > 300)
                                        {{ substr($testimonial_dto->caption, 0, 300) }}&hellip;
                                        <a class="review_read_more">Read More</a>
                                    @else
                                        {{ $testimonial_dto->caption }}
                                    @endif

                                </p>
                                <div class="full display_none">
                                    <p>
                                        {{ $testimonial_dto->caption }}
                                        <a class="review_close_read_more">Close</a>
                                    </p>
                                </div>

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

{!! $page->addCSS('<link rel="stylesheet" href="/assets/css/partials/testimonials.min.css">','bottom') !!}
{!! $page->addJS('<script src="/assets/js/partials/testimonials.min.js"></script>','bottom') !!}
<script>
    let rrms = document.getElementsByClassName('review_read_more');
    let rcrms = document.getElementsByClassName('review_close_read_more');


    for(let i = 0; i < rrms.length; i++) {
        rrms[i].addEventListener('click', function(e) {
            e.preventDefault();
            let preview = this.parentNode;
            let full    = this.parentNode.nextElementSibling;
            preview.classList.toggle('display_none');
            full.classList.toggle('display_none');
        });
    }

    for(let i = 0; i < rcrms.length; i++) {
        rcrms[i].addEventListener('click', function(e) {
            e.preventDefault();
            let preview = this.parentNode.parentNode.previousElementSibling;
            let full    = this.parentNode.parentNode;
            preview.classList.toggle('display_none');
            full.classList.toggle('display_none');

        });
    }
</script>
