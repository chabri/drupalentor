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
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class NoahsSectionSaveAsGlobalProController extends ControllerBase{

   

     
  public function saveWidgetModal(Request $request){

    $data = json_decode($request->getContent(), TRUE);

    $result = '<form id="saveSectionAsThemeForm" class="">
            <button type="button" class="btn-close close_modal_global_widgets" aria-label="Close"></button>

            <div class="input-group">
              <input type="text" name="NoahsGlobalTitle" class="form-control element-admin" placeholder="Widget Title" aria-label="Widget Title" aria-describedby="button-addon2">
            <textarea class="NoahsGlobalSettings" hidden>'.htmlspecialchars($data['html'], ENT_QUOTES, 'UTF-8').'</textarea>
            <button class="btn btn-success btn-admin" type="submit" id="button-addon2">Save</button>
          </div>
          </form>';

  return new JsonResponse($result); 
}

  public function saveWidget(Request $request){

    $data = json_decode($request->getContent(), TRUE);
    $title = $data['title'];
    $settings = $data['html'];


    $builder = \Drupal::database()->insert("noahs_page_builder_pro_theme")
      ->fields(array(
          'title' => $title,
          'html' => $settings,
      ))
    ->execute();
    $result = 'Widget añadido correctamente';
    

  return new JsonResponse($result); 
}

public function getList(){

  $builder = \Drupal::database()->select('noahs_page_builder_pro_theme', 'mt')
    ->fields('mt', ['id', 'title'])
    ->execute()
    ->fetchAll();

    $node_types_options = [];

    foreach($builder as $k => $type){
      $node_types_options[$k][$type->id] = $type->title;
      $node_types_options[$k]['remove'] = ['data' => array(
        '#markup' => '<a href="/noahs-admin/noahs_page_builder/'.$type->id.'/delete-theme" 
        class="action-link action-link--danger action-link--icon-trash" 
        role="button">
        '. t('Remove').'
        </a>',
      ),];
      $node_types_options[$k]['export'] = ['data' => array(
        '#markup' => '<a href="/noahs-admin/noahs_page_builder/'.$type->id.'/theme-export" 
        class="button button--delete" 
        target="_blank" 
        role="button">
        '. t('Export').'
        </a>',
      ),];

    }
    $header = [
      'type' => t('Title'),
      'remove' => t('Remove'),
      'export' => t('Export'),
    ];

    $table = [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $node_types_options,
      '#empty' => t('No content has been found.'),
      '#attributes' => [
        'class' => 'table',
      ],
    ];
    return [
      '#type' => '#markup',
      '#markup' => \Drupal::service('renderer')->render($table)
    ];

  }

  public function getTheme($id){
    $builder = \Drupal::database()->select('noahs_page_builder_pro_theme', 'mt')
    ->fields('mt', ['html'])
    ->condition('id', $id)
    ->execute()
    ->fetchAssoc();
   return new JsonResponse(noahs_page_builder_html_generated(json_decode($builder['html'])));
  }

  public function modalThemes(){
    
    return new JsonResponse(['html' => $this->listOfThemes()]);
  }

  private function listOfThemes(){
    $builder = \Drupal::database()->select('noahs_page_builder_pro_theme', 'mt')
    ->fields('mt', ['id', 'title'])
    ->execute()
    ->fetchAll();
    $noahs_themes = [];
    $output = '<div class="noahs_page_builder-media-modal modal-type-themes">';
    $output .= '<div class="noahs_page_builder-modal_container pb-0">';
    $output .= '<nav>';
    $output .= '<div class="nav nav-pills mb-3 justify-content-center" id="nav-tab" role="tablist">';
    $output .= '<button class="nav-link active text-uppercase p-3 active" id="nav-noahs-theme-tab" data-bs-toggle="tab" data-bs-target="#nav-noahs-theme" type="button" role="tab" aria-controls="nav-noahs-theme" aria-selected="true">Noahs themes</button>';
    $output .= '<button class="nav-link active text-uppercase p-3" id="nav-user-noahs-theme-tab" data-bs-toggle="tab" data-bs-target="#nav-user-noahs-theme" type="button" role="tab" aria-controls="nav-user-noahs-theme" aria-selected="true">My themes</button>';
    $output .= '</div>';
    $output .= '</nav>';
    $output .= '<div class="tab-content p-3 border bg-light" id="nav-tabContent">';
    $output .= '<form>';
    $output .= '<div class="mb-3">';
    $output .= '<label for="iconSearch" class="form-label">Search Icon</label>';
    $output .= '<input type="text" class="form-control element-admin" id="iconSearch">';
    $output .= '</div>';
    $output .= '</form>';
    $output .= '<div class="tab-pane fade active show" id="nav-noahs-theme" role="tabpanel" aria-labelledby="nav-noahs-theme-tab">';
    $output .= '<div class="d-flex flex-wrap g-2">';
    $output .= '<div class="col-12"><h4>Noahs Themes</h4></div>';
    foreach ($noahs_themes as $k => $item) {
        $output .= '<div class="col-1" data-group="noahs-theme" data-bs-toggle="tooltip" data-bs-placement="top">';
        $output .= '<div class="p-3 border d-flex justify-content-center"></div>';
        $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="tab-pane fade" id="nav-user-noahs-theme" role="tabpanel" aria-labelledby="nav-user-noahs-theme-tab">';
    $output .= '<div class="d-flex flex-wrap g-2">';
    $output .= '<div class="col-12"><h4>My Themes</h4></div>';
    foreach ($builder as $k => $item) {
        $output .= '<div class="col-4" data-group="user-noahs-theme" data-bs-toggle="tooltip" data-bs-placement="top">';
        $output .= '<div class="p-3 border d-flex justify-content-center noahs_paste_saved_theme" data-id="' . $item->id . '">' . $item->title . '</div>';
        $output .= '</div>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="mt-4 bg-white pt-2 pb-2 sticky-bottom text-end">';
    $output .= '<button class="btn btn-danger btn-labeled close-media-modal btn-admin"><span class="btn-label"><i class="fa-solid fa-xmark"></i></span>Close</button>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;


  }


  public function export($id){
    

    $builder = \Drupal::database()->select('noahs_page_builder_pro_theme', 'mt')
    ->fields('mt', ['title', 'html'])
    ->condition('id', $id)
    ->execute()
    ->fetchAssoc();

    $string = strtolower($builder['title']);
    $string = str_replace(' ', '_', $string);
    $string = preg_replace('/[^a-z0-9_]/', '', $string);
    $json_data = new JsonResponse($builder);

    $response = new Response($json_data);
    $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $string . '.json');
    $response->headers->set('Content-Disposition', $disposition);
    $response->headers->set('Content-Type', 'application/json');

    return $response;
  }
}

