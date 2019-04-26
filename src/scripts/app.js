$(document).ready(() => {
  var isExpanded = false;

  $("#navbar .nav-item").on("click", function() {
    var parent = $(this).closest(" #navbar");
    parent.find(".nav-item").removeClass("active");
    $(this).addClass("active");
  });

  $("#navbar .c-search__input").on("focus", function() {
    if (!isExpanded) {
      var parent = $(this).closest(".c-search__wrapper");
      parent.addClass("focus");
    }
  });

  $("#navbar .c-search__input").on("focusout", function() {
    var parent = $(this).closest(".c-search__wrapper");
    parent.removeClass("focus");
  });

  $("#js-btn-toggle").on("click", function() {
    $("#navbarCollapse").toggleClass("active");
    $(".c-menu__close").click(function() {
      $("#navbarCollapse").removeClass("active");
    });
  });

  $(".c-search__append button").click(function(ev) {
    let w = $(window).width();

    if(w < 992) {
      ev.preventDefault();
    }
    
    isExpanded = true;
    $(this).closest("body").toggleClass("is-expanded");
    $("#navbar .c-search__input").focus();
  });


});

//HAMMERJS
var w = window.innerWidth;

if (w <= 992) {
    console.log(w);
    var myMenu = document.getElementById('navbarCollapse');
    // create a simple instance
    // by default, it only adds horizontal recognizers
    var mc = new Hammer(myMenu);

    // listen to events...
    mc.on("panleft tap press", function(ev) {
        if (ev.type == "panleft") {
            console.log("LEFT");
            $('#navbarCollapse').removeClass('active');
        }
    });

}
