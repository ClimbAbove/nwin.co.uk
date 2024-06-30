<footer>
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-6 medium-6 small-12 hide-for-small-only">
                <div class="logo_container">
                    <a href="{{route('page-home')}}">
                        <img src="{{$config['footer_logo'] ?? $config['logo']}}">

                    </a>
                </div>
            </div>
            <div class="large-3 medium-3 small-12">
                <div class="block links">
                    <p class="title">
                        Legal
                    </p>
                    <hr>
                    <p class="content">
                        <a href="/terms-and-conditions">Terms & Conditions</a><br>
                        <a href="/privacy-policy">Privacy Policy</a><br>
                        <a href="/cookie-policy">Cookie Policy</a>
                    </p>
                </div>
            </div>
            <div class="large-3 medium-3 small-12">
                <div class="block address">
                    <p class="title">
                        Contact
                    </p>
                    <hr>
                    <p class="content">
                        {!! implode('<br>',$address) !!}
                    </p>
                </div>
            </div>
            <div class="large-6 small-12 show-for-small-only">
                <div class="logo_container">
                    <a href="{{route('page-home')}}">
                        <img src="{{$config['footer_logo'] ?? $config['logo']}}">
                    </a>
                </div>
            </div>
            <div class="small-12">
                <p class="content copyright">
                    &copy; Copyright {{ \Carbon\Carbon::now()->format('Y') }} {{ $config['company_name'] }} is a private limited company registered in England and Wales, UK Company Reg No. {{ $config['company_number'] }}. VAT No. {{ $config['vat_number'] }}.
                </p>
            </div>


            <div class="large-12 medium-12 small-12 ca">
                <img src="/images/ca-logo-horizontal-white.png">
                <span>Online Marketing and PPC provided by <a href="https://climbabove.co.uk">Climb Above</a></span>
            </div>
        </div>
    </div>
</footer>
{!! $page->addCSS('<link rel="stylesheet" href="/assets/css/partials/footer.min.css">','bottom') !!}
