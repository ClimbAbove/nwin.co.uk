<div class="field_container field_container_{{ $form_field->name }}">
    @if($form_field->label !== null && $form_field->label->getLocation() == 'before')
        <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
    @endif
    <input name="{{ $form_field->name }}" id="{{ $form_field->id }}" type="{{ $form_field->type }}"
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
    @if($form_field->label !== null && $form_field->label->getLocation() == 'after')
        <label for="{{ $form_field->id }}">{{ $form_field->label->getLabel() }}</label>
    @endif
</div>
