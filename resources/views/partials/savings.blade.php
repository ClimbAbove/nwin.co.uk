<section class="savings">
    <div class="grid-container-fluid">
        <div class="grid-x">
            <div class="large-6 medium-6 small-12 content_container">
                <h4>Want to find out how much you can save?</h4>
                @include('partials/ctas/button', ['cta_text' => 'Get Price Now!'])
            </div>
            <div class="large-6 medium-6 small-12 image_container">

            </div>
        </div>
    </div>
</section>
{!! $page->addCSS('<link rel="stylesheet" href="/assets/css/partials/savings.min.css">','bottom') !!}
