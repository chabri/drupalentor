<?php 
use Drupal\image\Entity\ImageStyle;
if(!class_exists('element_drupalentor_slideshow')):
   class element_drupalentor_slideshow{

      public function render_form(){
         $image_styles = \Drupal::entityQuery('image_style')->execute();
         $fields = array(
            'type' => 'drupalentor_slideshow',
            'title' => t('Slideshow'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title For Admin'),
                  'admin'     => true
               ),
               array(
                  'id'        => 'image_style',
                  'type'      => 'select',
                  'title'     => t('Image Style'),
                  'options'   => $image_styles
               ),
                array(
		        'id'        => 'padding_top',
		        'type'      => 'text',
		        'title'     => ('Padding Top'),
		        'desc'      => ('Padding Top for row (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'       => '0',
		      ),
		      array(
		        'id'          => 'padding_bottom',
		        'type'        => 'text',
		        'title'       => ('Padding Bottom'),
		        'desc'        => ('Padding Bottom for row (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'         => '0',
		      ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),   
            ),                                     
        );
            

         for($i=1; $i<=4; $i++){
            $fields['fields'][] = array(
               'id'     => "info_{$i}",
               'type'   => 'info',
               'desc'   => "Information for item {$i}"
            );
            $fields['fields'][] = array(
               'id'        => "image_{$i}",
               'type'      => 'upload',
               'title'     => t("Image {$i}")
            );
            $fields['fields'][] = array(
		        'id'          => "bg_color_{$i}",
		        'type'        => 'color',
		        'title'       => ('Background Color'),
		        'desc'        => ('Use color name (eg. "gray") or hex (eg. "#808080").'),
                'class'       => 'width-1-4',
		      );
            $fields['fields'][] = array(
		        'id'          => "txt_color_{$i}",
		        'type'        => 'color',
		        'title'       => ('Text Color'),
		        'desc'        => ('Use color name (eg. "gray") or hex (eg. "#808080").'),
                'class'       => 'width-1-4',
		      );
            $fields['fields'][] = array(
		        'id'          => "content_size_{$i}",
		        'type'        => 'text',
		        'title'       => ('Content Size'),
		        'desc'        => ('Content size un px'),
                'class'       => 'width-1-4',
		      );
            $fields['fields'][] = array(
               'id'        => "align_content_{$i}",
               'type'      => 'select',
               'title'     => t("Content {$i}"),
               'options'   => array( 'flex-start' => 'Left', 'center' => 'Center', 'flex-end' => 'Right' ),
                'class'       => 'width-1-4',
            );
     
            $fields['fields'][] = array(
               'id'        => "content_{$i}",
               'type'      => 'textarea',
               'title'     => t("Content {$i}")
            );
            $fields['fields'][] = array(
            'id'          => "button_1_{$i}",
            'type'        => 'text',
            'title'       => ('Button Primary'),
            'class'       => 'width-1-3',
            );
            $fields['fields'][] = array(
            'id'          => "button_1_url_{$i}",
            'type'        => 'text',
            'title'       => ('Button Primary URL'),
            'class'       => 'width-1-3',
            );
            $fields['fields'][] = array(
              'id'        => "icon_1_{$i}",
              'type'      => 'text',
              'title'     => ('Icon class'),
              'std'       => '',
              'desc'     => ('Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a> or <a target="_blank" href="http://gaviasthemes.com/icons/ionicon/">Custom icon</a>'),
            'class'       => 'width-1-3',
           );
            $fields['fields'][] = array(
            'id'          => "button_2_{$i}",
            'type'        => 'text',
            'title'       => ('Button Secondary'),
            'class'       => 'width-1-3',
            );
            $fields['fields'][] = array(
            'id'          => "button_2_url_{$i}",
            'type'        => 'text',
            'title'       => ('Button Secondary URL'),
            'class'       => 'width-1-3',
            );
            $fields['fields'][] = array(
              'id'        => "icon_2_{$i}",
              'type'      => 'text',
              'title'     => ('Icon class'),
              'std'       => '',
              'desc'     => ('Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a> or <a target="_blank" href="http://gaviasthemes.com/icons/ionicon/">Custom icon</a>'),
              'class'       => 'width-1-3',
           );
        }
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         global $base_url;
         $default = array(
            'title'           => '',
            'image_style'     => '',
            'padding_top'          	=> '',
            'padding_bottom'        => '',
            'el_class'        => '',
         );

         for($i=1; $i<=4; $i++){
            $default["image_{$i}"] = '';
            $default["content_{$i}"] = '';
            $default["bg_color_{$i}"] = '';
            $default["txt_color_{$i}"] = '#ffffff';
            $default["align_content_{$i}"] = 'center';
            $default["content_size_{$i}"] = '620';
            $default["button_1_{$i}"] = '';
            $default["button_1_url_{$i}"] = '';
            $default["icon_1_{$i}"] = 'ion-ios-arrow-thin-right';
            $default["button_2_{$i}"] = '';
            $default["button_2_url_{$i}"] = '';
            $default["icon_2_{$i}"] = 'ion-ios-arrow-thin-right';
         }

         extract(gavias_merge_atts($default, $attr));

         $style = ImageStyle::load($image_style);

         $_id = gavias_content_builder_makeid();
        $array_style = array();
        if($padding_top) $array_style[] 		= 'padding-top:'. intval( $padding_top ) .'px';
        if($padding_bottom) $array_style[] 	= 'padding-bottom:'. intval( $padding_bottom ) .'px';
        $row_style 	= implode('; ', $array_style );

         ?>
         <?php ob_start() ?>
         <div class="swiper-container header-slide <?php echo $el_class ?>"> 
            <div class="swiper-wrapper">
                         
               <?php for($i=1; $i<=4; $i++){ ?>
                  <?php 

                    $image = "image_{$i}";
                    $content = "content_{$i}";
                    $bg_color = "bg_color_{$i}";
                    $txt_color = "txt_color_{$i}"; 
                    $align_content = "align_content_{$i}";
                    $textColor = "color:".$$txt_color.";";
                    $content_size = "content_size_{$i}";
                    $btn_1 = "button_1_{$i}";
                    $btn_1_url = "button_1_url_{$i}";
                    $icon_1 = "icon_1_{$i}";
                    $btn_2 = "button_2_{$i}";
                    $btn_2_url = "button_2_url_{$i}";
                    $icon_2 = "icon_2_{$i}";
                    $content_size = 'max-width:'. intval( $$content_size ) .'px';
                    $image_path = "";
                    
                     $icon1 = '<i class="'.$$icon_1.'"></i>';
                     $icon2 = '<i class="'.$$icon_2.'"></i>';
       
                     if(!empty($$image)){
                        $image_path = $style->buildUrl(str_replace('/sites/default/files/', 'public://', $$image));
                     }
                  ?>
                 <?php if($$content){ ?>
                     <div class="swiper-slide background <?php if(!empty($$image)){ echo 'overlay';} ?>" style="<?php if(!empty($$image)){ echo "background-image:url(".$image_path.");";} ?> <?php if($$bg_color): ?> background-color: <?php print $$bg_color; ?>;<?php endif; ?><?php print $textColor; ?>">
                        <div class="container container-m" style="<?php print 'justify-content:'.$$align_content.';'; ?>">
                            <div class="box-content" style="<?php print $content_size.';'.$row_style ?>">
                                <?php print $$content ?>
                                <?php if($$btn_1 || $$btn_2){ ?>
                                    <div class="btn-container">
                                        <?php if($$btn_1){ ?>
                                            <a class="btn btn-primary" href="<?php print $$btn_1_url; ?>">
                                                <?php print $$btn_1; ?>
                                                <?php print $icon1; ?> 
                                            </a>
                                        <?php } ?>
                                        <?php if($$btn_2){ ?>
                                        <a class="btn btn-secondary" href="<?php print $$btn_2_url; ?>">
                                            <?php print $$btn_2; ?>
                                            <?php print $icon2; ?> 
                                        </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>      
                        </div>
                    </div>
                   <?php } ?>   
               <?php } ?>
            </div> 
            <div class="s-pagination">
                <div class="c-pag swiper-pagination"></div>
            </div>
         </div>   
         <?php return ob_get_clean();
      }
   }
 endif;  



