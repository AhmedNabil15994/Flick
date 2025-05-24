
(function ($) {
    'use strict';
    var $window = $(window);

    /*======================================
     WOW Animation
     ======================================*/
    var wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: false, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
        callback: function (box) {
        }
        , scrollContainer: true // optional scroll container selector, otherwise use window
    }
    );
    wow.init();

    $('.item-block .item-gallery').owlCarousel({
        responsiveClass: true,
        nav: true,
        dots: false,
        margin: 5,
        smartSpeed: 500,
        items: 4,
        loop: false,
        autoplay: false,
        autoplayHoverPause: true,
        mouseDrag: false,
        navText: ['<span class="ti-angle-left"></span>', '<span class="ti-angle-right"></span>'],
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });
    $('.influencers-modals').owlCarousel({
        responsiveClass: true,
        nav: true,
        dots: false,
        smartSpeed: 500,
        items: 1,
        loop: false,
        navText: ['<span class="ti-angle-left"></span>', '<span class="ti-angle-right"></span>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });
    $('.right-side .item-gallery').owlCarousel({
        responsiveClass: true,
        nav: true,
        dots: false,
        margin: 5,
        smartSpeed: 500,
        items: 5,
        loop: false,
        autoplay: false,
        autoplayHoverPause: true,
        mouseDrag: false,
        navText: ['<span class="ti-angle-left"></span>', '<span class="ti-angle-right"></span>'],
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 3
            },
            1200: {
                items: 5
            }
        }
    });
    $('.select2').select2({
    });
    $('tbody .select2').select2({minimumResultsForSearch: -1});
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    $('.slider-range-price').each(function () {
        var min = parseInt($(this).data('min'));
        var max = parseInt($(this).data('max'));
        var unit = $(this).data('unit');
        var value_min = parseInt($(this).data('value-min'));
        var value_max = parseInt($(this).data('value-max'));
        var label_reasult = $(this).data('label-reasult');
        var t = $(this);
        $(this).slider({
            range: true,
            min: min,
            max: max,
            values: [value_min, value_max],
            slide: function (event, ui) {
                var result = label_reasult + " <span>" + ui.values[0] + unit + ' </span>  <span> ' + ui.values[1] + unit + '</span>';
                t.closest('.price_slider_wrapper').find('.price_slider_amount').html(result);
                t.closest('.price_slider_wrapper').find('.minval').val(ui.values[0]);
                t.closest('.price_slider_wrapper').find('.maxval').val(ui.values[1]);
            }

        });
    });
    $('.filter-price').on('click', function (event) {
        $(this).parent('.dropdown-menu').addClass('show');
        event.stopPropagation();
    });
    $('.filter-drop').on('click', function (event) {
        $(this).parent('.dropdown-menu').addClass('show');
        event.stopPropagation();
    });
    $('.dropdown-menu form').on('click', function (event) {
        $(this).parent('.dropdown-menu').addClass('show');
        event.stopPropagation();
    });

    $('.search-box .btn').on('click', function () {
        $('.influncers').removeClass('overlay');
    });
    $('.search-input-group, .search-box .select2, .search-filter .filter-btn').on('click', function (e) {
        $('.influncers').addClass('overlay');
      e.stopPropagation();
    });
    $(document).on('click', function (e) {
        $('.influncers').removeClass('overlay');
        
    });
})(jQuery);

