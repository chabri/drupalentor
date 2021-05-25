/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

    var assets_url = drupalSettings.module_url + '/assets/',
        drupalentor_url = drupalSettings.module_url;
    $(document).ready(function() {

        var html_drupalentor = drupalSettings.html_drupalentor,
            default_layout = assets_url+'demo/narrow-jumbotron/index.html';

        if(!html_drupalentor != undefined){
             default_layout = 'about:blank';
            }
        if (window.location.hash.indexOf("no-right-panel") != -1)
        {
            $("#vvveb-builder").addClass("no-right-panel");
            $(".component-properties-tab").show();
            Vvveb.Components.componentPropertiesElement = "#left-panel .component-properties";
        } else
        {
            $(".component-properties-tab").hide();
}

        Vvveb.Builder.init(assets_url+'demo/index.html', function() {
            $('body').addClass('drupalentor-editor');
            if(html_drupalentor != undefined){

                Vvveb.Builder.setHtml(html_drupalentor);
            }else{
//                         Vvveb.FileManager.loadPage("narrow-jumbotron",);
            }
//                      gavias_save_blockbuilder();
            $('#save-btn').on('click', function () {
                drupalentor_save();
			         return false;
             });

        });
    });
    function drupalentor_save() {
        var $iframe = $('#iframe');
        var result = document.getElementById('iframe1').contentWindow.document.body.innerHTML;
        var nid = drupalSettings.nid;
        var data = {
            data: result,
            nid: nid
        };

        $.ajax({
            url: drupalSettings.saveConfigURL,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + ":" + jqXHR.responseText);
            }
        });

    }
            
})(jQuery, Drupal, drupalSettings);



