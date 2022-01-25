<?php

namespace Drupal\drupalentor;


/**
 * Elementor autoloader.
 *
 * Elementor autoloader handler class is responsible for loading the different
 * classes needed to run the plugin.
 *
 * @since 1.6.0
 */
class Autoloader {

	/**
	 * Classes map.
	 *
	 * Maps Elementor classes to file names.
	 *
	 * @since 1.6.0
	 * @access private
	 * @static
	 *
	 * @var array Classes used by elementor.
	 */
	private static $classes_map;

	/**
	 * Classes aliases.
	 *
	 * Maps Elementor classes to aliases.
	 *
	 * @since 1.6.0
	 * @access private
	 * @static
	 *
	 * @var array Classes aliases.
	 */
	private static $classes_aliases;

	/**
	 * Default path for autoloader.
	 *
	 * @var string
	 */
	private static $default_path;

	/**
	 * Default namespace for autoloader.
	 *
	 * @var string
	 */
	private static $default_namespace;

	/**
	 * Run autoloader.
	 *
	 * Register a function as `__autoload()` implementation.
	 *
	 * @param string $default_path
	 * @param string $default_namespace
	 *
	 * @since 1.6.0
	 * @access public
	 * @static
	 */
	public static function run( $default_path = '', $default_namespace = '' ) {
		if ( '' === $default_path ) {
			$default_path = DRUPALENTOR_PATH;
		}

		if ( '' === $default_namespace ) {
			$default_namespace = __NAMESPACE__;
		}
		$default_namespace = __NAMESPACE__;
		self::$default_path = $default_path;

		// self::$default_namespace = $default_namespace;
		spl_autoload_register( [ __CLASS__, 'autoload' ] );
	}


	public static function get_classes_map() {
		if ( ! self::$classes_map ) {
			self::init_classes_map();
		}

		return self::$classes_map;
	}


	private static function init_classes_map() {
		self::$classes_map = [
			'ModalForm' => 'includes/modal-form.php',
			'Controls_Manager' => 'includes/controls.php',
		];

		$controls_names = Controls_Manager::get_controls_names();
		foreach ( $controls_names as $control_name ) {
			$class_name = 'Control_' . self::normalize_class_name( $control_name, '_' );

			self::$classes_map[ $class_name ] = 'includes/controls/' . str_replace( '_', '-', $control_name ) . '.php';
		}
	}

	private static function normalize_class_name( $string, $delimiter = ' ' ) {
		return ucwords( str_replace( '-', '_', $string ), $delimiter );
	}
	private static function load_class( $relative_class_name ) {

		$classes_map = self::get_classes_map();
		// dump($classes_map);
		if ( isset( $classes_map[ $relative_class_name ] ) ) {
			$filename = self::$default_path . '/' . $classes_map[ $relative_class_name ];
		} else {
			$filename = strtolower(
				preg_replace(
					[ '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
					[ '$1-$2', '-', DIRECTORY_SEPARATOR ],
					$relative_class_name
				)
			);

			$filename = self::$default_path . $filename . '.php';
		}

		if ( is_readable( $filename ) ) {

			require $filename;
		}
	}
	private static function autoload( $Class ) {
		// Cut Root-Namespace

		$final_class_name = $Class;
		$Class = str_replace( __NAMESPACE__.'\\', '', $Class );
		// dump($final_class_name);
		if ( ! class_exists( $final_class_name ) ) {
			self::load_class( $Class );
		}
	}
}
