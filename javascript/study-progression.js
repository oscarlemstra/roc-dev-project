"use strict";

const hamburger = document.querySelector(".hamburger");
const hamburgerMenu = document.querySelector(".hamburger-menu");
const profile = document.querySelector(".profile");
const profileMenu = document.querySelector(".profile-menu");
const progression = document.querySelector(".progression");
let accordion = document.getElementsByClassName("subject-container");
let currentAccordion;

let procent = progression.textContent;

window.addEventListener("resize", function () {
  if (window.innerWidth > 1024) {
    hamburgerMenu.style.display = "none";
  }
});

progression.style.background = `linear-gradient(to right, #ee7326 ${procent}, #b7b7b7 0 )`;

profile.addEventListener("click", openProfileMenu);

function openProfileMenu() {
  profileMenu.style.display = "flex";
  profile.addEventListener("click", closeProfileMenu);
  profile.removeEventListener("click", openProfileMenu);
}

function closeProfileMenu() {
  profileMenu.style.display = "none";
  profile.addEventListener("click", openProfileMenu);
  profile.removeEventListener("click", closeProfileMenu);
}

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

for (
  currentAccordion = 0;
  currentAccordion < accordion.length;
  currentAccordion++
) {
  accordion[currentAccordion].addEventListener("click", function () {
    this.classList.toggle("active");
    let panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
      /*      accordion[currentAccordion].setAttribute("style","borderBottomLeftRadius: 10px;")
      accordion[currentAccordion].setAttribute("style","borderBottomRightRadius: 10px;")*/
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
      /*      accordion[currentAccordion].setAttribute("style","borderBottomLeftRadius: 0;")
      accordion[currentAccordion].setAttribute("style","borderBottomRightRadius: 0;")*/
    }
  });
}
