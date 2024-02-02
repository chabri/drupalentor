<?php 


use Drupal\noahs_page_builder\WidgetBase;
use Drupal\views\Views;

class element_noahs_drupal_views extends WidgetBase{

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
         $options = noahs_page_builder_load_views();

         $form['drupal_block'] = [
            'type'    => 'select',
            'select_group_views'    => true,
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
                  <?php if (!empty($render_block)) { ?>
                  <?php  print  $render_block; ?>
                  <?php }else{ ?>
                     <div class="drupal-viewblock-empty">Drupal View</div>
                  <?php } ?>
               </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content( $settings = null, $content = null) {
                return $this->wrapper($element, $this->template(json_decode($element->settings, true)));

      }
   }

   



