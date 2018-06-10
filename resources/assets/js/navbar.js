$(window).scroll(function () {
    var scroll   = $(window).scrollTop();
    var $sidebar = $('.sidebar-wrapper');

    if (scroll > 20) {
        $('.navbar').addClass('navbar-bg');
    }
    else {
        $('.navbar').removeClass('navbar-bg');
    }

});
$(window).load(function () {
    var scroll = $(window).scrollTop();
    if (scroll > 20) {
        $('.navbar').addClass('navbar-bg');
    }
    else {
        $('.navbar').removeClass('navbar-bg');
    }

});
