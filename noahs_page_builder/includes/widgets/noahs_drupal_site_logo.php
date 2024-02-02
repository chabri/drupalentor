<?php 


use Drupal\noahs_page_builder\WidgetBase;
use Drupal\Core\Url;

   class element_noahs_drupal_site_logo extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-brands fa-drupal"></i>',
            'title' => 'Drupal Site Logo',
            'description' => 'Description',
            'group' => 'Drupal'
         ];
      }
      
      public function render_form(){
         $form = [];

         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];
         $form['logo_width'] =[
            'type'    => 'noahs_width',
            'title'   => ('Logo Width'),
            'style_type' => 'style',
            'style_selector' => '.widget-content img', 
            'style_css' => 'width', 
            'tab' => 'section_content',
            'responsive' => true,
            'placeholder' => 'use as 10%, 100px, 100vw...',
         ];
   
         return $form;
      }

      public function template( $settings ){

         $settings = $settings['element'];
         $logo_relative_path = theme_get_setting('logo.url');


         ?>
         <?php ob_start() ?>
               <div class="widget-content">
                  <img src="<?php echo $logo_relative_path; ?>">
               </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content( $settings = null, $content = null) {
                return $this->wrapper($element, $this->template(json_decode($element->settings, true)));

      }
   }

   



