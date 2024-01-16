<?php 

use Drupal\drupalentor\WidgetBase;

   class element_drupalentor_separator extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-solid fa-arrows-left-right"></i>',
            'title' => 'Separator',
            'description' => 'Description',
            'group' => 'Drupalentor'
         ];
      }
      public function render_form(){
         $form = [];

         // Section Content
         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];
   

         $form['separator_type'] = [
            'type'      => 'select',
            'tab'     => 'section_content',
            'title'     => ('Type'),
            'options' => [
               'h1' => 'H1',
               'h2' => 'H2',
               'h3' => 'H3',
               'h4' => 'H4',
               'h5' => 'H5',
               'h6' => 'H6',
            ],
            'update_selector_html' => '.widget-content > *' 

         ];
         return $form;
      }

      public static function template( $settings ){

         $ouput = '';
         $ouput .= '<div class="widget-content">';
         $ouput .=  isset($settings['element']['text']) ? $settings['element']['text'] : '<h2>Your Text Here</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mollis consequat dui in ultricies. Maecenas iaculis aliquet iaculis. Maecenas magna mi, pulvinar sed malesuada nec, convallis euismod libero.</p>';
         $ouput .= '</div>';
         return $ouput;
      }

      public function render_content($section, $settings = null, $content = null) {
       
         return $this->wrapper($section, $settings, $this->template($settings));
      }
   }




