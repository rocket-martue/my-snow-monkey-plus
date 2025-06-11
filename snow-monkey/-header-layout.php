<?php
/**
 * ヘッダーのレイアウト変更
 *
 * @param string $setting レイアウトのセッティング
 * sticky : 上部固定
 * sticky-overlay : オーバレイ（上部固定）
 * sticky-overlay-colored : オーバーレイ（上部固定 / スクロール時背景白）
 * overlay : オーバレイ
 * '' : ノーマル.
 *
 * @package my-snow-monkey+
 */

/**
 * フロントページでのヘッダーレイアウト設定
 *
 * @param string $value 現在のヘッダーレイアウト設定値.
 * @return string フロントページの場合は 'sticky-overlay-colored' を、それ以外は元の値を返す.
 */
function set_front_page_header_layout( $value ) {
	if ( is_front_page() ) {
		return 'sticky-overlay-colored';
	}
	return $value;
}

// PCの設定
add_filter( 'theme_mod_header-position-lg', 'set_front_page_header_layout', 10, 1 );

// SPの設定
add_filter( 'theme_mod_header-position', 'set_front_page_header_layout', 10, 1 );
