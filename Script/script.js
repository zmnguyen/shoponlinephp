$(document).ready(function(e){
    var topnav = $('#top-navbar');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            topnav.addClass("navbar-fixed-top");
        }else{
            topnav.removeClass("navbar-fixed-top");
        }
    });
});