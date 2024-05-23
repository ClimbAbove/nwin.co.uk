@php
if(($cta_text ?? null) === null) {
    $cta_text = 'Find Prices Now!';
}

if(($cta_href ?? null) === null) {
   $cta_href = '/quote';
}

if(($scrolling_text_data ?? null) === null) {
    $scrolling_text_data = [
        'Great service',
        'Local & Friendly',
        'Leading Prices',
    ];
}

if(($show_phone ?? null) === null) {
$show_phone = true;
}

@endphp
<div class="cta_container">
    <a class="button primary cta" href="{{$cta_href}}">{{$cta_text}} 👉</a>

    @if($show_phone)
    <a class="button secondary cta ghost">
        Talk to an Expert
        <i class="fa fa-phone"></i>
    </a>
    @endif

    @if(($scrolling_text_enabled  ?? false) === true && count($scrolling_text_data))
        <div class="text_scroller">
            @foreach($scrolling_text_data as $index => $text)
                @if($index == 0)
                    <span class="scroll visible">{{$text}}</span>
                @else
                    <span class="scroll">{{$text}}</span>
                @endif
            @endforeach
        </div>
    @endif
</div>
