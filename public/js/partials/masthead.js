document.addEventListener("DOMContentLoaded", () => {

    const hamburger = document.getElementById('hamburger');
    const navigation = document.getElementById('navigation');
    const icons = document.querySelectorAll('.icon');

    hamburger.addEventListener('click', function () {
        if (this.classList.contains('open')) {
            this.classList.remove('open');
            navigation.classList.remove('open');
            enableScroll();
        } else {
            this.classList.add('open');
            navigation.classList.add('open');
            disableScroll();
        }
    });


    icons.forEach(icon => {
        icon.addEventListener('click', (event) => {
            icon.classList.toggle("open");
        });
    });


    function disableScroll() {

        scrollTop =
            window.pageYOffset ||
            document.documentElement.scrollTop;
        scrollLeft =
            window.pageXOffset ||
            document.documentElement.scrollLeft,

            window.onscroll = function () {
                window.scrollTo(scrollLeft, scrollTop);
            };
    }

    function enableScroll() {
        window.onscroll = function () {
        };
    }


    let as = document.getElementsByTagName('a');

    for (let i = 0; i < as.length; i++) {


        if (as[i].hash) {
            as[i].addEventListener('click', function(e) {
                e.preventDefault()

                let anc = document.getElementById(as[i].hash.replace('#',''));
                anc.scrollIntoView({ behavior: "smooth", block: "end", inline: "nearest" });
            });

        }

    }

});
