/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

    $(document).ready(function() {

        $('.noahs_page_builder-slideshow').each(function (index, element) {
            $(this).attr('id', 'slide_' + index);
            if ($('#slide_' + index + ' .swiper-slide').length >= 1) {
                var slide = new Swiper('#slide_' + index, {
                    autoplay: {
                        delay: 5000,
                    },
                    pagination: {
                      el: ".swiper-pagination",
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev', 
                    }
                });
            }
        });
        $('.noahs_page_builder-carousel').each(function (index, element) {
            $(this).attr('id', 'slide_carousel_' + index);
            if ($('#slide_carousel_' + index + ' .swiper-slide').length >= 1) {
                var slide = new Swiper('#slide_carousel_' + index, {
                    slidesPerView: $(this).data('count-slide'),
                    spaceBetween: 30,
                    autoplay: {
                        delay: 5000,
                    },
                    pagination: {
                      el: ".swiper-pagination",
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev', 
                    }
                });
            }
        });
        $.each(drupalSettings.noahs_page_builder.classes, function(index, values) {
            $.each(values, function(key, value) {
     
                $(key).addClass(value);
            });
        });   

        $.each(drupalSettings.noahs_page_builder.attributes, function(index, values) {
            $.each(values, function(key, value) {
               
                $.each(value, function(attr_, valor) {
                    $(key).attr(attr_, valor);
                });
              
            });
        });
        var today = new Date();

        // Sumar dos días a la fecha actual
        var futureDate = new Date(today);
        futureDate.setDate(today.getDate() + 2);
        
        // Obtener el timestamp en segundos (Unix timestamp)
        var timestamp = Math.floor(futureDate.getTime() / 1000);
        

        $('.noahs_page_builder-countdown').each(function (index, element) {
            var date = !$(this).is(':empty') && $(this).data('countdown') ? $(this).data('countdown') : timestamp;
            $(this).attr('id', 'flipdown_' + index);
            new FlipDown(date, "flipdown_" + index, {
                headings: [$(this).data('days'), $(this).data('hours'), $(this).data('minutes'), $(this).data('seconds')],
              }).start();
        });
        AOS.init();
    });


  



})(jQuery, Drupal, drupalSettings);



