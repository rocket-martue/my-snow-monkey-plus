<?php
/**
 * Custom Logo
 *
 * @package Snow Monkey
 */

/**
 * Custom logo replacement for Snow Monkey theme.
 * ロゴ置換処理
 */
add_filter(
	'snow_monkey_template_part_render_template-parts/header/site-branding',
	function ( $html ) {
		$custom_logo_path = MY_SNOW_MONKEY_PATH . '/src/images/logo-02.png';
		$custom_logo_url  = MY_SNOW_MONKEY_URL . '/src/images/logo-02.png';

		// 画像ファイルが存在するかチェック
		if ( ! file_exists( $custom_logo_path ) ) {
			return $html; // ファイルがなければ元のHTMLをそのまま返す
		}

		// 元の属性を保持しながらsrcだけ置換
		$html = preg_replace_callback(
			'/<img\s+([^>]*?)src=["\']([^"\']*)["\']([^>]*?)>/i',
			function ( $matches ) use ( $custom_logo_url ) {
				$before_src = $matches[1];
				$after_src  = $matches[3];

				// alt属性がない場合は追加
				if ( ! preg_match( '/alt\s*=/i', $before_src . $after_src ) ) {
					$after_src .= ' alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"';
				}

				return '<img ' . $before_src . 'src="' . esc_url( $custom_logo_url ) . '"' . $after_src . '>';
			},
			$html
		);

		return $html;
	},
	10,
	1
);
