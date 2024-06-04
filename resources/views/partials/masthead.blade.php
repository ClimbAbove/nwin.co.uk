<div class="masthead">
    <div class="grid-container">
        <div class="grid-x">
            <div class="logo_container large-3 small-12">
                <a href="{{route('page-home')}}">
                    <img src="{{$config['logo']}}">
                </a>

            </div>
            <div class="large-5 small-10 menu_container">
                <a href="#services">Products</a><br>
                <a href="#why-us">About Us</a><br>
                <a href="#faqs">FAQs</a><br>
            </div>
            <div class="large-4 small-10 ctax">
                @include('partials/ctas/button', ['cta_text' => 'Find Prices Now!'])
            </div>
        </div>
    </div>
    <div class="price_match_container">
        <div class="top">
            <i class="fa fa-tags"></i>
            Price
            Match
        </div>
        <div class="bottom">
            <svg style="max-width:90px" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M1200 0L0 0 598.97 114.72 1200 0z" class="shape-fill"></path>
            </svg>
        </div>
    </div>
</div>
{!! $page->addCSSInline('<link rel="stylesheet" href="/assets/css/partials/masthead.css">','top') !!}
