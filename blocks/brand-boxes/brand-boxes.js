import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs';

const initializeBlock = () => {
  const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    centeredSlides: true,
    breakpoints: {
      0: {
          spaceBetween: 20,
          slidesPerView: '1.1',
          centeredSlides: true,
      },
      768: {
          spaceBetween: 20,
          slidesPerView: '1.8',
          centeredSlides: true,
      },
      1280: {
          spaceBetween: 0,
          slidesPerView: 3,
          centeredSlides: false,
      },
  },
  
    // Navigation arrows
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true,
    },
  });
  };

if (window.acf) {
    window.acf.addAction('render_block_preview/type=kodeks/brand-boxes', initializeBlock);
} else {
    initializeBlock();
}