<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
// プラグインが有効かどうかをチェック
if ( ! is_plugin_active( 'smart-custom-fields/smart-custom-fields.php' ) ) {
	return;
}

/**
 * SP用ヘッダー画像のカスタムフィールドを定義 Smart_Custom_Fields_Setting
 *
 * @param array  $settings  Smart_Custom_Fields_Setting  オブジェクトの配列
 * @param string $type      投稿タイプ or ロール
 * @param int    $id        投稿ID or ユーザーID
 * @param string $meta_type post | user
 * @return array
 */

/*
 * 固定ページ
 */
add_filter(
	'smart-cf-register-fields',
	function ( $settings, $type, $id, $meta_type ) {
		if ( !in_array( $type, array( 'page' ) ) ) {
			return $settings;
		}

		// SCF::add_setting( 'ユニークなID', 'メタボックスのタイトル' );
		$Setting = SCF::add_setting( 'sp_header_img', 'SPアイキャッチの設定' );
		$items = array(
			array(
				'type'        => 'image',
				'name'        => 'sp_img',
				'label'       => 'SPアイキャッチ',
				'size'        => 'medium',
			),
		);
		// $Setting->add_group( 'ユニークなID', 繰り返し可能か, カスタムフィールドの配列 );
		$Setting->add_group( 'g_sp_header_img', false, $items );

		$settings[] = $Setting;
		return $settings;
	},
	10,
	4
);


/*
 * アーカイブページ用の設定
 * Smart Custom Fields で、管理画面メニューを追加
 */
function options_page_setup() {
	/**
	 * @param string $page_title ページのtitle属性値
	 * @param string $menu_title 管理画面のメニューに表示するタイトル
	 * @param string $capability メニューを操作できる権限（maange_options とか）
	 * @param string $menu_slug オプションページのスラッグ。ユニークな値にすること。
	 * @param string|null $icon_url メニューに表示するアイコンの URL
	 * @param int $position メニューの位置
	 */
	SCF::add_options_page( 'SP用アイキャッチ', 'SP用アイキャッチ', 'administrator', 'option_page_sp_header_img', 'dashicons-format-image', $position = '23' );
}
add_action( 'after_setup_theme', 'options_page_setup' );

/**
 * カスタムフィールドを定義
 * @param array  $settings  Smart_Custom_Fields_Setting  オブジェクトの配列
 * @param string $type      投稿タイプ or ロール
 * @param int    $id        投稿ID or ユーザーID
 * @param string $meta_type post | user
 * @return array
 */
add_filter(
	'smart-cf-register-fields',
	function ( $settings, $type, $id, $meta_type ) {
		if ( !in_array( $type, array( 'option_page_sp_header_img' ) ) ) {
			return $settings;
		}

		// SCF::add_setting( 'ユニークなID', 'メタボックスのタイトル' );
		$Setting = SCF::add_setting( 'set_sp_header_img', 'SP用アイキャッチ' );

		$items = array(
			array(
				'type'        => 'image',
				'name'        => 'blog_sp_header_img',
				'label'       => 'ブログ SPアイキャッチ',
				'size'        => 'medium',
			),
			array(
				'type'        => 'image',
				'name'        => 'news_sp_header_img',
				'label'       => 'NEWS SPアイキャッチ',
				'size'        => 'medium',
			),
		);
		// $Setting->add_group( 'ユニークなID', 繰り返し可能か, カスタムフィールドの配列 );
		$Setting->add_group( 'g_sp_header_img', false, $items );

		$settings[] = $Setting;
		return $settings;
	},
	10,
	4
);

add_filter(
	'snow_monkey_template_part_render_template-parts/common/page-header',
	function( $html ) {
		// img タグを picture + source + img に置換
		// 779px以下のときは source で指定した画像を表示する
		$sp_img        = '';
		$sp_img        = SCF::get( 'sp_img' );
		$sp_header_img = '';
		if ( is_page() ) {
			if ( $sp_img !== '' ) {
				return preg_replace(
					'|(<img [^>]+>)|ms',
					'<picture>
						<source srcset="'.wp_get_attachment_url( $sp_img ).'" media="(max-width: 779px)">
						$1
					</picture>',
					$html
				);
			}
		} elseif ( is_home() || is_archive( 'news' ) ) {
			$_post_type = get_post_type();
			switch ( $_post_type ) {
				case 'post':
					$sp_header_img = SCF::get_option_meta( 'option_page_sp_header_img', 'blog_sp_header_img' );
					break;
				case 'news':
					$sp_header_img = SCF::get_option_meta( 'option_page_sp_header_img', 'news_sp_header_img' );
					break;
			}
			if ( $sp_header_img !== '' ) {
				return preg_replace(
					'|(<img [^>]+>)|ms',
					'<picture>
						<source srcset="'.wp_get_attachment_url( $sp_header_img ).'" media="(max-width: 779px)" class="'.$_post_type.'_sp_header_img">
						$1
					</picture>',
					$html
				);
			}
		}
		return $html;
	}
);