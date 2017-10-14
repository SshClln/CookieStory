$(document).ready(function(){

  var limitScrollTop = parseInt($('.bandeau').offset().top);

  if ($(document).scrollTop() >= limitScrollTop) {
    $('.bandeau').css({
      'position' : 'sticky',
      'top' : '0',
      'z-index' : '100'
    });
  }

  $(window).scroll(function(){
  	var posScroll = $(document).scrollTop();

    if (posScroll >= limitScrollTop) {
      $('.bandeau').css({
        'position' : 'fixed',
        'top' : '0',
        'z-index' : '100',
        'width' : '81%'
      });
    }
    else {
      $('.bandeau').css({
        'position' : 'initial',
        'z-index' : '0',
        'width' : '100%'
      });
    }
  });
});
