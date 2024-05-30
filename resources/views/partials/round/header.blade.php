<header>
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-12">
                <div class="logo_container">
                    <a href="{{route('page-home')}}">
                        <img src="{{$config['logo']}}">
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<style>
    header {
        background:#FFFFFF;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
        border-top:5px solid #1A90D9;
        z-index:2;
        position: relative;
    }
    header .logo_container {
        padding:1rem 0;
    }
    header .logo_container img {
        height:80px;
    }
</style>
