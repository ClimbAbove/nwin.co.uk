<a id="services"></a>
<section class="our_services">
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-12 medium-12 small-12">
                <h2>Our Services</h2>

                <div class="services_grid">
                    @foreach($masonry as $brick)
                        <div class="service">
                            <div class="image">
                                <img src="{{$brick['image']}}">
                            </div>
                            <div class="content">
                                <div class="text">
                                    {{$brick['text']}}
                                </div>
                                <div class="sub_text">
                                    {{$brick['sub_text']}}
                                </div>
                                <div class="cta_container">
                                    @include('partials/ctas/button',['scrolling_text_enabled' => true])
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    section.our_services {
        text-align: center;
        background: #d0e1eb;
    }
    section.our_services h2 {
        margin-bottom:2rem;
    }
    section.our_services .services_grid {
        display:grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-column-gap: 1rem;
        grid-row-gap: 1rem;
    }
    section.our_services .services_grid .service {
        text-align: center;
        background:#ECECEC;
        border-radius: 1rem;
        border:1px solid #CCCCCC;

    }
    section.our_services .services_grid .service .image img {
        border-radius: 1rem;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        width:100%;
    }
    section.our_services .services_grid .service .content {
        padding:1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }
    section.our_services .services_grid .service .content .text {
        font-weight:bold;
        font-size:1.4rem;
        padding:0.5rem 0;
    }
    section.our_services .services_grid .service .content .sub_text {
        min-height: 210px;
    }

    section.our_services .services_grid .service .cta_container {
        display: flex;
        flex-direction: row;
        gap: 1rem;
        width:100%;
        justify-content: center;
        justify-items: center;
    }

    section.our_services .services_grid .service .cta_container .button {
        background: transparent;
        border:2px solid var(--ca-button-primary);
        color:var(--ca-button-primary);

        margin-bottom: 0;
    }
    section.our_services .services_grid .service .cta_container .button.primary {
        background: var(--ca-button-primary);
        color:var(--ca-white);
    }
    section.our_services .services_grid .service .cta_container .button.primary:hover {
        background: var(--ca-white);
        color:var(--ca-button-primary);
    }
    section.our_services .services_grid .service .cta_container .button:hover {
        background: var(--ca-button-primary);
        color:#FFFFFF;
    }
    section.our_services .text_scroller {
        color:#000000;
        margin-top:0.8rem
    }
    @media print, screen and (max-width: 1023px) {
        section.our_services .services_grid {
            grid-template-columns: 1fr  1fr;
        }
        section.our_services .services_grid .service .image  {
            width:100%;
        }
        section.our_services .services_grid .service .image img{
            width:100%;
        }
        section.our_services .services_grid .service .sub_text {
            display: none;
        }
    }
    @media print, screen and (max-width: 760px) {
        section.our_services .services_grid {
            grid-template-columns: 1fr;
        }
        section.our_services .services_grid .service .image  {
            width:100%;
        }
        section.our_services .services_grid .service .image img{
            width:100%;
        }
        section.our_services .services_grid .service .sub_text {
            display: none;
        }
    }
    @media print, screen and (max-width: 640px) {
        section.our_services .cta_container {
            padding:0 !important;
        }
        section.our_services .cta_wrapper {
            margin:0;
        }
    }
    @media print, screen and (max-width: 420px) {
        section.our_services .cta_container {
            padding:0.5rem;
            width:100%;
        }
        section.our_services .cta_container .cta_container {
            padding:0;
        }
        section.our_services .services_grid .service .cta_container .button {
            font-size:1.1rem;
        }

        section.our_services .services_grid .service .cta_container {
            padding:0;
        }


    }

</style>
