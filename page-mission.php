<?php

	if($_GET['approved']){  
	
	update_field( 'task_approved', 'Yes' , $_GET['ID'] ) ;
	
	}

get_header('no-ads');

if($_POST['new_tasklist']){
	
	$date_added = date('Y-m-d H:i:s', strtotime($_POST['date_added']) );
// Create post object
		$my_post = array(
		  
		  'ID' => '',
		 'post_date'	=> $date_added,
		 'post_title' => $_POST['post_title'] ,
		 'post_content' => $_POST['notes'] . ' <br>--' . $_POST['task_details'] ,
		 'post_status' => 'publish'

		);
		

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );
		
		foreach ($_POST as $param_name => $param_val) {
			add_post_meta($post_id, $param_name, $param_val, true);
			update_post_meta( $post_id, $param_name, $param_val  );

		}
		
		set_post_type( $post_id, 'ssi_tasklists' );
		
}


	$staff = get_posts( array( 'post_type' => 'ssi_staff', 'posts_per_page' => -1 , 'order' => 'desc') );
	$tasklists = get_posts( array( 'post_type' => 'ssi_tasklists', 'posts_per_page' => -1 , 'order' => 'desc') );
	$tasks = get_posts( array( 'post_type' => 'ssi_tasks', 'posts_per_page' => -1 , 'order' => 'desc') );
	
	
?>

