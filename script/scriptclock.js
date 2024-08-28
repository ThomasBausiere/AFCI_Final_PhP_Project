"use strict";

//?---------------Déclaration des constantes et des variables---//

    //-------------Déclaration des constantes-------------------//
const deg= 6;
const
h = document.querySelector("#hr"),
m = document.querySelector("#mn"),
s = document.querySelector("#sc");
    //-------------Déclaration des variables--------------------//

setInterval(timed);

function timed() {
    let date= new Date();
    let hh =date.getHours()*30;
    let mm =date.getMinutes()*deg;
    let ss =date.getSeconds()*deg;

    h.style.transform =`rotateZ(${hh+(mm/12)}deg)`;
    m.style.transform =`rotateZ(${mm}deg)`;
    s.style.transform =`rotateZ(${ss}deg)`;
    
};