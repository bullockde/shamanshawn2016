<?php
	$staff = get_posts( array( 'post_type' => 'ssi_staff', 'posts_per_page' => -1 , 'order' => 'desc') );
	$tasklists = get_posts( array( 'post_type' => 'ssi_tasklists', 'posts_per_page' => -1 , 'order' => 'desc') );
	
	if( get_field( 'MX_user_id', $_GET['ID'] ) ){
			$report_user_ID = get_field( 'MX_user_id',  $_GET['ID'] );
			$has_user = 1;
			$user = get_userdata( $report_user_ID );
		}

?>

<div id='all-missions' class=''>		
		<div class='text-center h4'>
			<u><?php echo count($tasklists); ?></u> Projects
		</div>
		<hr>
		<div id='all-lists' style='display: block;' class='text-center hidden'>
		<button id='all-lists'>View All</button>	
		<div class='clearfix'></div><hr>			
		</div>
		<div id='all-lists' style='display: block;' class='col-md-12'>
			
			<?php 
				foreach( $tasklists as $lead ){
					
					//$person = $lead->post_name;
					if( ($user->ID != $lead->post_author)  ){ continue; }
					?>
					
						
<div class='clearfix'></div>

					<div class='col-xs-12 col-sm-2'>
						<div class='clearfix'></div>
						<?php
						$img_url = get_the_post_thumbnail_url($lead->ID , 'thumbnail');
						
						
						?> 
						<img src='<?php echo $img_url; ?>'>
						 <div class='clearfix'></div>
					</div>
					<div class='col-xs-6 col-sm-2'> 

						<?php echo ++$count . " - "; ?>
						
						<a href='/admin/report/?ID=<?php echo $lead->ID; ?>' target='_blank' ><?php echo $lead->post_title; ?></a>
						
						
							<div class='clearfix'></div>
					</div>
					<div class='col-xs-3 hidden'>
						
						<?php echo get_field( 'MX_user_email', $lead->ID ); ?>
						
						<div class='clearfix'></div>
					</div>
					<div class='col-xs-6 col-sm-2'>
						
						<a href="tel:<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>"><?php echo get_field( 'MX_user_phone', $lead->ID ); ?></a>
						
						<div class='clearfix'></div>
					</div>
					<div class='col-xs-12 col-sm-2'>
						<div class='clearfix'></div>
						<?php /* echo get_field( 'area_code', $lead->ID ); */?> 
						<?php 
							if(get_field( 'address', $lead->ID )){
								
								echo get_field( 'address', $lead->ID ) . ", ";
							}
 ?>						<?php echo get_field( 'MX_user_city', $lead->ID ); ?>
						 <?php echo get_field( 'MX_user_state', $lead->ID ); ?>

						 <div class='clearfix'></div>
					</div>
					
					
	<div class='clearfix'></div>				
					<a href='/tasklist?tasklist=<?php echo $person; ?>' class='' target='_blank'>		
							<?php echo $lead->post_title; ?> >>
					</a><hr>
					
					
								
	<?php
		$count = 1;
	
	$tasks = get_posts( array( 'post_type' => 'to_do', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby'=> 'meta_value_num', 'meta_key' => 'target_date' ) );

	foreach( $tasks as $task ){
		
		$num = 10;
		if(is_page('tasklist')){ $num = 10; }

		if( get_field( 'assigned_mission', $task->ID ) == $lead->ID ){ 
				//if( $count++ > $num )continue; 
		?>
		
		
<div class='well mini taskcard report text-center1 hidden1'>



		<div class=' header text-center'>
				<b><u>Task</u></b><br>
				<?php if($task->post_title){ echo $task->post_title; }else{ echo 'New Request'; } ?>

		</div>		
				
		<div class='clearfix'></div><hr>
			<div class='col-xs-6 text-center'>
				<u>Created</u><br>
				<?php echo mysql2date('n/j/y', $task->post_date ); ?>
			</div>
			<div class='col-xs-6 text-center'>
				<u>Deadline</u><br>
				<?php echo mysql2date('n/j/y', get_field( 'target_date', $task->ID ) ); ?>
			</div>
		<div class='clearfix'></div>
		
		<div id='details<?php echo $task->ID; ?>' class='' style='display: block;' >		
				<div class='clearfix'></div><hr>
				<button id='details<?php echo $task->ID; ?>' class='btn btn-success btn-default btn-block'> Details >> </button>
		</div>
		
		<div id='details<?php echo $task->ID; ?>' class='details goal' style='display: none;' >
				<?php

					echo "";
					
					?>
					
					<div class='col-xs-12 text-center title' ><b>Task Goals </b> </div><div class='clearfix'></div>
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
					echo "<div class='clearfix'></div><br><br>";
					
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
					echo "<div class='clearfix'></div><br>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $task->ID . "&action=edit' class='btn btn-default'>Edit Request</a>";
			?>
				<button id='details<?php echo $task->ID; ?>' class='btn btn-default '> x close </button>
			<?php
					//echo "<a target='_blank' href='/apply?title=" . $task->post_title . "' class='btn btn-default'>Apply Now!</a>";

					?>
			</div>
			<div class='clearfix'></div><br>
					
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
			<div class='clearfix'></div>
			
			
			

		<?php }//end if

	}//end foreach
	?>
					
					
					
					
					
					<?php
					
					
					
					
					
					
					
					
					
				}
			?>
			<div class='clearfix'></div>
			<div class='text-center'>
				<button id='all-lists' class='btn btn-default btn-block'>x close</button>	
			</div>
		</div>
	</div>
	<div class='clearfix'></div>
</div>	
<div class='clearfix'></div>
	<?php get_template_part('content', 'new-post'); ?>
	
	<div class='clearfix'></div>