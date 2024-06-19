@extends('layouts/round')
@section('content')
    {{ $page->title('Home') }}

    <section class="hero">
        <div class="grid-container">
            <div class="grid-x">
                <div class="large-7">
                    <div class="hero_text_container">
                        <h1>Conservatory Experts</h1>
                        <p>
                            Unbeatable Prices, Unbeatable Quality
                        </p>


                        <div class="reversible">
                            <div class="cta_container">
                                <a class="button cta cta_primary">
                                    View Prices
                                </a>
                                <a class="button cta cta_secondary">
                                    Talk to an Expert
                                </a>
                            </div>

                            <div class="space">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 96" style="enable-background:new 0 0 512 96" xml:space="preserve"><style>.st0{fill:#00b67a}.st2{fill:#fff}</style><g id="Trustpilot_ratings_4halfstar-RGB"><path id="Rectangle-path" class="st0" d="M0 0h96v96H0z"/><path class="st0" d="M104 0h96v96h-96zM208 0h96v96h-96zM312 0h96v96h-96z"/><g id="Half"><path style="fill:#dcdce6" d="M48 0h48v96H48z" transform="translate(416)"/><path class="st0" d="M0 0h48v96H0z" transform="translate(416)"/></g><path id="Shape" class="st2" d="M48 64.7 62.6 61l6.1 18.8L48 64.7zm33.6-24.3H55.9L48 16.2l-7.9 24.2H14.4l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15z"/><path class="st2" d="m152 64.7 14.6-3.7 6.1 18.8L152 64.7zm33.6-24.3h-25.7L152 16.2l-7.9 24.2h-25.7l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15zM256 64.7l14.6-3.7 6.1 18.8L256 64.7zm33.6-24.3h-25.7L256 16.2l-7.9 24.2h-25.7l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15zM360 64.7l14.6-3.7 6.1 18.8L360 64.7zm33.6-24.3h-25.7L360 16.2l-7.9 24.2h-25.7l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15zM464 64.7l14.6-3.7 6.1 18.8L464 64.7zm33.6-24.3h-25.7L464 16.2l-7.9 24.2h-25.7l20.8 15-7.9 24.2 20.8-15 12.8-9.2 20.7-15z"/></g></svg>


                            </div>



                            <ul class="selling_points">
                                <li>
                                    <i class="fa fa-check-circle"></i> Guaranteed Lowest Price
                                </li>
                                <li>
                                    <i class="fa fa-check-circle"></i> Free Expert Advice
                                </li>
                                <li>
                                    <i class="fa fa-check-circle"></i> Friendly & Local Installers
                                </li>
                                <li>
                                    <i class="fa fa-check-circle"></i> 25+ Years Experience
                                </li>
                                <li>
                                    <i class="fa fa-check-circle"></i> Finance Available
                                </li>
                                <li>
                                    <i class="fa fa-check-circle"></i> 10 Year Warranties
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="large-5">
                    <div class="hero_image_container"></div>
                </div>
            </div>
        </div>

    </section>


    <style>
        .hero {
            margin-top:-2rem;
            background:#1A90D9;
            padding:2rem;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }
        .hero h1 {
            color:#FFFFFF;
            font-size:3.2rem;
            line-height:3.8rem;
        }
        .hero p {
            color:#FFFFFF;
            font-size:1.8rem;
            line-height: 2rem;
        }
        .hero .hero_text_container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            justify-items: center;
            height:100%;
        }
        .hero .hero_image_container {
            background-image: url(/images/partners/eco-tech-conservatories/hero.png);
            height:420px;
            width:100%;
            background-size:cover;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }

        .hero .reversible {
            display: flex;
            flex-direction: column;
        }

        .cta_container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width:510px;
            grid-column-gap: 1rem;
        }
        .cta_container .cta {
            border-radius:2rem;
        }
        .cta_container .cta_primary {
            z-index:2;
            background:#ff4747;
        }
        .cta_container .cta_secondary {
            margin-left:-4rem;
            border:2px solid #ff4747;
            background:#FFFFFF;
            color:#ff4747;
            font-weight:normal;
            padding-left:2.2rem;
        }
        .cta_container .cta_secondary:hover  {
            z-index:3;
            background:#ff4747;
            border:2px solid #ff4747;
        }

        .space {
            display: flex;
            flex-direction: row;
            gap:0.2rem;
            width:510px;
            align-items: center;
            align-content: center;
            justify-items: center;
            justify-content: center;

        }
        .space .star {
            background: #22bb5b;
            padding:0.3rem;
            border-radius:3px;
        }

        .hero .selling_points {
            list-style: none;
            margin:0;
            padding:1rem 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .hero .selling_points li {
            color:#FFFFFF;
            font-size:1.1rem;
        }
        .hero .selling_points li i {
            color: #22bb5b;
            font-size:1.1rem;
        }

        @media print, screen and (max-width: 420px) {

            .cta_container {
                padding: 0.8rem 1.6rem;
            }
            .section_hero .cta_container .cta {
                padding: 0.8rem 1.6rem;
                font-size: 0.9rem;
            }
        }

        @media print, screen and (max-width: 400px) {
            .stalker .cta_container .button {
                font-size:1rem;
            }
        }
    </style>
@endsection
