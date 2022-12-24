<?php
/**
 * 管理画面のカスタマイズ　
 *
 * @package my-snow-monkey+
 */

/**
　* ダッシュボードメニュー名とアイコンの変更
　*/
function edit_admin_menus() {
	global $menu;
	global $submenu;
	$menu[5][0] = "お知らせ"; //　投稿　→　お知らせ
	$menu[5][6] = "dashicons-megaphone";//"dashicons-edit"; // アイコンの変更
	$submenu['edit.php'][5][0] = 'お知らせの登録'; // 投稿の登録　→　お知らせの登録
}
add_action( 'admin_menu', 'edit_admin_menus' );

/**
 * 管理画面 menu を並べ替え
 */
function custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) return true;

	$menu_order = array(
		'index.php',
		'separator1',
		'edit.php?post_type=page',
		'edit.php',
		'edit.php?post_type=service',
		'edit.php?post_type=works',
		'deli-cart/deli-cart.php',
	);

	return $menu_order;
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');

/**
 * 管理画面に固定ページのスラッグを表示
 */
function add_page_columns_name( $columns ) {
	$columns['slug'] = "スラッグ";
	return $columns;
}
add_filter( 'manage_pages_columns', 'add_page_columns_name' );

function add_page_column( $column_name, $post_id ) {
	if ( $column_name == 'slug' ) {
		$post = get_post( $post_id );
		$slug = $post->post_name;
		echo esc_attr( $slug );
	}
}
add_action( 'manage_pages_custom_column', 'add_page_column', 10, 2 );

/**
 * 固定ページ一覧にIDを表示
 */
add_filter( 'manage_pages_columns', 'posts_columns_id', 5 );
function posts_columns_id( $defaults ) {
	$defaults['wps_post_id'] = __( 'ID' );
	return $defaults;
}
add_action( 'manage_pages_custom_column', 'posts_custom_id_columns', 5, 2 );
function posts_custom_id_columns( $column_name, $id ) {
	if ( $column_name === 'wps_post_id' ) {
		echo $id;
	}
}

/**
 * 管理画面に投稿ページのスラッグを表示
 */
function add_posts_columns_name( $columns ) {
	$columns['slug'] = "スラッグ";
	return $columns;
}
add_filter( 'manage_posts_columns', 'add_posts_columns_name' );

function add_posts_column ( $column_name, $post_id ) {
	if( $column_name == 'slug' ) {
		$post = get_post( $post_id );
		$slug = $post->post_name;
		echo esc_attr( $slug );
	}
}
add_action( 'manage_posts_custom_column', 'add_posts_column', 10, 2 );

// /**
//  * 管理画面に投稿ページの id を表示
//  */
// function add_posts_columns_name( $columns ) {
// 	$columns['wps_post_id'] = __( 'ID' );
// 	return $columns;
// }
// add_filter( 'manage_posts_columns', 'add_posts_columns_name' );

// function add_posts_column ( $column_name, $post_id ) {
// 	if( $column_name == 'wps_post_id' ) {
// 		echo $post_id;
// 	}
// }
// add_action( 'manage_posts_custom_column', 'add_posts_column', 10, 2 );