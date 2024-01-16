/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

    $(document).ready(function() {
        $('.swiper').each(function (index, element) {
            $(this).attr('id', 'slide_' + index);
            if ($('#slide_' + index + ' .swiper-slide').length > 1) {
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
        $.each(drupalSettings.drupalentor.classes, function(index, values) {
            $.each(values, function(key, value) {
        
                $(key).addClass(value);
            });
        });   
    });


})(jQuery, Drupal, drupalSettings);



