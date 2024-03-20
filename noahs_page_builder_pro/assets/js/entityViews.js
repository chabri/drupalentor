(function ($, Drupal, drupalSettings) {
    Drupal.behaviors.getViewModes = {
        attach: function (context, settings) {

          $(document).on('myAjaxFinished', function(event) {

            if($('[name="element[noahs_commerce_product]"]').length){
                var data = {
                    product_bundle: $('[name="element[noahs_commerce_product]"]').val().split(',')[1],
                    entity_id: $('[name="element[noahs_commerce_product]"]').data('entity-id'),
                };
                
                getViews(data);
            }

   
            $('[name="element[noahs_commerce_product]"]').on('change', function(){
                var data = {
                    product_bundle: $(this).val().split(',')[1],
                    entity_id: $(this).data('entity-id'),
                };
                getViews(data);
            });
    

          });
        },
      };
   function getViews(data){

    $.ajax({
        url: "/noahs-admin/noahs_page_builder/get-view-modes",
        type:"POST",
        dataType:"json",
        data: JSON.stringify(data),     
        success:function(data){

            $('[name="element[product_view_options]"]').empty();
            $.each(data, function(valor, texto) {
                $('[name="element[product_view_options]"]').append($('<option>', {
                    value: valor,
                    text: texto
                }));
            });

            $('[name="element[product_view_options]"]').val($('[name="element[product_view_value]"]').val());
            // $('[name="element[product_view]"]').append($('<option>', {data}));
            
        },
    });
    $('[name="element[product_view_options]"]').on('change', function(){
        $('[name="element[product_view_value]"]').val($('[name="element[product_view_options]"]').val())
    });

   }

})(jQuery, Drupal, drupalSettings);
