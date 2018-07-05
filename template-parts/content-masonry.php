<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ignition
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'grid-item col-xl-3 col-lg-4 col-md-6 col-sm-12' ) ); ?>>
	<div class='masonry-inner'>
	<?php ignition_get_masonry_thumbnail( true ); ?>
<div class='masonry-content'>

	<header class="entry-header container">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
		<div class="entry-meta">
			<?php ignition_posted_on(); ?>
		</div><!-- .entry-meta -->
			<?php
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_excerpt(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ignition' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ignition' ),
					'after'  => '</div>',
				)
			);
			?>
	</div><!-- .entry-content -->

	<footer class="entry-footer container">
		<?php ignition_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</div></div></article><!-- #post-<?php the_ID(); ?> -->
