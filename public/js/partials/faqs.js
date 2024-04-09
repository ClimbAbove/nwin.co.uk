let qas = document.getElementsByClassName('qas');
if(qas.length) {
    for(let i = 0; i < qas.length; i++) {
        let dts = qas[i].getElementsByTagName('dt');
        for(let d = 0; d < dts.length; d++) {
            let as = dts[d].getElementsByTagName('a');
            for(let a = 0; a < as.length; a++) {
                as[a].addEventListener('click', function(e) {
                    e.preventDefault();
                    let answer = as[a].parentNode.nextElementSibling;
                    if(answer.classList.contains('display_none')) {
                        answer.classList.remove('display_none');
                        dts[i].classList.add('open');

                    } else {
                        answer.classList.add('display_none');
                        dts[i].classList.remove('open');
                    }
                    return false;
                });
            }
        }
    }
}
