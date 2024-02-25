<?php 


use Drupal\noahs_page_builder\WidgetBase;
use Drupal\token\TokenEntityMapperInterface;
use Drupal\token\TokenServiceInterface;
use Drupal\Core\Render\Markup;
   class element_noahs_drupal_token extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-solid fa-code"></i>',
            'title' => 'Drupal Token',
            'description' => 'Description',
            'group' => 'Drupal'
         ];
      }
      
      public function render_form(){
         $form = [];

         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Gallery')
         ];

         $form['token'] = [
            'type'    => 'text',
            'title'   => t('Token'),
            'tab' => 'section_content'
         ];
         
         $form['token_button'] = [
            'type'    => 'html',
            'value'   => '<a class="btn btn-s btn-info noahs_page_builder-modal-tokens mb-4" href="#">Select Token</a>',
            'tab' => 'section_content'
         ];

         return $form;
      }

      public function template( $settings ){

         $settings = $settings->element;
         $token_service = \Drupal::token();

         // Token que deseas renderizar.
         $token = $settings->token;
         
         // Renderiza el token.
         $rendered_token = $token_service->replace($token);

         ?>
         <?php ob_start() ?>
               <div class="widget-content">
                  <?php echo Markup::create($rendered_token); ?>
               </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



