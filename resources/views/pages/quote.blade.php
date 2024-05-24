@extends('layouts/master')

@section('content')
    {{ $page->title('Get Your Quote') }}
    @include('partials/selling_points_bar')
    @include('partials/quote_form')
@endsection
<style>



     .loading_text {
         margin-bottom: 0.5rem;
         font-weight: bold;
     }
      .loader {
          width: 120px;
          height: 22px;
          border-radius: 40px;
          color: #514b82;
          border: 2px solid;
          position: relative;
          margin:auto;
      }
    .loader::before {
        content: "";
        position: absolute;
        margin: 2px;
        width: 25%;
        top: 0;
        bottom: 0;
        left: 0;
        border-radius: inherit;
        background: currentColor;
        animation: l3 1s infinite linear;
    }

     label {
         font-weight: bold;
     }
    @keyframes l3 {
        50% {left:100%;transform: translateX(calc(-100% - 4px))}
    }

 @media print, screen and (max-width: 700px) {
     .comp {
         border-top-left-radius: 1rem;
         border-top-right-radius: 1rem;
         border-bottom-left-radius: 0;
         border-bottom-right-radius: 0;
     }
 }
    @media print, screen and (max-width: 40em) {
        .masthead .cta_container {
            display:none !important;
        }
    }
</style>
