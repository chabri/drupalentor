<?php 
use Drupal\drupalentor\WidgetBase;

   class element_drupalentor_button extends WidgetBase{
      
      public function data(){
         return [
            'icon' => '<i class="fa-solid fa-link"></i>',
            'title' => 'Button',
            'description' => 'Button link',
            'group' => 'Drupalentor'
         ];
      }
      public static function gsc_button_id($length=12){
         $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
         $randomString = '';
         for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
         }
         return $randomString;
      }

      public function render_form(){

         $form['section_content'] = [
            'type' => 'tab',
            'title' => t('Content')
         ];

   		$form['button_title'] = [
            'type' => 'text',
            'title' => t('Button Title'),
            'tab' => 'section_content',
            'placeholder' => t('Title'),
            'update_selector' => '.widget-content'
         ];

   		$form['button_url'] = [
            'type' => 'text',
            'title' => t('URL'),
            'tab' => 'section_content',
            'placeholder' => t('Pase url here'),
         ];

   		$form['button_style'] = [
            'type' => 'select',
            'title' => t('Style'),
            'tab' => 'section_content',
            'options' => [
               '' => 'Por defecto',
               'info' => 'Información',
               'success' => 'Correcto',
               'warning' => 'Advertencia',
               'danger' => 'Peligro',
            ]
         ];

         $form['button_horizontal_align'] = [
            'type'    => 'select',
            'title'   => t('Horizontal Align'),
            'tab' => 'section_content',
            'style_type' => 'style',
            'style_selector' => 'widget', 
            'style_css' => 'justify-content',
            'responsive' => true,
            'options' => [
               '' => 'Por defecto',
               'flex-start' => 'Start',
               'center' => 'Center',
               'flex-end' => 'End',
               'space-between' => 'Space Betwenn',
               'space-around' => 'Space Around',
               'space-evenly' => 'Space Evenly'
            ]
         ];

         $form['section_styles'] = [
            'type' => 'tab',
            'title' => t('Styles')
         ];

         $form['background_color'] = [
            'type' => 'drupalentor_color',
            'title' => t('Background Color'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'style_css' => 'background-color', 
            'style_hover' => true,
            'responsive' => true,
         ];

         $form['font'] = [
            'type' => 'drupalentor_font',
            'title' => t('Font'),
            'tab' => 'section_content',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'responsive' => true,
         ];

         $form['border'] = [
            'type' => 'drupalentor_border',
            'title' => t('Border'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'style_css' => 'border', 
            'responsive' => true,
            'style_hover' => true,
         ];

         $form['btn_margin'] = [
            'type' => 'drupalentor_margin',
            'title' => t('Margin'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'style_css' => 'margin', 
            'responsive' => true,
            'style_hover' => true,
         ];

         $form['btn_padding'] = [
            'type' => 'drupalentor_padding',
            'title' => t('Padding'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'style_css' => 'padding', 
            'responsive' => true,
            'style_hover' => true,
         ];
											
         return $form;
      }

      public function template( $settings ){

         ob_start();
         ?>
         <div class="btn-container">
            <a href="<?php echo $settings['element']['button_url'] ?? null; ?>" class="btn btn-<?php echo $settings['element']['button_style'] ?? 'success'; ?>"><?php echo $settings['element']['button_title'] ?? 'My button'; ?></a>
         </div>
         <?php       
         return ob_get_clean();
      }
      public function render_content($section, $settings = null, $content = null) {
	
         return $this->wrapper($section, $settings, $this->template($settings, $content));
      }
   }




