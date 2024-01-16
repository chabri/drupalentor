<?php 
use Drupal\drupalentor\WidgetBase;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

   class element_drupalentor_image extends WidgetBase{
      
      public function data(){
         return [
            'icon' => '<i class="fa-regular fa-image"></i>',
            'title' => 'Image',
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
     
         $form['image'] =[
            'type'    => 'drupalentor_image',
            'title'   => ('Image'),
            'desc'    => ('Multiple classes should be separated with SPACE.'),
            'tab' => 'section_content',
            'update_selector' => '.widget-image-src',
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
            'type'    => 'drupalentor_group_checkbox',
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
         return $form;
      }

      public function template( $settings ){

         $image = '/'.DRUPALENTOR_PATH.'/assets/img/widget-image.jpg';
         if($settings['element']['image']['fid']){
		
				$file = File::load($settings['element']['image']['fid']);
				$file_uri = $file->getFileUri();
				
				$image = ImageStyle::load($settings['element']['image']['image_style'])->buildUrl($file_uri);
         }
         ?>
         <?php ob_start() ?>
               <div class="widget-content">
                  <img class="widget-image-src" src="<?php echo $image; ?>">
               </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content($section, $settings = null, $content = null) {
         return $this->wrapper($section, $settings, $this->template($settings));
      }
   }





