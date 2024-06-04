<section id="benefits">
    <div class="grid-container">

        <div class="grid-x block">
            <div class="sidekick large-6 medium-12 small-12">

            </div>
            <div class="content large-6 medium-126 small-12">
                <h2>Benefits of a replacement conservatory roof...</h2>
                <ul>
                    <li>
                        <i class="fa fa-check-circle"></i>
                        Warmer in the winter
                    </li>
                    <li>
                        <i class="fa fa-check-circle"></i>
                        Cooler in summer
                    </li>
                    <li>
                        <i class="fa fa-check-circle"></i>
                        Quieter in bad weather
                    </li>
                    <li>
                        <i class="fa fa-check-circle"></i>
                        Energy efficient
                    </li>
                    <li>
                        <i class="fa fa-check-circle"></i>
                        Prevent fading furniture
                    </li>
                    <li>
                        <i class="fa fa-check-circle"></i>
                        Bespoke design
                    </li>
                    <li>
                        <i class="fa fa-check-circle"></i>
                        10 year guarantee
                    </li>
                </ul>
            </div>
        </div>
        <div class="large-12 medium-12 small-12 cta_container">
            @include('partials/ctas/button')
        </div>
    </div>
</section>
<style>
    #benefits {
        padding:2rem 0;
    }
    #benefits .block {
        border-radius: 1rem;
        overflow: hidden;
    }
    #benefits .grid-container.fluid {
        padding:0;
    }

    #benefits .sidekick {
        background: url('/images/partners/eco-tech-conservatories/replacement-conservatory-roof.jpg');
        background-position: -80px 1px;
        background-size:cover;
        height:500px;
        display: flex;

    }
    #benefits .content {
        padding:2rem 2rem;
        justify-items: center;
        align-content: center;
        background:#ECECEC;
    }
    #benefits .content h2 {
        line-height: 3rem;

    }
    #benefits .content ul {
        list-style: none;
        margin:0;
        padding:1rem 0;
    }
    #benefits .content ul li {
        font-size:1.2rem;
    }
    #benefits .content ul li i {
        margin-right:1rem;
        padding:0.5rem;
        color:green;

    }
    #benefits .cta_container {
        margin-top:1rem;
    }
    #benefits .cta_container a {
        background: var(--ca-button-primary);
        border: 2px solid var(--ca-button-primary);
    }
    #benefits .cta_container a.primary:hover {
        background: #FFFFFF;
        color: var(--ca-button-primary);
        border: 2px solid var(--ca-button-primary);
    }
    #benefits .cta_container a.ghost {
        color: var(--ca-button-primary);
        background: #FFFFFF;

    }
    #benefits .cta_container a.ghost:hover {
        background: var(--ca-button-primary);
        color: #FFFFFF;
    }
    @media print, screen and (max-width: 1023px) {
        #benefits .content {
            padding:2rem;
        }
        #benefits .content ul {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
    }
    @media print, screen and (max-width: 720px) {
        #benefits .content {
            text-align: center;
        }
        #benefits .content ul {
            display: grid;
            grid-template-columns: 1fr;
            text-align: left;
            margin-left:15%;
        }
    }
    @media print, screen and (max-width: 630px) {
        #benefits .content h2 {
            font-size:1.6rem !important;;
            line-height: 2rem;
        }
        #benefits .content ul {
            margin-left: 3%;
        }
        #benefits .sidekick {
            background-position: -200px 1px;
        }
    }
    @media print, screen and (max-width: 640px) {
        #benefits .cta_wrapper {
            margin: 0;
        }
        #benefits .cta_container {
            width:100%;
        }
    }

    @media print, screen and (max-width: 500px) {
        #benefits .content {
            padding:1rem;
        }
        #benefits .content ul li {
            font-size: 1rem;
        }
        #benefits .content ul li i {
            margin-right:0;
        }

        #benefits .cta_container .button {
            font-size:1.1rem;
        }
    }
</style>
