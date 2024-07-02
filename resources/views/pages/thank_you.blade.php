@extends('layouts/master')

@section('content')
    {{ $page->title('Thank You') }}
    @include('partials/selling_points_bar')
    <section class="thank_you">
        <div class="grid-container">
            <div class="grid-x">
                <div class="large-12">
                    <div class="content">
                        <h1>Thank You</h1>
                        <p>
                            Thank you for submitting your details. A member of the team will be in contact
                        </p>
                        <p>
                            <a class="button primary" href="{{route('page-home')}}"><i class="fa fa-chevron-left"></i> Go Back To Homepage</a>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        body {
            background:#ECECEC;
        }
        .thank_you .button {
            font-weight: bold;
            margin-top:2rem;

        }
        .masthead {
           padding-bottom:2rem;
        }
        .thank_you {
            background:#ECECEC;
            padding:2rem;
            margin-top:2rem;
        }
        footer {
            position: absolute;
        }

        .thank_you .content {
            background: #FFF;
            padding: 2rem;
            border-radius: 1rem;
        }

        #profitinstallations-body .masthead {
            padding-bottom: 1rem;
        }
        #profitinstallations-body .masthead + .selling_points_bar{
            margin-top:0;
        }
    </style>
@endsection
