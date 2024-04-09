<div class="hero_container">
    <div class="hero grid-container-fluid">
        <div class="grid-x">
            <div class="large-12">
                <div class="grid-container">
                    <div class="grid-x">
                        <div class="large-3 image_container left"></div>
                        <div class="large-6 medium-12 small-12 blurb">
                            <h2>
                                Windows & Door Sale Now On
                            </h2>
                            <h3>
                                Unbeatable Prices, Unbeatable Quality
                            </h3>
                            <div class="selling_points_container">
                                <ul class="selling_points hide-for-small-only">
                                    <li><img src="images/icons/white/tick.svg"> Leading Brands, Lowest prices</li>
                                    <li><img src="images/icons/white/tick.svg"> 25+ Years Experience</li>
                                    <li><img src="images/icons/white/tick.svg"> Free Expert Advice</li>
                                    <li><img src="images/icons/white/tick.svg"> 10 Year Warranties </li>
                                    <li><img src="images/icons/white/tick.svg"> Friendly & Local Installers</li>
                                </ul>
                            </div>
                        </div>
                        <div class="large-3 small-12 image_container right"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="swoosh_container">
        <div class="swoosh">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path class="shape-fill" stroke-width="3" stroke-miterlimit="10" d="M599.996 118.496c-267.698 0-498.59-33.875-604.996-82.771V126h1211V35.256c-105.947 49.149-337.454 83.24-606.004 83.24z"></path>
            </svg>
        </div>
        <div class="cta_swoosh">
            @include('partials/ctas/button', ['cta_text' => 'Get Prices Now', 'scrolling_text_enabled' => true])
            <div class="blurb">
                <ul class="selling_points show-for-small-only">
                    <li><img src="images/icons/white/tick.svg"> Leading Brands, Lowest prices</li>
                    <li><img src="images/icons/white/tick.svg"> 25+ Years Experience</li>
                    <li><img src="images/icons/white/tick.svg"> Free Expert Advice</li>
                    <li><img src="images/icons/white/tick.svg"> 10 Year Warranties </li>
                    <li><img src="images/icons/white/tick.svg"> Friendly & Local Installers</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .hero_container .hero {
        background-color: var(--ca-tertiary);
        background: #4bb1f3;
        height: 515px;
        position: relative;
    }
    .hero_container .grid-container {
        max-width: 95rem;
    }
    .hero_container .image_container {
        padding-top:8rem;
    }
    .hero_container .image_container.left {
        background:url('/images/hero/istockphoto-185692782-1024x1024.jpg');
        background-size: cover;
        background-position: -9px -20px;
    }
    .hero_container .image_container.right {
        background:url('/images/hero/kid_full.jpg');
        background-size: cover;
        background-position: -200px 0;
    }
    .hero_container .swoosh_container {
        background: #21427f;
    }
    .hero_container .swoosh_container .swoosh {
        margin-top: -125px;
        z-index: 2;
        position: relative;
    }
    .hero_container .swoosh_container .swoosh svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 125px;
    }
    .hero_container .swoosh_container .cta_swoosh .cta_container {
        text-align: center;
        margin-top: -2.1rem;
        position: relative;
        z-index:3;
    }
    .hero_container .swoosh_container .cta_swoosh .cta_container .button {
        background: #BF0F30;
        border:2px solid #BF0F30;
        padding:1.2rem 1.8rem;
    }
    .hero_container .swoosh_container .cta_swoosh .cta_container .button:hover {
        color: #BF0F30;
        border:2px solid #BF0F30;
    }
    .hero_container .swoosh_container .cta_swoosh .cta_container .text_scroller {
        padding-bottom: 3rem;
    }
    .hero_container .swoosh_container .swoosh svg .shape-fill {
        fill: #21427f;
        stroke: #BF0F30;
    }
    .hero_container .image {
        position: relative;
    }
    .hero_container h2 {
        font-size:3.6rem;
        line-height: 4.4rem;
        text-align: center;
        padding-right: 0;
    }
    .hero_container h3 {
        font-size:2.2rem;
        line-height: 2.6rem;
        text-align: center;
    }
    .hero_container .blurb {
        display: flex;
        flex-direction: column;
        justify-content: center;
        justify-items: center;
        align-items: center;
        align-content: center;
    }
    .hero_container .selling_points_container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        justify-items: center;
        padding-top:2rem;
    }
    .hero_container .blurb ul {
        list-style:none;
        margin:0;
        padding:0 0 2rem 0;
        text-align: left;
    }
    .hero_container .blurb ul li {
        font-size:1.2rem;
        color:#FFFFFF;
    }
    .hero_container .blurb ul li img {
        margin-right:5px;
        height:1.2rem;
    }
    .hero_container .cta_container .button {
        font-size:1.2rem;
        font-family: "Lato Black";
        background-color: #BF0F30;
    }
    .hero_container .cta_container .button:hover {
        background: #FFFFFF;
    }
    .hero_container .chevron_container {
        margin-top:-2px;
    }
    @media print, screen and (max-width: 80em) {
        .hero_container .grid-container {
            max-width: 75rem;
        }
    }
    @media print, screen and (max-width: 64em) {
        .hero_container {
            text-align: center;
        }
        .hero_container .image_container {
            display: none !important;
        }
        .hero_container .hero > .grid-x > div {
            width:100%;
        }
    }
    @media print, screen and (max-width: 40em) {

        .hero_container .hero {
            text-align: center;
            height:auto;
            padding-bottom: 2.16rem;
            background-size: 60%;
        }
        .hero_container .hero h2 {
            padding:1rem 1rem 1rem 1rem;
            font-size:3.2rem;
            line-height: 3.4rem;
        }
        .hero_container .hero h3 {
            font-size:2rem;
            line-height: 2.6rem;
            padding-bottom: 2rem;
        }
        .hero_container .hero .blurb {
            text-align: center;
            height:auto;
            z-index: 3;
            display: flex;
            flex-direction: column;
            justify-content: center;
            justify-items: center;
            align-items: center;
            align-content: center;
        }

        .hero_container .hero .blurb .selling_points {
            text-align: left;
        }

        .hero_container .blurb p {
            padding:0;
            text-align: center;
            height:auto;
            z-index: 3;
            margin-bottom: 2rem;
        }
        .hero_container .cta_container .button {
           width:90%;
            margin-top:-1.8rem;
        }

        .hero_container .image {
            margin-bottom: 3rem;
        }
        .hero_container .swoosh_container .swoosh {
            margin-top: -89px;
        }
        .hero_container .swoosh_container .swoosh svg {
            height:90px;
        }




    }





</style>
