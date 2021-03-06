<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

?>

<?php astra_entry_before(); ?>

<article 
	<?php
		echo astra_attr(
			'article-page',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
		);
		?>
>

	<?php astra_entry_top(); ?>
	
	<!-- <div class="hero" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');"></div> -->

	<div class="hero"></div>
		
	<?php if ( get_the_ID() !== 6331 ) : ?>
		<header class="entry-header <?php astra_entry_header_class(); ?>">
			<div class="entry-title-container">
				<?php if ( $post->post_parent == '5777' ) : // Experts ?>
					<h2 class="entry-title h1" itemprop="headline">Nos experts</h2>
				<?php elseif ( get_the_ID() === 6330 ) : // Login page ?>
					<h2 class="entry-title h1" itemprop="headline">Espace adhérent</h2>
				<?php elseif ( $post->post_parent == '5995' ) : // Sentinelle ?>
					<h2 class="entry-title h1" itemprop="headline">Sentinelle</h2>
				<?php elseif ( $post->post_parent == '12166' ) : // Publications ?>
					<h2 class="entry-title h1" itemprop="headline">Publications</h2>
				<?php else : ?>
					<?php
					astra_the_title(
						'<h1 class="entry-title" ' . astra_attr(
							'article-title-content-page',
							array(
								'class' => '',
							)
						) . '>',
						'</h1>'
					);
					?>
				<?php endif; ?>
			</div>
		</header><!-- .entry-header -->
	<?php endif; ?>


	<div class="entry-content clear" 
		<?php
				echo astra_attr(
					'article-entry-content-page',
					array(
						'class' => '',
					)
				);
				?>
	>

		<?php astra_entry_content_before(); ?>

		<?php the_content(); ?>
		
		<?php astra_entry_content_after(); ?>

		<?php
			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . esc_html( astra_default_strings( 'string-single-page-links-before', false ) ),
					'after'       => '</div>',
					'link_before' => '<span class="page-link">',
					'link_after'  => '</span>',
				)
			);
			?>

	</div><!-- .entry-content .clear -->

	<?php
		astra_edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'astra' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
		?>

	<?php astra_entry_bottom(); ?>

</article><!-- #post-## -->

<?php astra_entry_after(); ?>
