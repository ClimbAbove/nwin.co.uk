@if($breadcrumbs_dto)
    <div class="breadcrumbs">
        @foreach($breadcrumbs_dto as $breadcrumbs_dtos)
            @foreach($breadcrumbs_dtos as $index => $breadcrumb_dto)
                @if(($index + 1) < $breadcrumbs_dto->getBreadcrumbCount())
                    <a href="{{$breadcrumb_dto->url}}">{{$breadcrumb_dto->text}}</a>
                    <span>
                        <img src="/images/flares/chevron.svg">
                    </span>
                @else
                    <span>{{$breadcrumb_dto->text}}</span>
                @endif
            @endforeach
        @endforeach
    </div>

    <style>
        .breadcrumbs {
            padding-top:1rem;
        }
        .breadcrumbs a {
            color: var(--ca-tertiary);
        }
        .breadcrumbs span {
            font-weight:bold;
            font-size:0.9rem;
        }
        .breadcrumbs img {
            height:1.2rem;
        }
    </style>
@endif
