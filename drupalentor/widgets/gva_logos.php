<?php 

if(!class_exists('element_gva_logos')):
   class element_gva_logos{
      
      public function render_form(){
         $fields =array(
            'type' => 'gsc_logos',
            'title' => ('Logos'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'        => 'images',
                  'type'      => 'upload',
                  'title'     => t('Images')
               ),
                array(
                  'id'     => 'imagess',
                  'type' => 'upload',
                  'title' => t('Upload video'),
                  'upload_location' => 'public://footer-video', 
                  'description' => t("Upload in these formats mp4 ogv webm jpg"),
                  'multiple' => TRUE,
                  ),
               array(
                  'id'     => 'margin',
                  'type'      => 'text',
                  'title'  => t('Margin Top'),
                  'desc'      => t('example: 30px'),
               ),
               array(
                  'id'     => 'alt',
                  'type'      => 'text',
                  'title'  => t('Alternate Text'),
               ),
            ),                                       
         );
         return $fields;
      }

      public static function render_content( $attr, $content = null ){
         global $base_url;
         extract(gavias_merge_atts(array(
            'images'           => '',
            'border'          => 'off',
            'alt'             => '',
            'margin'          => '',
            'align'           => 'none',
            'link'            => '',
            'target'          => 'off',
            'animate'         => '',
            'animate_delay'   => '',
            'el_class'        => ''
         ), $attr));
          
        
         $image = $base_url . $images; 

         
         if( $margin ){
            $margin = 'style="margin-top:'. intval( $margin ) .'px"';
         } else {
            $margin = '';
         }

         ?>
         <?php ob_start() ?>
            <div class="widget gsc-logos" <?php print $margin ?>>
               <div class="widget-content">
                     <?php echo 'caca: ' . $images; ?>
                    <img src="<?php print $images ?>" alt="<?php print $alt ?>" />
               </div>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif;   




