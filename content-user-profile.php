<?php
/**
 * The template used for displaying page content
 *
 */
?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

	<?php
		// Page thumbnail and title.
		//twentyfourteen_post_thumbnail();
		//the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
	?>

	<div class="entry-content">
		<?php
			//the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
		?>


<?php

	
	$args = array(
		'posts_per_page'   => -1,
		'author_name'	   => '$post->post_name'
	);

	query_posts( $args );


		if (have_posts()) : while (have_posts()) : the_post(); 

			the_title(); 
			//the_content();

			echo "<hr>";

		endwhile; endif;

		wp_reset_query();
	

?>


	</div><!-- .entry-content -->
</article><!-- #post-## -->