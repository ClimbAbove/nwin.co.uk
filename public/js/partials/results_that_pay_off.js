document.addEventListener("DOMContentLoaded", () => {
    let lastKnownScrollPosition = 0;
    let counting = false;
    let boundary = 10;
    if(document.getElementsByClassName('results_that_pay_off').length) {
        let calc = document.getElementsByClassName('results_that_pay_off');
        boundary = (calc[0].offsetTop) - (window.innerHeight - (calc[0].offsetTop / 2));
    }

    function countUp(lastKnownScrollPosition, boundary) {
        if(lastKnownScrollPosition >= boundary) {
            runAnimations();
            document.removeEventListener('scroll', eventCountUp);
        }
    }
    //    document.addEventListener('scroll', eventCountUp);

    function eventCountUp(event) {
        lastKnownScrollPosition = window.scrollY;
        if(!counting) {
            window.requestAnimationFrame(() =>{
                countUp(lastKnownScrollPosition, boundary);
                counting = false;
            });
            counting = true;
        }
    }

});
