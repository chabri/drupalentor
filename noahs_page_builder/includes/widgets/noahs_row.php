<?php


use Drupal\noahs_page_builder\WidgetBase;

class element_noahs_row extends WidgetBase{
	
	public function data(){
		return [
			'icon' => '<svg id="fi_6938167" enable-background="new 0 0 60 60" height="512" viewBox="0 0 60 60" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m6 54h48v-48h-48zm2-10h21v8h-21zm23 8v-8h21v8zm21-44v34h-44v-34z"></path></svg>',
			'title' => 'Section',
			'description' => 'Description',
			'group' => 'noahs_page_builder'
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
			'style_selector' => '.noahs_page_builder-row-container', 
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
			'style_selector' => '.noahs_page_builder-row-container', 
			'style_css' => 'max-width', 
			'state' => [
				'visible' => [
					'section_container' => ['value' => 'container'],
				  ],
			]
		];
		$form['section_grid'] = [
			'type'    => 'select',
			'title'   => t('Grid'),
			'tab' => 'section_content',
			'style_type' => 'class',
			'style_selector' => '.row-elements', 
			'options' => [
				'' => t('default'),
				'row-cols-1 row-cols-md-2' => t('2 Columns'),
				'row-cols-1 row-cols-md-3' => t('3 Columns'),
				'row-cols-1 row-cols-sm-2 row-cols-md-4' => t('4 Columns'),
				'row-cols-1 row-cols-sm-2 row-cols-md-5' => t('5 Columns'),
				'row-cols-1 row-cols-sm-2 row-cols-md-6' => t('6 Columns'),
			]
		];
		$form['section_grid_gapy'] = [
			'type'    => 'text',
			'title'   => t('Grid gap Y'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => '.row-elements', 
			'style_css' => '--bs-gutter-y', 
			'responsive' => true,
			'default_value' => '0px'
		];
		$form['section_grid_gapx'] = [
			'type'    => 'text',
			'title'   => t('Grid gap X'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => '.row-elements', 
			'style_css' => '--bs-gutter-x', 
			'responsive' => true,
			'default_value' => '0px'
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
		$form['column_space'] = [
			'type'    => 'text',
			'title'   => t('Colum space'),
			'tab' => 'section_content',
			'placeholder'     => t('Column Space'),
			'style_type' => 'style',
			'style_selector' => '.row-elements', 
			'style_css' => '--bs-gutter-x', 
		];

		$form['columns_position'] = [
			'type'    => 'select',
			'title'   => t('Column position'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => '.noahs_page_builder-row-wrapper', 
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
			'type'     => 'noahs_color',
			'title'    => ('Background Color'),
			'tab'     => 'section_styles',
			'style_type' => 'style',
			'style_css' => 'background-color', 
			'style_selector' => 'widget', 
		];

		$form['bg_image'] = [
			'type'     => 'noahs_background_image',
			'title'    => ('Background Image'),
			'tab'     => 'section_styles',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'responsive' => true,
		];
		$form['bg_gradient'] = [
			'type'     => 'noahs_background_gradient',
			'title'    => ('Background Gradient'),
			'tab'     => 'section_styles',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'responsive' => true,
		];
		$form['bg_divider'] = [
			'type'     => 'noahs_divider',
			'title'    => ('Divider Gradient'),
			'tab'     => 'section_styles',
			'style_type' => 'style',
		];
		$form['video_background'] = [
			'type'     => 'noahs_video_background',
			'title'    => ('Video Background'),
			'tab'     => 'section_styles',
			'append' => 'widget',
		];



		

	return $form;
	}

	public function template( $settings,  $content = '' ) {

		$class = isset($settings->element->class->section_container) ? $settings->element->class->section_container : 'container';
		// $class = isset($settings->element->class->section_container) ? $settings->element->class->section_container : 'container';
	
		?>
		<?php ob_start() ?>
			<div class="noahs_page_builder-row-wrapper">
				<div class="noahs_page_builder-row-container <?php echo $class; ?>">
					<div class="row row-elements">
						<?php print $content ?>
					</div>
				</div>
			</div>
		<?php return ob_get_clean();
	}

	public function render_content($element, $content = null) {
		
		return $this->wrapper($element, $this->template($element->settings, $content));
	}
}