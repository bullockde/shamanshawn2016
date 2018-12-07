<?php
/*
Template Name: Zone Page
*/

get_header(); ?>


<div id='zone' class='zones 1'>
	

		
<div class='zone'>
	<div class='col-md-8 col-md-offset-2 ad content text-center'>


		 <a href='/zone/'><img src='http://shamanshawn.com/wp-content/uploads/TheZone-cover.png' class=' circle red-glow'></a><br>
		<div class='flexslider hidden'>
			<ul class="slides">
    <li>
      <a href='/tv/'><img src='/wp-content/uploads/2015/10/SSITV.png' class=''></a>
    </li>
    <li>
      <a href='/music/'><img src='/wp-content/uploads/2015/09/SSIPlaylist-e1445057287376.png' class='img-responsive'></a>
    </li>
    <li>
      <a href='/rhsossi/'><img src='/wp-content/uploads/2015/10/RHSoSSI-leader1.png' class=''></a>
    </li>
    <li>
      <a href='http://ssixxx.com'><img src='/wp-content/uploads/SSIxXx.png' class=''></a>
    </li>
 			 </ul>

		</div>
	
		<div class='clearfix'></div><br><br>

		
		<div class='col-md-3'><a href='/music/' class='btn btn-default btn-block'> Music </a></div>
		<div class='col-md-3'><a href='/tv/' class='btn btn-default btn-block'> TV </a></div>
		<div class='col-md-3'><a href='/rhsossi/' class='btn btn-default btn-block'> Videos </a></div>
		<div class='col-md-3'><a target='_blank' href='http://ssixxx.com/' class='btn btn-default btn-block'> SSIxXx</a></div>
	</div>
	<div class='col-md-41 ad'>
		

	</div>
	<div class='clearfix'></div><br>
</div>


<div class='clearfix'></div><br>

	<div class='zone-container report'>
		<div class='col-sm-3 text-center zone-left'>
			
	
			

			<div class='hidden col-sm-12 text-center well'>

				<b>Shaman Shawn's Closet</b><hr>

<img src='/wp-content/uploads/closet.jpg' class='img-responsive aligncenter ' width='250'>
<hr />
<p style="text-align: center;"><a class="btn btn-success btn-lg" href="/vault/">Get FREE Access!</a></p>
			
			</div>

			
			<iframe src='//www.groupon.com/content-assembly/render/c732c070-8b52-11e6-915a-bd4ba8ee7e8c' width='320' height ='480' frameBorder='0' scrolling='no'></iframe>
			
			

			<div class='col-sm-12 text-center well'>

			<b>Recent Galleries</b><hr>
			<?php
		wp_reset_postdata();
		
		$count = 0;

		$args = array(  'post_type' => 'g_galleries' , 'posts_per_page' => 6);

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
			if ( !post_password_required( $post ) ){
		
		echo '<form name="songs" style="text-align: left;" action="/music/" method="get">';
	?>
	
		<div class='song col-md-12 col-xs-6'>
			
			<a href='<?php echo '/' . $post->post_name; ?>'>
				<div class='col-xs-12 text-center'>
<?php
				if(get_field('youtube_id', $post->ID)){
		?>
			<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg' alt='Youtube Image'  class='circle'>
		<?php
		
	}else if( has_post_thumbnail() ) { //the post does not have featured image, use a default image
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'thumbnail' );

		?>
			<img src='<?php echo esc_attr( $thumbnail_src[0] ) ; ?>' alt='Youtube Image'  class='circle'>
		<?php
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}

?>

			
				</div>
				<div class='col-xs-12 text-center'>
					<?php  echo $post->post_title; ?>
				</div>
			</a>
			
		</div>
	<?php 
	
		$count++;
		
		if( ($count % 2) == 0 ){ ?> <div class='clearfix'></div> <?php }
		
		
		 }//end if password
		endforeach; 
		wp_reset_postdata();

		echo '<div class="clear"></div>';
	?>

			</div><!-- GALLERY Well -->	
			
		
	<div class="clear"></div>
		</div>
		
		
		
	
		</div>
		
		<div class='col-sm-5 text-center zone-mid'>
			<div class='clear visible-xs visible-sm'></div>
