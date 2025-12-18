<?php
/**
 * Plugin name: My Snow Monkey +
 * Plugin URI: https://github.com/rocket-martue/my-snow-monkey-plus
 * Description: Snow Monkey 用カスタマイズコードを管理するプラグインです。
 * Version: 1.0.3
 * Tested up to: 6.8
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Author: Rocket Martue
 * Author URI: https://profiles.wordpress.org/rocketmartue/
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: my-snow-monkey-plus
 *
 * @package my-snow-monkey+
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Plugin version
 *
 * @var string
 */
define( 'MY_SNOW_MONKEY_VERSION', '1.0.3' );

/**
 * Directory url of this plugin
 *
 * @var string
 */
define( 'MY_SNOW_MONKEY_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );

/**
 * Directory path of this plugin
 *
 * @var string
 */
define( 'MY_SNOW_MONKEY_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

// Require main class
require_once MY_SNOW_MONKEY_PATH . '/includes/class-my-snow-monkey-plus.php';

/**
 * Auto load helper function (Deprecated: Use My_Snow_Monkey_Plus::auto_load() instead)
 *
 * @param string $directory Directory path to load PHP files from.
 */
function my_snow_monkey_auto_load( $directory ) {
	My_Snow_Monkey_Plus::auto_load( $directory );
}

// Note: Plugin files are now loaded via init hook in the main class
// This prevents translation loading issues in WordPress 6.7.0+
