document.addEventListener("DOMContentLoaded", () => {

    let sectorsSections = document.getElementsByClassName('sectors');
    let initSectorsArray = [];
    let workingSectorsArray = [];
    for (let ss = 0; ss < sectorsSections.length; ss++) {
        let sectors = document.getElementsByClassName('sector');
        for (let s = 0; s < sectors.length; s++) {
            initSectorsArray.push(s);
            workingSectorsArray.push(s);
            sectors[s].classList.add('blah');
        }
        randomRoll(sectors);
        setInterval(randomRoll, 3000, sectors);
    }

    function randomRoll(sectors) {
        let existingOlds = sectors[0].parentNode.getElementsByClassName('old');
        if (existingOlds.length) {
            existingOlds[0].classList.remove('old');
        }
        for (let s = 0; s < sectors.length; s++) {
            if (sectors[s].classList.contains('highlight')) {
                let index = workingSectorsArray.indexOf(s);
                workingSectorsArray.splice(index, 1);
                sectors[s].classList.remove('highlight');
            }
        }
        if (workingSectorsArray.length <= 0) {
            workingSectorsArray = initSectorsArray;
        }
        let random = Math.floor(Math.random() * (workingSectorsArray.length - 1));
        sectors[random].classList.add('highlight');
    }
});
