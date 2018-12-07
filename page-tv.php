<?php get_header(); ?>


<div class='zone'>
	<div class='col-md-8 ad content text-center'>

		<a href='/tv/'><?php twentysixteen_post_thumbnail(); ?></a>
		<?php 
			if ( has_post_thumbnail(  ) ) {
				
				
				
				
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );	
						
   						if ( ! empty( $large_image_url[0] ) ) {
        						echo '<a href="' . esc_url( $large_image_url[0] ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
        						//echo get_the_post_thumbnail( $lead->ID, 'thumbnail' ); 
        						echo '</a>';

   					 	}
			}
		?>

		
		<div class='clear'></div>

		<div class='col-md-3'><a href='/music/' class='btn btn-default btn-block'> Music </a></div>
		<div class='col-md-3'><a href='/tv/' class='btn btn-default btn-block'> TV </a></div>
		<div class='col-md-3'><a href='/rhsossi/' class='btn btn-default btn-block'> Videos </a></div>
		<div class='col-md-3'><a href='http://ssixxx.com' class='btn btn-default btn-block'> SSIxXx</a></div>
	</div>
	<div class='col-md-4 ad text-center'>
		Ad<br>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- SSI_Zone -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3813829909026031"
     data-ad-slot="6008753785"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

	</div>
	<div class='clear'></div>
</div>


<div class='clear'></div>

<!----  Video Output from URL  -->
        	<?php 
		$songs = $_GET['playlist'];

		$all_songs = get_posts( array(  'post_type' => 'video' , 'posts_per_page' => -1) );
		
		?>
		
		<div id='playall' style='display: block; text-align: center;'>
		<br><center>Play All</center><br>

		<a href='/tv/?shuffle=true'>Random </a><br><br>
		<?php
		if( isset($all_songs) ){ 
			//print_r($all_songs);
		?>
			
		<center>
		<iframe src="//www.youtube.com/embed/<?php echo array_shift($songs); ?>?playlist=<?php
			
			foreach($all_songs as $song){
				if(get_field('youtube_id', $song->ID  )){ echo get_field('youtube_id', $song->ID ) . ","; }
			}
		?>" height="315" width="560" frameborder="0"></iframe>
			<div class='clear'></div>
		</div>
		<?php }
	
		if( isset($songs) ){ ?>
		<center>
		<iframe src="//www.youtube.com/embed/<?php echo array_shift($songs); ?>?playlist=<?php
			
			foreach($songs as $song){
				echo  $song . ",";
			}
		?>" height="315" width="560" frameborder="0"></iframe>
		<?php } ?>
		</center>

		<div class='clear'></div>
<!----    -->
<div class='playlist'>

	
	<?php
		wp_reset_postdata();

		$args = array(  'post_type' => 'video' , 'posts_per_page' => -1);

		$fix_count = 0;

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		//print_r($post);
		if(get_field('youtube_id')){
		echo '<form name="songs" style="text-align: left;" action="/playlist/" method="get">';
	?>
		<?php if( checkVideoExists( get_field('youtube_id') ) ) {  ?>
		<div class='song col-md-6'>
			
			<div class='col-sm-1'>
			<input type="checkbox" name="playlist[]" class="song" value="<?php the_field('youtube_id', $post->ID); ?>" >
			</div>
			<a href='<?php echo '/' . $post->post_name; ?>'>
				<div class='col-sm-3'>
				<?php// if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); } ?>

				<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg'>
				</div>
				<div class='col-sm-8'>
				<?php  

					echo $post->post_title; 
					echo '<br>(ID: ';
					if(get_field('youtube_id')){ echo get_field('youtube_id'); }
					echo ')';
				?>
				</div>
			</a>
		</div>
	<?php 
			}//if video exists
		}else{

			if ( is_user_logged_in() ) {
	?>
			<div class='song col-md-6'>

			<a target="_blank" href='http://shamanshawn.com/wp-admin/post.php?post=<?php echo $post->ID; ?>&action=edit'>FIX</a>
			
			<br>

			<?php echo "ID: " . $post->ID; ?>

			<?php $fix_count++; ?>
			
			</div>
	<?php

			}//## if is_user_logged ##
		}
		endforeach; 
		wp_reset_postdata();

		
		?>
		
		<div class='clear'> </div>
		<section class='playlist-header text-center'>
<h1 class='playlist title'>#SSI Personal Playlist Creator</h1>
<h3>Check Songs to Add. Click "Create My Playlist" at the bottom.</h3>


<br><br>
<center>

	
<?php if( is_user_logged_in() ){ ?> 
<button id='addvideo'> Add Video </button><br><br>

<div id='addvideo' class='' style='display: none;'>
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
	
</center>
		
		

</section>
	<div class="clear"></div>
	
	<center><input type="submit" value=">>Create My Playlist!<<" class="submit"></center>

</form>
	
</div>
		
<?php get_footer(); ?>