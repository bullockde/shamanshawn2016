	<div class="clear"></div>
	<?php
		

		//$page_slug = get_the_slug();
		
		//echo "SLUG-->" . $post->post_name;
		
		
		//echo $user->user_nicename;

		
		$args = array( 'post_type' => 'ssi_budgets'  , 'posts_per_page' => -1 );
		$leads = get_posts( $args );
		
		if( get_field( 'MX_user_id', $_GET['ID'] ) ){
			$report_user_ID = get_field( 'MX_user_id',  $_GET['ID'] );
			$has_user = 1;
			$user = get_userdata( $report_user_ID );
		}
	

?>


	<?php
		// Page thumbnail and title.
		
		//the_title( '<header class="entry-header"><h1 class="entry-title text-center">', '</h1></header><!-- .entry-header -->' );
	?>
	
	
	<div class='clearfix'></div>	
		<div id='add-tasklist' style='display: block;' class='text-center <?php if( !$is_admin ){ echo "hidden"; } ?>'>
			
			<button id='add-tasklist' class='hidden-print btn btn-success btn-lg hidden'>Add New</button>
			
		</div>
	<div class='clearfix'></div>	
<div class='col-xs-12 '>

	<div class='pull-right hidden'>
		<?php if( $leads = get_posts( $args ) ){ echo count($leads) . " " . $post->post_title ; } ?>
	</div>
	


		<div id='add-tasklist' style='display: none;' >
		
			<center><h3>Add New<hr></h3></center>
			
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
										
										
										<option value="<?php echo $lead->ID; ?>"><?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?></option>
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
										
										
										<option value="<?php echo $lead->ID; ?>"><?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?></option>
										
										<?php
									}
										
								?>
							</select>
					</div>
					
					<div class='clearfix'></div><br>
						<div class='col-md-12'>
						<b>Post Type</b><br> 
						
						
			<?php 
				
					$att = "ssi_" . $post->post_name;
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
	

<?php 

		$count = 1;
		foreach( $leads as $lead ){
			
			//echo ++$count . ". " . $lead->post_title;
			//if($is_admin ){ }else 
			
			//echo $user->ID;
			
			//echo " -- " . $lead->post_author;
			
			//echo "<br>";
			if( ($user->ID != $lead->post_author)  ){ continue; }
		
			echo "<br>";
			if( $count++ == 1 ){  
			
			?>
			
				<div id='payments' class='  payment report col-md-12' style='display: block;'>
			
			<div class=''>
				<?php 
								
				// ####################   Service Log	#########

				$client_profit = 0;

				?>
				<div class='clearfix'></div>
				
			
				<div class='col-xs-8 '><b>Description</b></div>

				<div class='col-xs-4  text-left'><b>Rate</b></div>
				
				<div class='clearfix'></div>

				<hr>
				
				
				
				

				<?php 
				
				
				$index  = 1;
				
				$tot_income = $tot_expense = 0;
				
				$initial_investment = 0;
				$return_rate = 0.1;
				$return_amount = 0;
				
				
				$client_profit = 0;

				// check if the repeater field has rows of data
				if( have_rows('service_log' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('service_log', $lead->ID ) ) : the_row();
					
						if( $index == 1 ){ 
							
							$initial_investment = get_sub_field('rate'); 
							$investment_date = get_sub_field('date');
							$return_amount = $initial_investment + ($initial_investment * $return_rate  );
							$index++;
						}
					
				
				?>

			       <div class='col-xs-1 '><?php $date = get_sub_field('date');
					 $date = $arr = explode('-', $date);
					$date = $arr[0] . '/' . $arr[1];
				   
				   echo $date;
				   
				   ?></div>
			<div class='col-xs-8 '>
			<?php the_sub_field('service'); ?>
			</div>
				<div class='col-xs-2  text-left'>
				
				
				<?php the_sub_field('income_expense');?> $ <?php the_sub_field('rate'); ?>
				</div>

				<div id='trans<?php the_sub_field('trans_id'); ?>' class='hidden1  col-xs-1 ' style='display: block;'>
				
					<button id='trans<?php the_sub_field('trans_id'); ?>' class='pull-right hidden-print'> >> </button>
				</div>
				
				<div class='col-xs-12 '>
					<div class='clearfix'></div>
				</div>
				
			
				
				
				
				
				
				<?php 
					
						
				if( get_sub_field( 'flex_pay' ) == 'Yes' ){ 

				//echo " "; 

				$flex_count++;
				$flex_total += get_sub_field( 'rate' );
				

			}else if( get_sub_field( 'income_expense' ) == '-' ){ 

				//echo "- "; 


				$expense_count++;
				$client_profit -= str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
				$total_amount -= str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
				$tot_expense += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
				//$tot_expense += get_field( 'trans_amount', $lead->ID );
				$trans_total = $trans_total - get_field( 'trans_amount', $lead->ID );

			}else{  

				//echo "+ ";  


				$income_count++;
				$client_profit += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
				
				$total_amount += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
				
				$tot_income += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
				
				//$tot_income += get_field( 'trans_amount', $lead->ID );
				$trans_total = $trans_total + get_field( 'trans_amount', $lead->ID );

			}
					
					
					
					?>
				<div class='clearfix'></div>

				
				<div id='trans<?php echo get_sub_field('trans_id'); ?>' class='' style='display: none;'>
					<hr>
					
					<div class='clear well'>
					 <div class='col-xs-6 col-sm-2'><b>Date</b><br><?php echo get_sub_field('date'); ?><br><br></div>
					<div class='col-xs-6 col-sm-2'><b>Time</b><br><?php the_sub_field('time'); ?><br><br></div>
					<div class=' col-sm-2'><b>Location</b><br><?php the_sub_field('location'); ?><br><br></div>
				
					
				
					<div class=' col-sm-2'><b>Trans ID</b><br><?php the_sub_field('trans_id'); ?><br><br></div>
					<div class='clearfix'></div> <br>
					<div class='col-sm-12'><b>Links</b><br><?php the_sub_field('service'); ?><br><br></div>
					<div class='col-sm-12'><b>Service</b><br><?php the_sub_field('service'); ?><br><br></div>
					
					
					<b>Photo: </b>
						<a href='<?php echo get_the_post_thumbnail_url(get_sub_field('trans_id')); ?>'><img src='<?php echo get_the_post_thumbnail_url(get_sub_field('trans_id')); ?>' width='150px' height='150px'></a>
						
					<div class='clearfix'></div> <br>	
					<div class='col-sm-12'><b>Notes</b><br><?php the_sub_field('service'); ?><br><br></div>
					
					<div class='clearfix'></div> <br>	
					
					<button id='trans<?php the_sub_field('trans_id'); ?>' class='pull-right hidden-print'> x close </button>
					<div class='clearfix'></div>	
					</div>
				</div>
				<hr>
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;

?>
<div id='details<?php echo $lead->ID; ?>' style='display: block;'>


		
	<button id='add_payment' class='btn btn-info btn-block hidden-print'>Add Payment</button><br>
</div>
	<div id='add_payment' class='' style='display: none;'>
		<form method="post" action="" name="add_transaction">
				<div class='col-xs-6 col-sm-2'><input  type="text" name="trans_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" ></div>
				<div class='col-xs-6 col-sm-2'><input type="text" name="trans_time" placeholder="Time" value="<?php echo current_time( 'g:i' ); ?> pm" ></div>
				<div class='col-sm-2'><input type="text" name="trans_location" placeholder="Location" value="Location"></div>
				<div class='col-sm-4'><input type="text" name="trans_service" placeholder="Service" Value="Service"></div>
				
				<div class='col-md-1'><input type="text" name="trans_amount" placeholder="Rate"></div>
		<div class='col-md-1'>
			<input type="radio" name="income_expense" value="+">+<br>
			<input type="radio" name="income_expense" value="-">-
		</div>		
				<input type="hidden" name="client_name" value="<?php echo $lead->post_title; ?>">
				<input type="hidden" name="client_city" value="<?php echo get_field( 'MX_user_city', $lead->ID ); ?>">
				<input type="hidden" name="client_phone" value="<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>">
				<input type="hidden" name="client_state" value="<?php echo get_field( 'MX_user_state', $lead->ID ); ?>">
				
				<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
				<input name="client_id" type="hidden" value="<?php echo $lead->ID; ?>" />

				<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
				<input type='hidden' name='insert_transaction' value='true'>
				<input type='hidden' name="update" value='true'>
				<input type="submit" class="pull-right">
			</form>
		</div>



				<div class='clearfix'></div>
				
			<?php 
				// #################### END Service Log	#########


				?>
			</div>
		</div>
		
		
		
			<div id='rental' class=' rental col-md-12' style='display: block;'>
		
			<div class='col-xs-4 col-md-4 well1 hidden'>
			
				<div class='col-xs-6 hidden'>
					Rate (weekly)
				</div>
				<div class='col-xs-6 hidden'>
					$
					<?php 
					
						echo get_field( 'room_rate', $lead->ID );
							?>
				</div>
					<div class='clear'><br></div>
				<div class='col-xs-6 hidden'>
					Security 
				</div>
				<div class='col-xs-6 hidden'>
					$
					<?php 
						echo $security;
						
							?>
				</div>
					<div class='clear'><br></div>
				<div class='col-xs-6 hidden'>
					App Fee
				</div>
				<div class='col-xs-6 hidden'>
					$
					<?php 
							if( get_field( 'app_fee', $lead->ID ) == 0  ){ 
								echo "Waived!";
							
							}else{
								echo get_field( 'app_fee', $lead->ID );
							}
							?>
				</div>
				

			</div>
			<div class='col-xs-4 col-md-4 hidden'>
										
<!--  ///////////////////////////////  DATE MAGIC  ///////////////////////////////   -->
	<?php  			
		
		
		
			//echo "MOVEIN: " . date('Y-m-d H:i:s', strtotime(  $investment_date  ) );

		if( get_field( "move-out_date", $lead->ID ) ){ echo "<br>MOVEOUT: " . get_field( "move-out_date", $lead->ID ); }
			
			
			$rate = get_field( 'room_rate', $lead->ID );

			//$s_date = mysql2date('n/j/y', $lead->post_date );

			$s_date = date('Y-m-d H:i:s', strtotime(  $investment_date  ) );
			
			if( get_field( "move-out_date", $lead->ID ) != "" ){

				$s_date = date('Y-m-d', strtotime(  $lead->post_date  ) );
				$e_date = date("Y-m-d H:i:s", strtotime( get_field( "move-out_date", $lead->ID ) ));

				$e_date = get_field( "move-out_date", $lead->ID );
				$e_date = date('Y-m-d', strtotime(  $e_date ) );

			}else{
				
				$e_date = strtotime( "today" );
				
				$e_date = date('Y-m-d H:i:s',  $e_date );
			}
			//echo "SD==>" . $s_date . "ED==>" . $e_date;

			$date1 = date_create( $s_date );
			$date2 = date_create( $e_date );

			//echo "SD==>" . $date1 . "ED==>" . $date2;
			
			//echo get_the_time('U');
			
			//echo ' <br><br>';
			//echo human_time_diff( $date1, $date2 ) . ' ago';
			
			
			$diff=date_diff($date1,$date2);
	
			$tot_days = $diff->format("%a");
			//echo "TOTAL DAYS--->" . $tot_days;

			$weeks = floor($tot_days/7);

			$days = $tot_days - ($weeks*7);

			$app_fee = get_field( 'app_fee', $lead->ID );

		//	echo "<br>WEEKS-> " . $weeks . " DAYS-> " . $days;

	
			

	?>

<!--  ///////////////////////////////  #DATE MAGIC  ///////////////////////////////   -->


			<?php 
				//echo "<div class='col-sm-12' ><b>Last Seen: </b> " . date('n/j/y', strtotime( get_field( 'last_seen', $lead->ID ) ) ) . "</div>"; 
				//	echo "<div class='col-sm-12' ><b>Last Contacted: </b> " . date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ) . "</div>"; 
				//	echo "<div class='col-sm-12' ><b>Added: </b> " . mysql2date('n/j/y', $lead->post_date ) . "</div>"; 
			?>

			</div>
	
			<div class=' col-xs-6 col-xs-offset-6 '>
				<h4 class='hidden'>Budget Summary</h4>
				
				
				<div class=' well'>
			
				<div class='col-xs-6'>
					Income:
				</div>
				<div class='col-xs-6'>
					$
					<?php 
					
						echo $tot_income;
							?>
				</div>
					<div class='clear'><br></div>
				<div class='col-xs-6'>
					Expense: 
				</div>
				<div class='col-xs-6'>
					$
					<?php 
						echo $tot_expense;
						
							?>
				</div>
					<div class='clear'><br></div>
				<div class='col-xs-6'>
					Left Over:
				</div>
				<div class='col-xs-6'>
					$
					<?php 
							echo ( $tot_income - $tot_expense );
							?>
				</div>
				
				<div class='clearfix'></div>
			</div>
			
			
				<div class='pull-right hidden'>
					<?php 
						
						$due = ((($weeks) * $rate)+($security + $rate + $app_fee));
						echo "Invested --->$" . $initial_investment;
					
					

						$tot_owed  += $due;

						echo "<br>Left Over--->$" . $client_profit;
						
						$percent = round((float)$return_rate * 100 ) . '%';
						echo "<br>Return rate --->$" . $percent;
						echo "<br>Return Amount --->$" . $return_amount;
						
						
						$owed = ($due - $client_profit);

					$banked = $loss = 0;
					

					if( $owed < 0 || get_field( "move-out_date", $lead->ID ) ){
						if( $owed < 0 ){ 
							$banked = (-$owed);
							//echo "<br>BANKED: $" . $banked;
						 }
						else{ 
							$loss = $owed; 
							//echo "<br>LOSS: $" . $loss;

							
						}
						if( get_field( 'security_applied', $lead->ID ) == "yes"  ){ 
								//echo "<br>SECURITY APPLIED!!";
								$final = ((-$loss) + $security);
								//echo "<br>FINAL: $" . $final;
							}

						$owed = 0; 
					}
					//	echo "<br><br>Owed: $" . $owed; 
				
						

						$tot_due += $owed;
					?>
				
				</div>
			</div>


		</div>
		
		
		
			
			
			<?php
			}else{
			?>
			<a target='_blank' href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>'>
			
				<div class='col-xs-3 text-center'>
					<?php
						if(get_field('youtube_id', $lead->ID)){
					?>
								<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg' alt='Youtube Image'  class='circle'>
							<?php
							
						}else if( has_post_thumbnail( $lead->ID ) ) { //the post does not have featured image, use a default image
							$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $lead->ID ), 'thumbnail' );

							?>
								<img src='<?php echo esc_attr( $thumbnail_src[0] ) ; ?>' alt='Youtube Image'  class='circle'>
							<?php
							echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
						}

					?>

				</div>
				<div class='col-xs-6 text-left'>
					<?php  echo ++$count . ". " . $lead->post_title; ?>
					<br>
					<u>
					<?php 
							$Private = get_field( 'ssi_private', $lead->ID );
							
							if( $Private == "Yes" ){ echo "Private"; }else{ echo "Public";}
						?>
					</u>
					
					
						<div class='col-sm-12  hidden'>
				<h4 class='visible-xs'>Budget Summary</h4>
				
				
				<div class=' well'>
			
				<div class='col-xs-6'>
					Income:
				</div>
				<div class='col-xs-6'>
					$
					<?php 
					
						echo $tot_income;
							?>
				</div>
					<div class='clear'><br></div>
				<div class='col-xs-6'>
					Expense: 
				</div>
				<div class='col-xs-6'>
					$
					<?php 
						echo $tot_expense;
						
							?>
				</div>
					<div class='clear'><br></div>
				<div class='col-xs-6'>
					Left Over:
				</div>
				<div class='col-xs-6'>
					$
					<?php 
							echo $client_profit;
							?>
				</div>
				
				<div class='clearfix'></div>
			</div>
			
			
				<div class='pull-right hidden'>
					<?php 
						
						$due = ((($weeks) * $rate)+($security + $rate + $app_fee));
						echo "Invested --->$" . $initial_investment;
					
					

						$tot_owed  += $due;

						echo "<br>Left Over--->$" . $client_profit;
						
						$percent = round((float)$return_rate * 100 ) . '%';
						echo "<br>Return rate --->$" . $percent;
						echo "<br>Return Amount --->$" . $return_amount;
						
						
						$owed = ($due - $client_profit);

					$banked = $loss = 0;
					

					if( $owed < 0 || get_field( "move-out_date", $lead->ID ) ){
						if( $owed < 0 ){ 
							$banked = (-$owed);
							//echo "<br>BANKED: $" . $banked;
						 }
						else{ 
							$loss = $owed; 
							//echo "<br>LOSS: $" . $loss;

							
						}
						if( get_field( 'security_applied', $lead->ID ) == "yes"  ){ 
								//echo "<br>SECURITY APPLIED!!";
								$final = ((-$loss) + $security);
								//echo "<br>FINAL: $" . $final;
							}

						$owed = 0; 
					}
					//	echo "<br><br>Owed: $" . $owed; 
				
						

						$tot_due += $owed;
					?>
				
				</div>
			</div>
					
					
					
					
					
					
					
					
					
					
				</div>
				<div class='col-xs-3 text-center'>
					<button class='pull-right'> >> </button>

				</div>
			</a>
			
			<div class="clear"></div><hr>
			
			<?php }
			
		}
			 
?><div class="clear"></div>
</div>
<div class="clear"></div>


<?php //get_template_part('content', 'new-post');

?><div class="clear"></div>