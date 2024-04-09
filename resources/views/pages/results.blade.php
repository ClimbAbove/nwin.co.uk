@extends('layouts/master')

@section('content')
    {{ $page->title('Your Results') }}
    @include('partials/selling_points_bar')

    <div class="grid-container">
        <div class="grid-x">
            <div class="large-12">

                <section class="results">

                    <h1>Hi {{ $data['name']['answer'] }}, We're Got Your Prices</h1>


                    <div class="result_row">
                        <div class="grid-container">
                            <div class="grid-x">
                                <div class="large-6">
                                    @switch($data['product_type']['answer'])
                                        @case('windows')
                                            <img src="/images/icons/door.svg" alt="Door">
                                        @break

                                    @endswitch
                                </div>
                                <div class="large-6">
                                    point
                                </div>
                            </div>
                        </div>


                    </div>


                </section>
            </div>
        </div>
    </div>

    @include('partials/what_happens_next')

    <style>
        section.results h1 {
            font-size:3rem;
        }

    </style>
@endsection
