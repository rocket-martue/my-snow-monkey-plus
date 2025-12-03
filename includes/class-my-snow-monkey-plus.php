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
		add_action( 'init', array( $this, 'load_plugin_files' ), 5 );  // 早めに実行
		add_action( 'init', array( $this, 'load_textdomain' ), 10 );
		add_action( 'init', array( $this, 'check_theme_support' ), 15 ); // 遅めに実行
	}

	/**
	 * Load text domain for translations
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'my-snow-monkey-plus',
			false,
			plugin_basename( MY_SNOW_MONKEY_PATH ) . '/languages'
		);
	}
	/**
	 * Check if Snow Monkey theme is active
	 *
	 * @return bool
	 */
	public function is_snow_monkey_active() {
		$template = get_template();

		// Check if current theme is Snow Monkey
		if ( 'snow-monkey' === $template ) {
			return true;
		}

		// Check theme name (for cases where template directory might be different)
		$current_theme = wp_get_theme();
		$theme_name    = strtolower( $current_theme->get( 'Name' ) );
		if ( false !== strpos( $theme_name, 'snow monkey' ) || false !== strpos( $theme_name, 'snow-monkey' ) ) {
			return true;
		}

		return false;
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
		return $plugin_data['Version'] ?? '1.0.2';
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
	/**
	 * Load plugin files
	 */
	public function load_plugin_files() {
		// Always load functions directory files (Snow Monkey independent)
		$functions_path = MY_SNOW_MONKEY_PATH . '/functions/';
		if ( is_dir( $functions_path ) ) {
			self::auto_load( $functions_path );
		}

		// Load snow-monkey directory files only if Snow Monkey theme is active
		if ( $this->is_snow_monkey_active() ) {
			$snow_monkey_path = MY_SNOW_MONKEY_PATH . '/snow-monkey/';
			if ( is_dir( $snow_monkey_path ) ) {
				self::auto_load( $snow_monkey_path );
			}
		}
	}
}

// Initialize plugin
My_Snow_Monkey_Plus::get_instance();
