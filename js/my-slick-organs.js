$('.slider-organs').slick({   
   infinite: true,
   slidesToShow: 5,
   slidesToScroll: 1,
   autoplay: true,
   autoplaySpeed: 1,
   speed: 8500,
   pauseOnHover: true,
   cssEase: 'linear',
   dots: false,
   focusOnSelect: true,
   adaptiveHeight: true,
   arrows: false, 
   responsive: [
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 375,
      settings: {
        slidesToShow: 1,
      }
    }
  ]
});