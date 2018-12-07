<div class='clearfix'></div>
<section id='welcome' class='welcome' style='display:block;'>

<?php 
	if( is_user_logged_in() ){
		$current_user = wp_get_current_user();
	}
?>

<div class='col-md-12'>
		<!--<h3><b><?php if( is_user_logged_in() ){  echo 'Welcome Back!'; }else{ echo "Welcome to Shaman Shawn Inc.";}  ?></b></h3>
-->

		<div class='clearfix'></div>
		<?php if( is_user_logged_in() ){ ?>
		<div class=" col-md-4 text-center well">

			<!-- <h3>Member <?php if( is_user_logged_in() ){ echo "Profile"; }else{ echo "Spotlight"; } ?></h3> -->
			<?php

				if( is_user_logged_in() ){
				    $current_user = wp_get_current_user();
				 /**
				     * @example Safe usage: $current_user = wp_get_current_user();
				     * if ( !($current_user instanceof WP_User) )
				     *     return;
				     */

				?>
			
			<div class=" ">
			
			
			
			
			
			
			
			
			
				<div class="col-xs-5 col-md-4">
					<a target='_blank' href='/members/<?php echo $current_user->user_nicename; ?>/profile/change-avatar/' class=' '>
						<?php echo do_shortcode("[bp_profile_gravatar]"); ?>
						<br>
						edit
					</a>

				</div>
				<div class="col-xs-7 col-md-8 text-left">
				
					<b><?php echo '<h4>Welcome, ' . $current_user->display_name . '</h4>' ?></b>

					<?php	bp_activity_latest_update($current_user->ID);  ?>

					<a target='_blank' href='/members/<?php $current_user = wp_get_current_user(); echo  $current_user->user_login;  ?>/#subnav' class='status btn btn-default btn-sm pull-right'>Update</a>

				</div>
		
				
				
				
				
				<div class='clearfix'></div><br>
				
					<a target='_blank' href='/user-profile/?ID=<?php echo  $current_user->ID; ?>' class='btn btn-warning btn-block'>View Profile</a>
					
					<a target='_blank' href='/edit-profile/?ID=<?php echo  $current_user->ID; ?>' class='btn btn-warning btn-block'>Edit Profile</a>
					
					<button id='whatsnew' class='explode btn btn-danger btn-block'>Random Button</button>
					
			<div class='clearfix'></div><hr>	
				
					
					<?php echo do_shortcode("[wpmem_form login]"); ?>
				
				
				
				

			</div>

			<?php } ?>
			<!--
			 <a href='/members/<?php $current_user = wp_get_current_user(); echo  $current_user->user_login;  ?>/profile/change-avatar/'><button class='btn btn-info btn-block'>Update Profile Photo</button></a>

				<button id='profilemenu' class='btn btn-info btn-block'>Profile Menu</button>

				<div id='profilemenu' class="profilemenu" style="display: none;">

					<a href='/members/<?php $current_user = wp_get_current_user(); echo  $current_user->user_login;  ?>/profile/' class='btn btn-lg btn-info btn-block'>View My Profile</a>
						<a href='/members/<?php $current_user = wp_get_current_user(); echo  $current_user->user_login;  ?>/profile/edit/' class='btn btn-lg btn-info btn-block'>Edit My Profile</a>


				</div>

				
			-->	
			
			
		</div>
		
		<?php } ?>



			<div class='col-md-8'>

				<div id='whatsnew' >

					<div class='new-tag  hidden'><h3>What's New:</h3></div>
					
				<!-- https://www.youtube.com/embed/x7dePk1h430 -->
					<iframe width="100%" height="315" src="https://www.youtube.com/embed/3wtNi20XAdw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					
					

					<a href='/tv/'><img src="/wp-content/uploads/2015/10/SSITV.png"  alt='SSITV' class='img-responsive hidden' /></a> 
				<div class="flexslider11 hidden">
					
					<ul class="slides">
						<li>
							<a href='/playlist/'><img src="/wp-content/uploads/2015/09/SSIPlaylist-e1445057287376.png" class='img-responsive'/></a>

						</li>
						<li>
							<a href='/the-real-house-staff-of-shaman-shawn-season-premiere-trailer-1-hour-ssi/'><img src="/wp-content/uploads/2015/10/RHSoSSI-leader.png" class='img-responsive' /></a>


						</li>
						<li>
							<a href='/tv/'><img src="/wp-content/uploads/2015/10/SSITV.png" /></a>

						</li>
					</ul>
				</div>

				<!-- <center><small><< Swipe || Click >></small></center>   -->
				</div><!-- #whatsnew -->
				
				<div id='whatsnew' class='random well' style='display: none;'>
		<?php
				query_posts(array('orderby' => 'rand', 'showposts' => 1 ));
				if (have_posts()) :
				while (have_posts()) : the_post(); 
		?>
				
				<div class='text-center'>
				
			

				<?php
					$format = get_post_format( get_the_ID() );

					if( $format == 'video' || in_category( 'music' , get_the_ID() ) || in_category( 'songs-that-touch-the-soul' , get_the_ID() ) ){
					get_template_part( 'content', 'video' );
					}else{
					
					get_template_part('template-parts/content' , 'page');
					//the_content(); 
					}
				?>
				</div>
				
				<h1><a target='_blank' href='<?php the_permalink() ?>' class='btn btn-info btn-lg btn-block hidden'>Learn More >></a></h1>

	<?php endwhile;
		endif;

		wp_reset_query();
		?>
		</div>
		
			</div>	<!-- #new -->
								
								
							
		<?php if( !is_user_logged_in() ){ ?>

		
		<div class='col-md-4 spotlight text-center'>
			
			<div class='well'><a href='/members/'>#SSIMembers</a></div>

			<?php if( !is_user_logged_in() ){ ?>
				
				<div id='loginform'>
					<a href='/register/' class='btn btn-lg btn-info btn-block hidden'>Register Now</a>
					<button id='loginform' class=' btn btn-lg btn-info btn-block'>Register Now</button>
					<button id='loginform' class=' btn btn-lg btn-info btn-block'>Login</button>

					<button id='whatsnew' class=' btn btn-lg btn-danger btn-block'>Random Button</button>
				</div>

				<div id='loginform' class=' well ' style='display: none;'>
					<?php echo do_shortcode("[wpmem_form register]"); ?><br>
					<?php echo do_shortcode("[wpmem_form login]"); ?>
					
				</div> 
					<?php }else{ ?>
					<a href='/activity/' class='btn btn-lg btn-info btn-block'>Member Activity</a><br>

						<a href='/members/' class='btn btn-lg btn-info btn-block'>View All Members</a><br>
					<?php } ?>

		</div><!--  #members  -->
		<?php } ?>
		<div class='clearfix'></div><br>
</div><!--  #Container  -->
							
</section>
<div class='clearfix'></div>