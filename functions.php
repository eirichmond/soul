<?php
/**
 * Soul functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package soul
 * @since 1.0.0
 */
/**
 * Enqueue the style.css file.
 * 
 * @since 1.0.0
 */
function soul_styles() {
	wp_enqueue_style(
		'soul-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'soul_styles' );

if ( ! function_exists( 'soul_setup' ) ) {
	function soul_setup() {
		add_theme_support( 'wp-block-styles' );
	}

}
add_action( 'after_setup_theme', 'soul_setup' );



// add_action( 'init', 'themeslug_register_block_styles' );
// function themeslug_register_block_styles() {
//     register_block_style( 'core/image', array(
//         'name'  => 'hand-drawn',
//         'label' => __( 'Hand-Drawn', 'themeslug' )
//     ));
//     register_block_style( 'core/image', array(
//         'name'  => 'other',
//         'label' => __( 'Other', 'themeslug' )
//     ));
// }

add_action( 'init', 'themeslug_enqueue_block_styles' );
function themeslug_enqueue_block_styles() {

	$styled_blocks = array(
		'separator' => array(
			'handle' => 'soul-block-separator',
			'styles' => array(
				array(
					'name' => 'soul-one',
					'label' => __( 'Soul-One', 'soul' )
				),
				array(
					'name' => 'soul-two',
					'label' => __( 'Soul-Two', 'soul' )
				),
				array(
					'name' => 'soul-three',
					'label' => __( 'Soul-Three', 'soul' )
				)
			)
		)
	);

	foreach ( $styled_blocks as $key => $block ) {
		wp_enqueue_block_style( 'core/'.$key, array(
			'handle' => $block['handle'],
			'src'    => get_theme_file_uri( "assets/blocks/core-$key.css" ),
			'path'   => get_theme_file_path( "assets/blocks/core-$key.css" )
		) );

		foreach($styled_blocks[$key]['styles'] as $style) {
			register_block_style( "core/$key", array(
				'name'  => $style['name'],
				'label' => __( $style['label'], 'soul' )
			));
		}
	}
	
    // wp_enqueue_block_style( 'core/image', array(
    //     'handle' => 'themeslug-block-image',
    //     'src'    => get_theme_file_uri( 'assets/blocks/core-image.css' ),
    //     'path'   => get_theme_file_path( 'assets/blocks/core-image.css' )
    // ) );
}
