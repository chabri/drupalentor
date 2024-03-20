<?php 


use Drupal\noahs_page_builder\WidgetBase;
use Drupal\Core\Language\Language;

use Drupal\Core\Url;

   class element_noahs_drupal_lang_switcher extends WidgetBase {

      public function data(){
         return [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="512" height="512" id="fi_5403606"><g id="_31_-_40" data-name="31 - 40"><g id="Language"><path d="M41,17.5H30V11a5.006,5.006,0,0,0-5-5H7a5.006,5.006,0,0,0-5,5V23a5.006,5.006,0,0,0,5,5v2.09a1.988,1.988,0,0,0,1.231,1.842,2,2,0,0,0,2.186-.435.892.892,0,0,0,.1-.114L13.005,28H18v6.5a5.006,5.006,0,0,0,5,5H34.086l3.5,3.5A2,2,0,0,0,41,41.586V39.5a5.006,5.006,0,0,0,5-5v-12A5.006,5.006,0,0,0,41,17.5ZM12.5,26a1,1,0,0,0-.8.407L9,30.067V27a1,1,0,0,0-1-1H7a3,3,0,0,1-3-3V11A3,3,0,0,1,7,8H25a3,3,0,0,1,3,3v6.5H23a4.957,4.957,0,0,0-2.951.985l-3.139-6.9a1,1,0,0,0-1.82,0l-5,11a1,1,0,0,0,.5,1.324A.982.982,0,0,0,11,24a1,1,0,0,0,.91-.586L13.462,20H18.54l.071.155A4.939,4.939,0,0,0,18,22.5V26Zm5.131-8h-3.26L16,14.416ZM44,34.5a3,3,0,0,1-3,3H40a1,1,0,0,0-1,1v3.086l-3.793-3.793A1,1,0,0,0,34.5,37.5H23a3,3,0,0,1-3-3v-12a3,3,0,0,1,3-3H41a3,3,0,0,1,3,3Z"></path><path d="M37,25H33V23a1,1,0,0,0-2,0v2H27a1,1,0,0,0,0,2h7.42a6.96,6.96,0,0,1-2.426,4.348A6.974,6.974,0,0,1,30.171,29a1,1,0,1,0-1.806.858,8.863,8.863,0,0,0,1.875,2.572A7.128,7.128,0,0,1,27.429,33a.97.97,0,0,0-.965,1A1.031,1.031,0,0,0,27.5,35a8.932,8.932,0,0,0,4.52-1.23A9.127,9.127,0,0,0,36.571,35a.97.97,0,0,0,.965-1A1.031,1.031,0,0,0,36.5,33a6.949,6.949,0,0,1-2.72-.566A8.97,8.97,0,0,0,36.441,27H37a1,1,0,0,0,0-2Z"></path></g></g></svg>',
            'title' => 'Language Switcher Node',
            'description' => '',
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
            $form['group_menu'] = [
               'type' => 'group',
               'title' =>  t('Content')
            ];
 
            $form['menu_lang_code'] = [
               'type'    => 'checkbox',
               'title'   => t('Use Lang Code'),
               'value' => 'true',
               'default_value' => 'false',
               'tab' => 'section_content',
               'group' => 'group_menu'
            ];
 
            $form['menu_dropdown'] = [
               'type'    => 'checkbox',
               'title'   => t('Use Drupdown'),
               'value' => 'true',
               'default_value' => 'false',
               'tab' => 'section_content',
               'group' => 'group_menu'
            ];
            $form['hide_current'] = [
               'type'    => 'checkbox',
               'title'   => t('Hide Current Language'),
               'value' => 'true',
               'default_value' => 'false',
               'tab' => 'section_content',
               'group' => 'group_menu'
            ];

            $form['section_styles'] = [
               'type' => 'tab',
               'title' => t('Styles')
            ];

            $form['group_links'] = [
               'tab' => 'section_styles',
               'type' => 'group',
               'title' =>  t('Links')
            ];
            $form['font'] = [
               'type' => 'noahs_font',
               'title' => t('Font'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.noahs-language-switcher .caption, .noahs-language-switcher a', 
               'style_hover' => true,
               'group' => 'group_links',
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
               'group' => 'group_links',
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
               'group' => 'group_links',
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
               'group' => 'group_links',
            ];
            $form['active_color'] = [
               'type'     => 'noahs_color',
               'title'    => ('Active Color'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => 'li.active a', 
               'style_css' => 'color',
               'style_hover' => true,
               'group' => 'group_links',
            ];
            $form['bg_color'] = [
               'type'     => 'noahs_color',
               'title'    => ('Backgroud Color'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.noahs-language-switcher .caption, .noahs-language-switcher .item', 
               'style_css' => 'background-color',
               'style_hover' => true,
               'group' => 'group_links',
            ];
            $form['active_bg_color'] = [
               'type'     => 'noahs_color',
               'title'    => ('Active Backgroud Color'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.noahs-language-switcher.open .caption, .noahs-language-switcher.open .item', 
               'style_css' => 'background-color',
               'style_hover' => true,
               'group' => 'group_links',
            ];

            $form['dropdown_group'] = [
               'tab' => 'section_styles',
               'type' => 'group',
               'title' =>  t('Dropdown')
            ];
            $form['dropdown_font_icon_size'] = [
               'type' => 'text',
               'title' => t('Icon size'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.caption i', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'dropdown_group',
            ];
            $form['dropdown_font'] = [
               'type' => 'noahs_font',
               'title' => t('Font'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.list a', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'dropdown_group',
            ];
            $form['dropdown_bgcolor'] = [
               'type'     => 'noahs_color',
               'title'    => ('Background Box'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.list a', 
               'style_css' => 'background-color',
               'style_hover' => true,
               'group' => 'dropdown_group',
            ];
            $form['dropdown_border'] = [
               'type' => 'noahs_border',
               'title' => t('Border'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.list', 
               'style_css' => 'border', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'dropdown_group',
            ];
            $form['dropdown_btn_padding'] = [
               'type' => 'noahs_padding',
               'title' => t('Padding'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.list', 
               'style_css' => 'padding', 
               'responsive' => true,
               'group' => 'dropdown_group',
            ];
            $form['box_shadows'] = [
               'type'    => 'noahs_shadows',
               'title'   => t('Image Shadow'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.list', 
               'responsive' => true, 
               'style_hover' => true,
               'group' => 'dropdown_group',
            ];
            $form['border-radius'] = [
               'type'    => 'noahs_radius',
               'title'   => t('Border Radius'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.list', 
               'responsive' => true, 
               'style_hover' => true,
               'group' => 'dropdown_group',
            ];
            return $form;

      }

      public function template( $settings ){




         $render_block = '';
         $settings = $settings->element;
         $route_name = \Drupal::routeMatch()->getRouteName();
         $langManager = \Drupal::languageManager();
         $languages = $langManager->getLanguages();


         $route_match = \Drupal::routeMatch();
         $manager = \Drupal::service('plugin.manager.block');

         $block = $manager->createInstance('language_block:language_interface');
         
         $derivative_id = $block->getDerivativeId();

         $links = $langManager->getLanguageSwitchLinks($derivative_id, Url::fromRouteMatch($route_match));
         $links = ($links !== NULL) ? $links->links : [];


         // $langManager->getCurrentLanguage()->getId()
         if(!empty($settings->hide_current)){
            unset($languages[$langManager->getCurrentLanguage()->getId()]);
         }
    
         

         ?>
         <?php ob_start() ?>
               <div class="widget-content">
                  <div class="noahs-language-switcher <?php echo !empty($settings->menu_dropdown) ? 'dropdown' : 'not_dropdown' ?>">
                     <?php if(!empty($settings->menu_dropdown)){ ?>
                        <div class="caption">
                           <span>
                              <?php 
                                  if(!empty($settings->menu_lang_code)){
                                    echo  $langManager->getCurrentLanguage()->getId();
                                 }else{
                                    echo  $langManager->getCurrentLanguage()->getName();
                                 }
                                 ?>
                           </span>
                           <i class="fa-solid fa-chevron-down"></i>
                        </div>
                     <?php } ?>
                     <div class="list">
                        <?php 
                              foreach ($languages as $language) {
                                 $url = Url::fromRoute($links[$language->getId()]['url']->getRouteName(), $links[$language->getId()]['url']->getRouteParameters(), ['language' => $language]);
                                 $uri = $url->toString();
                                 $current_path = \Drupal::service('path.current')->getPath();

                                 if(!empty($settings->menu_lang_code)){
                                    $name = $language->getId();
                                 }else{
                                    $name = $language->getName();
                                 }
                              ?>
                           <div class="item <?php echo ($current_path === $uri) ?  'active' : 'inactive'; ?>"><a href="<?php echo $uri; ?>"><?php echo $name; ?></a></div>
                        <?php } ?>
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

   



