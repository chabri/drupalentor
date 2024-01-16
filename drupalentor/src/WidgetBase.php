<?php 

namespace Drupal\drupalentor;

class WidgetBase {
  
  public function wrapper($section, $settings, $content) {

      $element = 'div';
      $class = ['drupalentor-widget', 'widget-'.$section['type']];
      $widget_default = 'element';
      $column_size = null;
      // dump($id);
      $id = !empty($section['id']) ? $section['id'] : uniqid();
      $uid =\Drupal::currentUser()->id();
      $tabs = new \DOMDocument();
      $list = $tabs->createElement('ul');
      $list->setAttribute('class', 'drupalentor-widget-action-tabs tab-' . $section['type']);
  
      $this->agregarElementoALista($tabs, $list);

      $this->agreateButton($tabs, $list, 'Edit', 'drupalentor-edit-widget', 0, $id, 'fa-solid fa-pen-to-square');
      
      $data = $this->getSettings($settings);
      if($section['type'] === 'drupalentor_row'){
        $element = 'section';
        $widget_default = 'section';
        $this->agregarElementoALista($tabs, $list);
        $this->agreateButton($tabs, $list, 'Add Column', 'drupalentor-add-column', 0, $id, 'fa-solid fa-plus');
        $this->agreateButton($tabs, $list, 'Move', 'drupalentor-move-section', 0, '', 'fa-solid fa-up-down-left-right');
      }else if($section['type'] === 'drupalentor_column'){
        $widget_default = 'column';
        $column_size = $section['column_size'] ?? null;
        $class[] = 'col-xs-12';
        array_push($class, $column_size);
        $this->agreateButton($tabs, $list, 'Add Widget', 'drupalentor-add-element-widget', 0, $id, 'fa-solid fa-plus');
        $this->agreateButton($tabs, $list, 'Move', 'drupalentor-move-column', 0, '', 'fa-solid fa-up-down-left-right');
      }else{
        $class[] = 'element-widget';
        $this->agreateButton($tabs, $list, 'Move', 'drupalentor-move-widget', 0, '', 'fa-solid fa-up-down-left-right');
      }
      
      $this->agreateButton($tabs, $list, 'Remove', 'drupalentor-remove-widget', 0, '', 'fa-solid fa-trash');
     
      $this->agreateButton($tabs, $list, 'Up', 'drupalentor-up-widget', 0, '', 'fa-solid fa-arrow-up');
      $this->agreateButton($tabs, $list, 'Down', 'drupalentor-down-widget', 0, '', 'fa-solid fa-arrow-down');
      $this->agreateButton($tabs, $list, 'Cone', 'drupalentor-clone-widget', 0, $id, 'fa-solid fa-clone');

      $widget_class = '';

      $class = implode(' ', $class);
      $tabs->appendChild($list);

      $route = \Drupal::routeMatch()->getRouteName();

      $html_tabs = '';
      if ($route === 'drupalentor.preview' || $route === 'drupalentor.widget'){
       
       $html_tabs = $tabs->saveHTML();
      }

      
      $data_setting = isset($settings) ? $settings : array('wid' => $id, 'did' => $section['did'], 'uid' => $uid, 'type' => $section['type'], 'langcode' =>  $section['langcode'], 'elements' => array());
      // dump($section);
      // dump($settings);
      // dump($data_setting);
      $data_setting = htmlspecialchars(json_encode($data_setting), ENT_QUOTES, 'UTF-8');
      return '
          <'.$element.' 
          class="'.$class.'" 
          data-widget-type="'.$widget_default.'" 
          id="widget-id-'.$id.'" 
          data-widget-id="'.$id.'" 
          '.($column_size ? 'data-column-size="'.$column_size.'"' : '').'
          data-type="'.$section['type'].'" 
          data-settings="'.$data_setting.'" 
          >
                  ' . $html_tabs . '
                  ' . $content . '
          </'.$element.'>
      ';
    }

  public function getSettings($settings){

    return !empty($settings) ? $settings : null;
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
