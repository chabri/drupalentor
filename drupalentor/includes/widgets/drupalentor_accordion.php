<?php 


use Drupal\drupalentor\WidgetBase;

   class element_drupalentor_accordion extends WidgetBase{

      public function data(){
         return [
            'icon' => '<i class="fa-solid fa-bars"></i>',
            'title' => 'Accordion',
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
         $form['accordion_items'] = [
            'type'    => 'drupalentor_multiple_fields',
            'title'   => t('Accordion Items'),
            'tab' => 'section_content',
            'fields' => [
               'accordion_title' => [
                  'title' => 'Title',
                  'type' => 'text',
                  'placeholder' => 'This is a h2'
               ],
               'accordion_text' => [
                  'title' => 'Text',
                  'type' => 'textarea'
               ]
      
            ],
         ];
         return $form;
      }

      public function template( $settings ){
        $elements = !empty($settings['element']['accordion_items']) ? $settings['element']['accordion_items'] : [];

         ?>
         <?php ob_start() ?>
         <div class="accordion accordion-flush" id="accordion_<?php echo $settings['wid']; ?>">

            <!-- Slides -->
            <?php foreach($elements as $index => $element){ ?>
            <div class="accordion-item">
               <h2 class="accordion-header" id="flush-heading_<?php echo $index; ?>">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse_<?php echo $index; ?>" aria-expanded="false" aria-controls="flush-collapse_<?php echo $index; ?>">
                     <?php echo $element['accordion_title']; ?>
                  </button>
               </h2>
               <div id="flush-collapse_<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading_<?php echo $index; ?>" data-bs-parent="#accordion_<?php echo $settings['wid']; ?>">
                  <div class="accordion-body">
                     <?php echo $element['accordion_text']; ?>
                  </div>
               </div>
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

   



