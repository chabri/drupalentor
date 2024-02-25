<?php 


use Drupal\noahs_page_builder\WidgetBase;
use Drupal\block\Entity\Block;

   class element_noahs_drupal_block extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-brands fa-drupal"></i>',
            'title' => 'Drupal Block',
            'description' => 'Description',
            'group' => 'Drupal'
         ];
      }
      
      public function render_form(){
         $form = [];
         $options = noahs_page_builder_load_blocks();

         $form['drupal_block'] = [
            'type'    => 'select',
            'title'   => t('Drupal Block'),
            'tab' => 'section_content',
            'options' => $options,
         ];
         return $form;
      }

      public function template( $settings ){
         $render_block = '';
         $settings = $settings->element;

         if(!empty($settings->drupal_block)){
            $block_manager = \Drupal::service('plugin.manager.block');
            $config = [];
            $plugin_block = $block_manager->createInstance($settings->drupal_block, $config);
        
            $render_block = '<div>Missing view, block "'.$settings->drupal_block.'"</div>';
            if($plugin_block){
               $render_block = \Drupal::service('renderer')->render($plugin_block->build());
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
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



