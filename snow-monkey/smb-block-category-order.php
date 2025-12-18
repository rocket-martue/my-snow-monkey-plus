<?php
/**
 * ブロックインサーターで Snow Monkey Blocks が一番上に表示されるようにする
 *
 * @package my-snow-monkey+
 */

/**
 * ブロックインサーターのブロックカテゴリーの順番を変更する
 *
 * @param array $categories 現在のブロックカテゴリー配列.
 * @return array 更新されたブロックカテゴリー配列.
 */
add_filter(
	'block_categories_all',
	function ( $categories ) {
		$new_category_order = array(
			array(
				'slug'     => 'smb',
				'title'    => __( 'Snow Monkey Blocks', 'snow-monkey-blocks' )
									. ' '
									. __( '[Common]', 'snow-monkey-blocks' ),
				'position' => 0,
			),
			array(
				'slug'     => 'smb-section',
				'title'    => __( 'Snow Monkey Blocks', 'snow-monkey-blocks' )
									. ' '
									. __( '[Sections]', 'snow-monkey-blocks' ),
				'position' => 0,
			),
			array(
				'slug'     => 'smb-layout',
				'title'    => __( 'Snow Monkey Blocks', 'snow-monkey-blocks' )
									. ' '
									. __( '[Layout]', 'snow-monkey-blocks' ),
				'position' => 0,
			),
			array(
				'slug'     => 'text',
				'position' => 1,
			),
			array(
				'slug'     => 'media',
				'position' => 2,
			),
			array(
				'slug'     => 'embed',
				'position' => 3,
			),
			array(
				'slug'     => 'design',
				'position' => 4,
			),
		);

		// スラッグをキーとするブロックカテゴリの連想配列を作成する。
		$current_block_categories = array_column( $categories, 'title', 'slug' );

		// 新しいカテゴリ順序にタイトルが設定されているか確認し、設定されていない場合はデフォルトのタイトルを使用する。
		foreach ( $new_category_order as &$new_category ) {
			$new_category['title'] = $new_category['title'] ?? $current_block_categories[ $new_category['slug'] ] ?? __( 'Untitled', 'your-text-domain' );
		}

		// 新しいカテゴリ順序からスラッグの配列を作成する。
		$new_category_slugs = array_column( $new_category_order, 'slug' );

		// 新しい順序に含まれていない残りのブロックカテゴリをフィルタリングする。
		$remaining_categories = array_filter(
			$categories,
			function ( $category ) use ( $new_category_slugs ) {
				return ! in_array( $category['slug'], $new_category_slugs, true );
			}
		);

		// 新しいカテゴリ順序を、残りのカテゴリと統合する。
		return array_merge( $new_category_order, $remaining_categories );
	},
	10,
	2
);
