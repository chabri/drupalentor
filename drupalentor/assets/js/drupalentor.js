/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

    Drupal.behaviors.drupalentor = {
        attach: function (context, settings) {
            var module_url = drupalSettings.module_url + '/assets/';
            $(document).ready(function() {
                //if url has #no-right-panel set one panel demo
                if (window.location.hash.indexOf("no-right-panel") != -1)
                {
                    $("#vvveb-builder").addClass("no-right-panel");
                    $(".component-properties-tab").show();
                    Vvveb.Components.componentPropertiesElement = "#left-panel .component-properties";
                } else
                {
                    $(".component-properties-tab").hide();
                }

                Vvveb.Builder.init(module_url+'demo/narrow-jumbotron/index.html', function() {
                     $('body').addClass('drupalentor-editor');
                });

                Vvveb.Gui.init();
                Vvveb.FileManager.init();
                Vvveb.SectionList.init();

                Vvveb.FileManager.loadPage("narrow-jumbotron",);
            });
        }
    }

})(jQuery, Drupal, drupalSettings);



