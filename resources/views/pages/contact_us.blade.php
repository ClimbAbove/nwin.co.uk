@extends('layouts/master')

@section('content')
    {{ $page->title('Contact Us') }}

    <section class="contact_us">
        <div class="grid-container">
            <div class="grid-x">
                <div class="large-12">
                    <div>
                    <h1>Get In Touch</h1>
                    @include('forms/contact_form', ['form' => $form])
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        h1 {
            font-family: 'Lato Black', sans-serif;
        }
        footer {

        }

        .contact_us {
            background: url('/images/repeat-modified.png') repeat;
            background-size:50%;
            background-color: #151515;
            text-align: left;
        }

        .contact_us .large-12 > div {
            background: white;
            border-radius: 0.4rem;

        }

        .contact_us .field_container {
            margin-bottom:0.5rem;
        }
        #send {
            text-align:right;
            align-self: center;
        }

    </style>
@endsection

