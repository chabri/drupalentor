/**
 * @file
 * Javascript for Color Field.
 */

(function ($, Drupal, drupalSettings) {

            
    $(document).on("click", '.noahs_copy_element', function(e){
        e.preventDefault();

        var clonedSection = copyElement(this).prop('outerHTML');

       navigator.clipboard.writeText(clonedSection)
       .then(function() {
           alert("The content has been copied to the clipboard.");
       })
       .catch(function(error) {
           console.error("Error when pasting from clipboard: ", error);
           alert("Error al copiar al portapapeles. Consulta la consola para más detalles.");
       });
    })

    //Paste functions
    $(document).on("click", '.noahs_paste_element', function(e){
        e.preventDefault();
        if( $(this).closest('.noahs_page_builder-widget').hasClass('widget-noahs-row')){
            var currentSection = $(this).closest('.noahs_page_builder-widget').find('.row-elements');
        }
        if( $(this).closest('.noahs_page_builder-widget').hasClass('widget-noahs-column')){
            var currentSection = $(this).closest('.noahs_page_builder-widget').find('.noahs_page_builder-column--content-inner ');
        }
       
       navigator.clipboard.readText()
       .then(function(textoPegado) {

      
        currentSection.after(textoPegado);
       })
       .catch(function(error) {
           console.error("Error when pasting from clipboard: ", error);
           alert("Error when pasting from clipboard. See the console for more details.");
       });
    })

    $(document).on("click", '.noahs_paste_in_page', function(e){
        e.preventDefault();
        var currentSection = $('.noahs_page_builder-wrapper .builder-wrapper');
    
       navigator.clipboard.readText()
       .then(function(textoPegado) {

            if($(textoPegado).hasClass('widget-noahs-row')){
                currentSection.before(textoPegado);
            }else{
                alert("This actions is only for sections");
            }
      
       })
       .catch(function(error) {
           console.error("Error when pasting from clipboard: ", error);
           alert("Error when pasting from clipboard. See the console for more details.");
       });
    })

    $(document).on("click", '.close_modal_global_widgets', function(e){
        e.preventDefault();
        $(this).closest('form').remove();
    })

    $(document).on("click", '.noahs_remove_as_global', function(e){
        e.preventDefault();
        $(this).closest('.noahs_page_builder-widget').removeAttr('data-widget-global');
        $(this).closest('.noahs_page_builder-widget-action-tabs').removeClass('widget-global');
        window.noahs_page_builderSavePage();
    })
    

    //Saves As Global
    $(document).on("submit", '#saveWidgetAsGlobalForm', function(e){
        e.preventDefault();

        var title = $(this).find('input[name="NoahsGlobalTitle"]').val();
        var widget_id = $(this).find('input[name="NoahsGlobalWid"]').val();
        var langcode = $(this).find('input[name="NoahsGlobalLangcode"]').val();
        var settings = $(this).find('.NoahsGlobalSettings').data('settings');
        var widget_type = $(this).find('input[name="input"]').val();

        var data = {
            title:  title,
            widget_id: widget_id,
            langcode: langcode,
            settings: JSON.stringify(settings),
            widget_type: widget_type,
        };

        var result="";

        $.ajax({
            url: '/noahs-admin/noahs_page_builder/save-widget-global',
            method: 'POST',
            data: JSON.stringify(data),
            async: false,  
            success:function(data) {
                $('#widget-id-' + widget_id).attr('data-widget-global', 'true');
                window.noahs_page_builderSavePage();
                $('#saveWidgetAsGlobalForm').remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + ":" + jqXHR.responseText);
            }
        });
    })
    
    $(document).on("click", '.noahs_save_as_global', function(e){

        e.preventDefault();
     
        var widget_type = $(this).closest('.noahs_page_builder-widget').data('type');
        var widget_id = $(this).closest('.noahs_page_builder-widget').data('widget-id');
        var settings = $(this).closest('.noahs_page_builder-widget').data('settings');
        var langcode = $('#noahs_page_builder').data('langcode');

        var data = {
            widget_id: widget_id,
            langcode: langcode,
            settings: JSON.stringify(settings),
            widget_type: widget_type,
        };

        $.ajax({
            url: '/noahs-admin/noahs_page_builder/save-widget-global-modal',
            method: 'POST',
            data: JSON.stringify(data),
            async: false,  
            success:function(data) {
                $('body').append($(data));
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + ":" + jqXHR.responseText);
            }
        });
    })


    // Save As Theme
    $(document).on("submit", '#saveSectionAsThemeForm', function(e){
        e.preventDefault();

        var title = $(this).find('input[name="NoahsGlobalTitle"]').val();
        var html = $(this).find('.NoahsGlobalSettings').text();

        var data = {
            title:  title,
            html: html,
        };

        var result="";

        $.ajax({
            url: '/noahs-admin/noahs_page_builder/save-section-theme',
            method: 'POST',
            data: JSON.stringify(data),
            async: false,  
            success:function(data) {
                console.log('success');
                $('#saveSectionAsThemeForm').remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + ":" + jqXHR.responseText);
            }
        });
    })
    
    $(document).on("click", '.noahs_save_as_theme', function(e){

        e.preventDefault();
        var html = '<div class=" noahs_page_builder-wrapper">';
            html += copyElement(this).prop('outerHTML');
            html += '</div>';
        var settings = window.getWidgetStructure(html);

        var data = {
            html: settings,
        };

        $.ajax({
            url: '/noahs-admin/noahs_page_builder/save-section-theme-modal',
            method: 'POST',
            data: JSON.stringify(data),
            async: false,  
            success:function(data) {
                $('body').append($(data));
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + ":" + jqXHR.responseText);
            }
        });
    })

    $(document).on("click", '.noahs_paste_saved_theme', function(e){

        e.preventDefault();
        var id = $(this).data('id');

        var data = {
            id: id,
        };

        $.ajax({
            url: '/noahs-admin/noahs_page_builder/'+id+'/get-theme',
            method: 'POST',
            data: JSON.stringify(data),
            async: false,  
            success:function(data) {
                var html = transformWidget($(data));

                $('.noahs_page_builder-wrapper .builder-wrapper').append($(html).addClass('caca'));
                $('.noahs_page_builder-media-modal').remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + ":" + jqXHR.responseText);
            }
        });
    })

    $(document).on("click", '.noahs_open_widget_gallery', function(e){
        e.preventDefault();

        $.ajax({
            url: '/noahs-admin/noahs_page_builder/themes-list-modal',
            method: 'POST',
            async: false,  
            success:function(data) {

                $('body').append($(data.html));
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus + ":" + jqXHR.responseText);
            }
        });
    })

    $(document).on("click", '.close-media-modal', function(e){
        e.preventDefault();
        $('.noahs_page_builder-media-modal').remove();
    })
    
    $(document).on("click", ".noahs_page_builder-up-widget", function() {
        var section = $(this).closest(".noahs_page_builder-widget");
        section.insertBefore(section.prev());
    });

    $(document).on("click", ".noahs_page_builder-down-widget", function() {
        var section = $(this).closest(".noahs_page_builder-widget");
        section.insertAfter(section.next());
    });

    // Editar widget
    $(document).on('click', '.noahs_page_builder-edit-widget', function() {
        var $widget = $(this).closest('.noahs_page_builder-widget');
        var widget = $widget.data('type');
        var widget_id = $widget.data('widget-id');
        var settings = $widget.attr('data-settings');
        var form = addWidgetForm(widget, widget_id, jQuery.parseJSON(settings));
    
        window.noahs_page_builderOpenModal(form);
    });

    $(document).ready(function() {   


        // $('#noahs_page_builder').on('mouseenter', '.area_tooltip', function () {
        //     $(this).tooltip({html: true});
        // });
        // $(".widget-noahs-row").draggable({
        //     containment: ".builder-wrapper",
        //     cursor: "move",
        //     revert: true,
        //     snap: true
        //   });
        // $(".widget-noahs-column").draggable({
        //     containment: ".row-elements",
        //     cursor: "move",
        //     revert: true,
        //     snap: true
        //   });
        // $(".element-widget").draggable({
        //     connectWith: ".connected-sortable",
        //     stack: '.connected-sortable ul',
        //     containment: ".noahs_page_builder-column--content-inner",
        //     cursor: "move",
        //     revert: true,
        //     snap: true
        //   });

        $('.area_tooltip').tooltip({html: true});
        
          $("#noahs_page_builder .builder-wrapper").sortable({
            items: '.widget-noahs-row',
            handle: ".noahs_page_builder-move-section",
            cursor: "move",
            opacity: 0.5,
          });

          $(".widget-noahs-row .row-elements").sortable({
            items: '.widget-noahs-column',
            handle: ".noahs_page_builder-move-column",
            cursor: "move",
            opacity: 0.5,
          });

          $(".widget-noahs-column .noahs_page_builder-column--content-inner").sortable({
            items: '.element-widget',
            handle: ".noahs_page_builder-move-widget",
            connectWith: ".noahs_page_builder-column--content-inner",
            tolerance: "pointer",
            forcePlaceholderSize: true,
            cursor: "move",
            opacity: 0.5,
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

        // $('[data-bs-toggle]').on('click', function () {
        //     var id = $(this).attr('href');
        //     $('.tab-content .tab-pane').removeClass('active');
        //     $('body').find(id).addClass('active');
        //     $(this).closest('.nav-tabs').find('.nav-link').removeClass('active');
        //     $(this).addClass('active');

        // });

        // Añadir sección
        $('.noahs_add_section').on('click', function () {
            var html =  window.addWidget('noahs_row');
            $(this).closest('#noahs_page_builder').find('.builder-wrapper').append(html);
            $("#noahs_page_builder .builder-wrapper").sortable("refresh");

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
            window.noahs_page_builderAddColum($(this).data('widget-id'));
            $(".widget-noahs-row .row-elements").sortable("refresh");
        });

        //Añadir elemento
        $('.builder-wrapper').on('click', '.noahs_page_builder-add-element-widget', function() {
            window.addElementWidgetModal($(this).data('widget-id'));
            $(".widget-noahs-column .noahs_page_builder-column--content-inner").sortable("refresh");
        });

        // Manejar el evento de clic en el botón de clonar
        $('#noahs_page_builder').on('click', '.noahs_page_builder-clone-widget', function () {
            var clonedSection = copyElement(this);
            var currentSection = $(this).closest('.noahs_page_builder-widget');
            currentSection.after(clonedSection);
        });

        $('.builder-wrapper').on('click', '.save-widget', function() {
            var data = $(this).closest('.noahs_page_builder-row').data('type');
        });

 

    });
    
    function copyElement(element){

        // Clonar la sección

        var currentSection = $(element).closest('.noahs_page_builder-widget');
        var clonedSection = currentSection.clone();

        transformWidget(clonedSection)
    
        return transformWidget(clonedSection);
    }

    function transformWidget(clonedSection){

        var newSuffix = generateUniqueId();
        var newId = newSuffix;

        $(clonedSection).attr('data-widget-id', newId);

        $(clonedSection).data('settings').wid = newId;
        $(clonedSection).attr('data-settings', JSON.stringify($(clonedSection).data('settings')));
        $(clonedSection).find('[data-widget-id]').attr('data-widget-id', newId);


        $(clonedSection).addClass('widget-cloned');
        // Generar nuevos sufijos aleatorios para los elementos clonados
        $(clonedSection).find('[id^="widget-id-"]').each(function () {
            var newSuffix = generateUniqueId();
            $(this).find('[data-widget-id]').attr('data-widget-id', newSuffix);
            $(this).attr('data-widget-id', newSuffix);
            $(this).data('settings').wid = newSuffix;
            $(this).attr('data-settings', JSON.stringify($(this).data('settings')));

            $(this).addClass('widget-cloned');

        });

        return clonedSection;
    }
    // Función para generar un ID único
    function generateUniqueId() {
        return Math.random().toString(36).substr(2, 10);
    }

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
        url: '/noahs-admin/modal-form/' + drupalSettings.nid + '/' + widget_id + '/' + section_id,
        method: 'POST',
        data: JSON.stringify(data),
        async: false,  
        success:function(html) {
            result =  html;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(textStatus + ":" + jqXHR.responseText);
        }
        });
     return result;  
    }




})(jQuery, Drupal, drupalSettings);



