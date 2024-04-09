<button name="{{ $form_field->name }}" id="{{ $form_field->id }}"  class="button
@if($classes = $form_field->getClassList())
   {{ $classes }}
@endif
"
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
>{{$form_field->value}}</button>
