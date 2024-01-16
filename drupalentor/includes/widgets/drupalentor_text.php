<?php 

use Drupal\drupalentor\WidgetBase;

   class element_drupalentor_text extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-solid fa-align-left"></i>',
            'title' => 'Text',
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
   
         $form['text'] = [
            'type'      => 'textarea',
            'title'     => t('Text'),
            'default_value' => '<h2>Your Text Here</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mollis consequat dui in ultricies. Maecenas iaculis aliquet iaculis. Maecenas magna mi, pulvinar sed malesuada nec, convallis euismod libero.</p>',
            'tab'     => 'section_content',
            'title'     => ('Description Separator'),
            'update_selector' => '.widget-content'
         ];
         
         $form['section_style'] = [
            'type' => 'tab',
            'title' =>  t('Style')
         ];
   
         $form['font'] = [
            'type'        => 'drupalentor_font',
            'title'       => t('Font'),
            'tab'     => 'section_style',
            'style_type' => 'style',
            'style_selector' => 'widget', 
            'responsive' => true,
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




