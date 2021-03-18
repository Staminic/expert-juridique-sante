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

// Add widgets to astra_masthead_content()
// add_action( 'astra_masthead_content', 'add_widgets_to_header' );
// function add_widgets_to_header() {
//   if ( is_active_sidebar( 'header-widget' ) ) {
// 		dynamic_sidebar( 'header-widget' );
// 		echo '<pre>test</pre>';
// 	}
// }

// Astra markup overrides

/**
 * Function to get site title/logo
 */
if ( ! function_exists( 'astra_site_branding_markup' ) ) {
	/**
	 * Site Title / Logo
	 *
	 * @since 1.0.0
	 */
	function astra_site_branding_markup() {
		?>

		<div class="site-branding-wrapper">
			<div class="site-branding">
				<div
				<?php
					echo astra_attr(
						'site-identity',
						array(
							'class' => 'ast-site-identity',
						)
					);
				?>
				>
					<?php astra_logo(); ?>
				</div>
			</div>

			<?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
				<div class="navbar-utilities">
					<?php dynamic_sidebar( 'header-widget' ); ?>
				</div>
			<?php endif; ?>

		</div>
		<?php
	}
}
add_action( 'astra_masthead_content', 'astra_site_branding_markup', 8 );

/**
 * Remove single post navigation
 */
add_filter( 'astra_single_post_navigation_enabled', '__return_false' );

/**
 * Function to get Read More Link of Post
 *
 * @since 1.0.0
 * @return html
 */
if ( ! function_exists( 'astra_post_link' ) ) {

	/**
	 * Function to get Read More Link of Post
	 *
	 * @param  string $output_filter Filter string.
	 * @return html                Markup.
	 */
	function astra_post_link( $output_filter = '' ) {

		$enabled = apply_filters( 'astra_post_link_enabled', '__return_true' );
		if ( ( is_admin() && ! wp_doing_ajax() ) || ! $enabled ) {
			return $output_filter;
		}

		$read_more_text    = apply_filters( 'astra_post_read_more', __( 'Read More &raquo;', 'astra' ) );
		$read_more_classes = apply_filters( 'astra_post_read_more_class', array() );

		$post_link = sprintf(
			esc_html( '%s' ),
			'<a class="' . esc_attr( implode( ' ', $read_more_classes ) ) . '" href="' . esc_url( get_permalink() ) . '"> ' . the_title( '<span class="screen-reader-text">', '</span>', false ) . ' ' . $read_more_text . '</a>'
		);

		$output = ' &hellip;<p class="read-more"> ' . $post_link . '</p>';

		if ( 'publication' != get_post_type() ) {
			return apply_filters( 'astra_post_link', $output, $output_filter );			
		}	else {
				return;			
		}
	}
}
add_filter( 'excerpt_more', 'astra_post_link', 1 );

/**
 * Archive Page Title
 */
if ( ! function_exists( 'astra_archive_page_info' ) ) {

	/**
	 * Wrapper function for the_title()
	 *
	 * Displays title only if the page title bar is disabled.
	 */
	function astra_archive_page_info() {

		if ( apply_filters( 'astra_the_title_enabled', true ) ) {

			// Author.
			if ( is_author() ) { ?>

				<section class="ast-author-box ast-archive-description">
					<div class="ast-author-bio">
						<?php do_action( 'astra_before_archive_title' ); ?>
						<h1 class='page-title ast-archive-title'><?php echo get_the_author(); ?></h1>
						<?php do_action( 'astra_after_archive_title' ); ?>
						<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
						<?php do_action( 'astra_after_archive_description' ); ?>
					</div>
					<div class="ast-author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'email' ), 120 ); ?>
					</div>
				</section>

				<?php

				// Category.
			} elseif ( is_category() ) {
				?>

				<section class="ast-archive-description">
					<?php do_action( 'astra_before_archive_title' ); ?>
					<h1 class="page-title ast-archive-title"><?php echo single_cat_title(); ?></h1>
					<?php do_action( 'astra_after_archive_title' ); ?>
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
					<?php do_action( 'astra_after_archive_description' ); ?>
				</section>

				<?php

				// Tag.
			} elseif ( is_tag() ) {
				?>

				<section class="ast-archive-description">
					<?php do_action( 'astra_before_archive_title' ); ?>
					<h1 class="page-title ast-archive-title"><?php echo single_tag_title(); ?></h1>
					<?php do_action( 'astra_after_archive_title' ); ?>
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
					<?php do_action( 'astra_after_archive_description' ); ?>
				</section>

				<?php

				// Search.
			} elseif ( is_search() ) {
				?>

				<section class="ast-archive-description">
					<?php do_action( 'astra_before_archive_title' ); ?>
					<?php
						/* translators: 1: search string */
						$title = apply_filters( 'astra_the_search_page_title', sprintf( __( 'Search Results for: %s', 'astra' ), '<span>' . get_search_query() . '</span>' ) );
					?>
					<h1 class="page-title ast-archive-title"> <?php echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </h1>
					<?php do_action( 'astra_after_archive_title' ); ?>
				</section>

				<?php

				// Other.
			} else {
				?>

				<section class="ast-archive-description">
					<?php
					if ( ( is_tax() || is_category() || is_tag() ) ) {
							$trail     = '';
							$home      = '<span class="breadcrumb-item angle-left"><a href="/publications/">Publications</a></span>';
							$query_obj = get_queried_object();
							$term_id   = $query_obj->term_id;
							$taxonomy  = get_taxonomy( $query_obj->taxonomy );
					
							if ( $term_id && $taxonomy ) {
									// Add taxonomy label name to the trail.
									// $trail .=  '/' . $taxonomy->labels->menu_name;
									// Add term parents to the trail.
									$trail .= '<span class="breadcrumb-item angle-left">' . get_term_parents_list( $term_id, $taxonomy->name, array( 'separator' => '', 'inclusive' => false ) ) . '</span>';
							}
					
							// Print trail and add current term name at the end.
							// echo '<p class="breadcrumb-trail">' . $home . $trail . $query_obj->name . '</p>';
							echo '<p class="breadcrumb-trail">' . $home . $trail . '</p>';
					}
					?>

					<?php do_action( 'astra_before_archive_title' ); ?>
					<?php the_archive_title( '<h1 class="page-title ast-archive-title">', '</h1>' ); ?>
					<?php do_action( 'astra_after_archive_title' ); ?>
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
					<?php do_action( 'astra_after_archive_description' ); ?>
				</section>

				<?php
			}
		}
	}

	add_action( 'astra_archive_header', 'astra_archive_page_info' );
}

/**
 * Remove prefix word from Archive title
 */
add_filter( 'get_the_archive_title', 'ejs_archive_title_remove_prefix' );
function ejs_archive_title_remove_prefix( $title ) {
    if ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    
		} elseif ( is_tax() ) {
    	$tax = get_taxonomy( get_queried_object()->taxonomy );
    	$title = single_term_title( '', false );
    
		} elseif ( is_category ()) {
		$title = single_cat_title( '', false);
	}
    return $title;
}