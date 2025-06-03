<?php
/**
 * Snow Monkeyテーマのカラーパレットを追加する
 *
 * @package my-snow-monkey+
 */

/**
 * Snow Monkeyテーマのカラーパレットを追加する
 *
 * @param object $theme_json テーマJSONオブジェクト.
 * @return object 更新されたテーマJSONオブジェクト.
 */
add_filter(
	'wp_theme_json_data_theme',
	function ( $theme_json ) {
		// theme.json の内容を格納.
		$get_data = $theme_json->get_data();

		// 追加するカラーパレットを生成.
		$add_color_palette = array(
			array(
				'slug'  => 'color-01',
				'color' => '#343434',
				'name'  => 'charcoal',
			),
			array(
				'slug'  => 'color-02',
				'color' => '#696969',
				'name'  => 'grey1',
			),
			array(
				'slug'  => 'color-03',
				'color' => '#E3E3DF',
				'name'  => 'grey2',
			),
			array(
				'slug'  => 'color-04',
				'color' => '#8BB8A3',
				'name'  => 'green',
			),
			array(
				'slug'  => 'color-05',
				'color' => '#B05F5F',
				'name'  => 'red',
			),
			array(
				'slug'  => 'color-06',
				'color' => '#D87B7B',
				'name'  => 'red2',
			),
			array(
				'slug'  => 'color-07',
				'color' => '#CFB9B9',
				'name'  => 'pink',
			),
			array(
				'slug'  => 'color-08',
				'color' => '#E3D6D6',
				'name'  => 'pink2',
			),
			array(
				'slug'  => 'color-09',
				'color' => '#BCAB80',
				'name'  => 'yellow',
			),
			array(
				'slug'  => 'color-10',
				'color' => '#E2DEBC',
				'name'  => 'yellow2',
			),
		);

		// カラーパレットをマージして新しいカラーパレットを生成.
		$new_color_palette = array_merge(
			$get_data['settings']['color']['palette']['theme'],
			$add_color_palette
		);

		// 更新データを生成.
		$new_data = array(
			'version'  => 2,
			'settings' => array(
				'color' => array(
					'palette' => $new_color_palette,
				),
			),
		);

		// カラーパレットを更新.
		return $theme_json->update_with( $new_data );
	}
);
