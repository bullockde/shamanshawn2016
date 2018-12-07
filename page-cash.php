<?php
/**

 
 */

 
  if( wp_is_mobile() ){  $height = '375px'; }else{  $height = '475px';}
 
 //if( !isset($_COOKIE["site_entered"]) ){ setcookie( 'site_entered' , 'Yes' , time() + (86400 * 30), "/"); }
 
get_header('network'); ?>


<div id="" class=" text-center">


		<div class='col-sm-8 col-sm-offset-2 text-center'>
			
			<div class='col-xs-6 h3  well hidden1'>
				<h4>Requests</h4>
				
					<h1><?php echo count($upcoming_events); ?>4</h1>
				
			</div>
			<div class='col-xs-6 h3 well hidden1'>
				<h4>Approved</h4>
				
					<h1><?php echo count($past_events); ?>3</h1>
				
			</div>
				
					
					<div class="clear"></div><br>
		</div>

		<center>
		<a href="/about" class="btn btn-default rsvp button hidden" target="_blank"><< About</a>
		<a href="/events" class="btn btn-default rsvp button hidden" target="_blank">Events >></a>
		<button id="models" class="btn rsvp hidden">> Our VIP List <</button>
		</center>
		<br>
		<a href="/events" class="btn btn-default rsvp button hidden" target="_blank">> Our VIP List <</a>
		<br><br>
			<div id='models' class=' container' style='display:none;'>
				<hr>
				<div class='  text-center'>
					<?php 
					
					echo do_shortcode('[gravityform id="11" title="false" description="false"]');
					?>
				</div><div class='clear'></div><br><hr>
			</div>
		
		
		<div class='well col-sm-6 col-sm-offset-3'>
		
		<div class=' video'>
				
			<?php  get_template_part( 'ad ', '300-250-1' ); ?>

			
			<?php
					//the_post_thumbnail( get_the_ID() );
			
				/*$args = array( 'numberposts' => 1, 'post_type' => 'video' );
				$recent_posts = wp_get_recent_posts( $args );
				
				//print_r($recent_posts);
				
				foreach( $recent_posts as $recent ){
					//echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
					//print_r($recent);
					?> 
					<a href='/videos'> <div style='max-height: <?php echo $height; ?>;'>
					<?php
					//echo get_the_post_thumbnail( $recent["ID"] );
					echo $recent["post_content"];
					?> </div>
					</a>
					
					<?php
				}*/
				wp_reset_query();
			?>
			</div>
	
	
	
		<div class='clear'></div>
		
		<div class="stats">
			<hr><h4>Upcoming Challenges:</h4><hr>
		<?php
			$upcoming_events = get_posts( array (  
						
					   'posts_per_page'         =>  -1,
					   'post_type' => 'ssi_events',
					   'category_name' => 'cashapp',
					   //'meta_key'               => 'event_date',
						'order' => 'desc', 

					)     );
					
					
					
	
			
		$found = 0;
		
		$count = 0;
		
		if(count($upcoming_events) == 0){ 	
			?>
			<center>- No Upcoming Events -</center>
			<?php	
		}
		
		foreach( $upcoming_events as $lead ){
		
	?>
				<div class='col-sm-10 col-sm-offset-1 report text-center well'>		
			
				<h3><?php echo $lead->post_title; ?></h3>
				<div class='clear'></div><br>
				<div class='col-sm-12 hidden1 '>	
					
			<?php 
					if( has_post_thumbnail() ){
						
						echo get_the_post_thumbnail( $lead->ID ,  'thumbnail');
					}else{
						
						//twentysixteen_the_custom_logo(); 
					}
				 ?>
		<div class='clear'></div><br>
		
<?php if( in_category('cashapp', $lead->ID) ) { ?>			
			
		
			<div class=' col-xs-12 text-center hidden1'>
				<h4>$<u><?php echo get_field('event_reward', $lead->ID); ?></u> Will Be Awarded</h4>
			</div>
			
			<div class='clear'></div><hr>
<?php } ?>	

				</div>
				<div class='col-sm-12'>			
					<div class='clear'></div>
					
					<div class='col-xs-6 '>
						<h5><u>Date</u></h5>

						<?php date_default_timezone_set("America/New_York"); 

						echo date("M jS", strtotime(get_field('event_date', $lead->ID)));
						?> 
														
														
					</div>
					<div class='col-xs-6 '>
						<h5><u>Time</u></h5>
						<?php echo get_field( 'event_time', $lead->ID ); ?>
					</div>
					<div class='clear '></div><br>
						
						<h5><u>Location</u></h5> 
						<?php echo get_field( 'event_location', $lead->ID ); ?>
									
						<br><br>
				
				<br>
				<h4><?php echo get_field( 'event_price' , $lead->ID); ?></h4>
			

				
						<div class='clear'></div>
				<?php $rsvps = get_field( 'event_rsvps' , $lead->ID); 
						$max_guests = get_field( 'event_max_guests' , $lead->ID);
						$seats = $max_guests - $rsvps;
					
					?>
					( <u><?php echo $seats; ?></u> Slots Left ) <br>
					
				</div>
				<div class='col-sm-12 report '>	
					<!--
						<hr>
							<center>Top <u>3</u> Guests</center><hr>
							<?php 
							
							
					$guests = get_posts( array (
						
					   'posts_per_page'         =>  -1,
					   'post_type' => 'event_guests',
						'category_name'                  => 'event' . $lead->ID ,
					    'order'                  => 'asc',
						//'orderby'                => 'meta_value_num',
						//'meta_key'               => 'vortex_system_likes',
						//'categories'	=>	array( -147 ),
					)     );
					$guest_count = 1;
					
					if( !count($guests) || count($guests) == 1 ){ echo "- no guests -<br>"; }
					foreach( $guests as $guest ){
					
						if( get_field( 'event_host' , $guest->ID ) == 'Yes' || $guest_count > 3 ){  continue; }
						?>
						<div class='col-md-12 text-left'>
							<?php 
							echo ($guest_count) . ". ";
								$guest_count++;
							?>
							
								<?php echo $guest->post_title;  ?>
							
						</div>

					<div class='clear'></div><hr>
				<?php
					}
					
						?>
					-->
					<br>
					<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-rsvp btn-info btn-lg btn-block'><br> Full Details >><br><br></a>
				
				</div>
						<div class='clear'></div>
				
				
				<img src='<?php echo get_field( 'event_flyer', $lead->ID ); ?>' class=' img-responsive hidden'>	
						
		</div>					

						<div class='clear'></div>
						
					

								<?php
		}
					
					$past = 0;
		
		
			?>			
			<hr><h4>We Current Have: </h4><hr>
			
			<div class="col-md-12 text-center">		
						
						<?php get_template_part( 'ad' , 'flag-counter' ); ?>
						<br>
				</div>
				
					
						
			<?php 
			
			$events = get_posts(array(  'post_type' => 'ssi_events' , 'posts_per_page' => -1 )); 
			$models = get_posts(array(  'post_type' => 'ssi_models' , 'posts_per_page' => -1 ));
			$projects = get_posts(array(  'post_type' => 'ssi_projects' , 'posts_per_page' => -1 ));
			$photos = get_posts(array(  'post_type' => 'ssi_photos' , 'posts_per_page' => -1 ));
			$videos = get_posts(array( 'post_type' => 'ssi_videos' , 'posts_per_page' => -1 ));
			$requests = get_posts(  array(	 'post_type'   => 'ssi_requests',  'posts_per_page' => -1,  
								//'date_query' => array( array( 'after' => '1 month ago' ) )  
						) 
					);
			
		?>


						

			<div class='clear'></div>
					
					<?php get_template_part( 'ad' , '300-250-1' ); ?>	

			<div class='clear'></div>

								
	</div><!-- // container -->
		
	<br>
		
		
		
		
		<hr><h4> Member Benefits </h4><hr>
		
		
		<p>- View All Member Profiles</p>
		<p>- Get Full Access to our Pix/Vids</p>
		<p>- Get Access to our Private Events</p>
		<p>- View Exclusive Model Content</p>
		<p>- Get Notified when we Make an Update!</p>
		<!--<p>- View My Full Model Profile</p>
		<p>- Get Full Access to My Amateur Photos</p>
		<p>- Get Full Access to My Amatuer Vidoes</p>
		<p>- Get My Personal Cell Phone #</p>
		<p>- Ask me any Question. I'll Answer!</p>-->
		<br>
		
		<div class='clear'></div>
		
		<div class='well'>
			<h4>Join Today - 100% FREE!</h4><hr>
			
			<a href='/join' class='btn btn-success btn-lg btn-block'>Join Now</a>
			
			<div id='join' style='display: none;'>
				<?php echo do_shortcode("[wpmem_form register]"); ?>
			</div>
			
			<br><h4>Already A Member?</h4><hr>
			
			<?php 
			
				if( is_user_logged_in() ){
					?>
					<a href='/hhh-home' class='btn btn-success btn-lg btn-block'>Enter Here >></a>
					<?php
				}else{
					?>
					<button id='login' class='btn btn-success btn-lg btn-block'>Login Here</button>
			<div id='login' style='display: none;'>
				<?php echo do_shortcode("[wpmem_form login redirect_to='/hhh-home']"); ?>
			</div>
					<?php
				}
			?>
			
			
		</div>
		
	</div>
	<div class='clear'></div>
		
	<?php  //	get_template_part( 'content', 'welcome' ); ?>
	
	
	
			
			<div class=' col-sm-12 text-center well hidden <?php if( is_page( array('ssixxx') ) ){ echo "hidden" ; } ?>'>
				<b>SEXUAL INTERESTS :</b><br><br>

				Daddy/Son Roleplay<br>
				Master/Slave<br>
				Daddys little Boy/Girl<br>
				Tapout Game<br>
				Bondage (BDSM)<br>
				Cum Control<br>
				Male Chastity<br><br>
				I am big on ROLEPLAY &amp; FETISH sex

			</div>

		

		
</div><!-- .content-area -->


<?php 
	get_footer('network');  
?>