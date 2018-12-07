<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 global $post;

?>

<?php 
	if( is_page( array('about', 'services',  'coaching', 'entertainment') ) || $post->post_parent == '8383' ){ }else{


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
	<header class="entry-header">
		<center>	
		
		<?php 
		
			if( get_field( "display_title", $post->ID ) == "No" ){   
		
					//Nothing
			}else{ 

				the_title( '<h1 class="entry-title text-center">', '</h1>' ); 

			}
		
		 ?>
	
		<?php 

		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
		$thumb_url = $thumb_url_array[0];

			
		
		
		 if( is_page( array('resume', 'contact', 'gallery', 'subscribe') ) ){

		 }else if ( (get_post_type( $post ) == 'ssi_gallery') && (is_user_logged_in()) ){


		} else if ( $thumb_url == 'http://shamanshawn.com/wp-content/uploads/Home2016-featured.png' ){


		}else if( get_field( "display_image", $post->ID ) == "No" ){   
		
				//Nothing
		}else{ 

			the_post_thumbnail('medium' ); 

		}
	
	 ?>
		</center>	
	</header><!-- .entry-header -->

	
<div class='clear'> </div><br>
	<div class="">
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
		
		
		
		if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		
		?>
	</div><!-- .entry-content -->

	<?php
	
		// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
			}
	
	
	
	
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
	}
?>