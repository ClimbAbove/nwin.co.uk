<footer>
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-6 medium-6 small-12 hide-for-small-only">
                <div class="logo_container">
                    <a href="{{route('page-home')}}">
                        <img src="{{$config['logo']}}">
                    </a>
                </div>
            </div>
            <div class="large-3 medium-3 small-12">
                <div class="block links">

                </div>
            </div>
            <div class="large-3 medium-3 small-12">
                <div class="block address">
                    <p class="title">
                        Contact
                    </p>
                    <hr>
                    <p class="content">
                        {!! implode('<br>',$address) !!}
                    </p>
                </div>
            </div>
            <div class="large-6 small-12 show-for-small-only">
                <div class="logo_container">
                    <a href="{{route('page-home')}}">
                        <svg width="80" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 161.809 201.567" fill="none">
                            <path stroke="#" stroke-miterlimit="10" stroke-width="4" d="M3 3h156v217H3z"/>
                            <g fill="#FFF">
                                <path fill="#FFFFFF" d="M23.378 156.347c.224.03.425.086.604.168s.35.197.514.346c.164.149.35.351.559.604l15.467 19.559a40.889 40.889 0 0 1-.134-1.822 32.761 32.761 0 0 1-.045-1.665v-17.233h6.661v32.567H43.07c-.581 0-1.073-.09-1.475-.269s-.79-.506-1.163-.983l-15.356-19.401c.045.566.082 1.121.112 1.665s.045 1.055.045 1.531v17.457h-6.661v-32.567h3.979c.327-.002.604.013.827.043zM49.91 156.302h6.348c.656 0 1.204.149 1.643.447s.727.693.86 1.185l4.471 16.987c.148.552.297 1.141.446 1.767.149.625.261 1.281.335 1.967.149-.7.313-1.36.492-1.979s.35-1.203.514-1.755l5.275-16.987c.135-.417.421-.793.861-1.129.439-.335.972-.503 1.598-.503h2.235c.655 0 1.196.146 1.62.437.425.29.719.689.883 1.195l5.23 16.987c.164.522.336 1.077.514 1.666.18.588.336 1.218.471 1.889.118-.656.241-1.282.368-1.878.126-.596.257-1.154.392-1.677l4.47-16.987c.119-.432.402-.812.85-1.14.446-.328.983-.492 1.609-.492h5.946l-10.059 32.567h-6.84l-6.125-20.185a34.848 34.848 0 0 1-.324-1.027c-.111-.373-.22-.768-.324-1.186-.104.418-.212.813-.324 1.186-.111.372-.22.715-.324 1.027l-6.213 20.185h-6.84L49.91 156.302zM108.518 188.869h-7.6v-32.567h7.6v32.567zM119.357 156.347c.223.03.424.086.604.168.178.082.35.197.514.346.164.149.35.351.559.604l15.468 19.559a40.889 40.889 0 0 1-.134-1.822 32.761 32.761 0 0 1-.045-1.665v-17.233h6.661v32.567h-3.935c-.58 0-1.072-.09-1.475-.269s-.79-.506-1.162-.983l-15.356-19.401c.045.566.082 1.121.112 1.665.029.544.045 1.055.045 1.531v17.457h-6.662v-32.567h3.979c.327-.002.604.013.827.043z"/>
                            </g>
                            <path fill="#FFF" d="M87 86h56v56H87zM19 86h57v56H19zM87 19h56v56H87zM19 19h57v56H19z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="small-12">
                <p class="content copyright">
                    &copy; Copyright {{ \Carbon\Carbon::now()->format('Y') }} {{ $config['company_name'] }} is a private limited company registered in England and Wales, UK Company Reg No. {{ $config['company_number'] }}. VAT No. {{ $config['vat_number'] }}.
                </p>
            </div>
        </div>
    </div>
</footer>
{!! $page->addCSS('<link rel="stylesheet" href="/assets/css/partials/footer.min.css">','bottom') !!}
