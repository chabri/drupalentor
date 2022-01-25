/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

    var assets_url = drupalSettings.module_url + '/assets/',
        drupalentor_url = drupalSettings.module_url;
    $(document).ready(function() {

        var html_drupalentor = drupalSettings.html_drupalentor;
        // console.log(JSON.parse(html_drupalentor));

        $('#save-btn').on('click', function () {
            drupalentor_save();
                 return false;
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
                $("#message-modal").modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + ":" + jqXHR.responseText);
            }
        });

    }
            
})(jQuery, Drupal, drupalSettings);



