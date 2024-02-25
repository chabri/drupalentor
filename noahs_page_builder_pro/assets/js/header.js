(function ($, Drupal, drupalSettings) {
     var page_settings = drupalSettings.header_settings.page;
// console.log(page_settings);
//     $(window).scroll(function(){

//         var navbar = $('.noahs-pro-theme--header');
       
//         var a = $(window).scrollTop(),
//             b = navbar.outerHeight(),
//             c;

//         currentScrollTop = a;
//         if(page_settings.header_sticky == 'on'){
//             var offset = page_settings.sticky_in ?? 0;
            
//             if(page_settings.hide_on_scroll_down == 'on'){
            
//                 offset = page_settings.hide_in ?? a;
//                 console.log(offset);
//                 if (c < offset && a > b + b) {
//                     navbar.css("scrollUp");
//                     navbar.css('top', - b);
//                 } else if (c > offset && !(a <= b)) {
//                     navbar.css('top', 0);
//                 }
//                 c = offset;
//             }
//             if (currentScrollTop >= offset) {
//                 navbar.addClass('sticky');
//             }
//             else {
//                 navbar.removeClass('sticky');
//             }
       

//         }

//     });

  
    var c,
        currentScrollTop = 0,
        navbar = $('.noahs-pro-theme--header'),
        headerHeight = navbar.outerHeight();
  
    $(window).on('scroll', function () {
  
        var a = $(window).scrollTop();
        var b = headerHeight
        currentScrollTop = a;
        if(page_settings.hide_on_scroll_down == 'on'){
            currentScrollTop = a;
    
            if (c < currentScrollTop && a > b + b) {
                navbar.css("scrollUp");
                navbar.css("transform", `translateY(${- b}px)`); 
            } else if (c > currentScrollTop && !(a <= b)) {
                navbar.css('top', 0);
                navbar.css("transform", `translateY(0)`); 
            }
        }
        if (currentScrollTop >= b) {
            navbar.addClass('sticky');
        }else{
            navbar.removeClass('sticky');
        }
        c = currentScrollTop;
    });

})(jQuery, Drupal, drupalSettings);
