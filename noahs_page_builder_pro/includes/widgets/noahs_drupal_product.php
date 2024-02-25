<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_product extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_9710013" enable-background="new 0 0 512.001 512.001" height="512" viewBox="0 0 512.001 512.001" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m506.258 116.716-246-115.765c-2.696-1.269-5.819-1.269-8.516 0l-246 115.765c-3.505 1.649-5.742 5.175-5.742 9.048v85.234c0 5.523 4.477 10 10 10s10-4.477 10-10v-69.478l226 106.336v238.386l-226-106.353v-78.892c0-5.523-4.477-10-10-10s-10 4.477-10 10v85.238c0 3.874 2.237 7.399 5.742 9.048l246 115.765c1.348.634 2.803.952 4.258.952s2.91-.317 4.258-.952l246-115.765c3.505-1.649 5.742-5.175 5.742-9.048v-260.471c0-3.873-2.236-7.399-5.742-9.048zm-250.178 113.78-99.583-46.855 62.495-29.409 99.575 46.859zm-222.592-104.732 62.505-29.414 99.514 46.83-62.497 29.41zm136.521-64.245 222.574 104.741-50.53 23.779-222.574-104.741zm181.984 145.946 54.016-25.419v50.258l-54.016 25.419zm64.076-52.257-99.575-46.859 62.506-29.415 99.575 46.859zm-160.068-134.156 99.514 46.83-62.506 29.415-99.514-46.83zm10 465.191v-238.311l65.992-31.055v56.604c0 3.423 1.751 6.609 4.642 8.443 1.628 1.033 3.49 1.557 5.359 1.557 1.45 0 2.904-.315 4.257-.952l74.016-34.831c3.505-1.649 5.742-5.175 5.742-9.048v-66.016l65.991-31.055v238.311z"></path><path d="m64.258 345.458c-5-2.352-10.955-.207-13.306 4.791-2.351 4.997-.207 10.955 4.791 13.306l22.434 10.557c1.376.647 2.825.954 4.251.954 3.753 0 7.351-2.124 9.055-5.745 2.352-4.997.207-10.955-4.791-13.306z"></path><path d="m108.386 337.281c3.753 0 7.351-2.124 9.055-5.745 2.352-4.997.207-10.954-4.79-13.306l-48.393-22.773c-4.999-2.354-10.955-.208-13.306 4.79-2.352 4.997-.207 10.955 4.79 13.306l48.393 22.772c1.376.65 2.825.956 4.251.956z"></path><path d="m457.468 271.388c-2.828-1.847-6.397-2.14-9.489-.782l-146 64.145c-3.632 1.596-5.978 5.188-5.978 9.155v79.306c0 3.423 1.751 6.609 4.642 8.443 1.627 1.033 3.489 1.557 5.358 1.557 1.45 0 2.904-.315 4.257-.952l146-68.707c3.505-1.649 5.742-5.174 5.742-9.048v-74.745c.001-3.376-1.704-6.525-4.532-8.372zm-141.468 79.047 69.054-30.339v54.862l-69.054 32.497zm126.001-2.275-36.946 17.386v-54.236l36.946-16.232z"></path><path d="m10.002 265.998c2.56 0 5.121-.977 7.073-2.93 3.905-3.905 3.905-10.236 0-14.142s-10.236-3.905-14.142 0l-.003.003c-3.905 3.905-3.904 10.235.001 14.14 1.954 1.953 4.512 2.929 7.071 2.929z"></path></g></g></svg>',
            'title' => 'Product',
            'description' => 'Description',
            'group' => 'Ecommerce'
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
               'tab' => 'section_content',
               'group' => 'group_menu'
            ];

            return $form;

      }

      public function template( $settings ){

         $settings = $settings->element;
         $output = '<ul><li><a href="">Hello</a></li><ul>';
         if(!empty($settings->menu)){
            $output = $this->render_menu_navigation('main', $settings);
         }
        
         


       



         return $output;   
      }
      private function render_menu_navigation($menu_name, $settings, $theme_alter = ''){
         //Set system menu mobile
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
     
         return \Drupal::service('renderer')->render($menu);
     }
     
      public function render_content($element) {
         return $this->wrapper($element, $this->template($element->settings));
      }
   }

   



