<?php
if(!class_exists('element_drupalentor_pricing_item')):
   class element_drupalentor_pricing_item{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_pricing_item',
            'title' => ('Pricing Item'), 
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'desc'      => t('Pricing item title'),
                  'admin'     => true
               ),
               array(
                  'id'        => 'price',
                  'type'      => 'text',
                  'title'     => t('Price'),
               ),
               
               array(
                  'id'        => 'currency',
                  'type'      => 'text',
                  'title'     => t('Currency'),
               ),
                  
               array(
                  'id'        => 'period',
                  'type'      => 'text',
                  'title'     => t('Period'),
               ),
            
             
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
                  'desc'      => t('HTML tags allowed.'),
                  'std'       => '<ul><li><strong>List</strong> item</li></ul>',
               ),
               array(
                  'id'        => 'link_title',
                  'type'      => 'text',
                  'title'     => t('Link title'),
                  'desc'      => t('Link will appear only if this field will be filled.'),
               ),
               
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
                  'desc'      => t('Link will appear only if this field will be filled.'),
               ),
               array(
                  'id'        => 'link_title_2',
                  'type'      => 'text',
                  'title'     => t('Link title 2'),
                  'desc'      => t('Link will appear only if this field will be filled.'),
               ),
               
               array(
                  'id'        => 'link_2',
                  'type'      => 'text',
                  'title'     => t('Link 2'),
                  'desc'      => t('Link will appear only if this field will be filled.'),
               ),

               array(
                  'id'        => 'featured',
                  'type'      => 'select',
                  'title'     => t('Featured'),
                  'options'   => array( 'off' => 'No', 'on' => 'Yes' ),
               ),

               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
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
               
            ),                                          
         );
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         extract(gavias_merge_atts(array(
            'title'        => '',
            'currency'     => '',
            'price'        => '',
            'period'       => '',
            'content'      => '',
            'link_title'   => 'Sign Up Now',
            'link_title_2'   => '',
            'link'         => '',
            'link_2'         => '',
            'featured'     => 'off',
            'el_class'     => '',
            'animate'      => '',
            'animate_delay'   => ''
         ), $attr));
         if($featured == 'on') $el_class .= ' highlight-plan'; 
         if($animate) $el_class .= ' wow ' . $animate; 
         ?>

	     <?php ob_start() ?>
         <div class="pricing-table <?php print $el_class ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
            <?php if($featured=='on'){ ?>
               <div class="recommended-plan"><?php print t('Recommended Plan') ?></div>
            <?php } ?>   
            <div class="content-inner">
               <div class="content-wrap">
                  <div class="plan-name"><span class="title"><?php print $title; ?></span></div>
                  <div class="plan-price">
                     <div class="price-value clearfix">
                        <span class="dollar"><?php print $currency ?></span>
                        <span class="value"><?php print $price; ?></span>
                       <?php if($period): ?> <span class="interval"><span class="space">&nbsp;/&nbsp;</span><?php print $period ?></span> <?php endif; ?>
                     </div>
                  </div>
                  <?php if($content){ ?>
                     <div class="plan-list">
                        <?php print $content ?>
                     </div>
                  <?php } ?>   
                  <?php if($link){ ?>
                   <div class="action">
                     <div class="plan-signup">
                        <a class="btn-theme" href="<?php print $link; ?>"><?php print $link_title ?></a>
                     </div>
                     <div class="plan-demo">
                        <a class="btn-theme-link" href="<?php print $link_2; ?>"><?php print $link_title_2 ?></a>
                     </div>
                    </div>
                  <?php } ?>  
               </div> 
            </div>      
         </div>
   	<?php return ob_get_clean();
      }
   }   
endif;   


