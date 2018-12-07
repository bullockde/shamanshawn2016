<?php
	$staff = get_posts( array( 'post_type' => 'ssi_staff', 'posts_per_page' => -1 , 'order' => 'desc') );
	
	$tasklists = get_posts( array( 'post_type' => 'ssi_tasklists', 'posts_per_page' => -1 , 'order' => 'desc') );
?>
	
<center><button id='newgoal' class='btn btn-info '> >> New Goal << </button></center><br>
<div id='newgoal' class='addnew clear' style='display: none;'>

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
	<div class='clear'></div><br>
		<div class='col-md-12'>
						<b>Mission</b><br> 
						
						<select name="assigned_mission" style='width: 100%;'>
						
							<option value="-">No Mission</option>
							<?php
								

									foreach( $tasklists as $lead ){
										
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

<div class='clear'></div>

<div id='staff' class='staff '>

<?php

	

	foreach( $staff as $lead ){
		
		
		$person = $lead->post_name;
		
		$current_user = wp_get_current_user();
		
		if(!empty($_GET['person'])){ $current_user = $_GET['person']; }else{
			
			$current_user = $current_user->user_nicename;
		}
		
		
		
		if( $person != $current_user ){ continue; }
		
	//	echo $author->display_name;
		
		?>
		<div class='name col-md-6 col-md-offset-3'>


			
	<?php
		$count = 1;
	
		$num = 10;
	//	if( is_page('tasklist') ){ $num = 10; }
	
	$tasks = get_posts( array( 'post_type' => 'ssi_tasks', 'posts_per_page' => $num, 'order' => 'DESC', /*'orderby'=> 'meta_value_num', 'meta_key' => 'target_date' */ ) );

	foreach( $tasks as $task ){
		
		

		if( 1 /* get_field( 'assigned_to', $task->ID ) == $person */ ){ 
				if( $count++ > $num )continue; 
		?>
		
		
<div class='well mini taskcard report text-center1 hidden1'>



		<div class=' header text-center'>
				<b><u>Task</u></b><br>
				<?php if($task->post_title){ echo $task->post_title; }else{ echo 'New Request'; } ?>

		</div>		
				
		<div class='clear'></div><hr>
			<div class='col-xs-6 text-center'>
				<u>Created</u><br>
				<?php echo mysql2date('n/j/y', $task->post_date ); ?>
			</div>
			<div class='col-xs-6 text-center'>
				<u>Deadline</u><br>
				<?php echo mysql2date('n/j/y', get_field( 'target_date', $task->ID ) ); ?>
			</div>
		<div class='clear'></div>
		
		<div id='details<?php echo $task->ID; ?>' class='' style='display: block;' >		
				<div class='clear'></div><hr>
				<button id='details<?php echo $task->ID; ?>' class='btn btn-success btn-default btn-block'> Details >> </button>
		</div>
		
		<div id='details<?php echo $task->ID; ?>' class='details goal' style='display: none;' >
				<?php

					echo "";
					
					?>
					
					<div class='col-xs-12 text-center title' ><b>Task Goals </b> </div><div class='clear'></div>
					<div class='col-xs-4' >
						<b>Date: </b> 
					<!--	<input  type="text" name="target_date" value="<?php echo  get_field( 'target_date', $task->ID , 1  ) ?>" >-->
						<?php echo  get_field( 'target_date', $task->ID , 1 ) ?> 
					</div>
					<div class='col-xs-4' >
						<b>Hrs: </b> 
					<!--	<input  type="text" name="target_hours" value="<?php echo  get_field( 'target_hours', $task->ID , 1  ) ?>" >-->
						<?php echo  get_field( 'target_hours', $task->ID , 1 ) ?> 
						</div>
					<div class='col-xs-4' >
						<b>Budget: </b>
						$<!--<input  type="text" name="target_budget" value="<?php echo  get_field( 'target_budget', $task->ID , 1  ) ?>" >-->
						<?php echo  get_field( 'target_budget', $task->ID , 1 ) ?> </div>


				<?php
					echo "<div class='clear'></div><br><br>";
					
					$content = $task->post_content;
					
					$content = apply_filters('the_content', $content);
					
					//echo "<div class='col-xs-12 text-left' ><b><u>Notes</u></b><br>" . $content . "";
			?>
			<div class='col-xs-12 text-left' >
				<b><u>Notes</u></b><br>
				
				<?php echo $content; ?>
			<form method='post'>	
				<textarea name="post_content" placeholder="More notes .."></textarea>
				
				<input type='hidden' name='ID' value='<?php echo $task->ID; ?>'>
				<input type='hidden' name='ssi_update_cf' value='1'>
				<input type='submit' value='Add Notes'>
			</form>
			</div>
			<div class='nav text-center'>
			<?php
					echo "<div class='clear'></div><br>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $task->ID . "&action=edit' class='btn btn-default'>Edit Request</a>";
			?>
				<button id='details<?php echo $task->ID; ?>' class='btn btn-default '> x close </button>
			<?php
					//echo "<a target='_blank' href='/apply?title=" . $task->post_title . "' class='btn btn-default'>Apply Now!</a>";

					?>
			</div>
			<div class='clear'></div><br>
					
			</div>

<div id='details<?php echo $task->ID; ?>' class='' style='display: none;' >			
		<form method="post" action="" class=''>
			<button name="task_complete" type="submit" class='btn btn-success btn-block btn-lg' value="Remove Lead" />Completed!</button>
			
			<input  type="hidden" name="trans_date" value="<?php echo current_time( 'm/d/y' ); ?>" >
			<input name="ID" type="hidden" value="<?php echo $task->ID; ?>" />
			<input name="task_complete" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
</div>		
		
		
</div>
			<div class='clear'></div>
			
			
			

		<?php }//end if

	}//end foreach
	?>

	</div>
	
	
	

		
		<?php 	}	?>


</div>
