@if($form_field->label !== null && $form_field->label->getLocation() == 'before')
    @if($form_field->label->escape)
        <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
    @else
        <label for="{{ $form_field->id }}">{!! $form_field->label->getLabel() !!}</label>
    @endif
@endif
<div class="radio_options_container radio_option_container_quote_type_{{ $form_field->name }}">
    @foreach($form_field->options->getOptions() as $index => $option)
        <div class="radio_option_container radio_option_container_quote_type_{{ $form_field->name }}">
            <input name="{{ $form_field->name }}" id="{{ $form_field->id }}-{{ $index }}" type="radio" value="{{$option->getValue()}}"
                   @if($classes = $form_field->getClassList())
                       class="{{ $classes }}"
            @endif

            @if($form_field->selected_value == $option->getValue())
                 checked="checked"
            @endif

            @foreach($form_field->data ?? [] as $k => $v)
                {{$k}}="{{$v}}"
            @endforeach
            @foreach($form_field->getAttributes() ?? [] as $k => $v)
                @if($v !== null)
                    {{$k}}="{{$v}}"
                @else
                    {{$k}}
                @endif
            @endforeach
            />
            <label class="radio_option_label" for="{{$form_field->id}}-{{$index}}">{{$option->getLabel()}}</label>
        </div>
    @endforeach
</div>
@if($form_field->label !== null && $form_field->label->getLocation() == 'after')
    @if($form_field->label->escape)
        <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
    @else
        <label for="{{ $form_field->id }}">{!! $form_field->label->getLabel() !!}</label>
    @endif
@endif
