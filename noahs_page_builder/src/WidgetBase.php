<?php 

namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controller\NoahsSaveStylesController;

class WidgetBase {
  
  public function wrapper($data, $content) {

      $config = \Drupal::config('noahs_page_builder.settings');

      $divider_declaration = '';
      
      $settings = !empty($data->settings->element) ? $data->settings->element : null;

    if(!empty($settings) && !empty($settings->bg_divider)){
      $dividers = $settings->bg_divider;

      foreach($dividers as $k => $divider){
   
          

            $width = ($divider->width) ? $divider->width : '100';
            $height = !empty($divider->height) ? $divider->height : '300';
            $color = $divider->color ?? $config->get('principal_color');
            $transform = '';
            $direction = '';
            
						if($k === 'bottom'){
              $divider_declaration .= '<div class="noahs-divider-svg after">';
              $transform = 'transform: rotate(180deg);';
           
              if(!empty($divider->direction)){
                $transform = 'transform: rotate(180deg) scaleX(-1);';
              }
            }
            if($k === 'top'){
              $divider_declaration .= '<div class="noahs-divider-svg">';
              if(!empty($divider->direction)){
                $direction = 'transform: scaleX(-1);';
              }
            }

            if(!empty($divider->type) && $divider->type === 'waves'){
              $divider_declaration .= '
              <svg
                preserveAspectRatio="none"
                viewBox="0 0 1200 120"
                xmlns="http://www.w3.org/2000/svg"
                style="fill: '.$color.'; width: '.$width.'%; height: '.$height.'px; '.$transform.' '.$direction.';">
                <path d="M321.39 56.44c58-10.79 114.16-30.13 172-41.86 82.39-16.72 168.19-17.73 250.45-.39C823.78 31 906.67 72 985.66 92.83c70.05 18.48 146.53 26.09 214.34 3V0H0v27.35a600.21 600.21 0 00321.39 29.09z" />
              </svg>';
            }
            if(!empty($divider->type) && $divider->type === 'waves_2'){
              $divider_declaration .= '
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35.28 2.17" preserveAspectRatio="none"
              style="fill: '.$color.'; width: '.$width.'%; height: '.$height.'px; '.$transform.' '.$direction.';">
              <path d="M0 1c3.17.8 7.29-.38 10.04-.55 2.75-.17 9.25 1.47 12.67 1.3 3.43-.17 4.65-.84 7.05-.87 2.4-.02 5.52.88 5.52.88V0H0z"></path>
              </svg>';
            }
            if(!empty($divider->type) && $divider->type === 'triangle'){
              $divider_declaration .= '
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 1" preserveAspectRatio="none"
              style="fill: '.$color.'; width: '.$width.'%; height: '.$height.'px; '.$transform.' '.$direction.';">
              <path d="M0 0h10L5 1z"></path>
              </svg>';
            }
            if(!empty($divider->type) && $divider->type === 'triangle_invert'){
              $divider_declaration .= '
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 476.62 100.69" preserveAspectRatio="none"
              style="fill: '.$color.'; width: '.$width.'%; height: '.$height.'px; '.$transform.' '.$direction.';">
              <path d="M0 0v100.69L238.3 5.22l238.32 95.47V0Z"></path>
              </svg>';
            }
            if(!empty($divider->type) && $divider->type === 'curve'){
              $divider_declaration .= '
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 2" preserveAspectRatio="none"
              style="fill: '.$color.'; width: '.$width.'%; height: '.$height.'px; '.$transform.' '.$direction.';">
              <path d="M0 0q5 4 10 0z"></path>
              </svg>';
            }
            if(!empty($divider->type) && $divider->type === 'slash'){
              $divider_declaration .= '
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 476.62 100.69" preserveAspectRatio="none"
              style="fill: '.$color.'; width: '.$width.'%; height: '.$height.'px; '.$transform.' '.$direction.';">
              <path d="M0 0q5 4 10 0z"></path>
              </svg>';
            }
						if(!empty($divider->type) && $divider->type === 'tilt'){
							$divider_declaration .= '  <svg
              preserveAspectRatio="none"
              viewBox="0 0 1200 120"
              xmlns="http://www.w3.org/2000/svg"
              style="fill: '.$color.'; width: '.$width.'%; height: '.$height.'px; '.$transform.' '.$direction.';"
            >
              <path d="M1200 120L0 16.48V0h1200v120z" />
            </svg>';
						}
						if(!empty($divider->type) && $divider->type === 'waves_opaque'){
							$divider_declaration .= '  <svg
              preserveAspectRatio="none"
              viewBox="0 0 1200 120"
              xmlns="http://www.w3.org/2000/svg"
              style="fill: '.$color.'; width: '.$width.'%; height: '.$height.'px; '.$transform.' '.$direction.';"
            >
              <path
              d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
              opacity=".25"
            />
              <path
                d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
                opacity=".5"
              />
              <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
            </svg>';
						}
						if(!empty($divider->type) && $divider->type === 'triangles'){
							$divider_declaration .= '  <svg
              preserveAspectRatio="none"
              viewBox="0 0 1200 120"
              xmlns="http://www.w3.org/2000/svg"
              style="fill: '.$color.'; width: '.$width.'%; height: '.$height.'px; '.$transform.' '.$direction.';"
            >
              <path  d="M60 120L0 0h120L60 120zm120 0L120 0h120l-60 120zm120 0L240 0h120l-60 120zm120 0L360 0h120l-60 120zm120 0L480 0h120l-60 120zm120 0L600 0h120l-60 120zm120 0L720 0h120l-60 120zm120 0L840 0h120l-60 120zm120 0L960 0h120l-60 120zm120 0L1080 0h120l-60 120z"/>
            </svg>';
						}
            $divider_declaration .= '</div>';
      }
    
    }

      $element = 'div';
      $class = ['noahs_page_builder-widget', 'widget-'. str_replace('_', '-', $data->type)];
      $subclass = ['widget-wrapper'];
      $widget_default = 'element';
      $column_size = null;
      $obj = new \stdClass();
      $global_class =  !empty($data->global) ? 'widget-global' : '';
      $tabs = "<ul class='noahs_page_builder-widget-action-tabs tab-{$data->type} $global_class'>";
      $id = !empty($data->wid) ? $data->wid : uniqid();
      $uid =\Drupal::currentUser()->id();

      $fields = noahs_page_builder_get_widget_fields($data->type);
      
      $tabs .= "<li><div class='area_tooltip noahs_page_builder-edit-widget' title='Edit' data-widget-id='$id'><i class='fa-solid fa-pen-to-square'></i></div></li>";

      if($data->type === 'noahs_row'){
        $element = 'section';
        $widget_default = 'section';
        $tabs .= "<li><div class='area_tooltip noahs_page_builder-add-column' title='Add Column' data-widget-id='$id'><i class='fa-solid fa-plus'></i></div></li>";
        $tabs .= "<li><div class='area_tooltip noahs_page_builder-move-section' title='Move' data-widget-id='$id'><i class='fa-solid fa-up-down-left-right'></i></div></li>";

      }else if($data->type === 'noahs_column'){
        $widget_default = 'column';
        $column_size = $data->column_size ?? null;
        $class[] = 'col-xs-12';
  
        array_push($class, $column_size);
        $tabs .= "<li><div class='area_tooltip noahs_page_builder-add-element-widget' title='Add Widget' data-widget-id='$id'><i class='fa-solid fa-plus'></i></div></li>";
        $tabs .= "<li><div class='area_tooltip noahs_page_builder-move-column' title='Move' data-widget-id='$id'><i class='fa-solid fa-up-down-left-right'></i></div></li>";

      }else{
        $class[] = 'element-widget';
        $tabs .= "<li><div class='area_tooltip noahs_page_builder-move-widget' title='Move' data-widget-id='$id'><i class='fa-solid fa-up-down-left-right'></i></div></li>";
      }
      if(!empty($settings->elemenet_animation_active) && $settings->elemenet_animation_active === 'true'){
        $class[] = 'scrollme';
        $subclass[] = 'animateme';
      }

      $tabs .= "<li><div class='area_tooltip noahs_page_builder-remove-widget' title='Remove' data-widget-id='$id'><i class='fa-solid fa-trash'></i></div></li>";
      $tabs .= "<li><div class='area_tooltip noahs_page_builder-up-widget' title='Up' data-widget-id='$id'><i class='fa-solid fa-arrow-up'></i></div></li>";
      $tabs .= "<li><div class='area_tooltip noahs_page_builder-down-widget' title='Down' data-widget-id='$id'><i class='fa-solid fa-arrow-down'></i></div></li>";
      $tabs .= "<li><div class='area_tooltip noahs_page_builder-clone-widget' title='Clone' data-widget-id='$id'><i class='fa-solid fa-clone'></i></div></li>";
      $tabs .= '<li><div class="dropdown">
      <div class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical"></i>
      </div>';
      $tabs .= '<ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
        <li class="d-block"><div class="dropdown-item d-block noahs_copy_element">Copy</div></li>';
        if($data->type != 'noahs_row' && $data->type != 'noahs_column' && empty($global_class)){
          $tabs .= '<li class="d-block"><div class="dropdown-item d-block noahs_save_as_global">Save as Global</div></li>';
        }
        if(!empty($global_class)){
          $tabs .= '<li class="d-block"><div class="dropdown-item d-block noahs_remove_as_global">Detach as Global</div></li>';
        }

        if($data->type === 'noahs_row'){
          $tabs .= '<li class="d-block"><div class="dropdown-item d-block noahs_save_as_theme">Save as Theme</div></li>';
        }
        if($data->type === 'noahs_column' || $data->type === 'noahs_row'){
          $tabs .= '<li class="d-block"><div class="dropdown-item d-block noahs_paste_element">Paste</div></li>';
        }
      $tabs .= '</ul>
      </div></li>';
      $tabs .= '</ul>';
      $widget_class = '';
      $class = implode(' ', $class);
      $subclass = implode(' ', $subclass);
      $route = \Drupal::routeMatch()->getRouteName();

      $obj->wid = $data->wid;
      $obj->did = $data->did;
      $obj->type = $data->type; 
      if(empty($data->settings->element)){
        $obj->element = [];
      }
  


      $html_tabs = '';
      $data_setting = '';
      $widgetStyles = '';
      $data_global = !empty($data->global) ? 'data-widget-global="true"' : null;

      if ($route === 'noahs_page_builder.preview' || 
          $route === 'noahs_page_builder.widget' || 
          $route === 'noahs_page_builder_pro.iframe' || 
          $route === 'noahs_page_builder.product_preview' || 
          $route === 'noahs_page_builder_pro.get_theme' || 
          $route === 'noahs_page_builder.final_widget'
          ){

       $data_setting = !empty($data->settings) ? $data->settings : $obj;
       $data_setting = ' data-settings="'.htmlspecialchars(json_encode($data_setting), ENT_QUOTES, 'UTF-8').'"';
       

       $efw = !empty($data->settings) ? json_decode(json_encode($data->settings), true) : json_decode(json_encode($obj), true);

       $inlineCSS = new NoahsSaveStylesController;
       $widgetStyles = '<style id="w_style_'.$data->wid.'">' . $inlineCSS->generateWidgetStyles($efw) . '</style>';
      }else{

     
        $tabs = '';
      }




      return '
          <'.$element.' 
          class="'.$class.'" 
          data-widget-type="'.$widget_default.'" 
          id="widget-id-'.$id.'" 
          data-widget-id="'.$id.'" 
          '.($column_size ? 'data-column-size="'.$column_size.'"' : '').'
          data-type="'.$data->type.'" 
          ' . $data_setting . '
          ' . $data_global . '
          >
          ' . $tabs . '
          ' . $divider_declaration . '
          <div class="'.$subclass.'">
                  ' . $content . '
          </div>
          ' . $widgetStyles . '
          </'.$element.'>
      ';
    }

  public function getSettings($settings){

    // return !empty($settings) ? json_decode($settings, true) : null;
  }

  private function agregarElementoALista($tabs, $list, $text = '') {
    $listElement = $tabs->createElement('li', $text);
    $list->appendChild($listElement);
  }

  private function agreateButton($tabs, $list, $text, $class, $delta, $id, $icon_class) {
    $items = $list->getElementsByTagName('li');
    $selected = $items->item($delta);
    $button = $tabs->createElement('div');
    $button->setAttribute('class', $class .' area_tooltip');  
    $button->setAttribute('title', $text); 
    $button->setAttribute('data-widget-id', $id); 

    // Crear un elemento <i> con la clase personalizada
    $icon = $tabs->createElement('i');
    $icon->setAttribute('class', "$icon_class");

    // Agregar el elemento <i> como hijo del botón
    $button->appendChild($icon);

    $selected->appendChild($button);
  }

 
}
