/*
 *****************************************************
 *	CUSTOM JS DOCUMENT                              *
 *	Single window load event                        *
 *   "use strict" mode on                           *
 *****************************************************
 */
$(window).on('load', function() {

    "use strict";

    var preloader = $('.spinner-wrapper');
    var minicart = $(document);
    var opencart = $(".opencart");
    var addClass = $(".add-cart-section");
    var closecart = $(".miniclose");
    var removeclass = $(".add-cart-section");
    var countNumber = $(".count-number");
    var firstdatepicker = $('#datepicker-13');
    var seconddatepicker = $('#datepicker-14');
    var fancybox = $('.fancybox');
    var accordion = $('#accordion');
    var progressbar = $('.progress-bar');
    var toggletooltip = $('[data-toggle="tooltip"]');
    var serachpopup = $('.serach-popup-box');
	var demoCountdown = $('#demo');
	var mapDiv = $('#gmap_canvas');

    /*
    ========================================
        Preloder Setting
    ========================================
    */
    if (preloader.length) {
        preloader.fadeOut();
    }

    /*
    ========================================
        Password box Setting
    ========================================
    */
    var account_box = $('#account');
    var passWord_type = $('.pwsd');

    if (account_box.length) {
        account_box.on('change', function() {
            passWord_type.slideToggle('slow');
        });
    }

    /*
    ========================================
        Mini cart Setting
    ========================================
    */
    
	opencart.on('click', function(e) {
		e.preventDefault();
		addClass.toggleClass("mini-cart-show");
	});

	closecart.on('click', function(e) {
		e.preventDefault();
		removeclass.removeClass("mini-cart-show");
	});
     

    /*
    ========================================
    	Scroll Top
    ========================================
    */
    var scroll_top = $('#scrollbtntop');
    var html_body = $('html,body');

    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            scroll_top.addClass('showScrollTop');
        } else {
            scroll_top.removeClass('showScrollTop');
        }
    });

    //Click event to scroll to top
    if (scroll_top.length) {
        scroll_top.on('click', function(e) {
			e.preventDefault();
            html_body.animate({
                scrollTop: 0
            }, 1000);
        });
    }
    /*
    ========================================
    	Counter Setting
    ========================================
    */
    if (countNumber.length) {
        countNumber.appear(function() {
            $(this).each(function() {
                var datacount = $(this).attr('data-count');
                $(this).find('.counter').delay(6000).countTo({
                    from: 10,
                    to: datacount,
                    speed: 3000,
                    refreshInterval: 50,
                });
            });
        });
    }
    /*
    ========================================
        Datepicker Setting
    ========================================
    */

    if (firstdatepicker.length) {
        firstdatepicker.datepicker();
    }

    if (seconddatepicker.length) {
        seconddatepicker.datepicker();
    }

    /*
    ========================================
        FANCYBOX Setting
    ========================================
    */

    if (fancybox.length) {
        fancybox.fancybox();
    }

    /*
    ========================================
        Accordion Setting
    ========================================
    */

    if (accordion.length) {
        accordion.accordion();
    }

    /*
	========================================
		PROGRESS BAR JS
	========================================
	*/

    if (progressbar.length) {
        progressbar.each(function() {
            var each_bar_width = $(this).attr('aria-valuenow');
            $(this).width(each_bar_width + '%');
        });

        toggletooltip.tooltip({
            trigger: 'manual'
        }).tooltip('show');

    }
    /*
    ========================================
        Serach Popup Setting
    ========================================
    */
    var add_class = $(".addClass");
    var qni_mate = $('#qnimate');
    var remove_class = $("#removeClass");

    if (serachpopup.length) {
        if (add_class.length) {
            add_class.on('click', function(e) {
				e.preventDefault();
                qni_mate.addClass('popup-box-on');
            });
        }
        if (remove_class.length) {
            remove_class.on('click', function(e) {
				e.preventDefault();
                qni_mate.removeClass('popup-box-on');
            });
        }
    }
    /*
	========================
		Header-sticky
    ========================
	*/
    var header_sticky = $("#header");

    if (header_sticky.length) {
        $(window).scroll(function() {
            var winTop = $(window).scrollTop();
            if (winTop >= 100) {
                header_sticky.addClass("sticky-header");
            } else {
                header_sticky.removeClass("sticky-header");
            } //if-else
        }); //win func.
    }

    /*
    =======================
    	price filter
    =========================
    */
    var slider_range = $("#slider-range");
    var a_mount = $("#amount");


    if (slider_range.length) {
        slider_range.slider({
            orientation: "horizontal",
            range: true,
            values: [10, 100],
            slide: function(event, ui) {
                a_mount.val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        a_mount.val("$" + slider_range.slider("values", 0) +
            " - $" + slider_range.slider("values", 1));
    }

    /*
	==============================
		Vertical-slider with fancy box
    ================================
	*/
    var sliderEight = $('.slider8');
    if (sliderEight.length) {
        sliderEight.bxSlider({
            mode: 'vertical',
            slideWidth: 300,
            minSlides: 4,
            slideMargin: 10,
            pager: false,

        });
    }
    /*
	========================================
		Owl Carousel Setting
	========================================
	*/

    owlCarouselInit();

    /*
	========================================
		COUNTDOWN FUNCTION CALLING
	========================================
	*/
	
	if(demoCountdown.length){
		Countdown();
	}

    /*
	========================================
		MAP INITIALIZATION FUNCTION CALLING
	========================================
	*/
	
	if(mapDiv.length){
		initMap();
	}

});

/*
========================================
 Owl Carousel functions
======================================== 	
*/
function owlCarouselInit() {

    "use strict";

    var mainslider = $('#banner');
    var mainsliderhome = $('#sliderhome');
    var mainsliderhome1 = $('#sliderhome-1');
    var trainersslider1 = $('#trainers-1');
    var trainersslider = $('#trainers');
    var testimonialslider = $('#testimonial');
    var partnersslider = $('#partners');
    var partners1slider = $('#partners1');
    var nextNav = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
    var prevNav = '<i class="fa fa-angle-left" aria-hidden="true"></i>';

    if (mainslider.length) {
        mainslider.owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    if (mainsliderhome.length) {
        mainsliderhome.owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: false,
            autoplay: true,
            navText: [prevNav, nextNav],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    if (mainsliderhome1.length) {
        mainsliderhome1.owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: false,
            autoplay: true,
            navText: [prevNav, nextNav],
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    if (trainersslider.length) {
        trainersslider.owlCarousel({
            loop: true,
            margin: 0,
            dots: false,
            nav: true,
            autoplay: true,
            navText: [prevNav, nextNav],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });
    }

    if (trainersslider1.length) {
        trainersslider1.owlCarousel({
            loop: true,
            margin: 0,
            dots: false,
            nav: true,
            autoplay: true,
            navText: [prevNav, nextNav],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        });
    }

    if (testimonialslider.length) {
        testimonialslider.owlCarousel({
            loop: true,
            margin: 0,
            dots: false,
            autoplay: true,
            nav: true,
            navText: [prevNav, nextNav],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    }


    if (partnersslider.length) {
        partnersslider.owlCarousel({
            loop: true,
            margin: 0,
            dots: false,
            autoplay: true,
            nav: false,
            navText: [prevNav, nextNav],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 6
                }
            }
        });
    }

    if (partners1slider.length) {
        partners1slider.owlCarousel({
            loop: true,
            margin: 0,
            dots: false,
            autoplay: true,
            nav: false,
            navText: [prevNav, nextNav],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        });
    }
}

/*
========================================
	CONTACT PAGE MAP
========================================
*/

function initMap() {

    "use strict";

    var mapDiv = $('#gmap_canvas');

    if (mapDiv.length) {
        var myOptions = {
            zoom: 10,
            scrollwheel: false,
            center: new google.maps.LatLng(-37.81614570000001, 144.95570680000003),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
        var marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(-37.81614570000001, 144.95570680000003)
        });
        var infowindow = new google.maps.InfoWindow({
            content: '<strong>Envato</strong><br>Envato, King Street, Melbourne, Victoria<br>'
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });

        infowindow.open(map, marker);
    }

}

/*
========================================
	COUNTDOWN TIMER Setting
========================================
*/
function Countdown() {

    "use strict";

    var demoCountdown = $('#demo');

    if (demoCountdown.length) {
        // Set the date we're counting down to
        var countDownDate = new Date("June 5, 2018 15:37:25").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = "<div class='col-md-3 col-sm-3 col-xs-3 com-pad0 text-center'><div class='timer'>" + days + "</div><span>days</span></div><div class='col-md-3 col-sm-3 col-xs-3 com-pad0 text-center'><div class='timer'> " + hours + "</div><span>hours</span></div><div class='col-md-3 col-sm-3 col-xs-3 com-pad0 text-center'><div class='timer'>" +
                minutes + "</div><span>minutes</span></div><div class='col-md-3 col-sm-3 col-xs-3 com-pad0 text-center'><div class='timer'> " + seconds + "</div><span>seconds</span></div> ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    }
}