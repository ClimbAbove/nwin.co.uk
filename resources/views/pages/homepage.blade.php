@extends('layouts/master')

@section('content')
    {{ $page->title('Home') }}

    @if($config['partner'] == 'eco-tech-conservatories')

        @include('partials/selling_points_bar')
        @include('partials/hero')
        @include('partials/quote_form')
        @include('partials/how_we_work')
        @include('partials/our_services')
        @include('partials/why_customers_love_us')
        @include('partners/eco-tech-conservatories/partials/benefits')
        @include('partners/eco-tech-conservatories/partials/testimonials')
        @include('partials/price_beater')
        @include('partials/faqs', ['faqs', $faqs ?? []])
        @include('partials/stalker', [])

    @else
        @include('partials/selling_points_bar')
        @include('partials/hero')
        @include('partials/quote_form')
        @include('partials/how_we_work')

        @include('partials/masonry_grid')
        @include('partials/why_customers_love_us')
        @include('partials/made_in_britain')
        @include('partials/local_to_you')
        @include('partials/price_beater')
        @include('partials/faqs', ['faqs', $faqs ?? []])
        @include('partials/savings')
        @include('partials/stalker', [])
    @endif




    {!! $page->addJS('<script src="/assets/js/partials/scrolling_text.min.js"></script>','bottom') !!}
    <style>
        .chevron_container .chevron {
            position: absolute;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }
        .hero_container + .generator {
            padding-top:5rem;
        }
        .chevron_container .chevron svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 35px;
        }
        .chevron_container .chevron.shape-fill {
            fill: #000000;
        }
        .hero_container {
            position: relative;
        }
        .hero {

            height:600px;
        }
        .hero .blurb {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height:508px;
            color:#FFFFFF;
        }
        section.generator {
            background:#ECECEC;
        }
        section.generator h3 {
            font-size:2rem;
            font-weight:bold;
        }

        .cta_container {
            display: flex;
            grid-template-columns: 1fr 1fr;
            grid-column-gap: 1rem;
            margin:auto;
        }

        section h2 {
            font-size:2.4rem !important;
        }

        @media (max-width: 1024px)  {
            .section_hero .selling_points_container ul li {
                width:100%;
            }
        }


        @media (max-width: 640px)  {
            .generator > div > .grid-x  {
                flex-direction: column-reverse;
            }

            section {
                padding:2rem 1rem !important;
            }
            .cta_container {
                display: grid;
                grid-template-columns: 1fr;
                grid-column-gap: 1rem;
                margin:auto;
                width:80%;
            }
            .cta_container .cta {
                width:100%;
            }
        }
    </style>
@endsection

