<?php
/**
 * Snow MonkeyテーマのCSSを読み込む
 *
 * @package my-snow-monkey+
 */

/**
 * 実際のページ用の CSS 読み込み
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'my-snow-monkey',
			MY_SNOW_MONKEY_URL . '/assets/css/style.css',
			array(
				Framework\Helper::get_main_style_handle(),
				Framework\Helper::get_main_style_handle() . '-blocks',
				Framework\Helper::get_main_style_handle() . '-block-library',
			),
			filemtime( MY_SNOW_MONKEY_PATH . '/assets/css/style.css' )
		);

		// Google Fonts example (uncomment if needed):
		// wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Alex+Brush&family=Cinzel&display=swap', array(), null );
	}
);

// ブロックエディター用の CSS 読み込み
add_action(
	'enqueue_block_editor_assets',
	function () {
		wp_enqueue_style(
			'my-snow-monkey-editor',
			MY_SNOW_MONKEY_URL . '/assets/css/editor-style.css',
			array(
				Framework\Helper::get_main_style_handle(),
				'wp-edit-blocks',
			),
			filemtime( MY_SNOW_MONKEY_PATH . '/assets/css/editor-style.css' )
		);
	}
);
