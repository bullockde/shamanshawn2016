<?php
/**
 * The template for displaying posts in the Video post format
 * Template: twentysixteen
*/
?>

<div id="post-<?php the_ID(); ?>" >

	<div class='container'>

	<header class="text-center">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentysixteen_categorized_blog() ) : ?>
			
		<?php
			endif;

			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentysixteen' ) ); ?></span>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="col-md-8  entry-content">

		
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



			<?php edit_post_link( __( 'Edit', 'twentysixteen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->


			</center>
				
			
		<?php
			


			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentysixteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
			
		
			

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class='col-md-4 pad0'>

		<?php if( is_user_logged_in() ){ ?> 
<button id='addsong'> Add Song </button><br><br>

<div id='addsong' class='' style='display: none;'>
<form id='insert_song' method='post'>
	
		<input type="hidden" name="cur_post_type" value="video">

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
	
</div><!-- #container -->

	
	<?php
		

		 the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</div><!-- #post-## -->