<div id="main-content" class="">
	
	
	<header class='text-center'>
	
		<?php the_post_thumbnail();  ?>


		<br>
		<h1 class='entry-title'>
			#SSI Mission Tracker 5000
			<br>
			<small>Turn Your Missions into Memories!</small>
		</h1> 
		
	</header>
	
	
			<div class='clearfix'></div><hr>
	
	<div id='all-members' class=''>			
		<div class='text-center'>
			We have <u><?php echo count($staff); ?></u> Members
		</div>
		<hr>
		<div id='members' style='display: block;' class='text-center'>
		<button id='members'>View All</button>	
		<div class='clearfix'></div><hr>			
		</div>
		<div id='members' style='display: none;' class='col-md-12'>
			
			<?php 
				foreach( $staff as $lead ){
					
					$person = $lead->post_name;
					
					
					?>
					
					<br>
					
					
					<?php 
					
				//	echo get_the_author_meta( $lead->ID ); 
					
					?>
					
					<?php $author_id=$lead->post_author; ?>
					
					<a target='_blank' href='/user-profile/?ID=<?php echo $author_id; ?>' class='' target='_blank'>		
					<div class='well'>
					<img src="<?php echo get_avatar_url( $author_id ); ?>" width="25" height="25" class="  circle avatar" alt="<?php echo the_author_meta( 'display_name' , $author_id ); ?>" />
					<?php the_author_meta( 'display_name' , $author_id ); ?> 
					
					<button class='pull-right btn button'> >> </button>
					</div>
					</a>
					
					<?php
				}
			?>
			<div class='clearfix'></div>
			<div class='text-center'>
				<button id='members' class='btn btn-default btn-block'>x close</button>	
			</div>
				
		</div>
	</div>
	<div class='clearfix'></div>
	
	
	
	<div class='clearfix'></div><hr>
	
	<div id='all-missions' class=''>		
		<div class='text-center'>
			We Track <u><?php echo count($tasks); ?></u> Missions
		</div>
		<hr>
		<div id='all-lists' style='display: block;' class='text-center'>
		<button id='all-lists'>View All</button>	
		<div class='clearfix'></div><hr>			
		</div>
		<div id='all-lists' style='display: none;' class='col-md-12'>
			
			<?php 
				$total_tasks = count($tasks);
			
				foreach( $tasks as $lead ){
					
					$person = $lead->post_name;
					
					
					?> .
					
				<div class='well'> 	
					<?php $author_id=$lead->post_author; ?>
					<h4><?php echo $total_tasks--; ?>.
					<a target='_blank'  href='/?p=<?php echo $lead->ID; ?>' class='' target='_blank'>		
							 <?php echo $lead->post_title; ?><button class='pull-right btn button'> >> </button>
					</a></h4> 
					<br>
					
					
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  by 
					<a target='_blank' href='/user-profile/?ID=<?php echo $author_id; ?>' class='' target='_blank'>		
					
					<img src="<?php echo get_avatar_url( $author_id ); ?>" width="25" height="25" class="  circle avatar" alt="<?php echo the_author_meta( 'display_name' , $author_id ); ?>" />
					<?php the_author_meta( 'display_name' , $author_id ); ?> 
					
					
					</a>
					
					<div class='clearfix'></div>
				</div>	
					
					
					
					
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
	

	
	
<?php
		$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {
 ?>

	
		<div id='add-tasklist' style='display: block;' class='text-center'>
			
			<button id='add-tasklist' class='btn btn-success btn-lg'>New Tasklist</button>
			<br><br>
		</div>
		<div id='add-tasklist' style='display: none;' >
		
			<center><h3>New Tasklist<hr></h3></center>
			
			<div id='addnew' class='addnew clear' style='display: block;'>
				 
				<form method="post" action="" name="add_tasklist">
				<div class='well col-md-6 taskcard'>

					<div class='col-md-12'>
						<b>Name:</b><br>
						<input type="text" name="post_title" placeholder="Enter Name" >
					</div>
					<div class='clearfix'></div><br>
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
					<div class='clearfix'></div><br>
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
					<div class='clearfix'></div><hr>
					
					<div class='col-sm-3 hidden ' >
								<b>Posted By: </b><br> <?php 
								$author = wp_get_current_user();
								//$recent_author = get_current_user( 'ID', $lead->post_author );
								//print_r($author);
								
								
								echo $author->user_nicename; ?> 
								<div class='clearfix'></div><br>
							</div>
							<div class='col-sm-4' >
								<b>Assigned To: </b><br> <select name="assigned_to" style='width: 100%;'>
									
									<option value="all">All</option>
								<?php
								$staff = get_posts( array('post_type' => 'ssi_staff', 'posts_per_page' => -1, 'orderby' => 'modified') );

									foreach( $staff as $lead ){
										
										?>
										<option value="<?php echo $lead->post_name; ?>"><?php echo $lead->post_title; ?></option>
										<?php
									}
										
								?>
									
									
									
								</select> 
								<div class='clearfix'></div><br>
							</div>	
							 <div class='col-sm-4'>
							 
								<div class='col-xs-9'>
									<input type="text" name="target_hours" placeholder=".25" >
								</div>
								<div class='col-xs-3'>
									Hrs
								</div>
								<div class='clearfix'></div><br>
							 </div>
							 
							<div class='col-md-4'>
								<input type="text" name="target_budget" placeholder="$$$" >
								<div class='clearfix'></div><br>
							</div>
						<div class='clearfix'></div><br>
						<div class='col-md-6'>
						<b>Start Date</b><br>
						<input  type="text" name="date_added" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					</div>
						<div class='col-md-6'>
						<b>Target Date</b><br>
						<input  type="text" name="target_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					</div>
					<div class='clearfix'></div><br>
						<b>Notes:</b>
						<textarea name="notes" id="" cols="30" rows="3"></textarea>
							<input type="submit" class="btn btn-block">
					
				</div>	

								<input type='hidden' name='new_tasklist' value='1'>
								



				</form>
					
				</div>
		</div>

		<?php 	
		
			//get_template_part('content','goals');

			//get_template_part('content','tasks');
		

		?>
		<?php		


				echo "<div id='latest'></div><br><br>";

			?>
		
		
	<div class='clearfix'></div>	

</div>

<div class='clearfix'></div>

			





<?php




		get_template_part('content','connections-list');



}else{ 
	
		
		 ?>

			<div class='container'>
			
				<div class='clearfix'></div><hr>
				<div class='clearfix'></div>
		
				<div class='well'>
					
					
					<a href='/join' class='btn btn-success btn-lg btn-block hidden'>Join Now</a>
					
					<div id='join' style='display: block;' class='text-center'>
					<h4>Join Today - 100% FREE!</h4><hr>
					<button id='join' class='btn btn-success btn-lg btn-block'>Join Now</button>
					</div>
					<div id='join' style='display: none;'>
					
						<center><h3>Join Today - 100% FREE!</h3></center>
						<?php echo do_shortcode("[wpmem_form register]"); ?>
					</div>
					
					<br>
					

					<div id='login' style='display: block;' class='text-center'>
						<center><h4>Already A Member?</h4></center><hr>
						<button id='login' class='btn btn-success btn-lg btn-block'>Login Here</button>
					</div>
					<div id='login' style='display: none;' >
					
						<center><h3>Member Login</h3></center>
						
						<?php echo do_shortcode("[wpmem_form login]"); ?>
					</div>
					
				</div>
			
			</div>
			
	<?php  
	}
//get_sidebar();
get_footer();