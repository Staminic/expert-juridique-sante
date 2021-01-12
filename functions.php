<?php
/**
 * Expert Juridique Santé Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Expert Juridique Santé
 * @since 0.1
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_EXPERT_JURIDIQUE_SANTE_VERSION', '0.1' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'expert-juridique-sante-theme-css', get_stylesheet_directory_uri() . '/css/main.css', array('astra-theme-css'), CHILD_THEME_EXPERT_JURIDIQUE_SANTE_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

/**
 * Enqueue Google Fonts
 */
function ejs_google_fonts() {
	wp_enqueue_style( 'ejs-google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;700&family=Source+Serif+Pro:ital,wght@0,400;0,700;1,400&display=swap', false ); 
}

add_action( 'wp_enqueue_scripts', 'ejs_google_fonts' );