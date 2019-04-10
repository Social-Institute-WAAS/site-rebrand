
// FIXED NAVBAR
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop + 0.5;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("fixed-top")
  } else {
    navbar.classList.remove("fixed-top");
  }
}

