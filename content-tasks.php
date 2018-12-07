<div class='clear'></div>



<?php	
			


	/*********************************************************/


			// The Query

			//$leads2 = get_posts( array( 'post_type' => 'to_do', 'posts_per_page' => -1 ) );

			$count = 1 ;
			//print_r( $leads2 );


			foreach( $leads2 as $lead ){
					

					$public = 1;

					
					
					//echo "<hr>";
					//echo "-->" . strcmp( $lead["24"] , "Private Request (will NOT be shown on the website)" );

					//echo "<div class='row'><div class='col-md-6'>";
					//echo "<div class='col-md-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>
					
	<div class='well col-md-6 taskcard'>
		<h1></h1>
		<div class='col-md-8 '>
		
		</div>
		<div class='col-md-4 '>
		
		</div>
		<div class=' header'>
				<div class='col-md-9'>
					<b>Task</b>
				</div>
				<div class='col-md-3'>
					<b>Date</b>
				</div>
				<div class='clear'></div>
		</div>		
				<div class='col-md-9'><?php if($lead->post_title){ echo $lead->post_title; }else{ echo 'New Request'; } ?></div>
				<div class='col-md-3'> <?php echo mysql2date('n/j/y', $lead->post_date ); ?><span class='pull-right'><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span></div>
				<div class='clear'></div><hr>
			<?php 
				$recent_author = get_user_by( 'ID', $lead->post_author );
			
			
			?>
				
			<div class='col-xs-4' >
				<b>Posted By: </b><br> <?php echo $recent_author->display_name; ?> 
			</div>
			<div class='col-xs-3' >
				<b>Assigned To: </b><br> <?php echo get_field( 'assigned_to', $lead->ID ); ?> 
			</div>	
			 <div class='col-md-3'><a target='_blank' href='<?php echo "/apply?title=" . $lead->post_title ; ?>' class='btn btn-default btn-block'>Claim</a></div>
			

			
			<form method="post" action="" class=' hidden'>
				<button name="task_complete" type="submit" class='btn btn-success btn-block' value="Remove Lead" />Completed!</button>
				
				<input  type="hidden" name="trans_date" value="<?php echo current_time( 'm/d/y' ); ?>" >
				<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
				<input name="task_complete" type="hidden" value="true" />
				<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
			</form>
			
			
			<div class='col-md-2'>
				<button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'> >>> </button>
			</div>
			
			<br><br>
			<div id='details<?php echo $lead->ID; ?>' class='details goal' style='display: none;' >
				<?php

					echo "";
					
					?>
					
					<div class='col-xs-12 text-center title' ><b>Task Goals </b> </div><div class='clear'></div>
					<div class='col-xs-4' ><b>Date: </b> <?php echo  get_field( 'target_date', $lead->ID , 1  ) ?> </div>
					<div class='col-xs-4' ><b>Hrs: </b> <?php echo  get_field( 'target_hours', $lead->ID  , 1 ) ?> </div>
					<div class='col-xs-4' ><b>Budget: </b> $<?php echo  get_field( 'target_budget', $lead->ID , 1 ) ?> </div>


				<?php
					echo "<div class='clear'></div><br>";
					echo "<div class='col-xs-12' ><b>Notes: </b> " . $lead->post_content . "</div>";
					
					echo "<div class='clear'></div><br>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default'>Edit Request</a>";

					echo "<a target='_blank' href='/apply?title=" . $lead->post_title . "' class='btn btn-default'>Apply Now!</a>";


					
					?>
					<br>
					
			</div><hr>
					<?php
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published

					?>
					
			
		<div class='col-md-12'>
			<form method="post" action="" class=''>
				<button name="task_complete" type="submit" class='btn btn-success btn-block' value="Remove Lead" />Completed!</button>
				
				<input  type="hidden" name="trans_date" value="<?php echo current_time( 'm/d/y' ); ?>" >
				<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
				<input name="task_complete" type="hidden" value="true" />
				<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
			</form>
		</div>	
				
	</div>	
					<?php 
					
					
					
					
				}else{  echo "Private<hr><br>" ; } 
					if( ($count++ % 2) == 0){ echo "<div class='clear'></div>";}
				}
				echo "<br><br>";
				//print_r( $leads );


			// Reset Query
			wp_reset_query();


