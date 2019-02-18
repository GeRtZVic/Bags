/**
 * Created by Serhii on 16.06.2018.
 */
$(function () {
    $('.main_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    $('.reviews_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    $('.jsContinueShopping').click(function(e){
      e.preventDefault();
      $(this).parents('.modal').modal('hide');
    });

    $('.brands_slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 510,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            }
        ]
    });

    $('.receipts_slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 510,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            }
        ]
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({

        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        vertical: true,
        verticalSwiping: true,
        focusOnSelect: true,
        responsive:[
            {
                breakpoint: 768,
                settings: {
                    vertical: false,
                    verticalSwiping: false
                }
            },
            {
                breakpoint: 395,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    vertical: false,
                    verticalSwiping: false
                }
            }
        ]
    });

    $('input[type="tel"]').mask('+38 (099) 999-99-99');

    var hamburger = {

        el: {
            ham: $('.hamburger'),
            hamburgerTop: $('.hamburger-top'),
            hamburgerMiddle: $('.hamburger-middle'),
            hamburgerBottom: $('.hamburger-bottom')
        },

        init: function() {
            hamburger.bindUIactions();
        },

        bindUIactions: function() {
            hamburger.el.ham
                .on(
                    'click',
                    function(event) {
                        hamburger.activateMenu(event);
                        event.preventDefault();
                    }
                );
        },

        activateMenu: function() {
            hamburger.el.hamburgerTop.toggleClass('hamburger-top-click');
            hamburger.el.hamburgerMiddle.toggleClass('hamburger-middle-click');
            hamburger.el.hamburgerBottom.toggleClass('hamburger-bottom-click');
        }
    };

    hamburger.init();

    $( ".hamburger" ).on( 'click', function() {
        $(this).next(".hamburger_down").slideToggle( "slow" );
    });

    if($('#map').length){
        function initMap() {
            var myLatLng = {lat: 49.426266, lng: 26.988502};

            // Create a map object and specify the DOM element
            // for display.
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 17
            });

            // Create a marker and set its position.
            var marker = new google.maps.Marker({
                map: map,
                position: myLatLng,
                title: 'магазин «Центр Сумок»'
            });
        }
        initMap();
    }

    $(".numbers-row").append('<div class="inc button">+</div><div class="dec button">-</div>');

    $('.fancybox').fancybox();

    // $('select').niceSelect();

    $('.rating li').on('click', function() {
        var selectedCssClass = 'selected';
        var $this = $(this);
        $this.siblings('.' + selectedCssClass).removeClass(selectedCssClass);
        $this
            .addClass(selectedCssClass)
            .parent().addClass('vote-cast');
    });

    $(".question_block_top").click(function(){
        $(this).next(".question_block_content").slideToggle(300);
        $(this).toggleClass('active');
    });

    $(".sidebar_li_title").click(function(){
        $(this).find(".sidebar_li_toggle").slideToggle(300);
        $(this).toggleClass('active');
    });
    $(".filter_open").click(function(){
        $('.catalog_sidebar').toggleClass('active');
    });


    
});