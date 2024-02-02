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

		$form['vertical_align'] = [
			'type'    => 'select',
			'title'   => t('Vertical Align'),
			'tab' => 'section_content',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_css' => 'align-items', 
			'responsive' => true,
			'options' => [
				'flex-start' => t('Top'),
				'center' => t('Center'),
				'flex-end' => t('Bottom'),
			]
		];

		$form['horizontal_align_structures'] = [
			'type'    => 'select',
			'title'   => t('Horizontal Align'),
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
			$id_column = '';

//            $column_class = implode($array_class, ' ');
            $column_class = implode(' ',$array_class);
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
		return $this->wrapper($element, $this->template($element->settings, $content));
	}
}