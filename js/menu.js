jQuery(document).ready(function ($) {
    $("#hamburguer").click(function () {
      if ($("#hamburguer").attr("class") == "mobile") {
        $("#hamburguer").addClass("close-hamburguer");
        $(".full-menu").css({ left: "0" });
      } else {
        $("#hamburguer").removeClass("close-hamburguer");
        $(".full-menu").css({ left: "-100%" });
      }

    });


    $('#menu-item-489 a').click(function() {

        $('#hamburguer').removeClass('close-hamburguer');
        $('.full-menu').css({ 'left': '-100%', });

    });

    $('#menu-item-490 a').click(function() {

        $('#hamburguer').removeClass('close-hamburguer');
        $('.full-menu').css({ 'left': '-100%', });

    });

    $('#menu-item-491 a').click(function() {

        $('#hamburguer').removeClass('close-hamburguer');
        $('.full-menu').css({ 'left': '-100%', });

    });

    $('#menu-item-492 a').click(function() {

      $('#hamburguer').removeClass('close-hamburguer');
      $('.full-menu').css({ 'left': '-100%', });

  });

  $('#menu-item-493 a').click(function() {

      $('#hamburguer').removeClass('close-hamburguer');
      $('.full-menu').css({ 'left': '-100%', });

  });
});
  
  