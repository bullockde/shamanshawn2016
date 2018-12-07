<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area text-center">
	<br><br>
	<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentysixteen' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
	<header class="page-header">
				
			</header><!-- .page-header -->

		<main id="main" class="" role="main">
		
		

		<?php if ( have_posts() ) : ?>

			
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
		
			<div class="error-404 not-found">
				<header class="page-header">
					
				</header><!-- .page-header -->

				<div class="page-content text-center">
					
					
	<?php //get_template_part( 'content', 'random' ); ?>
					<hr><br><br>
				</div><!-- .page-content -->
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>

					<?php get_search_form(); ?>
					
					<br><br><hr>
					<?php echo do_shortcode('[wpmem_form login]');   ?> 
					<br><br>
			
			</div><!-- .error-404 -->
	</div><!-- .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
