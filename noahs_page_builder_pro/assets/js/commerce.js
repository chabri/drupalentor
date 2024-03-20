(function ($, Drupal, drupalSettings) {

    $(document).ajaxSend(function(event, jqxhr, settings) {
        console.log('Se ha enviado una solicitud AJAX:', settings);
    });

})(jQuery, Drupal, drupalSettings);
