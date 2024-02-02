<?php 


use Drupal\noahs_page_builder\WidgetBase;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

   class element_noahs_carousel extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_8103689" height="512" viewBox="0 0 60 60" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m19 15a3 3 0 1 0 -3-3 3 3 0 0 0 3 3zm0-4a1 1 0 1 1 -1 1 1 1 0 0 1 1-1z"></path><path d="m36.495 25.673a2.062 2.062 0 0 0 -2.989 0l-6.549 7.366-2.543-2.539a2.047 2.047 0 0 0 -2.828 0l-4.707 4.7a2.98 2.98 0 0 0 -.879 2.123v1.677a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2v-3.745a3 3 0 0 0 -.758-1.992zm5.505 13.327h-24v-1.677a1.007 1.007 0 0 1 .293-.707l4.707-4.707 2.544 2.544a2.154 2.154 0 0 0 1.472.584 2.011 2.011 0 0 0 1.436-.671l6.548-7.366 6.747 7.591a1 1 0 0 1 .253.664z"></path><path d="m19.5 29a3.5 3.5 0 1 0 -3.5-3.5 3.5 3.5 0 0 0 3.5 3.5zm0-5a1.5 1.5 0 1 1 -1.5 1.5 1.5 1.5 0 0 1 1.5-1.5z"></path><path d="m14 45h32a4 4 0 0 0 4-4v-32a4 4 0 0 0 -4-4h-32a4 4 0 0 0 -4 4v32a4 4 0 0 0 4 4zm32-2h-32a2 2 0 0 1 -2-2v-22h36v22a2 2 0 0 1 -2 2zm-32-36h32a2 2 0 0 1 2 2v8h-36v-8a2 2 0 0 1 2-2z"></path><path d="m14 51a4 4 0 1 0 4-4 4 4 0 0 0 -4 4zm6 0a2 2 0 1 1 -2-2 2 2 0 0 1 2 2z"></path><path d="m26 51a4 4 0 1 0 4-4 4 4 0 0 0 -4 4zm6 0a2 2 0 1 1 -2-2 2 2 0 0 1 2 2z"></path><path d="m38 51a4 4 0 1 0 4-4 4 4 0 0 0 -4 4zm6 0a2 2 0 1 1 -2-2 2 2 0 0 1 2 2z"></path><path d="m26 11h8a1 1 0 0 0 0-2h-8a1 1 0 0 0 0 2z"></path><path d="m26 15h5a1 1 0 0 0 0-2h-5a1 1 0 0 0 0 2z"></path><path d="m5.318 31.731a1 1 0 0 0 1.364-1.462l-4.582-4.269 4.585-4.269a1 1 0 0 0 -1.364-1.462l-4.741 4.411a1.792 1.792 0 0 0 0 2.64z"></path><path d="m54.682 20.269a1 1 0 0 0 -1.364 1.462l4.582 4.269-4.585 4.269a1 1 0 1 0 1.364 1.462l4.741-4.411a1.792 1.792 0 0 0 0-2.64z"></path></svg>',
            'title' => 'Carousel',
            'description' => 'Description',
            'group' => 'noahs_page_builder'
         ];
      }
      
      public function render_form(){
         
         $form = [];
         $image_styles = \Drupal::entityQuery('image_style')->execute();
         // Section Content
         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Carousel')
         ];
         $form['carousel_add_button'] = [
            'type' => 'html',
            'title' => 'Test',
            'tab' => 'section_content',
            'value' => '<button class="btn btn-secondary btn-labeled noahs_page_builder-add-item mb-3" id="add_multiple_images_field" data-element-id="carousel-images-wrapper"><span class="btn-label"><i class="fa-solid fa-circle-plus"></i></span>Add new Item</button>'
         ];
         $form['gallery_items'] = [
            'type'    => 'noahs_carousel',
            'title'   => t('carousel Items'),
            'tab' => 'section_content',
         ];

         $form['carousel_image_style'] = [
            'type'    => 'select',
            'title'   => t('Image Style'),
            'tab' => 'section_content',
            'options' => $image_styles,
         ];

         $form['carousel_type_columns'] = [
            'type'    => 'select',
            'title'   => t('Show Elements'),
            'tab' => 'section_content',
            'options' => [
               '' => 'Default',
               '1' => '1',
               '2' => '2',
               '3' => '3',
               '4' => '4',
               '5' => '5',
               '6' => '6',
               '7' => '7',
               '8' => '8',
               '9' => '9',
               '10' => '10',
            ],
         ];

         return $form;
      }

      public function template( $settings ){
         $image = '/'.NOAHS_PAGE_BUILDER_PATH.'/assets/img/widget-image.jpg';
         $items = isset($settings['element']['gallery_items'])  ? $settings['element']['gallery_items'] : [];
         $image_style = $settings['element']['carousel_image_style'] ?? 'thumbnail';
         $carousel_columns = $settings['element']['carousel_type_columns'] ?? '4';

         ?>
         <?php ob_start() ?>
            <div class="noahs_page_builder-carousel swiper" data-count-slide="<?php echo $carousel_columns; ?>">
            <div class="swiper-wrapper">
               <?php if (!empty($elements)){ ?>
                  <?php foreach($items as $item) { 

                     if(isset($item['fid'])){
                        $file = File::load($item['fid']);
                        $file_uri = $file->getFileUri();
               
                        $image = ImageStyle::load($image_style)->buildUrl($file_uri);
                     }
            
                     ?>

                     
                     <div class="swiper-slide"> 
                        <div class="noahs_page_builder-carousel--actions">
                           <?php if(isset($item['url'])) { echo '<a href="' . $item['url'] . '"><i class="fa-solid fa-link"></i></a>';} ?>
                           <a data-fancybox="carousel" href="<?php echo $image; ?>"><i class="fa-solid fa-magnifying-glass"></i></a>
                        </div>
                        <img class="carousel-image-src img-fluid" src="<?php echo $image; ?>">
                     </div>
                  <?php } ?>
               <?php } else{ ?>

                  <div class="swiper-slide">
                     <div class="noahs_page_builder-carousel--actions">
                        <a href=""><i class="fa-solid fa-link"></i></a>
                        <a data-fancybox="carousel" href="<?php echo $image; ?>"><i class="fa-solid fa-magnifying-glass"></i></a>
                     </div>
                     <img class="carousel-image-src img-fluid" src="<?php echo $image; ?>">
                  </div>
                  <div class="swiper-slide">
                     <div class="noahs_page_builder-carousel--actions">
                        <a href=""><i class="fa-solid fa-link"></i></a>
                        <a data-fancybox="carousel" href="<?php echo $image; ?>"><i class="fa-solid fa-magnifying-glass"></i></a>
                     </div>
                     <img class="carousel-image-src img-fluid" src="<?php echo $image; ?>">
                  </div>
                  <div class="swiper-slide">
                     <div class="noahs_page_builder-carousel--actions">
                        <a href=""><i class="fa-solid fa-link"></i></a>
                        <a data-fancybox="carousel" href="<?php echo $image; ?>"><i class="fa-solid fa-magnifying-glass"></i></a>
                     </div>
                     <img class="carousel-image-src img-fluid" src="<?php echo $image; ?>">
                  </div>
                  <div class="swiper-slide">
                     <div class="noahs_page_builder-carousel--actions">
                        <a href=""><i class="fa-solid fa-link"></i></a>
                        <a data-fancybox="carousel" href="<?php echo $image; ?>"><i class="fa-solid fa-magnifying-glass"></i></a>
                     </div>
                     <img class="carousel-image-src img-fluid" src="<?php echo $image; ?>">
                  </div>
                  <div class="swiper-slide">
                     <div class="noahs_page_builder-carousel--actions">
                        <a href=""><i class="fa-solid fa-link"></i></a>
                        <a data-fancybox="carousel" href="<?php echo $image; ?>"><i class="fa-solid fa-magnifying-glass"></i></a>
                     </div>
                     <img class="carousel-image-src img-fluid" src="<?php echo $image; ?>">
                  </div>
                  <div class="swiper-slide">
                     <div class="noahs_page_builder-carousel--actions">
                        <a href=""><i class="fa-solid fa-link"></i></a>
                        <a data-fancybox="carousel" href="<?php echo $image; ?>"><i class="fa-solid fa-magnifying-glass"></i></a>
                     </div>
                     <img class="carousel-image-src img-fluid" src="<?php echo $image; ?>">
                  </div>

               <?php } ?>
            </div>

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
      public function render_content( $settings = null, $content = null) {
                return $this->wrapper($element, $this->template(json_decode($element->settings, true)));

      }
   }

   



