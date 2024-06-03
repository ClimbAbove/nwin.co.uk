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
$show_phone = false;
if(($contact_mode ?? null) === 'telephone') {
   $show_phone = true;
}

@endphp

<div class="cta_wrapper">

    @if($show_phone === true)
        <div class="cta_container double">
        <a class="button primary cta double" href="{{$cta_href}}">{{$cta_text}} 👉</a>
    @else
                <div class="cta_container single">
        <a class="button primary cta single" href="{{$cta_href}}">{{$cta_text}} 👉</a>
    @endif
    @if($show_phone === true)
        <a class="button secondary cta ghost open_dialog cta_telephone" href="tel:{{$telephone['international'] }}" data-dialog="dialog_book">
            Talk to an Expert
            <i class="fa fa-phone"></i>
        </a>
    @endif
                </div>
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
