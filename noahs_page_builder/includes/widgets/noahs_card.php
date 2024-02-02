<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_card extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_3596091" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m21.5 21h-19c-1.378 0-2.5-1.122-2.5-2.5v-13c0-1.378 1.122-2.5 2.5-2.5h19c1.378 0 2.5 1.122 2.5 2.5v13c0 1.378-1.122 2.5-2.5 2.5zm-19-17c-.827 0-1.5.673-1.5 1.5v13c0 .827.673 1.5 1.5 1.5h19c.827 0 1.5-.673 1.5-1.5v-13c0-.827-.673-1.5-1.5-1.5z"></path></g><g><path d="m7.5 12c-1.378 0-2.5-1.122-2.5-2.5s1.122-2.5 2.5-2.5 2.5 1.122 2.5 2.5-1.122 2.5-2.5 2.5zm0-4c-.827 0-1.5.673-1.5 1.5s.673 1.5 1.5 1.5 1.5-.673 1.5-1.5-.673-1.5-1.5-1.5z"></path></g><g><path d="m11.5 17c-.276 0-.5-.224-.5-.5v-1c0-.827-.673-1.5-1.5-1.5h-4c-.827 0-1.5.673-1.5 1.5v1c0 .276-.224.5-.5.5s-.5-.224-.5-.5v-1c0-1.378 1.122-2.5 2.5-2.5h4c1.378 0 2.5 1.122 2.5 2.5v1c0 .276-.224.5-.5.5z"></path></g><g><path d="m20.5 9h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z"></path></g><g><path d="m20.5 13h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z"></path></g><g><path d="m20.5 17h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z"></path></g></svg>',
            'title' => 'Card',
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

         $form['card_style'] = [
            'type'      => 'select',
            'tab'     => 'section_content',
            'title'     => ('Cart Style'),
            'options' => [
               '' => 'Vertical',
               'h2' => 'Horizontal',
               'h3' => 'Image overlays',
               'h4' => 'H4',
               'h5' => 'H5',
               'h6' => 'H6',
            ],
            'update_selector_html' => '.widget-content > *',
            'group' => 'card_group_text'
         ];
         $form['image'] =[
            'type'    => 'noahs_image',
            'title'   => ('Image'),
            'tab' => 'section_content',
            'update_selector' => '.card-img-top',
            
         ];

         $form['card_group_text'] = [
            'type' => 'group',
            'title' => t('Title'),
         ];
         $form['card_title'] = [
            'type'    => 'text',
            'title'   => t('Title'),
            'tab' => 'section_content',
            'group' => 'card_group_text'
         ];
         
         $form['heading_type'] = [
            'type'      => 'select',
            'tab'     => 'section_content',
            'title'     => ('Type'),
            'options' => [
               'h1' => 'H1',
               'h2' => 'H2',
               'h3' => 'H3',
               'h4' => 'H4',
               'h5' => 'H5',
               'h6' => 'H6',
            ],
            'update_selector_html' => '.widget-content > *',
            'group' => 'card_group_text'
         ];

         $form['text'] = [
            'type'    => 'textarea',
            'title'   => t('Text'),
            'tab' => 'section_content',
            'group' => 'card_group_text'
         ];

         $form['group_link'] = [
            'type' => 'group',
            'title' => t('Link'),
         ];
         $form['link_text'] = [
            'type'    => 'text',
            'title'   => t('Link Title'),
            'tab' => 'section_content',
            'group' => 'group_link',
            
         ];
         $form['link_url'] = [
            'type'    => 'text',
            'title'   => t('Link'),
            'tab' => 'section_content',
            'group' => 'group_link',
            
         ];
         $form['button_style'] = [
            'type' => 'select',
            'title' => t('Style'),
            'tab' => 'section_content',
            'options' => [
               '' => 'Por defecto',
               'info' => 'Información',
               'success' => 'Correcto',
               'warning' => 'Advertencia',
               'danger' => 'Peligro',
               'link' => 'Link',
            ],
            'group' => 'group_link',
         ];
         $form['stretched_link'] = [
            'type'    => 'radio',
            'title'   => t('Stretched-link'),
            'tab' => 'section_content',
            'group' => 'group_link',
         ];

         return $form;
      }

      public function template( $settings ){

         $settings = $settings['element'];
         $image = '/'.NOAHS_PAGE_BUILDER_PATH.'/assets/img/widget-image.jpg';
         if($settings['element']['image']['fid']){
		
				$file = File::load($settings['element']['image']['fid']);
				$file_uri = $file->getFileUri();
				
				$image = ImageStyle::load($settings['element']['image']['image_style'])->buildUrl($file_uri);
         }
         ?>
         <?php ob_start() ?>


               <div class="widget-content">
               <div class="card">
                  <div class="card-header">Header</div>
                  <img class="card-img-top" src="<?php echo $image; ?>">
                  <div class="card-body">
                     <<?php echo ($settings['heading_type'] ?? 'h5'); ?> class="card-title"><?php echo $settings['card_title'] ?? 'Card Title Here'; ?></<?php echo  ($settings['heading_type'] ?? 'h5'); ?>>
                     <p class="card-text"><?php echo $settings['text'] ?? 'This is the card text, please write here'; ?></p>
                     <a href="<?php echo $settings['link_url']; ?>" class="btn btn-<?php echo $settings['element']['button_style'] ?? 'success'; ?>"><?php echo $settings['link_text'] ?? 'Button'; ?></a>
                  </div>
                  <div class="card-footer">Footer</div>
                  </div>
               </div>

         <?php return ob_get_clean() ?>  
         <?php       
      }
      public function render_content( $settings = null, $content = null) {
                return $this->wrapper($element, $this->template(json_decode($element->settings, true)));

      }
   }

   



