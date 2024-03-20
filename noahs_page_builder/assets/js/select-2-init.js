(function ($, Drupal, drupalSettings, once) {

    'use strict';

    $(document).on('myAjaxFinished', function(event) {

        $('[data-select-2="1"]').select2({
            width: 'resolve',
            theme: "classic"
        });
        
        $('[data-select-2-sortable]').next().find('.select2-selection__rendered').sortable({
            containment: 'parent'
          });
        

    });


})(jQuery, Drupal, drupalSettings, once);