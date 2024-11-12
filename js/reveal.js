window.addEventListener("scroll", reveal);

function reveal() {
  // Verificar el ancho de la pantalla
  if (window.innerWidth < 480) {
    // Desencolar el script scroll-reveal si el ancho de la pantalla es menor que 480px
    wp_dequeue_script('scroll-reveal');
    return; // Salir de la función si el ancho de la pantalla es menor que 480px
  }

  var reveals = document.querySelectorAll(".reveal-opacity");

  for (var i = 0; i < reveals.length; i++) {
    var windowheight = window.innerHeight;
    var revealtop = reveals[i].getBoundingClientRect().top;
    var revealpoint = 150;

    if (revealtop < windowheight - revealpoint) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}