
$(document).ready(()=>{
    $('#navbar .nav-item').on('click', function(){
        var parent = $(this).closest(' #navbar');
        parent.find('.nav-item').removeClass('active');
        $(this).addClass('active');
    });
    $('#navbar .c-search__input').on('focus', function(){
        var parent = $(this).closest('.c-search__wrapper');
        parent.addClass('focus');
    });
    $('#navbar .c-search__input').on('focusout', function(){
        var parent = $(this).closest('.c-search__wrapper');
        parent.removeClass('focus');
    });
});

