<a id="quote"></a>
<section class="quote_form">
    <div class="grid-container">
        <div class="grid-x reversible">
            <div class="large-4 medium-12 small-12">
                <div class="selling_points_container">
                    <h4>Get Your Free Quote!</h4>
                    <ul>
                        <li><i class="fa fa-check-circle"></i> Free No Obligation Quote</li>
                        <li><i class="fa fa-check-circle"></i> Leading Brands</li>
                        <li><i class="fa fa-check-circle"></i> Lowest prices</li>
                        <li><i class="fa fa-check-circle"></i> 25+ Years Experience</li>
                        <li><i class="fa fa-check-circle"></i> Free Expert Advice</li>
                        <li><i class="fa fa-check-circle"></i> 10 Year Warranties</li>
                        <li><i class="fa fa-check-circle"></i>  Friendly & Local Installers</li>
                    </ul>
                </div>
            </div>
            <div class="large-8 medium-12 small-12 comp">
                @livewire('questionnaire-component', ['data' => ['questionnaire_element' => $questionnaire_element]])
            </div>
        </div>
    </div>
</section>
<style>
    .loading_text {
        margin-bottom: 0.5rem;
        font-weight: bold;
    }
    .loader {
        width: 120px;
        height: 22px;
        border-radius: 40px;
        color: #514b82;
        border: 2px solid;
        position: relative;
        margin:auto;
    }
    .loader::before {
        content: "";
        position: absolute;
        margin: 2px;
        width: 25%;
        top: 0;
        bottom: 0;
        left: 0;
        border-radius: inherit;
        background: currentColor;
        animation: l3 1s infinite linear;
    }
    section.quote_form .error {
        color: #cc4b37;
        margin-top:-5px;
        margin-bottom: 15px;
        text-align: center;
    }
    section.quote_form section.quote_tool .loading {
        width:100%;
        text-align: center;
    }
    .comp {
        border-top-right-radius: 1rem;
        border-bottom-right-radius: 1rem;
        overflow:hidden;
    }
    section.quote_form {
        background:#ECECEC;
    }
    section.quote_form section.quote_tool {
        background:#FFFFFF;
        min-height: 325px;
        padding:0;
    }
    section.quote_form section.quote_tool .button_container {
        width:100%;
        text-align: center;
    }
    .quote_tool_container  label {
        text-align: center;
        margin-bottom: 0.5rem;
        font-size:1.2rem;
    }
    section.quote_form section.quote_tool .button_container button {
        border-radius: 2rem;
        color:#FFFFFF;
        width:100%;
        border:2px solid var(--ca-button-primary);
        background: var(--ca-button-primary);
        margin-top:2rem;
    }
    section.quote_form section.quote_tool .button_container button:hover {
        background: #FFFFFF;
        color:  var(--ca-button-primary);
    }

    section.quote_form section.quote_tool .previous_question {
        color:#ccc;
        border: 1px solid #cccccc;
        border-radius: 2rem;
        padding:1rem 2rem;
    }
    section.quote_form section.quote_tool .previous_question:hover {
        color:#333;
        border-color:#333;
    }
    section.quote_form .reversible .large-8 {
        min-height: 325px;
    }

    section.quote_form h4 {
        margin:0;
        padding:0;
        font-size:2rem;
    }
    label {
        font-weight: bold;
    }
    section.quote_form .grid-container .grid-x {
        box-shadow: 0 0 9px 1px rgba(0,0,0,0.19);
        border-radius: 1rem;
    }

    section.quote_form .selling_points_container {
        background:#21427f;
        height:100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color:#FFFFFF;
        padding:2rem 1rem;
        border-top-left-radius: 1rem;
        border-bottom-left-radius: 1rem;
    }
    section.quote_form .selling_points_container ul {
        margin:0;
        list-style: none;
        text-indent: -23px;
        margin-left: 18px;
        padding:1rem;
    }
    section.quote_form .selling_points_container ul li {
        font-size:1.2rem;
    }
    section.quote_form .selling_points_container ul li i {

        color:#F4EB2A;
    }


    .quote_tool_container .progress_bar {
        background-color: #CCCCCC;
    }
    .quote_tool_container form {
        background-color: #FFFFFF;
        overflow: hidden;
    }
    .quote_tool_container  .step_container {
        padding:1rem;
    }
    .quote_tool_container  .step_container h3 {
        text-align: center;
        font-size:2rem;
    }
    .quote_tool_container  .step_container p {
        text-align: center;
    }
    .quote_tool_container  .step_container .xanswer_tiles_container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        flex-flow: wrap;
    }


    .quote_tool_container  .step_container .answer_tiles_container {
        display: grid;
        grid-template-rows:repeat(2,150px);
        grid-auto-flow: column;
        column-gap:1rem;
        row-gap:10px;
    }
    .quote_tool_container  .step_container .answer_tiles_container .answer_tile {
        flex-basis: 280px;
        width: 167px;
        height: 150px;
        background:#FFFFFF;
        margin-right:10px;
        text-align: center;
        margin-bottom:10px;
        border:1px solid #CCCCCC;
        border-radius: 0.3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0px 3px 12px 0px rgba(0,0,0,0.1);
        cursor: pointer;
    }

    .quote_tool_container  .step_container .answer_tiles_container .xanswer_tile {
        border:1px solid #CCCCCC;
        padding:1rem;
        cursor: pointer;
        border-radius: 0.3rem;
        text-align: center;
        margin:0.5rem;
        width:160px;
    }
    .quote_tool_container  .step_container .answer_tiles_container .answer_tile.answered {
        background-color: var(--ca-tertiary);
    }
    .quote_tool_container  .step_container .answer_tiles_container .answer_tile:hover {
        color:  var(--ca-tertiary);
        border-color: var(--ca-tertiary);
    }
    .quote_tool_container  .step_container .answer_tiles_container .answer_tile .icon_container img {
        height:75px;
        margin-bottom: 1rem;
    }
    .quote_tool_container  .step_container .answer_tiles_container .answer_tile .answer {
        font-weight: bold;
        font-size:0.9rem;
    }
    .quote_tool_container .controls_container {
        padding:1rem;

        margin-bottom:1rem;
        text-align: center;
    }

    .quote_tool_container .controls_container .button {
        background:#BF0F30;
    }

    @media print, screen and (max-width: 1250px) {


        .quote_tool_container  .step_container .answer_tiles_container {
            display: grid;
            grid-template-rows:1fr 1fr 1fr;
            grid-auto-flow: column;
            column-gap:1rem;
            row-gap:10px;
        }
        .quote_tool_container  .step_container .answer_tiles_container .answer_tile {
            width:auto;
        }
        .quote_tool_container  .step_container .answer_tiles_container .answer_tile .answer {
            width:180px;
            margin:0 auto;
        }
    }

    @media print, screen and (max-width: 1023px) {

        .quote_form .reversible {
            flex-direction: column-reverse;
        }
        .comp {
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            border-bottom-left-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
        section.quote_form .selling_points_container {
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
            border-bottom-left-radius: 1rem !important;
            border-bottom-right-radius: 1rem !important;
        }
        .quote_tool_container  .step_container .answer_tiles_container {
            display: grid;
            grid-template-rows:repeat(4,150px);
            grid-auto-flow: column;
            column-gap:1rem;
            row-gap:10px;
        }
        .quote_tool_container  .step_container .answer_tiles_container .answer_tile {
            flex-basis: 280px;
            height: 150px;
            background:#FFFFFF;
            margin-right:10px;
            text-align: center;
            margin-bottom:10px;
            border:1px solid #CCCCCC;
            border-radius: 0.3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0px 3px 12px 0px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .quote_tool_container  .step_container .answer_tiles_container .answer_tile .answer {
            width:auto;
        }
        section.quote_form .selling_points_container {
            border-top-right-radius: 2rem;
            border-bottom-left-radius: 0;
        }
        .comp {
            border-top-right-radius: 0;
            border-bottom-right-radius: 2rem;
            border-top-right-radius: 0;
            border-bottom-left-radius: 2rem;
        }
    }

    @media only screen and (max-width: 830px) {
        .quote_tool_container .step_container .answer_tiles_container {
            grid-template-columns: 1fr 1fr ;
            grid-auto-flow: inherit;
        }
        .quote_tool_container .step_container .answer_tiles_container .answer_tile {
            width:auto;
        }

        .quote_tool_container  label {
            text-align: center;
        }

        .quote_tool_container  a, button {
            font-weight: bold;
        }
    }

    @media print, screen and (max-width: 640px) {
        section#quote_form {
            padding:0;
        }
        .comp {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        section.quote_form h4 {
            font-size:1.6rem;
        }
        section.quote_form .selling_points_container {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }

        .quote_tool_container .step_container .answer_tiles_container {
            grid-template-columns: 1fr;

            grid-auto-flow: inherit;
        }
        .quote_tool_container .step_container .answer_tiles_container .answer_tile {
            width:100%;
        }
    }
    @media print, screen and (max-width: 40em) {
        .xquote_form .reversible {
            flex-direction: column-reverse;
        }


        .xquote_tool_container  .step_container .answer_tiles_container {
            display: grid;
            grid-template-rows:repeat(4,150px);
            grid-auto-flow: column;
            column-gap:1rem;
            row-gap:10px;
        }
        .xquote_tool_container  .step_container .answer_tiles_container .answer_tile {
            flex-basis: 280px;

            height: 150px;
            background:#FFFFFF;
            margin-right:10px;
            text-align: center;
            margin-bottom:10px;
            border:1px solid #CCCCCC;
            border-radius: 0.3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0px 3px 12px 0px rgba(0,0,0,0.1);
            cursor: pointer;
        }
    }

    @media print, screen and (max-width: 500px) {
        section.quote_form h4 {
            font-size: 1.3rem;
        }
        section.quote_form .selling_points_container ul li {
            font-size: 1rem;
        }
    }
</style>
