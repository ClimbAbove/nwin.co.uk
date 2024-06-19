@php

    if(($cta_text ?? null) === null) {
        $cta_text = 'Find Out Prices Now!';
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


//50p
    if(($contact_mode ?? null) === 'telephone') {
       //$show_phone = false;
    }

@endphp

<div class="cta_wrapper">

    @if(($show_phone ?? false) === true)
        <div class="cta_container double">
    @else
        <div class="cta_container single">
    @endif

    @if(($show_phone ?? false) === true)
        <a class="button primary cta double" href="{{$cta_href}}">{{$cta_text}} 👉
        @if($seconds ?? false)
            <span>It takes less than 60 seconds</span>
        @endif
        </a>
    @else
        <a class="button primary cta single" href="{{$cta_href}}">{{$cta_text}} 👉</a>
    @endif

        @if(($show_phone ?? false) === true)
            <a class="button secondary cta ghost open_dialog cta_telephone" href="tel:{{$telephone['international'] }}" data-dialog="dialog_book">
                <span style="display: block; font-size:1rem; margin-top:0;">

                    <i class="fa fa-phone"></i>
                </span>
            </a>
            <a class="display_none minimal button secondary cta ghost open_dialog cta_telephone" href="tel:{{$telephone['international'] }}" data-dialog="dialog_book">
                <i class="fa fa-phone"></i>
            </a>
        @endif

    </div>

    @if(($scrolling_text_enabled ?? false) === true && count($scrolling_text_data))
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
