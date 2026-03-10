<?php

/**
 * Plugin name: Shortcode Preview Block
 * Author: Ronak Ganatra
 * Description: Normal WordPress gutenberg block do not show How the shortcode will output frontside, so we have created a similar gutenberg block which can preview the shortcode result on editor side.
 * version: 1.0.0
 */

add_action('enqueue_block_editor_assets', 'swp_rnk_add_block_editor_assets');

/**
 * Enqueue block script.
 */
function swp_rnk_add_block_editor_assets()
{
	wp_enqueue_script(
		'swp-rnk-gutenberg-block',
		plugin_dir_url(__FILE__) . 'block.build.js',
		['wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components', 'wp-dom-ready']
	);
	wp_enqueue_style(
		'swp-rnk-gutenberg-block-css',
		plugin_dir_url(__FILE__).'assets/css/block-style.css'
	);
}

add_action('init', 'swp_rnk_init_callback');

/**
 * Runs on the initialization to register block.
 */
function swp_rnk_init_callback()
{

	/**
	 * Register block type
	 */
	register_block_type(
		'shortcode-preview/shortcode-preview',
		[
			'attributes'      => [
				'shortcodeText' => [
					'type'    => 'string',
					'default' => '',
				],
			],
			'editor_style' => 'swp-rnk-gutenberg-block-css',
			'render_callback' => 'swp_rnk_shortcode_preview_callback'
		]
	);
}

function swp_rnk_shortcode_preview_callback($atts)
{
	ob_start();
?>
	<div class="swp-rnk-preview">
		<?php
		echo ! empty( $atts['shortcodeText'] ) ? do_shortcode( $atts['shortcodeText'] ) : '';
		?>
	</div>
<?php
	$html = ob_get_clean();
	return $html;
}
