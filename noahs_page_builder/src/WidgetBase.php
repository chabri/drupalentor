<?php 

namespace Drupal\noahs_page_builder;

class WidgetBase {
  
  public function wrapper($data, $content) {

      $element = 'div';
      $class = ['noahs_page_builder-widget', 'widget-'. str_replace('_', '-', $data->type)];
      $widget_default = 'element';
      $column_size = null;
      // dump($id);

      $id = !empty($data->wid) ? $data->wid : uniqid();
      $uid =\Drupal::currentUser()->id();
      $tabs = new \DOMDocument();
      $list = $tabs->createElement('ul');
      $list->setAttribute('class', 'noahs_page_builder-widget-action-tabs tab-' . $data->type);
  
      $this->agregarElementoALista($tabs, $list);

      $this->agreateButton($tabs, $list, 'Edit', 'noahs_page_builder-edit-widget', 0, $id, 'fa-solid fa-pen-to-square');
      
    
      if($data->type === 'noahs_row'){
        $element = 'section';
        $widget_default = 'section';
        $this->agregarElementoALista($tabs, $list);
        $this->agreateButton($tabs, $list, 'Add Column', 'noahs_page_builder-add-column', 0, $id, 'fa-solid fa-plus');
        $this->agreateButton($tabs, $list, 'Move', 'noahs_page_builder-move-section', 0, '', 'fa-solid fa-up-down-left-right');
      }else if($data->type === 'noahs_column'){
        $widget_default = 'column';
        $column_size = $data->column_size ?? null;
        $class[] = 'col-xs-12';
        array_push($class, $column_size);
        $this->agreateButton($tabs, $list, 'Add Widget', 'noahs_page_builder-add-element-widget', 0, $id, 'fa-solid fa-plus');
        $this->agreateButton($tabs, $list, 'Move', 'noahs_page_builder-move-column', 0, '', 'fa-solid fa-up-down-left-right');
      }else{
        $class[] = 'element-widget';
        $this->agreateButton($tabs, $list, 'Move', 'noahs_page_builder-move-widget', 0, '', 'fa-solid fa-up-down-left-right');
      }
      
      $this->agreateButton($tabs, $list, 'Remove', 'noahs_page_builder-remove-widget', 0, '', 'fa-solid fa-trash');
     
      $this->agreateButton($tabs, $list, 'Up', 'noahs_page_builder-up-widget', 0, '', 'fa-solid fa-arrow-up');
      $this->agreateButton($tabs, $list, 'Down', 'noahs_page_builder-down-widget', 0, '', 'fa-solid fa-arrow-down');
      $this->agreateButton($tabs, $list, 'Cone', 'noahs_page_builder-clone-widget', 0, $id, 'fa-solid fa-clone');

      $widget_class = '';

      $class = implode(' ', $class);
      $tabs->appendChild($list);

      $route = \Drupal::routeMatch()->getRouteName();

      $html_tabs = '';
      if ($route === 'noahs_page_builder.preview' || $route === 'noahs_page_builder.widget' || $route === 'noahs_page_builder.final_widget'){
       
       $html_tabs = $tabs->saveHTML();
      }
      // dump($data);
      // dump($data);
      // $settings = $this->getSettings($data->settings);
      // dump($data->settings);
      $settings = $data->settings;
      $data_setting = isset($settings) ? $settings : array(
        'wid' => $id, 
        'did' => $data->did, 
        'uid' => $uid, 
        'type' => $data->type, 
        'langcode' =>  $data->langcode,
        'elements' => array());
      // dump($data);
      // dump($settings);
      // dump($data_setting);
   

      // dump($data_setting);
      $data_setting = htmlspecialchars(json_encode($data_setting), ENT_QUOTES, 'UTF-8');
      return '
          <'.$element.' 
          class="'.$class.'" 
          data-widget-type="'.$widget_default.'" 
          id="widget-id-'.$id.'" 
          data-widget-id="'.$id.'" 
          '.($column_size ? 'data-column-size="'.$column_size.'"' : '').'
          data-type="'.$data->type.'" 
          data-settings="'.$data_setting.'" 
          >
          <div class="before"></div>
                  ' . $html_tabs . '
                  ' . $content . '
          <div class="after"></div>
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
