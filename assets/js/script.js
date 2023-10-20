(function ($) {
  "use strict";

  // Lorsqu'un lien dans le menu de navigation est cliqué, le menu est réduit.
  $(".navbar-collapse a").on("click", function () {
    $(".navbar-collapse").collapse("hide");
  });

  const navbarToggler = document.getElementById("navbar-toggler");

  // Défilement fluide
  $(".smoothscroll").click(function () {
    // Récupère l'élément cible (ancre) depuis l'attribut href
    var el = $(this).attr("href");
    var elWrapped = $(el);
    var header_height = $(".navbar").height();

    scrollToDiv(elWrapped, header_height);
    return false;

    function scrollToDiv(element, navheight) {
        var offset = element.offset();
        var offsetTop = offset.top;
        var totalScroll = offsetTop - 0;

        // Utilise une animation pour faire défiler jusqu'à l'élément cible
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
// Sélectionnez l'élément du bouton de retour en haut par son ID.
const scrollButton = document.getElementById("scroll-to-top-button");

// Ajoutez un écouteur d'événements pour le clic sur le bouton de retour en haut.
scrollButton.addEventListener("click", scrollToTop);

// Ajoutez un écouteur d'événements pour le défilement de la fenêtre.
window.addEventListener("scroll", toggleScrollButtonVisibility);

// Cette fonction anime le défilement de la page vers le haut.
function scrollToTop() {
  window.scrollTo({
    top: 0,         // Défilez jusqu'en haut de la page.
    behavior: "smooth",  // avec un défilement en douceur.
  });
}

// Cette fonction gère la visibilité du bouton de retour en haut en fonction du défilement.
function toggleScrollButtonVisibility() {
  console.log("toggleScrollButtonVisibility called"); // Un message pour le débogage.

  if (window.scrollY > 100) {
    // Si la position de défilement est supérieure à 100 pixels, le bouton est rendu visible.
    scrollButton.style.opacity = "1";
    scrollButton.style.visibility = "visible";
  } else {
    // Sinon, le bouton est rendu invisible.
    scrollButton.style.opacity = "0";
    scrollButton.style.visibility = "hidden";
  }
}


// FORMULAIRE DE CONTACT
// Sélectionnez l'élément du menu déroulant avec l'ID "subject" et ajoutez un écouteur d'événements pour le changement de valeur.
document.getElementById("subject").addEventListener("change", function () {
  // Récupérez la valeur de l'option sélectionnée dans le menu déroulant.
  var selectedOption = this.value;

  // Vérifiez si l'option sélectionnée est "Autres".
  if (selectedOption === "Autres") {
    // Si c'est le cas, affichez l'élément avec l'ID "other-details" et masquez l'élément avec l'ID "message-wrapper".
    document.getElementById("other-details").style.display = "block";
    document.getElementById("message-wrapper").style.display = "none";
  } else {
    // Sinon, masquez l'élément avec l'ID "other-details" et affichez l'élément avec l'ID "message-wrapper".
    document.getElementById("other-details").style.display = "none";
    document.getElementById("message-wrapper").style.display = "block";
  }
});


// AFFICHAGE MOT DE PASSE
function changer(id) {
  // Sélectionnez l'élément d'entrée de texte avec l'ID fourni en paramètre.
  let e = document.getElementById(id);
  
  // Générez l'ID de l'icône de l'œil associée à cet élément.
  let eyeId = "eye" + id;

  // Vérifiez si le type de l'élément d'entrée de texte est "password".
  if (e.getAttribute("type") === "password") {
    // Si le type est "password", changez-le en "text" pour afficher le texte en clair.
    e.setAttribute("type", "text");

    // Changez la source de l'image de l'icône de l'œil pour qu'elle soit verte (œil ouvert).
    document.getElementById(eyeId).src = "assets/images/logos/greenEye.png";
  } else {
    // Sinon, si le type est autre que "password", changez-le en "password" pour masquer le texte.
    e.setAttribute("type", "password");

    // Changez la source de l'image de l'icône de l'œil pour qu'elle soit rouge (œil fermé).
    document.getElementById(eyeId).src = "assets/images/logos/redEye.png";
  }
}


