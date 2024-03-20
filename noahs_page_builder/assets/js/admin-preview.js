/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {


    // Función para serializar y agrupar campos del formulario

    // function asignarValores(data, prefix = '') {
    //     for (const key in data) {
    //         const cleanKey = key.replace(/\[/g, '').replace(/\]/g, ''); // Elimina corchetes del nombre del campo
    //         const newPrefix = prefix ? `${prefix}[${cleanKey}]` : cleanKey;
    //         if (typeof data[key] === 'object') {
    //             asignarValores(data[key], newPrefix);
    //         } else {

    //             const elements = document.querySelectorAll(`[name="${newPrefix}"]`);
            
    //             if (elements.length > 0) {
    //                 if (elements[0].type === 'radio') {
    //                     elements.forEach(radio => {
    //                         if (radio.value === data[key]) {
    //                             radio.checked = true;
    //                         }
    //                     });
    //                 } else if (elements[0].type === 'checkbox') {
                    
    //                     elements[0].checked = data[key];
    //                 } else if (elements[0].tagName.toLowerCase() === 'select') {
    //                     const options = elements[0].options;
    //                     for (let i = 0; i < options.length; i++) {
    //                         if (options[i].value === data[key]) {
    //                             options[i].selected = true;
    //                             break;
    //                         }
    //                     }
    //                 } else {
    //                     elements[0].value = data[key];
    //                 }
    //             }
    //         }
    //     }
    // }
                

    // function setControlName(){
        

    // }
        
    $('#noahs_page_builder_preview').on('load', function() {
        // Inyectar la función en el iframe
        this.contentWindow.noahs_page_builderOpenModal = noahs_page_builderOpenModal;
        this.contentWindow.noahs_page_builderAddColum = noahs_page_builderAddColum;
        this.contentWindow.addElementWidgetModal = addElementWidgetModal;
        this.contentWindow.removeWidgets = removeWidgets;
        this.contentWindow.addWidget = addWidget;
        this.contentWindow.noahs_page_builderSavePage = noahs_page_builderSavePage;
        this.contentWindow.getWidgetStructure = getWidgetStructure;
    });
 
    $(document).keydown(function (e) {
        if ((e.ctrlKey || e.metaKey) && e.keyCode === 83) {
            e.preventDefault();    
            $('#noahs_page_builder_form_builder').submit();
        }
    });
    
    $(document).ajaxStart(function() {
        $('body').append('<div class="noahs_page_builder_loading"><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
    });
    
    $(document).ajaxStop(function() {
        $('.noahs_page_builder_loading').remove();
    });

    $(document).on("click", '[data-show-click]', function(e){
        e.preventDefault();
        var element = $(this).data('show-click');
        $('[data-show-click]').addClass('hidden');
        $(element).toggleClass('hidden');
    })
    $(document).on("click", '.move-modal', function(e){
        e.preventDefault();
        $('.noahs_page_builder-modal').toggleClass('right');
    })

    $(document).on("click", '.media-select-icon', function(e){
        e.preventDefault();
        var element_id  = $(this).data('element-id');
        var delta  = $(this).data('delta');
        openIconModal(element_id, delta);
    })
    $(document).on("click", '.media-remove-icon', function(e){
        e.preventDefault();

        $(this).closest('.media-preview-actions').find('input').val('');
        $(this).closest('.media-preview-actions').find('span').attr('class', '');
    })
    
    $(document).on("click", '.noahs_page_builder-modal-tokens', function(e){
        e.preventDefault();
        
        openDialogToken();
    })


    $(document).on("keyup", '[data-update-selector]', function(e){
        e.preventDefault();
        var selector = $(this).data('update-selector');
        var contenidoIframe = $('#noahs_page_builder_preview').contents().find(selector);
        $(contenidoIframe).text($(this).val());
        $('.update_reload_form').trigger('change');
    })

    $(document).on("change", '[data-update-selectorhtml]', function(e){
        e.preventDefault();
        var contenidoIframe = $('#noahs_page_builder_preview').contents();
        var selectedValue = $(this).val();
        var selector = $(this).data('update-selectorhtml');
        var html = contenidoIframe.find(selector).html();
        var newHTML = $('<' + selectedValue + '>').html(html);
        contenidoIframe.find(selector).replaceWith(newHTML);
    })

    $(document).on("click", '.close-media-modal', function(e){
        e.preventDefault();
        $('.noahs_page_builder-media-modal').remove();
    })
    
    $(document).on("click", '.noahs_page_builder-remove-item', function(e){
        e.preventDefault();
        $(this).closest('.accordion-item').remove();
    })

    $(document).on("click", '.media-remove_mask_image', function(e){
        e.preventDefault();
        $(this).closest('.media-preview-actions--mask').find('input').prop('checked', false);
        $(this).closest('.media-preview-actions--mask').find('input[checked]').trigger('change');

    })
    $(document).on("keyup", '[name="element[separator_weight]"]', function(e){

        e.preventDefault();
        var contenidoIframe = $('#noahs_page_builder_preview').contents();
        var weight = $(this).val(); 
        var selector = $(this).data('selector'); 
        var currentStyle = contenidoIframe.find(selector).attr('style');
    
        var newStyle = currentStyle.replace(/(stroke-width="[^"]*")/, 'stroke-width="' + weight + '"');
        contenidoIframe.find(selector).attr('style', newStyle);

    })
    $(document).on("click", '.noahs_page_builder-duplicate-item', function(e){
        e.preventDefault();

        var currentItem = $(this).closest('.accordion-item');
        var cloenedItem = currentItem.clone();
        currentItem.after(clonedItem);
        var count = $(this).closest('.noahs_page_builder_multiple_field').find('.accordion-item').length;

        $(clonedItem).find('.accordion-button').text('Accordion Item #' + (count + 1));
        $(clonedItem).find('.accordion-header').attr('id', 'header_' + (count + 1));
        $(clonedItem).find('.accordion-button').attr('data-bs-target', '#slideshow_' + (count + 1));
        $(clonedItem).find('.accordion-button').attr('aria-controls', 'slideshow_' + (count + 1));
        $(clonedItem).find('.accordion-collapse').attr('id', 'slideshow_' + (count + 1));
        $(clonedItem).find('.accordion-collapse').attr('aria-labelledby', 'header_' + (count + 1));
    })


    $(document).ready(function() {
        // console.log(JSON.parse(getWidgetStructure()));
        $('[data-bs-toggle="tooltip"]').tooltip();
        var contenidoIframe = $('#noahs_page_builder_preview').contents().find('#noahs_page_builder').html();

        $('.noahs_page_builder_preview-content').resizable({
            handles: {
              'e': '.r',
              'w': '.l'
            }
        });

        $("#btn-desktop").on("click", function() {
            $(".noahs_page_builder_preview-content").css({
                "width": "100%",
            });
        });
        $("#btn-tablet").on("click", function() {
            $(".noahs_page_builder_preview-content").css({
                "width": "840px",
            });
        });
        $("#btn-mobile").on("click", function() {
            $(".noahs_page_builder_preview-content").css({
                "width": "460px",
            });
        });
        
        $('.area_tooltip').tooltip({html: true});



        $('#noahs_page_builder_form_builder').on("submit", function(e){
            e.preventDefault();
            noahs_page_builderSavePage();
            document.getElementById('noahs_page_builder_preview').contentWindow.location.reload(true);
            return false;
        })

        $('#noahs_page_builder_sttings_page_form').on("submit", function(e){
            e.preventDefault();
            noahs_page_builderSavePage();
            return false;
          })
    });
    

    function addClasses(classes){

        var iframeContent = $('#noahs_page_builder_preview').contents();

        // Iterar sobre las clases y aplicarlas al contenido del iframe
        $.each(classes, function (index, values) {
            $.each(values, function (selector, className) {
                iframeContent.find(selector).addClass(className);
            });
        });
    }

    // se obteiene la estructura de datos de la página
    function getWidgetStructure(html){

        if(html){
            var contenidoIframe = html;
        }else{
            var contenidoIframe = $('#noahs_page_builder_preview').contents().find('#noahs_page_builder').html();
        }

        var iframeContent = $('#noahs_page_builder_preview').contents();
        var did = $(iframeContent).find('#noahs_page_builder').data('did');
        var langcode = $(iframeContent).find('#noahs_page_builder').data('langcode');
        // Crear un objeto para almacenar la estructura serializada
        var estructuraSerializada = [];

        // Iterar sobre cada elemento con la clase "section"

        $(contenidoIframe).find('section[data-widget-type="section"]').each(function(index, section) {


            var sectionId = $(section).data('widget-id'); // Obtener el ID de la sección
            var type = $(section).data('type'); // Obtener el ID de la columna
            var widget_type = $(section).data('widget-type'); // Obtener el ID de la columna
            var settings = $(section).data('settings'); // Obtener el ID de la columnaa
          
            var sectionData = {
                wid: sectionId,
                type: type,
                did: did,
                widget_type: widget_type,
                settings: settings,
                columns: []
            };

            // Iterar sobre cada elemento con la clase "column" dentro de la sección
            $(section).find('div[data-widget-type="column"]').each(function(index, column) {
                var columnId = $(column).data('widget-id'); // Obtener el ID de la columna
                var type = $(column).data('type'); // Obtener el ID de la columna
                var widget_type = $(column).data('widget-type'); // Obtener el ID de la columna
                var column_size = $(column).data('column-size'); // Obtener el ID de la columna
                var settings = $(column).data('settings'); // Obtener el ID de la columna

                var columnData = {
                    wid: columnId,
                    type: type,
                    did: did,
                    widget_type: widget_type,
                    column_size: column_size,
                    settings: settings,
                    elements: []
                    
                };
                sectionData[columnData];
                // Iterar sobre cada elemento con la clase "widget" dentro de la columna
                $(column).find('div[data-widget-type="element"]').each(function(index, widget) {
                    var widgetId = $(widget).data('widget-id'); // Obtener el ID del widget
                    var type = $(widget).data('type'); // Obtener el ID de la columna
                    var widget_type = $(widget).data('widget-type'); // Obtener el ID de la columna
                    var settings = $(widget).data('settings'); // Obtener el ID de la columna
                    var global = $(widget).data('widget-global'); // Obtener el ID de la columna

                    var elementsData = {
                        wid: widgetId,
                        type: type,
                        did: did,
                        widget_type: widget_type,
                        settings: settings,
                        global: global,
                        // Otra información relevante del widget si es necesario
                    };

                    // Agregar los datos del widget al arreglo de widgets de la columna
                    columnData.elements.push(elementsData);
                });

                // Agregar los datos de la columna al arreglo de columnas de la sección
                sectionData.columns.push(columnData);
            });

            // Agregar los datos de la sección al arreglo de estructura serializada
            estructuraSerializada.push(sectionData);
        });

        // $(contenidoIframe).find('.widget-cloned').each(function() {

        //     var dataSettings = $(this).data('settings');
        //     noahs_page_builderSaveWidgetfromStruture(dataSettings);

        //     $('.widget-cloned').removeClass('widget-cloned');
        // });
        // Convertir la estructura serializada a JSON
        var estructuraSerializadaJSON = JSON.stringify(estructuraSerializada);

        return estructuraSerializadaJSON;

    }
    function actualizarPropiedad(objeto, partes, nuevoValor) {
        // Verificar si hemos llegado al final de las partes
        if (partes.length === 0) {
            // Actualizar el valor de la propiedad
            return nuevoValor;
        }
    
        // Acceder a la próxima parte
        var siguienteParte = partes.shift();
    
        // Verificar si la parte actual existe en el objeto
        if (objeto.hasOwnProperty(siguienteParte)) {
            // Recursivamente buscar la siguiente parte en el objeto
            objeto[siguienteParte] = actualizarPropiedad(objeto[siguienteParte], partes, nuevoValor);
        } else {
            console.error("No se encontró el camino en el objeto settings");
        }
    
        return objeto;
    }

    // formulario de edicion modal
    function noahs_page_builderOpenModal(form){
        $('.noahs_page_builder-modal').remove();
        $('body').append(form);
        $(document).trigger('myAjaxFinished');
        const widget_id = $(form).find('input[name="wid"]').val();

        var settings = $(form).find('.form-data-settings').data('settings') ?? $(form).serializeJSON();
        const formElement = $('.noahs_page_builder-modal form');
        ckeditor(widget_id);

        $('.background-image-field').each(function(index) {
            var bg_fid = $(this).find('.background-fid');
            var bg_thumb = $(this).find('.background-thumbnail').val();
            if(bg_thumb){
                $(this).find('.background-thumbnail-image').attr('src',bg_thumb).show();
            }
            // $(this).find('.media-uploadbg_image').attr('data-element-id', bg_fid.attr('id'));
         });

        $('.media-uploadbg_image').on('click', function (e) {
            e.preventDefault();
            var element_id = $(this).data('element-id');
            var name = $(this).data('element-id');
            openMediaModal(element_id, 'single', null, widget_id);
        });

        $('#add_multiple_images_field').on('click', function (e) {
            e.preventDefault();

            var element_id = $(this).data('element-id');
            var elements =  $('.noahs_page_builder_gallery_field').find('.image-box').length;
            openMediaModal(element_id, 'multiple', elements, widget_id);
        });


        // $('.noahs-input--control-css input, .noahs-input--control-css select').on('change', function() {
        //     const widget_id = $(this).closest('form').find('input[name="wid"]').val();
        //     modificarJson(this, widget_id);
        // });
        
        $(".noahs-input--control-css").each(function(index) {
            const widget_id = $(this).closest('form').find('input[name="wid"]').val();
      
            $(this).find('input, select, :checkbox, :radio').on('change', function() {
                modificarJson(this, widget_id);

            });

        });

        $(".noahs-input--control-css").each(function(index) {
            const widget_id = $(this).closest('form').find('input[name="wid"]').val();
            var styleStype = $(this).data('style-type');
            var styleSelector = $(this).attr('data-style-selector');
            var attributeType = $(this).data('attribute-type');
        
            if (styleSelector != undefined) {
                $(this).find('input, select, :checkbox, :radio').each(function(index) {
                    var localStyleSelector = styleSelector; // Captura el valor actual del estilo
        
                    if (localStyleSelector === 'widget') {
                        localStyleSelector = '#widget-id-' + widget_id;
                    } else if (!localStyleSelector.includes('#widget-id-' + widget_id)) {
                        localStyleSelector = '#widget-id-' + widget_id + ' ' + localStyleSelector;
                    }
                    var targetElement = $('#noahs_page_builder_preview').contents().find(localStyleSelector);
                    var stringClass = targetElement.attr('class');
        
                    $(this).on('change keyup', function() {
                        if (styleStype == 'style' && styleStype !== false) {
                            modificarEstilo(this, widget_id);
                        } else if (styleStype == 'class' && styleStype !== false) {
                            var targetElement = $('#noahs_page_builder_preview').contents().find(localStyleSelector);
                            if($(this).attr('type') === 'checkbox'){
                                if ($(this).is(':checked')) {
                                    targetElement.addClass($(this).val());
                                }else{
                                    targetElement.removeClass($(this).val());
                                }
                            }else{
                                if (stringClass != '') {
                                    var newClass = stringClass + ' ' + $(this).val();
                                    targetElement.attr('class', newClass);
                                }
                            }
                            if($(this).is("[name='element[class][gallery_type_columns]']")){
                                targetElement.attr('class', 'row ' + $(this).val());
                            }
                           
                 
                        } else if (styleStype == 'attribute' && styleStype !== false) {
                            var targetElement = $('#noahs_page_builder_preview').contents().find(localStyleSelector);
                            var attributeValue = $(this).val();
                            if (attributeValue) {
                                targetElement.attr(attributeType, attributeValue);
                            }
                        }
                    });
                });
            }
        });
        
        

        formElement.on("submit", function(e){
            e.preventDefault();
            // var formData = $(this).find('input').not('[value=""]').serializeJSON();
            var formData = $(this).find(':input').filter(function () {
                return $.trim(this.value).length > 0
            }).serializeJSON();


            const widget_id = $('input[name="wid"]').val();

            $('#noahs_page_builder_preview').contents().find('#widget-id-' + widget_id).attr('data-settings', JSON.stringify(formData));
            noahs_page_builderSavePage();
            reloadIframeAndCheckForErrors();
            // document.getElementById('noahs_page_builder_preview').contentWindow.location.reload(true);
            return false;
        })

        $('.noahs_page_builder_textarea').on('change', function (param) {
            var selector = $(this).data('update-selector');
            $(contenidoIframe).find(selector).html($(this).val());
        });
  
        $('.media-removebg_image').on("click", function(e){
            e.preventDefault();
            $(this).closest('.background-image-field').find('input').val('');
            $(this).closest('.background-image-field').find('.background-thumbnail-image').attr('src', '').hide();;
        })

        $('.noahs_page_builder-edit-grid-item').on("click", function(e){
            e.preventDefault();
        })

        $('.noahs_page_builder-remove-grid-item').on("click", function(e){
            e.preventDefault();
            $(this).closest('.image-box').remove();
        })

        $('.noahs_page_builder-add-item').on("click", function(e){
            e.preventDefault();
            
            var htmlData = $(this).data('html');
            var count = $(this).closest('.noahs_page_builder_multiple_elements').find('.accordion-item').length;
            var newHtml = htmlData.replace(/replace_it/g, (count + 1));
            var $tempDiv = $('<div>').html(newHtml);
            const widget_id = $(this).closest('form').find('input[name="wid"]').val();
            const type = $(this).closest('form').find('input[name="type"]').val();
            $tempDiv.find('.accordion-button').text('Item #' + (count + 1));
            $tempDiv.find('.accordion-header').attr('id', 'header_' + (count + 1));
            $tempDiv.find('.accordion-button').attr('data-bs-target', '#slideshow_' + (count + 1));
            $tempDiv.find('.accordion-button').attr('aria-controls', 'slideshow_' + (count + 1));
            $tempDiv.find('.accordion-collapse').attr('id', 'slideshow_' + (count + 1));
            $tempDiv.find('.accordion-collapse').attr('aria-labelledby', 'header_' + (count + 1));
        
            var updatedHtml = $tempDiv.html();

            $(this).closest('.noahs_page_builder_multiple_elements').find('.accordion').append(updatedHtml);
            ckeditor(widget_id);

            if(type === 'noahs_accordion'){
                var accordion_html = getDefaultTemplate(type);
                var $accordion_html = $(accordion_html); // Almacenar una referencia al elemento en una variable
                count = (count + 1);
                $accordion_html.addClass('accordion-item_' + count);
                $accordion_html.find('.accordion-header').attr('id', 'flush-heading_' + count);
                $accordion_html.find('.accordion-button').attr('data-bs-target', '#flush-collapse-' + count);
                $accordion_html.find('.accordion-button').attr('aria-controls', 'flush-collapse-' + count);
                $accordion_html.find('.accordion-button').addClass('accordion-button_' + count);
                $accordion_html.find('.accordion-collapse').attr('id', 'flush-collapse-' + count);
                $accordion_html.find('.accordion-collapse').attr('aria-labelledby', 'flush-collapse-' + count);
                $accordion_html.find('.accordion-collapse').attr('data-bs-parent', '#accordion_' + widget_id);
                
                $('#noahs_page_builder_preview').contents().find('#widget-id-' + widget_id + ' .multipart-item').append($accordion_html); // Agregar el elemento modificado al contenedor
                $('.update_reload_form').trigger('change');

            }else{
                $('#noahs_page_builder_preview').contents().find('#widget-id-' + widget_id + ' .multipart-item').append(getDefaultTemplate(type));

            }


        })

        $('.noahs_page_builder-close-modal').on("click", function(e){
            e.preventDefault();
            $('.noahs_page_builder-modal').remove();
        })

        $(".noahs_page_builder_gallery_field .gallery-images-wrapper").sortable({
            items: '.image-box',
            handle: ".noahs_page_builder-move-grid-item",
            cursor: "move",
            opacity: 0.5,
            
            stop: function(event, ui) {
                var newIndex = ui.item.index();
                $(".gallery-images-wrapper .image-box").each(function(index) {
                    $(this).attr('data-delta', index);

                    var hoverModalId = 'edit-gallery-image-' + index;

                    $(this).find('.noahs_page_builder-hover-modal').attr('id', hoverModalId);
                    $(this).find('.noahs_page_builder-edit-grid-item').attr('data-show-click', '#' + hoverModalId);

                    $(this).find('.noahs_page_builder-hover-modal input[name^="element[gallery_items]"]').each(function() {

                        var currentName = $(this).attr('name');
                        var newName = currentName.replace(/\[\d+\]/, '[' + index + ']');
                        $(this).attr('name', newName);

                    });
                });
            }
          });

        fieldStates();
    }
    function modificarEstilo($this, widget_id) {
        var iframe = $('#noahs_page_builder_preview').contents();
        var formData = $($this).closest('form').find(':input').filter(function () {
            return $.trim(this.value).length > 0
        }).serializeJSON();
        
        iframe.find('#widget-id-' + widget_id).attr('data-settings', JSON.stringify(formData));

        var data = {
            formData: formData,
        };
        $.ajax({
            url: '/noahs-admin/update_live_styles',
            type: 'POST',
            data: JSON.stringify(data),
            processData: false,
            contentType: false,
            success: function (data) {
                var contenidoCSS = iframe.find('#w_style_' + widget_id);
                contenidoCSS.html(data.styles);
                // $('#noahs_page_builder_preview').contents().find('#widget-id-' + widget_id).attr('data-settings', JSON.stringify(formData));
            },
            error: function (error) {
                console.log(error);
            }
        });

    }

    function modificarJson($this, widget_id) {

        var iframe = $('#noahs_page_builder_preview').contents();
        var formData = $($this).closest('form').find(':input').filter(function () {
            return $.trim(this.value).length > 0
        }).serializeJSON();
        
        iframe.find('#widget-id-' + widget_id).attr('data-settings', JSON.stringify(formData));


    }
    function reloadIframeAndCheckForErrors() {
        var iframe = document.getElementById('noahs_page_builder_preview');
        
        iframe.onload = function() {
            var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
            var headContent = iframeDocument.head.innerHTML.trim();

            if (headContent === '') {
                console.log('El iframe se recargó pero el <head> está vacío. Puede haber ocurrido un error.');
                $('.noahs_page_builder-modal').addClass('error');
            }
        };

        iframe.contentWindow.location.reload(true);
    }

    function openDialogToken(){
        var ajaxSettings = {
            url: '/noahs-admin/get_token',
            dialogType: 'modal',
            dialog: { width: 800 },
          };
          var myAjaxObject = Drupal.ajax(ajaxSettings);
          myAjaxObject.execute();
    }

    // Media modal
    function openMediaModal(element_id, type, total, wid){

        var data = {
            element_id: element_id,
            type: type,
            wid: wid,
        };

        $.ajax({
        url: '/noahs-admin/noahs_page_builder/media-modal', 
        method: 'POST',
        data: JSON.stringify(data),
        success:function(data) {

            modal = data.html;

            $('body').append(modal);

            if($(modal).hasClass('modal-type-multiple')){
                $('.image-box').on('click', function(e) {
                    e.preventDefault();
                    $(this).toggleClass('selected');
                  });
                $('.insert-media-modal').on('click', function() {
                    var selectedData = [];
             
                    // Iterar sobre las cajas seleccionadas.
                    $('.image-box.selected').each(function() {
                      // Obtener los valores de los atributos 'data-fileid' y 'data-thumbnail'.
                      var fileid = $(this).data('fileid');
                      var thumbnail = $(this).data('thumbnail');
                
                      // Agregar los datos al array.
                      selectedData.push({
                        fileid: fileid,
                        thumbnail: thumbnail
                      });
                    });
                
                    // Realizar la acción deseada con los datos seleccionados.
                    var timestamp = $.now();
                    var selectedHtml = '';
                    var newItems = '';
                    
                    for (var i = 0; i < selectedData.length; i++) {
                    var index = (total + i);
                      selectedHtml += '<div class="col-3 image-box mb-2 position-relative" data-delta="'+ index +'">';
                      selectedHtml += '<div class="noahs_gallery_field_actions">';
                      selectedHtml += '<div class="noahs_page_builder-edit-grid-item btn btn-sm btn-info position-absolute top-50 start-50 translate-middle rounded-circle" data-show-click="#edit-gallery-image-'+index+'"><i class="fa-solid fa-pen-to-square"></i></div>';
                      selectedHtml += '<div class="noahs_page_builder-move-grid-item btn btn-sm btn-info position-absolute top-0 start-0 rounded-circle"><i class="fa-solid fa-arrows-up-down-left-right"></i></div>';
                      selectedHtml += '<div class="noahs_page_builder-remove-grid-item btn btn-sm btn-danger position-absolute bottom-0 end-0 rounded-circle"><i class="fa-solid fa-trash"></i></div>';
                      selectedHtml += '</div>';
                      selectedHtml += '<img src="' + selectedData[i].thumbnail + '" data-fid="' + selectedData[i].fileid + '" style="width:100%; height:auto;">';

                      selectedHtml += '<div id="edit-gallery-image-'+index+'" class="noahs_page_builder-hover-modal bg-light p-3 position-absolute top-50 start-0 translate-middle-y shadow-lg hidden w-100">';
                      selectedHtml += '<div class="btn btn-sm btn-danger position-absolute top-0 start-50 translate-middle rounded-circle" data-show-click="#edit-gallery-image-'+index+'"><i class="fa-regular fa-circle-xmark"></i></div>';
                      selectedHtml += '<input type="hidden" name="element[gallery_items]['+ index +'][fid]" value="'+ selectedData[i].fileid +'">';
                      selectedHtml += '<input class="form-control" type="text" name="element[gallery_items]['+ index +'][url]" value="">';
                      selectedHtml += '</div>';
                      
                      selectedHtml += '</div>';
                      newItems += '<div class="gallery-item col"><div class="noahs_page_builder-carousel--actions"><a data-fancybox="gallery" href="' + selectedData[i].thumbnail + '"><i class="fa-solid fa-magnifying-glass"></i></a></div><img class="gallery-image-src" src="' + selectedData[i].thumbnail + '"></div>'
                    }
                   

                    // Agregar el HTML al contenedor.
                    $('#' + element_id).append(selectedHtml);
                    $('.update_reload_form').trigger('change');
                    var contenidoIframe = $('#noahs_page_builder_preview').contents().find('#widget-id-' + wid + ' .row').append(newItems);

                    $('.noahs_page_builder-media-modal').remove();
                });
            }else{
                $('.image-box').on('click', function(e){
                    e.preventDefault();
                    $('.image-box').removeClass('selected');
                    $(this).addClass('selected');
                    var fid = $(this).data('fileid');
                    var thumbnail = $(this).data('thumbnail');
                    $('.insert-media-modal').attr('data-fileid', fid).attr('data-thumbnail', thumbnail);
                })
                $('.insert-media-modal').on("click", function(e){
                    e.preventDefault();

                    var fid = $(this).data('fileid');
                    var thumbnail = $(this).data('thumbnail');
                    var element_id = $(this).data('element-id');
                    var wid = $(this).data('wid');

                    $('#' + element_id).val(fid);
                    $('#' + element_id).parent().find('.background-thumbnail-image').attr('src', thumbnail).show();
                    $('#' + element_id).parent().find('.background-thumbnail').val(thumbnail);
                    $('.noahs_page_builder-media-modal').remove();
                    var contenidoIframe = $('#noahs_page_builder_preview').contents().find('#widget-id-' + wid);
                    contenidoIframe.find('.widget-image-src').attr('src', thumbnail)
                    $('#' + element_id).trigger('change');
                })
            }



            $('#noahs_page_builder_upload_image').on('change', function () {
                var files = $(this).prop("files");

                if (!files || files.length === 0) {
                    $('.modal-messages').append('<p>Por favor, selecciona al menos un archivo</p>');
                    return;
                }

                var formData = new FormData();

                for (var i = 0; i < files.length; i++) {
                    var fileInput = files[i];

                    // Verificar si el archivo es una imagen JPG o PNG
                    if (fileInput.type !== 'image/jpeg' && fileInput.type !== 'image/png') {
                        $('.modal-messages').append('<p>Por favor, selecciona un archivo JPG o PNG</p>');
                        return;
                    }

                    formData.append('files[' + i + ']', fileInput);
                }

                $.ajax({
                    url: '/noahs-admin/noahs_page_builder/upload_file',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        // Hacer algo con la respuesta del servidor si es necesario

                        $('#fileInput').val(null)
                        var files = data.files;

                        for (var i = 0; i < files.length; i++) {
                            var fileData = files[i];
                            $('.noahs_page_builder-modal_container > .row').prepend('<div class="col-2 image-box mb-2 selected" data-fileid="' + fileData.file_id + '" data-thumbnail="' + fileData.file_url + '"><span><img src="' + fileData.file_url + '"></span></div>');
                            $('.modal-messages').append('<div class="alert alert-success mt-3" role="alert"><i class="fa-solid fa-circle-check me-3"></i>' + data.message + '</div>');

                        }

                        // $('.insert-media-modal').attr('data-fileid', data[0].file_id); // Suponiendo que deseas utilizar noahs_page_builder el primer archivo como valor por defecto
                        $('.image-box').on('click', function (e) {
                            e.preventDefault();
                            $('.image-box').removeClass('selected');
                            $(this).addClass('selected');
                            var fid = $(this).data('fileid');
                            $('.insert-media-modal').attr('data-fileid', fid);
                        });
                    },
                    error: function (error) {
                        $('.modal-messages').addClass('error').append('<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation me-3"></i>' + data.message + '</div>');
                    }
                });
            });
        }, error: function (jqXHR, textStatus, errorThrown) {
            alert(textStatus + ":" + jqXHR.responseText);
            }
        });

    
    }

    // Icon modal
    function openIconModal(element_id, delta){
      
        var data = {
            element_id: element_id,
        };

        $.ajax({
        url: '/noahs-admin/structure/noahs_page_builder/icons/modal', // Reemplaza con la URL de tu ruta de Ajax.
        method: 'POST',
        data: JSON.stringify(data),
        success:function(data) {

            $('body').append(data);

                $('[data-icon]').on('click', function(e){
                    e.preventDefault();
                    $('[data-icon]').removeClass('selected');
                    $(this).addClass('selected');
                    var iconClass = $(this).data('icon');
                    // var thumbnail = $(this).data('thumbnail');
                    $('.insert-media-modal').attr('data-icon-class', iconClass);
                })
                $('[data-bs-toggle="tooltip"]').tooltip();
                // Manejar el evento de entrada en el campo de búsqueda
                $('#iconSearch').on('input', function() {
                    // Obtener el valor del campo de búsqueda
                    var searchText = $(this).val().toLowerCase();
            
                    // Filtrar los elementos según el valor del campo de búsqueda
                    $('[data-icon]').each(function() {
                        var iconData = $(this).data('icon').toString().toLowerCase();
                        var matchesSearch = iconData.includes(searchText);
            
                        // Mostrar u ocultar el elemento según si coincide con la búsqueda
                        $(this).toggle(matchesSearch);
                    });
                });
                $('.insert-media-modal').on("click", function(e){
                    e.preventDefault();
                    var iconClass = $(this).data('icon-class');
                    var element_id = $(this).data('element-id');
    
                    $('#' + element_id).closest('.media-preview-actions').find('#noahs_page_builder_icon_class_' + delta).val(iconClass);
                    $("#item").removeAttr('class');

                    $('#' + element_id).closest('.media-preview-actions').find('span').removeAttr('class')
                    $('#' + element_id).closest('.media-preview-actions').find('span').attr('class', iconClass)

                    $('.noahs_page_builder-media-modal').remove();
                })
        

            $('.close-media-modal').on("click", function(e){
                e.preventDefault();
                $('.noahs_page_builder-media-modal').remove();
            })

            $('#noahs_page_builder_upload_image').on('change', function () {
                var files = $(this).prop("files");

                if (!files || files.length === 0) {
                    $('.modal-messages').append('<p>Por favor, selecciona al menos un archivo</p>');
                    return;
                }

                var formData = new FormData();

                for (var i = 0; i < files.length; i++) {
                    var fileInput = files[i];

                    // Verificar si el archivo es una imagen JPG o PNG
                    if (fileInput.type !== 'image/jpeg' && fileInput.type !== 'image/png') {
                        $('.modal-messages').append('<p>Por favor, selecciona un archivo JPG o PNG</p>');
                        return;
                    }

                    formData.append('files[' + i + ']', fileInput);
                }

                $.ajax({
                    url: '/noahs-admin/noahs_page_builder/upload_file',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        // Hacer algo con la respuesta del servidor si es necesario

                        $('#fileInput').val(null)
                        var files = data.files;

                        for (var i = 0; i < files.length; i++) {
                            var fileData = files[i];
                            $('.noahs_page_builder-modal_container > .row').prepend('<div class="col-2 image-box mb-2 selected" data-fileid="' + fileData.file_id + '" data-thumbnail="' + fileData.file_url + '"><span><img src="' + fileData.file_url + '"></span></div>');
                            $('.modal-messages').append('<div class="alert alert-success mt-3" role="alert"><i class="fa-solid fa-circle-check me-3"></i>' + data.message + '</div>');

                        }

                        // $('.insert-media-modal').attr('data-fileid', data[0].file_id); // Suponiendo que deseas utilizar noahs_page_builder el primer archivo como valor por defecto
                        $('.image-box').on('click', function (e) {
                            e.preventDefault();
                            $('.image-box').removeClass('selected');
                            $(this).addClass('selected');
                            var fid = $(this).data('fileid');
                            $('.insert-media-modal').attr('data-fileid', fid);
                        });
                    },
                    error: function (error) {
                        $('.modal-messages').addClass('error').append('<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation me-3"></i>' + data.message + '</div>');
                    }
                });
            });
      
        }, error: function (jqXHR, textStatus, errorThrown) {
            alert(textStatus + ":" + jqXHR.responseText);
            }
        });

    
    }

    //Añadir wl widget
    function addWidget(widget_id){
        var data = {
        widget_id: widget_id,
        nid:  drupalSettings.nid,
        };


        var result="";
        $.ajax({
        url: '/noahs-admin/noahs_page_builder/widget/' + widget_id,
        method: 'POST',
        data: JSON.stringify(data),
        async: false,  
        success:function(data) {

            result =  data.html;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(textStatus + ":" + jqXHR.responseText);
        }
        });
     return result;  
    }

    //Get Default Template widget
    function getDefaultTemplate(type){
        var result="";
        $.ajax({
        url: '/noahs-admin/noahs_page_builder/default_widget_template/' + type,
        method: 'POST',
        async: false,  
        success:function(data) {
            result =  data.html;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(textStatus + ":" + jqXHR.responseText);
        }
        });

     return result;  
    }

    // Obtener formulario del widget
    function addWidgetForm(widget_id, section_id){
  
        var data = {
        nid:  drupalSettings.nid,
        widget: widget_id,
        section_id: section_id,
        };

        var result="";
        $.ajax({
        url: '/modal-form/' + drupalSettings.nid + '/' + widget_id + '/' + section_id, // Reemplaza con la URL de tu ruta de Ajax.
        method: 'POST',
        data: JSON.stringify(data),
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


    // Guardar Página
    function noahs_page_builderSavePage() {
        var settings = getWidgetStructure();

        var pageSettings = $('#noahs_page_builder_sttings_page_form').serializeJSON();

        var data_id = drupalSettings.did;
        var data = {    
            nid: data_id,
            did: drupalSettings.did,
            uid: drupalSettings.uid,
            langcode: drupalSettings.langcode,
            settings: settings,
            page_settings: JSON.stringify(pageSettings),
        };
        if(drupalSettings.theme_builder){
            data_id = drupalSettings.theme_builder_type;
            var data = {    
                type: data_id,
                langcode: drupalSettings.langcode,
                settings: settings,
                page_settings: JSON.stringify(pageSettings),
            };
        }

        $.ajax({
            url: drupalSettings.savePage,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {

                $.ajax({
                    url: '/noahs-admin/save-styles/' + data_id,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                 
                        createAlert('','Styles Saved or updated!','everything went well.','info',true,true,'pageMessages');     
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        createAlert('Opps!',textStatus + ":" +  'Something went wrong','Check your drupal Recent log messages.','danger',true,false,'pageMessages');
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                createAlert('Opps!',textStatus + ":" +  'Something went wrong','Check your drupal Recent log messages.','danger',true,false,'pageMessages');
            }
        });

    }

    //Obtener html del widget

    function getFinalWidget(settings){
        
        var result = settings;
        var data = {
            nid: result['did'],
            widget: result['type'],
            wid: result['wid'],     
            settings: JSON.stringify(settings),
        };


        $.ajax({
            url: '/noahs-admin/final-widget/'+ result['did'] +'/'+ result['type'] +'/' + result['wid'],
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {

                var contenidoIframe = $('#noahs_page_builder_preview').contents().find('#widget-id-' + result['wid']);
                contenidoIframe.replaceWith(data.html)
                var slider = $('#noahs_page_builder_preview').contents().find('#widget-id-' + result['wid'] + ' .noahs_page_builder-slideshow');
                var slide = new Swiper(slider, {
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


            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                createAlert('Opps!',textStatus + ":" +  'Something went wrong','Check your drupal Recent log messages.','danger',true,false,'pageMessages');
            },
            complete: function () {
                // Este bloque se ejecutará cuando la primera solicitud AJAX haya terminado
            }
        });

    }
    
    // Añadir columna
    function noahs_page_builderAddColum(widget_id) {
        $('#noahsAddColumn').modal('show');
        $('.noahs_page_builder-column-modal .column-box').off('click');
        $('.noahs_page_builder-column-modal .column-box').on('click', function () {
            var html = addWidget('noahs_column');
            $('#noahs_page_builder_preview').contents().find('section[id="widget-id-' + widget_id + '"]').find('.row-elements').append(html);
            $('#noahs_page_builder_preview').contents().find('div[id="' + $(html).attr('id') + '"]').attr('data-column-size', $(this).data('column')).addClass($(this).data('column'));
            $('#noahsAddColumn').modal('hide');
        });

    }

    // Añadir Widget
    function addElementWidgetModal(element_id){
    
        $('#addElementWidgetModal').modal('show');
        // Eliminar controladores de eventos previos para .widget-box_element
        $('.noahs_page_builder-element-widget-modal .widget-box_element').off('click').on('click', function(){
            var element = $(this).data('element');
            var html = addWidget(element);
            $('#noahs_page_builder_preview').contents().find('div[id="widget-id-'+element_id+'"]').find('.noahs_page_builder-column--content-inner ').append(html);
            $('#addElementWidgetModal').modal('hide');
        });
    }


    // mostras alertas
    function createAlert(title, summary, details, severity, dismissible, autoDismiss, appendToId) {
        
        var iconMap = {
            info: "fa fa-info-circle",
            success: "fa fa-thumbs-up",
            warning: "fa fa-exclamation-triangle",
            danger: "fa ffa fa-exclamation-circle"
        };

        var iconAdded = false;

        var alertClasses = ["alert", "animated", "flipInX"];
        alertClasses.push("alert-" + severity.toLowerCase());

        if (dismissible) {
            alertClasses.push("alert-dismissible");
        }

        var msgIcon = $("<i />", {
            "class": iconMap[severity] // you need to quote "class" since it's a reserved keyword
        });

        var msg = $("<div />", {
            "class": alertClasses.join(" ") // you need to quote "class" since it's a reserved keyword
        });

        if (title) {
            var msgTitle = $("<h4 />", {
            html: title
            }).appendTo(msg);
            
            if(!iconAdded){
                msgTitle.prepend(msgIcon);
                iconAdded = true;
            }
        }

        if (summary) {
            var msgSummary = $("<strong />", {
            html: summary
            }).appendTo(msg);
            
            if(!iconAdded){
            msgSummary.prepend(msgIcon);
            iconAdded = true;
            }
        }

        if (details) {
            var msgDetails = $("<p />", {
                html: details
            }).appendTo(msg);
            
            if(!iconAdded){
                msgDetails.prepend(msgIcon);
                iconAdded = true;
            }
        }

        if (dismissible) {
            var msgClose = $("<span />", {
            "class": "close", // you need to quote "class" since it's a reserved keyword
            "data-dismiss": "alert",
            html: "<i class='fa fa-times-circle'></i>"
            }).appendTo(msg);
        }
        
        $('#' + appendToId).prepend(msg);
        
        if(autoDismiss){
            setTimeout(function(){
            msg.addClass("flipOutX");
            setTimeout(function(){
                msg.remove();
            },1000);
            }, 5000);
        }
    }

    function fieldStates(){

        $('[data-field-state]').each(function() {
            var stateData = $(this).attr('data-field-state');
            var showField = $(this).data('field-name');
            if (stateData) {
                try {
                    stateData = JSON.parse(stateData);
                    if (stateData) {
                        $.each(stateData.visible, function(selector, condition) {   
                        
                            var element = $('[data-field-name="'+selector+'"]').find('[field-settings]');
                            var elementValue = element.val();
                            var elementChecked = element.is(':checked');
                          
                            if ((elementValue && elementValue === condition.value) || (elementChecked && condition.value === 'checked')) {
                                
                                $('[data-field-name="' + showField + '"]').show();
                            }else{
                                $('[data-field-name="' + showField + '"]').hide();
                                $('[data-field-name="' + showField + '"]').find('input').attr('value', '');
                                $('[data-field-name="' + showField + '"]').find('select, input').val('')
                                $('[data-field-name="' + showField + '"]').find('select option').removeAttr('selected')
                                $('[data-field-name="' + showField + '"]').find('checkbox').prop('checked', false);
                                $('[data-field-name="' + showField + '"]').find('textarea').text('');
                            }
                        });
                    }
                } catch (e) {
                    console.error('Error al analizar JSON:', e);
                }
            }
        });

        $('select[name^="element"], input[name^="element"], input[type="checkbox"], input[type="radio"]').change(function() {
            var fieldValue = $(this).val();
            var isChecked = $(this).is(':checked');
            
            // Evaluar las condiciones de visibilidad definidas en data-field-state
            $('[data-field-state]').each(function() {
                var stateData = $(this).attr('data-field-state');
                var showField = $(this).data('field-name');
                
                if (stateData) {
                    try {
                        stateData = JSON.parse(stateData);
                       
                        if (stateData) {
                            $.each(stateData.visible, function(selector, condition) {   
                            
                                var element = $('[data-field-name="'+selector+'"]').find('[field-settings]');
                                var elementValue = element.val();
                                var elementChecked = element.is(':checked');
                              
                                if ((elementValue && elementValue === condition.value) || (elementChecked && condition.value === 'checked')) {
                                    
                                    $('[data-field-name="' + showField + '"]').show();
                                }else{
                                    $('[data-field-name="' + showField + '"]').hide();
                                }
                            });
                        }
                    } catch (e) {
                        console.error('Error al analizar JSON:', e);
                    }
                }
            });
        });
        
    }
    var deletedIds = [];
    function removeWidgets(deletedId) {
        deletedIds.push(deletedId);
        mergedJSON = JSON.stringify(deletedIds);
        $('#widgets_to_remove').attr('data-remove-widgets', mergedJSON);
    }

    function ckeditor(wid){
        $('[noahs_page_builder-editor]').each(function (index, element) {
            $(this).attr('id', 'noahs_page_builder_editor_' + index);
                const editorElement = document.querySelector('#noahs_page_builder_editor_' + index);

                ClassicEditor
                .create(editorElement, {})
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        var selector = $(editor.sourceElement).data('update-selector');
                        var contenidoIframe = $('#noahs_page_builder_preview').contents().find('#widget-id-' + wid + ' ' + selector);
                        // console.log(editor.sourceElement);
                   
                       
                        $(contenidoIframe).html(editor.getData());
                        $(editorElement).html(editor.getData());
                        modificarJson(editorElement, wid);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar el editor:', error);
                });

        });
    }
    function removeWidgetsDataBase(id){
       
  

        $.ajax({
            url: '/noahs-admin/remove-widgets/' + id,
            type: 'POST',
            dataType: 'json',
            success: function (data) {

                createAlert('','Widgets removed!','','info',true,true,'pageMessages');                       },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(errorThrown);
                createAlert('Opps!',textStatus + ":" +  'Something went wrong','Check your drupal Recent log messages.','danger',true,false,'pageMessages');
            }
        });
    }

})(jQuery, Drupal, drupalSettings);



