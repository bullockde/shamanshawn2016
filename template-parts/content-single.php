<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 global $post;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header text-center">
		<?php the_title( '<h1 class="entry-title ">', '</h1>' ); ?>
	

	<?php twentysixteen_excerpt(); ?>
	
	 <a target='_blank' href='<?php echo $lead->guid; ?>'>
					<?php
						if(get_field('youtube_id', $post->ID)){
					?>
								<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg' alt='Youtube Image'  class='circle'>
							<?php
							
						}else if( has_post_thumbnail( $post->ID ) ) { //the post does not have featured image, use a default image
							$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );

							?>
								<img src='<?php echo esc_attr( $thumbnail_src[0] ) ; ?>' alt='Youtube Image'  class='circle1'>
							<?php
							echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
						}
						//echo get_the_post_thumbnail(  $post->ID , 'thumbnail' );
						

					?>
					</a>
<center>
	<?php 

		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
		$thumb_url = $thumb_url_array[0];

			
		
		
		 if( is_page( array('resume', 'contact', 'gallery', 'subscribe') ) ){

		 }else if ( (get_post_type( $post ) == 'ssi_gallery') && (is_user_logged_in()) ){


		} else if ( $thumb_url == 'http://shamanshawn.com/wp-content/uploads/Home2016-featured.png' ){


		}else if( get_field( "display_image", $post->ID ) == "No" ){   
		
				//Nothing
		}else{ 

			echo get_the_post_thumbnail('medium'); 

		}
	
	 ?>
	 
	 
	
</center>
	</header><!-- .entry-header -->
	<?php

			if( get_field( 'youtube_id' , $post->ID ) ){
		?>
	<div class="container">
		<div class='col-md-8'>
			<center><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field('youtube_id'); ?>" frameborder="0" allowfullscreen></iframe>
			<br>
		</div>
		<div class='col-md-4 pad0'>

		
		<center>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- ShamanShawn_video_sidebar_300_600 -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:300px;height:600px"
		     data-ad-client="ca-pub-3813829909026031"
		     data-ad-slot="7427730986"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</center>
		<div class='text-center'> Advertisement </div>

		</div>
	</div>
		<?php } ?>


	<div class="">
		<?php
			the_content();
			
			
			twentysixteen_entry_meta();
			 
			
				// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

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

	<footer class="entry-footer">
		
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->