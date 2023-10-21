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


