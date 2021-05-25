(function ($, Drupal, drupalSettings) {

    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : { allow_single_deselect: true },
      '.chosen-select-no-single' : { disable_search_threshold: 10 },
      '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
      '.chosen-select-rtl'       : { rtl: true },
      '.chosen-select-width'     : { width: '95%' }
    }

    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

//    var pallete_color = ["blue", "black"];

        
    
        var pallete_color = drupalSettings.drupalentor.pallete_color;
    var caca = ["blue", "black"];
    console.log(pallete_color);
    console.log(caca);
    $('.form-control-color').spectrum({
        type: "color",
        showInput: true,
        showInitial: true,
        showAlpha: false,
        showPalette: true,
        showSelectionPalette: true,
        palette: pallete_color,
        localStorageKey: "spectrum.homepage",
    });

})(jQuery, Drupal, drupalSettings);