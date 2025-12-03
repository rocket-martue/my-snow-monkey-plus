<?php
/**
 * カスタムカラーパレットの設定
 *
 * @package my-snow-monkey+
 */

/**
 * Snow Monkeyテーマのカラーパレットにカスタムカラーを追加する
 * Core のデフォルトカラーパレットを非表示にする
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
				'color' => '#f3f3ec',
				'name'  => 'background',
			),
			array(
				'slug'  => 'color-02',
				'color' => '#2073e5',
				'name'  => 'primary',
			),
			array(
				'slug'  => 'color-03',
				'color' => '#ce3c1b',
				'name'  => 'accent',
			),
			array(
				'slug'  => 'color-04',
				'color' => '#e7ddae',
				'name'  => 'sand',
			),
			array(
				'slug'  => 'color-05',
				'color' => '#303228',
				'name'  => 'text-body',
			),
			array(
				'slug'  => 'color-06',
				'color' => '#6b6f5d',
				'name'  => 'gray',
			),
			array(
				'slug'  => 'color-07',
				'color' => '#265f93',
				'name'  => 'dark-blue',
			),
			array(
				'slug'  => 'color-08',
				'color' => '#2c6b22',
				'name'  => 'dark-green',
			),
			array(
				'slug'  => 'color-09',
				'color' => '#286aa8',
				'name'  => 'grade-high',
			),
			array(
				'slug'  => 'color-10',
				'color' => '#c34563',
				'name'  => 'grade-low',
			),
			array(
				'slug'  => 'color-11',
				'color' => '#2f8521',
				'name'  => 'grade-middle',
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
					'palette'        => $new_color_palette,
					'defaultPalette' => false,
				),
			),
		);

		// カラーパレットを更新.
		return $theme_json->update_with( $new_data );
	}
);
