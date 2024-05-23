<a id="faqs"></a>
<section class="faqs">
    <div class="grid-container">
        <div class="grid-x">
             <div class="small-12 text-center">
                 <h3>FAQs</h3>
                 <p>
                     Some quick answers to the questions we get frequently asked.
                 </p>
             </div>
             <div class="large-8 large-offset-2 small-12 medium-12">
                 @if(count($faqs ?? []))
                    @foreach($faqs as $faq)
                        <dl class="faqs qas">
                            <dt>
                                <a href="" rel="nofollow">
                                    <span>{{$faq['question']}}</span>
                                    <img class="icon" src="/images/flares/chevron-dark-blue.svg">
                                </a>
                            </dt>
                            <dd class="display_none">
                                @foreach($faq['answer'] as $p)
                                    <p>
                                        {!! $p !!}
                                    </p>
                                @endforeach
                            </dd>
                        </dl>
                     @endforeach
                 @endif
            </div>
        </div>
    </div>
    {!! $page->addCSS('<link rel="stylesheet" href="/assets/css/partials/faqs.min.css">','bottom') !!}
    {!! $page->addJS('<script src="/assets/js/partials/faqs.min.js"></script>','bottom') !!}
</section>
