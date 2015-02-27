(function($){
    var slider = function(){
        $('#loopedslider ul.slides li:visible').fadeOut(2000);
        $($('#loopedslider ul.slides li')[i]).fadeIn(2000);
        $('#loopedslider ul.pagination li.active').removeClass('active');
        $($('#loopedslider ul.pagination li')[i]).addClass('active');
        i = $('#loopedslider ul.slides li').length - 1 <= i? 0: i + 1;
    }, i = 1, t = setInterval(slider, 5000);
    $('#loopedslider ul.slides li').hover(function(){clearInterval(t);}, function(){t = setInterval(slider, 5000);});
    $('#loopedslider ul.pagination li').mouseover(function(){
        $('#loopedslider ul.slides li:visible').hide();
        $($('#loopedslider ul.slides li')[$(this).index()]).show();
        $('#loopedslider ul.pagination li.active').removeClass('active');
        $(this).addClass('active');
        i = $(this).index();
        i = $('#loopedslider ul.slides li').length - 1 <= i? 0: i + 1;
    }).hover(function(){clearInterval(t);}, function(){t = setInterval(slider, 5000);});
})(jQuery);