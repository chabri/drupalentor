/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

    

    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };


        const html = drupalSettings.html_drupalentor;
        const nid = drupalSettings.nid;
        const wid = drupalSettings.wid;
        const form = $('.drupalentor-modal form');
        $('.drupalentor-modal').on('click', '.save', function() {
            // Acciones que deseas realizar al hacer clic en el botón específico
            alert('¡Has hecho clic en un botón específico!');
        });
        form.on("submit", function(e){
            e.preventDefault();
            const formData = JSON.stringify($(this).serializeObject());
            var widget_id = drupalSettings.widget_id;
            console.log(formDatar);
            $('#widget-id-' + widget_id).prepend('<p>'+formData+'</p>');
            return false;
          })
        // const lastData = html.findIndex(
        // (book) => book.settings.id === wid
        // )
        // console.log(html);
        // if (lastData !== -1)
  
        // html[lastData] = formData

        // var data = {
        //     data: JSON.stringify(html),
        //     nid: nid
        // };
        // function save(){
        //     $.ajax({
        //     url: drupalSettings.saveConfigURL,
        //     type: 'POST',
        //     data: data,
        //     dataType: 'json',
        //     success: function (data) {
        //         alert('toma ya');
        //     },
        //     error: function (jqXHR, textStatus, errorThrown) {
        //         console.log(textStatus + ":" + jqXHR.responseText);
        //     }
        //     });
        // }
        // $(function() {
        //     $('form').submit(function() {
        //         save();
        //         return false;
        // });
    // });
})(jQuery, Drupal, drupalSettings);

/*
{
    "row_name": "",
    "resp_column_inverted": "normal-row",
    "resp_column_media": "md",
    "bg_color": "",
    "bg_particles": "Disable",
    "bg_overlay": "off",
    "bg_position": "center top",
    "bg_repeat": "no-repeat",
    "bg_attachment": "Scroll",
    "bg_size": "cover",
    "style_space": "Remove padding for [colums & row]",
    "padding_top": "",
    "padding_right": "",
    "padding_bottom": "",
    "padding_left": "",
    "margin_top": "",
    "margin_right": "",
    "margin_bottom": "",
    "margin_left": "",
    "layout": "Full Width",
    "height": "",
    "align_horizontal": "flex-start",
    "align_vertical": "flex-start",
    "container": "default",
    "equal_height": "Disable",
    "icon": "",
    "class": "",
    "row_id": "",
    "bg_row": "-- None --"
 }
*/