/*********************************************************/
?>
	<div class='clear'></div>
	

		<h3><center>Pending</center></h3>
		<hr><hr>

		<div id='latest'></div>
		
		
<?php	

	/*********************************************************/
			// The Query

			$leads2 = get_posts( array( 'post_type' => 'ssi_tasks', 'posts_per_page' => -1 , 'order' => 'desc' ) );


			//print_r( $leads2 );


			foreach( $leads2 as $lead ){
					

					$public = 1;

					
					
					//echo "<hr>";
					//echo "-->" . strcmp( $lead["24"] , "Private Request (will NOT be shown on the website)" );

					//echo "<div class='row'><div class='col-md-6'>";
					//echo "<div class='col-md-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>
					<div class='col-xs-2 col-md-2'><b>Date:</b><br> <?php echo mysql2date('n/j/y', $lead->post_date ); ?><span class='pull-right'><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span></div>
					<div class='col-xs-4 col-md-4'><b>Task:</b><br> <?php if($lead->post_title){ echo $lead->post_title; }else{ echo 'New Request'; } ?></div>
					<div class='col-xs-2 col-md-2' ><b>Hrs:</b><br><?php echo  get_field( 'target_hours', $lead->ID ) ?> </div>
					<div class='col-xs-2 col-md-2' ><b>Budget: </b> $<?php echo  get_field( 'target_budget', $lead->ID ) ?> </div>
					<div class='col-md-2 '>
					<b>Assigned To:</b> <?php echo  get_field( 'assigned_to', $lead->ID ) ?> <br>
					<?php 
						if(get_field( 'task_approved', $lead->ID ) == "Yes"){
							
							echo "-- Approved!";
						}else{
							echo "-- Pending";
						}
					?>
					
					<button id='task-details<?php echo $lead->ID; ?>' class='btn btn-default btn-block hidden-print'>Details >></button>
					
					
					
					</div>
					

					<br><br>
					<div class='clear'></div>
					<div id='task-details<?php echo $lead->ID; ?>' class='details well' style='display: none;' >
					
				<?php


					?>
					
					<center>Completion Goals</center><hr>
					
					<div class='col-xs-4' ><b>Date: </b> <?php echo  get_field( 'target_date', $lead->ID ) ?> </div>
					<div class='col-xs-4' ><b>Hrs: </b> <?php echo  get_field( 'target_hours', $lead->ID ) ?> </div>
					<div class='col-xs-4' ><b>Budget: </b> $<?php echo  get_field( 'target_budget', $lead->ID ) ?> </div>

			<div class='clear'></div><br>
			<div class='col-xs-12' >
				<b>Project: </b><?php echo get_field( 'assigned_project', $lead->ID ); ?> 
			</div>
			<div class='clear'></div><br>
			<div class='col-xs-12' >
				<b>Assigned To: </b><?php echo get_field( 'assigned_to', $lead->ID ); ?> 
			</div>

				<?php
					echo "<div class='clear'></div><br>";
					echo "<div class='col-xs-12' ><b>Description: </b> " . $lead->post_content . "</div>";
					
					echo "<div class='clear'></div><br>";
					
					?>
					<div class='col-md-12 '><a target='_blank' href='/admin/to-do/?ID=<?php echo $lead->ID ; ?>&approved=1' class='btn btn-success btn-block'>Approve >></a></div>
					<?php
					echo "<div class='clear'></div><hr>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default'>Edit Request</a>";

					//echo "<a target='_blank' href='/apply?title=" . $lead->post_title . "' class='btn btn-default'>Apply Now!</a>";
?>


				<br>
				<?php 
				
				$user_logged_in = 0;
				$user_is_admin = 0;
			$user = wp_get_current_user();
			$allowed_roles = array('editor', 'administrator');
		

					
			if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {
					$user_logged_in = 1;
					$user_is_admin = 1;
					?>
					<br>
		<form method="post" action="" class='pull-left'>
			<button name="update" type="submit" class='btn btn-danger' value="Remove Lead" />Delete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="post_to_draft" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>

		<a target='_blank' href='/wp-admin/post.php?post=<?php echo $lead->ID ; ?>&action=edit' class='btn btn-default pull-left'>Edit Lead</a>
		
			<?php } ?>
							
							
							
		<form method="post" action="" class=''>
			<button name="task_complete" type="submit" class='btn btn-success ' value="Remove Lead" />Completed!</button>
			
			<input  type="hidden" name="trans_date" value="<?php echo current_time( 'm/d/y' ); ?>" >
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="task_complete" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
		
		
	
		
<?php 
					echo "<br></div><hr>";
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 
					
				}
				echo "<br><br>";
				//print_r( $leads );


			// Reset Query
			wp_reset_query();


