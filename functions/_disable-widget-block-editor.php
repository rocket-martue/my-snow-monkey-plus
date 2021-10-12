<?php
/**
 * ブロックエディタでのウィジェットの管理を無効化
 *
 * @package my-snow-monkey+
 */

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );
