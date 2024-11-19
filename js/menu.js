jQuery(document).ready(function ($) {
    $("#hamburguer").click(function () {
      if ($("#hamburguer").attr("class") == "mobile") {
        $("#hamburguer").addClass("close-hamburguer");
        $(".full-menu").css({ top: "0" });
      } else {
        $("#hamburguer").removeClass("close-hamburguer");
        $(".full-menu").css({ top: "-100%" });
      }

    });


    $('#menu-item-30 a').click(function() {

        $('#hamburguer').removeClass('close-hamburguer');
        $('.full-menu').css({ 'top': '-100%', });

    });

    $('#menu-item-31 a').click(function() {

        $('#hamburguer').removeClass('close-hamburguer');
        $('.full-menu').css({ 'top': '-100%', });

    });

    $('#menu-item-32 a').click(function() {

        $('#hamburguer').removeClass('close-hamburguer');
        $('.full-menu').css({ 'top': '-100%', });

    });

    $('#menu-item-33 a').click(function() {

      $('#hamburguer').removeClass('close-hamburguer');
      $('.full-menu').css({ 'top': '-100%', });

  });

});
  
  