/*********************************************************/
?>
	<div class='clear'></div>	
	
			<br><br>
		<h3><center>Completed</center></h3>
		<hr><hr>

		<div id='latest'></div>
		
		
<?php	

	/*********************************************************/
			// The Query

			$leads3 = get_posts( array( 'post_type' => 'to_do','post_status' => 'draft', 'posts_per_page' => -1 ) );


			//print_r( $leads2 );
			$total_tasks = 0;
			$total_hours = 0;
			$total_budget = 0;

			foreach( $leads3 as $lead ){
					

					$public = 1;

					
					
					//echo "<hr>";
					//echo "-->" . strcmp( $lead["24"] , "Private Request (will NOT be shown on the website)" );

					//echo "<div class='row'><div class='col-md-6'>";
					//echo "<div class='col-md-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					
					?>
					<div class='col-xs-3 col-md-2'><b>Date:</b><br> <?php echo mysql2date('n/j/y', $lead->post_date ); ?><span class='pull-right'><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span></div>
					<div class='col-xs-6 col-md-6'><b>Task:</b><br> <?php if($lead->post_title){ echo $lead->post_title; }else{ echo 'New Request'; } ?></div>
					<div class='col-xs-3 col-md-2' ><b>Hrs:</b><br><?php echo  get_field( 'target_hours', $lead->ID ) ?> </div>
					<div class='col-md-2'><button id='task-details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>Details >></button></div>
					

					<br><br>
					
					<div id='task-details<?php echo $lead->ID; ?>' class='details well' style='display: none;' >
					
				<?php


					?>
					
					<div class='clear'></div><center>Completion Goals</center><hr>
					
					<div class='col-xs-4' ><b>Date: </b> <?php echo  get_field( 'target_date', $lead->ID ); ?> </div>
					<div class='col-xs-4' ><b>Hrs: </b> <?php echo  get_field( 'target_hours', $lead->ID );
					$hours = get_field( 'target_hours', $lead->ID );
					$total_hours += $hours;
					?> </div>
					<div class='col-xs-4' ><b>Budget: </b> $<?php echo  get_field( 'target_budget', $lead->ID ); 
					
					$budget = get_field( 'target_budget', $lead->ID );
					$total_budget += $budget;
					
					$total_tasks += 1;
					?> </div>

			<div class='clear'></div><br>
			<div class='col-xs-12' >
				<b>Assigned To: </b><?php echo get_field( 'assigned_to', $lead->ID ); ?> 
			</div>

				<?php
					echo "<div class='clear'></div><br>";
					echo "<div class='col-xs-12' ><b>Description: </b> " . $lead->post_content . "</div>";
					
					echo "<div class='clear'></div><br>";
					
					?>
				
					<?php
					echo "<div class='clear'></div><hr>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default'>Edit Request</a>";

					
?>


					 <br></div><hr>
					<?php
					//print_r( $lead );
					//echo "<hr>";
					
				}else{  echo "Private<hr><br>" ; } 
					
				}
				//echo "<br><br>";
				//print_r( $leads );


			// Reset Query
			wp_reset_query();


