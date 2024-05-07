<section class="masonry_grid">
    @foreach($masonry as $brick)
        <div class="brick" style="order: 0; background: url({{$brick['image']}})">
            <div class="overlay"></div>
            <div class="text">
                {{$brick['text']}}
            </div>
            <div class="sub_text">
                <div class="overlay"></div>
                <p>{{$brick['sub_text']}} some sub text</p>
            </div>
        </div>
    @endforeach

    <style>
        section.masonry_grid  {
            display:grid;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: start;
            justify-items: stretch;
            grid-column-gap: 0.5rem;
            grid-row-gap: 0.5rem;
            cursor: pointer;
            padding:0.5rem;
        }
        section.masonry_grid .brick {
            height:400px;
            display:flex;
            flex-direction: column;
            justify-items: flex-end;
            align-content: flex-end;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        section.masonry_grid .brick .text {
            padding:1rem;
            font-size:2rem;
            color:#FFFFFF;
            font-weight:bold;
            text-shadow: 1px 0 1px rgba(0,0,0,0.8)
        }

        section.masonry_grid .brick .sub_text {
            position:absolute;
            bottom:-100px;
            color:#FFFFFF;
            width:100%;
            transition: position .3s, top .3s, bottom .3s;
            padding:1rem;
        }
        section.masonry_grid .brick .sub_text .overlay {
            background: rgba(0,0,0,0.5);
            background: linear-gradient(0deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.02) 100%);

            position: absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
        }

        section.masonry_grid .brick .sub_text p {
            position: absolute;
            top:0;
            left:0;
            padding:1rem;
            width:100%;
            height:100%;
            background: #ececec;
            padding:1rem;
            color:#333333;
            opacity: 0.9;
        }
        section.masonry_grid .brick .sub_text.active {

        }

        @media print, screen and (max-width: 1024px) {
            section.masonry_grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media print, screen and (max-width: 700px) {
            section.masonry_grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        let mg = document.getElementsByClassName('masonry_grid');
        if(mg.length) {
            for(let i = 0; i < mg.length; i++) {
                let bricks = mg[i].getElementsByClassName('brick');
                let mgHeight = mg[i].offsetHeight;
                for(let j = 0; j < bricks.length; j++) {
                    let bBottom = bricks[j].offsetTop + bricks[j].offsetHeight;
                    bricks[j].addEventListener('mouseover', function() {
                        let t = this.getElementsByClassName('text');
                        let tBottom = t[0].offsetTop + t[0].offsetHeight;
                        t[0].style.marginTop = "-2rem";
                        let st = this.getElementsByClassName('sub_text');
                        if(st.length) {
                            st[0].classList.add('active');
                            st[0].style.top = tBottom + 'px';
                        }
                    });
                    bricks[j].addEventListener('mouseout', function() {
                        let t = this.getElementsByClassName('text');
                        let st = this.getElementsByClassName('sub_text');
                        if(st.length) {
                            t[0].style.marginTop = "0";
                            st[0].classList.remove('active');
                            st[0].style.top = bBottom + 'px';
                        }
                    });
                }

                let mgh = mg[i].offsetHeight;

            }
        }


    </script>
</section>