<a href='/music/'><img src='/wp-content/uploads/2015/09/SSIPlaylist-e1445057287376.png' class='img-responsive leader'></a><br>
<!-- #################################### -->
			<?php
		wp_reset_postdata();
		
		$count = 0;

		$args = array(  'post_type' => 'music' , 'posts_per_page' => 4);

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		
		echo '<form name="songs" style="text-align: left;" action="/music/" method="get">';
	?>
	
		<div class='song col-xs-6'>
			
			<a href='<?php echo '/' . $post->post_name; ?>'>
				<div class='col-xs-12 text-center pic'>

				<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/0.jpg' alt='Youtube Image'>
				</div>
				<div class='col-xs-12 text-center video-name'>
					<?php  echo $post->post_title; ?>
				</div>
			</a>
			<div class='clearfix'></div>
			
			<?php 
			
			
			
			
			?>
		</div>
	<?php 
			$count++	;
		if( ($count % 2) == 0 ){ ?> <div class='clearfix'></div> <?php }
			
			
		
		endforeach; 
		wp_reset_postdata();

		echo '<div class="clear"></div>';
	?>
	<a href='/music/' class='btn btn-danger btn-block'>All Music >> </a><br>
<hr>
<a href='/tv/'><img src='http://shamanshawn.com/wp-content/uploads/2015/10/SSITV.png' class='img-responsive leader'></a><br>
<!-- #################################### -->
			<?php
		wp_reset_postdata();
		
		$count = 0;

		$args = array(  'post_type' => 'video' , 'posts_per_page' => 4);

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		
		echo '<form name="songs" style="text-align: left;" action="/music/" method="get">';
	?>
	
		<div class='song col-xs-6'>
			
			<a href='<?php echo '/' . $post->post_name; ?>'>
				<div class='col-xs-12 text-center pic'>

				<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/0.jpg' alt='Youtube Image'>
				</div>
				<div class='col-xs-12 text-center video-name'>
					<?php  echo $post->post_title; ?>
				</div>
			</a>
			<div class='clearfix'></div>
		</div>
	<?php 
		
					$count++	;
		if( ($count % 2) == 0 ){ ?> <div class='clearfix'></div> <?php }
		
		endforeach; 
		wp_reset_postdata();
		
		

		echo '<div class="clear"></div>';
	?>
	
	<a href='/music/' class='btn btn-danger btn-block'>Go to #SSITV >> </a><br>
	<hr>
		<iframe src='//www.groupon.com/content-assembly/render/8f17ce60-8b52-11e6-b287-fb33b50b91ed' width='468' height ='400' frameBorder='0' scrolling='no'></iframe>	
		
		
		
		</div>
		<div class='col-sm-4 text-center zone-right'>
			<div class='clear visible-xs visible-sm'><br></div>
		
			<div class='col-sm-12 text-center ' style='padding-right: 5px;'>

						
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- SSI_Zone_300_250 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-3813829909026031"
     data-ad-slot="9987321388"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<br>Advertisement<br><br>
			</div>

			

			<div class='hidden col-sm-12 text-center well'>

	<b>Shaman Shawn - In The Flesh</b><hr>

<img src='http://shamanshawn.com/wp-content/uploads/2015/07/InTheFlesh-border.png' class='img-responsive aligncenter ' width='250'><br>

<p style="text-align: center;">
<a href='/in-the-flesh/' class='btn btn-success btn-lg'>Get FREE Access!</a><br>
</p>

			
			</div>

			
			<!-- #################################### -->

		<div class='col-sm-12 text-center well'>

			<b>Recent Blogs</b><hr>
			<?php
		wp_reset_postdata();

		$args = array(  'post_type' => 'post' , 'posts_per_page' => 6);

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		
		echo '<form name="songs" style="text-align: left;" action="/music/" method="get">';
	?>
	
		<div class='song col-md-12'>
			
			<a href='<?php echo '/' . $post->post_name; ?>'>
				<div class='col-xs-12 text-center'>
<?php
				if(get_field('youtube_id', $post->ID)){
		?>
			<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg' alt='Youtube Image'>
		<?php
		
	}else if( has_post_thumbnail() ) { //the post does not have featured image, use a default image
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'medium'  );

		?>
			<img src='<?php echo esc_attr( $thumbnail_src[0] ) ; ?>' alt='Youtube Image '>
		<?php
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}

?>

			
				</div>
				<div class='col-xs-12 text-center'>
					<?php  echo $post->post_title; ?>
				</div>
			</a>
			<div class='clearfix'></div><hr>
		</div>
	<?php 
		
		
		endforeach; 
		wp_reset_postdata();

		echo '<div class="clear"></div>';
	?>

		</div><!-- WELL Blog -->	


		</div>
		


			
			<div class='clearfix'></div>		
	</div><!-- #Container -->
	

<div class='clearfix'></div>
<?php //get_template_part( 'content', 'members' ); ?>


</div> <!--  #Gallery  -->


<?php get_footer(); ?>