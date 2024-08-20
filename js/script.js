let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}
// Sélectionne l'image principale dans le conteneur d'image
let mainImage = document.querySelector('.quick-view .box .image-container .main-image img');

// Sélectionne toutes les images secondaires dans le conteneur d'image
let subImages = document.querySelectorAll('.quick-view .box .image-container .sub-image img');

// Ajoute un écouteur d'événement à chaque image secondaire
subImages.forEach(image => {
   image.onclick = () => {
      // Obtient l'attribut 'src' de l'image cliquée
      let src = image.getAttribute('src');
      // Met à jour la source de l'image principale avec celle de l'image cliquée
      mainImage.src = src;
   }
});

