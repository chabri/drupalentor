<?php 

use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_video_button_pro extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_3204345" enable-background="new 0 0 1550 1550" height="512" viewBox="0 0 1550 1550" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><g><g><path d="m1009.3 804.9c-11.6 0-21-9.4-21-21 0-55.6-45.3-100.9-100.9-100.9s-100.9 45.3-100.9 100.9c0 11.6-9.4 21-21 21s-21-9.4-21-21c0-78.8 64.1-142.9 142.9-142.9s142.9 64.1 142.9 142.9c0 11.6-9.4 21-21 21z"></path></g><g><g><path d="m1058.1 1117.4c-11.6 0-21-9.4-21-21v-79.6c0-19.8-16.1-35.9-35.9-35.9s-35.9 16.1-35.9 35.9c0 11.6-9.4 21-21 21s-21-9.4-21-21c0-42.9 34.9-77.9 77.9-77.9s77.9 34.9 77.9 77.9v79.6c0 11.6-9.4 21-21 21z"></path></g><g><path d="m1171.8 1096.9c-11.6 0-21-9.4-21-21v-42.8c0-19.8-16.1-35.9-35.9-35.9s-35.9 16.1-35.9 35.9c0 11.6-9.4 21-21 21s-21-9.4-21-21c0-42.9 34.9-77.9 77.9-77.9 42.9 0 77.9 34.9 77.9 77.9v42.8c0 11.6-9.4 21-21 21z"></path></g><g><path d="m1135 1540-191.3-1.1c-.6 0-1.1 0-1.7-.1-46.2-2.8-89.8-25.4-122.8-63.6-24.3-28.2-40.7-61.5-56.5-93.6-4.7-9.6-9.2-18.6-13.8-27.6l-71.6-137.3c-1.1-2.2-2.3-4.4-3.6-6.8-8.9-16.8-20-37.6-24.4-59.3-7.5-36.4 7.5-59 21.4-71.6 37.4-33.8 90.7-16.6 124.4 13.8 4.9 4.4 9.7 9.1 14.3 14.1v-322.3c0-42 32.4-76.5 73.8-78.7 21.6-1.1 42.1 6.5 57.8 21.3 15.4 14.6 24.3 35.2 24.3 56.5v323.4c0 11.6-9.4 21-21 21s-21-9.4-21-21v-323.4c0-9.9-4-19.2-11.2-26s-16.7-10.3-26.7-9.8c-19 1-33.9 17.1-33.9 36.7v386.4c0 9.6-6.5 17.9-15.7 20.3-9.3 2.4-19-1.7-23.6-10.1-3.2-5.7-6.7-11.5-10.6-17-10.7-15.7-22.4-29.3-34.6-40.3-14.5-13-47.3-32.7-68.1-13.9-19.2 17.3-6.6 45.3 11.8 80.1 1.3 2.4 2.5 4.7 3.7 7l71.6 137.3c4.9 9.4 9.7 19.1 14.3 28.4 14.7 29.8 29.8 60.6 50.6 84.8 25.3 29.4 58.3 46.8 92.9 49.1 11.3.1 181.5 1 190.8 1.1 4.1-.1 8.3-.5 12.5-1.1 37.7-5.3 73.6-28.6 96.2-62.5 22-33 21.6-76.2 21.3-117.9 0-5.3-.1-10.9-.1-16.3v-234.7c0-9.9-4-19.2-11.2-26s-16.7-10.3-26.6-9.8c-19 1-33.9 17.1-33.9 36.7v27.8c0 11.6-9.4 21-21 21s-21-9.4-21-21v-27.8c0-42 32.4-76.5 73.8-78.7 21.6-1.1 42.1 6.4 57.7 21.3 15.4 14.6 24.3 35.2 24.3 56.5v234.7c0 5.2 0 10.4.1 15.9.4 45.8.9 97.8-28.3 141.6-29.1 43.7-76 73.9-125.3 80.8-5.8.8-11.7 1.3-17.4 1.5-.3.2-.5.2-.7.2z"></path></g></g></g></g><g><g><path d="m733.4 990.3c-66.2 0-130.4-13-190.8-38.5-58.4-24.7-110.8-60-155.8-105s-80.3-97.4-105-155.8c-25.6-60.4-38.5-124.6-38.5-190.8s13-130.4 38.5-190.8c24.7-58.4 60-110.8 105-155.8s97.4-80.3 155.8-105c60.4-25.6 124.6-38.6 190.8-38.6s130.4 13 190.8 38.5c58.4 24.7 110.8 60 155.8 105s80.3 97.4 105 155.8c25.6 60.4 38.5 124.6 38.5 190.8 0 92.5-25.9 182.6-74.9 260.5-47.7 75.8-115 137.2-194.9 177.4-6.5 3.3-14.3 3-20.5-.9-6.2-3.8-10-10.6-10-17.9v-135.5c0-9.9-4-19.2-11.2-26s-16.7-10.3-26.7-9.8c-19 1-33.9 17.1-33.9 36.7v174.5c0 9.9-6.9 18.5-16.7 20.5-33 7.2-67.1 10.7-101.3 10.7zm0-938.3c-247.1 0-448.2 201-448.2 448.2s201 448.2 448.2 448.2c25.6 0 51.1-2.2 76.2-6.4v-157.1c0-42 32.4-76.5 73.8-78.7 21.6-1.1 42.1 6.5 57.8 21.3 15.4 14.6 24.3 35.2 24.3 56.5v99.9c134.2-81 216.2-225 216.2-383.6-.2-247.3-201.2-448.3-448.3-448.3z"></path></g><g><path d="m628.1 708.2c-3.6 0-7.3-.9-10.5-2.8-6.5-3.8-10.5-10.7-10.5-18.2v-359.7c0-7.5 4-14.4 10.5-18.2s14.5-3.8 21 0l311.5 179.8c6.5 3.8 10.5 10.7 10.5 18.2s-4 14.4-10.5 18.2l-311.5 179.9c-3.2 1.9-6.9 2.8-10.5 2.8zm21-344.3v286.9l248.5-143.5z"></path></g></g></g></svg>',
            'title' => 'Video Button',
            'description' => 'Description',
            'group' => 'Noahs Pro'
         ];
      }
      public function render_form(){
         $form = [];

         // Section Content
         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];
   
         $form['text'] = [
            'type'      => 'text',
            'title'     => t('Buttom Text'),
            'default_value' => 'Open Video On Modal',
            'tab'     => 'section_content',
            'title'     => ('Video modal'),
            'update_selector' => '.noahs--video-button h5'
         ];
         $form['columns_inverted'] = [
            'type'    => '',
            'title'   => t('Inverted Button'),
            'tab' => 'section_content',
            'options' => [
               '' => t('No'),
               'flex-row-reverse' => t('Yes')
            ],
            'style_type' => 'class',
            'style_selector' => '.noahs--video-button', 
      
         ];
         $form['section_style'] = [
            'type' => 'tab',
            'title' =>  t('Style')
         ];
   
         $form['font'] = [
            'type'        => 'noahs_font',
            'title'       => t('Font'),
            'tab'     => 'section_style',
            'style_type' => 'style',
            'style_selector' => '.noahs--video-button h5', 
            'responsive' => true,
           ];
           $form['color_icon'] = [
            'type'     => 'noahs_color',
            'title'    => ('Icon Color'),
            'tab'     => 'section_style',
            'style_type' => 'style',
            'style_css' => 'color', 
            'style_selector' => '.play-video', 
         ];
           $form['bg_color'] = [
            'type'     => 'noahs_color',
            'title'    => ('Button Color'),
            'tab'     => 'section_style',
            'style_type' => 'style',
            'style_css' => 'background-color', 
            'style_selector' => '.play-video', 
         ];
         return $form;
      }

      public static function template( $settings ){


         ?>
         <?php ob_start() ?>

            <div class="noahs--video-button play-button-left">
               <a data-fancybox="video" href="https://www.youtube.com/embed/fystY7WFkHc" class="">
                  <span class="play-video">
                     <span class="fas fa-play"></span>
                  </span>
               </a>
               <h5>Watch how it works</h5>
            </div>
   
         <?php return ob_get_clean();
      }

      public function render_content($element) {

         return $this->wrapper($element, $this->template($element));
      }
   }




