<?php
/**
 * Plugin name: My Snow Monkey +
 * Plugin URI: https://github.com/rocket-martue/my-snow-monkey-plus
 * Description: Snow Monkey 用カスタマイズコードを管理するプラグインです。
 * Version: 1.0.1
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
define( 'MY_SNOW_MONKEY_VERSION', '1.0.1' );

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

/**
 * Auto load the PHP files.
 * functions ディレクトリの中にある php file を読み込みます。
 * その際、ファイル名がハイフン2つで始まるもの（例：--example.php）は、読み込みません。
 * Snow Monkey に依存しないコードは、こちらのディレクトリに配置します。
 */
My_Snow_Monkey_Plus::auto_load( MY_SNOW_MONKEY_PATH . '/functions/' );

/**
 * Snow Monkey 以外のテーマを利用している場合は有効化してもカスタマイズが反映されないようにする
 */
if ( ! My_Snow_Monkey_Plus::get_instance()->is_snow_monkey_active() ) {
	return;
}

/**
 * Auto load the PHP files.
 * snow-monkey ディレクトリの中にある php file を読み込みます。
 * その際、ファイル名がハイフン2つで始まるもの（例：--example.php）は、読み込みません。
 * Snow Monkey に依存するコードは、こちらのディレクトリに配置します。
 */
My_Snow_Monkey_Plus::auto_load( MY_SNOW_MONKEY_PATH . '/snow-monkey/' );
