<section class="quote_tool">
    <div class="quote_tool_container">
        <form wire:submit.prevent="save">

            @if($current_step = $questionnaire->getCurrentStep())

                <div class="step_container">
                    <h3>{{ $current_step->text }}</h3>
                    <div class="element_container">

                        @if($current_step instanceof \App\Classes\Elements\Form\FormElement)

                            @foreach($current_step->fields as $key => $field)

                                @switch($field->type)

                                    @case('text')
                                        <div class="field_container text">
                                            <label>{{ $field->label }}</label>
                                            <input type="text" wire:model="_form_fields.{{$field->name}}">
                                            <div>@error("{{$field->name}}") {{ $message }} @enderror</div>
                                        </div>
                                    @break

                                @endswitch

                            @endforeach

                            <button class="button" type="submit" wire:click="save()">Save</button>

                        @elseif($current_step instanceof \App\Classes\Elements\Question\QuestionElement)

                            @if($current_step->sub_text)
                                @foreach($current_step->sub_text as $sub_text)
                                    <p>
                                        {{$sub_text}}
                                    </p>
                                @endforeach
                            @endif

                                @switch($current_step->type)
                                    @case('tile')

                                        <div class="answer_tiles_container">

                                            @foreach($current_step->answers as $answer_index => $answer)

                                                <div class="answer_tile" wire:click="answer('{{$answer->id}}', '{{$answer->value}}')">
                                                    <div class="answer">{{$answer->text}}</div>
                                                    @if($answer->help ?? false)
                                                        <div class="answer_help_container">
                                                            @foreach($answer->help->help as $p)
                                                                <div class="answer_help display_none">
                                                                    <span>{{$p}}</span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                        <i class="help_icon {{$answer->help->icon}}"></i>
                                                    @endif
                                                    <div class="select_prompt">Select</div>
                                                </div>

                                            @endforeach

                                        </div>
                                    @break

                                    @case('text')
                                        @foreach($current_step->answers as $answer_index => $answer)
                                            <label>{{ $answer->text }}
                                                <input type="text" value="" wire:model="current_step">
                                            </label>
                                        @endforeach

                                        <button type="submit">Next</button>

                                        @break
                                @endswitch

                                @if($current_step->help ?? false)
                                    @include('partials/question_help', ['question' => $current_step])
                                @endif

                                @if($questionnaire->hasHistory() > 0)
                                    <a class="previous_question" href="" wire:click.prevent="back()")>Back</a>
                                @endif
                            @else
                                Nope
                            @endif

                        </div>
                    </div>

                @endif

            </form>
        </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            let openOverlays = document.getElementsByClassName('overlay_opener');
            let closeOverlays = document.getElementsByClassName('overlay_openerer');

            if (openOverlays.length) {
                for (let i = 0; i < openOverlays.length; i++) {
                    openOverlays[i].addEventListener('click', function (e) {
                        e.preventDefault();
                        let overlay = document.getElementById(e.target.dataset.overlay);
                        overlay.classList.remove('display_none');
                    });

                }
            }
            if (closeOverlays.length) {
                for (let i = 0; i < closeOverlays.length; i++) {
                    closeOverlays[i].addEventListener('click', function (e) {
                        e.preventDefault();
                        e.target.parentElement.classList.add('display_none');
                    });
                }
                return false;
            }
        });
    </script>

    <style>
        body {
            font-family: arial;
        }
        .quote_tool_container {
            text-align: center;
        }

        .quote_tool_container .step_container {
            background: #2d3748;
            padding:1rem;
            color:#FFFFFF;
            text-align: center;
        }

        .quote_tool_container .step_container .element_container {
            display: flex;
            flex-direction: column;
        }

        .quote_tool_container .step_container .answer_tiles_container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            align-content: center;
            align-items: center;
            margin:auto;
        }

        .quote_tool_container .step_container .answer_tiles_container .answer_tile {
            width:167px;
            max-width:167px;
            display: block;
            position: relative;
        }

        .quote_tool_container .step_container .answer_tiles_container .answer_tile .answer {
            padding-top:1rem;
        }
        .quote_tool_container .step_container .answer_tiles_container .answer_tile .help_icon {

        }

        .quote_tool_container .step_container .answer_tiles_container .answer_tile .select_prompt {
            display: none;
        }
        .quote_tool_container .step_container .answer_tiles_container .answer_tile .help_icon,
        .quote_tool_container .step_container .answer_tiles_container .answer_tile:hover .select_prompt {
            display:block;
            position: absolute;
            bottom:0;
            width:100%;
            padding:0.5rem;
            box-sizing: border-box;
            background:#5966F2;
            color:#FFFFFF;
            border-bottom-left-radius: 0.3rem;
            border-bottom-right-radius: 0.3rem;
        }

        .quote_tool_container .step_container .answer_tiles_container .answer_tile .help_icon {
            background: none;
            color:#000000;
        }

        .display_none {
            display:none !important;
        }
        .progress_bar {
            background:#ccc;
            height:10px;

        }
        .progress {
            background:#5966F2;
            height:10px;
        }
        .qa_container {
            background: #2d3748;
            padding:1rem;
            color:#FFFFFF;
            text-align: center;
        }
        .qa_container > div {
            display: flex;
            flex-direction: row;
            margin:auto;
            justify-content: center;
        }
        .answer_tile {
            width:200px;
            height:120px;
            border:1px solid #000;
            margin:0.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            justify-items: center;
            font-weight:bold;
            background: #FFFFFF;
            border-radius: 0.4rem;
            color:#000000;
            cursor: pointer;
        }

        .answer_tile .answer_help_container {
            margin-top:1rem;
        }

        .answer_tile .answer_help_container .select {
            display: none;
        }


        .answer_tile:hover .answer_help_container .answer_help {
            display: block !important;
            padding:0 0 1rem 0;
            font-weight: normal;
            font-size:0.8rem;
        }
        .answer_tile:hover .answer_help_container .icon {
            display: none;
        }
        .answer_tile:hover .answer_help_container .select {
            display: block;
            background: red;
        }

        .previous_question {
            color:#FFFFFF;
            text-decoration: none;
            font-weight:bold;
            margin-top:1rem;
            display: inline-block;
        }

        .help_container {
            display:block;
            margin-top:0.5rem;
        }
        .help_container a {
            color:#FFFFFF;
            text-decoration: none;
            margin-top:2rem;
            padding:0.8rem 1rem;
            border-radius: 0.3rem;
            font-size:0.8rem;
        }
        .help_container a:hover {
            background: #FFFFFF;
            color: #102337;
        }
        .help_container i {
            margin-right:0.3rem;
        }

        input[type="text"] {
            padding:0.5rem;
            border-radius: 0.3rem;
            border:1px solid #ccc;
        }
        button {
            margin-top: 0.5rem;
            background: #5966F2;
            border-radius: 0.3rem;
            background: #5966F2;
            padding: 0.8rem 1rem;
            font-size: 0.9rem;
            color: #FFFFFF;
        }

        .field_container {
            margin: 0.5rem
        }
        .field_container label {
            display:block;
            margin-bottom:0.3rem;
        }
        .field_container .error {
            color:red;
            padding-top:0.5rem;
        }



        @media only screen and (max-width: 960px) {
            .qa_container > div {

                flex-direction: column;
                justify-content: center;
                align-content: center;
                align-items: center;
                margin:auto;
            }

            .answer_tile {
                width:80%;
            }
        }

        @media only screen and (max-width: 830px) {
            .quote_tool_container .step_container .answer_tiles_container {
                grid-template-columns: 1fr 1fr 1fr;
                background:red;
            }
        }

    </style>


</section>
