new Glide('.testimonials_glide', {
    type: 'carousel',
    startAt: 0,
    perView: 3,
    focusAt: 'center',
    autoplay: 3000,
    rewind: false,
    gap:0,
    hoverpause: true,
    breakpoints: {
        860: {
            perView: 1
        },
        1400: {
            perView: 2
        },
        1680: {
            perView: 2,
            peek: {
                before:200,
                after:200
            }
        },
        3600: {
            perView: 3,
            gap:0,
            peak: {
                before: 200,
                after: 200
            }
        },
    }
}).mount();
