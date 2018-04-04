<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ignition
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<section class="content-no-sidebar">
	<header class="entry-header container">
		<?php
do_action('before_title');
		the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content container">

		<?php

			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ignition' ),
				'after'  => '</div>',
			) );
?>
</section><!-- .entry-content -->
</div>
<?php do_action('ignition_after_content') ?>
	<?php
	if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer container">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'ignition' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif;



	?>
</article><!-- #post-<?php the_ID(); ?> -->
