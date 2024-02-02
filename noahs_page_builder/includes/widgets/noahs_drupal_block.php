<?php 


use Drupal\noahs_page_builder\WidgetBase;

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
         $settings = $settings['element'];

         if(!empty($settings['drupal_block'])){
            $block = \Drupal\block\Entity\Block::load($settings['drupal_block']);
        
            $render_block = '<div>Missing view, block "'.$settings['drupal_block'].'"</div>';
            if($block){
            $block_content = \Drupal::entityTypeManager()
               ->getViewBuilder('block')
               ->view($block);
               $block = null;
               $render_block = \Drupal::service('renderer')->render($block_content);
               $render_block->__toString();
             
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
      public function render_content( $settings = null, $content = null) {
                return $this->wrapper($element, $this->template(json_decode($element->settings, true)));

      }
   }

   



