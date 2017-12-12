<?php
/**
 * The template for displaying blog posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ignition
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container">
		<?php

		if ( have_posts() ) :

get_filters('category');

			?>



			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php

if(get_theme_mod('blog-layout')=='masonry'){

?>

<div class="grid masonry row">

<?php
	/* Start the Loop */
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */



get_template_part( 'template-parts/content', 'masonry' );

endwhile;

?> </div> <?php

}

elseif(get_theme_mod('blog-layout')=='equal'){

?>

<div class="grid masonry row match-equal">

<?php
	/* Start the Loop */
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */



get_template_part( 'template-parts/content', 'masonry' );

endwhile;

?> </div> <?php

}

else{

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */



	get_template_part( 'template-parts/content', get_post_format() );

endwhile;

}

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
