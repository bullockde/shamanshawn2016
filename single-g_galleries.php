<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?> 

<div id="primary" class=" text-center">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

		?> 
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php twentysixteen_excerpt(); ?>

			
			
			<div class='clear'> </div><br><br>
			<div class=' col-md-4'>
			
			
				<?php twentysixteen_post_thumbnail(); ?>
				<br>
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- SSI2018_300_600_sky -->
				<ins class="adsbygoogle"
					 style="display:inline-block;width:300px;height:600px"
					 data-ad-client="ca-pub-9799103274848934"
					 data-ad-slot="9445055504"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
				<br>
		</div>
			<div class="col-md-8">
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
						//get_template_part( 'template-parts/biography' );
					}
				?>
				<div class='clear'></div>
				<hr>
				
					<h3><center> More Galleries </center></h3>
				<hr>
<?php

		$args = array( 'post_type' => 'g_galleries' , 'posts_per_page' => 6, 'orderby' => 'rand' );
		$leads = get_posts( $args );

		//print_r($leads);
		$count = 0;

		foreach( $leads as $lead ){
						
			$thumb_id = get_post_thumbnail_id( $lead->ID );
			$thumb_url_array = wp_get_attachment_image_src(  $thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];


			
				$count++;
			?>

<!--  ###################################  -->
		  <div class='col-md-4'>
			<a href='<?php echo $lead->guid; ?>'> <?php echo $lead->post_title;   ?> <br>
			<img src='<?php echo $thumb_url; ?>' class='img-responsive aligncenter ' width='250'>
			</a>
		 
				<p style="text-align: center;"><a class="btn btn-success btn-md" href="<?php 
				
					echo $lead->guid;
			
				
			 ?>">View Gallery</a></p><br>

				
<div class='clear'></div><br>
				
			</div>
<!--  ###################################  --> <!--  #Gallery col-md-4  -->



		<?php
			
		
			if( ($count % 3) == 0 ){  echo "<div class='clear'><hr></div><br>"; }

			}
	
	?>

<div class='clear'></div><br>
				
				
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php twentysixteen_entry_meta(); ?>
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

		
		
		
		<?php
			// Include the single post content template.
			//get_template_part( 'template-parts/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentysixteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'twentysixteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentysixteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'twentysixteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	

</div><!-- .content-area -->


<?php get_footer(); ?>
