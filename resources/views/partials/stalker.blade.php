<section id="stalker" class="stalker display_none">
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-12 medium-12 small-12">
                @if(($contact_mode ?? null) === 'telephone')
                    @include('partials/ctas/button', ['cta_text' => 'Find Out Prices Now', 'scrolling_text_enabled' => true])
                @else
                    @include('partials/ctas/button', ['cta_text' => 'Find Out Prices Now', 'scrolling_text_enabled' => true])
                @endif
            </div>
        </div>
    </div>
</section>
{!! $page->addCSS('<link rel="stylesheet" href="/assets/css/partials/stalker.min.css">','bottom') !!}
{!! $page->addJS('<script src="/assets/js/partials/stalker.min.js"></script>','bottom') !!}
