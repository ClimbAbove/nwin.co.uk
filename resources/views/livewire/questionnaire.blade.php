<div>
<section id="quote_tool" class="quote_tool">
    <div class="quote_tool_container">
        <form wire:submit.prevent="save">

            <div class="progress_bar">
                <div class="progress" style="width:{{$this->questionnaire->progress}}%">
                </div>
            </div>

            <div wire:loading class="loading">
                <div class="loading_text">
                    Loading...
                </div>
                <div class="loader"></div>
            </div>

            @if($current_step = $questionnaire->getCurrentStep())

                <div wire:loading.remove class="step_container">
                    <h3>{{ $current_step->text }} </h3>
                    <div class="element_container">

                        @if($current_step instanceof \App\Classes\Elements\Form\FormElement)

                            @foreach($current_step->fields as $key => $field)

                                @switch($field->type)

                                    @case('button')
                                       <div class="field_container button_container">
                                           @if($field->next_step !== null)
                                               <button class="button primary" wire:click.prevent="nextStep()" id="{{$field->id}}">{{$field->label ?? $field->value}}</button>
                                           @elseif($current_step->next_step !== null)
                                               <button class="button primary" wire:click.prevent="nextStep()" id="{{$field->id}}">{{$field->label ?? $field->value}}</button>
                                           @else
                                               <button class="button primary" id="{{$field->id}}">{{$field->label ?? $field->value}}</button>
                                           @endif
                                       </div>
                                    @break

                                    @case('text')
                                        <div class="field_container text">
                                            <label>{{ $field->label }}</label>
                                            <input type="text" wire:model="_form_fields.{{$field->name}}" wire:key="{{$field->id}}">
                                            <div class="error">
                                                @if(isset($_custom_validation_messages[$field->name]))
                                                    {{$_custom_validation_messages[$field->name] ?? ''}}
                                                @endif
                                            </div>
                                            <div class="error">@error($field->name){{$message}} @enderror</div>
                                        </div>
                                    @break

                                @endswitch

                            @endforeach

                            @if($current_step->help ?? false)
                                @include('partials/question_help', ['question' => $current_step])
                            @endif



                            @if($field->type == 'submit')
                                <div class="field_container button_container">
                                    <button class="button primary" type="submit" id="{{$field->id}}">{{$field->label ?? $field->value}}</button>
                                </div>
                            @endif






                        @elseif($current_step instanceof \App\Classes\Elements\Question\QuestionElement)

                            @if($current_step->sub_text)
                                @foreach($current_step->sub_text as $sub_text)
                                    <p>
                                        {{$sub_text}}
                                    </p>
                                @endforeach
                            @endif

                                @switch($current_step->type)

                                    @case('multi_tile')

                                    <div class="answer_tiles_container multi_tile">

                                        @foreach($current_step->answers as $answer_index => $answer)

                                            @php
                                              $class = '';
                                              if($answer->answered === true) {
                                                $class = 'answered';
                                              }
                                             @endphp



                                            <div class="answer_tile {{$class}}" wire:click="answer('{{$answer->id}}', '{{$answer->value}}')" >
                                                @if(($answer->icon ?? null) !== null)
                                                    <div class="icon_container">
                                                        <img src="{{$answer->icon}}" alt="{{$answer->value}} image">
                                                    </div>
                                                @endif


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

                                            </div>

                                        @endforeach


                                    </div>

                                    @break

                                    @case('tile')

                                        <div class="answer_tiles_container">

                                            @foreach($current_step->answers as $answer_index => $answer)

                                                <div class="answer_tile" wire:click="answer('{{$answer->id}}', '{{$answer->value}}')">
                                                    @if(($answer->icon ?? null) !== null)
                                                        <div class="icon_container">
                                                            <img src="{{$answer->icon}}" alt="{{$answer->value}} image">
                                                        </div>
                                                    @endif


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

                                                </div>

                                            @endforeach

                                        </div>




                                    @break

                                    @case('text')
                                        @foreach($current_step->answers as $answer_index => $answer)

                                            <div class="field_container text">
                                                <label>{{ $answer->text }}</label>
                                                <input type="text" wire:model="_form_fields.{{$answer->id}}">
                                                <div class="error">
                                                    @if(isset($_custom_validation_messages[$answer->name]))
                                                        {{$_custom_validation_messages[$answer->name] ?? ''}}
                                                    @endif
                                                </div>
                                                <div class="error">@error($answer->name){{$message}} @enderror</div>
                                            </div>

                                        @endforeach

                                        <button type="button" wire:click="answer('{{$answer->id}}', '{{$answer->value}}')">Next</button>

                                        @break


                                    @case('select')

                                        <div class="field_container text">
                                            <label>{{ $current_step->text }}</label>
                                            <select>
                                                @foreach($current_step->answers as $answer_index => $answer)

                                                    <option value="">Please Select</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>






                                                @endforeach
                                            </select>
                                            <div class="error">@error($answer->name){{$message}} @enderror</div>

                                            <div class="error">
                                                @if(isset($_custom_validation_messages[$answer->name]))
                                                    {{$_custom_validation_messages[$answer->name] ?? ''}}
                                                @endif
                                            </div>
                                        </div>
                                    @break
                                @endswitch

                                @if($current_step->help ?? false)
                                    @include('partials/question_help', ['question' => $current_step])
                                @endif


                            @else

                            @endif

                        </div>

                    </div>

                @endif


            @if($current_step->next_step_enabled or $questionnaire->hasHistory() > 0)
                <div class="controls_container">
                    @if($current_step->next_step_enabled)
                        <div class="field_container button_container">
                            <button class="button primary" type="submit" id="{{$field->id}}">{{$field->label ?? $field->value}}</button>
                        </div>
                    @endif

                    @if($questionnaire->hasHistory() > 0)

                    @endif

                </div>
            @endif



    </div>

        </form>
    </section>
</div>



@script
<script>
$wire.on('stepTaken', () => {
    setTimeout(() => {
        let actual_height = document.getElementById('quote_tool').scrollHeight;
        parent.postMessage('{"type":"resize", "height":' + actual_height + '}', "*");
    }, 1);

    let rect = document.getElementById('quote_tool').getBoundingClientRect();

    if (rect.top < 0) {
        document.getElementById('quote_tool').scrollIntoView();
    }

});
$wire.on('redirect', (event) => {
    setTimeout(() => {
        parent.postMessage('{"type":"redirect", "url":"' + event.url + '"}', "*");
    }, 1);
});
</script>
@endscript
<script>
    document.addEventListener("DOMContentLoaded", () => {
        addEventListener("resize", (event) => {
            let actual_height = document.getElementById('quote_tool').scrollHeight;
            parent.postMessage('{"type":"resize", "height":' + actual_height + '}', "*");
        });

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

            for (let i = 0; i < closeOverlays.length; i++) {
                closeOverlays[i].addEventListener('click', function (e) {
                    e.preventDefault();
                    e.target.parentElement.classList.add('display_none');
                });
            }

        }
    });

</script>
</div>
