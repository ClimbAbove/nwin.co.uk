<div class="selling_points_bar">
    <div class="grid-container">
        <div class="grid-x">
            <div class="small-12">
                <ul class="hide-for-small-only2">
                    <li  class="scroll visible">
                        <img src="/images/icons/white/pound-sign.svg">
                        <span>100% Fixed Prices Quote</span>
                    </li>
                    <li  class="scroll">
                        <img src="/images/icons/white/uk-flag.svg">
                        <span>Made in Britain</span>
                    </li>
                    <li  class="scroll">
                        <img src="/images/icons/white/tag.svg">
                        <span>Price Beater Promise</span>
                    </li>
                    <li  class="scroll">
                        <img src="/images/icons/white/rosette-plain.svg">
                        <span>FENSA Installers</span>
                    </li>
                </ul>

                <ul class="show-for-small-only2 text_scroller">
                    <li  class="scroll visible">
                        <img src="/images/icons/white/pound-sign.svg">
                        <span>100% Fixed Prices Quote</span>
                    </li>
                    <li  class="scroll">
                        <img src="/images/icons/white/uk-flag.svg">
                        <span>Made in Britain</span>
                    </li>
                    <li  class="scroll">
                        <img src="/images/icons/white/tag.svg">
                        <span>Price Beater Promise</span>
                    </li>
                    <li  class="scroll">
                        <img src="/images/icons/white/rosette-plain.svg">
                        <span>FENSA Installers</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    .selling_points_bar {
        background:#21427f;
        margin-top:1rem;
        padding:0.8rem;
    }
    .selling_points_bar ul {
        display: flex;
        flex-direction: row;
        margin:0;
        padding:0;
        justify-items: center;
        align-items: center;
        justify-content: space-between;
        list-style: none;
    }
    .selling_points_bar ul li {
        color:#FFFFFF;
        display: flex;
        flex-direction: row;

    }
    .selling_points_bar ul li img {
        display: inline-block;
        height:18px;
        margin-right:0.4rem;
    }
    .selling_points_bar ul li span {
        font-weight: bold;
        font-size: 1rem;
        line-height: 1.1rem;
    }

    .selling_points_bar .hide-for-small-only2 {

        display: flex;
    }

    .selling_points_bar .show-for-small-only2 {
        display: none;
    }

    @media print, screen and (max-width: 50em) {

        .selling_points_bar .hide-for-small-only2 {
            display: none !important;
        }

        .selling_points_bar .show-for-small-only2 {
            display: flex;
        }

        .selling_points_bar {
            padding-bottom: 0.6rem;
        }
        .selling_points_bar ul {
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .selling_points_bar ul li {
            display: flex !important;
            flex-direction: row;
            align-content: center;
            align-items: center;
            justify-content: center;
            justify-items: center;
            width:100%;
            position: absolute;
        }
        .selling_points_bar ul li span {
            font-weight: bold;
            font-size:1.2rem;
        }
        .selling_points_bar ul li img {
            display: inline-block;
            height:20px;
            margin-right:0.4rem;
        }

    }
</style>
