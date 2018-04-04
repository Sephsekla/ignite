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


	<div class="entry-content container">
		<div class="row d-flex align-items-stretch">
			<div class="col-md-8 content-with-sidebar">
				<header class="entry-header">
					<?php
do_action('before_title');

					 the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
		<?php

			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ignition' ),
				'after'  => '</div>',
			) );
?>
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
</div><div class="col-md-4 sidebar-container">
		<?php

			get_sidebar();
		?>
	</div>
	</div>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
