<?php
/**
 * @file
 * Contains \Drupal\noahs_page_builder_pro\Controller\noahs_page_builderController.
 */

namespace Drupal\noahs_page_builder_pro\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\File\FileSystemInterface;




class NoahsMaskImageProController extends ControllerBase{

   

    static function list($name = null) {


        $module_path = NOAHS_PAGE_BUILDER_PRO_PATH;

        $mask = [];
        $icon_folder_path = $module_path . '/assets/svg-mask-kit/';
        $file_system = \Drupal::service('file_system');

        $files = $file_system->scanDirectory($icon_folder_path, '/\.svg$/');

        
        // Renderiza los archivos.
        foreach ($files as $file) {
          // Ruta completa del archivo.
          $mask[] = '/' . $file->uri;
        
          // Haz algo con la ruta del archivo, por ejemplo, imprimir la ruta.

        }

      return $mask;

    }


}

