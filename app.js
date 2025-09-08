/* .......................start navbar ...................... */
const menuToggle = document.getElementById("menu-toggle");
const menuClose = document.getElementById("menu-close");
const navLink = document.getElementById("nav-link");

menuToggle.addEventListener("click", () => {
  navLink.classList.add("show");
  menuToggle.style.display = "none";
  menuClose.style.display = "block";
});

menuClose.addEventListener("click", () => {
  navLink.classList.remove("show");
  menuToggle.style.display = "block";
  menuClose.style.display = "none";
});

window.addEventListener("resize", () => {
  if (window.innerWidth > 768) {
    navLink.classList.remove("show");
    menuToggle.style.display = "none";
    menuClose.style.display = "none";
  } else {
    menuToggle.style.display = "block";
    menuClose.style.display = "none";
  }
});
/* .......................end navbar...................... */




/* .......................start voiture zome...................... */
window.onload = function() {
const image = document.getElementById('loupe');

image.addEventListener('mousemove', function(e) {
    const rect = image.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const xPercent = (x / rect.width) * 100;
    const yPercent = (y / rect.height) * 100;

    image.style.transformOrigin = `${xPercent}% ${yPercent}%`;
    image.style.transform = "scale(2)";
});

image.addEventListener('mouseleave', function() {
    image.style.transform = "scale(1)";
    });
};
/* .......................end voiture zome...................... */





/* .......................start contact input...................... */
const inputs = document.querySelectorAll(".input");

function focusFunc() {
  let parent = this.parentNode;
  parent.classList.add("focus");
}

function blurFunc() {
  let parent = this.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  input.addEventListener("focus", focusFunc);
  input.addEventListener("blur", blurFunc);
});
/* .......................start contact input...................... */








