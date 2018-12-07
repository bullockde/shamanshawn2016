<?php
/*
Template Name: SSIxXx Single
*/


get_header();

?>

<br><br>
<div id='ssixxx' class=' '>
		
	<?php 
	//the_title( '<header class="entry-header"><h1 class="entry-title text-center">', '</h1></header><!-- .entry-header -->' );

	?>


<div class='zone'>
	

	<?php if( !is_page('ssixxx') ){ ?>

		<div class='col-md-12 content ad text-center'>

		<a href='<?php if( is_page('ssixxx') ){ ?>
			/ssixxx/
		<?php }else{ ?>
			/ssixxx-home/
		<?php } ?>'><img src='/wp-content/uploads/SSIxXx.png' class='img-responsive'></a>
		
			<div class='col-md-1'></div>

		<?php if( is_user_logged_in() ){ ?>
			<div class='col-md-2'><a href='/ssixxx-home/' class='btn btn-danger btn-block'> Home</a></div>
		<?php }else{ ?>
			<div class='col-md-2'><a href='/ssixxx-access/' class='btn btn-danger btn-block'> Join Now (FREE)</a></div>
		<?php } ?>
			<div class='col-md-2'><a href='/ssixxx/about-ssixxx/' class='btn btn-default btn-block'> About </a></div>
			<div class='col-md-2'><a href='/ssixxx/photos/' class='btn btn-default btn-block'> Photos </a></div>
			<div class='col-md-2'><a href='/ssixxx/videos/' class='btn btn-default btn-block'> Videos </a></div>	
		<?php if( is_user_logged_in() ){ ?>
			<div class='col-md-2'><a href='https://ssi.memberful.com/checkout?plan=13503' class='btn btn-success btn-block'>Premium Access ($1)</a></div>
		<?php }else{ ?>
			<div class='col-md-2'><a href='/ssixxx-login/' class='btn btn-danger btn-block'> Member Login</a></div>
		<?php } ?>
			
			<div class='col-md-1'></div>

			</div>

	<?php } ?>
		
		<div class='clear'></div>

		
	
</div>



		
		<div class='clear'></div>


<!-- ------------------------------------   -->


<div class='clear'></div><hr>


	<div class='zone-container '>
		<div class='col-sm-1 text-center'>
			
			<!-- Left Column-->

	
		
		</div>
		<div class='col-sm-7 text-center'>
				
			
			<div class='col-sm-12 text-center well content'>


			<?php 
				the_title( '<header class="entry-header"><h1 class="entry-title text-center">', '</h1></header><!-- .entry-header -->' );

			?>
			<?php
				// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			the_content();
			echo "<hr>";
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;

			?>

			<div class='clear'></div><br>

			<!--JuicyAds v2.0-->
<iframe border=0 frameborder=0 marginheight=0 marginwidth=0 width=468 height=72 scrolling=no allowtransparency=true src=http://adserver.juicyads.com/adshow.php?adzone=504575></iframe>
<!--JuicyAds END-->

					
			<div class='clear'></div>
			<br><br>

			<b>Recent Galleries</b><hr>

	<?php
		wp_reset_postdata();


		if( in_category('videos', $post->ID ) ){
			$args = array(  'post_type' => 'ssi_gallery' , 'posts_per_page' => -1 , 'category' => '152' );
		}else if( in_category('photos', $post->ID) ){
			$args = array(  'post_type' => 'ssi_gallery' , 'posts_per_page' => -1 , 'category' => '153' );
		}else{
			$args = array(  'post_type' => 'ssi_gallery' , 'posts_per_page' => -1 , 'category' => '-160');
		}


		$count = 0;
		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		$count++;
			
		echo '<form name="songs" style="text-align: left;" action="/music/" method="get">';
	?>
	
		
		<div class='song col-md-6'>
			<div class='col-xs-12 text-center'>
					<?php  echo $post->post_title; 

						if( !is_user_logged_in() ){						
					?>

					
					<?php
						}
					?>
				</div>
			<a href='<?php

				if( is_page('photos') && ($count <= 3) ){
					 echo '/ssi_gallery/' . $post->post_name; 
				}else if( is_page('videos') ){
					 echo '/ssi_gallery/' . $post->post_name; 
				}else{

					echo '/ssi_gallery/' . $post->post_name; 
					//echo 'https://ssi.memberful.com/checkout?plan=13503';
				}
	?>'>
				<div class='col-xs-12 text-center'>
			
		<?php
		
		 //the post does not have featured image, use a default image
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'thumbnail' );

		?>
			<img src='<?php echo esc_attr( $thumbnail_src[0] ) ; ?>' alt='Youtube Image'></a><br>
		<?php

			echo "<div class='clear'></div>" . get_field('member_level', $post->ID );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	

?>
			
			

				</div>
				<div class='col-md-12'>

			<div class='clear'></div>

				<a class="btn-success btn-block btn-lg text-center <?php if( !is_page('photos') ){ echo 'hidden'; } ?>" href="<?php if( is_page('photos') && ($count <= 3) ){
					 echo '/ssi_gallery/' . $post->post_name; 
				}else{
					echo '/ssi_gallery/' . $post->post_name;
					//echo 'https://ssi.memberful.com/checkout?plan=13503';
				}?>">View Gallery</a>
				</div>
				
			</a>
			<div class='clear'></div>

		</div>
	<?php 
		if( ($count % 2) == 0 ){  echo "<div class='clear'><hr></div><br>"; }
		
		endforeach; 
		wp_reset_postdata();

		

		echo '<div class="clear"></div>';
	?>
<br>
 <h4><center>Subscribe & Unlock More HOT Stuff!!</center></h4> <hr>
<div class='col-md-6'>
<a class="btn-danger btn btn-lg btn-block" href="/ssixxx/join/">Join Now! (Free)</a>
</div>
<div class='col-md-6'>
<a class="btn-danger btn btn-lg btn-block" href="/ssixxx-login/">Member Login</a>
</div>

<div class='clear'></div>
<hr />

		<span style="color: #999999; font-size: 8px;"><center>*($1) Subscription renews at $10/month</center></span>

			</div><!-- GALLERY Well -->	

			<?php
	

		echo '<div class="clear"></div>';
	?>

		</div>
		<div class='col-sm-4 text-center'>

		
			<div class='col-sm-12 text-center pad0'>

						
		<!--JuicyAds v2.0-->
<iframe border=0 frameborder=0 marginheight=0 marginwidth=0 width=300 height=262 scrolling=no allowtransparency=true src=http://adserver.juicyads.com/adshow.php?adzone=498540></iframe>
<!--JuicyAds END-->
<br>
			</div>


			
			<div class=' col-sm-12 text-center well'>

	<b>Shaman Shawn - In The Flesh</b><hr>

<img src='http://shamanshawn.com/wp-content/uploads/2015/07/InTheFlesh-border.png' class='img-responsive aligncenter ' width='250'><br>

<p style="text-align: center;">
<a href='/in-the-flesh/' class='btn btn-success btn-lg'>Get FREE Access!</a><br>
</p>

			
			</div>

			<div class=' col-sm-12 text-center well'>

				<b>Shaman Shawn's Closet</b><hr>

<img src='/wp-content/uploads/closet.jpg' class='img-responsive aligncenter ' width='250'>
<hr />
<p style="text-align: center;"><a class="btn btn-success btn-lg" href="/vault/">Get FREE Access!</a></p>
			
			</div>
			<!-- #################################### -->

		</div><!-- Right Column -->
		
	</div><!-- #Zone Container -->
	

<div class='clear'></div><hr>

<!-- --------------------------------  -->



<?php

get_footer('ssixxx'); ?>