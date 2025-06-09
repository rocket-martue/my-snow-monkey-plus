<?php
/**
 * My Snow Monkey Plus Main Class
 *
 * @package my-snow-monkey+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main plugin class
 */
class My_Snow_Monkey_Plus {

	/**
	 * Instance of this class
	 *
	 * @var My_Snow_Monkey_Plus
	 */
	private static $instance = null;

	/**
	 * Get instance
	 *
	 * @return My_Snow_Monkey_Plus
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->init();
	}

	/**
	 * Initialize plugin
	 */
	private function init() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'init', array( $this, 'check_theme_support' ) );
	}

	/**
	 * Load text domain for translations
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'my-snow-monkey-plus',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
		);
	}

	/**
	 * Check if Snow Monkey theme is active
	 *
	 * @return bool
	 */
	public function is_snow_monkey_active() {
		$theme = wp_get_theme( get_template() );
		return in_array( $theme->template, array( 'snow-monkey', 'snow-monkey/resources' ), true );
	}

	/**
	 * Check theme support and show admin notice if needed
	 */
	public function check_theme_support() {
		if ( ! $this->is_snow_monkey_active() ) {
			add_action( 'admin_notices', array( $this, 'theme_not_supported_notice' ) );
		}
	}

	/**
	 * Show admin notice when theme is not supported
	 */
	public function theme_not_supported_notice() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php esc_html_e( 'My Snow Monkey+ プラグインは Snow Monkey テーマでのみ動作します。', 'my-snow-monkey-plus' ); ?>
			</p>
		</div>
		<?php
	}
	/**
	 * Get plugin version
	 *
	 * @return string
	 */
	public function get_version() {
		// 定数が定義されている場合はそれを使用
		if ( defined( 'MY_SNOW_MONKEY_VERSION' ) ) {
			return MY_SNOW_MONKEY_VERSION;
		}

		// get_plugin_data() が利用可能な場合のみ使用
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$plugin_data = get_plugin_data( MY_SNOW_MONKEY_PATH . '/my-snow-monkey-plus.php' );
		return $plugin_data['Version'] ?? '1.0.1';
	}
	/**
	 * Auto load PHP files from directory
	 *
	 * @param string $directory Directory path to load PHP files from.
	 */
	public static function auto_load( $directory ) {
		if ( ! is_dir( $directory ) ) {
			return;
		}

		$php_files = glob( $directory . '*.php' );
		foreach ( $php_files as $file ) {
			$filename = basename( $file );
			// Skip files that start with hyphen
			if ( '-' === substr( $filename, 0, 1 ) ) {
				continue;
			}
			require_once $file;
		}
	}
}

// Initialize plugin
My_Snow_Monkey_Plus::get_instance();
