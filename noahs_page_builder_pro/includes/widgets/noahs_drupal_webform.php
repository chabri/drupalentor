<?php 


use Drupal\noahs_page_builder\WidgetBase;

   class element_noahs_drupal_webform extends WidgetBase{

      public function data(){
         return [
            'icon' => '<svg id="fi_4615974" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><g id="Page-1_39_"><g id="_x30_40---Browser-Contact-Form"><path id="Shape_199_" d="m469.333 0h-426.666c-23.553.028-42.639 19.114-42.667 42.667v426.667c.028 23.552 19.114 42.638 42.667 42.666h426.667c23.552-.028 42.638-19.114 42.667-42.667v-426.666c-.029-23.553-19.115-42.639-42.668-42.667zm-426.666 17.067h426.667c14.138 0 25.6 11.462 25.6 25.6v25.6h-477.867v-25.6c0-14.139 11.461-25.6 25.6-25.6zm426.666 477.866h-426.666c-14.138 0-25.6-11.462-25.6-25.6v-384h477.867v384c-.001 14.139-11.462 25.6-25.601 25.6z"></path><circle id="Oval_16_" cx="401.067" cy="42.667" r="8.533"></circle><circle id="Oval_15_" cx="435.2" cy="42.667" r="8.533"></circle><circle id="Oval_14_" cx="469.333" cy="42.667" r="8.533"></circle><path id="Shape_198_" d="m59.733 179.2h170.667c9.426 0 17.067-7.641 17.067-17.067v-34.133c0-9.426-7.641-17.067-17.067-17.067h-170.667c-9.426 0-17.067 7.641-17.067 17.067v34.133c.001 9.426 7.642 17.067 17.067 17.067zm0-51.2h170.667v34.133h-170.667z"></path><path id="Shape_197_" d="m452.267 110.933h-170.667c-9.426 0-17.067 7.641-17.067 17.067v34.133c0 9.426 7.641 17.067 17.067 17.067h170.667c9.426 0 17.067-7.641 17.067-17.067v-34.133c-.001-9.426-7.642-17.067-17.067-17.067zm-170.667 51.2v-34.133h170.667v34.133z"></path><path id="Shape_196_" d="m452.267 196.267h-392.534c-9.426 0-17.067 7.641-17.067 17.067v170.666c0 9.426 7.641 17.067 17.067 17.067h392.533c9.426 0 17.067-7.641 17.067-17.067v-170.667c0-9.425-7.641-17.066-17.066-17.066zm-392.534 187.733v-170.667h392.533v170.667z"></path><path id="Shape_195_" d="m443.733 418.133h-119.466c-14.138 0-25.6 11.462-25.6 25.6s11.462 25.6 25.6 25.6h119.467c14.138 0 25.6-11.462 25.6-25.6-.001-14.138-11.462-25.6-25.601-25.6zm0 34.134h-119.466c-4.713 0-8.533-3.821-8.533-8.533 0-4.713 3.821-8.533 8.533-8.533h119.467c4.713 0 8.533 3.821 8.533 8.533s-3.821 8.533-8.534 8.533z"></path><path id="Shape_194_" d="m85.333 247.467h25.6c4.713 0 8.533-3.821 8.533-8.533 0-4.713-3.821-8.533-8.533-8.533h-25.6c-4.713 0-8.533 3.821-8.533 8.533s3.821 8.533 8.533 8.533z"></path><path id="Shape_193_" d="m145.067 247.467h102.4c4.713 0 8.533-3.821 8.533-8.533 0-4.713-3.82-8.533-8.533-8.533h-102.4c-4.713 0-8.533 3.821-8.533 8.533-.001 4.712 3.82 8.533 8.533 8.533z"></path><path id="Shape_192_" d="m307.2 264.533h-221.867c-4.713 0-8.533 3.82-8.533 8.533s3.821 8.533 8.533 8.533h221.867c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533z"></path><path id="Shape_191_" d="m36.634 57.233c3.332 3.331 8.734 3.331 12.066 0l2.5-2.5 2.5 2.5c3.348 3.234 8.671 3.188 11.962-.104 3.292-3.292 3.338-8.614.104-11.962l-2.5-2.5 2.5-2.5c3.234-3.348 3.188-8.671-.104-11.962-3.292-3.292-8.614-3.338-11.962-.104l-2.5 2.5-2.5-2.5c-3.348-3.234-8.671-3.188-11.962.104-3.292 3.292-3.338 8.614-.104 11.962l2.5 2.5-2.5 2.5c-3.332 3.332-3.332 8.734 0 12.066z"></path></g></g></g></svg>',
            'title' => 'Webform',
            'description' => 'Description',
            'group' => 'Noahs Pro'
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

   



