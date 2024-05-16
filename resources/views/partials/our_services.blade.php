<section class="our_services">
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-12 medium-12 small-12">
                <h3>Our Services</h3>

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
                                    @include('partials/ctas/button')
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
    }
    section.our_services h3 {
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
        min-height: 180px;
    }
    section.our_services .services_grid .service .cta_container .button {
        background: transparent;
        border:2px solid var(--ca-button-primary);
        color:var(--ca-button-primary);
        width:100%;
        margin-bottom: 0;
    }
    section.our_services .services_grid .service .cta_container .button:hover {
        background: var(--ca-button-primary);
        color:#FFFFFF;
    }
</style>
