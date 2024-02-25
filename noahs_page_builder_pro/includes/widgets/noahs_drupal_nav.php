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

   



