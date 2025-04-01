import ScrollEffects from './components/scrollEffects.js';

document.addEventListener('DOMContentLoaded', function () {
  document.body.classList.remove('kodeks-load')
})

new ScrollEffects({
    elements: document.querySelectorAll('.fade-me'),
    margin: '0px',
    threshold: 0
})

document.getElementById('menu-toggle').addEventListener('click', function () {
    var body = document.getElementById("top");
    var bigmenu = document.getElementById("dropdown-menu");
	var menuIcon = document.getElementById("menu-toggle");
	body.classList.toggle("menu-open");
    bigmenu.classList.toggle("open");
	menuIcon.classList.toggle("close");
});