jQuery(document).ready(function ($) {
  $('.search').on('click', function (e) {
    e.preventDefault();
    $('#search-popup').fadeToggle(); // Alterna entre mostrar y ocultar
  });

  // Cerrar el popup al hacer clic fuera de él
  $('#search-popup').on('click', function (e) {
    if (e.target === this) {
      $(this).fadeOut();
    }
  });

  // Cerrar el popup al hacer clic en el botón de cerrar
  $('.close').on('click', function () {
    $('#search-popup').fadeOut();
  });
});
