<?php
/**
 * Plugin name: My Snow Monkey +
 * Description: Snow Monkey 用カスタマイズコードを管理するプラグインです。
 * Version: 1.0.0
 *
 * Author: Rocket Martue
 * Author URI: https://profiles.wordpress.org/rocketmartue/
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: my-snow-monkey-plus
 *
 * @package my-snow-monkey+
 */

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
 * Custom Functions
 * functions ディレクトリの中にある php file を読み込みます。
 * その際、ファイル名がアンダースコアで始まるもの（例：_example.php）は、読み込みません。
 * Snow Monkey に依存しないコードは、こちらのディレクトリに配置します。
 */
$dir = MY_SNOW_MONKEY_PATH .'/functions/';
if ( ! file_exists( $dir) ) {
	return;
} else {
	opendir( $dir );
	while( ( $file = readdir() ) !== false ) {
		if( ! is_dir( $file ) && ( strtolower( substr( $file, -4 ) ) == ".php" ) && ( substr( $file, 0, 1 ) != "_" ) ) {
			$load_file = $dir.$file;
			require_once( $load_file );
		}
	}
	closedir();
}

/**
 * Snow Monkey 以外のテーマを利用している場合は有効化してもカスタマイズが反映されないようにする
 */
$theme = wp_get_theme( get_template() );
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	return;
}

/**
 * Custom Functions
 * inc ディレクトリの中にある php file を読み込みます。
 * その際、ファイル名がアンダースコアで始まるもの（例：_example.php）は、読み込みません。
 * Snow Monkey に依存するコードは、こちらのディレクトリに配置します。
 */
$dir = MY_SNOW_MONKEY_PATH .'/inc/';
if ( ! file_exists( $dir) ) {
	return;
} else {
	opendir( $dir );
	while( ( $file = readdir() ) !== false ) {
		if( ! is_dir( $file ) && ( strtolower( substr( $file, -4 ) ) == ".php" ) && ( substr( $file, 0, 1 ) != "_" ) ) {
			$load_file = $dir.$file;
			require_once( $load_file );
		}
	}
	closedir();
}
