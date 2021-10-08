<?php
namespace Aelia\WC\EU_VAT_Assistant\Traits;
if(!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
* Implements common functions to make it easier to access the logger
* used by the plugin.
*
* @since 1.15.0.201125
*/
trait Logger_Trait {
  /**
	 * The logger used by the class.
	 *
	 * @var Aelia\WC\Logger
	 */
	protected static $_logger;

	/**
	 * Indicates if the debug mode is enabled.
	 *
	 * @var bool
	 */
	protected static $_debug_mode;

	/**
	 * Sets the logger to be used by the instance of the class.
	 *
	 * @param Aelia\WC\Logger $logger
	 */
	protected function set_logger(\Aelia\WC\Logger $logger) {
		self::$_logger = $logger;
 	}

	/**
	 * Returns the logger to be used by the instance of the class.
	 *
	 * @return Aelia\WC\Logger
	 */
	protected static function get_logger() {
		return self::$_logger = self::$_logger ?? \Aelia\WC\EU_VAT_Assistant\WC_Aelia_EU_VAT_Assistant::instance()->get_logger();
	}

	/**
	 * Returns the logger to be used by the instance of the class.
	 *
	 * @return Aelia\WC\Logger
	 */
	protected static function debug_mode() {
		return self::$_debug_mode = self::$_debug_mode ?? \Aelia\WC\EU_VAT_Assistant\WC_Aelia_EU_VAT_Assistant::instance()->debug_mode();
	}
}
