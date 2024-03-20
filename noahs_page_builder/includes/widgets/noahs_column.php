<?php

use Drupal\noahs_page_builder\WidgetBase;
use Drupal\image\Entity\ImageStyle;

class element_noahs_column extends WidgetBase{

	public function data(){
		return [
			'icon' => 'icon-column',
			'title' => 'Column',
			'description' => 'Description'
		];
	}

	public function render_form(){
		$form = [];

		// Section Content
		$form['section_content'] = [
			'type' => 'tab',
			'title' =>  t('Content')
		];

		$form['column_width'] =[
			'type'    => 'noahs_width',
			'title'   => ('Colum Width'),
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_css' => 'width', 
			'tab' => 'section_content',
			'responsive' => true,
			'placeholder' => 'use as 10%, 100px, 100vw...',
		];
		$form['innver_column_width'] =[
			'type'    => 'noahs_width',
			'title'   => ('Inner Width'),
			'style_type' => 'style',
			'style_selector' => '.widget-wrapper', 
			'style_css' => 'max-width', 
			'tab' => 'section_content',
			'responsive' => true,
			'placeholder' => 'use as 10%, 100px, 100vw...',
		];
		$form['section_height'] = [
			'type'    => 'select',
			'title'   => t('Column height'),
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
		$form['vertical_align'] = [
			'type'    => 'select',
			'title'   => t('Vertical Align'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_css' => 'align-items', 
			'responsive' => true,
			'options' => [
				'' => t('Center'),
				'flex-start' => t('Top'),
				'flex-end' => t('Bottom'),
			]
		];

		$form['column_elements_inline'] = [
			'type'    => 'select',
			'title'   => t('Elements orientation'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => '.noahs_page_builder-column--content-inner', 
			'style_css' => 'flex-direction',
			'responsive' => true,
			'options' => [
				'' => 'Por defecto (one under the other)',
				'column-reverse' => 'Column Reverse',
				'row' => 'Inline',
				'row-reverse' => 'Inline Reverse',
				'revert' => 'Revert',
				'unset' => 'Unset',
			]
		];
		$form['horizontal_align_structures'] = [
			'type'    => 'select',
			'title'   => t('Distribution'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_css' => 'justify-content',
			'responsive' => true,
			'options' => [
				'' => 'Por defecto',
				'flex-start' => 'Start',
				'center' => 'Center',
				'flex-end' => 'End',
				'space-between' => 'Space Betwenn',
				'space-around' => 'Space Around',
				'space-evenly' => 'Space Evenly'
			]
		];
		$form['horizontal_align'] = [
			'type'    => 'select',
			'title'   => t('Horizontal Align'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_css' => 'text-align',
			'responsive' => true,
			'options' => [
				'' => 'Por defecto',
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			]
		];

		$form['elements_gap'] =[
			'type'    => 'text',
			'title'   => ('Element Space'),
			'style_type' => 'style',
			'style_selector' => '.noahs_page_builder-column--content-inner ', 
			'style_css' => 'gap', 
			'tab' => 'section_content',
			'responsive' => true,
			'placeholder' => 'use as 10%, 100px, 100vw...',
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
			'style_selector' => 'widget', 
		];
		
		$form['bg_image'] = [
			'type'     => 'noahs_background_image',
			'title'    => ('Background Image'),
			'tab'     => 'section_styles',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_hover' => true,
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
		$form['video_background'] = [
			'type'     => 'noahs_video_background',
			'title'    => ('Video Background'),
			'tab'     => 'section_styles',
			'append' => 'widget',
		];
		$form['font'] = [
			'type'        => 'noahs_font',
			'title'       => t('Font'),
			'tab'     => 'section_styles',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'responsive' => true,
		  ];


		return $form;
	}

	public function template( $settings,  $content = '' ) {




			$array_class = array();
			$array_style = array();
			$array_class_inner = array();
			$array_class_inner_inner = array();
//			$column_class_inner = implode($array_class_inner, ' ');
            $column_class_inner = implode(' ',$array_class_inner);
            $array_class_inner_inner = implode(' ',$array_class_inner_inner);

         
		?>
		<?php ob_start() ?>

	      <div class="noahs_page_builder-column--inner <?php print $column_class_inner ?>">
	         <div class="noahs_page_builder-column--content-inner <?php print $array_class_inner_inner ?>">
	           <?php print $content; ?>
	         </div>  
	      </div>

	   <?php return ob_get_clean();
	}
	
	public function render_content($element, $content = null) {
		return $this->wrapper($element, $this->template($element, $content), $element);
	}
}