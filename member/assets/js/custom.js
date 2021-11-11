$(document).ready(function () {

(function($) {

    $('.nk-nav-toggle').on('click', function(e) {
      e.preventDefault();
      var toggle = $(this).add('.nk-header-overlay');
      toggle.toggleClass('toggle-active');
    });
    
  })(jQuery);





  /* menu open close wrapper screen click close menu */
  $('.menu-btn').on('click', function (e) {
    e.stopPropagation();
   
    if ($('body').hasClass('sidemenu-open') == true) {
        $('body, html').removeClass('sidemenu-open');
        setTimeout(function () {
            $('body, html').removeClass('menuactive');
        }, 500);
    } else {
        $('body, html').addClass('sidemenu-open menuactive');
    }
});
$('.wrapper, .closesidemenu').on('click', function () {

    if ($('body').hasClass('sidemenu-open') == true) {

        $('body, html').removeClass('sidemenu-open');
        setTimeout(function () {
            $('body, html').removeClass('menuactive');
        }, 500);
    }
});



})


