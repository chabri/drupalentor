<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_nav extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m12 0a12 12 0 1 0 12 12 12 12 0 0 0 -12-12zm0 23a11 11 0 1 1 11-11 11.0125 11.0125 0 0 1 -11 11z"/><path d="m7 14.5h-1a1.5017 1.5017 0 0 0 -1.5 1.5v1a1.5017 1.5017 0 0 0 1.5 1.5h1a1.5017 1.5017 0 0 0 1.5-1.5v-1a1.5017 1.5017 0 0 0 -1.5-1.5zm.5 2.5a.5006.5006 0 0 1 -.5.5h-1a.5006.5006 0 0 1 -.5-.5v-1a.5006.5006 0 0 1 .5-.5h1a.5006.5006 0 0 1 .5.5z"/><path d="m18 14.5h-7a1.5017 1.5017 0 0 0 -1.5 1.5v1a1.5017 1.5017 0 0 0 1.5 1.5h7a1.5017 1.5017 0 0 0 1.5-1.5v-1a1.5017 1.5017 0 0 0 -1.5-1.5zm.5 2.5a.5006.5006 0 0 1 -.5.5h-7a.5006.5006 0 0 1 -.5-.5v-1a.5006.5006 0 0 1 .5-.5h7a.5006.5006 0 0 1 .5.5z"/><path d="m7 10h-1a1.5017 1.5017 0 0 0 -1.5 1.5v1a1.5017 1.5017 0 0 0 1.5 1.5h1a1.5017 1.5017 0 0 0 1.5-1.5v-1a1.5017 1.5017 0 0 0 -1.5-1.5zm.5 2.5a.5006.5006 0 0 1 -.5.5h-1a.5006.5006 0 0 1 -.5-.5v-1a.5006.5006 0 0 1 .5-.5h1a.5006.5006 0 0 1 .5.5z"/><path d="m18 10h-7a1.5017 1.5017 0 0 0 -1.5 1.5v1a1.5017 1.5017 0 0 0 1.5 1.5h7a1.5017 1.5017 0 0 0 1.5-1.5v-1a1.5017 1.5017 0 0 0 -1.5-1.5zm.5 2.5a.5006.5006 0 0 1 -.5.5h-7a.5006.5006 0 0 1 -.5-.5v-1a.5006.5006 0 0 1 .5-.5h7a.5006.5006 0 0 1 .5.5z"/><path d="m7 5.5h-1a1.5017 1.5017 0 0 0 -1.5 1.5v1a1.5017 1.5017 0 0 0 1.5 1.5h1a1.5017 1.5017 0 0 0 1.5-1.5v-1a1.5017 1.5017 0 0 0 -1.5-1.5zm.5 2.5a.5006.5006 0 0 1 -.5.5h-1a.5006.5006 0 0 1 -.5-.5v-1a.5006.5006 0 0 1 .5-.5h1a.5006.5006 0 0 1 .5.5z"/><path d="m18 5.5h-7a1.5017 1.5017 0 0 0 -1.5 1.5v1a1.5017 1.5017 0 0 0 1.5 1.5h7a1.5017 1.5017 0 0 0 1.5-1.5v-1a1.5017 1.5017 0 0 0 -1.5-1.5zm.5 2.5a.5006.5006 0 0 1 -.5.5h-7a.5006.5006 0 0 1 -.5-.5v-1a.5006.5006 0 0 1 .5-.5h7a.5006.5006 0 0 1 .5.5z"/></svg>',
            'title' => 'Drupal Menu',
            'description' => 'Description',
            'group' => 'Drupal'
         ];
      }
      
      public function render_form(){
         $form = [];


         $media_types = \Drupal::entityTypeManager()->getStorage('menu')->loadMultiple();
         $menus = [];
         $menus[] = 'Select your menu';
         foreach ($media_types as $menu_entity) {
           $menus[$menu_entity->id()] = $menu_entity->label();
         }
     

            // Section Content
            $form['section_content'] = [
               'type' => 'tab',
               'title' =>  t('Content')
            ];
            $form['group_menu'] = [
               'type' => 'group',
               'title' =>  t('Content')
            ];
            $form['menu'] = [
               'type'    => 'select',
               'title'   => t('Menu'),
               'tab' => 'section_content',
               'options' =>  $menus,
               'group' => 'group_menu'
            ];
            $form['expand_all'] = [
               'type'    => 'checkbox',
               'title'   => t('Expand All'),
               'value' => 'true',
               'default_value' => 'false',
               'tab' => 'section_content',
               'group' => 'group_menu'
            ];

            $form['menu_vertical'] = [
               'type'    => 'checkbox',
               'title'   => t('Vertical'),
               'value' => 'true',
               'default_value' => 'false',
               'tab' => 'section_content',
               'group' => 'group_menu'
            ];

            $form['menu_responsive'] = [
               'type'    => 'checkbox',
               'title'   => t('Responsive?'),
               'value' => 'true',
               'default_value' => 'true',
               'tab' => 'section_content',
               'group' => 'group_menu'
            ];

            $form['menu_horizontal_align'] = [
               'type'    => 'select',
               'title'   => t('Horizontal Align'),
               'tab' => 'section_content',
               'style_type' => 'style',
               'style_selector' => '.menu__inner', 
               'style_css' => 'justify-content',
               'responsive' => true,
               'options' => [
                  'center' => 'Center',
                  'flex-start' => 'Start',
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

            $form['group_links'] = [
               'tab' => 'section_styles',
               'type' => 'group',
               'title' =>  t('First Links')
            ];
            $form['group_links_gap'] = [
               'type' => 'text',
               'title' => t('Links separation'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.menu__inner', 
               'style_css' => 'gap', 
               'responsive' => true,
               'group' => 'group_links',
            ];
            $form['group_links_font'] = [
               'type' => 'noahs_font',
               'title' => t('Font'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => 'a.menu__link', 
               'style_selector_hover' => '.menu__item:hover .menu__link', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'group_links',
            ];
            $form['group_links_border'] = [
               'type' => 'noahs_border',
               'title' => t('Border'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => 'a.menu__link', 
               'style_css' => 'border', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'group_links',
            ];
   
            $form['group_links_btn_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => 'a.menu__link', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'group_links',
            ];
   
            $form['group_links_btn_padding'] = [
               'type' => 'noahs_padding',
               'title' => t('Padding'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => 'a.menu__link', 
               'style_css' => 'padding', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'group_links',
            ];
            $form['group_links_bg_color'] = [
               'type'     => 'noahs_color',
               'title'    => ('Background Color'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => 'a.menu__link', 
               'style_css' => 'color',
               'style_hover' => true,
               'group' => 'group_sub_links',
            ];
            $form['group_links_bg_color'] = [
               'type'     => 'noahs_color',
               'title'    => ('Background Active Color'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => 'a.menu__link.active', 
               'style_css' => 'color',
               'style_hover' => true,
               'group' => 'group_sub_links',
            ];
            $form['group_links_active_color'] = [
               'type'     => 'noahs_color',
               'title'    => ('Active Color'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => 'a.menu__link.active', 
               'style_css' => 'color',
               'style_hover' => true,
               'group' => 'group_links',
            ];

            $form['group_sub_links'] = [
               'tab' => 'section_styles',
               'type' => 'group',
               'title' =>  t('SubMenu Links')
            ];
            $form['group_sub_links_font'] = [
               'type' => 'noahs_font',
               'title' => t('Font'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu li a', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'group_sub_links',
            ];
            $form['group_sub_links_border'] = [
               'type' => 'noahs_border',
               'title' => t('Border'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu li a', 
               'style_css' => 'border', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'group_sub_links',
            ];
   
            $form['group_sub_links_btn_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Margin'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu li a', 
               'style_css' => 'margin', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'group_sub_links',
            ];
   
            $form['group_sub_links_btn_padding'] = [
               'type' => 'noahs_padding',
               'title' => t('Padding'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu li a', 
               'style_css' => 'padding', 
               'responsive' => true,
               'style_hover' => true,
               'group' => 'group_sub_links',
            ];
            $form['group_sub_links_bg_color'] = [
               'type'     => 'noahs_color',
               'title'    => ('Background Color'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu li a', 
               'style_css' => 'color',
               'style_hover' => true,
               'group' => 'group_sub_links',
            ];
            $form['group_sub_links_bg_color'] = [
               'type'     => 'noahs_color',
               'title'    => ('Background Active Color'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu li a', 
               'style_css' => 'background-color',
               'style_hover' => true,
               'group' => 'group_sub_links',
            ];
            $form['group_sub_links_active_color'] = [
               'type'     => 'noahs_color',
               'title'    => ('Active Color'),
               'tab'     => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu li.active a', 
               'style_css' => 'color',
               'style_hover' => true,
               'group' => 'group_sub_links',
            ];

            $form['submenu'] = [
               'tab' => 'section_styles',
               'type' => 'group',
               'title' =>  t('SubMenu')
            ];

            $form['submenu_border'] = [
               'type' => 'noahs_border',
               'title' => t('Border'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu', 
               'style_css' => 'border', 
               'responsive' => true,
               'group' => 'submenu',
            ];

   
            $form['submenu_padding'] = [
               'type' => 'noahs_padding',
               'title' => t('Padding'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu', 
               'style_css' => 'padding', 
               'responsive' => true,
               'group' => 'submenu',
            ];
            $form['submenu_box_shadows'] = [
               'type'    => 'noahs_shadows',
               'title'   => t('Box Shadow'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.submenu', 
               'group' => 'submenu',
            ];
            $form['submenu_width'] = [
               'type' => 'text',
               'title' => t('Width'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_css' => 'width',
               'style_selector' => '.submenu', 
               'responsive' => true,
               'group' => 'group_links',
            ];

            $form['burger_menu'] = [
               'tab' => 'section_styles',
               'type' => 'group',
               'title' =>  t('Burger')
            ];
               
            $form['burger_margin'] = [
               'type' => 'noahs_margin',
               'title' => t('Burger Margin'),
               'tab' => 'section_styles',
               'style_type' => 'style',
               'style_selector' => '.burger', 
               'style_css' => 'margin', 
               'responsive' => true,
               'group' => 'burger_menu',
            ];
            $form['burger_horizontal_align'] = [
               'type'    => 'select',
               'title'   => t('Horizontal Align'),
               'tab' => 'section_content',
               'style_type' => 'style',
               'style_selector' => '.burger-wrapper', 
               'style_css' => 'justify-content',
               'group' => 'burger_menu',
               'options' => [
                  'center' => 'Center',
                  'flex-start' => 'Start',
                  'flex-end' => 'End'
               ]
            ];
            return $form;

      }

      public function template( $settings ){

         $settings = $settings->element;
         $menu = !empty($settings->menu) ? $settings->menu : 'main';
   
         $output = $this->render_menu_navigation($menu, $settings, null );
        
         return $output;   
      }

      private function render_menu_navigation($menu_name, $settings, $theme_alter){

         $menu_orientation = !empty($settings->menu_vertical) ? 'navbar--horizontal' : 'navbar--vertical';
         $responsive = !empty($settings->menu_responsive) ? 'menu--responsive' : 'menu--not-responsive';

         $menu_tree = \Drupal::menuTree();
         // Build the typical default set of menu tree parameters.
         if(!empty($settings->menu)){
            $parameters = new \Drupal\Core\Menu\MenuTreeParameters();
         }else{
            $parameters = $menu_tree->getCurrentRouteMenuTreeParameters($menu_name);
         }

      
         // Load the tree based on this set of parameters.
         $tree = $menu_tree->load($menu_name, $parameters);
  
         // Transform the tree using the manipulators you want.
         $manipulators = array(
             // Only show links that are accessible for the current user.
             array('callable' => 'menu.default_tree_manipulators:checkAccess'),
             // Use the default sorting of menu links.
             array('callable' => 'menu.default_tree_manipulators:generateIndexAndSort'),
         );
         $tree = $menu_tree->transform($tree, $manipulators);
     
         // Finally, build a renderable array from the transformed tree.
         $menu = $menu_tree->build($tree);

         if(!empty($theme_alter)){
            $menu['#theme'] = $theme_alter;
        }
        ?>
        <?php ob_start() ?>
        <div class="noahs-navbar w-100 <?php echo $menu_orientation .' '. $responsive; ?>">
         <span class="overlay"></span>
         <div class="burger-wrapper" id="burger">
               <div class="burger" id="burger">
                  <span class="burger-line"></span>
                  <span class="burger-line"></span>
                  <span class="burger-line"></span>
               </div>
            </div>
            <?php echo \Drupal::service('renderer')->render($menu); ?>
        </div>

         <?php return ob_get_clean() ?>  
         <?php   
     }
     
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



