<?php 

get_header('events');

$past_events = get_posts( array (  
						
					   'posts_per_page'         =>  -1,
					   'post_type' => 'ssi_events',
					   
					   'category_name' => 'past-events',
						'order' => 'desc',

					)     );
					
$upcoming_events = get_posts( array (  
						
					   'posts_per_page'         =>  -1,
					   'post_type' => 'ssi_events',
					   'category_name' => 'upcoming-events',
					   //'meta_key'               => 'event_date',
						'order' => 'desc', 

					)     );

	if($_POST['new_event']){
		echo "NEW EVENT!!";
		

				
		$name = $_POST['post_title'];
		
		$catID = get_cat_ID( 'Upcoming Events' );
			//$category =  get_the_category($EventID);
			
			
			$cats = array();
			
			array_push($cats, $catID);
		
		// Create post object
		$my_post = array(
		  'post_title'    => $name,
		  'post_type'  => 'ssi_events',
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => $cats
		);
		 
		// Insert the post into the database
		$postID = wp_insert_post( $my_post );
		
		
		add_post_meta($postID , 'event_date', $_POST['event_date'] );
		
		$start_time = date("ga", strtotime($_POST['event_start'])); 
		
		add_post_meta($postID , 'event_start', $start_time );
		
		$end_time = date("ga", strtotime($_POST['event_end'])); 
		
		add_post_meta($postID , 'event_end', $end_time );
		
		$event_time = $start_time . " - " . $end_time;
		
		add_post_meta($postID , 'event_time', $event_time );
		
		add_post_meta($postID , 'event_location', $_POST['event_location'] );
	
		wp_publish_post( $postID ); 
		wp_update_post( $postID ); 
		
		
		
	}
	
	

?>
<?php
$folks = get_posts( array (  
						
					   'posts_per_page'         =>  -1,
					  // 'post_type' => 'party_guests',
						'category_name'                  => 'vip-member',
						'post_status'                => 'draft',
						'order' => 'asc',
						//'offset' => 2
					   // 'meta_key'               => 'vortex_system_likes',
						//'categories'	=>	array( -147 ),
					)     );
					
					foreach( $folks as $lead ){
						set_post_type( $lead->ID , 'party_guests' );
						wp_publish_post( $lead->ID ); 
					}
					

		
?>
<hr><h2 class='text-center'> Events </h2><hr>

<div class='col-sm-8 col-sm-offset-2 text-center'>
	
	<div class='col-xs-6 h3  well hidden1'>
		<h4>Upcoming</h4>
		
			<h1><?php echo count($upcoming_events); ?></h1>
		
	</div>
	<div class='col-xs-6 h3 well hidden1'>
		<h4>Completed</h4>
		
			<h1><?php echo count($past_events); ?></h1>
		
	</div>
		
			<div class="clear"></div>
			
			<button id='newparty' class=' text-center hidden1'>New Event</button>
			
			<div class="clear"></div>
</div>
		
		
<div class=' text-center hidden1'>

	<div class="clear"></div>
	

	<div id='newparty' style='display: none;'>
			
			<hr>
	<div class='col-sm-10 col-sm-offset-1 text-center hidden1 well'>		
		<form method='post'>
				<h3><input type='text' name='post_title' placeholder='Event Title' required><hr></h3>
				
				<div class='col-sm-6 '>	
					<?php //echo get_the_post_thumbnail($lead->ID); ?>
					<img src='http://shamanshawn.com/wp-content/uploads/SSI-Logo-Banner-New-QR-940x635.png'>
					
				<div class="event-info h4">
					<div class='clearfix'></div><br>
						<div class="col-xs-6">
							<b>Members Only?</b>
						</div>
						<div class="col-xs-6">
							<?php 
							
								$att = get_user_meta($userid, 'event_members_only', 1);
								$options = array( 'No', 'Yes' );

							?>
							<select name="event_members_only" >
							<?php 
								foreach($options as $option){
									
									?>
									<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
									<?php
								}
							?>
							</select>

						</div>
					</div>
				</div>
				<div class='col-sm-6 '>			
					<div class='clearfix'></div>
					<div class='col-xs-12 '>
						<h3><u>Date</u></h3><h4 class='orange'> <?php date_default_timezone_set("America/New_York"); 

						?> <input type='date' name='event_date' placeholder='Event Date' required></h4>
														
														
					</div>
					<div class='clear '></div>
					<h3><u>Time</u></h3>
					<div class='col-xs-6 '>
						<b><u>Start</u></b><h4 class='orange'>  <input type='time' name='event_start' placeholder='Event Time' required></h4>
					</div>
					<div class='col-xs-6 '>
						<b><u>End</u></b><h4 class='orange'>  <input type='time' name='event_end' placeholder='Event Time' required></h4>
					</div>
					<div class='clear '></div>
						
						<h3><u>Location</u> <br> <input type='text' name='event_location' placeholder='Event Location' required><hr>
						

				<h4><input type='text' name='event_price' placeholder='Event Price' required></h4>

				</div>
						<div class='clearfix'></div>
			
			<input type='hidden' name='new_event' value='true'>
			<input type='submit' value='Submit' class='btn btn-lg btn-success btn-block' style='padding: 1em; '>
								
								
				<img src='<?php echo get_field( 'event_flyer', $lead->ID ); ?>' class=' img-responsive'>	
			</form>					
		</div>	
	</div>
