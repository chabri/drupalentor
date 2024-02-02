<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_bars extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_8630332" height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m59 50h-54c-1.65 0-3 1.35-3 3v6c0 1.65 1.35 3 3 3h54c1.65 0 3-1.35 3-3v-6c0-1.65-1.35-3-3-3zm-54.82 9.53c-.1-.16-.18-.33-.18-.53v-6c0-.55.45-1 1-1h3.53zm8.98.47 1.44-2.5-1.73-1-2.02 3.5h-4.63l4.62-8h4.62l-1.44 2.5 1.73 1 2.02-3.5h4.61l-4.62 8h-4.61zm13.85 0 1.44-2.5-1.73-1-2.02 3.5h-4.62l4.62-8h4.62l-1.44 2.5 1.73 1 2.02-3.5h4.62l-4.62 8h-4.61zm6.92 0 4.62-8h4.62l-4.62 8zm6.93 0 4.62-8h4.79l-4.62 8zm7.1 0 4.62-8h4.58l-4.62 8zm12.05-1c0 .55-.45 1-1 1h-4.16l4.57-7.91c.34.16.59.5.59.91z"></path><path d="m59 34h-54c-1.65 0-3 1.35-3 3v6c0 1.65 1.35 3 3 3h54c1.65 0 3-1.35 3-3v-6c0-1.65-1.35-3-3-3zm-54.82 9.53c-.1-.16-.18-.33-.18-.53v-6c0-.55.45-1 1-1h3.53zm8.98.47 1.44-2.5-1.73-1-2.02 3.5h-4.63l4.62-8h4.62l-1.44 2.5 1.73 1 2.02-3.5h4.61l-4.62 8h-4.61zm13.85 0 1.44-2.5-1.73-1-2.02 3.5h-4.62l4.62-8h4.62l-1.44 2.5 1.73 1 2.02-3.5h4.62l-4.62 8h-4.61zm33-1c0 .55-.45 1-1 1h-25.08l4.62-8h20.45c.55 0 1 .45 1 1v6z"></path><path d="m59 18h-54c-1.65 0-3 1.35-3 3v6c0 1.65 1.35 3 3 3h54c1.65 0 3-1.35 3-3v-6c0-1.65-1.35-3-3-3zm-54.82 9.53c-.1-.16-.18-.33-.18-.53v-6c0-.55.45-1 1-1h3.53zm8.98.47 1.44-2.5-1.73-1-2.02 3.5h-4.63l4.62-8h4.62l-1.44 2.5 1.73 1 2.02-3.5h4.61l-4.62 8h-4.61zm46.85-1c0 .55-.45 1-1 1h-32.01l1.44-2.5-1.73-1-2.02 3.5h-4.62l4.62-8h4.62l-1.44 2.5 1.73 1 2.02-3.5h27.38c.55 0 1 .45 1 1v6z"></path><path d="m59 2h-54c-1.65 0-3 1.35-3 3v6c0 1.65 1.35 3 3 3h54c1.65 0 3-1.35 3-3v-6c0-1.65-1.35-3-3-3zm-54.82 9.53c-.1-.16-.18-.33-.18-.53v-6c0-.55.45-1 1-1h3.53zm8.98.47 1.44-2.5-1.73-1-2.02 3.5h-4.63l4.62-8h4.62l-1.44 2.5 1.73 1 2.02-3.5h4.61l-4.62 8h-4.61zm46.85-1c0 .55-.45 1-1 1h-38.94l4.62-8h34.31c.55 0 1 .45 1 1v6z"></path></svg>',
            'title' => 'Skill Bars',
            'description' => 'Description',
            'group' => 'noahs_page_builder'
         ];
      }
      
      public function render_form(){
         $form = [];


         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];
         $form['bar_items'] = [
            'type'    => 'noahs_multiple_elements',
            'title'   => t('Skill Bar'),
            'tab' => 'section_content',
            'fields' => [
               'bar_content' => [
                  'type' => 'tab',
                  'title' =>  t('Bar Content')
               ],
               'bar_title' => [
                  'title' => 'Title',
                  'type' => 'text',
                  'placeholder' => 'This is a h2',
                  'tab' => 'bar_content',
               ],
               'bar_with' => [
                  'title' => 'Width',
                  'type' => 'number',
                  'tab' => 'bar_content',
               ],

               'bar_style' => [
                  'type' => 'tab',
                  'title' =>  t('Individual Style')
               ],
               'bar_text_color' => [
                  'type'     => 'noahs_color',
                  'title'    => ('Text Color'),
                  'tab' => 'bar_style',
                  'style_type' => 'style',
                  'style_selector' => '.progress_[index] .progress-bar', 
                  'style_css' => 'background-color',
               ],
               'bar_bg_color' => [
                  'type'     => 'noahs_color',
                  'title'    => ('Background Color'),
                  'style_type' => 'style',
                  'style_selector' => '.progress_[index] .progress-bar', 
                  'style_css' => 'background-color',
                  'tab' => 'bar_style',
               ],
               'bar_base_bg_color' => [
                  'type'     => 'noahs_color',
                  'title'    => ('Base Color'),
                  'style_type' => 'style',
                  'style_selector' => '.progress_[index]', 
                  'style_css' => 'background-color',
                  'tab' => 'bar_style',
               ],
      
            ],
         ];
         return $form;
      }

      public function template( $settings ){

         $settings = $settings['element'];
         $elements = !empty($settings['bar_items']) ? $settings['bar_items'] : [];


         ?>
         <?php ob_start() ?>
         <div class="widget-content w-100">
         <?php if (!empty($elements)){ ?>
            <?php foreach($elements as $index => $element){ ?>
                  <div class="progress progress_<?php echo $index; ?>">
                     <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $element['bar_with'] ?? '50' ?>%"><?php echo $element['bar_title'] ?? ''; ?></div>
                  </div>
            <?php } ?>
            <?php }else{ ?>
               <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:20%">Bar Text</div>
               </div>
               <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:30%">Bar Text</div>
               </div>
               <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:40%">Bar Text</div>
               </div>
               <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:50%">Bar Text</div>
               </div>
               <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:60%">Bar Text</div>
               </div>
               <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:70%">Bar Text</div>
               </div>
               <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:80%">Bar Text</div>
               </div>
            <?php } ?>
         </div>
         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content( $settings = null, $content = null) {
                return $this->wrapper($element, $this->template(json_decode($element->settings, true)));

      }
   }

   



