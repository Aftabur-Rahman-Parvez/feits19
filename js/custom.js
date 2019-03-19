$(function(){
    new WOW().init();
})

// $(function(){
//     var text_p = $('.typewriter').text();

//     var length_p = text_p.length;
//     var timeOut;
//     var character_p = 0;


//     (function typeWriter() { 
//         timeOut = setTimeout(function() {
//             character_p++;
//             var type = text_p.substring(0, character_p);
//             $('.typewriter').text(type);
//             typeWriter();
            
//             if (character_p == length_p) {
//                 clearTimeout(timeOut);
//             }
            
//         }, 20);
//     }());
// })





$(document).on('click', '.navbar-collapse', function (e) {
    if ($(e.target).is('a:not(".dropdown-toggle")')) {
        $(this).collapse('hide');
    }
});

	
$(".carousel").swipe({

    swipe: function (event, direction, distance, duration, fingerCount, fingerData) {

        if (direction == 'left') $(this).carousel('next');
        if (direction == 'right') $(this).carousel('prev');

    },
    allowPageScroll: "vertical"

});
        

    var targetImgSrc = $("#targetImg").attr("src");
    var hoverImgSrc='';
    var hoverId='';

    function hover(element) {

        const getSrc = element.src;
        $("#targetImg").attr("src", getSrc);
        $("#targetImg").addClass('zoomhov');

        hoverId=element.id;
        hoverImgSrc=$('#'+hoverId).attr("src");
        $('#'+hoverId).attr("src", targetImgSrc);
    
    }

    function outHover() {
        $("#targetImg").attr("src", targetImgSrc);
        $("#targetImg").removeClass('zoomhov');

        $('#'+hoverId).attr("src", hoverImgSrc);
    }

$('#client-slider').owlCarousel({
    loop:true,
    responsiveClass:true,
    dots:false,
    responsive:{
        0:{
            items:2,
            nav:true
        },
        600:{
            items:4,
            nav:true,
        },
        1000:{
            items:6,
            nav:true,
            loop:false
        }
    },
    navText:['<i class="fa fa-caret-left">','<i class="fa fa-caret-right">']
})


// menu
$(".nav-1 .nav-item .nav-link").click(function(){

    $('.nav-item').removeClass('active');
    $(this).parent('.nav-item').addClass('active');
})

// smooth scrolling

$("a.smooth-scroll").click(function(event){
    event.preventDefault();
    // get id about http
    var getid=$(this).attr("href");
    $("html,body").animate({
        scrollTop:$(getid).offset().top
    },1000,"easeInOutExpo")
})


// home animation on page load
$(window).on('load', function () {

    $(".Top-first").addClass("animated fadeInDown");
    $(".Top-first").addClass("animated fadeInDown");
    $("#home-text").addClass("animated zoomIn");
    $("#home-btn").addClass("animated zoomIn");
    $("#arrow-down i").addClass("animated fadeInDown infinite");

});


// snake image
$(function(){
    $(".snake").snakeify({
        speed: 500,
    });
})

    // products
$('#product-slider').owlCarousel({
    loop:true,
    responsiveClass:true,
    dots:false,
    responsive:{
        0:{
            items:1,
            nav:true,
            loop:true
        },
        600:{
            items:1,
            nav:true,
            loop:true
        },
        1000:{
            items:1,
            nav:true,
            loop:true
        }
    },
    navText:['<i class="fas fa-angle-left">','<i class="fas fa-angle-right">'],
    
})


$(function(){

    showHideNav1();

    $(window).scroll(function(){
        showHideNav1();
    })

    function showHideNav1(){
        if($(window).scrollTop() > 65){
            $('.top-menu').addClass('whiteNav')
            $('.top-menu .navbar-brand img').attr("src","images/Feits_Logo.svg")
            $("#back-to-top").fadeIn();
           
        }else{
            $('.top-menu').removeClass('whiteNav');
            $('.top-menu .navbar-brand img').attr("src","images/feits_logo_white.png")
            $("#back-to-top").fadeOut();
                   
        }
    }
})


$(document).ready(function () {
    $(document).click(function (event) {
        var clickover = $(event.target);
        var _opened = $(".navbar-collapse").hasClass("show");
        if (_opened === true && !clickover.hasClass("navbar-toggler")) {
            $(".navbar-toggler").click();
        }
    });
});


if($(window).width() < 991)
{

    $(document).ready(function() {
        (function() {
          var showChar = 150;
          var ellipsestext = "...";
      
          $(".more").each(function() {
            var content = $(this).html();
            if (content.length > showChar) {
              var c = content.substr(0, showChar);
              var h = content;
              var html =
                '<div class="truncate-text" style="display:block">' +
                c +
                '<span class="moreellipses">' +
                ellipsestext +
                '&nbsp;&nbsp;<a href="" class="moreless more">more</a></span></span></div><div class="truncate-text" style="display:none">' +
                h +
                '<a href="" class="moreless less">Less</a></span></div>';
      
              $(this).html(html);
            }
          });
      
          $(".moreless").click(function() {
            var thisEl = $(this);
            var cT = thisEl.closest(".truncate-text");
            var tX = ".truncate-text";
      
            if (thisEl.hasClass("less")) {
              cT.prev(tX).toggle();
              cT.slideToggle();
            } else {
              cT.toggle();
              cT.next(tX).fadeToggle();
            }
            return false;
          });
          /* end iffe */
        })();
      
        /* end ready */
      });
}


/* ---- particles.js config ---- */



