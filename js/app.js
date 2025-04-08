import ScrollEffects from './components/scrollEffects.js';

document.addEventListener('DOMContentLoaded', function () {
  document.body.classList.remove('kodeks-load')
});

// Fade me
document.querySelectorAll('.fade-me').forEach(e => {
  new ScrollEffects({
    el: e,
    reload: false, 
    parallaxEl: e.querySelector('.move-me'),
    parallaxPercentage: 50,
  })
});

let currentScrollPosition = 0;

// Menu toggle behavior
document.getElementById('menu-toggle').addEventListener('click', function () {
  var body = document.getElementById("top");
  var bigmenu = document.getElementById("dropdown-menu");
  var menuIcon = document.getElementById("menu-toggle");

  // When opening the menu
  if (!bigmenu.classList.contains("open")) {
    currentScrollPosition = window.scrollY || window.pageYOffset;

    body.style.position = "fixed";
    body.style.top = `-${currentScrollPosition}px`; 
    body.style.width = "100%";
    body.style.overflow = "hidden";
  }

  // Toggle menu open and close
  body.classList.toggle("menu-open");
  bigmenu.classList.toggle("open");
  menuIcon.classList.toggle("close");

  // When the menu is being closed
  if (!bigmenu.classList.contains("open")) {
    body.style.position = "";
    body.style.top = "";
    body.style.overflow = "";

    window.scrollTo(0, currentScrollPosition);
  }
});

// Add event listener for menu links
var menuLinks = document.querySelectorAll("#dropdown-menu a"); 
menuLinks.forEach(function(link) {
  link.addEventListener("click", function(event) {
    if (this.getAttribute("href").startsWith("#")) {
      event.preventDefault();

      // Get the target anchor element
      var targetId = this.getAttribute("href").substring(1);
      var targetElement = document.getElementById(targetId);

      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop,
          behavior: "smooth"
        });
      }

      // Close the menu
      var body = document.getElementById("top");
      var bigmenu = document.getElementById("dropdown-menu");
      var menuIcon = document.getElementById("menu-toggle");
      body.classList.remove("menu-open");
      bigmenu.classList.remove("open");
      menuIcon.classList.remove("close");

      // Remove the fixed position and restore the scroll position
      body.style.position = "";
      body.style.top = "";
      body.style.overflow = "";
    }
  });
});

// --------- Smooth scroll anchor links ---------
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
      e.preventDefault();

      if (window.location.pathname !== "/") {
          window.location.href = '/' + this.getAttribute('href');
      } else {
          document.querySelector(this.getAttribute('href')).scrollIntoView({
              behavior: 'smooth'
          });
      }
  });
});

window.addEventListener('load', function () {
  if (window.location.hash) {
      document.querySelector(window.location.hash).scrollIntoView({
          behavior: 'smooth'
      });
  }
});

// --------- Scroll-up header ---------
const headerDiv = document.querySelector('.site-header');
let lastScrollTop = 0;
let delta = 35;

if (window.scrollY === 0) {
  headerDiv.classList.add('top');
  headerDiv.classList.remove('scrolling');
}

document.addEventListener('scroll', function () {
  let scrollTop = document.scrollingElement.scrollTop;

  if (Math.abs(lastScrollTop - scrollTop) <= delta) return;

  if (scrollTop > lastScrollTop) {
    headerDiv.style.transform = 'translateY(-100%)'; 
  } else if (scrollTop < lastScrollTop) {
    headerDiv.style.transform = 'translateY(0)';
  }
  
  lastScrollTop = (scrollTop <= 0) ? 0 : scrollTop;
});

headerDiv.style.transition = 'transform 0.3s ease-out'; 


