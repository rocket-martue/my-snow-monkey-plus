<?php
/**
 * グローバルナビのカスタマイズ
 *
 * @package my-snow-monkey+
 */

/**
 * 特定のページで、グローバルナビを別のメニューに入れ替える
 *
 * @param array $args ナビゲーションメニューの引数
 * @return array 更新されたナビゲーションメニューの引数
 */
add_filter(
	'wp_nav_menu_args',
	function ( $args ) {
		if ( is_page( array( 'recruit', 'entry' ) ) ||
			is_singular( array( 'job-posts' ) ) ||
			is_post_type_archive( array( 'job-posts' ) ) ||
			is_tax( get_object_taxonomies( 'job-posts' ) ) ) {
			if ( 'global-nav' === $args['theme_location'] ) {
				$args['menu'] = 'recruit-global-menu';
			}
		}
		return $args;
	}
);
