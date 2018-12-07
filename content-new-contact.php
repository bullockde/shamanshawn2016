
<div id='newpost' class='clear' style='display: none;'>

<?php /*$lead = get_post(11975);*/ ?>
<div class='well contact taskcard'>
		<div class='col-md-2 text-center'> Name </div>
		<div class='col-md-3 text-center'> Email </div>
		<div class='col-md-2 text-center'> Phone# </div>
		<div class='col-md-2 text-center'> City </div>
		<div class='col-md-1 text-center'> State </div>
		<div class='col-md-2 text-center'> &nbsp; </div><br>
		<div class='clear'></div>
	<form method="post" action="">		
		<div class='clear'></div>
					<div class='col-md-2'> 

						<input type="text" name="post_title" value="John Doe">

					</div>
					<div class='col-md-3'>
						
						<input type="text" name="update_lead_email" placeholder="Email" placeholder="<?php echo get_field( 'lead_email', $lead->ID ); ?>">

					</div>
					<div class='col-md-2'>
						
						<input type="text" name="update_lead_phone" placeholder="1-555-555-5555">

					</div>
					<div class='col-md-2'>
	
						<input type="text" name="update_lead_city" placeholder="Philadelphia">

					</div>
					<div class='col-md-1'>

						<input type="text" name="update_lead_state" placeholder="PA">

					</div>
					<div class='col-md-2'>
					
						<select name="site">
								<option value="">Contact Type</option>
								<option value="client">Client</option>
								<option value="family">Family</option>
								<option value="friend">Friend</option>
								<option value="lead">Lead</option>
						
					
								<option value="other">Other</option>
						</select>
			
		


					</div>
					
<div class='clear'></div>
	
	<br><br><div id='details' class='details' style='display: block;'>	
				
					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>


				<div class='col-sm-4' >
					<b>Last Seen: </b> 
					
					<input type="text" name="update_last_seen" placeholder="Last Seen" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Last Contacted: </b> 
					
					<input type="text" name="update_last_contacted" placeholder="Last Contacted" placeholder="<?php echo date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ); ?>" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Added: </b> 

					<input type="text" name="update_date_added" placeholder="Date Added" placeholder="<?php echo mysql2date('n/j/y', $lead->post_date ); ?>" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				
				<div class='clear'></div>
				<hr>
				
				<div class='info'>
				<u>Details</u><br>
				
				<b>Area Code: </b> <input type="text" name="update_area_code" placeholder="Area Code" placeholder="<?php echo get_field( 'area_code', $lead->ID ); ?>">
				

				<b>D.O.B: </b> <input width="100" type="text" name="update_dob" placeholder="D.O.B" placeholder="<?php echo get_field( 'lead_dob', $lead->ID ); ?>">
				
				</div>

			<div class='clear'></div>
				

</div>

<div class='clear'></div>
<div class='well '>

	<div id='addsocial<?php echo $lead->ID; ?>' style='display: block;'>
		<div class='clear'></div><hr>
		ADD SOCIAL FORM
		
		
		<select name="site">
				<option value="">Social</option>
		
	<?php 
		foreach( $social as $site => $link ){				
	?>		
				<option value="<?php echo $site; ?>"><?php echo $site; ?></option>
		
	<?php 		
		}
	?>
				<option value="other">Other</option>
		</select>
			
			

			<input type="text" name="username">
			
		
	</div>
	<div class='clear'></div>
</div>

	<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
<br>
	<button name="ssi_new_contact" type="submit" class='btn btn-info btn-lg pull-right' value="True" />Add Contact</button>
	
	</form>						

<div class='clear'></div>

</div><!-- END Well Contact-->

	<hr>
</div>