</div>


<div class=' text-center'>


<div class="clear"></div>
	
	<hr><h3> Upcoming Events </h3><hr>
	

	<?php 
			
		$found = 0;
		
		$count = 0;
		
		if(count($upcoming_events) == 0){ 	
			?>
			<center>- No Upcoming Events -</center>
			<?php	
		}
		
		
		
		foreach( $upcoming_events as $lead ){
		
	?>
				<div class='col-sm-10 col-sm-offset-1 text-center well'>		
			
				<h3><?php echo $lead->post_title; ?></h3>
				<div class='clearfix'></div><hr>
				<div class='col-sm-3 '>	
					<?php echo get_the_post_thumbnail($lead->ID); ?>
					<br><br>
				</div>
				<div class='col-sm-6 '>			
					<div class='clearfix'></div>
					
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
			

				
						<div class='clearfix'></div>
				
				</div>
				<div class='col-sm-3 '>	
					<a href='/?p=<?php echo $lead->ID; ?>' class='btn btn-rsvp btn-info btn-lg btn-block'><br> Full Details >><br><br></a>
				
				</div>
						<div class='clearfix'></div>
				
				
				<img src='<?php echo get_field( 'event_flyer', $lead->ID ); ?>' class=' img-responsive hidden'>	
						
		</div>					

						<div class='clearfix'></div>
						
					

								<?php
		}
					
					$past = 0;
		
		?>
	
	
</div>	 
	<?php //foreach( $emails as $email){ echo $email . "; "; } ?>
	
	<?php //get_template_part('home-members'); ?>
	
	<?php //get_template_part('content-party-people'); ?>
	
	<?php //get_template_part('content-dl-people'); ?>
    
	
		 
<?php

					
					
					$args = array(
						
							//'number' => -1,
							//'role' => 'role_party_guest',
							//'meta_key' => 'wp-last-login',
							//'orderby'  => 'meta_value_num',
							//'orderby'  => 'registered',
							//'order' => 'DESC',
							//'date_query' => array( array( 'after' => '12/25/16' ) )  ,
							
						) ;
						
					//	$ordered_users =  new WP_User_Query( $args );

					//	$ordered_users =  get_users( $args );
						//$blogusers = $ordered_users->get_results();
						
				//	$total_results = count($ordered_users);
					
					
					
		
							
		?>
<hr>
<br><br>
<br><br>
<br><br>
<br><br>

<div class='clearfix'></div>

<div class=' text-center hidden1'>

	
	<div class='col-xs-12 '>
	
	<hr><h3> Past Events </h3><hr>
	

		<?php 
			
				if(count($past_events) == 0){ 	
				
					?><center>- No Past Events -</center>
						<hr>
						<br><br>
						<br><br>
						<br><br>
						<br><br>
						<?php
				}
				
					foreach(   $past_events as $lead ){
						
						
					
						
						?>
					

		<div class='well  '>
			<div class='text-center'>
	
				

				<div class='clearfix'></div>
		

<?php 

				$current_party_date = '';
				$count = 1;
				

		
				
				?>
				
				
			<div class='<?php if($count == 1){ echo " past-party"; } ?> '>
			      
				  <h2><?php echo $lead->post_title; ?><br><small>(<?php echo get_field('event_date',  $lead->ID); ?>)</small><h2>
				  
				  
				  <hr>
				  <?php 
					
					echo get_field('event_showed' ,  $lead->ID); 
					//echo get_field('event_showed' ,  $lead->ID);
					
					
					?> Showed Up
				

				
				
				
				<div class='clearfix'></div>
			</div>	
		
	
				
			
				<?php
				

?>
	</div>
						
			
						
						
						</div>
						
						
									<div class='clearfix'></div>
									
									
									<a href='/?p=<?php echo $lead->ID; ?>' class='btn btn-info btn-lg btn-block'>View Details >></a>
				<hr><hr>
						<?php
					}
					
					$past = 0;
		
		?>
	
		 			
	 
	<?php //foreach( $emails as $email){ echo $email . "; "; } ?>
	
	<?php //get_template_part('home-members'); ?>
	
	<?php //get_template_part('content-party-people'); ?>
	
	<?php //get_template_part('content-dl-people'); ?>
 
<hr>

	</div>

	
	
		
		
</div>
<?php
get_footer(); ?>