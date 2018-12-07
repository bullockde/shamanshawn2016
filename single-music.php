<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?> 

<div id="primary" class="container text-center">
	
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			

		if ( has_post_format( 'video' ) ){
			?> 
			<article>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<?php //twentysixteen_post_thumbnail(); ?>

	<?php if( get_field( 'youtube_id' , $post->ID ) ){ ?>
	
	<div class='clear'></div>

	<div id="post-<?php the_ID(); ?>" class="">
		<div class='col-md-8'>
			<center><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field('youtube_id'); ?>" frameborder="0" allowfullscreen></iframe>
			<br>

<!-- #START -->
			<div class='clear'></div>
<div class='other'>
		
		<div class=''>
	
		<div class='row'>
			
				 <h2>#SSIEntertainment</h2>
		</div>
			
		<div class='col-md-12'>
			<div class='col-md-12'>
				
<!-- #START Playlist-->
			<div class='random'>

				<?php
		wp_reset_postdata();

		//echo "TTYPE-->>" . get_post_type();

		$args = array(  'post_type' => get_post_type() , 'posts_per_page' => 6 , 'orderby' => 'rand' );

		$count = 0;

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		$count++;

		echo '<form name="songs" style="text-align: left;" action="/music/" method="get">';
	?>
	
		<div class='song col-sm-6 col-md-4 text-center'>
			
			
			<a href='<?php echo '/' . $post->post_name; ?>'>
				
				
				<?php
				if(get_field('youtube_id', $post->ID)){
					?>
						<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg' alt='Youtube Image'>
					<?php
					
				}else if( has_post_thumbnail() ) { //the post does not have featured image, use a default image
					$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'medium'  );

					?>
						<img src='<?php echo esc_attr( $thumbnail_src[0] ) ; ?>' alt='Youtube Image img-responsive'>
					<?php
					echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
				}

?>

				<!--	<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg' alt='Youtube Image'>-->
					<br>
					<?php  echo $post->post_title; ?>
			</a>

				<div class='clear'></div>

		</div>

<?php 
		
		if( ($count % 3) == 0 ){  echo "<div class='clear hidden-xs hidden-sm'><br></div>"; }
		if( ($count % 2) == 0 ){  echo "<div class='clear visible-xs visible-sm'><br></div>"; }
		
		endforeach; 
		wp_reset_postdata();
?>
	<div class="clear"></div>
</form>
	
	
			
			</div>
<!-- #END Playlist-->
				

				<br>
			</div>
			
		</div>	
	
		</div><!-- #container-->
	
	</div>


<!-- #FINISH -->
<div class='clear'></div>


		</div>
		<div class='col-md-4 pad0'>
<?php if( is_user_logged_in() ){ ?> 
<button id='addsong'> Add Song </button><br><br>

<div id='addsong' class='' style='display: none;'>
<form id='insert_song' method='post'>
	
		<input type="hidden" name="cur_post_type" value="music">

		<div class='col-md-4'><input type="text" name="song_name" placeholder="Name"></div>
		<div class='col-md-4'>https://www.youtube.com/watch?v=</div>
		<div class='col-md-3'><input type="text" name="youtube_id" placeholder="ID"></div>
		<div class='col-md-1'><input type="submit" value="Add"></div>

		<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		
		<input type='hidden' name='insert_song' value='true'>
	</form>	
	<div class='clear'></div>
	</div>
<?php }?>
		
		<center>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- SSI2018_300_600_sky -->
		<ins class="adsbygoogle"
			 style="display:inline-block;width:300px;height:600px"
			 data-ad-client="ca-pub-9799103274848934"
			 data-ad-slot="9445055504"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</center>
		<div class='text-center'> Advertisement </div>

		</div>
	</div>
		<?php } ?>


	<div class="entry-content">
		<?php

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
</article>

<?php
		}else{
			// Include the single post content template.
			get_template_part( 'template-parts/content', 'single' );
		}
		echo "<div class='clear'></div><br><br>";
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
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


	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>