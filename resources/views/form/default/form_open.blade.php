<form novalidate name="{{ $form->name }}" id="{{ $form->id }}" action="{{ $form->action }}" enctype="{{ $form->enctype }}" method="{{ $form->method }}"
@if($classes = $form->getClassList())
   class="{{ $classes }}"
@endif
@if($data = $form->getData())
    @foreach($data ?? [] as $k => $v)
        {{$k}}="{{$v}}"
    @endforeach
@endif
>
