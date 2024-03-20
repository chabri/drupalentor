<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_accordion extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_6348087" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m489.45 0h-79.456c-4.15 0-7.515 3.365-7.515 7.515s3.364 7.515 7.515 7.515h79.456c4.147 0 7.521 3.374 7.521 7.521v111.87c0 4.147-3.374 7.521-7.521 7.521h-466.9c-4.147 0-7.521-3.374-7.521-7.521v-111.871c0-4.147 3.374-7.521 7.521-7.521h357.385c4.15 0 7.515-3.365 7.515-7.515s-3.364-7.514-7.515-7.514h-357.385c-12.434 0-22.55 10.116-22.55 22.55v111.87c0 12.434 10.116 22.55 22.55 22.55h466.9c12.434 0 22.55-10.116 22.55-22.55v-111.87c0-12.434-10.116-22.55-22.55-22.55z"></path><path d="m156.331 38.965c-2.294-1.619-5.298-1.822-7.79-.532-2.492 1.292-4.057 3.864-4.057 6.672v65.754c0 2.807 1.565 5.38 4.057 6.672 1.088.565 2.275.843 3.457.843 1.524 0 3.041-.463 4.333-1.375l46.596-32.877c1.996-1.408 3.183-3.698 3.183-6.14s-1.187-4.732-3.183-6.14zm3.183 57.396v-36.757l26.047 18.378z"></path><path d="m77.411 116.001c4.15 0 7.515-3.365 7.515-7.515v-62.466c0-4.15-3.365-7.515-7.515-7.515h-13.34c-4.15 0-7.515 3.364-7.515 7.515s3.364 7.515 7.515 7.515h5.826v54.952c0 4.149 3.364 7.514 7.514 7.514z"></path><path d="m457.741 57.198c0-4.15-3.365-7.515-7.515-7.515h-195.155c-4.15 0-7.515 3.364-7.515 7.515s3.364 7.515 7.515 7.515h195.156c4.15 0 7.514-3.365 7.514-7.515z"></path><path d="m255.071 91.252c-4.15 0-7.515 3.364-7.515 7.515s3.364 7.515 7.515 7.515h108.371c4.15 0 7.515-3.365 7.515-7.515s-3.364-7.515-7.515-7.515z"></path><path d="m489.45 177.515h-363.659c-4.15 0-7.515 3.364-7.515 7.515 0 4.15 3.365 7.515 7.515 7.515h363.659c4.147 0 7.521 3.374 7.521 7.521v111.87c0 4.147-3.374 7.521-7.521 7.521h-466.9c-4.147 0-7.521-3.374-7.521-7.521v-111.87c0-4.147 3.374-7.521 7.521-7.521h73.182c4.15 0 7.515-3.365 7.515-7.515s-3.365-7.515-7.515-7.515h-73.182c-12.434 0-22.55 10.116-22.55 22.55v111.87c0 12.434 10.116 22.55 22.55 22.55h466.9c12.434 0 22.55-10.116 22.55-22.55v-111.87c0-12.434-10.116-22.55-22.55-22.55z"></path><path d="m151.999 295.89c1.524 0 3.041-.463 4.333-1.375l46.596-32.877c1.996-1.408 3.183-3.698 3.183-6.14s-1.187-4.732-3.183-6.14l-46.596-32.877c-2.294-1.619-5.298-1.822-7.79-.532-2.492 1.292-4.057 3.865-4.057 6.672v65.754c0 2.807 1.565 5.38 4.057 6.672 1.088.565 2.274.843 3.457.843zm7.515-58.77 26.047 18.378-26.047 18.378z"></path><path d="m72.137 250.275c-9.882 14.129-15.778 21.856-18.946 26.006-3.882 5.087-5.83 7.64-4.558 11.777.751 2.44 2.597 4.313 5.065 5.136 1.016.339 1.93.645 13.994.645 4.779 0 11.31-.048 20.287-.161 4.15-.052 7.472-3.459 7.42-7.609s-3.477-7.454-7.609-7.42c-5.975.075-12.3.126-17.659.14 3.428-4.599 8.103-11.009 14.322-19.902 4.02-5.749 6.644-11.19 7.798-16.171.057-.246.101-.495.134-.745l.308-2.416c.04-.316.06-.633.06-.951 0-12.957-10.536-23.498-23.486-23.498-11.198 0-20.89 7.971-23.045 18.952-.799 4.073 1.854 8.022 5.926 8.821 4.07.801 8.022-1.853 8.821-5.926.776-3.951 4.266-6.818 8.298-6.818 4.528 0 8.237 3.582 8.448 8.066l-.186 1.456c-.769 3.03-2.582 6.6-5.392 10.618z"></path><path d="m255.071 242.228h195.156c4.15 0 7.515-3.365 7.515-7.515s-3.365-7.515-7.515-7.515h-195.156c-4.15 0-7.515 3.365-7.515 7.515s3.365 7.515 7.515 7.515z"></path><path d="m255.071 283.797h108.371c4.15 0 7.515-3.365 7.515-7.515s-3.364-7.515-7.515-7.515h-108.371c-4.15 0-7.515 3.365-7.515 7.515s3.365 7.515 7.515 7.515z"></path><path d="m489.45 355.03h-78.689c-4.15 0-7.515 3.365-7.515 7.515s3.365 7.515 7.515 7.515h78.689c4.147 0 7.521 3.374 7.521 7.521v111.87c0 4.147-3.374 7.521-7.521 7.521h-466.9c-4.147 0-7.521-3.374-7.521-7.521v-111.871c0-4.147 3.374-7.521 7.521-7.521h358.152c4.15 0 7.515-3.365 7.515-7.515s-3.364-7.515-7.515-7.515h-358.152c-12.434.001-22.55 10.117-22.55 22.551v111.87c0 12.434 10.116 22.55 22.55 22.55h466.9c12.434 0 22.55-10.116 22.55-22.55v-111.87c0-12.434-10.116-22.55-22.55-22.55z"></path><path d="m156.331 393.996c-2.294-1.619-5.298-1.822-7.79-.532-2.492 1.292-4.057 3.865-4.057 6.672v65.755c0 2.807 1.565 5.38 4.057 6.672 1.088.565 2.275.843 3.457.843 1.524 0 3.041-.463 4.333-1.375l46.596-32.878c1.996-1.408 3.183-3.698 3.183-6.14s-1.187-4.732-3.183-6.14zm3.183 57.395v-36.757l26.047 18.378z"></path><path d="m457.741 412.228c0-4.15-3.365-7.515-7.515-7.515h-195.155c-4.15 0-7.515 3.365-7.515 7.515s3.364 7.515 7.515 7.515h195.156c4.15 0 7.514-3.364 7.514-7.515z"></path><path d="m255.071 446.283c-4.15 0-7.515 3.365-7.515 7.515s3.364 7.515 7.515 7.515h108.371c4.15 0 7.515-3.364 7.515-7.515 0-4.15-3.364-7.515-7.515-7.515z"></path><path d="m70.741 393.407c-11.198 0-20.89 7.971-23.046 18.953-.799 4.073 1.854 8.022 5.926 8.821 4.072.8 8.022-1.854 8.821-5.926.776-3.951 4.266-6.819 8.298-6.819 4.663 0 8.456 3.799 8.456 8.469s-3.794 8.469-8.456 8.469c-4.15 0-7.515 3.364-7.515 7.515s3.365 7.515 7.515 7.515c4.663 0 8.456 3.799 8.456 8.469s-3.794 8.469-8.456 8.469c-4.196 0-7.797-3.129-8.375-7.279-.054-.389-.082-.789-.082-1.19 0-4.15-3.364-7.515-7.515-7.515s-7.515 3.365-7.515 7.515c0 1.094.076 2.194.226 3.267 1.608 11.534 11.608 20.231 23.26 20.231 12.95 0 23.486-10.542 23.486-23.499 0-6.169-2.392-11.787-6.292-15.984 3.9-4.197 6.292-9.815 6.292-15.984.002-12.955-10.534-23.497-23.484-23.497z"></path></g></svg>',
            'title' => 'Accordion',
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
         $form['accordion_items'] = [
            'type'    => 'noahs_multiple_elements',
            'title'   => t('Accordion Items'),
            'tab' => 'section_content',
            'fields' => [
               'accordion_content' => [
                  'type' => 'tab',
                  'title' =>  t('Bar Content')
               ],
               'accordion_title' => [
                  'title' => 'Title',
                  'type' => 'text',
                  'placeholder' => 'This is a h2',
                  'tab' => 'accordion_content',
                  'default_value' => 'This is a h2',
                  'update_selector' => '.accordion-button_[index]'
               ],
               'accordion_text' => [
                  'title' => 'Text',
                  'type' => 'textarea',
                  'tab' => 'accordion_content',
                  'default_value' => 'This is the third items accordion body. It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables.',
                  'update_selector' => '.accordion-item_[index] .accordion-body'
               ]
      
            ],
         ];
         return $form;
      }

      public function template( $settings ){
        $elements = !empty($settings->element->accordion_items) ? $settings->element->accordion_items : [];

         ?>
         <?php ob_start() ?>
         <div class="accordion accordion-flush multipart-item" id="accordion_<?php echo $settings->wid; ?>">

            <!-- Slides -->
            <?php if (!empty($elements)){ ?>
            <?php foreach($elements as $index => $element){ 
               $index = ($index + 1);
               ?>
            <div class="accordion-item accordion-item_<?php echo $index; ?>">
               <h2 class="accordion-header" id="flush-heading_<?php echo $index; ?>">
                  <button class="accordion-button accordion-button_<?php echo $index; ?> collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse_<?php echo $index; ?>" aria-expanded="false" aria-controls="flush-collapse_<?php echo $index; ?>">
                     <?php echo $element->accordion_title->text; ?>
                  </button>
               </h2>
               <div id="flush-collapse_<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading_<?php echo $index; ?>" data-bs-parent="#accordion_<?php echo $settings->wid; ?>">
                  <div class="accordion-body">
                     <?php echo $element->accordion_text; ?>
                  </div>
               </div>
            </div>
            <?php } ?>
            <?php } else{ ?>
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     Accordion Item #1
                     </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion_<?php echo $settings->wid; ?>">
                     <div class="accordion-body">
                     <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                     </div>
                  </div>
               </div>
               <div class="accordion-item ">
                  <h2 class="accordion-header" id="headingTwo">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     Accordion Item #2
                     </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion_<?php echo $settings->wid; ?>">
                     <div class="accordion-body">
                     <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                     </div>
                  </div>
               </div>
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                     Accordion Item #3
                     </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion_<?php echo $settings->wid; ?>">
                     <div class="accordion-body">
                     <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                     </div>
                  </div>
               </div>
            <?php } ?>
         </div>


         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function default_template( ){

         ?>
         <?php ob_start() ?>

               <div class="accordion-item">
                  <h2 class="accordion-header" id="replaceit">
                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#replaceit" aria-expanded="true" aria-controls="replaceit">
                     This is a h2
                     </button>
                  </h2>
                  <div id="replaceit" class="accordion-collapse collapse" aria-labelledby="replaceit" data-bs-parent="replaceit">
                     <div class="accordion-body">
                     <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                     </div>
                  </div>
               </div>
              



         <?php return ob_get_clean() ?>  
         <?php       
      }

      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



