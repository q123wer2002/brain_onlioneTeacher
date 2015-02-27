(function($){
    $('#faq dd').hide();
    $('dt.cursor').click(function(){
        if ($(this).next().hasClass('active')) {
            $(this).next().removeClass('active').slideUp();
        } else {
            $(this).next().addClass('active').slideDown();
        }
    })
})(jQuery);