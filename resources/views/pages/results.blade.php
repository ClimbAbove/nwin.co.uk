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
                                        @case('garden_room')
                                            <img src="/images/icons/garden-room.svg" alt="Icon">
                                            @break
                                        @case('roof_line')
                                            <img src="/images/icons/roof-line.svg" alt="Icon">
                                            @break
                                        @default
                                            <img src="/images/icons/windows.svg" alt="Icon">
                                        @break
                                    @endswitch
                                </div>
                                <div class="cells large-6 medium-12 small-12 detail">

                                    @if($data['product_type']['answer'] == 'conservatory_repair')
                                        <p style="text-align: center; font-weight: bold">We can undertake your {{ str_replace(['-','_', 'new'], ' ', $data['product_type']['answer']) }}</p>
                                    @else
                                        <p style="text-align: center; font-weight: bold">We can supply and install your new {{ str_replace(['-','_', 'new'], '', $data['product_type']['answer']) }}</p>
                                    @endif


                                    <div class="price_container">
                                        <div class="text">From as little as</div>


                                        @switch($data['product_type']['answer'])
                                            @case('new_conservatory')
                                                <div class="price">£14,995</div>
                                                @break
                                            @case('doors')
                                                <div class="price">£995</div>
                                                @break
                                            @case('conservatory_roof')
                                                <div class="price">£2,995</div>
                                                @break
                                            @case('windows')
                                                <div class="price">£495</div>
                                                @break
                                            @case('conservatory_repair')
                                                <div class="price">£499</div>
                                                @break
                                            @case('orangeries')
                                                <div class="price">£29,995</div>
                                                @break
                                            @case('garden_room')
                                                <div class="price">£14,995</div>
                                                @break
                                            @case('roof_line')
                                                <div class="price">£1995</div>
                                                @break
                                            @default

                                                @break
                                        @endswitch


                                        <div class="vat">Fully Fitted, Including VAT</div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>


                </section>





                <section class="what_happens_next {{$section_class ?? ''}}">
                    <div class="grid-container">
                        <div class="grid-x">
                            <div class="cells large-12 medium-12 small-12">
                                <h2>What happens next?</h2>
                            </div>
                            <div class="cells large-4 medium-12 small-12">
                                <div class="step cell large-4">
                                    <div class="number">1</div>
                                    <div class="image_container">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 350 350">


                                            <path fill="none" stroke="#21427F" stroke-width="4" stroke-linecap="round" stroke-miterlimit="10" d="M246.104,298.646	c0.179,2.744-1.922,5.135-4.666,5.313l-131.692,8.555c-2.744,0.178-5.135-1.922-5.313-4.666L87.967,54.316	c-0.178-2.744,1.921-5.135,4.665-5.313l131.692-8.552c2.744-0.178,5.135,1.921,5.313,4.665L246.104,298.646z"/>
                                            <path fill="none" stroke="#21427F" stroke-width="4" stroke-miterlimit="10" d="M89.5,80L230,70.5"/><path fill="none" stroke="#525252" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M316.313,75.813c13.54-9.014,33.95,5.661,21.146,26.854l0,0h-74.764l0.591-0.039c-8.562-0.147-15.453-7.131-15.453-15.726 c0-8.687,7.042-15.729,15.729-15.729c2.715,0,4.67,0.445,6.897,1.655l0,0c3.317-8.889,12.896-15.453,22.94-15.453	c11.184,0,20.534,7.845,22.85,18.333 M63.693,188.046c10.649-7.09,26.702,4.452,16.632,21.12l0,0H21.523l0.464-0.03	c-6.733-0.114-12.154-5.608-12.154-12.368c0-6.832,5.539-12.371,12.371-12.371c2.135,0,3.674,0.351,5.426,1.303l0,0	c2.61-6.991,10.143-12.154,18.043-12.154c8.796,0,16.151,6.17,17.971,14.419"/>
                                            <path fill="#21427F" d="M180.677,164.147c-0.857-1.409-2.906-2.466-4.552-2.348l-20.128,1.444c-1.646,0.118-3.483,1.473-4.083,3.01 l-10.172,26.065c-0.6,1.537-0.994,4.142-0.876,5.787l0.507,7.059c0.118,1.646,1.562,2.896,3.207,2.777l50.424-3.62 c1.646-0.118,2.896-1.562,2.777-3.207l-0.507-7.059c-0.118-1.646-0.917-4.146-1.774-5.555L180.677,164.147z"/>
                                            <circle fill="#FFFFFF" cx="167.89" cy="183.829" r="8.992"/>
                                            <path fill="#21427F" d="M146.163 171.363L132.355 172.354 131.76 164.057 148.299 160.974z"/>
                                            <path fill="#21427F" stroke="#21427F" stroke-linecap="round" stroke-miterlimit="10" d="M165.216,149.76 c-18.859,1.354-28.96,6.605-33.205,14.457l-0.013,0.001l16.11-2.714l-0.112,0.006c-0.231-1.927,7.859-3.932,17.729-4.64 L165.216,149.76z"/>
                                            <path fill="#21427F" d="M187.266 168.413L201.071 167.421 200.478 159.124 183.668 158.436z"/>
                                            <path fill="#21427F" stroke="#21427F" stroke-linecap="round" stroke-miterlimit="10" d="M165.322,149.752 c18.86-1.353,29.608,2.402,34.929,9.566l0.014-0.001l-16.334-0.386l0.112-0.01c-0.047-1.94-8.34-2.769-18.21-2.061 L165.322,149.752z"/>
                                            <path fill="none" stroke="#21427F" stroke-width="4" stroke-linecap="round" stroke-miterlimit="10" d="M74.222 47.507c-.517-7.297 4.97-13.62 12.267-14.137M64.423 48.503c-.909-12.836 8.742-23.958 21.578-24.866M258.934 301.809c.477 7.3-5.044 13.592-12.345 14.068M268.737 300.866c.839 12.841-8.873 23.909-21.714 24.747"/>
                                            <g fill="#21427F">
                                                <path d="M170.096 274.659l-1.244.091c-.14.01-.257-.017-.352-.08s-.166-.146-.214-.246l-.775-1.717-3.585.262-.517 1.813c-.025.093-.082.183-.171.265-.088.083-.199.13-.335.14l-1.25.091 2.765-8.901 1.646-.121L170.096 274.659zM164.256 271.801l2.759-.201-1.265-2.801c-.057-.125-.121-.272-.191-.44-.07-.17-.141-.354-.212-.554-.041.208-.081.401-.123.581-.041.18-.082.337-.125.473L164.256 271.801zM171.378 265.874c.049.002.092.011.131.026.04.016.079.039.116.07.038.031.082.073.13.126l4.965 5.454c-.027-.139-.048-.273-.063-.408-.016-.133-.027-.257-.036-.373l-.385-5.26 1.418-.104.634 8.653-.832.061c-.127.009-.235-.003-.321-.036-.087-.034-.174-.101-.262-.199l-4.945-5.431c.021.127.04.254.055.378.015.126.026.24.034.343l.389 5.314-1.418.104-.634-8.653.844-.062C171.269 265.873 171.33 265.872 171.378 265.874zM184.155 266.513c-.038.091-.085.156-.14.196s-.123.063-.203.068c-.079.006-.171-.017-.275-.072-.104-.055-.228-.115-.368-.182-.141-.065-.305-.121-.491-.171-.187-.048-.402-.063-.65-.046-.223.017-.415.059-.577.124-.161.065-.295.151-.402.254-.106.105-.183.226-.229.364-.047.138-.063.286-.052.445.015.204.084.369.207.496.124.127.283.232.478.314.194.081.414.151.659.21s.495.122.751.188c.256.068.508.149.754.246.248.096.472.224.673.383.199.161.366.362.498.605.133.243.211.544.237.903.029.391-.011.762-.119 1.112-.109.351-.283.662-.521.936-.239.271-.538.493-.899.666-.36.174-.779.276-1.258.312-.275.02-.549.015-.82-.021-.271-.034-.533-.093-.786-.175-.252-.081-.49-.184-.714-.309-.223-.123-.426-.266-.605-.424l.41-.807c.039-.059.089-.109.148-.152s.126-.066.202-.071c.1-.008.21.025.332.099.122.074.265.153.43.242s.357.166.576.231c.22.066.479.089.779.066.458-.033.805-.169 1.04-.404.235-.234.338-.558.309-.964-.017-.228-.087-.409-.211-.544-.124-.137-.284-.244-.479-.329-.194-.084-.414-.15-.658-.201-.245-.05-.494-.106-.747-.168s-.503-.14-.75-.234c-.248-.095-.472-.224-.673-.391-.2-.165-.368-.378-.5-.64-.135-.26-.215-.588-.244-.983-.022-.314.017-.627.121-.936.104-.309.268-.586.492-.836.224-.25.507-.456.848-.621.341-.166.737-.266 1.188-.298.511-.038.987.007 1.43.136s.826.324 1.149.589L184.155 266.513zM185.021 264.866l1.352-.099c.141-.011.259.015.358.073.098.06.166.144.207.253l1.852 5.067c.045.125.088.262.129.409.041.148.081.304.122.47.02-.17.043-.331.07-.484.026-.151.056-.293.092-.425l1.32-5.3c.024-.095.082-.183.17-.265.088-.083.199-.13.335-.14l.474-.035c.139-.01.258.015.354.073.097.061.166.145.211.253l2.066 5.053c.105.249.202.526.29.834.016-.158.034-.311.054-.456s.04-.281.063-.408l1.093-5.283c.02-.102.076-.192.167-.271.09-.078.202-.123.338-.133l1.264-.093-2.054 8.851-1.454.106-2.323-5.774c-.03-.074-.062-.154-.093-.239-.033-.086-.064-.179-.096-.276-.017.101-.034.197-.055.287-.02.089-.038.173-.057.251l-1.477 6.052-1.454.106L185.021 264.866zM203.804 263.491l.094 1.281-3.835.281.176 2.398 3.021-.222.091 1.239-3.021.222.18 2.447 3.835-.281.094 1.287-5.457.399-.634-8.653L203.804 263.491zM207.249 268.54l.247 3.381-1.61.118-.634-8.653 2.64-.193c.59-.043 1.101-.02 1.53.071.43.092.788.236 1.072.437.286.199.503.447.649.742.149.298.237.629.264.996.021.291-.001.568-.068.835-.067.266-.173.509-.319.733-.146.224-.332.423-.557.6-.227.177-.488.324-.784.442.212.102.399.254.563.458l2.4 3.037-1.448.106c-.14.01-.261-.01-.362-.058-.102-.049-.19-.123-.266-.222l-2.022-2.638c-.076-.099-.155-.167-.24-.205-.086-.038-.208-.05-.366-.039L207.249 268.54zM207.164 267.385l1.005-.073c.303-.022.564-.08.784-.173.221-.092.398-.21.534-.354.136-.145.233-.312.291-.5.059-.188.079-.393.063-.612-.032-.439-.201-.766-.508-.979-.306-.214-.757-.3-1.351-.256l-1.029.075L207.164 267.385z"/>
                                            </g>
                                            <path fill="none" stroke="#21427F" stroke-miterlimit="10" d="M209.805 250.6L209.941 250.589"/>
                                            <path fill="none" stroke="#21427F" stroke-width="2" stroke-miterlimit="10" d="M211.25,284.709l-76.628,5.571l-2.497-34.349	l77.658-5.645l0.105,0.017c9.755-0.188,17.819,7.36,18.014,16.861c0.182,8.988-6.742,16.506-15.749,17.451L211.25,284.709z"/>
                                            <ellipse fill="#21427F" cx="133.666" cy="273.067" rx="18.054" ry="18.265"/>
                                            <path fill="none" stroke="#21427F" stroke-miterlimit="10" d="M212.414 284.625L211.25 284.709"/>
                                            <path fill="none" stroke="#FFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M139.365 267.835L133.276 278.307 127.967 275.88"/>

                                        </svg>
                                    </div>
                                    <h3>Step One</h3>
                                    <h6>We'll be in touch</h6>
                                    <p>
                                        An expert will call you to discuss your exact requirements.
                                    </p>

                                </div>
                            </div>


                            @switch($data['product_type']['answer'])
                                @case('new_conservatory')
                                    <div class="step cell large-4">
                                        <div class="number">2</div>
                                        <div class="image_container">
                                            <img src="/images/icons/conservatory.svg" alt="Icon">
                                        </div>
                                        <h3>Step Two</h3>
                                        <h6>You Choose</h6>
                                        <p>
                                            You can choose to accept your fixed price quote
                                        </p>
                                    </div>
                                    @break
                                @case('doors')
                                    <div class="step cell large-4">
                                        <div class="number">2</div>
                                        <div class="image_container">
                                            <img src="/images/icons/door.svg" alt="Icon">
                                        </div>
                                        <h3>Step Two</h3>
                                        <h6>You Choose</h6>
                                        <p>
                                            You select from the options we provide
                                        </p>
                                    </div>

                                    @break
                                @case('conservatory_roof')
                                    <div class="step cell large-4">
                                        <div class="number">2</div>
                                        <div class="image_container">
                                            <img src="/images/icons/conservatory-roof.svg" alt="Icon">
                                        </div>
                                        <h3>Step Two</h3>
                                        <h6>You Choose</h6>
                                        <p>
                                            You select from the options we provide
                                        </p>
                                    </div>

                                    @break
                                @case('windows')

                                    <div class="step cell large-4">
                                        <div class="number">2</div>
                                        <div class="image_container">
                                            <img src="/images/icons/windows.svg" alt="Icon">>
                                        </div>
                                        <h3>Step Two</h3>
                                        <h6>You Choose</h6>
                                        <p>
                                            You can choose to accept your fixed price quote
                                        </p>
                                    </div>
                                    @break
                                @case('conservatory_repair')
                                    <div class="step cell large-4">
                                        <div class="number">2</div>
                                        <div class="image_container">
                                            <img src="/images/icons/conservatory-repair.svg" alt="Icon">
                                        </div>
                                        <h3>Step Two</h3>
                                        <h6>You Choose</h6>
                                        <p>
                                            You select from the options we provide
                                        </p>
                                    </div>

                                    @break
                                @case('orangeries')
                                    <div class="step cell large-4">
                                        <div class="number">2</div>
                                        <div class="image_container">
                                            <img src="/images/icons/orangery.svg" alt="Icon">
                                        </div>
                                        <h3>Step Two</h3>
                                        <h6>You Choose</h6>
                                        <p>
                                            You can choose to accept your fixed price quote
                                        </p>
                                    </div>

                                    @break
                                @case('garden_room')
                                    <div class="step cell large-4">
                                        <div class="number">2</div>
                                        <div class="image_container">
                                            <img src="/images/icons/garden-room.svg" alt="Icon">
                                        </div>
                                        <h3>Step Two</h3>
                                        <h6>You Choose</h6>
                                        <p>
                                            You select from the options we provide
                                        </p>
                                    </div>

                                    @break
                                @case('roof_line')
                                    <div class="step cell large-4">
                                        <div class="number">2</div>
                                        <div class="image_container">
                                            <img src="/images/icons/roof-line.svg" alt="Icon">
                                        </div>
                                        <h3>Step Two</h3>
                                        <h6>You Choose</h6>
                                        <p>
                                            You can choose to accept your fixed price quote
                                        </p>
                                    </div>

                                    @break
                                @default
                                    <div class="step cell large-4">
                                        <div class="number">2</div>
                                        <div class="image_container">
                                            <img src="/images/icons/windows.svg" alt="Icon">
                                        </div>
                                        <h3>Step Two</h3>
                                        <h6>You Choose</h6>
                                        <p>
                                            You select from the options we provide
                                        </p>
                                    </div>

                                    @break
                            @endswitch



                            <div class="step cell large-4">
                                <div class="number">3</div>
                                <div class="image_container">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 550 550">
                            <path fill="none" stroke="#21427F" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M185.667 134.667c.833.833 2.167 1.833 10 2.667"/>
                                        <path fill="none" stroke="#21427F" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M366 135h1.195c26.334-8 24.383 17.44 24.938 13.438l-.334-1.979c4.5 26.167-13.469 49.542-30.604 49.542l-.375.083c-2.25 52.5-24.293 92.917-83.292 91.917h-1.861c-59 1-81.042-39.417-83.292-91.917l-.375-.167c-17.135 0-35.104-23.333-30.604-49.5l-.333 2C161.618 152.419 159.667 127 186 135h1"/>
                                        <path fill="#21427F" stroke="#21427F" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M371.43 134.151c-1.027.225-3.605.506-4.734.849h0c1.638-88-10.695-80.667-52.362-80.667l-.334-.666c-1-3.333 1.333-6.333 9.667-15-29.11 0-46.833 5-52.167 8.333l-.5.333C283.667 40 280.167 31.833 295 22l-.5-1.5c-85.5 10-106.5 14-106 114.5H187a40.235 40.235 0 0 0-4.483-1.101l5.149.767c.833.833 2.167 1.833 10 2.667l1-.333c1.167-1.5 11.167-1.333 19.167-45l.167-.333c0-8.015 106.334-3.833 116-5.333 10 26.167 14.833 50.833 22.333 51.333h0c5.278 0 7.886-1.461 10.374-2.646l-13.04 2.645"/>
                                        <path fill="#21427F" stroke="#21427F" stroke-width="4" stroke-miterlimit="10" d="m329.133 449.988-18.789-2.979-2.979-18.789 10.974-10.973 3.806-3.806c-6.953-.746-14.169 1.544-19.498 6.873-7.736 7.736-9.07 19.446-4.009 28.556l-33.304 33.238 19.32-.03 23.596-23.596c9.109 5.063 20.522 3.429 28.257-4.307 5.081-5.08 7.4-11.875 6.959-18.521l-3.359 3.36-10.974 10.974z"/>
                                        <path fill="none" stroke="#21427F" stroke-width="8" stroke-linecap="round" stroke-miterlimit="10" d="M202 527v-46h148v46"/>
                                        <path fill="none" stroke="#21427F" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m152.5 527.657.167-91.903c12.16 0 24.333-8.605 24.333-20.909V415 315l34.833-2.411C147.221 312.589 61.062 335.486 62 384v-1 144M211.833 312.589c14.667 7.539 29.073 15.078 65.001 15.078M401.413 527.657l-.124-91.903c-12.16 0-24.289-8.605-24.289-20.909V415 315l-34.832-2.411C406.779 312.589 493 335.486 492 384v-1 144M341.994 312.589c-14.668 7.539-29.073 15.078-65.002 15.078"/>
                                        <path fill="none" stroke="#21427F" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M344 313v82c0 3.3-2.7 6-6 6H218c-3.3 0-6-2.7-6-6v-82M62 528h430"/>

                    </svg>
                                </div>
                                <h3>Step Three</h3>
                                <h6>Book Installation</h6>
                                <p>
                                    @switch($product ?? 'all')
                                        @case('heat_pump')
                                            When we start installing Heat Pumps in your area we'll arrange your installation to be undertaken by our local, experienced and friendly engineers.
                                            @break

                                        @default
                                            We'll arrange your installation to be undertaken by our local, experienced and friendly engineers.
                                            @break
                                    @endswitch

                                </p>
                            </div>
                        </div>
                    </div>

                    <style>
                        section.what_happens_next {
                            text-align: center;
                            font-family: "lato";
                        }
                        section.what_happens_next h2 {
                            font-size: 3rem;
                            margin-bottom: 0.5rem;
                            font-family: "lato";
                        }
                        section.what_happens_next .step {
                            position: relative;
                            padding: 0 2rem;
                        }
                        section.what_happens_next .step .number {
                            position: absolute;
                            width: 4.4rem;
                            height: 4.4rem;
                            border-radius: 2.2rem;
                            color: #FFFFFF;
                            display: flex;
                            flex-direction: column;
                            background: #000;
                            justify-content: center;
                            font-family: "lato";
                            font-weight: bold;
                            font-size: 2.2rem;
                        }
                        section.what_happens_next .step .image_container {
                            height:300px;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            justify-items: center;
                            align-content: center;
                            align-items: center;
                        }
                        section.what_happens_next .step .image_container img {
                            width:60%;
                            }

                        section.what_happens_next .step h3 {
                            font-size: 1.1rem;
                            font-family: "lato";
                        }
                        section.what_happens_next .step h6 {
                            font-weight: bold;
                            font-size: 1.4rem;
                            font-family: "lato";
                        }


                        @media print, screen and (max-width: 1023px) {

                            section.what_happens_next {
                                display: grid;
                                grid-template-columns: 1fr;
                            }

                            xsection.what_happens_next .step {
                                width:35%;
                                margin:auto;
                            }
                            section.what_happens_next .step .image_container {
                                height:auto;
                                max-width:320px;
                                margin:auto;
                            }

                        }

                       @media print, screen and (max-width: 500px) {
                           section.results {
                               padding:0 0;
                           }
                           section.results h1 {
                               font-size:1.6rem !important;
                           }
                           .result_row {
                               padding:1rem !important;;
                           }
                        }



                    </style>



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
