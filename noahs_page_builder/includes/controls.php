<?php

namespace Drupal\noahs_page_builder;

use Drupal\noahs_page_builder\Controls_Base;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class Controls_Manager {

	private $register;
	/**
	 * Content tab.
	 */
	const TAB_CONTENT = 'content';

	/**
	 * Style tab.
	 */
	const TAB_STYLE = 'style';

	/**
	 * Advanced tab.
	 */
	const TAB_ADVANCED = 'advanced';

	/**
	 * Responsive tab.
	 */
	const TAB_RESPONSIVE = 'responsive';

	/**
	 * Layout tab.
	 */
	const TAB_LAYOUT = 'layout';

	/**
	 * Settings tab.
	 */
	const TAB_SETTINGS = 'settings';

	/**
	 * Text control.
	 */
	const TEXT = 'text';

	/**
	 * Text control.
	 */
	const INFO = 'info';

	/**
	 * Color control.
	 */
	const NOAHS_COLOR = 'noahs_color';

	/**
	 * Background control.
	 */
	const NOAHS_BACKGROUND_IMAGE = 'noahs_background_image';
	/**
	 * Background control.
	 */
	const NOAHS_BACKGROUND_GRADIENT = 'noahs_background_gradient';
	/**
	 * Background control.
	 */
	const NOAHS_VIDEO_BACKGROUND = 'noahs_video_background';
	/**
	 * Background control.
	 */
	const NOAHS_IMAGE = 'noahs_image';
	/**
	 * MArgin control.
	 */
	const NOAHS_MARGIN = 'noahs_margin';
	/**
	 * Padding control.
	 */
	const NOAHS_PADDING = 'noahs_padding';
	/**
	 * Padding control.
	 */
	const NOAHS_BORDER = 'noahs_border';
	/**
	 * Padding control.
	 */
	const NOAHS_GROUP_RADIO = 'noahs_group_radio';
	/**
	 * Padding control.
	 */
	const NOAHS_GROUP_CHECKBOX = 'noahs_group_checkbox';
	/**
	 * Padding control.
	 */
	const NOAHS_WIDTH = 'noahs_width';
	/**
	 * Padding control.
	 */
	const NOAHS_MULTIPLE_ELEMENTS = 'noahs_multiple_elements';
	/**
	 * Padding control.
	 */
	const NOAHS_COORDINATES = 'noahs_coordinates';
	/**
	 * Padding control.
	 */
	const NOAHS_GALLERY = 'noahs_gallery';
	/**
	 * Padding control.
	 */
	const NOAHS_CAROUSEL = 'noahs_carousel';
	/**
	 * Padding control.
	 */
	const NOAHS_ICON = 'noahs_icon';
	/**
	 * Padding control.
	 */
	const NOAHS_IMAGE_MASK = 'noahs_image_mask';
	/**
	 * Padding control.
	 */
	const HTML = 'html';
	/**
	 * Number control.
	 */
	const NUMBER = 'number';

	/**
	 * Textarea control.
	 */
	const TEXTAREA = 'textarea';

	/**
	 * Select control.
	 */
	const SELECT = 'select';

	/**
	 * Select control.
	 */
	const CHECKBOX = 'checkbox';

	/**
	 * Select control.
	 */
	const RADIO = 'radio';

	/**
	 * Switcher control.
	 */
	const SWITCHER = 'switcher';

	/**
	 * Button control.
	 */
	const BUTTON = 'button';

	/**
	 * Hidden control.
	 */
	const HIDDEN = 'hidden';

	/**
	 * Heading control.
	 */
	const HEADING = 'heading';

	/**
	 * Raw HTML control.
	 */
	const RAW_HTML = 'raw_html';

	/**
	 * Deprecated Notice control.
	 */
	const DEPRECATED_NOTICE = 'deprecated_notice';

	/**
	 * Popover Toggle control.
	 */
	const POPOVER_TOGGLE = 'popover_toggle';

	/**
	 * Section control.
	 */
	const SECTION = 'section';

	/**
	 * Tab control.
	 */
	const TAB = 'tab';

	/**
	 * Tabs control.
	 */
	const TABS = 'tabs';

	/**
	 * Divider control.
	 */
	const NOAHS_DIVIDER = 'noahs_divider';

	/**
	 * Divider control.
	 */
	const GROUP = 'group';



	/**
	 * Media control.
	 */
	const MEDIA = 'media';

	/**
	 * Slider control.
	 */
	const SLIDER = 'slider';

	/**
	 * Dimensions control.
	 */
	const DIMENSIONS = 'dimensions';

	/**
	 * Choose control.
	 */
	const CHOOSE = 'choose';

	/**
	 * WYSIWYG control.
	 */
	const WYSIWYG = 'wysiwyg';

	/**
	 * Code control.
	 */
	const CODE = 'code';

	/**
	 * Font control.
	 */
	const NOAHS_FONT = 'noahs_font';

	/**
	 * Image dimensions control.
	 */
	const IMAGE_DIMENSIONS = 'image_dimensions';

	/**
	 * WordPress widget control.
	 */
	const WP_WIDGET = 'wp_widget';

	/**
	 * URL control.
	 */
	const URL = 'url';

	/**
	 * Repeater control.
	 */
	const REPEATER = 'repeater';

	/**
	 * Icon control.
	 */
	const ICON = 'icon';

	/**
	 * Icons control.
	 */
	const ICONS = 'icons';

	/**
	 * Gallery control.
	 */
	const GALLERY = 'gallery';

	/**
	 * Structure control.
	 */
	const STRUCTURE = 'structure';

	/**
	 * Select2 control.
	 */
	const SELECT2 = 'select2';

	/**
	 * Date/Time control.
	 */
	const DATE = 'date';

	/**
	 * Box shadow control.
	 */
	const BOX_SHADOW = 'box_shadow';

	/**
	 * Text shadow control.
	 */
	const TEXT_SHADOW = 'text_shadow';

	/**
	 * Entrance animation control.
	 */
	const ANIMATION = 'animation';

	/**
	 * Hover animation control.
	 */
	const HOVER_ANIMATION = 'hover_animation';

	/**
	 * Exit animation control.
	 */
	const EXIT_ANIMATION = 'exit_animation';

	/**
	 * Controls.
	 *
	 * Holds the list of all the controls. Default is `null`.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var Base_Control[]
	 */
	private $controls = null;





	public static function get_controls_names() {
		return [
			self::TABS,
			self::TAB,
			self::GROUP,
			self::TEXT,
			self::DATE,
			self::NUMBER,
			self::HTML,
			self::SELECT,
			self::CHECKBOX,
			self::INFO,
			self::RADIO,
			self::TEXTAREA,
			self::NOAHS_BACKGROUND_IMAGE,
			self::NOAHS_BACKGROUND_GRADIENT,
			self::NOAHS_IMAGE,
			self::NOAHS_VIDEO_BACKGROUND,
			self::NOAHS_MARGIN,
			self::NOAHS_PADDING,
			self::NOAHS_GROUP_RADIO,
			self::NOAHS_GROUP_CHECKBOX,
			self::NOAHS_COLOR,
			self::NOAHS_FONT,
			self::NOAHS_WIDTH,
			self::NOAHS_BORDER,
			self::NOAHS_MULTIPLE_ELEMENTS,
			self::NOAHS_COORDINATES,
			self::NOAHS_GALLERY,
			self::NOAHS_CAROUSEL,
			self::NOAHS_ICON,
			self::NOAHS_IMAGE_MASK,
			self::NOAHS_DIVIDER,
		];
	}

	/**
	 * Register controls.
	 *
	 * This method creates a list of all the supported controls by requiring the
	 * control files and initializing each one of them.
	 *
	 * The list of supported controls includes the regular controls and the group
	 * controls.
	 *
	 * External developers can register new controls by hooking to the
	 * `elementor/controls/controls_registered` action.
	 *
	 * @since 3.1.0
	 * @access private
	 */
	private function register_controls() {
		$this->controls = [];
		foreach ( self::get_controls_names() as $control_id ) {
			$control_class_id = str_replace( ' ', '_', ucwords( str_replace( '_', ' ', $control_id ) ) );
	
		}
	}

	public function register( $control_instance, $control_id = null ) {
		// TODO: Uncomment when Pro uses the new hook.

		// TODO: For BC. Remove in the future.
		//if ( $control_id ) {
		//	Plugin::instance()->modules_manager->get_modules( 'dev-tools' )->deprecation->deprecated_argument(
		//		'$control_id', '3.5.0'
		//	);
		//} else {
		//}

		$control_id = $control_instance->get_type();

		$this->controls[ $control_id ] = $control_instance;
	}

	/**
	 * Get controls.
	 *
	 * Retrieve the controls list from the current instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Base_Control[] Controls list.
	 */
	public function get_controls() {

		if ( null === $this->controls ) {
			$this->register_controls();
		}

		return $this->controls;
	}

	/**
	 * Get control.
	 *
	 * Retrieve a specific control from the current controls instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $control_id Control ID.
	 *
	 * @return bool|Base_Control Control instance, or False otherwise.
	 */
	public function get_control( $control_id ) {

		$controls = $this->get_controls();

		return isset( $controls[ $control_id ] ) ? $controls[ $control_id ] : false;
	}

	/**
	 * Get controls data.
	 *
	 * Retrieve all the registered controls and all the data for each control.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array {
	 *    Control data.
	 *
	 *    @type array $name Control data.
	 * }
	 */
	public function get_controls_data() {
		$controls_data = [];

		foreach ( $this->get_controls() as $name => $control ) {
			$controls_data[ $name ] = $control->get_settings();
		}

		return $controls_data;
	}

	/**
	 * Render controls.
	 *
	 * Generate the final HTML for all the registered controls using the element
	 * template.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function render_tabs($tabs, $values, $multiple = null, $delta = null, $parent = null) {
		$html_tabs = '';
		$css = '';

		$control_tabs = new Control_Tabs();
		$default_fields = new Controls_Base;
	 	$tab_titles = [];
		$items = [];


		if(!$multiple){
			$array1 = $default_fields->defaultFields();
			$array1 = $default_fields->groupFields($array1);

			foreach ($array1 as $key => $value) {


				if (array_key_exists($key, $tabs)) {
				
					$tabs[$key]['items'] = array_merge(
						$tabs[$key]['items'],
						array_diff_key($value['items'], $tabs[$key]['items'])
					);
				
				} else {
			
					$tabs[$key] = $value;
				}
			}
		}


		$first = true;

		foreach($tabs as $tab_id => $tab){
			$html_tab = '';
	
			foreach($tab['items'] as $item_id => $item){

	
				
				if(isset($item['type']) && $item['type'] === 'group'){
					$group = new Control_Group();

					$html_group = '';
					foreach ($item['items'] as $group_item_id => $group_item) {

						if($group_item['type'] === 'noahs_multiple_group_fields'){

						}
				
						$group_items = [
							'item' => $group_item,
							'wid' => $values ? $values['wid'] : null,
							'item_id' => $group_item_id,
							'delta' => $delta,
							'parent' => $parent,
						];
						// dump($group_items);
						$html_group .= $this->render_controls($group_items, $values['element'], 'group', $delta);
					}
					$html_tab  .= $group->content_template($html_group, $item_id, $item['title']);
				}else{
					$items[$item_id] = $item;

					$data = [
						'item' => $item,
						'wid' => isset($values['wid']) ? $values['wid'] : null,
						'item_id' => $item_id,
						'delta' => $delta,
						'parent' => $parent,
					];
				
					$values_element = isset($values['element']) ? $values['element'] : [];
					
					$html_tab .= $this->render_controls($data, $values_element, '', $delta);
				}
			}

		

			$tab_titles[$tab_id] = $tab['title'];
			$control_tab = new Control_Tab();

			$html_tabs .= $control_tab->content_template($html_tab,$tab_id, $tab['title'], $delta, $first); // Agregar el HTML del tab al HTML de todos los tabs
			$first = false;
		}

		return ['form' => $control_tabs->content_template($html_tabs, $tab_titles, $delta)];
	}

	public function render_controls($data, $values, $wrapper = null, $delta = null) {
		$html_form_fields = new Controls_Base;

		return $html_form_fields->extractHtml($data, $values, $wrapper, $delta);
	}

	public function getClasses($items, $values, $wid) {
		$class = [];

		foreach($values as $item_id => $element){

			if(!empty($element)){
				if($items[$item_id]['style_selector'] === 'widget'){
					$class['#widget-id-'.$wid ][] = $element;
				}else{
					$class['#widget-id-'.$wid .' '. $items[$item_id]['style_selector']][] =  $element;
				}
			}
		}

		if(!empty($class)){
			return $this->transformArray($class);
		}
	}

	public function getAttributes($items, $values, $wid) {
		$class = [];

		foreach($values as $item_id => $element){
	
			if(!empty($element)){
				
				if($items[$item_id]['style_type'] === 'attribute'){

					if($items[$item_id]['style_selector'] === 'widget'){
						$class['#widget-id-'.$wid ][$items[$item_id]['attribute_type']] = $element;
					}else{
						$class[ '#widget-id-'.$wid .' '. $items[$item_id]['style_selector']][$items[$item_id]['attribute_type']] =  $element;
					}
				}
			}
		}
		return $class;

	}

	public function transformArray($array) {
		$newArray = [];

		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$flattenedValues = [];
	
				foreach ($value as $val) {
					if (is_array($val)) {
						$flattenedValues[] = implode(' ', $val);
					} else {
						$flattenedValues[] = $val;
					}
				}
	
				$newArray[$key] = implode(' ', $flattenedValues);
			} else {
				$newArray[$key] = $value;
			}
		}
	
		return $newArray;
	}
	public function getStyles($items, $value, string $wid) {


		$style = [];
		$css = "";

	
		$querys = Controls_Base::getMediaQuery();
		
		if(!empty($value)){
			foreach($value as $query => $item_value){
		
				if($query === 'desktop'){
					foreach($item_value as $state => $state_value){		
							
						if($state === 'default'){
		
							$css .= $this->generateCSS($state, $state_value, $items, $wid);

						}else{
							$css .= $this->generateCSS($state, $state_value, $items, $wid);
						}
					}
				}
				if($query === 'tablet'){
					$css .= '@media (max-width:959px){';
					foreach($item_value as $state => $state_value){						
						if($state === 'default'){
							$css .= $this->generateCSS($state, $state_value, $items, $wid);
						}else{
							$css .= $this->generateCSS($state, $state_value, $items, $wid);
						}
					}
					$css .= '}';
				}
				if($query === 'mobile'){
					$css .= '@media (max-width:767px){';
					foreach($item_value as $state => $state_value){						
						if($state === 'default'){
							$css .= $this->generateCSS($state, $state_value, $items, $wid);
						}else{
							$css .= $this->generateCSS($state, $state_value, $items, $wid);
						}
					}
					$css .= '}';
				}

			}
		}
		return $css;
		
	}

	public function getBackgroundImage($value){

		$css = "";
		if(isset($value['background_image']['fid'])){
	
			$file = File::load($value['background_image']['fid']);
			$file_uri = $file->getFileUri();
			
			$background_image = ImageStyle::load($value['image_style'])->buildUrl($file_uri);
			$css .= 'background-image:' .'url(' . $background_image . ');';

			$css .= 'background-repeat:' . ($value['background_image']['background_repeat'] ?? 'no-repeat') . ';';
			$css .= 'background-position:' . ($value['background_image']['background_position'] ?? 'center center'). ';';
			$css .= 'background-attachment:' . ($value['background_image']['background_attachment'] ?? 'initial'). ';';
			$css .= 'background-size:' .  ($value['background_image']['background_size'] ?? 'cover'). ';';

		}



		return $css;
	}

	public function getBackgroundGradient($value){

		$css = "";

		if($value['gradient']['type'] === 'horizontal'){
			$css .= 'background:' . 'linear-gradient(to right,  '.(($value['gradient']['start']['color'] ?? 'transparent') ?? 'transparent').' '.$value['gradient']['start']['location'].'%,'.$value['gradient']['end']['color'].' '.$value['gradient']['end']['location'].'%);';
		}
		if($value['gradient']['type'] === 'vertical'){
			$css .= 'background:' . 'linear-gradient(to bottom,  '.($value['gradient']['start']['color'] ?? 'transparent').' '.$value['gradient']['start']['location'].'%,'.$value['gradient']['stendart']['color'].' '.$value['gradient']['end']['location'].'%);';
		}
		if($value['gradient']['type'] === 'diagonal'){

			$css .= 'background:' . 'linear-gradient(135deg,  '.($value['gradient']['start']['color'] ?? 'transparent').' '.$value['gradient']['start']['location'].'%,'.$value['gradient']['end']['color'].' '.$value['gradient']['end']['location'].'%);';

		}
		if($value['gradient']['type'] === 'diagonal-bottom'){
			$css .= 'background:' . 'linear-gradient(45deg,  '.($value['gradient']['start']['color'] ?? 'transparent').' '.$value['gradient']['start']['location'].'%,'.$value['gradient']['end']['color'].' '.$value['gradient']['end']['location'].'%);';
		}
		if($value['gradient']['type'] === 'radial'){
			$css .= 'background:' . 'radial-gradient(ellipse at center,  '.($value['gradient']['start']['color'] ?? 'transparent').' '.$value['gradient']['start']['location'].'%,'.$value['gradient']['end']['color'].' '.$value['gradient']['end']['location'].'%);';
		}

		return $css;
	}

	public function generateCSS($state, $state_value, $items, $wid) {
		$css = '';
	
		$selectors = [];
		$config = \Drupal::config('noahs_page_builder.settings');
		
		foreach ($state_value as $item_id => $element) {
		
			
			if($items[$item_id]['type'] === 'noahs_multiple_elements'){
			
	
				if (!empty($element)) {
					foreach($element as $k => $caca){
						$k_sin_numeros = preg_replace('/_\d+$/', '', $k);
						$numero = null;
						if (preg_match('/_(\d+)$/', $k, $matches)) {
							$numero = $matches[1];
						}
					
						$selector = ($items[$item_id]['fields'][$k_sin_numeros]['style_selector'] === 'widget') ? '#widget-id-' . $wid : '#widget-id-' . $wid .' '.$items[$item_id]['fields'][$k_sin_numeros]['style_selector'];
					
						$selector .= ($state != 'hover') ? '' : ':hover';
						
						if (strpos($selector, '[index]') !== false) {
							$selector = str_replace('[index]', $numero, $selector);
						} 

						$declaration = '';
				
					if ($items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_font' ||
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_margin' ||
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_padding' ||
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_border') {
	
						foreach ($element as $property => $value) {
							$property = str_replace('_', '-', $property);
							if (!empty($value)) {
								$declaration .= $property . ':' . $value . ';';
							}
						}
					}
	
					if ($items[$item_id]['fields'][$k_sin_numeros]['type'] === 'select' ||
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'text' ||
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_color' ||
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_width') {
						$declaration .= $items[$item_id]['fields'][$k_sin_numeros]['style_css'] . ':' . $caca . ';';
					}
	
					if ($items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_background_image') {
					
						$background = $this->getBackgroundImage($element);
						if (!empty($background)) {
							$declaration .= $background;
						}
					}
	
					if ($items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_background_gradient') {
					
						$background = $this->getBackgroundGradient($element);
						if (!empty($background)) {
							$declaration .= $background;
						}
					}
	
					if (!empty($declaration)) {
						$selectors[$selector][] = $declaration;
					}
					}
				}
			}

	
		

			if (!empty($items[$item_id]['style_type']) && $items[$item_id]['style_type'] === 'style') {
			
				$declaration = '';
				$selector = '';
				if($items[$item_id]['type'] === 'noahs_divider'){

			
					$selector = '#widget-id-' . $wid . ' > .before:before';
					if(!empty($element['position'])){
						$selector = '#widget-id-' . $wid . ' > .after:after';
						$declaration = 'transform: rotate(180deg) scaleX(-1);';
						
					}
					if(!empty($element['direction'])){
						$declaration = 'transform: scaleX(-1);';
					}
				
					$declaration .= '--nohas-divider-width: ' . ($element['width'] ?? '100') . '%;';
					$declaration .= '--nohas-divider-height: ' . ($element['height'] ?? '300') . 'px;';
					$declaration .= 'width: var(--nohas-divider-width);';
					$declaration .= 'height: var(--nohas-divider-height);';
					$color = $element['color'] ?? $config->get('principal_color');
					if(!empty($element['type']) && $element['type'] === 'waves'){
						$declaration .= 'background: url(\'data:image/svg+xml;utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="fill: '.rawurlencode($color).'; width: var(--nohas-divider-width)%; height: var(--nohas-divider-height)px;"%3E%3Cpath d="M321.39 56.44c58-10.79 114.16-30.13 172-41.86 82.39-16.72 168.19-17.73 250.45-.39C823.78 31 906.67 72 985.66 92.83c70.05 18.48 146.53 26.09 214.34 3V0H0v27.35a600.21 600.21 0 00321.39 29.09z"%3E%3C/path%3E%3C/svg%3E\')';
					}
					if(!empty($element['type']) && $element['type'] === 'tilt'){
						$declaration .= 'background: url(\'data:image/svg+xml;utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="fill: '.rawurlencode($color).'; width: var(--nohas-divider-width)%; height: var(--nohas-divider-height)px;"%3E%3Cpath d="M1200 120L0 16.48V0h1200v120z"%3E%3C/path%3E%3C/svg%3E\')';
					}
					if(!empty($element['type']) && $element['type'] === 'waves_opaque'){
						$declaration .= 'background: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="fill: '.rawurlencode($color).'; width: 106%; height: 500px;"><path d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z" opacity=".25"/><path d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z" opacity=".5"/><path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z"/></svg>\')';
					}
					if(!empty($element['type']) && $element['type'] === 'triangles'){
						$declaration .= 'background: url(\'data:image/svg+xml;utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="fill: '.rawurlencode($color).'; width: var(--nohas-divider-width)%; height: var(--nohas-divider-height)px;"%3E%3Cpath d="M60 120L0 0h120L60 120zm120 0L120 0h120l-60 120zm120 0L240 0h120l-60 120zm120 0L360 0h120l-60 120zm120 0L480 0h120l-60 120zm120 0L600 0h120l-60 120zm120 0L720 0h120l-60 120zm120 0L840 0h120l-60 120zm120 0L960 0h120l-60 120zm120 0L1080 0h120l-60 120z"%3E%3C/path%3E%3C/svg%3E\')';
					}
		
				}

		
				if (!empty($element) && !empty($items[$item_id]['style_selector'])) {
				
					$selector = ($items[$item_id]['style_selector'] === 'widget')
					 ? '#widget-id-' . $wid 
					 : '#widget-id-' . $wid .' '.$items[$item_id]['style_selector'];
					$selector .= ($state != 'hover') ? '' : ':hover';

					if ($items[$item_id]['type'] === 'noahs_font' ||
						$items[$item_id]['type'] === 'noahs_margin' ||
						$items[$item_id]['type'] === 'noahs_padding' ||
						$items[$item_id]['type'] === 'noahs_border') {
	
						foreach ($element as $property => $value) {
							$property = str_replace('_', '-', $property);
							if (!empty($value)) {
								$declaration .= $property . ':' . $value . ';';
							}
						}
					}

					if ($items[$item_id]['type'] === 'noahs_coordinates'){

						foreach ($items[$item_id]['fields'] as $key => $value) {
							$property = str_replace('_', '-', $key);
							if (!empty($value)) {
								$declaration .= $property . ':' . $element[$key] . ';';
							}
						}
					}
					
					if ($items[$item_id]['type'] === 'select' ||
						$items[$item_id]['type'] === 'text' ||
						$items[$item_id]['type'] === 'noahs_color' ||
						$items[$item_id]['type'] === 'number' ||
						$items[$item_id]['type'] === 'noahs_width') {

						$style_suffix = !empty($items[$item_id]['style_suffix']) ? $items[$item_id]['style_suffix'] : null;

						$declaration .= $items[$item_id]['style_css'] . ':' . $element . $style_suffix .';';
					}

					if ($items[$item_id]['type'] === 'noahs_image_mask') {

						$declaration .= 'mask: url('.$element['mask'].') no-repeat center;';
						$declaration .= '-webkit-mask: url('.$element['mask'].') no-repeat center;';
						$declaration .= 'mask-size: '.($element['mask_size'] ?? '100%'). ';';
						$declaration .= '-webkit-mask-size: '.($element['mask_size'] ?? '100%'). ';';
dump($element);
						// $declaration
						// $style_suffix = !empty($items[$item_id]['style_suffix']) ? $items[$item_id]['style_suffix'] : null;

						// $declaration .= $items[$item_id]['style_css'] . ':' . $element . $style_suffix .';';
					}
	
					if ($items[$item_id]['type'] === 'noahs_background_image') {
					
						$background = $this->getBackgroundImage($element);
						if (!empty($background)) {
							$declaration .= $background;
						}
					}
	
					if ($items[$item_id]['type'] === 'noahs_background_gradient') {
					
						$background = $this->getBackgroundGradient($element);
						if (!empty($background)) {
							$declaration .= $background;
						}
					}

			
				}
				if (!empty($declaration)) {

					$selectors[$selector][] = $declaration;
				}
			}
		}

		// Generate CSS from grouped selectors and declarations
		foreach ($selectors as $selector => $declarations) {
			$css .= $selector . '{' . implode('', $declarations) . '}';
		}
	
		return $css;
	}
	
	

}