<?php 
use Drupal\noahs_page_builder\WidgetBase;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

   class element_noahs_image extends WidgetBase{
      
      public function data(){
         return [
            'icon' => '<svg version="1.1" id="fi_149092" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
            <g>
               <path d="M57,6H1C0.448,6,0,6.447,0,7v44c0,0.553,0.448,1,1,1h56c0.552,0,1-0.447,1-1V7C58,6.447,57.552,6,57,6z M56,50H2V8h54V50z"></path>
               <path d="M16,28.138c3.071,0,5.569-2.498,5.569-5.568C21.569,19.498,19.071,17,16,17s-5.569,2.498-5.569,5.569
                  C10.431,25.64,12.929,28.138,16,28.138z M16,19c1.968,0,3.569,1.602,3.569,3.569S17.968,26.138,16,26.138s-3.569-1.601-3.569-3.568
                  S14.032,19,16,19z"></path>
               <path d="M7,46c0.234,0,0.47-0.082,0.66-0.249l16.313-14.362l10.302,10.301c0.391,0.391,1.023,0.391,1.414,0s0.391-1.023,0-1.414
                  l-4.807-4.807l9.181-10.054l11.261,10.323c0.407,0.373,1.04,0.345,1.413-0.062c0.373-0.407,0.346-1.04-0.062-1.413l-12-11
                  c-0.196-0.179-0.457-0.268-0.72-0.262c-0.265,0.012-0.515,0.129-0.694,0.325l-9.794,10.727l-4.743-4.743
                  c-0.374-0.373-0.972-0.392-1.368-0.044L6.339,44.249c-0.415,0.365-0.455,0.997-0.09,1.412C6.447,45.886,6.723,46,7,46z"></path>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            </svg>',
            'title' => 'Image',
            'description' => 'Description',
            'group' => 'noahs_page_builder'
         ];
      }
      public function render_form(){
         $form = [];

         // Section Content
         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];
     
         $form['image'] =[
            'type'    => 'noahs_image',
            'title'   => ('Image'),
            'desc'    => ('Multiple classes should be separated with SPACE.'),
            'tab' => 'section_content',
            'update_selector' => '.widget-image-src',
         ];
         $form['mask_image'] = [
            'type'    => 'noahs_image_mask',
            'title'   => t('Mask Image'),
            'tab' => 'section_content',
            'style_type' => 'style',
            'style_selector' => '.widget-wrapper', 
         ];
         $form['horizontal_align'] = [
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

         $form['hidden_image'] = [
            'type'    => 'noahs_group_checkbox',
            'title'   => t('Hide Image'),
            'tab' => 'section_content',
            'style_type' => 'class',
            'style_selector' => 'widget', 
            'options' => [
               'hidden-xs' => t('Hide on mobile'),
               'hidden-md' => t('Hide on Tablet'),
               'hidden-lg' => t('Hide on desktop'),
            ]
         ];

         $form['section_styles'] = [
            'type' => 'tab',
            'title' =>  t('Styles')
         ];
         $form['box_shadows'] = [
            'type'    => 'noahs_shadows',
            'title'   => t('Image Shadow'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.widget-image-src', 
            'responsive' => true, 
            'style_hover' => true,
         ];
         $form['border-radius'] = [
            'type'    => 'noahs_radius',
            'title'   => t('Border Radius'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.widget-image-src', 
            'responsive' => true, 
            'style_hover' => true,
         ];
         return $form;
      }

      public function template( $settings ){

         $image = '/'.NOAHS_PAGE_BUILDER_PATH.'/assets/img/widget-image.jpg';

         if(!empty($settings->element->image->fid)){
		
				$file = File::load($settings->element->image->fid);
				$file_uri = $file->getFileUri();
				
				$image = ImageStyle::load($settings->element->image->image_style)->buildUrl($file_uri);
         }
         ?>
         <?php ob_start() ?>

               <div class="widget-wrapper">
                  <img class="widget-image-src <?php echo !empty($settings->element->image->fid) ? '' : 'empty' ?>" src="<?php echo $image; ?>">
               </div>
               
         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }





