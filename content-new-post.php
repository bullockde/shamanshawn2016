<?php global $post; ?>	
	<div class='clearfix'></div>	
		<div id='add-budget' style='display: block;' class='text-center '>
			
			<button id='add-budget' class='hidden-print  btn-block btn btn-success btn-lg'>New Budget</button>
			
		</div>
	<div class='clearfix'></div>	
<div class='col-xs-12 '>

	<div class='pull-right'>
		<?php if( $leads = get_posts( $args ) ){ echo count($leads) . " " . $post->post_title ; } ?>
	</div>
	


		<div id='add-budget' style='display: none;' >
		
			<center><h3>Add New<hr></h3></center>
			
			<div id='addnew' class='addnew clear' style='display: block;'>
				 
				<form method="post" action="" name="add_tasklist">
				<div class='well col-md-6 taskcard'>
				
					<div class='col-md-12'>
						<b>Name:</b><br>
						<input type="text" name="post_title" placeholder="Enter Name" >
					</div>
					
					<div class='col-md-12 hidden'>	<div class='clearfix'></div><br>
						<b>Project</b><br> 
						
						<select name="assigned_project" style='width: 100%;'>
						
							<option value="-">No Project</option>
							<?php
									$projects = get_posts( array('post_type' => 'ssi_projects', 'posts_per_page' => -1, 'orderby' => 'modified') );
									
									
									foreach( $projects as $lead ){
										
										?>
										
										
										<option value="<?php echo $lead->ID; ?>"><?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?></option>
										<?php
									}
										
								?>
							</select>
					</div>
					
		<div class='col-md-12 hidden'>	<div class='clearfix'></div><br>
						<b>Mission</b><br> 
						
						<select name="assigned_mission" style='width: 100%;'>
						
							<option value="-">No Mission</option>
							<?php
								

									foreach( $tasklists as $lead ){
										
										?>
										
										
										<option value="<?php echo $lead->ID; ?>"><?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?></option>
										
										<?php
									}
										
								?>
							</select>
					</div>
					
					<div class='clearfix'></div><br>
						<div class='col-md-12 hidden'>
						<b>Post Type</b><br> 
						
						
			<?php 
				
					$att = "ssi_budgets" ;
					$options = array('post', 'ssi_tasklists', 'ssi_projects', 'ssi_staff', 'to_do', 'ssi_budgets', 'ssi_investments');

				?>
				<select name="post_type"  style='width: 100%;'>
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
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
	
<?php wp_reset_query(); ?>