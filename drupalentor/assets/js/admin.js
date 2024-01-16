/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

                

    $(window).on("load", function (e) {

        $('.swiper').each(function (index, element) {
            $(this).attr('id', 'slide_' + index);
            if ($('#slide_' + index + ' .swiper-slide').length > 1) {
                var slide = new Swiper('#slide_' + index, {
                    slidesPerView: 1,
                    autoplay: {
                        delay: 5000,
                    },
                    pagination: {
                      el: ".swiper-pagination",
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev', 
                    }
                });
            }
        });
    });
    $(document).ready(function() {   


        // $('#drupalentor-builder').on('mouseenter', '.area_tooltip', function () {
        //     $(this).tooltip({html: true});
        // });
        // $(".widget-drupalentor_row").draggable({
        //     containment: ".builder-wrapper",
        //     cursor: "move",
        //     revert: true,
        //     snap: true
        //   });
        // $('.area_tooltip').tooltip({html: true});
          $("#drupalentor-builder .builder-wrapper").sortable({
            items: '.widget-drupalentor_row',
            handle: ".drupalentor-move-section",
            cursor: "move",
            opacity: 0.5,
          });
          $(".widget-drupalentor_row .row-elements").sortable({
            items: '.widget-drupalentor_column',
            handle: ".drupalentor-move-column",
            cursor: "move",
            opacity: 0.5,
          });
          $(".drupalentor-column .column-content-inner").sortable({
            items: '.element-widget',
            handle: ".drupalentor-move-widget",
            cursor: "move",
            opacity: 0.5,
          });

          $(".drupalentor-up-widget").click(function() {
            var section = $(this).closest(".drupalentor-widget");
            section.insertBefore(section.prev());
          });
      
          $(".drupalentor-down-widget").click(function() {
            var section = $(this).closest(".drupalentor-widget");
            section.insertAfter(section.next());
          });
        
        //Print classes
        console.log(drupalSettings.drupalentor.classes);
        $.each(drupalSettings.drupalentor.classes, function(index, values) {
            $.each(values, function(key, value) {
        
                $(key).addClass(value);
            });
        });

        var did = $('#drupalentor-builder').data('did');
        var langcode = $('#drupalentor-builder').data('langcode');

        $('[data-bs-toggle]').on('click', function () {
            var id = $(this).attr('href');
            $('.tab-content .tab-pane').removeClass('active');
            $('body').find(id).addClass('active');
            $(this).closest('.nav-tabs').find('.nav-link').removeClass('active');
            $(this).addClass('active');

        });

        // Añadir sección
        $('.add-section .add-section_wrapper').on('click', function () {
    
            var html =  window.addWidget('drupalentor_row', did, langcode);

            $(this).closest('#drupalentor-builder').find('.builder-wrapper').append(html);
           
         });

         // Editar widget
        $('.builder-wrapper').on('click', '.drupalentor-edit-widget', function() {
            var widget = $(this).closest('.drupalentor-widget').data('type');
            var widget_id = $(this).closest('.drupalentor-widget').data('widget-id');
            var settings = $(this).closest('.drupalentor-widget').data('settings');
            var form = addWidgetForm(widget, widget_id, settings);
            
            window.drupalentorOpenModal(form);
        });

        // Eliminar
        $('.builder-wrapper').on('click', '.drupalentor-remove-widget', function() {
            var widget = $(this).closest('.drupalentor-widget');
            if (confirm('¿Estás seguro de que quieres eliminar este elemento?')) {
                window.removeWidgets(widget.data('widget-id'));
                widget.remove();
            } 

        });

        //Añadir columna
        $('.builder-wrapper').on('click', '.drupalentor-add-column', function() {
            window.drupalentorAddColum($(this).data('widget-id'), did, langcode);
        });

        //Añadir elemento
        $('.builder-wrapper').on('click', '.drupalentor-add-element-widget', function() {
            window.addElementWidgetModal($(this).data('widget-id'), did, langcode);
        });
        // var str = '{&quot;wid&quot;:&quot;65a03b9626af8&quot;,&quot;did&quot;:&quot;2&quot;,&quot;uid&quot;:&quot;1&quot;,&quot;type&quot;:&quot;drupalentor_text&quot;,&quot;langcode&quot;:&quot;en&quot;,&quot;element&quot;:{&quot;text&quot;:&quot;<p>1tewfwefwefefwefwkefiowejkifoweiofwjeiofjweoifweoifewiofjweiofjowie<\/p>&quot;,&quot;css&quot;:{&quot;desktop&quot;:{&quot;default&quot;:{&quot;text_color&quot;:&quot;#c92c2c&quot;}}}}}';
        // console.log(str.replace('65a03b9626af8', 'caca'));
        // Manejar el evento de clic en el botón de clonar
        $('#drupalentor-builder').on('click', '.drupalentor-clone-widget', function () {
            // Clonar la sección
            var newSuffix = generateUniqueId();
            var oldId = $(this).data('widget-id');
            var newId = newSuffix;
            var currentSection = $(this).closest('.drupalentor-widget');
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
            var data = $(this).closest('.drupalentor-row').data('type');
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
    //     url: '/admin/drupalentor/widget/' + widget_id, // Reemplaza con la URL de tu ruta de Ajax.
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
        

    //     $('.drupalentor-column-modal .column-box').on('click', function(){
    //         var html = addWidget('drupalentor_column');
    //         $('section[id="widget-id-'+widget_id+'"]').find('.row-wrapper').append(html);

    //         $('div[id="'+$(html).attr('id')+'"]').attr('data-column-size', $(this).data('column')).addClass($(this).data('column'));
    //         $('.drupalentor-column-modal').remove();
    //     });
    // }


})(jQuery, Drupal, drupalSettings);



