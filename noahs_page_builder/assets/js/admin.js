/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

                

    $(document).on("load", function (e) {

        // $('.noahs_page_builder-slideshow').each(function (index, element) {
        //     $(this).attr('id', 'slide_' + index);
        //     if ($('#slide_' + index + ' .swiper-slide').length > 1) {
        //         var slide = new Swiper('#slide_' + index, {
        //             slidesPerView: 1,
        //             autoplay: {
        //                 delay: 5000,
        //             },
        //             pagination: {
        //               el: ".swiper-pagination",
        //             },
        //             navigation: {
        //                 nextEl: '.swiper-button-next',
        //                 prevEl: '.swiper-button-prev', 
        //             }
        //         });
        //     }
        // });


    });
    $(document).ready(function() {   


        // $('#noahs_page_builder').on('mouseenter', '.area_tooltip', function () {
        //     $(this).tooltip({html: true});
        // });
        // $(".widget-noahs_page_builder_row").draggable({
        //     containment: ".builder-wrapper",
        //     cursor: "move",
        //     revert: true,
        //     snap: true
        //   });
        // $('.area_tooltip').tooltip({html: true});
          $("#noahs_page_builder .builder-wrapper").sortable({
            items: '.widget-noahs_page_builder-row',
            handle: ".noahs_page_builder-move-section",
            cursor: "move",
            opacity: 0.5,
          });

          $(".widget-noahs_page_builder-row .row-elements").sortable({
            items: '.widget-noahs_page_builder-column',
            handle: ".noahs_page_builder-move-column",
            cursor: "move",
            opacity: 0.5,
          });

          $(".widget-noahs_page_builder-column .noahs_page_builder-column--content-inner").sortable({
            items: '.element-widget',
            handle: ".noahs_page_builder-move-widget",
            connectWith: ".noahs_page_builder-column--content-inner",
            tolerance: "pointer",
            forcePlaceholderSize: true,
            cursor: "move",
            opacity: 0.5,
          });

          $(".noahs_page_builder-up-widget").click(function() {
            var section = $(this).closest(".noahs_page_builder-widget");
            section.insertBefore(section.prev());
          });
      
          $(".noahs_page_builder-down-widget").click(function() {
            var section = $(this).closest(".noahs_page_builder-widget");
            section.insertAfter(section.next());
          });
        
        //Print classes

        $.each(drupalSettings.noahs_page_builder.classes, function(index, values) {
            $.each(values, function(key, value) {
        
                $(key).addClass(value);
            });
        });

        //Print Attributes



        var did = $('#noahs_page_builder').data('did');
        var langcode = $('#noahs_page_builder').data('langcode');

        $('[data-bs-toggle]').on('click', function () {
            var id = $(this).attr('href');
            $('.tab-content .tab-pane').removeClass('active');
            $('body').find(id).addClass('active');
            $(this).closest('.nav-tabs').find('.nav-link').removeClass('active');
            $(this).addClass('active');

        });

        // Añadir sección
        $('.add-section .add-section_wrapper').on('click', function () {
    
            var html =  window.addWidget('noahs_row', did, langcode);

            $(this).closest('#noahs_page_builder').find('.builder-wrapper').append(html);
           
         });

         // Editar widget
        $('.builder-wrapper').on('click', '.noahs_page_builder-edit-widget', function() {
      
            var widget = $(this).closest('.noahs_page_builder-widget').data('type');
            var widget_id = $(this).closest('.noahs_page_builder-widget').data('widget-id');
            var settings = $(this).closest('.noahs_page_builder-widget').data('settings');
            var form = addWidgetForm(widget, widget_id, settings);

            window.noahs_page_builderOpenModal(form);
        });

        // Eliminar
        $('.builder-wrapper').on('click', '.noahs_page_builder-remove-widget', function() {
            var widget = $(this).closest('.noahs_page_builder-widget');
            if (confirm('¿Estás seguro de que quieres eliminar este elemento?')) {
                window.removeWidgets(widget.data('widget-id'));
                widget.remove();
            } 

        });

        //Añadir columna
        $('.builder-wrapper').on('click', '.noahs_page_builder-add-column', function() {
            window.noahs_page_builderAddColum($(this).data('widget-id'), did, langcode);
        });

        //Añadir elemento
        $('.builder-wrapper').on('click', '.noahs_page_builder-add-element-widget', function() {
            window.addElementWidgetModal($(this).data('widget-id'), did, langcode);
        });
        // var str = '{&quot;wid&quot;:&quot;65a03b9626af8&quot;,&quot;did&quot;:&quot;2&quot;,&quot;uid&quot;:&quot;1&quot;,&quot;type&quot;:&quot;noahs_page_builder_text&quot;,&quot;langcode&quot;:&quot;en&quot;,&quot;element&quot;:{&quot;text&quot;:&quot;<p>1tewfwefwefefwefwkefiowejkifoweiofwjeiofjweoifweoifewiofjweiofjowie<\/p>&quot;,&quot;css&quot;:{&quot;desktop&quot;:{&quot;default&quot;:{&quot;text_color&quot;:&quot;#c92c2c&quot;}}}}}';
        // console.log(str.replace('65a03b9626af8', 'caca'));
        // Manejar el evento de clic en el botón de clonar
        $('#noahs_page_builder').on('click', '.noahs_page_builder-clone-widget', function () {
            // Clonar la sección
            var newSuffix = generateUniqueId();
            var oldId = $(this).data('widget-id');
            var newId = newSuffix;
            var currentSection = $(this).closest('.noahs_page_builder-widget');
            var clonedSection = currentSection.clone();

            $(clonedSection).attr('id', 'widget-id-' + newId).attr('data-widget-id', newId);
            $(clonedSection).data('settings').wid = newId;
            $(clonedSection).attr('data-settings', JSON.stringify($(clonedSection).data('settings')));
            $(clonedSection).find('[data-widget-id]').attr('data-widget-id', newId);



            $(clonedSection).addClass('widget-cloned');
            // Generar nuevos sufijos aleatorios para los elementos clonados
            $(clonedSection).find('[id^="widget-id-"]').each(function () {
                var oldSuffix = $(this).data('widget-id');
                var newSuffix = generateUniqueId();
                var self = this; // Guardar la referencia al objeto actual
                $(this).find('[data-widget-id]').attr('data-widget-id', newSuffix);
                $(this).attr('id', 'widget-id-' + newSuffix).attr('data-widget-id', newSuffix);
                $(this).data('settings').wid = newSuffix;
                $(this).attr('data-settings', JSON.stringify($(this).data('settings')));

                $(this).addClass('widget-cloned');
                $.ajax({
                    url: '/admin/widget-clone/' + oldSuffix + '/' + newSuffix,
                    method: 'POST',
                    async: false,
                    success: function (data) {
                        var stylesContainer = $('head').find('[data-widget-style="' + data.wid + '"]');
                        if (stylesContainer.length) {
                            stylesContainer.text(data.styles);
                        } else {
                            $('head').append(data.styles);
                        }
                        result = data;
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(textStatus + ":" + jqXHR.responseText);
                    }
                });
            });
        
            // Agregar el elemento clonado al DOM
            currentSection.after(clonedSection);
            // var originalDataTypeValue = currentSection.attr('data-type');

            // $(currentSection).find('[data-type]').each(function () {
            //     var dataTypeValue = $(this).data('type');
            //     console.log('Data-type:', dataTypeValue);
            // });


            var data = {};

            $.ajax({
                url: '/admin/widget-clone/'+oldId+'/'+newId,
                method: 'POST',
                data: JSON.stringify(data),
                async: false,  
                success:function(data) {
                        // $(clonedSection).attr('data-cloned-settings', data.settings);

                        var stylesContainer =$('head').find('[data-widget-style="' + data.wid + '"]');
                        if (stylesContainer.length) {
                          stylesContainer.text(data.styles);
                        } else {
                          $('head').append(data.styles);
                        }
                    result =  data;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus + ":" + jqXHR.responseText);
                }
            });
        });

        $('.builder-wrapper').on('click', '.save-widget', function() {
            var data = $(this).closest('.noahs_page_builder-row').data('type');
        });

 

    });
    
    // Función para generar un ID único
    function generateUniqueId() {
        return Math.random().toString(36).substr(2, 10);
    }

    //Añadir wl widget
    // function addWidget(widget_id){
    //     var data = {
    //     widget_id: widget_id,
    //     };

    //     var result="";
    //     $.ajax({
    //     url: '/admin/noahs_page_builder/widget/' + widget_id, // Reemplaza con la URL de tu ruta de Ajax.
    //     method: 'POST',
    //     data: JSON.stringify(data),
    //     async: false,  
    //     success:function(data) {

    //         result =  data;
    //     },
    //     error: function (jqXHR, textStatus, errorThrown) {
    //         alert(textStatus + ":" + jqXHR.responseText);
    //     }
    //     });
    //     return result;  
    // }

    // Obtener formulario del widget
    function addWidgetForm(widget_id, section_id, settings){
  

        var data = {
        nid:  drupalSettings.nid,
        widget: widget_id,
        section_id: section_id,
        settings: JSON.stringify(settings),
        };

        var result="";
        $.ajax({
        url: '/admin/modal-form/' + drupalSettings.nid + '/' + widget_id + '/' + section_id, // Reemplaza con la URL de tu ruta de Ajax.
        method: 'POST',
        data: data,
        async: false,  
        success:function(data) {

            result =  data;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(textStatus + ":" + jqXHR.responseText);
        }
        });
     return result;  
    }



    // Añadir columna
    // function addColum(widget_id){
    //     $('#myModal').modal('show'); 
        

    //     $('.noahs_page_builder-column-modal .column-box').on('click', function(){
    //         var html = addWidget('noahs_page_builder_column');
    //         $('section[id="widget-id-'+widget_id+'"]').find('.row-wrapper').append(html);

    //         $('div[id="'+$(html).attr('id')+'"]').attr('data-column-size', $(this).data('column')).addClass($(this).data('column'));
    //         $('.noahs_page_builder-column-modal').remove();
    //     });
    // }


})(jQuery, Drupal, drupalSettings);



