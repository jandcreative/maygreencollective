
$(document).ready(function(){

  $('.slider-organs').slick({   
    autoplay: true,
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplaySpeed: 1,
    speed: 8500,
    pauseOnHover: true,
    cssEase: 'linear',
    centerMode: true,
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
     }
   ]
  });

$('.slider-people').slick({   
  infinite: true,
  slidesToShow: 2,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1,
  speed: 20000,
  cssEase: 'linear',
  centerMode: true,
  variableWidth: true,
  arrows: false,
});

$('.slider-contact').slick({
  autoplay: true,
  infinite: true,
  speed: 1400,
  fade: true,
  cssEase: 'linear',
  arrows: false,
});

});
