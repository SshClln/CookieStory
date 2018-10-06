$(document).ready(function(){
  $(window).scroll(function(){
    var limitScrollTop = parseInt($('header > *').height());
  	var posScroll = $(document).scrollTop();

    if (posScroll >= limitScrollTop) {
      $('.bandeau-wrapper').css({
        'position' : 'fixed',
        'top' : '0',
        'z-index' : '100'
      }).siblings().css({'margin-top':'50px'});
    }
    else {
      $('.bandeau-wrapper').css({
        'position' : 'initial',
        'z-index' : '0',
      }).siblings().css({'margin-top':'0px'});;
    }
  });
});
