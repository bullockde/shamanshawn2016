<div class='clear'></div>
<section class='songs'>
		
		<div class='container'>
	
		<div class='row'>
			<div class='col-xs-6'>
				 <h2>#SSIEntertainment</h2>
			</div>	
			<div class='col-xs-6'>
				<button id='music' class='btn btn-lg btn-default btn-section'>View / Hide</button>
			</div><div class='clear'></div>
			<hr>
		</div>
			
		<div class='col-md-12'>
			<div class='col-md-6'>
				<a href='/playlist/'><img src='/wp-content/uploads/2015/09/SSIPlaylist-e1445057287376.png' class='img-responsive'></a>

<!-- #START Playlist-->
			<div class='playlist'>

				<?php
		wp_reset_postdata();

		$args = array(  'post_type' => 'music' , 'posts_per_page' => 6);

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		//print_r($post);
		//if(get_field('youtube_id', $post->ID)){
		echo '<form name="songs" style="text-align: left;" action="/music/" method="get">';
	?>
	
		<div class='song col-md-12'>
			
			<div class='col-sm-12 col-md-1'>
			<input type="checkbox" name="playlist[]" class="song" value="<?php the_field('youtube_id', $post->ID); ?>" >
			</div>
			<a href='<?php echo '/' . $post->post_name; ?>'>
				<div class='col-xs-12 col-sm-3 col-md-4 text-center'>

				<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg' alt='Youtube Image'>
				</div>
				<div class='col-xs-12 col-sm-8 col-md-7 text-center'>
				<?php  

					echo $post->post_title; 
					//echo '<br>(ID: ';
					//if(get_field('youtube_id')){ echo get_field('youtube_id'); }
					//echo ')';
				?>
				</div>
			</a>
			<div class='clear'></div>
		</div>
	<?php 
		
		//}
		endforeach; 
		wp_reset_postdata();

		echo '<div class="clear"></div>';
		echo '<div class="col-md-6 pad0"><center><input type="submit" value=">> View All <<" class="submit"></center></div>
<div class="col-md-6 pad0"><center><input type="submit" value=">>Create My Playlist!<<" class="submit"></center></div>';
		echo '</form>';	
	?>

	
	
			
			</div>
<!-- #END Playlist-->
				

				<br>
			</div>
			<div class='col-md-6'>
				<a href='/tv/'><img src='/wp-content/uploads/2015/10/SSITV.png' class='img-responsive'></a>
				
<!-- #START TV-->
			<div class='playlist'>

				<?php
		wp_reset_postdata();

		$args = array(  'post_type' => 'video' , 'posts_per_page' => 6);

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		//print_r($post);
		//if(get_field('youtube_id', $post->ID)){
		echo '<form name="songs" style="text-align: left;" action="/tv/" method="get">';
	?>
	
		<div class='song col-md-12'>
			
			<div class='col-sm-12 col-md-1'>
			<input type="checkbox" name="playlist[]" class="song" value="<?php the_field('youtube_id', $post->ID); ?>" >
			</div>
			<a href='<?php echo '/' . $post->post_name; ?>'>
				<div class='col-xs-12 col-sm-3 col-md-4 text-center'>

				<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg'>
				</div>
				<div class='col-xs-12 col-sm-8 col-md-7 text-center'>
				<?php  

					echo $post->post_title; 
					//echo '<br>(ID: ';
					//if(get_field('youtube_id')){ echo get_field('youtube_id'); }
					//echo ')';
				?>
				</div>
			</a>
			<div class='clear'></div>
		</div>
	<?php 
		
		//}
		endforeach; 
		wp_reset_postdata();

		echo '<div class="clear"></div>';
		echo '<div class="col-md-6 pad0"><center><input type="submit" value=">> View All <<" class="submit"></center></div>
<div class="col-md-6 pad0"><center><input type="submit" value=">> Create My Station! <<" class="submit"></center></div>';
		echo '</form>';	
	?>

	
	
			
			</div>
<!-- #END TV-->
			</div>
		</div>	
	<div id='music' style=' display: block;'>		
		<div class="col-md-12">
			<!--<a href='/playlist/'><img class='img-responsive' src='http://shamanshawn.com/wp-content/uploads/2015/09/Create-your-playlist.jpg'></a>
			<br>-->

		</div>
			

			</div><!-- #music-->
		</div><!-- #container-->
	
	</section>
<div class='clear'></div>