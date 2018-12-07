<div class=' text-center hidden1'>


		<button id='newparty' class=' text-center hidden1'>New Event</button>
		
	<div class="clear"></div><br>
	

	<div id='newparty' style='display: none;'>
			
			<hr>
	<div class='col-sm-10 col-sm-offset-1 text-center hidden1 well'>		
		<form method='post'>
				<h3><input type='text' name='post_title' placeholder='Event Title' required><hr></h3>
				
				<div class='col-sm-6 '>	
					<?php //echo get_the_post_thumbnail($lead->ID); ?>
					<img src='http://shamanshawn.com/wp-content/uploads/SSI-Logo-Banner-New-QR-940x635.png'>
					
				<div class="event-info h4">
					<div class='clear'></div><br>
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
					<div class='clear'></div>
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
						<div class='clear'></div>
			
			<input type='hidden' name='new_event' value='true'>
			<input type='submit' value='Submit' class='btn btn-lg btn-success btn-block' style='padding: 1em; '>
								
								
				<img src='<?php echo get_field( 'event_flyer', $lead->ID ); ?>' class=' img-responsive'>	
			</form>					
		</div>	
	</div>
</div>