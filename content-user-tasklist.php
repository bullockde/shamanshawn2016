<?php
	//$staff = get_posts( array( 'post_type' => 'ssi_staff', 'posts_per_page' => -1 , 'order' => 'ASC') );
	
	$tasks = get_posts( array( 'author' => $_GET["ID"] , 'post_type' => 'ssi_tasks', 'post_status' => 'publish' , 'posts_per_page' => -1, 'order' => 'DESC' ) );
?>
	<div class='clearfix'></div><hr>


<div id='staff' class='staff'>

<?php

	$person = 0;
	$current_user = 0;
	
	if( !empty($_GET['ID']) ){ 
	
		$current_user = get_userdata( $_GET['ID'] ); 
		//print_r($current_user);

	}else{ 
	
		$current_user = wp_get_current_user(); 
		
	
	}
	
	
	

	if( get_user_meta($current_user->ID , 'ssi_tasklist_ID' , true ) ){
		
		//echo "TaskilistID=" . get_field( 'ssi_tasklist_ID', $_GET['ID'], 1 );
		$tasklistID = get_field( 'ssi_tasklist_ID', $_GET['ID'], 1 );
		$tasklistID  = get_user_meta($current_user->ID , 'ssi_tasklist_ID' , true );
		
		$person = get_post( $tasklistID );
		//print_r($person->post_name);
		$person = $person->post_name;
		
		$leads = get_posts( array( 'post_type' => 'ssi_tasks', /*'orderby'=> 'meta_value_num', 'meta_key' => 'target_hours' ,*/'posts_per_page' => -1, 'order' => 'ASC' ) );
		
		$leads = get_posts( array( 'post_type' => 'ssi_tasks', 'post_status' => 'draft' , 'posts_per_page' => -1, 'order' => 'DESC' ) );
		
	}else{
		if( !empty($_GET['person']) ){ $person = $_GET['person']; }
		?>
		
		<form  class='hidden'>
		
				<div class='col-sm-12' >
					Create New Tasklist
				</div>
			<div class='col-sm-12' >
					<b>Tasklist ID: </b> 
					
					<input type="text" name="ssi_tasklist_ID" placeholder="Enter ID" value="<?php echo get_user_meta($current_user->ID , 'ssi_tasklist_ID' , true ); ?>">
			</div>
				<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
			<button name="ssi_update_cf" type="submit" class='btn btn-info btn-block' value="Update" />Update</button>
		</form>
		<?php
	}
	$staff_budget = 0;
	
	?>
		<div class='col-xs-2 '> 
		<b>Date:</b>
	</div>
	<div class='col-xs-4 col-sm-3'>
		<b>Task:</b>
	</div>
	<div class='col-xs-2 text-center '>
		<b>Hr(s):</b>
	</div>
	<div class='col-xs-2 '>
		<b>Budget:</b>
	</div>
	<div class='col-xs-2 '>
		<b>Finish By:</b>
	</div>
					
					
		
		<div class='clearfix'></div><hr>
	
	
	<?php
	foreach( $tasks as $lead ){
		
		if( $person  != $lead->post_name ){ 
				//continue; 
		}
	//	echo $author->display_name;
		
		?>
<div class='name col-md-12 '>

		


			
	<?php
		$count = 1;

		
		if( $GET['type'] == 'tasklist' ){ $is_tasklist = 1; }
	
	

	//foreach( $leads as $lead ){

		if( get_field( 'assigned_to', $lead->ID ) == $person ){ 
				//if( $count++ > 3 )continue; 
		?>
		
		<div class='col-xs-2'> <?php echo mysql2date('n/j/y', $lead->post_date ); ?><span class='pull-right'><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span></div>
					<div class='col-xs-4 col-sm-3'><?php if($lead->post_title){ echo $lead->post_title; }else{ echo 'New Request'; } ?></div>
					<div class='col-xs-2 text-center'><u><?php 
						echo get_field( 'target_hours', $lead->ID );
						
					?></u></div>
					<div class='col-xs-2'>
					
					-- $<?php 
							$budget = get_field( 'target_budget', $lead->ID );
							
							echo $budget;
							
							$staff_budget += $budget;
					?></div>
					<div class='col-xs-2'><?php 
						echo get_field( 'target_date', $lead->ID );
						
					?></div>
					<div class='col-sm-1 hidden-xs'><button id='details3<?php echo $lead->ID; ?>' class='btn btn-default btn-block'> >> </button></div>
					
		
		<div class='clearfix'></div><hr>
				<div id='details3<?php echo $lead->ID; ?>' class='details goal' style='display: none;' >
				<?php

					echo "";
					
					?>
					
					<div class='col-xs-12 text-center title' ><b>Task Goals </b> </div><div class='clearfix'></div>
					<div class='col-xs-4' >
						<b>Date: </b> 
						<input  type="text" name="target_date" value="<?php echo  get_field( 'target_date', $lead->ID , 1  ) ?>" >
					 
					</div>
					<div class='col-xs-4' >
						<b>Hrs: </b> 
						<input  type="text" name="target_hours" value="<?php echo  get_field( 'target_hours', $lead->ID , 1  ) ?>" >
						
						</div>
					<div class='col-xs-4' >
						<b>Budget: </b>
						$<input  type="text" name="target_budget" value="<?php echo  get_field( 'target_budget', $lead->ID , 1  ) ?>" >
					</div>


				<?php
					echo "<div class='clearfix'></div><br><br>";
					
					$content = $lead->post_content;
					
					$content = apply_filters('the_content', $content);
					
					//echo "<div class='col-xs-12 text-left' ><b><u>Notes</u></b><br>" . $content . "";
			?>
			
			<div id='forms' style='display: block;'>
				<div class='clearfix'></div><br><hr>
			
			<h3 class=''>Forms</h4>
			<br>
			
			
							<?php 

				// check if the repeater field has rows of data
				if( have_rows('ssi_forms_uploader' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('ssi_forms_uploader', $lead->ID ) ) : the_row();
				
				?>

			       <div class='col-xs-2 text-center'>
				   <a href='<?php the_sub_field('ssi_form_upload'); ?>' target='_blank'> <img src='http://shamanshawn.com/wp-includes/images/media/document.png' class=''><br><br>
				   (<?php echo get_sub_field('ssi_form_date'); ?>)
				   <br><?php the_sub_field('ssi_form_title'); ?></a>
				   </div>
						
				
				
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;

?>

<div class='clearfix'></div>
				<hr>

					<div class='col-xs-2'>
						<img src='<?php echo get_field( 'file_1', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<div class='col-xs-2'>
						<img src='<?php echo get_field( 'file_2', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<div class='col-xs-2'>
						<img src='<?php echo get_field( 'file_3', $lead->ID ); ?>' class='img-responsive'>
					</div>
					
					
						<div class='clearfix'></div><br>		
	
		</div>
		
		
		
					<div id='forms' style='display: block;'>
				<div class='clearfix'></div><br><hr>
			
			<h3 class=''>Forms</h4>
			<br>
			
			
							<?php 

				// check if the repeater field has rows of data
				if( have_rows('ssi_forms_uploader' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('ssi_forms_uploader', $lead->ID ) ) : the_row();
				
				?>

			       <div class='col-xs-2 text-center'>
				   <a href='<?php the_sub_field('ssi_form_upload'); ?>' target='_blank'> <img src='http://shamanshawn.com/wp-includes/images/media/document.png' class=''><br><br>
				   (<?php echo get_sub_field('ssi_form_date'); ?>)
				   <br><?php the_sub_field('ssi_form_title'); ?></a>
				   </div>
						
				
				
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;

?>

<div class='clearfix'></div>
				<hr>

					<div class='col-xs-2'>
						<img src='<?php echo get_field( 'file_1', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<div class='col-xs-2'>
						<img src='<?php echo get_field( 'file_2', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<div class='col-xs-2'>
						<img src='<?php echo get_field( 'file_3', $lead->ID ); ?>' class='img-responsive'>
					</div>
					
					
						<div class='clearfix'></div><br>		
	
		</div>
		
			<div class='col-xs-12 text-left' >
				<b><u>Notes</u></b><br>
				
				<?php echo $content; ?>
			<form method='post'>	
				<textarea name="post_content" placeholder="More notes .."></textarea>
				
				<input type='hidden' name='ID' value='<?php echo $lead->ID; ?>'>
				<input type='hidden' name='ssi_update_cf' value='1'>
				<input type='submit' value='Add Notes'>
			</form>
			</div>
			<div class='nav text-center'>
			<?php
					echo "<div class='clearfix'></div><br>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default'>Edit Request</a>";
			?>
				<button id='details<?php echo $lead->ID; ?>' class='btn btn-default '> x close </button>
			<?php
					//echo "<a target='_blank' href='/apply?title=" . $task->post_title . "' class='btn btn-default'>Apply Now!</a>";

					?>
			</div>
			<div class='clearfix'></div><br>
					

<div id='details3<?php echo $lead->ID; ?>' class='' style='display: none;' >			
		<form method="post" action="" class=''>
		
			<button name="task_complete" type="submit" class='btn btn-success btn-block btn-lg' value="Remove Lead" />Completed!</button>
			
			<input  type="hidden" name="trans_date" value="<?php echo current_time( 'm/d/y' ); ?>" >
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="task_complete" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
		
		<div class='clearfix'></div><hr>
</div>		
		
		
</div>
			<div class='clearfix'></div>
		

		
		<?php

		}//end if

//	}//end foreach
	
	
	//echo "Total $ " . $staff_budget;
	?>

	</div>
		
		<?php 	}	?>



	<div class='clearfix'></div>

	
	
	<br><hr>
	
	
	<div id='Completed' class='tasks' style='display: none;'>
COMPLETED::
<?php

	
	$staff_budget = 0;
	
	$tasks = get_posts( array( 'author' => $_GET["ID"] , 'post_type' => 'ssi_tasks', 'post_status' => 'draft' , 'posts_per_page' => -1, 'order' => 'DESC' ) );
	
	echo count($tasks);
	
	?>
		
				
		

		<div class='h4 ' style='text-transform: capitalize; text-align: center;'>
		
		Tasks Completed
		
		</div><hr>

	<div class='col-xs-2 h4'> 
		Started:
	</div>
	<div class='col-xs-3 h4'>
		Task:
	</div>
	<div class='col-xs-2 text-center h4'>
		Hr(s):
	</div>
	<div class='col-xs-2 h4'>
		Budget:
	</div>
	<div class='col-xs-3 h4'>
		Completed:
	</div>
					
					
		
		<div class='clearfix'></div>
			

		<hr>


		<?php
	

		
	//	echo $lead->post_title;
		
		
		
	//	echo $author->display_name;
		
		?>
		
		<div class='name col-md-12 '>

		<?php $person = $lead->post_name; 
			$person =  $_GET['person'];

		$count = 1;
	
	

	
	$completed = 0; 
	
	foreach( $tasks as $lead ){

		if( 1 ){ 
		
				$completed++;
				
		?>
			<hr>
		<div class='col-xs-2'> <?php echo mysql2date('n/j/y', $lead->post_date ); ?><span class='pull-right'><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span></div>
					<div class='col-xs-3'><?php if($lead->post_title){ echo $lead->post_title; }else{ echo 'New Request'; } ?></div>
					<div class='col-xs-2 text-center'><u><?php 
						echo get_field( 'target_hours', $lead->ID );
						
					?></u></div>
					<div class='col-xs-2'>
					
					-- $<?php 
							$budget = get_field( 'target_budget', $lead->ID );
							
							echo $budget;
							
							$staff_budget += $budget;
					?></div>
					<div class='col-xs-2'><?php 
						echo get_field( 'date_complete', $lead->ID );
						
					?></div>
					<div class='col-xs-1 hidden-xs'><button id='details2<?php echo $lead->ID; ?>' class='btn btn-default btn-block'> >> </button></div>
					
		
		<div class='clearfix'></div>
		
		
	<div id='details2<?php echo $lead->ID; ?>' class='details' style='display: none;' >
	
	
	
	
					<div class='col-xs-12 text-center title' >Completion Goals<hr></div>
					<div class='col-xs-4' >
						<b>Date: </b> 
					<!--	<input  type="text" name="target_date" value="<?php echo  get_field( 'target_date', $lead->ID , 1  ) ?>" >-->
						<?php echo  get_field( 'target_date', $lead->ID , 1 ) ?> 
					</div>
					<div class='col-xs-4' >
						<b>Hrs: </b> 
					<!--	<input  type="text" name="target_hours" value="<?php echo  get_field( 'target_hours', $lead->ID , 1  ) ?>" >-->
						<?php echo  get_field( 'target_hours', $lead->ID , 1 ) ?> 
						</div>
					<div class='col-xs-4' >
						<b>Budget: </b>
						$<!--<input  type="text" name="target_budget" value="<?php echo  get_field( 'target_budget', $lead->ID , 1  ) ?>" >-->
						<?php echo  get_field( 'target_budget', $lead->ID , 1 ) ?> </div>


		<div class='clearfix'></div><br>
			<div class='col-xs-12' >
				<b>Assigned To: </b><?php echo get_field( 'assigned_to', $lead->ID ); ?> 
			</div>
		<div class='clearfix'></div><br>
				<?php
				
					echo "<div class='col-xs-6' ><b>Posted By: </b> " . $lead->post_author . "</div>"; 
					
					echo "<div class='clearfix'></div><br>";
					
					$content = $lead->post_content;
					
					$content = apply_filters('the_content', $content);
					
					//echo "<div class='col-xs-12 text-left' ><b><u>Notes</u></b><br>" . $content . "";
			?>
			<div class='col-xs-12 text-left' >
				<b><u>Notes</u></b><br>
				
				<?php echo $content; ?>
			<form method='post'>	
				<textarea name="post_content" placeholder="More notes .."></textarea>
				
				<input type='hidden' name='ID' value='<?php echo $lead->ID; ?>'>
				<input type='hidden' name='ssi_update_cf' value='1'>
				<input type='submit' value='Add Notes'>
			</form>
			</div>
			<div class='nav text-center'>
			
			<div class='clearfix'></div><br>
			<?php
					
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default'>Edit Request</a>";
			?>
				<button id='details<?php echo $lead->ID; ?>' class='btn btn-default '> x close </button>
			<?php
					//echo "<a target='_blank' href='/apply?title=" . $task->post_title . "' class='btn btn-default'>Apply Now!</a>";

					?>
			</div>
			<div class='clearfix'></div><br>

		<form method="post" action="" class=''>
		
			<button name="task_complete" type="submit" class='btn btn-success btn-block btn-lg' value="Remove Lead" />Completed!</button>
			
			<input  type="hidden" name="trans_date" value="<?php echo current_time( 'm/d/y' ); ?>" >
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="task_complete" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
		
		<div class='clearfix'></div><hr>

			<br></div>
			
			
				<?php

		}//end if

	}//end foreach
	
	
	?>

	</div>
		


	<hr>
</div>
	</div>
	<?php
	
		echo "Tasks Completed: " . $completed;
	?>
	<button id='Completed' class='btn btn-default btn-block hidden-print'> Show Completed >> </button>
	
	
	
	
<div id='tasklists-1' class='text-center hidden'>			

	<div id='all-lists' class='hidden-xs' style='display: block;'>
		<div class='clearfix'></div><hr>
			<button id='all-lists'>View All</button>	
		<div class='clearfix'></div><hr>			
	</div>
	<div id='all-lists' style='display: none;'>
		<div class='clearfix'></div><hr>
		<?php 
			foreach( $staff as $lead ){
				
				$person = $lead->post_name;
				
				?>
				<div class='name col-md-6 '>

				<?php $person = $lead->post_name; 
					$person =  $_GET['person'];
				?>

					<div class='h4 btn btn-default btn-block' style='text-transform: capitalize; text-align: center;'>
						<a href='/tasklist?person=<?php echo $person; ?>' target='_blank'>		
								<?php echo $lead->post_title; ?> >>
						</a>		
					</div><hr>
				</div>
				<?php
			}
		?>
		<div class='clearfix'></div><hr>
			<button id='all-lists'>close</button>	
		<div class='clearfix'></div><hr>
	</div>
</div>