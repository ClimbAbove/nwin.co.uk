<section id="benefits">
    <div class="grid-container">


        <div class="large-12">
            <div class="blocks">
            <div class="block left">
                <h2>Choose your colours</h2>
                <p>
                    We can supply and install a stunning range of windows and doors you can be sure to find a colour that suits you and your home.
                </p>

                <div class="swatches">

                    <div class="swatch mobile">
                        <img src="/images/swatches/swatch-1.png">
                    </div>
                    <div class="swatch mobile">
                        <img src="/images/swatches/swatch-2.png">
                    </div>
                    <div class="swatch mobile">
                        <img src="/images/swatches/swatch-3.png">
                    </div>
                    <div class="swatch mobile">
                        <img src="/images/swatches/swatch-4.png">
                    </div>

                    <div class="swatch">
                        <img src="/images/swatches/swatch-5.png">
                    </div>
                    <div class="swatch">
                        <img src="/images/swatches/swatch-6.png">
                    </div>

                    <div class="swatch">
                        <img src="/images/swatches/swatch-9.png">
                    </div>
                    <div class="swatch">
                        <img src="/images/swatches/swatch-10.png">
                    </div>

                    <div class="swatch">
                        <img src="/images/swatches/swatch-11.png">
                    </div>

                    <div class="swatch">
                        <img src="/images/swatches/swatch-13.png">
                    </div>
                    <div class="swatch">
                        <img src="/images/swatches/swatch-14.png">
                    </div>
                    <div class="swatch">
                        <img src="/images/swatches/swatch-15.png">
                    </div>
                </div>

            </div>
            <div class="block right">
                <h2>Get In Touch</h2>
                @include('forms/inline_form')
            </div>
            </div>
        </div>


    </div>
</section>
<style>
    #benefits {

    }
    #benefits .blocks {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap:1rem;
    }
    #benefits .left {
        padding:2rem 2rem;
        justify-items: center;
        align-content: center;
        background:#ECECEC;
        border-radius: 1rem;
        text-align: center;
    }
    #benefits .right {
        padding:2rem 2rem;
        justify-items: center;
        align-content: center;
        background:#d0e1eb;;
        border-radius: 1rem;
    }
    #benefits .swatches {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
        gap:0.5rem;
    }

    #benefits .right {
        text-align: center;
        display: flex;
        flex-direction: column;
    }

    #benefits .right label {
        text-align: left;
    }

    #benefits .right .button.primary {
        width:100%;
        margin-top:1rem;
    }

    @media print, screen and (max-width: 1023px) {
        #benefits .blocks {
            display: grid;
            grid-template-columns: 1fr ;
            gap:1rem;
        }
        #benefits .right .button.primary {
            width:100%;
        }

        #benefits .right .field_container {
            padding:0.5rem 0;
        }
    }



    #benefits {
        padding:2rem 0;
    }
    #benefits .block {

        overflow: hidden;
    }
    #benefits .grid-container.fluid {
        padding:0;
    }

    #benefits .form_container {
        background:#d0e1eb;
        height:500px;
        display: flex;
        border-radius: 1rem;

    }
    #benefits .content {
        padding:2rem 2rem;
        justify-items: center;
        align-content: center;
        background:#ECECEC;
        border-radius: 1rem;
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
    #benefits .text_scroller {
        color:#000000;
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
        #benefits .left {
            padding-bottom: 0;
            overflow: visible;
            position: relative;
            padding-bottom: 3.5rem;
        }
        #benefits .swatches {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            position: absolute;
            bottom:-2rem;
            margin-top:2rem;

            left: 0;
            width: 100%;
        }

        #benefits .swatches .swatch {
            display: none;
        }
        #benefits .swatches .swatch.mobile {
            display: block;
        }

        #benefits .right {
            margin-top:3rem;
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

        #benefits .right {
            padding: 1rem;
        }
    }
</style>
