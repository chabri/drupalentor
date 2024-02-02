/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

    var assets_url = drupalSettings.module_url + '/assets/',
        noahs_page_builder_url = drupalSettings.module_url;
  
        console.log(JSON.parse(drupalSettings.html_noahs_page_builder));


    $(document).ready(function() {
        $('body').addClass('noahs_page_builder-editor');
        var serialize = function(element) {
            return $(element).find(':input').get()
              .reduce(function(accu, field) {
                accu[field.name] = field.value;
                const caca = [accu];
                return caca;
              }, {});
          };
          
          function serializeUL(ul){
            var children = {};
            $(ul).children().each(function(){
                var li = $(this),
                    sub = li.children('fieldset');
                children[this.id] = sub.length > 0  ? serializeUL(sub) : null;
            })
            return children;
        }
console.log(serializeUL($('#myform fieldset')));
           
          // add sub-table data as "rows"
          var obj = $('#myform').serializeJSON();
          console.log(obj.section);
   
        $( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            var obj = $(this).serializeJSON();
            var obj = obj.section;
console.log(obj);
            // noahs_page_builder_save(obj);
          });

        // $('#save-btn').on('click', function () {
        //     noahs_page_builder_save();
        //          return false;
        //  });
    });
    
    
    function noahs_page_builder_save(data) {

        var result = JSON.stringify(data);
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
                console.log('guardado');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + ":" + jqXHR.responseText);
            }
        });

    }
            
})(jQuery, Drupal, drupalSettings);



