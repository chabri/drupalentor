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
        
    $('#noahs_page_builder-preview').on('load', function() {
        // Inyectar la función en el iframe
        this.contentWindow.noahs_page_builderOpenModal = noahs_page_builderOpenModal;
        this.contentWindow.noahs_page_builderAddColum = noahs_page_builderAddColum;
        this.contentWindow.addElementWidgetModal = addElementWidgetModal;
        this.contentWindow.removeWidgets = removeWidgets;
        this.contentWindow.addWidget = addWidget;
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

    $(document).on("click", '#noahs_page_builder_icon_data', function(e){
        e.preventDefault();
        var element_id  = $(this).data('element-id');
        openIconModal(element_id);
    })
    $(document).on("click", '.noahs_page_builder-modal-tokens', function(e){
        e.preventDefault();
        
        openDialogToken();
    })


    $(document).on("keyup", '[data-update-selector]', function(e){
        e.preventDefault();
        var selector = $(this).data('update-selector');
        var contenidoIframe = $('#noahs_page_builder-preview').contents().find(selector);
        $(contenidoIframe).text($(this).val());
    })

    $(document).on("change", '[data-update-selectorhtml]', function(e){
        e.preventDefault();
        var contenidoIframe = $('#noahs_page_builder-preview').contents();
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
    $(document).on("keyup", '[name="element[separator_weight]"]', function(e){

        e.preventDefault();
        var contenidoIframe = $('#noahs_page_builder-preview').contents();
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
        var contenidoIframe = $('#noahs_page_builder-preview').contents().find('#noahs_page_builder').html();

        $('.noahs_page_builder-preview-content').resizable({
            handles: {
              'e': '.r',
              'w': '.l'
            }
        });

        $("#btn-desktop").on("click", function() {
            $(".noahs_page_builder-preview-content").css({
                "width": "100%",
            });
        });
        $("#btn-tablet").on("click", function() {
            $(".noahs_page_builder-preview-content").css({
                "width": "840px",
            });
        });
        $("#btn-mobile").on("click", function() {
            $(".noahs_page_builder-preview-content").css({
                "width": "460px",
            });
        });
        
        $('.area_tooltip').tooltip({html: true});



        $('#noahs_page_builder_form_builder').on("submit", function(e){
            e.preventDefault();
            const formData = getWidgetStructure();
            console.log(JSON.parse(formData));
            noahs_page_builderSavePage(formData);
            var deletedIds = $('#widgets_to_remove').attr('data-remove-widgets')
           
            if(deletedIds){
                JSON.parse(deletedIds).forEach(element => {
                    // removeWidgetsDataBase(element);
                });
               
            }
            document.getElementById('noahs_page_builder-preview').contentWindow.location.reload(true);

            return false;
          })
        $('#noahs_page_builder_sttings_page_form').on("submit", function(e){

            e.preventDefault();
            const formData = getWidgetStructure();
  
            noahs_page_builderSavePage(formData);
          
            var deletedIds = $('#widgets_to_remove').attr('data-remove-widgets')
           
            if(deletedIds){
                JSON.parse(deletedIds).forEach(element => {
                    // removeWidgetsDataBase(element);
                });
               
            }
           
            return false;
          })
        $('[data-bs-toggle]').on('click', function () {
            var id = $(this).attr('href');
            $('.tab-content .tab-pane').removeClass('active');
            $('body').find(id).addClass('active');
            $(this).closest('.nav-tabs').find('.nav-link').removeClass('active');
            $(this).addClass('active');

        });
    });
    
    function addClasses(classes){

        var iframeContent = $('#noahs_page_builder-preview').contents();

        // Iterar sobre las clases y aplicarlas al contenido del iframe
        $.each(classes, function (index, values) {
            $.each(values, function (selector, className) {
                iframeContent.find(selector).addClass(className);
            });
        });
    }
    // se obteiene la estructura de datos de la página
    function getWidgetStructure(){
        var contenidoIframe = $('#noahs_page_builder-preview').contents().find('#noahs_page_builder').html();

        // Crear un objeto para almacenar la estructura serializada
        var estructuraSerializada = [];

        // Iterar sobre cada elemento con la clase "section"
        $(contenidoIframe).find('section[data-widget-type="section"]').each(function(index, section) {
            var sectionId = $(section).data('widget-id'); // Obtener el ID de la sección
            var type = $(section).data('type'); // Obtener el ID de la columna
            var widget_type = $(section).data('widget-type'); // Obtener el ID de la columna
            var settings = $(section).data('settings'); // Obtener el ID de la columnaa
          
            var sectionData = {
                id: sectionId,
                type: type,
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
                    id: columnId,
                    type: type,
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

                    var elementsData = {
                        id: widgetId,
                        type: type,
                        widget_type: widget_type,
                        settings: settings,
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
        $(contenidoIframe).find('.widget-cloned').each(function() {

            var dataSettings = $(this).data('settings');
            noahs_page_builderSaveWidgetfromStruture(dataSettings);

            $('.widget-cloned').removeClass('widget-cloned');
        });
        // Convertir la estructura serializada a JSON
        var estructuraSerializadaJSON = JSON.stringify(estructuraSerializada);
        return estructuraSerializadaJSON;

    }


    // formulario de edicion modal
    function noahs_page_builderOpenModal(form){
        $(form).remove();
        $('body').append(form);
        $(document).trigger('myAjaxFinished');


        var settings = $(form).find('.form-data-settings').data('settings') ?? $(form).serializeJSON();

        
        const formElement = $('.noahs_page_builder-modal form');

        ckeditor(settings.wid);

        $('.background-image-field').each(function(index) {
            var bg_fid = $(this).find('.background-fid');
            var bg_thumb = $(this).find('.background-thumbnail').val();
            if(bg_thumb){
                $(this).find('.background-thumbnail-image').attr('src',bg_thumb).show();
            }
            $(this).find('.media-uploadbg_image').attr('data-element-id', bg_fid.attr('id'));
         });

        $('.media-uploadbg_image').on('click', function (e) {
            e.preventDefault();
            var element_id = $(this).data('element-id');
            var name = $(this).data('element-id');
            openMediaModal(element_id, 'single');
        });
        $('#add_multiple_images_field').on('click', function (e) {
            e.preventDefault();

            var element_id = $(this).data('element-id');
            var elements =  $('.noahs_page_builder_gallery_field').find('.image-box').length;
            openMediaModal(element_id, 'multiple', elements);
        });

        formElement.on("submit", function(e){
            e.preventDefault();
            // var formData = $(this).find('input').not('[value=""]').serializeJSON();
            var formData = $(this).find(':input').filter(function () {
                return $.trim(this.value).length > 0
            }).serializeJSON();
            console.log(formData);

            const widget_id = $('input[name="wid"]').val();
            noahs_page_builderSave(formData);
            $('#noahs_page_builder-preview').contents().find('#widget-id-' + settings.wid).attr('data-settings', JSON.stringify(formData));
            document.getElementById('noahs_page_builder-preview').contentWindow.location.reload(true);
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
           
            
            var count = $(this).closest('.noahs_page_builder_multiple_field').find('.accordion-item').length;
            var newHtml = htmlData.replace(/replace_it/g, (count + 1));
            var $tempDiv = $('<div>').html(newHtml);
            $tempDiv.find('.accordion-button').text('Accordion Item #' + (count + 1));
            $tempDiv.find('.accordion-header').attr('id', 'header_' + (count + 1));
            $tempDiv.find('.accordion-button').attr('data-bs-target', '#slideshow_' + (count + 1));
            $tempDiv.find('.accordion-button').attr('aria-controls', 'slideshow_' + (count + 1));
            $tempDiv.find('.accordion-collapse').attr('id', 'slideshow_' + (count + 1));
            $tempDiv.find('.accordion-collapse').attr('aria-labelledby', 'header_' + (count + 1));
        
            var updatedHtml = $tempDiv.html();
        
            $(this).closest('.noahs_page_builder_multiple_field').find('.accordion').append(updatedHtml);
          

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
                // Actualiza los atributos y valores para cada elemento de la galería.
                $(".gallery-images-wrapper .image-box").each(function(index) {
                    // Actualiza el atributo 'data-delta'.
                    $(this).attr('data-delta', index);

                    // Actualiza el ID del elemento hover-modal.
                    var hoverModalId = 'edit-gallery-image-' + index;
                    $(this).find('.noahs_page_builder-hover-modal').attr('id', hoverModalId);

                    // Actualiza el atributo 'data-show-click' en el botón de editar.
                    $(this).find('.noahs_page_builder-edit-grid-item').attr('data-show-click', '#' + hoverModalId);

                    // Actualiza los atributos 'name' de los inputs dentro del hover-modal.
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

    function openDialogToken(){
        var ajaxSettings = {
            url: '/admin/get_token',
            dialogType: 'modal',
            dialog: { width: 800 },
          };
          var myAjaxObject = Drupal.ajax(ajaxSettings);
          myAjaxObject.execute();
    }

    // Media modal
    function openMediaModal(element_id, type, total){

        var data = {
            element_id: element_id,
            type: type,
        };

        $.ajax({
        url: '/admin/noahs_page_builder/media-modal', // Reemplaza con la URL de tu ruta de Ajax.
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
                    
                    for (var i = 0; i < selectedData.length; i++) {
                    var index = (total + i);
                      selectedHtml += '<div class="col-3 image-box mb-2">';
                      selectedHtml += '<div class="noahs_page_builder-edit-grid-item btn btn-sm btn-info position-absolute top-50 start-50 translate-middle rounded-circle" data-show-click="#edit-gallery-image-'+index+'"><i class="fa-solid fa-pen-to-square"></i></div>';
                      selectedHtml += '<div class="noahs_page_builder-move-grid-item btn btn-sm btn-info position-absolute top-0 start-0 rounded-circle"><i class="fa-solid fa-arrows-up-down-left-right"></i></div>';
                      selectedHtml += '<div class="noahs_page_builder-remove-grid-item btn btn-sm btn-danger position-absolute bottom-0 end-0 rounded-circle"><i class="fa-solid fa-trash"></i></div>';
                      selectedHtml += '<img src="' + selectedData[i].thumbnail + '" data-fid="' + selectedData[i].fileid + '">';

                      selectedHtml += '<div id="edit-gallery-image-'+index+'" class="noahs_page_builder-hover-modal bg-light p-3 position-absolute top-50 start-0 translate-middle-y shadow-lg hidden w-100">';
                      selectedHtml += '<div class="btn btn-sm btn-danger position-absolute top-0 start-50 translate-middle rounded-circle" data-show-click="#edit-gallery-image-'+index+'"><i class="fa-regular fa-circle-xmark"></i></div>';
                      selectedHtml += '<input type="hidden" name="element[gallery_items]['+ index +'][fid]" value="'+ selectedData[i].fileid +'">';
                      selectedHtml += '<input class="form-control" type="text" name="element[gallery_items]['+ index +'][url]" value="">';
                      selectedHtml += '</div>';
                      
                      selectedHtml += '</div>';
                    }
                
                    // Agregar el HTML al contenedor.
                    $('#' + element_id).append(selectedHtml);
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

                    $('#' + element_id).val(fid);
                    $('#' + element_id).prev().find('.background-thumbnail-image').attr('src', thumbnail).show();
                    $('#' + element_id).next().val(thumbnail);
                    $('.noahs_page_builder-media-modal').remove();
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
                    url: '/admin/noahs_page_builder/upload_file',
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
    function openIconModal(element_id){

        var data = {
            element_id: element_id,
        };

        $.ajax({
        url: '/admin/structure/noahs_page_builder/icons/modal', // Reemplaza con la URL de tu ruta de Ajax.
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

                $('.insert-media-modal').on("click", function(e){
                    e.preventDefault();
                    var iconClass = $(this).data('icon-class');
                    var element_id = $(this).data('element-id');
    
                    $('#' + element_id).closest('.media-preview-actions').find('#noahs_page_builder_icon_class').val(iconClass);
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
                    url: '/admin/noahs_page_builder/upload_file',
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
    function addWidget(widget_id, did, langcode){
        var data = {
        widget_id: widget_id,
        did: did,
        langcode: langcode,
        };


        var result="";
        $.ajax({
        url: '/admin/noahs_page_builder/widget/' + widget_id + '/' + did + '/' + langcode, // Reemplaza con la URL de tu ruta de Ajax.
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

    // Guardar Widget 1
    function noahs_page_builderSaveWidgetfromStruture(settings) {

        var result = settings;
        var data = {
            wid: result['wid'],
            did: result['did'],
            uid: result['uid'],
            langcode: result['langcode'],
            type: result['type'],
            settings: JSON.stringify(settings),
        };


        $.ajax({
            url: drupalSettings.saveWidget,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {

                addClasses(data.classes);
                // Ejecutar el segundo AJAX después de que el primero termine
                $.ajax({
                    url: '/admin/save-styles/' + result['did'],
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {

                        var contenidoIframe = $('#noahs_page_builder-preview').contents().find('head');
                        var stylesContainer = contenidoIframe.find('[data-noahs_page_builder="' + drupalSettings.did + '"]');
                        if (stylesContainer.length) {
                            stylesContainer.text(data.styles);
                        } else {
                           
                            contenidoIframe.append('<style type="text/css" data-noahs_page_builder="' + drupalSettings.did + '">' + data.styles + '</style>');
                        }
                        // createAlert('','Styles Saved or updated!','everything went well.','info',true,true,'pageMessages');                
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        createAlert('Opps!',textStatus + ":" +  'Something went wrong','Check your drupal Recent log messages.','danger',true,false,'pageMessages');
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
    // Guardar Widget
    function noahs_page_builderSave(settings) {

        var result = settings;
        var data = {
            wid: result['wid'],
            did: result['did'],
            uid: result['uid'],
            langcode: result['langcode'],
            type: result['type'],
            settings: JSON.stringify(settings),
        };
        var formData = getWidgetStructure();

        noahs_page_builderSavePage(formData);

        $.ajax({
            url: '/admin/noahs_page_builder/save_widget',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {

                addClasses(data.classes);

                createAlert('','Widget Saved!','everything went well.','success',true,true,'pageMessages');
                // Ejecutar el segundo AJAX después de que el primero termine
                $.ajax({
                    url: '/admin/save-styles/' + result['did'],
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {

                        var contenidoIframe = $('#noahs_page_builder-preview').contents().find('head');
                        var stylesContainer = contenidoIframe.find('[data-noahs_page_builder="' + drupalSettings.did + '"]');
                        if (stylesContainer.length) {
                            stylesContainer.text(data.styles);
                        } else {
                           
                            contenidoIframe.append('<style type="text/css" data-noahs_page_builder="' + drupalSettings.did + '">' + data.styles + '</style>');
                        }
                        // createAlert('','Styles Saved or updated!','everything went well.','info',true,true,'pageMessages');                     
                      },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        createAlert('Opps!',textStatus + ":" +  'Something went wrong','Check your drupal Recent log messages.','danger',true,false,'pageMessages');
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                createAlert('Opps!',textStatus + ":" +  'Something went wrong','Check your drupal Recent log messages.','danger',true,false,'pageMessages');
            },
            complete: function () {
                // getFinalWidget(settings);
            
             }
        });
    }

    // Guardar Página
    function noahs_page_builderSavePage(settings) {

        var pageSettings = $('#noahs_page_builder_sttings_page_form').serializeJSON();
        var data = {    
            nid: drupalSettings.nid,
            did: drupalSettings.did,
            uid: drupalSettings.uid,
            langcode: drupalSettings.langcode,
            settings: settings,
            page_settings: JSON.stringify(pageSettings),
        };

        $.ajax({
            url: drupalSettings.savePage,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $.ajax({
                    url: '/admin/save-styles/' + drupalSettings.did,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        var stylesContainer =$('head').find('[data-noahs_page_builder="' + drupalSettings.did + '"]');
                        if (stylesContainer.length) {
                          stylesContainer.text(data.styles);
                        } else {
                          $('head').append('<style type="text/css" data-noahs_page_builder="' + drupalSettings.did + '">' + data.styles + '</style>');
                        }
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
            url: '/admin/final-widget/'+ result['did'] +'/'+ result['type'] +'/' + result['wid'],
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {

                var contenidoIframe = $('#noahs_page_builder-preview').contents().find('#widget-id-' + result['wid']);
                contenidoIframe.replaceWith(data.html)
                var slider = $('#noahs_page_builder-preview').contents().find('#widget-id-' + result['wid'] + ' .noahs_page_builder-slideshow');
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
    function noahs_page_builderAddColum(widget_id, did, langcode){
        $('#noahsAddColumn').modal('show');

        $('.noahs_page_builder-column-modal .column-box').on('click', function(){
            var html = addWidget('noahs_column', did, langcode);

            $('#noahs_page_builder-preview').contents().find('section[id="widget-id-'+widget_id+'"]').find('.row-elements').append(html);

            $('#noahs_page_builder-preview').contents().find('div[id="'+$(html).attr('id')+'"]').attr('data-column-size', $(this).data('column')).addClass($(this).data('column'));
            $('#noahsAddColumn').modal('hide');
        });
        
    }

    // Añadir Widget
    function addElementWidgetModal(element_id, did, langcode){
    
        $('#addElementWidgetModal').modal('show');
        // Eliminar controladores de eventos previos para .widget-box_element
        $('.noahs_page_builder-element-widget-modal .widget-box_element').off('click').on('click', function(){
            var element = $(this).data('element');
            var html = addWidget(element, did, langcode);
            $('#noahs_page_builder-preview').contents().find('div[id="widget-id-'+element_id+'"]').find('.noahs_page_builder-column--content-inner ').append(html);
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
                        var contenidoIframe = $('#noahs_page_builder-preview').contents().find('#widget-id-' + wid + ' ' + selector);
                        $(contenidoIframe).html(editor.getData());
                    });
                })
                .catch(error => {
                    console.error('Error al cargar el editor:', error);
                });

        });
    }
    function removeWidgetsDataBase(id){
       
  
        console.log(id);
        $.ajax({
            url: '/admin/remove-widgets/' + id,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                createAlert('','Widgets removed!','','info',true,true,'pageMessages');                       },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(errorThrown);
                createAlert('Opps!',textStatus + ":" +  'Something went wrong','Check your drupal Recent log messages.','danger',true,false,'pageMessages');
            }
        });
    }

})(jQuery, Drupal, drupalSettings);



