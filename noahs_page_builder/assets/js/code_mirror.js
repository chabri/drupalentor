(function ($, Drupal, drupalSettings, once) {

    'use strict';

    Drupal.behaviors.codemirror_noahs = {
        attach: function (context, settings) {
         

            $(document).on('myAjaxFinished', function(event) {
                customMirror(context);
            });

        }
    };

    function customMirror(context){
        var textarea = $('.noahs_page_builder_codemirror');
        textarea.each(function(){
            var miTextarea = this;
            var miCodeMirror = CodeMirror.fromTextArea(miTextarea, {
                mode: "css",
                lineNumbers: true,
                theme: "material-darker",
                extraKeys : { "Ctrl-Space" : "autocomplete" }
            });
        });

    }
})(jQuery, Drupal, drupalSettings, once);