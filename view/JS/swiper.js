new Swiper('.card-wrapper', {
  loop: true,
  spaceBetween: 20,
  

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
      slidesPerView: 1 
    },
    768: {
      slidesPerView: 2
    },
    1024: {
      slidesPerView: 5
    }
  }
});