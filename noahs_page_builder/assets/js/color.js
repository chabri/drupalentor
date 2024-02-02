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
        $(once('colorFieldSpectrum', '.form-control-color', context)).each(function (index, element) {

            var pallete_color = drupalSettings.noahs_page_builder ? drupalSettings.noahs_page_builder.pallete_color : [];
            const $element = $(element);
            $element.spectrum({
                type: "color",
                preferredFormat: "hex",
                showInput: true,
                showInitial: true,
                showAlpha: false,
                showPalette: true,
                showSelectionPalette: true,
                palette: pallete_color,
                showInput: true,
                appendTo: $element.parent(),
                allowEmpty:true,
                localStorageKey: "spectrum.default",
            });

        })
        $(once('colorFieldSpectrum', '.form-control-color-alpha', context)).each(function (index, element) {

            const $element = $(element);

            $element.spectrum({
                type: "color",
                showInput: true,
                showInitial: true,
                showAlpha: true,
                showPalette: true,
                showSelectionPalette: true,
                palette: [ ],
                appendTo: $element.parent(),
                localStorageKey: "spectrum.overlay",
            });

        })
    }
})(jQuery, Drupal, drupalSettings, once);