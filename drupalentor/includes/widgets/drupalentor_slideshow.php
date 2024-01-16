<?php 


use Drupal\drupalentor\WidgetBase;

   class element_drupalentor_slideshow extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-solid fa-layer-group"></i>',
            'title' => 'Slideshow',
            'description' => 'Description',
            'group' => 'Drupalentor'
         ];
      }
      
      public function render_form(){
         $form = [];
         $options = drupalentor_load_blocks();
		// Section Content
		$form['section_content'] = [
			'type' => 'tab',
			'title' =>  t('Content')
		];
         $form['slideshow_items'] = [
            'type'    => 'drupalentor_multiple_fields',
            'title'   => t('Slideshow Items'),
            'tab' => 'section_content',
            'fields' => [
               'slideshow_title' => [
                  'title' => 'Title',
                  'type' => 'text',
                  'placeholder' => 'This is a h2'
               ],
               'slideshow_text' => [
                  'title' => 'Text',
                  'type' => 'textarea'
               ],
               'slideshow_image' => [
                  'title' => 'Image',
                  'type' => 'drupalentor_image'
               ],
               'slideshow_url' => [
                  'title' => 'Url',
                  'type' => 'text'
               ],
      
            ],
         ];
         return $form;
      }

      public function template( $settings ){
        $elements = !empty($settings['element']['slideshow_items']) ? $settings['element']['slideshow_items'] : [];

         ?>
         <?php ob_start() ?>
         <div class="swiper drupalentor-slideshow">
         <!-- Additional required wrapper -->
         <div class="swiper-wrapper">
            <!-- Slides -->
            <?php foreach($elements as $element){ ?>
            <div class="swiper-slide">
               <h2><?php echo $element['slideshow_title']; ?></h2>
               <div class="drupalentor-slideshow--content"><?php echo $element['slideshow_text']; ?></div>
               <div class="drupalentor-slideshow--button d-flex justify-content-center mt-5">
                <a class="btn btn-primary" href="<?php echo $element['slideshow_url']; ?>" role="button">Link</a>
               </div>
            </div>
            <?php } ?>
   
            
         </div>
         <!-- If we need pagination -->
         <div class="swiper-pagination"></div>

         <!-- If we need navigation buttons -->
         <div class="swiper-button-prev"></div>
         <div class="swiper-button-next"></div>

         <!-- If we need scrollbar -->
         <div class="swiper-scrollbar"></div>
         </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content($section, $settings = null, $content = null) {
         return $this->wrapper($section, $settings, $this->template($settings));
      }
   }

   



