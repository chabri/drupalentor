<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_contact_form extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="fi_1698477" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512" height="512">
            <g>
               <path d="M327.101,134.929c4.141,0,7.497-3.357,7.497-7.497c0-4.141-3.357-7.497-7.497-7.497H184.899   c-4.141,0-7.497,3.357-7.497,7.497c0,4.141,3.357,7.497,7.497,7.497H327.101z"></path>
               <path d="M136.54,200.205v19.506c0,9.194,7.48,16.674,16.674,16.674h205.573c9.194,0,16.674-7.48,16.674-16.674v-19.506   c0-9.194-7.48-16.674-16.674-16.674H153.214C144.02,183.531,136.54,191.011,136.54,200.205z M360.465,200.205v19.506   c0,0.926-0.753,1.679-1.679,1.679H153.214c-0.926,0-1.679-0.753-1.679-1.679v-19.506c0-0.926,0.753-1.679,1.679-1.679h205.573   C359.712,198.526,360.465,199.279,360.465,200.205z"></path>
               <path d="M136.54,304.572c0,9.194,7.48,16.674,16.674,16.674h205.573c9.194,0,16.674-7.48,16.674-16.674v-19.505   c0-9.194-7.48-16.674-16.674-16.674H153.214c-9.194,0-16.674,7.48-16.674,16.674V304.572z M151.535,285.067   c0-0.926,0.753-1.679,1.679-1.679h205.573c0.926,0,1.679,0.753,1.679,1.679v19.505c0,0.926-0.753,1.679-1.679,1.679H153.214   c-0.926,0-1.679-0.753-1.679-1.679V285.067z"></path>
               <path d="M273.439,358.644h-34.878c-14.178,0-25.713,11.535-25.713,25.713v1.019c0,14.178,11.535,25.713,25.713,25.713h34.878   c14.178,0,25.713-11.535,25.713-25.713v-1.019C299.152,370.179,287.617,358.644,273.439,358.644z M284.157,385.377   c0,5.91-4.808,10.718-10.718,10.718h-34.878c-5.91,0-10.718-4.808-10.718-10.718v-1.019c0-5.91,4.808-10.718,10.718-10.718h34.878   c5.91,0,10.718,4.808,10.718,10.718V385.377z"></path>
               <path d="M291.654,459.458H98.758c-7.694,0-13.953-6.26-13.953-13.953V142.426c0-4.141-3.357-7.497-7.497-7.497   c-4.141,0-7.497,3.357-7.497,7.497v303.079c0,15.962,12.986,28.948,28.948,28.948h192.896c4.141,0,7.497-3.357,7.497-7.497   S295.795,459.458,291.654,459.458z"></path>
               <path d="M421.5,1.378c-9.72-2.897-6.81-0.157-322.742-1.2c-15.961,0-28.948,12.986-28.948,28.948v83.311   c0,4.141,3.357,7.497,7.497,7.497c4.141,0,7.497-3.357,7.497-7.497V90.959h342.391v354.546c0,5.622-3.346,10.67-8.525,12.86   c-7.501,3.172-5.214,14.404,2.924,14.404c6.342,0,20.596-10.454,20.596-27.265V29.126C442.19,16.013,433.432,4.934,421.5,1.378z    M427.195,75.964H84.805V29.126c0-6.996,5.19-12.86,12.004-13.818c1.836-0.258-15.167-0.087,316.433-0.136   c7.708,0,13.953,6.275,13.953,13.953V75.964z"></path>
               <path d="M124.895,22.631c-12.648,0-22.938,10.289-22.938,22.937s10.29,22.938,22.938,22.938s22.937-10.29,22.937-22.938   S137.542,22.631,124.895,22.631z M124.895,53.511c-4.379,0-7.943-3.563-7.943-7.943s3.563-7.942,7.943-7.942   c4.379,0,7.942,3.563,7.942,7.942S129.274,53.511,124.895,53.511z"></path>
               <path d="M184.899,22.631c-12.648,0-22.937,10.289-22.937,22.937s10.289,22.938,22.937,22.938c12.648,0,22.938-10.29,22.938-22.938   S197.547,22.631,184.899,22.631z M184.899,53.511c-4.379,0-7.942-3.563-7.942-7.943s3.563-7.942,7.942-7.942   c4.379,0,7.943,3.563,7.943,7.942S189.279,53.511,184.899,53.511z"></path>
               <path d="M244.904,22.631c-12.648,0-22.938,10.289-22.938,22.937s10.29,22.938,22.938,22.938c12.648,0,22.937-10.29,22.937-22.938   S257.552,22.631,244.904,22.631z M244.904,53.511c-4.379,0-7.943-3.563-7.943-7.943s3.563-7.942,7.943-7.942   c4.379,0,7.942,3.563,7.942,7.942S249.284,53.511,244.904,53.511z"></path>
               <path d="M417.945,435.07c0-4.621-2.39-8.76-6.392-11.07l-77.787-44.91c-4.002-2.311-8.781-2.311-12.783,0   c-4.003,2.311-6.392,6.449-6.392,11.071v89.82c0,4.621,2.389,8.76,6.392,11.071c4.003,2.311,8.781,2.311,12.783,0l18.884-10.903   l14.518,25.145c2.483,4.299,7.002,6.705,11.642,6.705c2.275,0,4.579-0.578,6.686-1.795l16.779-9.688   c6.407-3.699,8.61-11.921,4.911-18.328l-14.518-25.145l18.884-10.903C415.556,443.831,417.945,439.692,417.945,435.07z    M384.018,444.725c-3.161,1.825-5.421,4.771-6.366,8.296c-0.945,3.525-0.46,7.207,1.365,10.368l14.395,24.932l-14.047,8.11   l-14.395-24.933c-2.528-4.378-7.129-6.828-11.854-6.828c-2.316,0-4.663,0.589-6.808,1.828l-16.721,9.653v-82.16l71.153,41.08   L384.018,444.725z"></path>
            </g>
             </svg>',
            'title' => 'Contact Form',
            'description' => 'Description',
            'group' => 'Noahs Pro'
         ];
      }
      
      public function render_form(){
         $form = [];

         $form['section_content'] = [
            'type' => 'tab',
            'title' =>  t('Content')
         ];
         $entityType = \Drupal::entityTypeManager();

         if ($entityType->hasDefinition('contact_form')) {
            $media_types = \Drupal::entityTypeManager()->getStorage('contact_form')->loadMultiple();
            $forms = [];
            $forms[] = 'Select your form';
            foreach ($media_types as $menu_entity) {
               if($menu_entity->id() != 'personal'){
               $forms[$menu_entity->id()] = $menu_entity->label();
               }
            }
            // Section Content

            $form['form'] = [
               'type'    => 'select',
               'title'   => t('Form'),
               'tab' => 'section_content',
               'options' =>  $forms,
            ];
         }else{
            $form['info_text'] = [
               'type'      => 'info',
               'tab'     => 'section_content',
               'title'     => ('Install contact form module'),
            ];
         }
         $form['section_styles'] = [
            'type' => 'tab',
            'title' => t('Styles')
         ];
         $form['btn_group'] = [
            'type' => 'group',
            'title' => t('Button'),
            'tab' => 'section_styles',
         ];

         $form['btnbg_color'] = [
            'type' => 'noahs_color',
            'title' => t('Backgorund Color'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.button', 
            'style_css' => 'background-color', 
            'style_hover' => true,
            'group' => 'btn_group',
         ];

         $form['btn_color'] = [
            'type' => 'noahs_color',
            'title' => t('Color'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.button', 
            'style_css' => 'color', 
            'style_hover' => true,
            'group' => 'btn_group',
         ];
         $form['btn_border'] = [
            'type' => 'noahs_border',
            'title' => t('Border'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.button', 
            'style_css' => 'border', 
            'style_hover' => true,
            'group' => 'btn_group',
         ];

         $form['btn_margin'] = [
            'type' => 'noahs_margin',
            'title' => t('Margin'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.button', 
            'style_css' => 'margin', 
            'responsive' => true,
            'style_hover' => true,
            'group' => 'btn_group',
         ];

         $form['btn_padding'] = [
            'type' => 'noahs_padding',
            'title' => t('Padding'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.button', 
            'style_css' => 'padding', 
            'responsive' => true,
            'style_hover' => true,
            'group' => 'btn_group',
         ];

         $form['form_group'] = [
            'type' => 'group',
            'title' => t('Form'),
            'tab' => 'section_styles',
         ];
         $form['font'] = [
            'type' => 'noahs_font',
            'title' => t('Form Font'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => 'widget form', 
            'responsive' => true,
            'group' => 'form_group',
         ];

         $form['input_border'] = [
            'type' => 'noahs_border',
            'title' => t('Input Border'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => 'input, select, textarea', 
            'style_css' => 'border', 
            'responsive' => true,
            'style_hover' => true,
            'group' => 'form_group',
         ];

         $form['input_radius'] = [
            'type'    => 'noahs_radius',
            'title'   => t('Border Radius'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => 'input, select, textarea', 
            'responsive' => true, 
            'style_hover' => true,
         ];

         $form['inputs_margin'] = [
            'type' => 'noahs_margin',
            'title' => t('Inputs Margin'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.form-item', 
            'style_css' => 'margin', 
            'responsive' => true,
            'style_hover' => true,
            'group' => 'form_group',
         ];

         $form['inputs_padding'] = [
            'type' => 'noahs_padding',
            'title' => t('Padding'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => 'input, select, textarea', 
            'style_css' => 'padding', 
            'responsive' => true,
            'style_hover' => true,
            'group' => 'form_group',
         ];

         $form['input_bgcolor'] = [
            'type' => 'noahs_color',
            'title' => t('Input Backgorund Color'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => 'input, select, textarea', 
            'style_css' => 'background-color', 
            'style_hover' => true,
            'group' => 'form_group',
         ];

         $form['input_color'] = [
            'type' => 'noahs_color',
            'title' => t('Input Color'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => 'input, select, textarea', 
            'style_css' => 'color', 
            'style_hover' => true,
            'group' => 'form_group',
         ];
            return $form;

      }

      public function template( $settings ){
      $output = '';
         if(!empty($settings->element->form)){
            $message = \Drupal::entityTypeManager()
            ->getStorage('contact_message')
            ->create([
            'contact_form' => $settings->element->form,
            ]);

            // Can't add Personal form.
            if (!$message->isPersonal()) {
               $form = \Drupal::service('entity.form_builder')->getForm($message);
               $output = \Drupal::service('renderer')->render($form);
            }
         }else{
            $output = '<ul><li><a href="">Hello</a></li><ul>';
         }
        
         return $output;   
      }


     
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



