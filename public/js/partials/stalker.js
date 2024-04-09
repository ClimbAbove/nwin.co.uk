document.addEventListener("DOMContentLoaded", () => {

    let lastKnownScrollPosition = 0;
    let ticking = false;
    let boundary = 10;
    let stalker = document.getElementById('stalker');

    if(document.getElementsByClassName('hero_container').length) {
        let hero = document.getElementsByClassName('hero_container');
        boundary = (hero[0].offsetTop + hero[0].offsetHeight / 3);
    }

    function doScroll(lastKnownScrollPosition, boundary) {

        if(lastKnownScrollPosition >= boundary) {
            stalker.classList.remove('display_none');
        } else {
            stalker.classList.add('display_none');
        }
    }

    document.addEventListener('scroll', (event) => {
        lastKnownScrollPosition = window.scrollY;
        if(!ticking) {
            window.requestAnimationFrame(() =>{
                doScroll(lastKnownScrollPosition, boundary);
                ticking = false;
            });
            ticking = true;
        }
    });
});
