@if($form_field->label !== null && $form_field->label->getLocation() == 'before')
    <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
@endif
@foreach($form_field->options->getOptions() as $index => $option)

    <input name="{{ $form_field->name }}_{{$index}}" id="{{ $form_field->id }}_{{ $index }}" type="checkbox" value="{{$option->getValue()}}"
         @if($classes = $form_field->getClassList())
            class="{{ $classes }}"
         @endif

         @if($form_field->selected_value == $option->getValue())
               checked="checked"
         @endif

        @foreach($form_field->getAttributes() ?? [] as $k => $v)
            @if($v !== null)
                {{$k}}="{{$v}}"
            @else
                {{$k}}
            @endif
        @endforeach
    />
    <label for="{{$form_field->id}}_{{$index}}">{{$option->getLabel()}}</label>

@endforeach

@if($form_field->label !== null && $form_field->label->getLocation() == 'after')
    <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
@endif
