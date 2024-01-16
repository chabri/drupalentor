/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {


    $( document ).on( "ajaxComplete", function( event, xhr, settings ) {
   
    });
    $(document).on('myAjaxFinished', function(event) {
        tabs()
      });
    $(document).ready(function() {
        tabs()
    });
  function tabs(){

    $(".drupalentor-tabs-list a").click(function(e) {

        e.preventDefault();
        var tabId = $(this).attr("href");

        $(".drupalentor-tab").hide();
        $(tabId).show();

        $(".drupalentor-tabs-list a").removeClass("active");
        $(this).addClass("active");
    });
    $('.field_state_options').each(function(index, element){
        $(element).find('*[data-state]').change(function() {

            $(element).find('*[data-state-group="'+$(this).data('state')+'"]').hide();


            var selectedValue = $(this).val();

            $(element).find('*[data-state-element="' + selectedValue + '"]').show();
        });
    });
    
    var defaultValue = $('input[data-state]:checked').val();
    $('*[data-state-element="' + defaultValue + '"]').show();

    // Show the first tab and hide the rest
    $('.field__hover').each(function(index, element){

        $(element).find('.hover_tabs a:first-child').addClass('active');
        $(element).find('.field__hover-content').hide();
        $(element).find('.field__hover-content:first').show();

        // Click function
        $(element).find('.hover_tabs a').click(function(){
            $(element).find('.hover_tabs a').removeClass('active');
            $(this).addClass('active');
            $(element).find('.field__hover-content').hide();
        
            var activeTab = $(this).attr('href');
            $(activeTab).fadeIn();
            return false;
        });
    });
    // Show the first tab and hide the rest
    $('.drupalentor_field__responsive').each(function(index, element){

        $(element).find('.responsive__tabs a:first-child').addClass('active');
        $(element).find('.field-wrapper').hide();
        $(element).find('.field-wrapper:first').show();

        // Click function
        $(element).find('.responsive__tabs a').click(function(){
            $(element).find('.responsive__tabs a').removeClass('active');
            $(this).addClass('active');
            $(element).find('.field-wrapper').hide();
        
            var activeTab = $(this).attr('href');
            $(element).find(activeTab).fadeIn();
            return false;
        });
    });
  }

})(jQuery, Drupal, drupalSettings);



