@extends('layouts/master')

@section('content')
    {{ $page->title('Your Results') }}
    @include('partials/selling_points_bar')

    <section class="section quotes">
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-12">

                <section class="results">




                    <div class="result_row">
                        <div class="grid-container">
                            <div class="grid-padding-x">
                                <div class="cells small-12 text-center">
                                    <h1>Hi {{ $data['name']['answer'] }}, We're Got Your Prices</h1>
                                </div>
                                <div class="cells large-6 medium-12 small-12 image">

                                    @switch($data['product_type']['answer'])
                                        @case('new_conservatory')
                                            <img src="/images/icons/conservatory.svg" alt="Icon">
                                        @break
                                        @case('doors')
                                            <img src="/images/icons/door.svg" alt="Icon">
                                        @break
                                        @case('conservatory_roof')
                                            <img src="/images/icons/conservatory-roof.svg" alt="Icon">
                                        @break
                                        @case('windows')
                                            <img src="/images/icons/windows.svg" alt="Icon">
                                        @break
                                        @case('conservatory_repair')
                                            <img src="/images/icons/conservatory-repair.svg" alt="Icon">
                                        @break
                                        @case('orangeries')
                                            <img src="/images/icons/orangery.svg" alt="Icon">
                                            @break
                                        @default

                                            <img src="/images/icons/windows.svg" alt="Icon">
                                        @break
                                    @endswitch
                                </div>
                                <div class="cells large-6 medium-12 small-12 detail">
                                    <p style="text-align: center; font-weight: bold">We can supply and install your new {{ str_replace(['-','_', 'new'], '', $data['product_type']['answer']) }}</p>
                                    <div class="price_container">
                                        <div class="text">From as little as</div>
                                        <div class="price">£599</div>
                                        <div class="vat">Fully Fitted, Including VAT</div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>


                </section>
            </div>
        </div>
    </div>
    </section>



    <style>
        section.quotes {
            background:#ececec;
        }
        section.results h1 {
            font-size:3rem;
        }
        .image {
            text-align: center;
            border:1px solid #21427f;
            border-radius: 1rem;
            margin-bottom: 2rem;
        }
        .detail {
            background:#2299dd;
            padding:1rem;
            border-radius: 1rem;
            color:#FFFFFF;
            font-size:1.2rem;
        }
        .result_row {
            background:#FFF;
            padding:2rem;
            border-radius: 1rem;
        }
        .price_container {

            font-family: lato;
            font-weight: bold;
            background: #21427f;
            padding:1rem;
            border-radius: 1rem;
            text-align: center;
        }
        .price_container .text {
            font-size:2rem;
            font-family: lato;
            font-weight: bold;
        }
        .price_container .price {
            font-size:4rem;
            font-family: lato;
            font-weight: bold;
        }
        .price_container .vat {
            font-size:1rem;
        }
    </style>
@endsection
