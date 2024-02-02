<?php

namespace Drupal\noahs_page_builder\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\File\FileSystem;
use Symfony\Component\HttpFoundation\Request;


class NoahsModalMediaController extends ControllerBase {

  public function mediaModal(Request $request) {

    $data = json_decode($request->getContent(), TRUE);
    $element_id = $data['element_id'];
    $files = \Drupal::entityTypeManager()->getStorage('file')
    ->loadByProperties([
      'filemime' => [
        'image/jpeg',
        'image/png',
      ]
    ]);


    // Preparar el HTML para la lista de miniaturas.
    $html = '<div class="noahs_page_builder-media-modal modal-type-'. $data['type'] .'">';
    $html .= '<div class="noahs_page_builder-modal_container">';
    $html .= '<div class="row mb-2">';
    foreach ($files as $file) {
      $file_uri = $file->getFileUri();
      $image_style_url = ImageStyle::load('thumbnail')->buildUrl($file_uri);

      $html .= '<div class="col-2 image-box mb-2" data-fileid="'.$file->id().'" data-thumbnail="'.$image_style_url.'"><span><img src="' . $image_style_url . '" alt="Thumbnail"></span></div>';
    }
    $html .= '</div>';
    $html .= '<div class="upload-image">
              <form id="noahs_page_builderUploadImageForm" enctype="multipart/form-data">
              <label>'.t('Upload Image').'</label>
              <input type="file" id="noahs_page_builder_upload_image" name="noahs_page_builder_upload_image" '.$data['type'].' title="Upload Image" accept="image/png, image/jpeg" class="form-control">
              </form>
              </div>';
    $html .= '<div class="modal-messages"></div>';
    $html .= '<div class="d-flex justify-content-between mt-4 bg-white pt-2 pb-2">
    <button class="btn btn-danger btn-labeled close-media-modal"><span class="btn-label"><i class="fa-solid fa-xmark"></i></span>Close</button>
    <button type="button" class="btn btn-success btn-labeled insert-media-modal" data-element-id="'.$element_id.'" data-thumbnail=""><span class="btn-label"><i class="fa-solid fa-check"></i></span>'.t("Insert selected").'</button>';
    $html .= '</div>';
    $html .= '</div>';

    return new JsonResponse(['html' => $html, 'data' => $data ]); 
  }
  
  public function uploadMediaModal() {
    $files = $_FILES['files'] ?? null;
    $current_date = \Drupal::time()->getCurrentTime();
    $current_month = date('Y-m', $current_date);

    $directory = 'public://' . $current_month;
    $file_system = \Drupal::service('file_system');
    $file_system->prepareDirectory($directory, FileSystemInterface::CREATE_DIRECTORY | FileSystemInterface::MODIFY_PERMISSIONS | FileSystemInterface::EXISTS_RENAME);

    $uploaded_files = [];

    foreach ($files['name'] as $key => $filename) {
        $filedata = file_get_contents($files['tmp_name'][$key]);
        $directory_url = $directory . '/' . $filename;

        $uploaded_file = \Drupal::service('file_system')->saveData($filedata, $directory_url, FileSystemInterface::EXISTS_RENAME);

        $file = File::create([
            'uri' => $uploaded_file,
        ]);

        $file->save();

        $image = \Drupal::service('file_url_generator')->generateAbsoluteString($file->getFileUri());
        $image_style_url = ImageStyle::load('thumbnail')->buildUrl($file->getFileUri());

        $uploaded_files[] = [
            'file_id' => $file->id(),
            'file_url' => $image_style_url,
        ];
    }

    if (empty($uploaded_files)) {
        return new JsonResponse(['message' => 'No se ha enviado ningún archivo.'], 400);
    }

    return new JsonResponse(['message' => 'Archivos subidos correctamente.', 'files' => $uploaded_files]);
}

}