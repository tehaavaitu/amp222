(function ($) {
  "use strict";

  // MENU DE NAVIGATION  Lorsqu'un lien dans le menu de navigation est cliqué, le menu est réduit.
  $(".navbar-collapse a").on("click", function () {
    $(".navbar-collapse").collapse("hide");
  });

  const navbarToggler = document.getElementById("navbar-toggler");

  // Ajoutez un écouteur d'événements pour le clic
  // navbarToggler.addEventListener("click", function (event) {
  // Empêchez le comportement par défaut du clic (développement du menu)
  //   event.preventDefault();
  // });

  // LIENS Défilement fluide
  $(".smoothscroll").click(function () {
    var el = $(this).attr("href");
    var elWrapped = $(el);
    var header_height = $(".navbar").height();

    scrollToDiv(elWrapped, header_height);
    return false;

    function scrollToDiv(element, navheight) {
      var offset = element.offset();
      var offsetTop = offset.top;
      var totalScroll = offsetTop - 0;

      $("body,html").animate(
        {
          scrollTop: totalScroll,
        },
        300
      );
    }
  });

  // CAROUSEL plugin jQuery, carrousel réactif avec un nombre d'éléments variable en fonction de la taille de l'écran et inclut des fonctionnalités telles que le centrage, la boucle, les marges et la lecture automatique
  $(document).ready(function () {
    $(".owl-carousel").owlCarousel({
      center: true,
      loop: true,
      margin: 30,
      autoplay: true,
      responsiveClass: true,
      responsive: {
        0: {
          items: 2,
        },
        767: {
          items: 3,
        },
        1200: {
          items: 4,
        },
      },
    });
  });
})(jQuery);

// defilement poisson
const poisson = document.getElementById("poisson");
        poisson.addEventListener("animationiteration", () => {
            // À chaque itération de l'animation (une fois qu'elle est terminée),
            // choisissez une nouvelle position verticale aléatoire pour le poisson.
            const randomTop = Math.random() * 60 + 20; // Position verticale aléatoire entre 20% et 80% de la hauteur de la fenêtre.
            poisson.style.top = `${randomTop}%`;
        });

        poisson.addEventListener("animationend", () => {
            // L'animation est terminée, supprimer l'élément du DOM
            poisson.remove();
        });

// TOP BUTTON
const scrollButton = document.getElementById("scroll-to-top-button");
scrollButton.addEventListener("click", scrollToTop);

window.addEventListener("scroll", toggleScrollButtonVisibility);

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

function toggleScrollButtonVisibility() {
  console.log("toggleScrollButtonVisibility called");
  if (window.scrollY > 100) {
    scrollButton.style.opacity = "1";
    scrollButton.style.visibility = "visible";
  } else {
    scrollButton.style.opacity = "0";
    scrollButton.style.visibility = "hidden";
  }
}

// FORMULAIRE DE CONTACT
window.addEventListener("DOMContentLoaded", (event) => {
document.getElementById("subject").addEventListener("change", function () {
  var selectedOption = this.value;
  if (selectedOption === "Autres") {
    document.getElementById("other-details").style.display = "block";
    document.getElementById("message-wrapper").style.display = "none";
  } else {
    document.getElementById("other-details").style.display = "none";
    document.getElementById("message-wrapper").style.display = "block";
  }
})
});

// AFFICHAGE MOT DE PASSE
function changer(id) {
  let e = document.getElementById(id);
  let eyeId = "eye" + id;
  if (e.getAttribute("type") === "password") {
    e.setAttribute("type", "text");
    document.getElementById(eyeId).src = "assets/images/logos/greenEye.png";
  } else {
    e.setAttribute("type", "password");
    document.getElementById(eyeId).src = "assets/images/logos/redEye.png";
  }
}
