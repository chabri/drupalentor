<?php 
use Drupal\drupalentor\WidgetBase;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

   class element_drupalentor_gallery extends WidgetBase{
      
      public function data(){
         return [
            'icon' => '<i class="fa-regular fa-images"></i>',
            'title' => 'Image Gallery',
            'description' => 'Description',
            'group' => 'Drupalentor'
         ];
      }
      
      public function render_form(){
         $form = [];
         $image_styles = \Drupal::entityQuery('image_style')->execute();
         // Section Content
         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Gallery')
         ];
         $form['gallery_add_button'] = [
            'type' => 'html',
            'title' => 'Test',
            'tab' => 'section_content',
            'value' => '<button class="btn btn-secondary btn-labeled drupalentor-add-item mb-3" id="add_multiple_images_field" data-element-id="gallery-images-wrapper"><span class="btn-label"><i class="fa-solid fa-circle-plus"></i></span>Add new Item</button>'
         ];
         $form['gallery_items'] = [
            'type'    => 'drupalentor_gallery',
            'title'   => t('Gallery Items'),
            'tab' => 'section_content',
         ];

         $form['gallery_image_style'] = [
            'type'    => 'select',
            'title'   => t('Image Style'),
            'tab' => 'section_content',
            'options' => $image_styles,
         ];
         $form['gallery_type'] = [
            'type'    => 'select',
            'title'   => t('Gallery Type'),
            'tab' => 'section_content',
            'options' => [
               'grid' => t('Grid'),
               'mazorny' => t('Mazorny'),
            ]
         ];


         $form['gallery_type_columns'] = [
            'type'    => 'select',
            'title'   => t('Colums'),
            'tab' => 'section_content',
            'style_type' => 'class',
            'style_selector' => '.drupalentor-gallery', 
            'options' => [
               '' => 'Default',
               'columns-1' => '1',
               'columns-2' => '2',
               'columns-3' => '3',
               'columns-4' => '4',
               'columns-5' => '5',
               'columns-6' => '6',
               'columns-7' => '7',
               'columns-8' => '8',
               'columns-8' => '9',
               'columns-10' => '10',
            ],
         ];


         return $form;
      }

      public function template( $settings ){

         $image = '/'.DRUPALENTOR_PATH.'/assets/img/widget-image.jpg';
         $items = isset($settings['element']['gallery_items'])  ? $settings['element']['gallery_items'] : [];
         $image_style = $settings['element']['gallery_image_style'] ?? 'thumbnail';
         $gallery_type = $settings['element']['gallery_type'] ?? 'grid';
         $gallery_columns = $settings['element']['gallery_type_columns'] ?? '4';

         ?>
         <?php ob_start() ?>
            <div class="drupalentor-gallery <?php echo $gallery_type; ?>">
               <?php foreach($items as $item) { 

                  if(isset($item['fid'])){
                     $file = File::load($item['fid']);
                     $file_uri = $file->getFileUri();
                     $image = ImageStyle::load($image_style)->buildUrl($file_uri);
                  }
          
                  ?>
                  <div class="gallery-item">
                     <?php if(isset($item['url'])) { echo '<a href="' . $item['url'] . '"><i class="fa-solid fa-link"></i></a>';} ?>
                     <a data-fancybox="gallery" href="<?php echo $image; ?>"><i class="fa-solid fa-magnifying-glass"></i></a>
                     <img class="gallery-image-src" src="<?php echo $image; ?>">
                  </div>
               <?php } ?>
            </div>
         <?php return ob_get_clean() ?>  
         <?php       
      }
      
      public function render_content($section, $settings = null, $content = null) {
         return $this->wrapper($section, $settings, $this->template($settings));
      }
   }





