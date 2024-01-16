(function ($, Drupal, drupalSettings, once) {

    'use strict';

    Drupal.behaviors.color_field_drupalenetor = {
        attach: function (context, settings) {
            colorSpectrum(context);
            $(document).on('myAjaxFinished', function(event) {
                colorSpectrum(context);
        });
        }
    };

    function colorSpectrum(context){
        $(once('colorFieldSpectrum', '.field__color', context)).each(function (index, element) {
        //    var pallete_color = ["blue", "black"];
         
            // if(drupalSettings.drupalentor){
     
                var pallete_color = drupalSettings.drupalentor ? drupalSettings.drupalentor.pallete_color : [];
                const $element = $(element);
                const $element_color = $element.find('.form-control-color');
    
                const $element_opacity = $element.find('.form-control-color-alpha');
                $element_color.spectrum({
                    type: "color",
                    preferredFormat: "hex",
                    showInput: true,
                    showInitial: true,
                    showAlpha: false,
                    showPalette: true,
                    showSelectionPalette: true,
                    palette: pallete_color,
                    showInput: true,
                    appendTo: $element_color.parent(),
                    allowEmpty:true,
                    localStorageKey: "spectrum.default",
                });
                $element_opacity.spectrum({
                    type: "color",
                    showInput: true,
                    showInitial: true,
                    showAlpha: true,
                    showPalette: true,
                    showSelectionPalette: true,
                    palette: [ ],
                    appendTo: $element_color.parent(),
                    localStorageKey: "spectrum.overlay",
                });
            // }
    
                })
            }
})(jQuery, Drupal, drupalSettings, once);