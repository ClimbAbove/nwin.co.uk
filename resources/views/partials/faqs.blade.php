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
    {!! $page->addJS('<script src="/assets/js/partials/faqs.js"></script>','bottom') !!}
    <script>
        let
            qas=document.getElementsByClassName('qas');if(qas.length){for(let i=0;i<qas.length;i++){let
            dts=qas[i].getElementsByTagName('dt');for(let d=0;d<dts.length;d++){let
            as=dts[d].getElementsByTagName('a');for(let a=0;a<as.length;a++){as[a].addEventListener('click',function(e){e.preventDefault();let
            answer=as[a].parentNode.nextElementSibling;if(answer.classList.contains('display_none')){answer.classList.remove('display_none');dts[i].classList.add('open');}else{answer.classList.add('display_none');dts[i].classList.remove('open');}return false;});}}}}
    </script>
    {!! $page->addCSS('<link rel="stylesheet" href="/assets/css/partials/faqs.min.css">','bottom') !!}

</section>
