@if($form_field->label !== null && $form_field->label->getLocation() == 'before')
    @if($form_field->label->escape)
        <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
    @else
        <label for="{{ $form_field->id }}">{!! $form_field->label->getLabel() !!}</label>
    @endif
@endif

<select name="{{ $form_field->name }}" id="{{ $form_field->id }}"
        @if($classes = $form_field->getClassList())
            class="{{ $classes }}"
@endif
@foreach($form_field->data ?? [] as $k => $v)
    {{$k}}="{{$v}}"
@endforeach
value="{{$form_field->value}}"
@foreach($form_field->getAttributes() ?? [] as $k => $v)
    @if($v !== null)
        {{$k}}="{{$v}}"
    @else
        {{$k}}
    @endif
@endforeach
>

@foreach($form_field->options->getOptions() as $option)
    <option
        @if($form_field->selected_value == $option->getValue())
            selected="selected"
        @endif
        value="{{$option->getValue()}}">{{$option->getLabel()}}
    </option>
@endforeach

</select>

@if($form_field->label !== null && $form_field->label->getLocation() == 'after')
    @if($form_field->label->escape)
        <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
    @else
        <label for="{{ $form_field->id }}">{!! $form_field->label->getLabel() !!}</label>
    @endif
@endif
