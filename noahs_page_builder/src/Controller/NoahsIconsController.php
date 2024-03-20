<?php
/**
 * @file
 * Contains \Drupal\noahs_page_builder\Controller\noahs_page_builderController.
 */

namespace Drupal\noahs_page_builder\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;




class NoahsIconsController extends ControllerBase{

   

    public function listOfIcons() {


      return [
          '#theme' => 'noahs_icons_list',
          '#content' => 'dewdwe',
          '#icons' => $this->htmlIconsScript(),
          '#attached' =>[
            'library' => [
              'noahs_page_builder/noahs_page_builder.fontawesome',
              'noahs_page_builder/noahs_page_builder.bootstrap',
            ],
          ],

      ];
    }

    private function getIcons() {

      $content = file_get_contents(NOAHS_PAGE_BUILDER_PATH . '/assets/icons.json');
      $json = json_decode($content);
      $icons = [];
  
      foreach ($json as $icon => $value) {
        
          foreach ($value->styles as $style) {
        
              $icons[$style][$icon] = "fa-$style fa-$icon";
          }
      }

      return $icons;

    }

    private function htmlIconsScript(){
      $icons = $this->getIcons();
      $firstIteration = true;

      ?>
      <?php ob_start() ?>
      <nav>
          <div class="nav nav-pills mb-3 justify-content-center" id="nav-tab" role="tablist">
              <?php foreach ($icons as $key => $items): ?>
                  <button class="nav-link <?php echo ($firstIteration) ? 'active' : ''; ?> text-uppercase p-3" id="nav-<?php echo $key; ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $key; ?>" type="button" role="tab" aria-controls="nav-<?php echo $key; ?>" aria-selected="true"><?php echo $key; ?></button>
                  <?php $firstIteration = false; ?>
              <?php endforeach; ?>
          </div>
      </nav>
      <div class="tab-content p-3 border bg-light" id="nav-tabContent">
          <form>
              <div class="mb-3">
                  <label for="iconSearch" class="form-label">Search Icon</label>
                  <input type="text" class="form-control" id="iconSearch">
              </div>
          </form>
          <?php $firstIteration = true; ?>
          <?php foreach ($icons as $key => $items): ?>
              <div class="tab-pane fade <?php echo ($firstIteration) ? 'active show' : ''; ?>" id="nav-<?php echo $key; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $key; ?>-tab">
                  <div class="d-flex flex-wrap g-2">
                      <div class="col-12"><h4><?php echo $key; ?></h4></div>
                      <?php $firstIterationInner = true; ?>
                      <?php foreach ($items as $k => $icon): ?>
                          <div class="col-1" data-group="<?php echo $key; ?>" data-icon="<?php echo $icon; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $k; ?>">
                              <div class="p-3 border d-flex justify-content-center"><i class="<?php echo $icon; ?>"></i></div>
                          </div>
                          <?php $firstIterationInner = false; ?>
                      <?php endforeach; ?>
                  </div>
                  <?php $firstIteration = false; ?>
              </div>
          <?php endforeach; ?>
      </div>


      <?php return ob_get_clean() ?>  
         <?php   
    }

    public function modal(Request $request){
        $data = json_decode($request->getContent(), TRUE);
        $output = '<div class="noahs_page_builder-media-modal modal-type-icon">';
        $output .= '<div class="noahs_page_builder-modal_container pb-0">';
        $output .=  $this->htmlIconsScript();
        $output .= '<div class="d-flex justify-content-between mt-4 bg-white pt-2 pb-2 sticky-bottom">
        <button class="btn btn-danger btn-labeled close-media-modal"><span class="btn-label"><i class="fa-solid fa-xmark"></i></span>Close</button>
        <button type="button" class="btn btn-success btn-labeled insert-media-modal" data-element-id="'.$data['element_id'].'" data-thumbnail=""><span class="btn-label"><i class="fa-solid fa-check"></i></span>'.t("Insert selected").'</button>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

       return new Response($output);
    }
}

