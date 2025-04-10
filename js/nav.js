// Scrolling Effect
jQuery(document).ready(function ($) {

  $(window).on("scroll", function () {
    if ($(window).scrollTop()) {
      $('#header').addClass('nav-up');
    }
    else {
      $('#header').removeClass('nav-up');
    }
    if ($(window).scrollTop()) {
      $('#page-wrapper').addClass('top');
    }
    else {
      $('.mega-sub-menu').removeClass('top');
    }
    if ($(window).scrollTop()) {
      $('.mega-sub-menu').addClass('top');
    }
    else {
      $('#page-wrapper').removeClass('top');
    }
    if ($(window).scrollTop()) {
      $('body').addClass('top');
    }
    else {
      $('body').removeClass('top');
    }
  })

});
  