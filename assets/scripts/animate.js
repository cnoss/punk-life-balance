import { animate, onScroll } from 'https://esm.sh/animejs';


document.documentElement.classList.add('js');

/* Animate Text ----------------------------------------------------------- */

const addAnimateText = () => {

  const textWrapper = document.querySelector('.textbox-content .letters');

  if(!textWrapper) return;

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

/* Mobile Menu ------------------------------------------------------------ */

const initMobileMenu = () => {
  const header = document.querySelector('.main-header');
  const toggleButton = document.querySelector('.menu-toggle');
  const menuPanel = document.getElementById('menu-panel');

  if (!header || !toggleButton || !menuPanel) return;

  const toggleText = toggleButton.querySelector('.menu-toggle__text');

  const setExpanded = (expanded) => {
    toggleButton.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    toggleButton.setAttribute('aria-label', expanded ? 'Menü schließen' : 'Menü öffnen');

    if (toggleText) {
      toggleText.textContent = expanded ? 'Schließen' : 'Menü';
    }

    header.classList.toggle('is-open', expanded);
  };

  const isExpanded = () => toggleButton.getAttribute('aria-expanded') === 'true';

  toggleButton.addEventListener('click', () => {
    setExpanded(!isExpanded());
  });

  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape') return;
    setExpanded(false);
  });

  document.addEventListener('click', (e) => {
    if (!isExpanded()) return;
    if (header.contains(e.target)) return;
    setExpanded(false);
  });

  menuPanel.addEventListener('click', (e) => {
    if (!e.target.closest('a')) return;
    setExpanded(false);
  });

  const mq = window.matchMedia('(min-width: 961px)');
  const onChange = (event) => {
    if (event.matches) setExpanded(false);
  };

  if (typeof mq.addEventListener === 'function') {
    mq.addEventListener('change', onChange);
  } else {
    mq.addListener(onChange);
  }
};

/* Main
############################################################################ */

document.addEventListener("DOMContentLoaded", (event) => {
  addAnimateText();
  initMobileMenu();
});

