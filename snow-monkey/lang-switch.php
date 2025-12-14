<?php
/**
 * Polylang の Lang switch を Snow Monkey に表示する
 *
 * @package my-snow-monkey+
 */

add_action(
	'snow_monkey_prepend_contents',
	function () {
		// contact ページでは言語スイッチを表示しない.
		if ( is_page( 'contact' ) ) {
			return;
		}

		if ( function_exists( 'pll_the_languages' ) ) {
			?>
		<div id="lang_switch">
			<ul class="lang_switch">
				<?php
				pll_the_languages(
					array(
						'display_names_as'       => 'slug',
						'hide_if_no_translation' => 1,
						'hide_current'           => 1,
					)
				);
				?>
			</ul>
		</div>
			<?php
		}
	}
);
