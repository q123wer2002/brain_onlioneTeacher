$(function(){
  $("#teachertab li a").click(function() {
    var anchor = '#'+$(this).attr('href').split("#")[1];
    $("#teachertabboxes div").hide();
    $(anchor).fadeToggle(0);
    $("li").removeClass("current");
    $(this).parent().addClass("current");
    return false;
  });

  $('#favbtn a').click(function() {
    var match = location.href.match(/teacher\/([a-z]+)/i);
    $t = $(this);
    if ($t.hasClass('doFav')) {
        action = 'create';
    } else if($(this).hasClass('doUnfav')) {
        action = 'delete';
    }
    $.post('/favorite', {action: action, name: match[1]}, function(res){
        res = eval('('+res+')');
        alert(res.message);
        if(res.result === 'created'){
            $t.removeClass('doFav').addClass('doUnfav').html('お気に入り解除する');
            $t.parent().parent().children('#favstatus').html('お気に入り：<span>登録中</span>');
            $favorites = $t.parent().parent().children('span');
            num = parseInt($favorites.html()) + 1;
            $favorites.html(num);
        }else if(res.result === 'deleted'){
            $t.removeClass('doUnfav').addClass('doFav').html('お気に入り登録する');
            $t.parent().parent().children('#favstatus').html('お気に入り：<span>解除中</span>');
            $favorites = $t.parent().parent().children('span');
            num = parseInt($favorites.html());
            if (num > 0) {
              num = num - 1;
              $favorites.html(num);
            }
        }else if(res.result === 'nologin'){
            location.href = location.href;
        }
    });
    return false;
  });

  $('#thumb li a').each(function(){
    $(this).qtip({
      content: $(this).next('.tip').html(),
      position: { adjust: {x: -20, y: 20}},
      style: {
        classes: 'qtip-light qtip-shadow qtip-rounded qtip-bootstrap'
      }
    });
  });

  $(".teachertable .header").click(function() {
    timezone = $(this).hasClass('timezone1') ? 'timezone1' : $(this).hasClass('timezone2') ? 'timezone2' : 'timezone3';
    $(this).nextAll('tr.'+timezone).slideToggle();
    if($(this).find("span").hasClass("icon_plus")){
      $(this).find("span").removeClass("icon_plus");
      $(this).find("span").addClass("icon_minus");
    }else{
      $(this).find("span").removeClass("icon_minus");
      $(this).find("span").addClass("icon_plus");
    }
  });

});
