//@prepros-prepend libs/jquery.cookie.js


/* Author: Dan Linn */
(function($) {
  $('.noahs-theme--open-tabs').on('click', function(e){
    e.preventDefault();

    $('.noahs-theme--tabs-wrapper').toggleClass('hidden');
  })

})(jQuery);





