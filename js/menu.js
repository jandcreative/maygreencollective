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

    $('#menu-item-1190 a').click(function() {
        $('#hamburguer').removeClass('close-hamburguer');
        $('.full-menu').css({ 'top': '-100%', });

    });

  $("#menu-item-1228").click(function () {
    if ($("#menu-item-1228").attr("class") == "menu-item-has-children") {
      $("#menu-item-1228").addClass("open");
    } else {
      $("#menu-item-1228").removeClass("open");
    }
  });

  $("#menu-item-1228").click(function (e) {
    //e.preventDefault();
    if (null != e.target.nextElementSibling) {
      e.preventDefault();
      $("#menu-item-1228").toggleClass("toggle-menu");
      $("#menu-item-1228 a").toggleClass("no-active");
      return false;
    }
    return;
  });

  $("#menu-item-1229").click(function () {
    if ($("#menu-item-1229").attr("class") == "menu-item-has-children") {
      $("#menu-item-1229").addClass("open");
    } else {
      $("#menu-item-1229").removeClass("open");
    }
  });

  $("#menu-item-1229").click(function (e) {
    //e.preventDefault();
    if (null != e.target.nextElementSibling) {
      e.preventDefault();
      $("#menu-item-1229").toggleClass("toggle-menu");
      $("#menu-item-1229 a").toggleClass("no-active");
      return false;
    }
    return;
  });

});

  
  