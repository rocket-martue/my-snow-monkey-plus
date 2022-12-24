<?php
// 実際のページ用の CSS 読み込み
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			'my-snow-monkey',
			MY_SNOW_MONKEY_URL . '/src/css/style.css',
			[
				Framework\Helper::get_main_style_handle(),
				Framework\Helper::get_main_style_handle() . '-snow-monkey-blocks'
			],
			filemtime( MY_SNOW_MONKEY_PATH . '/src/css/style.css' )
		);
	}
);

// エディター用の CSS 読み込み
// クラシックエディターとブロックエディターの両方に CSS が読み込まれます。
// ブロックエディターの場合は自動的に .editor-styles-wrapper でラップされます。
// 依存関係は指定できません。
add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'editor-styles' );
		add_editor_style( '/../../plugins/my-snow-monkey/src/css/style.css' );
	}
);

// ブロックエディター用の CSS 読み込み
// add_editor_style() とは違い、.editor-styles-wrapper ではラップされませんが、依存関係は指定できます。
add_action(
	'enqueue_block_editor_assets',
	function() {
		wp_enqueue_style(
			'my-snow-monkey',
			MY_SNOW_MONKEY_URL . '/src/css/block-editor.css',
			[ Framework\Helper::get_main_style_handle() ],
			filemtime( MY_SNOW_MONKEY_PATH . '/src/css/block-editor.css' )
		);
	}
);

// クラシックエディター用の CSS 読み込み
// add_filter(
// 	'tiny_mce_before_init',
// 	function( $mce_init ) {
// 		if ( ! isset( $mce_init['content_style'] ) ) {
// 			$mce_init['content_style'] = '';
// 		}

// 		$response = file_get_contents( MY_SNOW_MONKEY_PATH . '/src/css/classic-editor.css' );
// 		if ( $response ) {
// 			$response = str_replace( [ "\n", "\r" ], '', $response );
// 			$response = str_replace( '"', '\\"', $response );

// 			$mce_init['content_style'] .= $response;
// 		}

// 		return $mce_init;
// 	}
// );