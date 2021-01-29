<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>


		<div class="hero"></div>
		<header class="entry-header <?php astra_entry_header_class(); ?>">
			<div class="entry-title-container mb-3">
				<?php if ( 'publication' == get_post_type() ) : ?>
					<h1 class="entry-title" itemprop="headline">Publications</h1>
				<?php endif; ?>
			</div>
		</header>

		<?php astra_archive_header(); ?>

		<?php astra_content_loop(); ?>

		<?php astra_pagination(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
