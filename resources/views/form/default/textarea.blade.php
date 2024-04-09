<div class="field_container">
    @if($form_field->label !== null && $form_field->label->getLocation() == 'before')
        <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
    @endif
    <textarea
        name="{{ $form_field->name }}" id="{{ $form_field->id }}" type="{{ $form_field->type }}"
        @if($classes = $form_field->getClassList())
            class="{{ $classes }}"
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
    >{{$form_field->value}}</textarea>
    @if($form_field->label !== null && $form_field->label->getLocation() == 'after')
        <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
    @endif
</div>
