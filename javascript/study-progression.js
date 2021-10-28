const hamburger = document.getElementsByClassName('hamburger');
const hamburgerMenu = document.getElementsByClassName('hamburger-menu');

hamburger.addEventListener(openHamburgerMenu, 'click')
function openHamburgerMenu() {
    hamburgerMenu.style.display = 'block';
    hamburger.addEventListener(closeHamburgerMenu, 'click');
    hamburger.removeEventListener(openHamburgerMenu, 'click');
}

function closeHamburgerMenu() {
    hamburgerMenu.style.display = 'none';
    hamburger.addEventListener(openHamburgerMenu, 'click');
    hamburger.removeEventListener(closeHamburgerMenu, 'click');
}