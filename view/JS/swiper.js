new Swiper('.card-wrapper', {
  loop: true,
  spaceBetween: 20,  
  centeredSlides: true,  
  slidesPerView: 'auto',  

  // Paginación
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
    dynamicBullets: true
  },

  // Flechas de navegación
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // Puntos de quiebre responsivos
  breakpoints: {
    500: {
      slidesPerView: 1,
      spaceBetween: 10,  // Ajusta el espacio entre las diapositivas en pantallas más pequeñas
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 15,  // Ajusta el espacio en pantallas medianas
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 20,  // Ajusta el espacio en pantallas grandes
    }
  }
});