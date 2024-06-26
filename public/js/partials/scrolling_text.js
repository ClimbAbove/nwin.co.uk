window.addEventListener("load", function(event) {

    let textScrollers = document.getElementsByClassName('text_scroller');

    if (textScrollers.length > 0) {

        for (let i = 0; i < textScrollers.length; i++) {
            let textScroller = textScrollers[i];
            let textsToScroll = textScroller.getElementsByClassName('scroll');
            let textsToScrollCount = textsToScroll.length;
            let textSpacerCount = textScroller.getElementsByClassName('spacer').length;

            if (textsToScroll.length) {
                let j = 1;
                if (textsToScroll <= 0) {
                    let j = 0;
                }

                setInterval(function () {

                    textScroller.classList.add('loaded');

                    let currentText = textsToScroll[j];
                    let prevText = currentText;

                    if (j > 0) {
                        prevText = textsToScroll[j - 1];
                    } else if (j === 0) {
                        prevText = textsToScroll[textsToScrollCount - 1];
                    }

                    prevText.classList.remove('visible');
                    prevText.classList.add('transition_out');

                    if (textSpacerCount <= 0) {
                        let spacer = document.createElement("span");
                        spacer.classList.add('spacer');
                        spacer.style.width = textsToScroll[j].offsetWidth;
                        spacer.style.height = (textsToScroll[j].offsetHeight) + 'px';
                        textsToScroll[textsToScrollCount - 1].after(spacer);
                        textSpacerCount = 1;
                    }

                    let spacer = textScroller.getElementsByClassName('spacer');
                    spacer[0].style.width = textsToScroll[j].offsetWidth;
                    spacer[0].style.height = (textsToScroll[j].offsetHeight) + 'px';
                    currentText.classList.add('visible');
                    setTimeout(function () {
                        prevText.classList.remove('transition_out');
                    }, 1400);

                    if (j >= (textsToScrollCount - 1)) {
                        j = 0;
                    } else {
                        j++;
                    }
                }, 2000);

            }


        }
    }

});
