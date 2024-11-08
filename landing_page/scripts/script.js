const appearElements = document.querySelectorAll(".appear");

const appearOnScroll = new IntersectionObserver(
  (entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("active");
        observer.unobserve(entry.target);
      }
    });
  },
  {
    threshold: 0.1,
  }
);

appearElements.forEach((element) => {
  appearOnScroll.observe(element);
});
function toggleDropdown() {
  const dropdownMenu = document.getElementById("dropdownMenu");
  const dropdownIcon = document.querySelector(".dropdown-icon");

  dropdownMenu.classList.toggle("show");
  dropdownIcon.classList.toggle("up");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropdown-icon') && !event.target.closest('.dropdown')) {
      const dropdowns = document.getElementsByClassName("dropdown-menu");
      const icons = document.getElementsByClassName("dropdown-icon");

      for (let i = 0; i < dropdowns.length; i++) {
          dropdowns[i].classList.remove("show");
      }

      for (let i = 0; i < icons.length; i++) {
          icons[i].classList.remove("up");
      }
  }
}  

// gak work, fix pls
function scrollToAbout(event) {
  if (event) event.preventDefault(); 

  if (!window.location.pathname.endsWith("index.php")) {
      window.location.href = "./index.php#about";
  } else {
      const aboutSection = document.getElementById("about");
      if (aboutSection) {
          aboutSection.scrollIntoView({ behavior: "smooth" });
      }
  }
}

document.addEventListener("DOMContentLoaded", function() {
  if (window.location.hash === "#about") {
      scrollToAbout(); 
  }
});

function toggleMenu() {
  const navLinks = document.getElementById("navLinks");
  navLinks.classList.toggle("active");
};