<?php

namespace Drupal\noahs_page_builder;

use Drupal\noahs_page_builder\Controls_Base;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Render\Markup;
use Drupal\node\Entity\Node;


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
	const NOAHS_BORDER_RADIUS = 'noahs_radius';
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
	const NOHAS_URL = 'noahs_url';

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
	const NOAHS_SHADOWS = 'noahs_shadows';

	/**
	 * Box shadow control.
	 */
	const NOAHS_CUSTOM_CSS = 'noahs_custom_css';

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
			self::HIDDEN,
			self::TEXTAREA,
			self::NOAHS_BACKGROUND_IMAGE,
			self::NOAHS_BACKGROUND_GRADIENT,
			self::NOAHS_IMAGE,
			self::NOAHS_VIDEO_BACKGROUND,
			self::NOAHS_MARGIN,
			self::NOAHS_PADDING,
			self::NOAHS_SHADOWS,
			self::NOAHS_BORDER_RADIUS,
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
			self::NOAHS_CUSTOM_CSS,
			self::NOHAS_URL,
		];
	}

	/**
	 * Register controls.
	 */

	private function register_controls() {
		$this->controls = [];
		foreach ( self::get_controls_names() as $control_id ) {
			$control_class_id = str_replace( ' ', '_', ucwords( str_replace( '_', ' ', $control_id ) ) );
	
		}
	}

	public function register( $control_instance, $control_id = null ) {

		$control_id = $control_instance->get_type();

		$this->controls[ $control_id ] = $control_instance;
	}

	/**
	 * Get controls.
	 */
	public function get_controls() {

		if ( null === $this->controls ) {
			$this->register_controls();
		}

		return $this->controls;
	}

	/**
	 * Get control.
	 */

	public function get_control( $control_id ) {

		$controls = $this->get_controls();

		return isset( $controls[ $control_id ] ) ? $controls[ $control_id ] : false;
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


						$group_items = [
							'item' => $group_item,
							'wid' => $values ? $values['wid'] : null,
							'item_id' => $group_item_id,
							'delta' => $delta,
							'parent' => $parent,
						];
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


	// Get Classes from selector
	public function getClasses($items, $values, $wid) {
		$class = [];

		foreach($values as $item_id => $element){


			if(!empty($element)){
				if(!empty($items[$item_id]['style_selector']) && $items[$item_id]['style_selector'] === 'widget'){
					$class['#widget-id-'.$wid ][] = $element;
				}else if(!empty($items[$item_id]['style_selector'])){
					$class['#widget-id-'.$wid .' '. $items[$item_id]['style_selector']][] =  $element;
				}
			}
		}

		if(!empty($class)){
			return $this->transformArray($class);
		}
	}

	// Get Attributes from selector
	public function getAttributes($items, $values, $wid) {
		$class = [];

		foreach($values as $item_id => $element){
		
			if(isset($element)){
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

	// Transform Array to implode
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

	// getStyles Principal Function
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
	// 	$tokenService = \Drupal::token();
	// 	$route_match = \Drupal::routeMatch();

	// 		$nid = $route_match->getParameter('nid');

	// 	$node = Node::load($nid);

	// 	// Definir el token que deseas renderizar, por ejemplo 'node:id'.
	// 	$token = '[node:title]';
	
	// 	// Renderizar el token utilizando el servicio 'token'.
	// 	$token_service = \Drupal::token();

    //   // Renderizar el token [node:title] utilizando el servicio 'token'.
    //   $rendered_token = $token_service->replace('[node:title]', ['node' => $node]);
	//   dump($rendered_token);
      // Convertir el texto renderizado en Markup para que sea seguro imprimirlo.
  
		// if(isset($value['token'])){
	
		// 	$token_service = \Drupal::token();
		// 	$token = $token_service->replace($value['token']);
		// 	dump(Markup::create($token)->__toString());
		// }
		
		
		if(!empty($value['background_image']['fid'])){
	
			$file = File::load($value['background_image']['fid']);
			if (!empty($file) && $file != NULL && !is_null($file->getFileUri())) {
				$file_uri = $file->getFileUri();
				
				if(!empty($value['image_style'])){
					$background_image = ImageStyle::load($value['image_style'])->buildUrl($file_uri);
				}else{
					$background_image =  \Drupal::service('file_url_generator')->generateAbsoluteString($file_uri);
				}
				
				$css .= 'background-image:' .'url(' . $background_image . ');';

				$css .= 'background-repeat:' . ($value['background_image']['background_repeat'] ?? 'no-repeat') . ';';
				$css .= 'background-position:' . ($value['background_image']['background_position'] ?? 'center center'). ';';
				$css .= 'background-attachment:' . ($value['background_image']['background_attachment'] ?? 'initial'). ';';
				$css .= 'background-size:' .  ($value['background_image']['background_size'] ?? 'cover'). ';';
			}
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

	// Generate stiles from generateCSS first
	public function generateCSS($state, $state_value, $items, $wid) {
		$css = '';

		$selectors = [];
		$config = \Drupal::config('noahs_page_builder.settings');
		
		foreach ($state_value as $item_id => $element) {

			if($items[$item_id]['type'] === 'noahs_multiple_elements'){
			
	
				if (!empty($element)) {
					foreach($element as $k => $style_css){
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
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_radius' ||
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_border') {
						
						foreach ($element as $property => $value) {
							$property = str_replace('_', '-', $property);
							if (!empty($value)) {
								$declaration .= $property . ':' . $value . ';';
							}
						}
				
					}
			
					if ($items[$item_id]['fields'][$k_sin_numeros]['type'] === 'select' ||
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_color' ||
						$items[$item_id]['fields'][$k_sin_numeros]['type'] === 'noahs_width') {

						$declaration .= $items[$item_id]['fields'][$k_sin_numeros]['style_css'] . ':' . $style_css . ';';
					}
					if ($items[$item_id]['fields'][$k_sin_numeros]['type'] === 'text') {
						
						$declaration .= $items[$item_id]['fields'][$k_sin_numeros]['style_css']['text'] . ':' . $style_css . ';';
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
			
				// dump($declaration);
				if (!empty($element) && !empty($items[$item_id]['style_selector'])) {
				
					$selector = ($items[$item_id]['style_selector'] === 'widget')
					 ? '#widget-id-' . $wid 
					 : '#widget-id-' . $wid .' '.$items[$item_id]['style_selector'];

					if ($state === 'hover') {

						$selector_parts = explode(',', $selector); 
						$hover_selector_parts = array_map(function($part) {

							return $part . ':hover';
						}, $selector_parts);

						$selector = implode(', ', $hover_selector_parts);
					}
					if (!empty($items[$item_id]['style_selector_hover'])) {
						$selector = '#widget-id-' . $wid .' '. $items[$item_id]['style_selector_hover'] . ',' . $selector;
					}

					if ($items[$item_id]['type'] === 'noahs_font' ||
						$items[$item_id]['type'] === 'noahs_margin' ||
						$items[$item_id]['type'] === 'noahs_padding' ||
						$items[$item_id]['type'] === 'noahs_radius' ||
						$items[$item_id]['type'] === 'noahs_border') {
							
						foreach ($element as $property => $value) {
							$property = str_replace('_', '-', $property);
							if (!empty($value)) {
								$declaration .= $property . ':' . $value . ';';
							}
						}
					}
					if ($items[$item_id]['type'] === 'noahs_shadows') {

						$shadow_x = isset($element['shadow_x']) && $element['shadow_x'] !== '' ? $element['shadow_x'] : '0';
						$shadow_y = isset($element['shadow_y']) && $element['shadow_y'] !== '' ? $element['shadow_y'] : '0';
						$blur = isset($element['blur']) && $element['blur'] !== '' ? $element['blur'] : '0';
						$spread = isset($element['spread']) && $element['spread'] !== '' ? $element['spread'] : '0';
						$color = isset($element['color']) && $element['color'] !== '' ? $element['color'] : 'black';
						$box_shadow = "{$shadow_x}px {$shadow_y}px {$blur} {$spread} {$color}";

						$declaration .= "box-shadow: {$box_shadow};";
				
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
						$items[$item_id]['type'] === 'noahs_color' ||
						$items[$item_id]['type'] === 'number' ||
						$items[$item_id]['type'] === 'noahs_width') {

						$style_suffix = !empty($items[$item_id]['style_suffix']) ? $items[$item_id]['style_suffix'] : null;

						$declaration .= $items[$item_id]['style_css'] . ':' . $element . $style_suffix .';';
					}
					if ($items[$item_id]['type'] === 'text') {
						$style_suffix = !empty($items[$item_id]['style_suffix']) ? $items[$item_id]['style_suffix'] : null;
		
						$declaration .= $items[$item_id]['style_css'] . ':' . $element['text'] . $style_suffix .';';
					}
					if ($items[$item_id]['type'] === 'noahs_image_mask' && !empty($element['mask'])) {

						$declaration .= 'mask: url('.$element['mask'].') no-repeat center;';
						$declaration .= '-webkit-mask: url('.$element['mask'].') no-repeat center;';
						$declaration .= 'mask-size: '.($element['mask_size'] ?? '100%'). ';';
						$declaration .= '-webkit-mask-size: '.($element['mask_size'] ?? '100%'). ';';
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
					
			
			if($items[$item_id]['type'] === 'noahs_custom_css'){
				$css .= str_replace('selector', '#widget-id-' . $wid, $element);
			}
		}

		// Generate CSS from grouped selectors and declarations
		foreach ($selectors as $selector => $declarations) {
			$css .= $selector . '{' . implode('', $declarations) . '}';
		}
	
		return $css;
	}
	
	

}