<?php
/**
 * Plugin name: My Snow Monkey +
 * Plugin URI: https://github.com/rocket-martue/my-snow-monkey-plus
 * Description: Snow Monkey 用カスタマイズコードを管理するプラグインです。
 * Version: 1.0.0
 * Tested up to: 5.8
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

/**
 * Auto load the php file in the functions directory.
 * functions ディレクトリの中にある php file を読み込みます。
 * その際、ファイル名がアンダースコアで始まるもの（例：_example.php）は、読み込みません。
 * Snow Monkey に依存しないコードは、こちらのディレクトリに配置します。
 */

$dir_functions = MY_SNOW_MONKEY_PATH . '/functions/';
if ( ! file_exists( $dir_functions ) ) {
	return;
}

$handle = opendir( $dir_functions );
if ( false !== $handle ) {
	while ( true ) {
		$file = readdir( $handle );
		if ( false === $file ) {
			break;
		}
		if ( ! is_dir( $dir_functions . $file ) && '.php' === strtolower( substr( $file, -4 ) ) && '_' !== substr( $file, 0, 1 ) ) {
			$load_file = $dir_functions . $file;
			require_once( $load_file );
		}
	}
	closedir( $handle );
}

/**
 * Snow Monkey 以外のテーマを利用している場合は有効化してもカスタマイズが反映されないようにする
 */
$theme = wp_get_theme( get_template() );
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	return;
}

/**
 * Auto load the php file in the snow-monkey directory.
 * snow-monkey ディレクトリの中にある php file を読み込みます。
 * その際、ファイル名がアンダースコアで始まるもの（例：_example.php）は、読み込みません。
 * Snow Monkey に依存するコードは、こちらのディレクトリに配置します。
 */
$dir_snow_monkey = MY_SNOW_MONKEY_PATH . '/snow-monkey/';
if ( ! file_exists( $dir_snow_monkey ) ) {
	return;
}

$handle = opendir( $dir_snow_monkey );
if ( false !== $handle ) {
	while ( true ) {
		$file = readdir( $handle );
		if ( false === $file ) {
			break;
		}
		if ( ! is_dir( $dir_snow_monkey . $file ) && '.php' === strtolower( substr( $file, -4 ) ) && '_' !== substr( $file, 0, 1 ) ) {
			$load_file = $dir_snow_monkey . $file;
			require_once( $load_file );
		}
	}
	closedir( $handle );
}