/*********************************************************/
?>

<div class='clear'></div>
					<div class='col-xs-3 col-md-2'>Totals:</div>
					<div class='col-xs-6 col-md-6'><?php echo $total_tasks; ?> Tasks</div>
					<div class='col-xs-3 col-md-2' ><?php echo $total_hours; ?> Hrs</div>
					<div class='col-md-2'>$<?php echo $total_budget; ?> paid</div>
<div class='clear'></div><hr>

<button id='addnew' class='btn btn-block btn-lg btn-info container'>Add New</button><br>
<div id='addnew' class='addnew clear' style='display: none;'>

<form method="post" action="" name="add_task">
<div class='well col-md-6 taskcard'>

	<div class='col-md-12'>
		<b>Task</b><br>
		<input type="text" name="trans_service" placeholder="Your task here... " >
	</div>
	<div class='clear'></div><br>
	<div class='col-md-12'>
		<b>Project</b><br> 
		
		<select name="assigned_project" style='width: 100%;'>
		
			<option value="-">No Project</option>
			<?php
					$projects = get_posts( array('post_type' => 'ssi_projects', 'posts_per_page' => -1, 'orderby' => 'modified') );
					
					
					foreach( $projects as $lead ){
						
						?>
						
						
						<option value="<?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?>"><?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?></option>
						<?php
					}
						
				?>
			</select>
	</div>
	<div class='clear'></div><hr>
	
	<div class='col-sm-3 hidden ' >
				<b>Posted By: </b><br> <?php 
				$author = wp_get_current_user();
				//$recent_author = get_current_user( 'ID', $lead->post_author );
				//print_r($author);
				
				
				echo $author->user_nicename; ?> 
				<div class='clear'></div><br>
			</div>
			<div class='col-sm-4' >
				<b>Assigned To: </b><br> <select name="assigned_to" style='width: 100%;'>
					
					<option value="all">All</option>
				<?php

					foreach( $staff as $lead ){
						
						?>
						<option value="<?php echo $lead->post_name; ?>"><?php echo $lead->post_title; ?></option>
						<?php
					}
						
				?>
					
					
					
				</select> 
				<div class='clear'></div><br>
			</div>	
			 <div class='col-sm-4'>
			 
				<div class='col-xs-9'>
					<input type="text" name="target_hours" placeholder=".25" >
				</div>
				<div class='col-xs-3'>
					Hrs
				</div>
				<div class='clear'></div><br>
			 </div>
			 
			<div class='col-md-4'>
				<input type="text" name="target_budget" placeholder="$$$" >
				<div class='clear'></div><br>
			</div>
		<div class='clear'></div><br>
		<div class='col-md-6'>
		<b>Start Date</b><br>
		<input  type="text" name="trans_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
	</div>
		<div class='col-md-6'>
		<b>Target Date</b><br>
		<input  type="text" name="target_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
	</div>
	<div class='clear'></div><br>
		<b>Notes:</b>
		<textarea name="notes" id="" cols="30" rows="3"></textarea>
			<input type="submit" class="btn btn-block">
	
</div>	

<input type="hidden" name="trans_time" placeholder="Time" value="<?php echo current_time( 'g:i' ); ?> pm" >
				<input type="hidden" name="client_name" value="<?php echo $lead->post_title; ?>">
				<input type="hidden" name="client_city" value="<?php echo get_field( 'lead_city', $lead->ID ); ?>">
				<input type="hidden" name="client_phone" value="<?php echo get_field( 'lead_phone', $lead->ID ); ?>">
				<input type="hidden" name="client_state" value="<?php echo get_field( 'lead_state', $lead->ID ); ?>">
				
				<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
				<input name="client_id" type="hidden" value="<?php echo $lead->ID; ?>" />

				<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
				<input type='hidden' name='insert_task' value='true'>
				<input type='hidden' name="update" value='true'>



</form>
	
</div>