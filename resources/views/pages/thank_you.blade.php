@extends('layouts/master')

@section('content')
    {{ $page->title('Thank You') }}
    @include('partials/selling_points_bar')
    <section class="thank_you">
        <div class="grid-container">
            <div class="grid-x">
                <div class="large-12 medium-12 small-12">
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
            min-height:600px;
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

        @media print, screen and (max-width: 640px) {
            h1 {
                font-size:2.4rem;
            }
            footer {
                position: static;
            }
            .thank_you {
                padding:2rem 1rem;
                min-height:300px;
            }

        }
        @media print, screen and (max-width: 450px) {
            .thank_you {
                padding:2rem 1rem;
                min-height:300px;
            }
            .content .button {
                width:100%;
                font-size:0.9rem;
            }
            .thank_you .content {
                padding:1rem;
            }
        }
    </style>
@endsection
