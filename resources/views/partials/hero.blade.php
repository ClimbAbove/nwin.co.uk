    <section class="section_hero">
        <div class="grid-container">
            <div class="grid-x">
                <div class="large-6 medium-12 small-12">
                    <h1>
                        {{ $hero['h1'] }}
                    </h1>
                    <h2>
                        {{ $hero['h2'] }}
                    </h2>

                    <div class="reversable">
                        <p>
                            @include('partials/ctas/button')

                            <div class="star_container">
                                <img src="/images/star_gold.svg">
                                <img src="/images/star_gold.svg">
                                <img src="/images/star_gold.svg">
                                <img src="/images/star_gold.svg">
                                <img src="/images/star_gold.svg">
                            </div>

                        </p>
                        <div class="selling_points_container">
                            <ul>
                                <li class="one"><i class="fa fa-check"></i> Leading Brands, Lowest prices</li>
                                <li class="two"><i class="fa fa-check"></i> 25+ Years Experience</li>
                                <li class="three"><i class="fa fa-check"></i> Free Expert Advice</li>
                                <li class="four"><i class="fa fa-check"></i> 10 Year Warranties</li>
                                <li class="five"><i class="fa fa-check"></i> Friendly & Local engineers</li>
                                <li class="six"><i class="fa fa-check"></i> Some nw poine</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="large-6 small-12 hero_image_container">
                    <div class="slant">
                        <div class="hero_image">

                        </div>
                    </div>
                </div>


            </div>
        </div>
        <style>
            .hero_image_container {

                overflow: hidden;
                height:440px;
                position: relative;

            }
            .hero_image_container .slant {
                transform: rotate(10deg);

                background: #ffe388;
                overflow:hidden;
                position: absolute;
                top:-4rem;
                right:-2rem;
                height:800px;
                width:560px;
                margin-left:0;
            }
            .hero_image_container .hero_image {
                /*https://www.shutterstock.com/image-vector/realistic-pvc-window-open-sash-isolated-2311084423*/
                background:url('/images/hero/window1.png');
                background-position: center center;
                background-size:60%;
                background-repeat: no-repeat;
                position: relative;
                padding:2rem;
                transform: rotate(-10deg);
                height:600px;
                margin-left:-3rem;
            }
            .section_hero {
                padding:0rem !important;
            }
            .section_hero h1 {
                font-size:1.6rem;
                margin-top:2rem;
            }

            #van {
                position: absolute;
                bottom:1rem;
                right:1rem;
                width:40%;
            }

            .section_hero img {
                width:70%;
                text-align: right;
            }
            .section_hero ul {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                list-style: none;
                margin:0;
            }

            .section_hero .selling_points_container {
                display: flex;
                justify-content: center;
                margin-bottom:2rem;
            }
            .section_hero .selling_points_container i {
                color: #22bb5b;
            }

            .section_hero ul li {
                width:50%;
                color:#FFFFFF;
                font-weight: bold;
            }
            .section_hero ul li i {
                margin-right:0.2rem;
                color: var(--ds-green);
            }
            .section_hero {
                background: #1A90D9;

                padding-bottom: 2rem;
                background-size: cover;
            }
            .section_hero h1 {
                color:#FFFFFF;
                font-size:3rem;
            }
            .section_hero h2 {
                color:#FFFFFF;
                font-size:2rem;
            }
            .section_hero .hero_image_container {
                text-align: right;
            }
            .section_hero .button {
                background:var(--ca-button-primary);
                border:2px solid var(--ca-button-primary);
                margin-top:1rem;
                font-size:1.4rem;
                font-weight: bold;
                padding:1rem 4rem;
                margin-bottom: 0;
                animation: button_pulse 2s infinite;
                transition: 0.5s;
                border-radius: 3rem;
            }
            .section_hero .button:hover {
                background:#FFFFFF;
                color: var(--ca-button-primary);
            }
            .section_hero .button span {
                display: block;
                font-size:0.8rem;
                margin-top:0.4rem;
            }
            .section_hero .button i {
                margin-right:0.3rem;
            }


            .section_hero .star_container {
                display: flex;
                flex-direction: row;
                width:200px;
                margin-left:3rem;
                margin-top:1rem;
            }
            .section_hero .star_container img {
                height:35px;
            }


            @-webkit-keyframes button_pulse {
                0% {
                    box-shadow: 0 0 0 0 var(--ds-action);
                    transform: scale(1);
                }
                70% {
                    box-shadow: 0 0 0 15px rgba(255, 78, 194, 0);
                    transform: scale(1.1);
                }
                100% {
                    box-shadow: 0 0 0 0 rgba(255, 78, 194, 0);
                    transform: scale(1);
                }
            }


            @media print, screen and (max-width: 1023px) {
                .section_hero {
                    text-align: center;
                }

                .section_hero .star_container {
                    margin: 1rem auto auto;
                    width:200px;
                }

                .section_hero .hero_image_container {
                    text-align: center;
                    display: none;
                }

            }


            @media print, screen and (max-width: 700px) {


                .section_hero h1 {
                    margin-top:2rem;
                    line-height:2.7rem;
                    font-size:2.1rem;
                }
                .section_hero h2 {
                    line-height:2rem;
                    font-size:1.83rem;
                }
                .section_hero .button {
                    width:90%;
                }
                .section_hero ul {
                    display: flex;
                    flex-direction: column;
                    flex-wrap: wrap;
                    list-style: none;
                    margin: 0;
                    text-align: left;
                    justify-items: center;
                }
                .section_hero ul li {
                    width:100%;
                    margin:0.3rem;
                }

                .section_hero .reversable {
                    display: flex;
                    flex-direction: column-reverse;
                    padding-bottom: 1rem;
                }
                .section_hero .reversable .selling_points_container {
                    padding:0;
                    margin:0.8rem;
                }
                .section_hero .reversable .selling_points_container .five,
                .section_hero .reversable .selling_points_container .six
                {
                    display:none;
                }
                .section_hero .reversable .star_container {
                    padding-top:0;
                    margin-top:-1rem;
                    margin-bottom: 0.8rem;
                }
            }

        </style>
    </section>

