(function($) {
    'use strict';


    $(window).on('load', function () {
        $('.preloader').delay(1000).fadeOut(600);
        });

    var mobilManu = $("#mobile-nav");


    var windo = $(window),
        HtmlBody = $('html, body');

    /* ------------------ mobile and side bar manu ---------------- */

    var Accordion = function(el, multiple) {
        this.el = el || {};

        this.multiple = multiple || false;

        var dropdownlink = this.el.find('.dropdownlink');
        dropdownlink.on('click', {
                el: this.el,
                multiple: this.multiple
            },
            this.dropdown);
    };

    Accordion.prototype.dropdown = function(e) {
        e.preventDefault();
        var $el = e.data.el,
            $this = $(this),

            $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
            //show only one menu at the same time
            $el.find('.submenuItems').not($next).slideUp().parent().removeClass('open');
        }
    }

    var accordion = new Accordion($('.mobile-list-nav'), false);



    /* ---------------------- Back to Top ---------------------- */


    var backtotop = $(".backtotop");

    backtotop.on('click', function() {
        HtmlBody.animate({
            scrollTop: 0
        }, 1500);
    });

    /* Scrolling  */

    windo.on('scroll', function() {

        var scrltop = windo.scrollTop(),
            navigation = $('#navigation');
        if (scrltop > 400) {
            navigation.addClass('nav-scrl');
            // windo.scrollDown({
            //    $('.nav-scrl').css('transform', 'translateY(0)'); 
            // });
        } else {
            navigation.removeClass('nav-scrl');
        }

        /* Back to top */
        if (scrltop > 400) {
            backtotop.fadeIn(500);
        } else {
            backtotop.fadeOut(500);
        }


    });

    /* Scrolling  */
    windo.on('scroll', function() {
        var scrltop = windo.scrollTop(),
            navigation = $('#mid-nav');
        if (scrltop >750) {
            navigation.addClass('nav-scrl');
            // windo.scrollDown({
            //    $('.nav-scrl').css('transform', 'translateY(0)'); 
            // });
        } else {
            navigation.removeClass('nav-scrl');
        }

        /* Back to top */
        if (scrltop > 400) {
            backtotop.fadeIn(500);
        } else {
            backtotop.fadeOut(500);
        }


    });


    $('.second-nav-toggler').on('click', function(e) {
        e.preventDefault();
        var mask = '<div class="mask-overlay">';

        $('body').toggleClass('active');
        $(mask).hide().appendTo('body').fadeIn('fast');
        $('.mask-overlay, .manu-close').on('click', function() {
            $('body').removeClass('active');
            $('.mask-overlay').remove();
        });
    });

    /* Images Background Set */
    $('[data-bg-image]').each(function() {
        var img = $(this).data('bg-image');
        $(this).css({
            backgroundImage: 'url(' + img + ')',
        });
    });

    /* ---------------------------- Accodian icon change ---------------------------*/


   var accodianHead = $('.accodian-head');
    accodianHead.on('click', function() {
        accodianHead.removeClass('active');
        $(this).addClass('active');
        accodianHead.find('i').removeClass('fa-minus').addClass('fa-plus');
        $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
    });

    /* About Accodian */
    var accodianHead = $('.accodian-4-head');
    accodianHead.on('click', function() {
        $('.accodian-4-item').removeClass('active');
        $(this).parent('.accodian-4-item').addClass('active');
    });

    /* team hover effect */
    $('.team-member-des').slideUp();

    $('.team-item').on('mouseenter', function() {
        $(this).find('.team-member-des').stop().slideDown(600);
    }).on('mouseleave', function() {
        $(this).find('.team-member-des').stop().slideUp();
    });




    /* ---------------------------------Swiper  Sliders ----------------------------- */


 

  $('.swiper-container').each(function() {
     new SwiperRunner($(this));
    });



    /* ------------------------------------- Counter Up ----------------------------- */
    $('.counter').counterUp({
        delay: 20,
        time: 2500
    });

    /* ---------------------------------- Parallax js ----------------------- */
    if ($(window).width() > 768) {
        $('#banner-inner-1, #banner-text, #banner-inner-2, #banner-inner-3, #banner-inner-4, #banner-inner-5, #banner-inner-6, #banner-inner-7, #banner-inner-8, #banner-inner-9, #banner-inner-10, #banner-inner-11, #banner-inner-12, #banner-inner-13, #banner-inner-14').each(function() {

            var scene = document.getElementById('banner-inner-1');
            var parallaxInstance = new Parallax(scene);

            var scene = document.getElementById('banner-text');
            var parallaxInstance = new Parallax(scene);

            var scene = document.getElementById('banner-inner-2');
            var parallaxInstance = new Parallax(scene);

            var scene = document.getElementById('banner-inner-3');
            var parallaxInstance = new Parallax(scene);

            var scene = document.getElementById('banner-inner-4');
            var parallaxInstance = new Parallax(scene);

            var scene = document.getElementById('banner-inner-5');
            var parallaxInstance = new Parallax(scene);

            var scene = document.getElementById('banner-inner-6');
            var parallaxInstance = new Parallax(scene);


            var scene = document.getElementById('banner-inner-7');
            var parallaxInstance = new Parallax(scene);


            var scene = document.getElementById('banner-inner-8');
            var parallaxInstance = new Parallax(scene);


            var scene = document.getElementById('banner-inner-9');
            var parallaxInstance = new Parallax(scene);


            var scene = document.getElementById('banner-inner-10');
            var parallaxInstance = new Parallax(scene);



            var scene = document.getElementById('banner-inner-11');
            var parallaxInstance = new Parallax(scene);



            var scene = document.getElementById('banner-inner-12');
            var parallaxInstance = new Parallax(scene);


            var scene = document.getElementById('banner-inner-13');
            var parallaxInstance = new Parallax(scene);

            var scene = document.getElementById('banner-inner-14');
            var parallaxInstance = new Parallax(scene);
        });

    };


    /* ----------------------------- Bootstrap ProgressBar ------------------------------- */
    var waypoints = $('.progress-bar').waypoint(function(direction) {
        $('.progressbar-v2 .progress .progress-bar').progressbar({ display_text: 'fill' });
        $('.progress .progress-bar').progressbar({ display_text: 'fill' });

    }, {
        offset: '140%'
    });


    var waypoints = $('.progressbar-box .progressbar-wrapper').waypoint(function(direction) {
        $('.progressbar-box .progressbar-wrapper h5').css('opacity', '1');
    }, {
        offset: '95%'
    });

 

       
   
    
    
    //============= Google Map ============
 $('.gmap3-area').each(function() {
        var $this  = $(this),
        key    = $this.data('key'),
        lat    = $this.data('lat'),
        lng    = $this.data('lng'),
        mrkr   = $this.data('mrkr');

        $this.gmap3({
            center: [lat, lng],
            zoom: 16,
            scrollwheel: false,
            mapTypeId : google.maps.MapTypeId.ROADMAP,
            style: [{"featureType":"poi.business","elementType":"all","stylers":[{"hue":"#ff00ca"},{"saturation":"100"},{"lightness":"0"},{"gamma":"1"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"hue":"#ff0000"}]}]
        })
        .marker(function (map) {
            return {
                position: map.getCenter(),
                icon: mrkr
            };
        })

    });


new WOW().init();


 

}(jQuery));