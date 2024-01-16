<?php


use Drupal\drupalentor\WidgetBase;

class element_drupalentor_row extends WidgetBase{
	
	public function data(){
		return [
			'icon' => '<i class="fa-solid fa-square"></i>',
			'title' => 'Section',
			'description' => 'Description',
			'group' => 'Drupalentor'
		];
	}


	public function render_form(){
		$form = [];

		// Section Content
		$form['section_content'] = [
			'type' => 'tab',
			'title' =>  t('Content')
		];
		$form['row_name'] = [
			'type'      => 'text',
			'title'     => t('Row Name'),
			'tab'     => 'section_content',
			'placeholder'     => t('Row Name'),
		];
		$form['info_text'] = [
			'type'      => 'info',
			'tab'     => 'section_content',
			'title'     => ('Structure'),
		];
		$form['section_container'] = [
			'type'    => 'select',
			'title'   => t('Container'),
			'tab' => 'section_content',
			'style_type' => 'class',
			'style_selector' => '.drupalentor-row-container', 
			'options' => [
				'container' => t('Container'),
				'container-fluid' => t('Full Width'),
			]
		];
		$form['section_container_width'] = [
			'type'    => 'text',
			'title'   => t('Container Width'),
			'tab' => 'section_content',
			'placeholder'     => t('Custom Container Width'),
			'style_type' => 'style',
			'style_selector' => '.drupalentor-row-container', 
			'style_css' => 'max-width', 
			'state' => [
				'visible' => [
					'section_container' => ['value' => 'container'],
				  ],
			]
		];
		$form['section_height'] = [
			'type'    => 'select',
			'title'   => t('Row height'),
			'tab' => 'section_content',
			'style_type' => 'class',
			'style_selector' => 'widget', 
			'options' => [
				'' => t('default'),
				'full-height' => t('Full height'),
				'min-height' => t('Min Height'),
			]
		];
		$form['section_min_height'] = [
			'type'    => 'text',
			'title'   => t('Min height'),
			'tab' => 'section_content',
			'placeholder'     => t('Min height'),
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_css' => 'min-height', 
			'state' => [
				'visible' => [
					'section_height' => ['value' => 'min-height'],
				  ],
			]
		];

		$form['columns_position'] = [
			'type'    => 'select',
			'title'   => t('Column position'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => '.drupalentor-row-container', 
			'style_css' => 'align-items', 
			'responsive' => true,
			'options' => [
				'center' => t('Center'),
				'stretch' => t('Stretch'),
				'flex-start' => t('Top'),
				'flex-end' => t('Bottom'),
			]
		];


		$form['columns_horizontal_align'] = [
			'type'    => 'select',
			'title'   => t('Horizontal Align'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => '.row-wrapper', 
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

		$form['columns_inverted'] = [
			'type'    => 'checkbox',
			'title'   => t('Inverted Columns'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'responsive' => true,
	
		];

		// Section Styles
		$form['section_styles'] = [
			'type' => 'tab',
			'title' => t('Styles')
		];

		$form['bg_color'] = [
			'type'     => 'drupalentor_color',
			'title'    => ('Background Color'),
			'tab'     => 'section_styles',
			'style_type' => 'style',
			'style_css' => 'background-color', 
			'style_selector' => 'widget', 
		];

		$form['bg_image'] = [
			'type'     => 'drupalentor_background_image',
			'title'    => ('Background Image'),
			'tab'     => 'section_styles',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'responsive' => true,
		];
		$form['bg_gradient'] = [
			'type'     => 'drupalentor_background_gradient',
			'title'    => ('Background Gradient'),
			'tab'     => 'section_styles',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'responsive' => true,
		];
		$form['video_background'] = [
			'type'     => 'drupalentor_video_background',
			'title'    => ('Video Background'),
			'tab'     => 'section_styles',
			'append' => 'widget',
		];



		

	return $form;
	}

	public function template( $settings,  $content = '' ) {
		$class = isset($settings['element']['class']['section_container']) ? $settings['element']['class']['section_container'] : '';
	
		?>
		<?php ob_start() ?>



		      	<div class="drupalentor-row-container <?php echo $class; ?>">

							<div class="row row-elements h-100 align-items-center w-100">
								<?php print $content ?>
							</div>

    				</div>


		<?php return ob_get_clean();
	}

	public function render_content($section, $settings = null, $content = null) {
		return $this->wrapper($section, $settings, $this->template($settings, $content));
	}
}