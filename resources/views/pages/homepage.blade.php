@extends('layouts/master')

@section('content')
    {{ $page->title('Home') }}
    {!! $page->addJS('<script src="/js/dialog.js">') !!}
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
        @include('partials/our_services')
        @include('partials/why_customers_love_us')
        @include('partials/benefits')
        @include('partners/eco-tech-conservatories/partials/testimonials')
        @include('partials/price_beater')
        @include('partials/faqs', ['faqs', $faqs ?? []])
        @include('partials/stalker', [])

    @endif



    <dialog class="modal" id="dialog_book"
            data-mode="{{$contact_mode}}"
    >
        <button class="close-button close_dialog">
            <i class="fa fa-times"></i>
            Close
        </button>
        <h3>Talk to an Expert Now!</h3>
        <p>
            <a href="tel:{{$telephone['international'] }}" class="button primary"><i class="fa fa-phone-alt"></i><span class="cta_telephone">{{$telephone['number']}}</span></a>
        </p>
        <div class="star_container">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 96" style="enable-background:new 0 0 512 96" xml:space="preserve"><style>.st0{fill:#00b67a}.st2{fill:#fff}</style><g id="Trustpilot_ratings_4halfstar-RGB"><path id="Rectangle-path" class="st0" d="M0 0h96v96H0z"/><path class="st0" d="M104 0h96v96h-96zM208 0h96v96h-96zM312 0h96v96h-96z"/><g id="Half"><path style="fill:#dcdce6" d="M48 0h48v96H48z" transform="translate(416)"/><path class="st0" d="M0 0h48v96H0z" transform="translate(416)"/></g><path id="Shape" class="st2" d="M48 64.7 62.6 61l6.1 18.8L48 64.7zm33.6-24.3H55.9L48 16.2l-7.9 24.2H14.4l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15z"/><path class="st2" d="m152 64.7 14.6-3.7 6.1 18.8L152 64.7zm33.6-24.3h-25.7L152 16.2l-7.9 24.2h-25.7l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15zM256 64.7l14.6-3.7 6.1 18.8L256 64.7zm33.6-24.3h-25.7L256 16.2l-7.9 24.2h-25.7l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15zM360 64.7l14.6-3.7 6.1 18.8L360 64.7zm33.6-24.3h-25.7L360 16.2l-7.9 24.2h-25.7l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15zM464 64.7l14.6-3.7 6.1 18.8L464 64.7zm33.6-24.3h-25.7L464 16.2l-7.9 24.2h-25.7l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15z"/></g></svg>

        </div>


        <div class="selling_points_container">
            <ul>
                @foreach($hero['hero_selling_points'] as $selling_point)
                    <li><i class="fa fa-check-circle"></i> {{$selling_point}}</li>
                @endforeach
            </ul>
        </div>
    </dialog>

    <style>
        dialog {
            margin: 10% auto;
            width: 80%;
            max-width: 500px;
            background-color: #fff;
            padding: 34px;
            border: 0;
            border-radius: 5px;
        }
        dialog > p {
            text-align: center;
            margin: 0;
        }
        dialog > p:first-of-type {
            margin: 0 auto 20px;
            font-size: 32px;
            font-weight: 600;
        }
        dialog > button {
            margin: 20px auto;
            font-size:1rem;
        }
        dialog .close-button {
            font-size:1rem;
            margin: 15px auto;
        }

        #dialog_book {
            text-align: center;
            width: 80%;
            max-width: 600px;
        }
        #dialog_book h3 {
            margin-top:1rem;
        }
        #dialog_book a {
            margin-bottom: 0;
            background: var(--ca-button-primary);
            padding:1rem 3rem;
            font-size:1.2rem;
        }
        #dialog_book a:hover {
            background: var(--ca-button-primary);
            color: #FFFFFF;
        }
        #dialog_book a i {
            margin-right:0.4rem;
            color:#FFFFFF;
        }
        #dialog_book .star_container {
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: center;


            width: 260px;
            margin: 1.4rem auto auto auto;
        }

        .star_box {
            background:#22bb5b;
            margin:0 2px;
            text-align: center;
            padding:0.4rem;
            border-radius: 0.2rem;
        }
        #dialog_book .star_container img {
            height:35px;
        }

        #dialog_book .selling_points_container {
            display: flex;
            justify-content: center;
            margin-top:1rem;
        }

        #dialog_book .selling_points_container ul {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            list-style: none;
            margin: 0;
            text-align: left;
            justify-items: center;
        }
        #dialog_book .selling_points_container ul li {
            width:50%;
            padding:0.5rem;
            font-weight: bold;
        }
        #dialog_book .selling_points_container ul li i {
            color: green;
        }

        @media print, screen and (max-width: 700px) {

            #dialog_book h3 {
                font-size:2rem;
                line-height: 2.2rem;
                margin-bottom:1rem;
            }
            dialog > p:first-of-type {
                margin-bottom: 0.8rem;
            }
            #dialog_book .selling_points_container {
                flex-direction: column;
                padding-top:0;
                margin-left:1rem;
            }
            #dialog_book .selling_points_container ul {
                flex-direction: column;
            }
            #dialog_book .selling_points_container ul li {
                width:100%;
                padding: 0.2rem;
            }

            .button_star {
                flex-direction: column;
            }
            .section_hero .reversable .button_star .star_container {
                margin-top:1.5rem;
            }
        }
    </style>


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
        .section_hero .cta_container .cta.secondary.ghost {
            height:72px;
            width:72px;
            padding:1rem;
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
        .cta_wrapper {
            margin:auto;
        }
        .cta_container {
            display: flex;
            grid-template-columns: 1fr 1fr;
            grid-column-gap: 1rem;
            margin:auto;
        }
        .cta_container.single {
            grid-template-columns: 1fr;
        }

        section h2 {
            font-size:2.4rem !important;
        }

        @media (max-width: 1024px)  {
            .section_hero .selling_points_container ul li {
                width:100%;
            }
        }
        @media (max-width: 720px) {
            .section_hero h1 {
                margin-top:0.8rem;
            }

            .section_hero .cta_wrapper {
                margin: 0.3rem;
            }

            .section_hero .cta_wrapper .button {
                min-height: 55px;
                align-items: center;
                align-content: center;
                justify-content: center;
                justify-items: center;
            }
        }

        @media (max-width: 640px)  {
            .generator > div > .grid-x  {
                flex-direction: column-reverse;
            }

            section {
                padding:2rem 1rem !important;
            }
            section#quote_tool {
                padding:0 !important;
            }
            .cta_container {
                display: grid;
                grid-template-columns: 1fr;
                grid-column-gap: 1rem;
                margin:auto;


                display: flex;
                justify-items: center;
                justify-content: center;

            }
            .cta_container .cta {
                width:100%;
            }
        }


        @media print, screen and (max-width: 420px) {
            .section_hero .cta_container .cta {
                padding: 0.8rem 1.6rem;
                font-size: 0.9rem;
            }
            .cta_container {
                padding:0;
            }
            .section_hero .cta_container {
                padding:0 0.5rem;
            }


        }
        @media print, screen and (max-width: 400px) {


            .stalker .cta_container .button {
                font-size:1rem;

            }
        }
    </style>
@endsection

