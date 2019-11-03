
$(document).ready(()=>{
    var isExpanded = false;

    $('#navbar .nav-item').on('click', function(){
        var parent = $(this).closest(' #navbar');
        parent.find('.nav-item').removeClass('active');
        $(this).addClass('active');
    });
    $('#navbar .c-search__input').on('focus', function(){
        if(!isExpanded) {
            var parent = $(this).closest('.c-search__wrapper');
            parent.addClass('focus');
        }
    });
    $('#navbar .c-search__input').on('focusout', function(){
        var parent = $(this).closest('.c-search__wrapper');
        parent.removeClass('focus');
    });

    $('#js-btn-toggle').on('click', function(){
        $('#navbarCollapse').toggleClass('active');
        $('.c-menu__close').click(function(){
            $('#navbarCollapse').removeClass('active');
        });
    });

   //var isExpanded = false;

    // $('.c-search__append').click(function(ev){
    //     ev.preventDefault();
    //     if (!isExpanded) {
    //         $('.c-search__append').addClass('is-button');
    //         $('body').toggleClass('is-expanded');
    //         $('#navbar .c-search__input').focus();
    //         $('.c-search__append').find('button').on('click', function(){
    //             $('#navbar .c-search__input').submit();
    //         });
    //         isExpanded = true;
    //     } else {
    //         $('body').removeClass('is-expanded');
    //         isExpanded = false;
    //     }
    // }); 
    
    $('.c-search--toggle').on('click', function(){
        $(this).find('span').toggleClass('icon-search icon-close');
        $('body').toggleClass('is-expanded');
        //$('#navbar .c-search__input').focus();
    });

    // $(window).on('resize', function(){
    //     var w = window.innerWidth;
    //     if (w < 992) {
    //         $('body').removeClass('is-expanded');
            
    //     }
    // })
    

});

// HAMMERJS
var w = window.innerWidth;

if (w <= 992) {
    // console.log(w);
    var myElement = document.getElementById('navbarCollapse'),
    myMenu = $('#navbarCollapse');
    // create a simple instance
    // by default, it only adds horizontal recognizers
    var mc = new Hammer(myElement);

    // listen to events...
    mc.on("panleft panright tap press", function(ev) {
        if (ev.type == "panleft") {
            //console.log("LEFT");
            myMenu.removeClass('active');
        }
    });

} 