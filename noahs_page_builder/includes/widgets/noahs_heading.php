<?php 

use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_heading extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_8089962" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m464.5 27.26h-417c-26.191 0-47.5 21.309-47.5 47.5v376.082c0 18.691 15.207 33.897 33.897 33.897h338.69c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-338.69c-10.42 0-18.897-8.477-18.897-18.897v-333.646h82.576c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-82.576v-27.436c0-17.921 14.58-32.5 32.5-32.5h417c17.921 0 32.5 14.579 32.5 32.5v27.436h-359.424c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h359.424v333.646c0 10.42-8.478 18.897-18.897 18.897h-65.515c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h65.515c18.691 0 33.897-15.206 33.897-33.897v-376.082c0-26.191-21.309-47.5-47.5-47.5z"></path><path d="m456.425 82.735c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-90.724c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5z"></path><path d="m435.863 336.221c13.729 0 24.898-11.169 24.898-24.898 0-11.12-7.329-20.559-17.41-23.745.002-.074.011-.146.011-.22v-93.791c10.075-3.19 17.398-12.625 17.398-23.741 0-13.729-11.169-24.898-24.898-24.898-11.116 0-20.551 7.323-23.741 17.398h-312.243c-3.19-10.075-12.625-17.398-23.741-17.398-13.729 0-24.898 11.169-24.898 24.898 0 11.116 7.323 20.552 17.398 23.741v94.014c-10.075 3.19-17.398 12.625-17.398 23.741 0 13.729 11.169 24.898 24.898 24.898 11.116 0 20.552-7.323 23.741-17.398h312.244c3.19 10.076 12.625 17.399 23.741 17.399zm-352.226-48.639v-94.014c7.707-2.44 13.801-8.535 16.241-16.241h312.244c2.44 7.706 8.535 13.801 16.241 16.241v93.791c0 .074.009.146.011.22-7.712 2.438-13.811 8.535-16.252 16.245h-312.244c-2.44-7.708-8.535-13.802-16.241-16.242zm352.226 33.639c-5.457 0-9.897-4.44-9.897-9.898s4.44-9.898 9.897-9.898c5.458 0 9.898 4.44 9.898 9.898s-4.44 9.898-9.898 9.898zm0-161.293c5.458 0 9.898 4.44 9.898 9.898s-4.44 9.898-9.898 9.898c-5.457 0-9.897-4.44-9.897-9.898s4.44-9.898 9.897-9.898zm-359.726 0c5.458 0 9.898 4.44 9.898 9.898s-4.44 9.898-9.898 9.898-9.898-4.44-9.898-9.898 4.44-9.898 9.898-9.898zm0 161.293c-5.458 0-9.898-4.44-9.898-9.898s4.44-9.898 9.898-9.898 9.898 4.44 9.898 9.898-4.441 9.898-9.898 9.898z"></path><path d="m321.759 264.457c-.015 0-.028 0-.043 0-4.991.028-10.345.048-14.474.052v-55.371c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v62.818c0 3.653 2.633 6.775 6.233 7.392.544.093.962.165 7.84.165 3.362 0 8.269-.017 15.484-.057 4.142-.023 7.481-3.4 7.458-7.542-.022-4.127-3.375-7.457-7.498-7.457z"></path><path d="m197.761 201.639c-4.143 0-7.5 3.358-7.5 7.5v62.871c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-62.871c0-4.142-3.357-7.5-7.5-7.5z"></path><path d="m384.127 264.223h-18.75v-16.148h16.814c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-16.814v-16.148h18.75c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-26.25c-4.143 0-7.5 3.358-7.5 7.5v62.297c0 4.142 3.357 7.5 7.5 7.5h26.25c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.501-7.5-7.501z"></path><path d="m162.593 201.639h-34.721c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h9.79v55.371c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-55.371h9.931c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path><path d="m265.798 201.639h-34.722c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h9.791v55.371c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-55.371h9.931c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path><path d="m237.757 373.19h-161.62c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h161.621c4.143 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.501-7.5z"></path><path d="m237.757 410.414h-161.62c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h161.621c4.143 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.501-7.5z"></path><path d="m288.132 427.414h141.316c7.672 0 13.914-6.242 13.914-13.914v-28.396c0-7.672-6.242-13.914-13.914-13.914h-141.316c-7.672 0-13.914 6.242-13.914 13.914v28.396c0 7.672 6.242 13.914 13.914 13.914zm1.086-41.224h139.145v26.224h-139.145z"></path></g></svg>',
            'title' => 'Heading',
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
   
         $form['heading_text'] = [
            'type'      => 'text',
            'tab'     => 'section_content',
            'title'     => ('Hadline'),
            'update_selector' => '.widget-content span' 
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
            'update_selector_html' => '.widget-content > *' 

         ];

         $form['horizontal_align'] = [
            'type'    => 'select',
            'title'   => t('Horizontal Align'),
            'tab' => 'section_content',
            'style_type' => 'style',
            'style_selector' => '.widget-content', 
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

         $form['section_style'] = [
            'type' => 'tab',
            'title' =>  t('Style')
         ];

       $form['font'] = [
            'type'        => 'noahs_font',
            'title'       => t('Font'),
            'tab'     => 'section_style',
            'style_type' => 'style',
            'style_selector' => '.widget-content > *', 
            'responsive' => true,
           ];
         return $form;
      }

      public static function template( $settings ){

         $ouput = '<div class="widget-content d-flex w-100">';
         $ouput .=  '<' . ($settings->element->heading_type ?? 'h1') . '>';
         $ouput .=  '<span>' . (!empty($settings->element->heading_text->text) ? $settings->element->heading_text->text : 'Your Title Here') . '</span>';
         $ouput .=  '</' . ($settings->element->heading_type ?? 'h1') . '>';
         $ouput .= '</div>';

         return $ouput;
      }

      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }




