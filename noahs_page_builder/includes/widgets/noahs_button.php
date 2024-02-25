<?php 
use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_button extends WidgetBase{
      
      public function data(){
         return [
            'icon' => '<svg id="fi_4321133" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m108.533 155.743c-1.344-3.267-4.493-5.375-8.025-5.375-.003 0-.007 0-.011 0-3.536.004-6.685 2.122-8.022 5.395-.023.056-.045.112-.066.168l-19.517 51.243c-1.475 3.871.468 8.204 4.339 9.678 3.87 1.474 8.204-.469 9.678-4.339l3.021-7.932h21.004l2.985 7.91c1.134 3.003 3.987 4.854 7.019 4.854.879 0 1.775-.156 2.646-.485 3.875-1.462 5.832-5.79 4.369-9.665l-19.339-51.246c-.026-.069-.052-.138-.081-.206zm-12.889 33.837 4.837-12.701 4.793 12.701z"></path><path d="m408.418 216.398c3.509-1.096 5.776-4.357 5.776-8.379l-.486-50.224c-.04-4.142-3.405-7.487-7.572-7.427-4.142.04-7.467 3.43-7.427 7.572l.275 28.401-22.54-32.638c-1.865-2.7-5.269-3.875-8.403-2.898s-5.268 3.878-5.268 7.16v51.878c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-27.82l21.408 31c2.165 3.127 5.791 4.453 9.237 3.375z"></path><path d="m256.439 157.867v51.975c0 4.142 3.358 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-51.975c0-4.142-3.358-7.5-7.5-7.5s-7.5 3.358-7.5 7.5z"></path><path d="m167.809 165.367c3.706 0 7.278 1.09 10.331 3.153 3.432 2.318 8.094 1.417 10.413-2.016 2.319-3.432 1.417-8.094-2.016-10.413-5.542-3.744-12.018-5.724-18.729-5.724-18.465 0-33.488 15.022-33.488 33.488 0 18.465 15.022 33.488 33.488 33.488 7.408 0 14.065-2.441 19.25-7.059 1.016-.904 1.98-1.899 2.868-2.958 2.662-3.174 2.247-7.904-.926-10.566-3.174-2.662-7.904-2.247-10.566.927-.422.503-.876.972-1.351 1.395-2.43 2.164-5.55 3.261-9.275 3.261-10.194 0-18.488-8.294-18.488-18.488s8.295-18.488 18.489-18.488z"></path><path d="m223.169 217.343c4.142 0 7.5-3.358 7.5-7.5v-44.475h6.91c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-28.704c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h6.794v44.475c0 4.142 3.358 7.5 7.5 7.5z"></path><path d="m283.79 183.855c0 18.465 15.022 33.488 33.487 33.488s33.488-15.022 33.488-33.488c0-18.465-15.022-33.488-33.488-33.488-18.465 0-33.487 15.023-33.487 33.488zm51.975 0c0 10.194-8.293 18.488-18.488 18.488-10.194 0-18.487-8.294-18.487-18.488s8.293-18.488 18.487-18.488c10.195 0 18.488 8.294 18.488 18.488z"></path><path d="m508.788 314.3-116.157-80.948c-2.386-1.663-5.519-1.796-8.038-.342s-3.97 4.234-3.723 7.132l12.024 141.069c.237 2.787 2.006 5.211 4.588 6.286s5.548.625 7.695-1.169l27.219-22.756 28.189 56.118c.927 1.845 2.574 3.226 4.551 3.818.705.211 1.429.315 2.15.315 1.304 0 2.6-.34 3.75-1.005l34.71-20.041c1.788-1.032 3.071-2.756 3.548-4.765.476-2.009.103-4.125-1.031-5.851l-34.504-52.472 33.316-12.193c2.627-.961 4.5-3.305 4.86-6.079.362-2.774-.852-5.518-3.147-7.117zm-49.073 14.557c-2.151.787-3.825 2.515-4.543 4.69-.719 2.175-.404 4.56.854 6.474l35.338 53.741-20.943 12.092-28.871-57.474c-1.028-2.047-2.936-3.512-5.179-3.977-.506-.105-1.016-.156-1.523-.156-1.743 0-3.449.608-4.811 1.746l-23.422 19.583-9.442-110.773 91.211 63.564z"></path><path d="m358.938 264.532h-319.374c-13.544 0-24.564-11.019-24.564-24.564v-112.226c0-13.545 11.02-24.564 24.564-24.564h416.839c13.545 0 24.564 11.02 24.564 24.564v112.226c0 6.748-2.74 13.062-7.716 17.778-3.006 2.849-3.133 7.596-.284 10.603 2.85 3.007 7.597 3.134 10.603.284 7.994-7.578 12.397-17.758 12.397-28.665v-112.226c0-21.816-17.749-39.564-39.564-39.564h-416.839c-21.815 0-39.564 17.748-39.564 39.564v112.226c0 21.816 17.749 39.564 39.564 39.564h319.373c4.142 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.499-7.5z"></path></g></svg>',
            'title' => 'Button',
            'description' => 'Button link',
            'group' => 'noahs_page_builder'
         ];
      }
      public static function gsc_button_id($length=12){
         $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
         $randomString = '';
         for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
         }
         return $randomString;
      }

      public function render_form(){

         $form['section_content'] = [
            'type' => 'tab',
            'title' => t('Content')
         ];

   		$form['button_title'] = [
            'type' => 'text',
            'title' => t('Button Title'),
            'tab' => 'section_content',
            'placeholder' => t('Title'),
            'update_selector' => '.widget-content'
         ];

   		$form['button_url'] = [
            'type' => 'text',
            'title' => t('URL'),
            'tab' => 'section_content',
            'placeholder' => t('Pase url here'),
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
            ]
         ];

         $form['button_horizontal_align'] = [
            'type'    => 'select',
            'title'   => t('Horizontal Align'),
            'tab' => 'section_content',
            'style_type' => 'style',
            'style_selector' => 'widget', 
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

         $form['section_styles'] = [
            'type' => 'tab',
            'title' => t('Styles')
         ];

         $form['background_color'] = [
            'type' => 'noahs_color',
            'title' => t('Background Color'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'style_css' => 'background-color', 
            'style_hover' => true,
            'responsive' => true,
         ];

         $form['font'] = [
            'type' => 'noahs_font',
            'title' => t('Font'),
            'tab' => 'section_content',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'responsive' => true,
         ];

         $form['border'] = [
            'type' => 'noahs_border',
            'title' => t('Border'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'style_css' => 'border', 
            'responsive' => true,
            'style_hover' => true,
         ];

         $form['btn_margin'] = [
            'type' => 'noahs_margin',
            'title' => t('Margin'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'style_css' => 'margin', 
            'responsive' => true,
            'style_hover' => true,
         ];

         $form['btn_padding'] = [
            'type' => 'noahs_padding',
            'title' => t('Padding'),
            'tab' => 'section_styles',
            'style_type' => 'style',
            'style_selector' => '.btn', 
            'style_css' => 'padding', 
            'responsive' => true,
            'style_hover' => true,
         ];
											
         return $form;
      }

      public function template( $settings ){

         ob_start();
         ?>
         <div class="btn-container">
            <a href="<?php echo $settings->element->button_url ?? null; ?>" class="btn btn-<?php echo $settings->element->button_style ?? 'success'; ?>"><?php echo $settings->element->button_title ?? 'My button'; ?></a>
         </div>
         <?php       
         return ob_get_clean();
      }
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }



