<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 * @param string $block_name,
 * @param array  $style_properties
 *
 * @package my-snow-monkey+
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
 * Register block styles.
 */
	add_action(
		'init',
		function () {
			// 登録するブロックスタイルの定義
			$block_styles = array(
				array(
					'blocks' => array( 'core/heading', 'core/paragraph' ),
					'styles' => array(
						array(
							'name'  => 'pattern_1',
							'label' => 'パターン 1',
						),
						array(
							'name'  => 'pattern_2',
							'label' => 'パターン 2',
						),
						array(
							'name'  => 'pattern_3',
							'label' => 'パターン 3',
						),
					),
				),
			);

			// ブロックスタイルを一括登録
			foreach ( $block_styles as $block_style ) {
				foreach ( $block_style['styles'] as $style ) {
					register_block_style( $block_style['blocks'], $style );
				}
			}
		}
	);
}
