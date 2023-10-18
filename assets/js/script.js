// Classe pour la navigation
class Navigation {
  constructor() {
    // Attaque un gestionnaire d'événements pour le bouton de navigation    
   
this.navbarToggler = document.getElementById("navbar-toggler");
    this.navbarCollapse = document.querySelector(".navbar-collapse");

    // Écoute le clic sur le bouton pour réduire la navigation
    this.navbarToggler.addEventListener("click", (event) => {
      event.preventDefault();
      this.collapseNavbar();
    });

    // Écoute les clics sur les liens de la navigation pour les réduire
    document.querySelectorAll(".navbar-collapse a").forEach((link) => {
      link.
     
addEventListener("click", () => this.collapseNavbar());
    });
  }

  collapseNavbar() {
    // Retire la classe "show" pour réduire la navigation
    this.navbarCollapse.classList.remove("show");
  }
}

// Classe pour le défilement fluide
class SmoothScroll {
  constructor() {
    
   
// Écoute les clics sur les liens de défilement fluide
    document.querySelectorAll(".smoothscroll").forEach((link) => {
      link.addEventListener("click", (e) => this.scrollToSection(e));
    });
  }

// Cette méthode gère le défilement en douceur lorsqu'un lien de défilement fluide est cliqué.
scrollToSection(event) {
  // Empêche le comportement par défaut du lien (défilement)
  event.preventDefault();

  // Récupère l'attribut "href" du lien qui a été cliqué (cible du défilement)
  const target = event.target.getAttribute("href");

  // Sélectionne l'élément cible dans le document
  const targetElement = document.querySelector(target);

  // Récupère la hauteur de la barre de navigation pour compenser le défilement
  const navbarHeight = document.querySelector(".navbar").offsetHeight;

  // Appelle la méthode pour effectuer le défilement en douceur vers l'élément cible
  this.scrollSmoothly(targetElement, navbarHeight);
}

// Cette méthode effectue le défilement en douceur vers un élément spécifique
scrollSmoothly(element, navHeight) {
  // Calcule la position de défilement cible en fonction de l'élément et de la hauteur de la barre de navigation
  const offset = element.getBoundingClientRect().top + window.scrollY - navHeight;

  // Utilise la fonction native de défilement en douceur du navigateur pour atteindre la position cible
  window.scrollTo({
    top: offset,
    behavior: "smooth", // Défilement en douceur
  });
}
}

// Classe pour le carrousel
class Carousel {
  constructor() {
    // Constructeur de la classe
    this.initCarousel(); // Initialise le carrousel
  }

  initCarousel() {
    // Cette méthode initialise le carrousel en utilisant le plugin Owl Carousel
    $(".owl-carousel").owlCarousel({
      center: true, // Centre les éléments du carrousel
      loop: true, // Active la lecture en boucle
      margin: 30, // Marge entre les éléments
      autoplay: true, // Active la lecture automatique
      responsiveClass: true, // Active la gestion de la réactivité
      responsive: {
        0: {
          items: 2, // Affiche 2 éléments sur les écrans de petite taille (largeur < 767px)
        },
        767: {
          items: 3, // Affiche 3 éléments sur les écrans de taille moyenne (largeur ≥ 767px)
        },
        1200: {
          items: 4, // Affiche 4 éléments sur les écrans larges (largeur ≥ 1200px)
        },
      },
    });
  }
}

// Classe pour le bouton top
class ScrollToTop {
  constructor() {
    // Initialisation de la classe
    this.scrollButton = document.getElementById("scroll-to-top-button");
    this.addEventListeners();
  }

  addEventListeners() {
    // Ajoute des écouteurs d'événements pour les actions associées au bouton de retour en haut
    this.scrollButton.addEventListener("click", () => this.scrollToTop());
    window.addEventListener("scroll", () => this.toggleScrollButtonVisibility());
  }

  scrollToTop() {
    // Cette méthode fait défiler la page vers le haut de manière fluide
    window.scrollTo({
      top: 0,         // Défilement jusqu'au haut de la page
      behavior: "smooth", // Utilisation du défilement en douceur
    });
  }

  toggleScrollButtonVisibility() {
    // Cette méthode gère la visibilité du bouton de retour en haut en fonction du défilement
    if (window.scrollY > 100) {
      // Si la position de défilement est supérieure à 100 pixels, le bouton est rendu visible
      this.scrollButton.style.opacity = "1";
      this.scrollButton.style.visibility = "visible";
    } else {
      // Sinon, le bouton est rendu invisible
      this.scrollButton.style.opacity = "0";
      this.scrollButton.style.visibility = "hidden";
    }
  }
}

// Classe pour le formulaire de contact
class ContactForm {
  constructor() {
    // Initialisation de la classe
    this.subjectSelect = document.getElementById("subject");
    this.otherDetails = document.getElementById("other-details");
    this.messageWrapper = document.getElementById("message-wrapper");
    this.addEventListeners();
  }

  addEventListeners() {
    // Ajoute un écouteur d'événements pour le changement de sujet
    this.subjectSelect.addEventListener("change", () => this.handleSubjectChange());
  }

  handleSubjectChange() {
    // Cette méthode gère le changement de sujet dans le formulaire de contact
    const selectedOption = this.subjectSelect.value;
    if (selectedOption === "Autres") {
      // Si l'option "Autres" est sélectionnée, affiche les détails supplémentaires et masque le champ de message
      this.otherDetails.style.display = "block";
      this.messageWrapper.style.display = "none";
    } else {
      // Sinon, masque les détails supplémentaires et affiche le champ de message
      this.otherDetails.style.display = "none";
      this.messageWrapper.style.display = "block";
    }
  }
}

// Classe pour la gestion de la visibilité du mot de passe
class PasswordToggle {
  constructor() {
    // Initialisation de la classe
    this.addEventListeners();
  }

  addEventListeners() {
    // Ajoute un écouteur d'événements à tous les éléments ayant la classe "password-toggle"
    document.querySelectorAll(".password-toggle").forEach((toggle) => {
      toggle.addEventListener("click", () => this.togglePasswordVisibility(toggle));
    });
  }

  togglePasswordVisibility(toggle) {
    // Cette méthode gère la visibilité du mot de passe lorsque l'utilisateur clique sur l'icône de l'œil
    const targetId = toggle.getAttribute("data-target");
    const passwordInput = document.getElementById(targetId);

    if (passwordInput.getAttribute("type") === "password") {
      // Si le champ de mot de passe est masqué, le rendre visible
      passwordInput.setAttribute("type", "text");
      toggle.src = "assets/images/logos/greenEye.png"; // Changer l'icône en œil ouvert
    } else {
      // Sinon, masquer le mot de passe
      passwordInput.setAttribute("type", "password");
      toggle.src = "assets/images/logos/redEye.png"; // Changer l'icône en œil fermé
    }
  }
}


// Initialisation des fonctionnalités
new Navigation();
new SmoothScroll();
new Carousel();
new ScrollToTop();
new ContactForm();
new PasswordToggle();
