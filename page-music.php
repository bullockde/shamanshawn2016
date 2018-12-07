<?php get_header(); ?>


<div class='zone'>
	<div class='col-md-8 ad content text-center'>

		<a href='/tv/'><img src='/wp-content/uploads/2015/09/SSIPlaylist-e1445057287376.png' class='img-responsive'></a>

		
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

		$all_songs = get_posts( array(  'post_type' => 'music' , 'posts_per_page' => 25 , 'orderby' => 'rand' ) );
		
		//$all_songs = get_posts( array(  'post_type' => 'music' , 'category_name' => 'party-playlist', 'posts_per_page' => 100 , 'orderby' => 'rand' ) );
		
		?>
		
		<div id='playall' style='display: block; text-align: center;'>
		<br><center>Play All</center><br>

		<a href='/music/?shuffle=true'>Random </a><br><br>
		<?php
		if( isset($all_songs) ){ 
			//print_r($all_songs);
			
			$shuffle = $_GET['shuffle'];
			if( $shuffle ){
				shuffle ( $all_songs );
			}
			
			$song1 = array_shift($all_songs);
			
			$skip = true;
		?>
			
		<center>
		<iframe src="//www.youtube.com/embed/<?php echo get_field('youtube_id', $song1->ID ); ?>?playlist=<?php
			
			
			foreach($all_songs as $song){
				
				if( $count++ > 143) continue;
				
				if( $skip  ){ $skip = false; }else{ echo ","; }
				if(get_field('youtube_id', $song->ID  ) && checkVideoExists( get_field('youtube_id', $song->ID  ) )){ echo get_field('youtube_id', $song->ID ); }
				
				
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
		//wp_reset_postdata();

		$args = array(  'post_type' => 'music' , 'posts_per_page' => 10);

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
		//wp_reset_postdata();

		
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
	
</center>
		
		

</section>

<div class="clear"></div>
<center><input type="submit" value=">>Create My Playlist!<<" class="submit"></center>

</form>
	

</div>
		
<?php get_footer(); ?>