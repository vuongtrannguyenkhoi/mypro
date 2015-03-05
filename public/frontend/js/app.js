$(document).ready(function(){
//navigation
    el = $('.dropdown:has(.dropdown-menu:has(.active))').addClass('active');
    var win_width = $(window).width();
    var box_social_links = $('.box-social-links').width() + 40;
    var body_nav = $('.body-nav').width();
    var main_nav_width = $('#main-nav').width();

    resizeMenu();
    function resizeMenu(){
        body_nav = $('.body-nav').width();
        box_social_links = $('.box-social-links').width() + 40;
        $(".navbar-nav > li > a").css("width", (body_nav-300 - box_social_links)/5);

    }

    $(window).resize(function(){
        resizeMenu();
    });
});
