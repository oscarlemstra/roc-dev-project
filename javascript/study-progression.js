const hamburger = document.querySelector(".hamburger");
const hamburgerMenu = document.querySelector(".hamburger-menu");

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
