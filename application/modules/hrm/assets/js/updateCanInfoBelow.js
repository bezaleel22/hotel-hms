$('.btnNext').click(function(){
    'use strict';
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
     var next = $('.nav-tabs > .active').removeClass('active').next('li');
  if (!next.length) next = next.prevObject.siblings(':first');
  next.addClass('active');
});

 $('.btnPrevious').click(function(){
    'use strict';
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
     var prev = $('.nav-tabs > .active').removeClass('active').prev('li');
  if (!prev.length) prev = prev.prevObject.siblings(':first');
  prev.addClass('active');
});