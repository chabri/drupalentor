

(function ($, Drupal, drupalSettings) {
    Drupal.behaviors.select2 = {
      attach: function (context, settings) {
        $(document).on('myAjaxFinished', function(event) {
          $(".url_autocomplete").autocomplete({
            source: function(request,response){
                $.ajax({
                    url: "/noahs-admin/nohas-url-autocomplete",
                    type:"GET",
                    dataType:"json",
                    data:{
                        q: request.term
                    },                    
                    success:function(data){
                        response($.map(data, function (item) {
                            return {
                                label: item.text,
                                value: item.id
                            }
                        }))
                        
                    },
       
                })
            },
            select: function (event, ui) {
          
              var label = ui.item.label;
              var value = ui.item.value;
             //store in session
            $(this).val(label);
            $(this).parent().find('.node_id').val(value);
            console.log(label);
            return false;
          }

        })
        });
      },
    };
  })(jQuery, Drupal, drupalSettings);
  