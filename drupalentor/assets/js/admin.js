/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

    var assets_url = drupalSettings.module_url + '/assets/',
        drupalentor_url = drupalSettings.module_url,
        element_fields = drupalSettings.drupalentor.element_fields;
    $(document).ready(function() {

        var html_drupalentor = drupalSettings.html_drupalentor;
        // console.log(html_drupalentor);
        // console.log(JSON.parse(html_drupalentor));
        $('[data-bs-toggle]').on('click', function () {
            var id = $(this).attr('href');
            $('.tab-content .tab-pane').removeClass('active');
            $('body').find(id).addClass('active');
            $(this).closest('.nav-tabs').find('.nav-link').removeClass('active');
            $(this).addClass('active');

        });
        $('.section-name').on('click', function () {

            var widget = $(this).data('widgettype');

            // console.log(element_fields[widget].fields);
            // var options={
            //     method: 'get',
            //     parameters: element_fields[widget].fields,
            //     onSuccess: function(xhr) {
            //         // TODO: Whatever needs to happen on success
            //         alert('it worked');
            //     },
            //     onFailure: function(xhr) {
            //         // TODO: Whatever needs to happen on failure
            //         alert('it failed');
            //     }
            //   };
            //   $.ajax({
            //     url: drupalentor_url + '/includes/modal.php',
            //     context: options,
            //     success: function(){
            //       // whatever you need to do
            //     }
            //   });

         });
        $('#save-btn').on('click', function () {
            drupalentor_save();
                 return false;
         });
    });
    
    
    function drupalentor_save() {
        var $iframe = $('#iframe');
 

    }
            
})(jQuery, Drupal, drupalSettings);



