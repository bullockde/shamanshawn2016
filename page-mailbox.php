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


<div id="primary" class="">
	<main id="main" class="container" role="main">	
	
		<?php 
		
			if( get_field( "display_title", $post->ID ) == "No" ){   
		
					//Nothing
			}else{ 

				the_title( '<h1 class="entry-title text-center">', '</h1>' ); 

			}
		
		 ?>
		
	

		<?php


		//$args = array( 'post_type' => 'ssi_clients' , 'posts_per_page' => -1 );
		//$leads = get_posts( $args );
			 

		//print_r($leads);

		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
	<header class="entry-header">
		
		<?php 

		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
		$thumb_url = $thumb_url_array[0];

			
		
		
		 if( is_page( array('resume', 'contact', 'gallery', 'subscribe') ) ){

		 }else if ( (get_post_type( $post ) == 'ssi_gallery') && (is_user_logged_in()) ){


		} else if ( $thumb_url == 'http://shamanshawn.com/wp-content/uploads/Home2016-featured.png' ){


		}else if( get_field( "display_image", $post->ID ) == "No" ){   
		
				//Nothing
		}else{ 

			twentysixteen_post_thumbnail(); 

		}
	
	 ?>
		
	</header><!-- .entry-header -->

	
<div class='clear'> </div><br><br>
	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
	?>

</article><!-- #post-## -->
			
			<?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
			}

			// End of the loop.
		endwhile;
		?>
		
		

	</main><!-- .site-main -->
	
		<div class='clearfix'></div><hr>
		<?php get_template_part( 'content', 'member-area' ); ?>

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>