import { animate, onScroll } from 'https://esm.sh/animejs';


/* Animate Text ----------------------------------------------------------- */

const addAnimateText = () => {

  const textWrapper = document.querySelector('.textbox-content .letters');
  const body = document.querySelector('body');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  animate('.textbox-content .letter', {
    scale: [0, 1],
    opacity: [0, 1],
    duration: 1500,
    elasticity: 1600,
    loop: true,
    loopDelay: 2000,
    easing: "easeOutExpo",
    delay: (el, i) => 45 * (i + 1),
    autoplay: onScroll({ body, textWrapper })
  });

};

/* Main
############################################################################ */

document.addEventListener("DOMContentLoaded", (event) => {
  addAnimateText()
});

