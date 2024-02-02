(function ($, Drupal, drupalSettings, once) {

    'use strict';

    $(document).ready(function() {
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
    });
    
})(jQuery, Drupal, drupalSettings, once);