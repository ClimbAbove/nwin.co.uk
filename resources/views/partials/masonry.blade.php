<div class="masonry-with-columns" id="masonry-with-columns" style="height: 1802px;">
    @foreach($masonry as $brick)
        <div class="brick" style="order: 0; background: url({{$brick['image']}})">
            <div class="overlay"></div>
            <div class="text">
                {{$brick['text']}}
                <div class="sub_text">
                    {{$brick['sub_text']}} some sub text
                </div>
            </div>
        </div>
    @endforeach


</div>

<style>
    .masonry-with-columns {
        padding-top: 15px;
    }
    .masonry-with-columns .overlay {
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 2;
        background: linear-gradient(0deg, rgba(0,0,0,0.15) 0%, rgba(255,255,255,0.1) 100%);
    }
    .masonry-with-columns {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        max-height: 1200px;
    }
    .masonry-with-columns .brick  {
            flex: 1 0 auto;
            color: white;
            margin: 0 1rem 1rem 0;
            text-align: center;
            font-family: "Lato",;
            font-weight: 900;
            font-size: 2rem;
            background-size: cover !important;;
            background-repeat: no-repeat !important;
            background-position: center center !important;;
    }

    @for($i = 1; $i <= 9; $i++)
        .masonry-with-columns .brick:nth-child({{$i}}) {
            @php
            $h = (rand(200, 400) + 0);
            @endphp
            height: {{$h}}px;
            line-height: {{$h}}px;
            overflow: hidden;
        }
    @endfor

    .masonry-with-columns .brick {
        position: relative;
    }

    .masonry-with-columns .brick:hover .overlay{
        background: linear-gradient(0deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.01) 100%);
    }
    .masonry-with-columns .brick .text {
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
        line-height: 3rem;
        font-size: 2rem;
        height: 0;
        transition: transform 0.35s;
        cursor: pointer;
        text-shadow: 1px 0 1px rgba(0,0,0,0.8);
        z-index:3;
        transform: translate3d(0, -75px, 0);
    }
    .masonry-with-columns .brick:hover .text {
        height:fit-content;
        max-height:100%;
        transform: translate3d(0, -80px, 0);

    }
    .masonry-with-columns .brick .text .sub_text {
        font-size:1.4rem;
        padding:1rem 0;
    }

    @media print, screen and (max-width: 1024px) {
        .masonry-with-columns .brick {
            max-width: 50%;
            width: 50%;
        }
    }
    @media print, screen and (max-width: 700px) {
        .masonry-with-columns .brick {
            max-width: 100%;
            width: 100%;
        }
    }
</style>
<script>

    function reportWindowSize()
    {
        let numCols = 3;

        const colHeights = Array(numCols).fill(0);
        const container = document.getElementById('masonry-with-columns');
        console.log('resize'+window.innerWidth);
        if( window.innerWidth < 1025) {
            numCols = 2;
        }
console.log(getChildNodes(container));console.log(numCols);
        Array.from(container.children).forEach((child, i) => {
            const order = i % numCols;
            child.style.order = order;
            colHeights[order] += parseFloat(child.clientHeight);
        })
        container.style.height = Math.max(...colHeights) + 'px';
    }

    reportWindowSize();
    window.addEventListener("resize", reportWindowSize);

</script>
