<?php

namespace Drupal\drupalentor;

use Drupal\drupalentor\Controls_Base;
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
	 * Text control.
	 */
	const UPLOAD = 'upload';

	/**
	 * Color control.
	 */
	const DRUPALENTOR_COLOR = 'drupalentor_color';

	/**
	 * Background control.
	 */
	const DRUPALENTOR_BACKGROUND_IMAGE = 'drupalentor_background_image';
	/**
	 * Background control.
	 */
	const DRUPALENTOR_BACKGROUND_GRADIENT = 'drupalentor_background_gradient';
	/**
	 * Background control.
	 */
	const DRUPALENTOR_VIDEO_BACKGROUND = 'drupalentor_video_background';
	/**
	 * Background control.
	 */
	const DRUPALENTOR_IMAGE = 'drupalentor_image';
	/**
	 * MArgin control.
	 */
	const DRUPALENTOR_MARGIN = 'drupalentor_margin';
	/**
	 * Padding control.
	 */
	const DRUPALENTOR_PADDING = 'drupalentor_padding';
	/**
	 * Padding control.
	 */
	const DRUPALENTOR_BORDER = 'drupalentor_border';
	/**
	 * Padding control.
	 */
	const DRUPALENTOR_GROUP_RADIO = 'drupalentor_group_radio';
	/**
	 * Padding control.
	 */
	const DRUPALENTOR_GROUP_CHECKBOX = 'drupalentor_group_checkbox';
	/**
	 * Padding control.
	 */
	const DRUPALENTOR_WIDTH = 'drupalentor_width';
	/**
	 * Padding control.
	 */
	const DRUPALENTOR_MULTIPLE_FIELDS = 'drupalentor_multiple_fields';
	/**
	 * Padding control.
	 */
	const DRUPALENTOR_GALLERY = 'drupalentor_gallery';
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
	const DIVIDER = 'divider';

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
	const DRUPALENTOR_FONT = 'drupalentor_font';

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
	const DATE_TIME = 'date_time';

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
			self::HTML,
			self::SELECT,
			self::CHECKBOX,
			self::INFO,
			self::UPLOAD,
			self::TEXTAREA,
			self::DRUPALENTOR_BACKGROUND_IMAGE,
			self::DRUPALENTOR_BACKGROUND_GRADIENT,
			self::DRUPALENTOR_IMAGE,
			self::DRUPALENTOR_VIDEO_BACKGROUND,
			self::DRUPALENTOR_MARGIN,
			self::DRUPALENTOR_PADDING,
			self::DRUPALENTOR_GROUP_RADIO,
			self::DRUPALENTOR_GROUP_CHECKBOX,
			self::DRUPALENTOR_COLOR,
			self::DRUPALENTOR_FONT,
			self::DRUPALENTOR_WIDTH,
			self::DRUPALENTOR_BORDER,
			self::DRUPALENTOR_MULTIPLE_FIELDS,
			self::DRUPALENTOR_GALLERY,
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
	public function render_tabs($tabs, $values) {
		$html_tabs = '';
		$css = '';

		$control_tabs = new Control_Tabs();
		$default_fields = new Controls_Base;
	 	$tab_titles = [];
		$items = [];


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


		foreach($tabs as $tab_id => $tab){
			$html_tab = '';
		
			foreach($tab['items'] as $item_id => $item){
			
				if(isset($item['type']) && $item['type'] === 'group'){
					$group = new Control_Group();

					$html_group = '';
					
					foreach ($item['items'] as $group_item_id => $group_item) {

						$group_items = [
							'item' => $group_item,
							'wid' => $values ? $values['wid'] : null,
							'item_id' => $group_item_id
						];
						$html_group .= $this->render_controls($group_items, $values['element'], 'group');
					}
					
		
					$html_tab  .= $group->content_template($html_group, $item_id, $item['title']);
				}else{
					$items[$item_id] = $item;

					$data = [
						'item' => $item,
						'wid' => $values ? $values['wid'] : null,
						'item_id' => $item_id
					];

					$html_tab .= $this->render_controls($data, $values['element']);
				}
			}

			$tab_titles[$tab_id] = $tab['title'];
			$control_tab = new Control_Tab();
		
			$html_tabs .= $control_tab->content_template($html_tab,$tab_id, $tab['title']); // Agregar el HTML del tab al HTML de todos los tabs
		}

		return ['form' => $control_tabs->content_template($html_tabs, $tab_titles)];
	}

	public function render_controls($data, $values, $wrapper = null) {
		$html_form_fields = new Controls_Base;
		return $html_form_fields->extractHtml($data, $values, $wrapper);
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

		foreach ($state_value as $item_id => $element) {

			if (!empty($items[$item_id]['style_type']) && $items[$item_id]['style_type'] === 'style') {
				if (!empty($element)) {
					$selector = ($items[$item_id]['style_selector'] === 'widget') ? '#widget-id-' . $wid : '#widget-id-' . $wid .' '.$items[$item_id]['style_selector'];
					$selector .= ($state != 'hover') ? '' : ':hover';
	
					$declaration = '';
				
					if ($items[$item_id]['type'] === 'drupalentor_font' ||
						$items[$item_id]['type'] === 'drupalentor_margin' ||
						$items[$item_id]['type'] === 'drupalentor_padding' ||
						$items[$item_id]['type'] === 'drupalentor_border') {
	
						foreach ($element as $property => $value) {
							$property = str_replace('_', '-', $property);
							if (!empty($value)) {
								$declaration .= $property . ':' . $value . ';';
							}
						}
					}
	
					if ($items[$item_id]['type'] === 'select' ||
						$items[$item_id]['type'] === 'text' ||
						$items[$item_id]['type'] === 'drupalentor_color' ||
						$items[$item_id]['type'] === 'drupalentor_width') {
						$declaration .= $items[$item_id]['style_css'] . ':' . $element . ';';
					}
	
					if ($items[$item_id]['type'] === 'drupalentor_background_image') {
					
						$background = $this->getBackgroundImage($element);
						if (!empty($background)) {
							$declaration .= $background;
						}
					}
	
					if ($items[$item_id]['type'] === 'drupalentor_background_gradient') {
					
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
	
		// Generate CSS from grouped selectors and declarations
		foreach ($selectors as $selector => $declarations) {
			$css .= $selector . '{' . implode('', $declarations) . '}';
		}
	
		return $css;
	}
	
	

}