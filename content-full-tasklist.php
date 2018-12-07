<div id='staff' class='staff'>

<?php

	

	foreach( $staff as $lead ){
		
		echo $author->display_name;
		
		?>
		<div class='name col-md-3 '>

		<?php $person = $lead->post_name; ?>

		<div class='h4 ' style='text-transform: capitalize; text-align: center;'>
		
		<?php echo $lead->post_title; ?>
		
		</div><hr>

	
			
	<?php
		$count = 1;
	
	$tasks = get_posts( array( 'post_type' => 'to_do', 'posts_per_page' => -1, 'order' => 'DESC' ) );

	foreach( $tasks as $task ){

		if( get_field( 'assigned_to', $task->ID ) == $person ){ 
				//if( $count++ > 3 )continue; 
		?>
<div class='well mini taskcard text-center'>


		<div class='col-xs-12 '>
			<small><b><u><?php echo mysql2date('n/j/y', $task->post_date ); ?></u></b></small>
		</div>
			<div class='clear'></div>
			<div class='col-xs-12 task'>

		<?php echo $task->post_title; ?>
			</div>
			<div class='clear'></div>
			
			
			
			
		<form method="post" action="" class=''>
			<button name="task_complete" type="submit" class='btn btn-success btn-block' value="Remove Lead" />Completed!</button>
			
			<input  type="hidden" name="trans_date" value="<?php echo current_time( 'm/d/y' ); ?>" >
			<input name="ID" type="hidden" value="<?php echo $task->ID; ?>" />
			<input name="task_complete" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
</div>
			<div class='clear'></div>

		<?php }//end if

	}//end foreach
	?>

	</div>
		
		<?php 	}	?>


</div>