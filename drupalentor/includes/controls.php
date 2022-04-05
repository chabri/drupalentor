<?php

namespace Drupal\drupalentor;



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
	const COLOR = 'color';
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
	const FONT = 'font';

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




	/**
	 * Tabs.
	 *
	 * Holds the list of all the tabs.
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var array
	 */
	private static $tabs;

	/**
	 * Init tabs.
	 *
	 * Initialize control tabs.
	 *
	 * @since 1.6.0
	 * @access private
	 * @static
	 */
	private static function init_tabs() {
		self::$tabs = [
			self::TAB_CONTENT => esc_html__( 'Content', 'elementor' ),
			self::TAB_STYLE => esc_html__( 'Style', 'elementor' ),
			self::TAB_ADVANCED => esc_html__( 'Advanced', 'elementor' ),
			self::TAB_RESPONSIVE => esc_html__( 'Responsive', 'elementor' ),
			self::TAB_LAYOUT => esc_html__( 'Layout', 'elementor' ),
			self::TAB_SETTINGS => esc_html__( 'Settings', 'elementor' ),
		];
	}

	/**
	 * Get tabs.
	 *
	 * Retrieve the tabs of the current control.
	 *
	 * @since 1.6.0
	 * @access public
	 * @static
	 *
	 * @return array Control tabs.
	 */
	public static function get_tabs() {
		if ( ! self::$tabs ) {
			self::init_tabs();
		}

		return self::$tabs;
	}

	/**
	 * Add tab.
	 *
	 * This method adds a new tab to the current control.
	 *
	 * @since 1.6.0
	 * @access public
	 * @static
	 *
	 * @param string $tab_name  Tab name.
	 * @param string $tab_label Tab label.
	 */
	public static function add_tab( $tab_name, $tab_label = '' ) {
		if ( ! self::$tabs ) {
			self::init_tabs();
		}

		if ( isset( self::$tabs[ $tab_name ] ) ) {
			return;
		}

		self::$tabs[ $tab_name ] = $tab_label;
	}

	public static function get_controls_names() {
		return [
			self::TEXT,
			self::SELECT,
			self::INFO,
			self::UPLOAD,
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
	public function render_controls($fields, $values, $type, $key) {
		$control_id = $fields['type'];
		$control_class_id = str_replace( ' ', '_', ucwords( str_replace( '_', ' ', $control_id ) ) );
		$class_name = __NAMESPACE__ . '\Control_' . $control_class_id;
		$fieldId = $fields['id'];
	
		// dump($values);

		// $fieldValues = ($fields['id'] == $values[$fieldId]) ? $values[$fieldId] : '';
		$value = "";
		if(!empty($values[$fieldId])){
			$value = $values[$fieldId];
		}

		$culo = new $class_name();
		// dump($culo);
		$culo = $culo->content_template($fields, $value, $type, $key);
	// 	foreach ( $this->get_controls() as $control ) {
	// 		$control->content_template();
	// 	}
	}


}