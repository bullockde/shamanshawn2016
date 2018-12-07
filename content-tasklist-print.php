<?php
	$staff = get_posts( array( 'post_type' => 'ssi_staff', 'posts_per_page' => -1 , 'order' => 'ASC') );
	
	
?>
	<div class='clear'></div><hr>


<div id='staff' class='staff'>

<?php

	
	$staff_budget = 0;
	
	
	foreach( $staff as $lead ){
		
		if( $_GET['person'] != $lead->post_name ){ 
				continue; 
		}
	//	echo $author->display_name;
		
		?>
		<div class='name col-md-12 '>

		<?php $person = $lead->post_name; ?>

		<div class='h3 ' style='text-transform: capitalize; text-align: center;'>
		
		<?php echo $lead->post_title; ?>
		
		</div><hr>

	<div class='col-xs-2 h4'> 
		Date:
	</div>
	<div class='col-xs-4 col-sm-3 h4'>
		Task:
	</div>
	<div class='col-xs-2 text-center h4'>
		Hr(s):
	</div>
	<div class='col-xs-2 h4'>
		Budget:
	</div>
	<div class='col-xs-2 h4'>
		Finish By:
	</div>
					
					
		
		<div class='clear'></div><hr>
			
	<?php
		$count = 1;
	
	$leads = get_posts( array( 'post_type' => 'to_do', /*'orderby'=> 'meta_value_num', 'meta_key' => 'target_hours' ,*/'posts_per_page' => -1, 'order' => 'ASC' ) );

	foreach( $leads as $lead ){

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
					<div class='col-sm-1 hidden-xs'><button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'> >> </button></div>
					
		
		<div class='clear'></div><hr>
		
		

		<?php
			echo "<div id='details" . $lead->ID .  "' class='details' style='display: none;' >";
		?>

			
<?php		
					/*if( $lead["2.3"] ){
					echo "<b>Location: </b> " . $lead["2.3"] . ", " . $lead["2.4"] . " " . $lead["2.5"] . "<br><br>";
					}else	{
					echo "<b>Location:</b> Philadelphia, PA<br>";
					}*/
					echo "<div class='col-xs-6' ><b>Posted By: </b> " . get_field( 'username', $lead->ID ) . "</div>"; 
					echo "<div class='col-xs-6' ><b>Budget: </b>  $" . get_field( 'target_budget', $lead->ID ) . "</div>"; 

					?>

		<form method="post" action="" class='pull-right'>
			<button name="update" type="submit" class='btn ' value="Request Complete" />Request Complete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="update" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>

				<?php
					echo "<div class='clear'></div><br>";
					echo "<div class='col-xs-12' ><b>Description: </b> " . $lead->post_content . "</div>";
					
					echo "<div class='clear'></div><br>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default'>Edit Request</a>";

					echo "<a target='_blank' href='/apply?title=" . $lead->post_title . "' class='btn btn-default'>Apply Now!</a>";

					

		?>
			<br>
			</div>
			<div class='clear'></div>
		
		<?php

		}//end if

	}//end foreach
	
	
	echo "Total $ " . $staff_budget;
	?>

	</div>
		
		<?php 	}	?>


</div>
	<div class='clear'></div>
	
	
	
	<br><hr>
	
	
	<div id='Completed' class='tasks' style='display: none;'>

<?php

	
	$staff_budget = 0;
	
	
	foreach( $staff as $lead ){
		
		if( $_GET['person'] != $lead->post_name ){ 
				continue; 
		}
	//	echo $author->display_name;
		
		?>
		<div class='name col-md-12 '>

		<?php $person = $lead->post_name; ?>

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
					
					
		
		<div class='clear'></div>
			
	<?php
		$count = 1;
	
	$leads = get_posts( array( 'post_type' => 'to_do', 'post_status' => 'draft' , 'posts_per_page' => -1, 'order' => 'DESC' ) );

	
	$completed = 0; 
	
	foreach( $leads as $lead ){

		if( get_field( 'assigned_to', $lead->ID ) == $person ){ 
		
				$completed++;
				
		?>
		
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
					<div class='col-xs-1 hidden-xs'><button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'> >> </button></div>
					
		
		<div class='clear'></div>
		
		
	<div id='details<?php echo $lead->ID; ?>' class='details' style='display: none;' >
		
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
					
					
					echo "<div class='col-xs-6' ><b>Posted By: </b> " . $lead->post_author . "</div>"; 
					echo "<div class='col-xs-6' ><b>Budget: </b>  $" . get_field( 'target_budget', $lead->ID ) . "</div>"; 

					?>

		<form method="post" action="" class='pull-right'>
			<button name="update" type="submit" class='btn ' value="Request Complete" />Request Complete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="update" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
<div class='clear'></div><br>

			<div class='col-xs-12' ><b>Description: </b> 
				<?php
					
					echo $lead->post_content;
				?>
			</div>
			
			<div class='clear'></div><br>
			
				<a target='_blank' href='/wp-admin/post.php?post=<?php echo $lead->ID; ?>&action=edit' class='btn btn-default'>Edit Request</a>
				<?php				
					
					echo "<a target='_blank' href='/apply?title=" . $lead->post_title . "' class='btn btn-default'>Apply Now!</a>";

				
				?>
			<br></div>
			
			
				<?php

		}//end if

	}//end foreach
	
	
	?>

	</div>
		
		<?php 	}	?>


</div>
	
	<?php
	
		echo "Tasks Completed: " . $completed;
	?>
	<button id='Completed' class='btn btn-default btn-block hidden-print'> Show Completed >> </button>
	
	
	
	
	<div id='tasklists' class='text-center'>			

		<div id='all-lists' class='hidden-xs' style='display: block;'>
			<div class='clear'></div><hr>
				<button id='all-lists'>View All</button>	
			<div class='clear'></div><hr>			
		</div>
	<div id='all-lists' style='display: none;'>
		<div class='clear'></div><hr>
		<?php 
			foreach( $staff as $lead ){
				
				$person = $lead->post_name;
				
				?>
				<div class='name col-md-6 '>

				<?php $person = $lead->post_name; ?>

					<div  style='text-transform: capitalize; text-align: center;'>
						<a class='h4 btn btn-default btn-block' href='/tasklist?person=<?php echo $person; ?>' target='_blank'>		
								<?php echo $lead->post_title; ?> >>
						</a>		
					</div><hr>
				</div>
				<?php
			}
		?>
		<div class='clear'></div><hr>
			<button id='all-lists'>close</button>	
		<div class='clear'></div><hr>
	</div>
</div>