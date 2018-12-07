<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?> 

	
<?php get_template_part( 'content', 'complex-ifs' ); ?>




<div id="primary" class="">
	<main id="main" class="container" role="main">	



		<?php


		//$args = array( 'post_type' => 'ssi_clients' , 'posts_per_page' => -1 );
		//$leads = get_posts( $args );
			 

		//print_r($leads);

		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
			}

			// End of the loop.
		endwhile;
		?>
		
		

	</main><!-- .site-main -->
	
	

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->
  
<?php //get_sidebar(); ?>
<?php get_footer(); ?>