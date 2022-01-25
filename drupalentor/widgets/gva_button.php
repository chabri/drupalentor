<?php 
if(!class_exists('element_gva_button')):
   class element_gva_button{
      
      public static function gsc_button_id($length=12){
         $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
         $randomString = '';
         for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
         }
         return $randomString;
      }

      public function render_form(){
         $fields =array(
            'type' => 'gsc_button',
            'title' => ('Button'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'admin'     => true
               ),
                array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
               ),
               array(
                  'id'        => 'size',
                  'type'      => 'select',
                  'title'     => t('Size'),
                  'options'   => array(
                        'mini'         => 'Mini',
                        'small'        => 'Small',
                        'medium'       => 'Medium',
                        'large'        => 'Large',
                        'extra-large'  => 'Extra Large',
                  )
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => t('Style'),
                  'options'   => array(
                        'btn-theme'         => 'Pink',
                        'btn-white'        => 'White',
                  )
               ),
                
                array(
		        'id'          => 'margin_top',
		        'type'        => 'text',
		        'title'       => ('Margin Top'),
		        'desc'        => ('Margin top for column (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'         => '0',
		      ),
		      array(
		        'id'          => 'margin_bottom',
		        'type'        => 'text',
		        'title'       => ('Margin Bottom'),
		        'desc'        => ('Margin Bottom for column (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'         => '0',
		      ),

               array(
                  'id'        => 'align',
                  'type'      => 'select',
                  'title'     => t('Align'),
                  'options'   => array(
                        'flex-start'    => 'Left',
                        'center'        => 'Center',
                        'flex-end'      => 'Right',
                  )
               ),

               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'title'     => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link'),
                  'options'   => array( 0 => 'No', 1 => 'Yes' ),
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation for element'),
                  'options'   => gavias_content_builder_animate(),
                  'class'     => 'width-1-2'
               ), 
               array(
                  'id'        => 'animate_delay',
                  'type'      => 'select',
                  'title'     => t('Animation Delay'),
                  'options'   => gavias_content_builder_delay_aos(),
                  'desc'      => '0 = default',
                  'class'     => 'width-1-2'
               ), 
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
               
            ),                                       
         );
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         global $base_url;
         extract(gavias_merge_atts(array(
            'content'               => '',
            'title'          => 'Read more',
            'size'                  => 'mini',
            'style'                  => 'btn-theme',
            'link'                  => '',
            'align'                 => 'center',
            'target'                => '',
            'margin_top'                => '',
            'margin_bottom'                => '',
            'animate'               => '',
            'animate_delay'         => '',
            'el_class'              => ''
         ), $attr));
         $_id = 'button-' . self::gsc_button_id(12);
        
         $classes = array();
         $classes[] = "{$el_class} ";

         $classes[] = " {$size} ";
         $classes[] = " {$style} ";

         if( $target ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }
       
        $align = 'style="display:flex; justify-content:'.$align.';margin-top:'.intval( $margin_top ).'px;margin-bottom:'.intval( $margin_bottom ).'px"';

          //
          
         if($animate) $classes[] = 'wow ' . $animate; 
         ?>

         <?php ob_start() ?>

       

         <div class="clearfix"></div>
<div class="btn-container" <?php print $align; ?>>
         <a href="<?php print $link ?>" <?php print $target ?> class="btn <?php print implode('', $classes) ?>" id="<?php print $_id; ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
            <?php print $title ?>
         </a> 
</div>
         <?php return ob_get_clean() ?>

         <?php       
      }

   }
endif;   




