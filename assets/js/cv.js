(function () {
  "use strict";

  var navLinks = document.querySelectorAll(".cv-sidebar .nav-link[href^='#']");
  var sections = [];

  navLinks.forEach(function (link) {
    var id = link.getAttribute("href");
    if (id && id.length > 1) {
      var el = document.querySelector(id);
      if (el) sections.push({ link: link, el: el });
    }
  });

  function setActiveNav() {
    var scrollY = window.scrollY + 120;
    var current = sections[0];

    sections.forEach(function (item) {
      if (item.el.offsetTop <= scrollY) {
        current = item;
      }
    });

    navLinks.forEach(function (l) {
      l.classList.remove("active");
    });

    if (current) {
      current.link.classList.add("active");
    }
  }

  navLinks.forEach(function (link) {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      var target = document.querySelector(link.getAttribute("href"));
      if (target) {
        target.scrollIntoView({ behavior: "smooth", block: "start" });
        if (window.innerWidth < 992 && typeof $ !== "undefined") {
          $("body").removeClass("sidebar-open");
        }
      }
    });
  });

  window.addEventListener("scroll", setActiveNav, { passive: true });
  setActiveNav();
})();
