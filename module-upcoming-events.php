<div class=' text-center'>


<div class="clear"></div>
	
	<h4> Upcoming Events </h4><hr>
	

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
	<div class='clearfix'></div>
		<div class='col-sm-10 col-sm-offset-1 text-center well hidden'>		
			
				<h3><?php echo $lead->post_title; ?><hr></h3>
				
				<div class='col-sm-6 '>	
					<?php echo get_the_post_thumbnail($lead->ID); ?>
				
				</div>
				<div class='col-sm-6 '>			
					<div class='clearfix'></div><br>
					
					<div class='col-xs-6 '>
						<h3><u>Date</u></h3>

						<?php date_default_timezone_set("America/New_York"); 

						echo date("M jS", strtotime(get_field('event_date', $lead->ID)));
						?> 
														
														
					</div>
					<div class='col-xs-6 '>
						<h3><u>Time</u></h3>
						<?php echo get_field( 'event_time', $lead->ID ); ?>
					</div>
					<div class='clear '></div><br>
						
						<h3><u>Location</u></h3> 
						<?php echo get_field( 'event_location', $lead->ID ); ?>
									
						<br><br>
				
				<br>
				<h4><?php echo get_field( 'event_price' , $lead->ID); ?></h4>
			

				<div class='clearfix'></div><hr>
					
						<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-rsvp btn-info btn-lg btn-block'><br> Full Details >><br><br></a>
				
						<div class='clearfix'></div>
				
				</div>
						<div class='clearfix'></div>
				
				
				<img src='<?php echo get_field( 'event_flyer', $lead->ID ); ?>' class=' img-responsive'>	
						<div class='clearfix'></div>
		</div>					
				<div class='col-sm-10 col-sm-offset-1 text-center well'>		
			
				<h3><?php echo $lead->post_title; ?></h3>
				<div class='clearfix'></div><hr>
				<div class='col-sm-2 '>	
					<?php echo get_the_post_thumbnail($lead->ID); ?>
					<br><br>
				</div>
				<div class='col-sm-7 '>			
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
					<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-rsvp btn-info btn-lg btn-block'><br> Full Details >><br><br></a>
				
				</div>
						<div class='clearfix'></div>
				
				
				<img src='<?php echo get_field( 'event_flyer', $lead->ID ); ?>' class=' img-responsive hidden'>	
						
		</div>					
			
			
			
			<div class='clearfix'></div>	
		
						
						
						<div class='clearfix'></div>
						
					
			<div class='well container h4 hidden'>
						<div class='text-center'>

				
				
				<div class='col-xs-3 '><h3>Date</h3></div>
				
				<div class='col-xs-6 '><h3>Event</h3></div>
							
				<div class='col-xs-3'><h3>RSVP's</h3></div>

				
				
				
				<div class='clearfix'></div>
		

<?php 

				$current_party_date = '';
				$count = 1;
				
				


				// check if the repeater field has rows of data
				if( have_rows('party_stats' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('party_stats',  $lead->ID ) ) : the_row();
				
				?>
				<?php if($count > 1){ continue; } ?>
				<hr>
			<div class='<?php if($count == 1){ echo "h2 current-party"; } ?> '>
				
				<div class='col-xs-3 '><?php echo get_field('event_date' ,  $lead->ID); ?></div>
				<div class='col-xs-6 '>
					<?php echo $lead->post_title; ?>
						
				</div>
				
				<div class='col-xs-3'>
					<?php echo get_field('event_rsvps' ,  $lead->ID); ?>
				</div>
				
			
				<div class='clearfix'></div>
			</div>	
		
	
				
			
				<?php
				    endwhile;

				else :

				     // no rows found

				endif;
				
				
				

?>
	</div>
						
			
						
						
						</div>
						
						
								
								<?php
		}
					
					$past = 0;
		
		?>
	
		<?php get_template_part('content','new-event'); ?>	
</div>	
	
	
	