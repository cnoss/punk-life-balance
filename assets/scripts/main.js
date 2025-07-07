/* Functions
############################################################################ */

/* Cookie Consent ---------------------------------------------------------- */
const addCookieConsentGUI = () => {

  window.addEventListener('cc:onChange', ({detail}) => {
    window.location.reload();
  });


  window.addEventListener('cc:onModalHide', ({detail}) => {
    window.location.reload();
  });

  const cookieButton = document.querySelector("[data-js-cookies]");

  if (!cookieButton) return;

  cookieButton.addEventListener("click", (event) => {
    event.preventDefault();
    CookieConsent.show(true);
    console.log(document.body.style.containerType);
    document.body.style.containerType = "normal";
  });

  window.addEventListener('cookieConsentModalHide', () => {
    document.body.style.containerType = "inline-size";
  });
};

/* Menue ------------------------------------------------------------------ */
const addMenuGUI = () => {

  const menuButton = document.querySelector("[data-js-menu]");
  const menu = document.querySelector("[data-js-menu-state]");

  if (!menuButton) return;

  menuButton.addEventListener("click", (event) => {
    event.preventDefault();
    menuButton.classList.toggle("is-open");

    const menuState = menu.dataset.jsMenuState === "menu-is-open" ? "menu-is-closed" : "menu-is-open";
    menu.dataset.jsMenuState = menuState;
  });
};

/* Bottom Back Button ------------------------------------------------------ */
const addBottomBackButton = () => {
  const bottomBackButton = document.querySelector("[data-js-back]");

  if (!bottomBackButton) return;

  bottomBackButton.addEventListener("click", (event) => {
    event.preventDefault();
    window.history.back();
  });
};

/* Add YouTube Video ------------------------------------------------------ */

const addCookieConsentForVideo = (videoId) => {

  const cookieButton = document.querySelector("[data-js-change-cookie-settings='" + videoId + "']");
  if (!cookieButton) return;

  cookieButton.addEventListener("click", (event) => {
    event.preventDefault();
    CookieConsent.show("true");
    document.body.style.containerType = "normal";
  });
};

const addVideo = (videoItem) => {

  const videoId = videoItem.dataset.jsAddYoutubeVideo;
  const cookieContent = CookieConsent.getCookie();

  if (!cookieContent || !cookieContent.categories){ addCookieConsentForVideo(videoId); return; }

  const cookieNecessary = cookieContent.categories.includes('necessary');
  const cookieFunctionality = cookieContent.categories.includes('functionality');

  if (!cookieFunctionality){
    const cookieRequiredInfo = videoItem.querySelector("[data-js-cookie-required-info='" + videoId + "']");

    if (!cookieRequiredInfo) return;
    cookieRequiredInfo.classList.remove("is-hidden");

    addCookieConsentForVideo(videoId);

    return;
  }

  const videoElement = document.createElement("iframe");
  videoElement.setAttribute("width", "560");
  videoElement.setAttribute("height", "315");
  videoElement.setAttribute("src", `https://www.youtube.com/embed/${videoId}`);
  videoElement.setAttribute("frameborder", "0");
  videoElement.setAttribute("allow", "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture");
  videoElement.setAttribute("allowfullscreen", "");

  videoItem.appendChild(videoElement);
  videoItem.dataset.state="loaded";
}

const addYouTubeVideo = () => {
  const videoItems = document.querySelectorAll("[data-js-add-youtube-video]");

  if (!videoItems.length === 0) return;

  videoItems.forEach((videoItem) => {
    addVideo(videoItem);
  });

};



/* Main
############################################################################ */

document.addEventListener("DOMContentLoaded", (event) => {
  addCookieConsentGUI()
  addMenuGUI();
  addBottomBackButton();
  addYouTubeVideo();
});

