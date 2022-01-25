<?php
class element_gva_row{
	public function render_form(){
		return array(
			'title'	=> t('Row'),
			'fields'	=> array(
				array(
		        'id'        => 'row_name',
		        'type'      => 'text',
		        'title'     => ('Row Name'),
		        'placeholder'     => ('Row Name'),
		      ),
				array(
		        'id'        => 'info',
		        'type'      => 'info',
		        'title'      => 'Setting background for row'
		      ),
                
		      array(
		        'id'         => 'resp_column_inverted',
		        'type'       => 'select',
		        'title'      => t('Responsive Invert Column'),
		        'options'    => array(
		          'normal-row' => 'Disable',
		          'inverted-row' => 'Enable'
		        )
		      ),
              array(
		        'id'        => 'resp_column_media',
		        'type'      => 'select',
		        'title'     => ('When Apply Invert Column'),
		        'options'    => array(
		          'md' => ('Responsive Small Screen'),
		          's' => ('Responsive Extra Small screen')
		        )
		      ),
		      array(
		        'id'       => 'bg_image',
		        'type'     => 'upload',
		        'title'    => ('Background Image'),
		      ),
		      array(
		        'id'          => 'bg_color',
		        'type'        => 'text',
		        'title'       => ('Background Color'),
		        'desc'        => ('Use color name (eg. "gray") or hex (eg. "#808080").'),
		        'std'         => '',
		        'class'		 => 'width-1-2'
		      ),
		      array(
		        'id'         => 'bg_particles',
		        'type'       => 'select',
		        'title'      => t('Background Particles'),
		        'class'       => 'width-1-2',
		        'options'    => array(
		          'off' => 'Disable',
		          'on' => 'Enable'
		        )
		      ),
		      array(
		        'id'         => 'bg_overlay',
		        'type'       => 'select',
		        'title'      => t('Background Overlay'),
		        'class'       => 'overlay',
		        'options'    => array(
		          'off' => 'Disable',
		          'on' => 'Enable'
		        )
		      ),
		      array(
		        'id'         => 'bg_position',
		        'type'       => 'select',
		        'title'      => t('Background Position'),
		        'class'       => 'width-1-4 clear-both',
		        'options'    => array(
		          'center top' => 'center top',
		          'center right' => 'center right',
		          'center bottom' => 'center bottom',
		          'center center' => 'center center',
		          'left top' => 'left top',
		          'left center' => 'left center',
		          'left bottom' => 'left bottom',
		          'right top' => 'right top',
		          'right center' => 'right center',
		          'right bottom' => 'right bottom',
		        )
		      ),
		      array(
		        'id'         => 'bg_repeat',
		        'type'       => 'select',
		        'title'      => t('Background Position'),
		        'class'       => 'width-1-4',
		        'options'    => array(
		          'no-repeat' => 'no-repeat',
		          'repeat' => 'repeat',
		          'repeat-x' => 'repeat-x',
		          'repeat-y' => 'repeat-y',
		          )
		      ),
		      array(
		        'id'         => 'bg_attachment',
		        'type'       => 'select',
		        'title'      => t('Background Attachment'),
		        'class'       => 'width-1-4',
		        'options'    => array(
		          'scroll' => 'Scroll',
		          'fixed'  => 'Parallax',
		          ),
		        'std'         => 'scroll'
		      ),

		      array(
		        'id'         => 'bg_size',
		        'type'       => 'select',
		        'title'      => t('Background Size'),
		        'class'       => 'width-1-4',
		        'options'    => array(
		            'cover'      => 'cover',
		            'contain'    => 'contain',
		            'default'    => 'default',
		            'width-100'  => 'Width 100%',
		          ),
		        'std'         => 'cover'
		      ),

		      array(
		        'id'          => 'bg_video',
		        'type'     => 'upload',
		        'title'       => ('Background video (url video)'),
		        'desc'        => ('Use video youtube.'),
		        'std'         => '',
		      ),

		      array(
		        'id'        => 'info',
		        'type'      => 'info',
		        'title'      => 'Setting padding, margin for row'
		      ),
		      array(
		        'id'        => 'style_space',
		        'type'      => 'select',
		        'title'     => 'Style Space',
		        'options'   => array(
		          	'default'                           => 'Default',
		          	'padding-small'                     => 'Padding Small',
		          	'remove_padding_top'                => 'Remove padding top',
		          	'remove_padding_bottom'             => 'Remove padding bottom',
		          	'remove_padding'                    => 'Remove padding for row',
		          	'remove_padding_col'                => 'Remove padding for colums of row',
		          	'remove_margin remove_padding remove_padding_col' => 'Remove padding for [colums & row]',
		          	'padding-large'                  	=> 'Padding Large & Responsive padding',
		          	'padding-top-large'                  => 'Padding Top Large',
		          	'padding-row-120'                     => 'Padding 120px & Responsive padding'
		        )
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
		        'id'          => 'padding_right',
		        'type'        => 'text',
		        'title'       => ('Padding Right'),
		        'desc'        => ('Padding Right for row (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'         => '0',
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
		        'id'          => 'padding_left',
		        'type'        => 'text',
		        'title'       => ('Padding Left'),
		        'desc'        => ('Padding Left for row (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'         => '0',
		      ),
		      array(
		        'id'        => 'info',
		        'type'      => 'info',
		        'title'      => 'Setting padding, margin for row'
		      ),
		      array(
		        'id'          => 'margin_top',
		        'type'        => 'text',
		        'title'       => ('Margin Top'),
		        'desc'        => ('Margin top for row (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'         => '0',
		      ),
		      array(
		        'id'          => 'margin_right',
		        'type'        => 'text',
		        'title'       => ('Margin Right'),
		        'desc'        => ('Margin Right for row (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'         => '0',
		      ),
		      array(
		        'id'          => 'margin_bottom',
		        'type'        => 'text',
		        'title'       => ('Margin Bottom'),
		        'desc'        => ('Margin Bottom for row (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'         => '0',
		      ),
		      array(
		        'id'          => 'margin_left',
		        'type'        => 'text',
		        'title'       => ('Margin Left'),
		        'desc'        => ('Margin Left for row (e.g. 30)'),
		        'class'     => 'width-1-4',
		        'std'         => '0',
		      ),

		      array(
		        'id'        => 'info',
		        'type'      => 'info',
		        'title'      => 'Setting layout, style for row',
		      ),
		      array(
		        'id'            => 'layout',
		        'type'          => 'select',
		        'title'         => 'Layout',
		        'options'       => array( 'container' => 'Box', 'container-fw' => 'Full Width', 'full-screen' => 'Full Screen' )
		      ),
              array(
		        'id'          => 'height',
		        'type'        => 'text',
		        'title'       => ('height Size'),
		        'desc'        => ('Use with px or vh'),
		        'std'         => '',
		        'class'		 => 'width-1-2'
		      ),
              array(
		        'id'            => 'align_horizontal',
		        'type'          => 'select',
		        'title'         => 'Align Horizontal',
		        'options'       => array( 'flex-start' => 'Left', 'center' => 'Center', 'flex-end' => 'Right' )
		      ),
              array(
		        'id'            => 'align_vertical',
		        'type'          => 'select',
		        'title'         => 'Align Vertical',
		        'options'       => array( 'flex-start' => 'Top', 'center' => 'Center', 'flex-end' => 'Bottom' )
		      ),
		      array(
		        'id'            => 'container',
		        'type'          => 'select',
		        'title'         => 'Container Size',
		        'options'       => array( 'default'=> 'Default','container-s' => 'S', 'container-m' => 'm', 'container-l' => 'L' )
		      ),

		      array(
		        'id'            => 'equal_height',
		        'type'          => 'select',
		        'title'         => 'Columns Equal Height',
		        'options'       => array( '' => 'Disable', 'gsc-equal-height' => 'Enable' )
		      ),
		      
		      array(
		        'id'        => 'info',
		        'type'      => 'info',
		        'title'      => 'Setting style, class, id for row'
		      ),
		      
		     array(
		        'id'    => 'icon',
		        'type'    => 'text',
		        'title'   => ('Icon for row'),
		        'desc'     => t('Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a>'),
		      ),
		     
		      array(
		        'id'    => 'class',
		        'type'    => 'text',
		        'title'   => ('Custom CSS classes'),
		        'desc'    => ('Multiple classes should be separated with SPACE.<br />'),
		      ),
		      
		      array(
		        'id'    => 'row_id',
		        'type'    => 'text',
		        'title'   => ('Custom ID'),
		        'desc'    => ('Use this option to create One Page sites.<br/>For example: Your Custom ID is <strong>offer</strong> and you want to open this section, please use link: <strong>your-url/#offer-2</strong>'),
		        'class'   => 'small-text',
		      ),
		      array(
		        'id'    => 'bg_row',
		        'type'    => 'select',
		        'title'   => ('Background Row Available'),
		        'options'    => array(
		          '' 					=> '-- None --',
		          'row-gradient-1' => 'Background Gradient 1',
		          'row-gradient-2' => 'Background Gradient 2',
		          'row-bg-top'		=> 'Background Top'
		        )
		      ),
		   )
		);
	}

	public function render_content( $settings = array(), $content = '' ) {
		global $base_url, $base_path;
         extract(gavias_merge_atts(array(
            'bg_image'           	=> '',
            'bg_color'           	=> '',
            'bg_particles'			=> '',
            'resp_column_inverted'	=> 'normal-row',
            'resp_column_media'		=> 'md',
            'bg_overlay'			=> '',
            'bg_position'        	=> '',
            'bg_repeat'    			=> '',
            'bg_attachment'      	=> '',
            'bg_size'          		=> '',
            'bg_video'           	=> '',
            'style_space'         	=> '',
            'padding_top'          	=> '',
            'padding_right'         => '',
            'padding_bottom'        => '',
            'padding_left'          => '',
            'margin_top'            => '',
            'margin_right'          => '',
            'margin_bottom'         => '',
            'margin_left'           => '',
            'layout'						=> 'container',
            'height'						=> '',
            'align_horizontal'						=> 'center',
            'align_vertical'						=> 'center',
            'container'						=> '',
            'equal_height'				=> '',
            'icon'						=> '',
            'class'						=> '',
            'row_id'						=> '',
            'bg_row'						=> ''
         ), $settings));

         $array_class = array();
         $array_style = array();

         $array_class[]	= $class;
			$array_class[]   = 'o-row';
			$array_class[] = $bg_row;

			$array_class[] = $equal_height;

			if($padding_top) $array_style[] 		= 'padding-top:'. intval( $padding_top ) .'px';
			if($padding_left) $array_style[] 	= 'padding-left:'. intval( $padding_left ) .'px';
			if($padding_bottom) $array_style[] 	= 'padding-bottom:'. intval( $padding_bottom ) .'px';
			if($padding_right) $array_style[] 	= 'padding-top:'. intval( $padding_right ) .'px';
			if($margin_top) $array_style[] 		= 'margin-top:'. intval( $margin_top ) .'px';
			if($margin_right) $array_style[] 	= 'margin-right:'. intval( $margin_right ) .'px';
			if($margin_bottom) $array_style[] 	= 'margin-bottom:'. intval( $margin_bottom ) .'px';
			if($margin_left) $array_style[] 		= 'margin-left:'. intval( $margin_left ) .'px';
			if($height) $array_style[] 		= 'height:'. $height;
			if($align_horizontal) $array_style[] 		= 'justify-content:'. $align_horizontal;
			if($align_vertical) $array_style[] 		= 'align-items:'. $align_vertical;
			
			if($bg_color) $array_style[] 	= 'background-color:'. $bg_color;

			if( $bg_image){
				$array_style[] 	= 'background-image:url(\''. substr($base_path, 0, -1) . $bg_image .'\')';
				$array_style[] 	= 'background-repeat:' . $bg_repeat;
				$array_style[] 	= 'background-position:' . $bg_position;
				if($bg_size == 'width-100'){
					$array_style[]  = 'background-size: 100%';
				}
				if($bg_attachment=='fixed'){
					$array_class[] = 'gva-parallax-background ';
				}
			}
			
			$row_bg_size = 'bg-size-cover';
			if($bg_size){
				$row_bg_size = 'bg-size-' . $bg_size;
			}
			$array_class[] = $row_bg_size;

            if($bg_overlay === 'on'){
                $array_class[] = 'bg_overlay';
            }
        
			$data_bg_video = "";
			if($bg_video){
				$array_class[] = 'video-bg videoResp';
				$data_bg_video = 'data-vide-bg="mp4:'.$bg_video.'" data-vide-options="loop: true, muted: true, position: 0% 0%"';
			}

//			$row_class = implode($array_class, ' ');
            $row_class = implode(' ',$array_class);
			$row_style 	= implode('; ', $array_style );
            
            
		?>
		<?php ob_start() ?>
		<div class="row--wrapper">
		  	<?php if($icon){ ?><span class="icon-row <?php print $icon ?>"></span><?php } ?>
		  	<div class="<?php print $row_class ?> <?php print ($bg_particles=='on') ? ' row-background-particles-js' : ''; ?>" <?php if($row_id) print 'id="'.$row_id.'"' ?> style="<?php print $row_style ?>" <?php if($data_bg_video) print $data_bg_video; ?>>
		    	<div class="o--inner <?php if($style_space) print $style_space; ?>">  
		      	<div class="o--container <?php print $layout ?> <?php if($container != 'default'){ print $container; }?>">
			        	<div class="row">
			          	  <div class="row--wrapper clearfix <?php print $resp_column_inverted.'-'.$resp_column_media; ?>">
								<?php print $content ?>
							</div>
	     	 			</div>
    				</div>
  				</div>  
			</div>  
		</div>
		<?php return ob_get_clean();
	}

}