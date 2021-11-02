const hamburger = document.querySelector(".hamburger");
const hamburgerMenu = document.querySelector(".hamburger-menu");
let accordion = document.getElementsByClassName("subject-container")
let currentAccordion;

hamburger.addEventListener("click", openHamburgerMenu);

function openHamburgerMenu() {
  hamburgerMenu.style.display = "flex";
  hamburger.addEventListener("click", closeHamburgerMenu);
  hamburger.removeEventListener("click", openHamburgerMenu);
}

function closeHamburgerMenu() {
  hamburgerMenu.style.display = "none";
  hamburger.addEventListener("click", openHamburgerMenu);
  hamburger.removeEventListener("click", closeHamburgerMenu);
}

for (currentAccordion = 0; currentAccordion < accordion.length; currentAccordion++) {
  accordion[currentAccordion].addEventListener("click", function() {
    this.classList.toggle("active");
    let panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}