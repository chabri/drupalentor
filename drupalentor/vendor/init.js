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

        
    
    if(drupalSettings.drupalentor){
        let pallete_color = ( drupalSettings.drupalentor.pallete_color ) ? '' : '';

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
    }
    
  var $textarea = $('#edit-drupalentor-custom-css--2');

  var createEditor = function() {
    var editor = CodeMirror.fromTextArea($textarea[0], { lineNumbers : true, extraKeys : { "Ctrl-Space" : "autocomplete" } });
    return editor;
  };

  var editor = createEditor();

})(jQuery, Drupal, drupalSettings);