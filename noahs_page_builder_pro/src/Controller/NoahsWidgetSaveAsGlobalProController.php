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


class NoahsWidgetSaveAsGlobalProController extends ControllerBase{

   

     
  public function saveWidgetModal(Request $request){

    $data = json_decode($request->getContent(), TRUE);

    $result = '<form id="saveWidgetAsGlobalForm" class="">
            <button type="button" class="btn-close close_modal_global_widgets" aria-label="Close"></button>

            <div class="input-group">
              <input type="text" name="NoahsGlobalTitle" class="form-control" placeholder="Widget Title" aria-label="Widget Title" aria-describedby="button-addon2">
           
            <input type="hidden" name="NoahsGlobalWid" value="' . $data['widget_id'] . '">
            <input type="hidden" name="NoahsGlobalLangcode" value="' . $data['langcode'] . '">
            <input type="hidden" name="NoahsGlobalType" value="' . $data['widget_type'] . '">
            <div class="NoahsGlobalSettings hdiden" data-settings="'.htmlspecialchars($data['settings'], ENT_QUOTES, 'UTF-8').'"></div>
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Save</button>
          </div>
          </form>';

  return new JsonResponse($result); 
}
  public function saveWidget(Request $request){

    $data = json_decode($request->getContent(), TRUE);
    $title = $data['title'];
    $widget_id = $data['widget_id'];
    $langcode = $data['langcode'];
    $settings = $data['settings'];
    $widget_type = $data['widget_type'];



    $builder = \Drupal::database()->select('noahs_page_builder_pro_global_widget', 'd')
      ->fields('d', array('wid'))
      ->condition('wid', $widget_id)
      ->execute()
      ->fetchAssoc();
    
    if($builder != NULL){
        $schema = \Drupal::database()->update("noahs_page_builder_pro_global_widget")
        ->fields(array(
            'settings' => $settings,
        ))
        ->condition('wid', $widget_id)
        ->execute();
        $result = 'Widget Actualizado correctamente';
    }else{
        $builder = \Drupal::database()->insert("noahs_page_builder_pro_global_widget")
          ->fields(array(
              'title' => $title,
              'wid' => $widget_id,
              'langcode' => $langcode,
              'settings' => $settings,
              'type' => $widget_type,
          ))
        ->execute();
        $result = 'Widget añadido correctamente';
    }

  return new JsonResponse($result); 
}

}

