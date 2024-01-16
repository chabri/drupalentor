<?php 


use Drupal\drupalentor\WidgetBase;
use Drupal\views\Views;

class element_drupalentor_drupal_views extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-brands fa-drupal"></i>',
            'title' => 'Drupal Views',
            'description' => 'Description',
            'group' => 'Drupal'
         ];
      }
      
      public function render_form(){
         $form = [];
         $options = drupalentor_load_views();

         $form['drupal_block'] = [
            'type'    => 'select',
            'select_group'    => true,
            'title'   => t('Drupal Block'),
            'tab' => 'section_content',
            'options' => $options,
         ];
         return $form;
      }

      public function template( $settings ){
         $render_block = '';
         $settings = $settings['element'];

         if(!empty($settings['drupal_block'])){
            $views_array = json_decode($settings['drupal_block']);
            $view = Views::getView($views_array[0]);
            $display_id = Views::getView($views_array[1]);

     
            $render_block = '<div>Missing view, block "'.$settings['drupal_block'].'"</div>';
   
            if (!$view->access($display_id)) {
           
          
         
            if($view){
               $view->setDisplay($display_id);
          

             $view_render =   $view->buildRenderable($display_id);
             $render_block = \Drupal::service('renderer')->render($view_render);

             $render_block = !empty($render_block) ? $render_block ->__toString() : null;

   
            }
            }
         }
         ?>
         <?php ob_start() ?>
               <div class="widget-content">
                  <?php  print  $render_block; ?>
               </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content($section, $settings = null, $content = null) {
         return $this->wrapper($section, $settings, $this->template($settings));
      }
   }

   



