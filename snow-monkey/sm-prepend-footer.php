<?php
/**
 * Snow Monkeyテーマのフッターをカスタマイズする
 *
 * @package my-snow-monkey+
 */

/**
 * Reusable Blocks User Interface を使用して作成したフッターのパターンを表示する
 * https://ja.wordpress.org/plugins/reusable-blocks-user-interface/
 */
add_action(
	'snow_monkey_prepend_footer',
	function () {
			echo do_shortcode( '[rbui slug=footer]' );
	},
	10
);
