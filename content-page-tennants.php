<div class='clearfix'></div>
<div class=''>


<?php 

		
	?>
		<div class=''>
			<div class='col-xs-6'>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>	
			<div class='col-xs-6'>
				<button id='newpost' class='btn btn-lg btn-default pull-right'>Add New</button>
				<button id='filter' class='btn btn-lg btn-default pull-right'>Filter</button>		
				<button id='show-moved' class='btn btn-lg btn-default pull-right'>Show Moved Out</button>		
				
				<a href='#summary' class='btn btn-lg btn-default pull-right'>Summary</a>
			</div><div class='clearfix'></div>
			<hr>
		</div>
	

<div id='newpost' class='clear' style='display: none;'>

		<form id='insert_lead' method='post'>
		<!--  <div class='col-md-2'><input type="date" name="trans_date"></div>-->

		<input type="hidden" name="cur_post_type" value="<?php echo $post->post_name; ?>">

		<div class='col-md-2'><input type="text" name="client_name" placeholder="Enter Name"></div>
		<div class='col-md-2'><input type="text" name="client_email" placeholder="Enter Email"></div>
		<div class='col-md-2'><input type="text" name="client_phone" placeholder="Enter Phone" class="form-control bfh-phone" data-format="+1 (ddd) ddd-dddd"></div>
		<div class='col-md-2'><input type="text" name="client_city" placeholder="Enter City"></div>
		<div class='col-md-1'><input type="text" name="client_state" placeholder="State"></div>
		<div class='col-md-1'><input type="submit" value="Add"></div><br>
		<div class='clearfix'></div>
		<hr>

		<div class='col-sm-2' ><input type="text" name="area_code" placeholder="Area"></div>
		<div class='col-sm-2' ><input type="text" name="last_seen" placeholder="Last Seen"></div>
		<div class='col-sm-2' ><input type="text" name="last_contacted" placeholder="Last Contacted"></div>
		<div class='col-sm-3' ><input type="text" name="post_date" placeholder="Added"></div>
		<div class='col-sm-3' ><input type="text" name="notes" placeholder="Notes"></div>


		<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		
		<input type='hidden' name='insert_client' value='true'>
		<input type='hidden' name="update" value='true'>
		
		<div class='clearfix'></div>
	</form>
	<br><hr>
</div>


	<?php get_template_part( 'content', 'filter' ); ?>

	

		<div class='clearfix'></div>

		
			
			
		<?php
			/*********************************************************/
			
			$tot_count = 0;

			$total_amount = 0;

			/////////////////////////////////////////////////

			$tot_owed = 0;

			$tot_paid = 0;

			$tot_due = 0;


			// The Query
			
			//echo "THIS PAGE--> " . $post->post_name;
			
			
		
				$args = array( 'post_type' => 'ssi_' . $post->post_name , 'posts_per_page' => -1 , 'post_status' => 'publish'  );
				$leads = get_posts( $args );		
			
		
//###########  START FILTER Search Guts   ###########
		if( $_GET['term'] != '' )$term = $_GET['term'];

		if( $_GET['searchterm'] != '' )$searchterm = $_GET['searchterm'];

		$filter = 1;
		if( isset($searchterm) && $filter ){
				
			$filtered = array();
			foreach( $leads as $lead ){
				if( strcasecmp ( get_field( 'area_code', $lead->ID ) , $searchterm ) == 0  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;

			$filter = 0;
		}else if( isset($term) && $filter ){
				
			$filtered = array();
			foreach( $leads as $lead ){
				if( strcasecmp ( get_field( 'area_code', $lead->ID ) , $term ) == 0  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;
		}
//###########   END FILTER Search Guts   ###########

			//print_r( $leads );

			$names = array();
			$nums = array();
			$emails = array();
			
			$moved_out = array();
			
			foreach( $leads as $lead ){
				
				

					if(  get_field( "move-out_date", $lead->ID ) != "" ){ 

						
						array_push( $moved_out, $lead );
						

					 }else{
						 
						 
						 ?>
	<div class='well'>					 
		<div class='col-md-2'><h4>Name</h4></div>
		<div class='col-md-3'><h4>Dates</h4></div>
		<div class='col-md-2'><h4>Room/Rate</h4></div>
		<div class='col-md-2'><h4>Balance</h4></div>
		<div class='col-md-1'><h4></h4></div>
		<div class='col-md-2'><h4>Details</h4></div>
		<div class='clearfix'></div>
						 <?php
					
					$tot_count++;

					$public = 1;

					

		if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>

<!--  ///////////////////////////////  Start Variables ///////////////////////////////   -->
					

					<?php 

	
			$rate = get_field( 'room_rate', $lead->ID );

			$s_date = date('Y-m-d H:i:s', strtotime(  $lead->post_date  ) );
			
			if( get_field( "move-out_date", $lead->ID ) != "" ){

				$s_date = date('Y-m-d', strtotime(  $lead->post_date  ) );
				$e_date = date("Y-m-d H:i:s", strtotime( get_field( "move-out_date", $lead->ID ) ));

				$e_date = get_field( "move-out_date", $lead->ID );
				$e_date = date('Y-m-d', strtotime(  $e_date ) );

			}else{
				
				$e_date = current_time( 'mysql' );
				
			}
			//echo "SD==>" . $s_date . "ED==>" . $e_date;

			$date1 = date_create( $s_date );
			$date2 = date_create( $e_date );

			$diff=date_diff($date1,$date2);
	
			$tot_days = $diff->format("%a");
			//echo "TOTAL DAYS--->" . $tot_days;

			$weeks = floor($tot_days/7);

			$days = $tot_days - ($weeks*7);

			
		$app_fee = get_field( 'app_fee', $lead->ID );

		if( get_field( 'security_deposit', $lead->ID ) ){ $security = get_field( 'security_deposit', $lead->ID ); }
		else{ $security = (2 * $rate); }
			
		$deposit = ($security + $rate + $app_fee);

		$due = ((($weeks-1) * $rate)+($security + $rate + $app_fee));

		$client_profit = 0;

		// check if the repeater field has rows of data
				if( have_rows('service_log' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('service_log', $lead->ID ) ) : the_row();
				
				?>
				
				<?php 
					$client_profit += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT));
					$total_amount += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT)); ?>
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;


						
	?>
					
<!--  ///////////////////////////////  END Variables ///////////////////////////////   -->

				
<!--  ///////////////////////////////  Start Top ///////////////////////////////   -->

		<div id='moved-out<?php echo "-" . $lead->ID; ?>' class='' style='<?php if ( get_field( "move-out_date", $lead->ID ) ){ echo "display: block;"; } ?>'>

					<div class='col-md-2'>
						
						<?php 
							if ( has_post_thumbnail($lead->ID) ) {
    								echo get_the_post_thumbnail( $lead->ID, "thumbnail" ); 
							}else{
						?>
							<img src='http://shamanshawn.com/wp-content/uploads/2015/11/blank-face.jpe' class='img-responsive'>
						<?php
							}
   							
						?>
					</div>
					<div class='col-md-3'>
				<?php 		
				
					if($lead->post_title){ 

								echo $lead->post_title; 
							
								array_push( $names, $lead->post_title );

							}else{ echo 'No Name Added'; } 
						

					echo '<br><br>Phone#: ' . get_field( 'lead_phone', $lead->ID ); 

				?>
	<!--  ///////////////////////////////  DATE MAGIC  ///////////////////////////////   -->
	<?php  			
		

			echo "<br><br>Room Rented: " . get_field( "room_rented", $lead->ID );

			echo "<br>MOVEIN: " . get_field( "move-in_date", $lead->ID );

		if( get_field( "move-out_date", $lead->ID ) ){ 

			echo "<br>MOVEOUT: " . get_field( "move-out_date", $lead->ID ); 
		}
			

			echo "<br>WEEKS-> " . $weeks . " DAYS-> " . $days;

	?>

<!--  ///////////////////////////////  #DATE MAGIC  ///////////////////////////////   -->

					</div>
					<div class='col-md-2'>
						
						
			<?php 

							

			echo "Rate (weekly) -->$" . get_field( 'room_rate', $lead->ID );

			echo "<br>App Fee--->$" . get_field( 'app_fee', $lead->ID );

		$security = get_field( 'security_deposit', $lead->ID ); 
			
			echo "<br>Security --->$" . $security;

			$deposit = ($security + $rate + $app_fee);
			echo "<br>Move-In --->$" . $deposit; //first + last + security
			
						?>

					</div>
					<div class='col-md-2'>

					
					<?php 
						
						$due = ((($weeks) * $rate)+($security + $rate + $app_fee));
						echo "DUE--->$" . $due;


						$tot_owed  += $due;

						echo "<br>PAID--->$" . $client_profit;
						$owed = ($due - $client_profit);

					$banked = $loss = 0;
					

					if( $owed < 0 || get_field( "move-out_date", $lead->ID ) ){
						if( $owed < 0 ){ 
							$banked = (-$owed);
							echo "<br>BANKED: $" . $banked;
						 }
						else{ 
							$loss = $owed; 
							echo "<br>LOSS: $" . $loss;

							
						}
						if( get_field( 'security_applied', $lead->ID ) == "yes"  ){ 
								echo "<br>SECURITY APPLIED!!";
								$final = ((-$loss) + $security);
								echo "<br>FINAL: $" . $final;
							}

						$owed = 0; 
					}
						echo "<br>Owed: $" . $owed; 
				
						

						$tot_due += $owed;
					?>
					
					</div>
					<div class='col-md-3'>
				
						
				<?php
					echo "<a target='_blank' href='/admin/report/?type=tenants&ID=" . $lead->ID . "' class='btn btn-default btn-block'>FULL REPORT</a>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default btn-block'>Edit</a>";

				
				if( !get_field( "move-out_date", $lead->ID ) ){ 
					?>

		<form method="post" action="" class='pull-left1'>
			<button name="update" type="submit" class='btn btn-block btn-danger' value="Remove Lead" />Move Out</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="move_out" type="hidden" value="true" />
			<input name="move_out_date" type="hidden" value="<?php echo current_time( 'm/d/y' );  ?>" />
		</form>

					<?php 
				}
				?>

				
				<button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>More</button>
					</div>

					<div class='clearfix'></div>
		</div> <!--  #MOVED OUT Div  -->
<!--  ///////////////////////////////  END Top  ///////////////////////////////   -->

<!--  ///////////////////////////////  Start Bottom ///////////////////////////////   -->
<?php

					echo "<div id='details" . $lead->ID .  "' class='details' style='display: none;'>";

				?>

					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>

				<?php
					

					
					array_push( $nums, get_field( 'lead_phone', $lead->ID ) );

					echo '<br>Email: ' . get_field( 'lead_email', $lead->ID );

					echo get_field( 'lead_city', $lead->ID ); 


					/*if( $lead["2.3"] ){
					echo "<b>Location: </b> " . $lead["2.3"] . ", " . $lead["2.4"] . " " . $lead["2.5"] . "<br><br>";
					}else	{
					echo "<b>Location:</b> Philadelphia, PA<br>";
					}*/

					
					echo "<div class='col-sm-4' ><b>Last Seen: </b> " . date('n/j/y', strtotime( get_field( 'last_seen', $lead->ID ) ) ) . "</div>"; 
					echo "<div class='col-sm-4' ><b>Last Contacted: </b> " . date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ) . "</div>"; 
					echo "<div class='col-sm-4' ><b>Added: </b> " . mysql2date('n/j/y', $lead->post_date ) . "</div>"; 
					
				// ####################   Service Log	#########

				//$client_profit = 0;

				?>
				<div class='clear'><br><br></div>
				<div class='col-xs-6 col-sm-2'><b>Date</b></div>
				<div class='col-xs-6 col-sm-2'><b>Time</b></div>
				<div class='col-sm-2'><b>Location</b></div>
				<div class='col-sm-2'><b>Service</b></div>
				<div class='col-sm-2'><b>Trans ID</b></div>
				<div class='col-sm-2'><b>Rate</b></div>
				<div class='clearfix'></div>

				<hr>

				<?php 

				// check if the repeater field has rows of data
				if( have_rows('service_log' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('service_log', $lead->ID ) ) : the_row();
				
				?>

			       <div class='col-xs-6 col-sm-2'><?php echo get_sub_field('date'); 

							?></div>
				<div class='col-xs-6 col-sm-2'><?php the_sub_field('time'); ?></div>
				<div class='visible-xs'><br><br></div>
				<div class='col-sm-2'><?php the_sub_field('location'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-sm-2'><?php the_sub_field('service'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-sm-2'><?php the_sub_field('trans_id'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-sm-2'>$<?php the_sub_field('rate'); ?></div>
				
				<?php 
					//$client_profit += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT));
					//$total_amount += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT)); ?>
				<div class='clearfix'></div>
				<hr>
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;

?>

		<form method="post" action="" name="add_transaction">
				<div class='col-xs-6 col-sm-2'><input  type="text" name="trans_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" ></div>
				<div class='col-xs-6 col-sm-2'><input type="text" name="trans_time" placeholder="Time" value="<?php echo current_time( 'g:i' ); ?> pm" ></div>
				<div class='col-sm-2'><input type="text" name="trans_location" placeholder="Location" value="My Place"></div>
				<div class='col-sm-4'><input type="text" name="trans_service" placeholder="Service" Value="Room Rent"></div>
				
				<div class='col-sm-2'><span class='amount'>$<input type="text" name="trans_amount" placeholder="" ></span></div>				
				<input type="hidden" name="client_name" value="<?php echo $lead->post_title; ?>">
				<input type="hidden" name="client_city" value="<?php echo get_field( 'lead_city', $lead->ID ); ?>">
				<input type="hidden" name="client_phone" value="<?php echo get_field( 'lead_phone', $lead->ID ); ?>">
				<input type="hidden" name="client_state" value="<?php echo get_field( 'lead_state', $lead->ID ); ?>">
				
				<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
				<input name="client_id" type="hidden" value="<?php echo $lead->ID; ?>" />

				<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
				<input type='hidden' name='insert_transaction' value='true'>
				<input type='hidden' name="update" value='true'>
				<input type="submit" class="pull-right">
			</form>
				
				<div class='clearfix'></div>
				<hr>
			<?php 
				// #################### END Service Log	#########

				?>
				
				<div class='col-xs-6 col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>

					<div class='pull-right'><?php echo "Total: $" . $client_profit; ?></div><br>
					<div class='pull-right'><?php 
								//$due = ((($weeks-1) * $rate)+($security + $rate + $app_fee));

								//echo "DUE-->" . $due;
								$owed = ($due - $client_profit);
								echo "<br>Owed: $" . $owed; 
								
							if( get_field( 'security_applied', $lead->ID ) == "yes"  ){ 
								echo "<br>SECURITY APPLIED!!";
								$final = ((-$owed) + $security);
								echo "<br>FINAL: $" . $final;
							}
				?></div>
					
				</div>
				<?php 
					
				
				
				
					echo "<div class='clearfix'></div><br>";
					echo "<div class='col-xs-12' ><b>Area Code: </b> " . get_field( 'area_code', $lead->ID ) . "</div><br>";
					echo "<div class='col-xs-12' ><b>Description: </b> " . $lead->post_content . "</div><br>";
					echo "Forms:<br>";
			?>
					<div class='col-xs-6'>
						<img src='<?php echo get_field( 'file_1', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<div class='col-xs-6'>
						<img src='<?php echo get_field( 'file_2', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<img src='<?php echo get_field( 'file_3', $lead->ID ); ?>' class='img-responsive'>
			<?php 	
					echo "<div class='clearfix'></div><br>";


					?>

		<form method="post" action="" class='pull-left'>
			<button name="update" type="submit" class='btn btn-danger' value="Remove Lead" />Delete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="post_to_draft" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>

				<?php
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default pull-left'>Edit</a>";

					echo "<a target='_blank' href='/admin/tenant-report/?ID=" . $lead->ID . "' class='btn btn-default pull-left'>FULL REPORT</a>";
				
					echo "<br></div><div class='clearfix'></div>";
				?>
		</div>
<?php				

					}// #END IF Published

?>

<!--  ///////////////////////////////  END Bottom ///////////////////////////////   -->


		

		<?php if ( get_field( "move-out_date", $lead->ID ) ){ ?>
		
		<div id='show-moved-out' style='display: none;'>
			<div class="alert alert-info">
			 <strong>Moved Out</strong> <button id='moved-out<?php echo "-" . $lead->ID; ?>'>View</button>	
			<hr>
			</div>
		</div>

		<?php }else{ ?>

			<div class="alert alert-info">
			  <strong>Success!</strong> Indicates a successful or positive action.
			</div>

			<hr>

		<?php } ?>
		

		

		<?php
				}else{  echo "Private<hr><br>" ; } 
				

				}	//END ELSE MOVE OUT


				}// END FOR EACH LEADS

				
				//print_r($moved_out);
				
				
	?>
	<div id='show-moved' style='display: none;'>
<?php	
				
				foreach( $moved_out as $lead ){
				
				

					if(  0 /* get_field( "move-out_date", $lead->ID ) != "" */ ){ 

						
						array_push( $moved_out, $lead );
						

					 }else{
						 
						 
						 ?>
	<div class='well'>					 
		<div class='col-md-2'><h4>Name</h4></div>
		<div class='col-md-3'><h4>Dates</h4></div>
		<div class='col-md-2'><h4>Room/Rate</h4></div>
		<div class='col-md-2'><h4>Balance</h4></div>
		<div class='col-md-1'><h4></h4></div>
		<div class='col-md-2'><h4>Details</h4></div>
		<div class='clearfix'></div>
						 <?php
					
					$tot_count++;

					$public = 1;

					

		if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>

<!--  ///////////////////////////////  Start Variables ///////////////////////////////   -->
					

					<?php 

	
			$rate = get_field( 'room_rate', $lead->ID );

			$s_date = date('Y-m-d H:i:s', strtotime(  $lead->post_date  ) );
			
			if( get_field( "move-out_date", $lead->ID ) != "" ){

				$s_date = date('Y-m-d', strtotime(  $lead->post_date  ) );
				$e_date = date("Y-m-d H:i:s", strtotime( get_field( "move-out_date", $lead->ID ) ));

				$e_date = get_field( "move-out_date", $lead->ID );
				$e_date = date('Y-m-d', strtotime(  $e_date ) );

			}else{
				
				$e_date = current_time( 'mysql' );
				
			}
			//echo "SD==>" . $s_date . "ED==>" . $e_date;

			$date1 = date_create( $s_date );
			$date2 = date_create( $e_date );

			$diff=date_diff($date1,$date2);
	
			$tot_days = $diff->format("%a");
			//echo "TOTAL DAYS--->" . $tot_days;

			$weeks = floor($tot_days/7);

			$days = $tot_days - ($weeks*7);

			
		$app_fee = get_field( 'app_fee', $lead->ID );

		if( get_field( 'security_deposit', $lead->ID ) ){ $security = get_field( 'security_deposit', $lead->ID ); }
		else{ $security = (2 * $rate); }
			
		$deposit = ($security + $rate + $app_fee);

		$due = ((($weeks-1) * $rate)+($security + $rate + $app_fee));

		$client_profit = 0;

		// check if the repeater field has rows of data
				if( have_rows('service_log' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('service_log', $lead->ID ) ) : the_row();
				
				?>
				
				<?php 
					$client_profit += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT));
					$total_amount += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT)); ?>
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;


						
	?>
					
<!--  ///////////////////////////////  END Variables ///////////////////////////////   -->

				
<!--  ///////////////////////////////  Start Top ///////////////////////////////   -->

		<div id='moved-out<?php echo "-" . $lead->ID; ?>' class='' style='<?php if ( get_field( "move-out_date", $lead->ID ) ){ echo "display: block;"; } ?>'>

					<div class='col-md-2'>
						
						<?php 
							if ( has_post_thumbnail($lead->ID) ) {
    								echo get_the_post_thumbnail( $lead->ID, "thumbnail" ); 
							}else{
						?>
							<img src='http://shamanshawn.com/wp-content/uploads/2015/11/blank-face.jpe' class='img-responsive'>
						<?php
							}
   							
						?>
					</div>
					<div class='col-md-3'>
				<?php 		
				
					if($lead->post_title){ 

								echo $lead->post_title; 
							
								array_push( $names, $lead->post_title );

							}else{ echo 'No Name Added'; } 
						

					echo '<br><br>Phone#: ' . get_field( 'lead_phone', $lead->ID ); 

				?>
	<!--  ///////////////////////////////  DATE MAGIC  ///////////////////////////////   -->
	<?php  			
		

			echo "<br><br>Room Rented: " . get_field( "room_rented", $lead->ID );

			echo "<br>MOVEIN: " . get_field( "move-in_date", $lead->ID );

		if( get_field( "move-out_date", $lead->ID ) ){ 

			echo "<br>MOVEOUT: " . get_field( "move-out_date", $lead->ID ); 
		}
			

			echo "<br>WEEKS-> " . $weeks . " DAYS-> " . $days;

	?>

<!--  ///////////////////////////////  #DATE MAGIC  ///////////////////////////////   -->

					</div>
					<div class='col-md-2'>
						
						
			<?php 

							

			echo "Rate (weekly) -->$" . get_field( 'room_rate', $lead->ID );

			echo "<br>App Fee--->$" . get_field( 'app_fee', $lead->ID );

		$security = get_field( 'security_deposit', $lead->ID ); 
			
			echo "<br>Security --->$" . $security;

			$deposit = ($security + $rate + $app_fee);
			echo "<br>Move-In --->$" . $deposit; //first + last + security
			
						?>

					</div>
					<div class='col-md-2'>

					
					<?php 
						
						$due = ((($weeks) * $rate)+($security + $rate + $app_fee));
						echo "DUE--->$" . $due;


						$tot_owed  += $due;

						echo "<br>PAID--->$" . $client_profit;
						$owed = ($due - $client_profit);

					$banked = $loss = 0;
					

					if( $owed < 0 || get_field( "move-out_date", $lead->ID ) ){
						if( $owed < 0 ){ 
							$banked = (-$owed);
							echo "<br>BANKED: $" . $banked;
						 }
						else{ 
							$loss = $owed; 
							echo "<br>LOSS: $" . $loss;

							
						}
						if( get_field( 'security_applied', $lead->ID ) == "yes"  ){ 
								echo "<br>SECURITY APPLIED!!";
								$final = ((-$loss) + $security);
								echo "<br>FINAL: $" . $final;
							}

						$owed = 0; 
					}
						echo "<br>Owed: $" . $owed; 
				
						

						$tot_due += $owed;
					?>
					
					</div>
					<div class='col-md-3'>
				
						
				<?php
					echo "<a target='_blank' href='/admin/report/?type=tenants&ID=" . $lead->ID . "' class='btn btn-default btn-block'>FULL REPORT</a>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default btn-block'>Edit</a>";

				
				if( !get_field( "move-out_date", $lead->ID ) ){ 
					?>

		<form method="post" action="" class='pull-left1'>
			<button name="update" type="submit" class='btn btn-block btn-danger' value="Remove Lead" />Move Out</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="move_out" type="hidden" value="true" />
			<input name="move_out_date" type="hidden" value="<?php echo current_time( 'm/d/y' );  ?>" />
		</form>

					<?php 
				}
				?>

				
				<button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>More</button>
					</div>

					<div class='clearfix'></div>
		</div> <!--  #MOVED OUT Div  -->
<!--  ///////////////////////////////  END Top  ///////////////////////////////   -->

<!--  ///////////////////////////////  Start Bottom ///////////////////////////////   -->
<?php

					echo "<div id='details" . $lead->ID .  "' class='details' style='display: none;'>";

				?>

					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>

				<?php
					

					
					array_push( $nums, get_field( 'lead_phone', $lead->ID ) );

					echo '<br>Email: ' . get_field( 'lead_email', $lead->ID );

					echo get_field( 'lead_city', $lead->ID ); 


					/*if( $lead["2.3"] ){
					echo "<b>Location: </b> " . $lead["2.3"] . ", " . $lead["2.4"] . " " . $lead["2.5"] . "<br><br>";
					}else	{
					echo "<b>Location:</b> Philadelphia, PA<br>";
					}*/

					
					echo "<div class='col-sm-4' ><b>Last Seen: </b> " . date('n/j/y', strtotime( get_field( 'last_seen', $lead->ID ) ) ) . "</div>"; 
					echo "<div class='col-sm-4' ><b>Last Contacted: </b> " . date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ) . "</div>"; 
					echo "<div class='col-sm-4' ><b>Added: </b> " . mysql2date('n/j/y', $lead->post_date ) . "</div>"; 
					
				// ####################   Service Log	#########

				//$client_profit = 0;

				?>
				<div class='clear'><br><br></div>
				<div class='col-xs-6 col-sm-2'><b>Date</b></div>
				<div class='col-xs-6 col-sm-2'><b>Time</b></div>
				<div class='col-sm-2'><b>Location</b></div>
				<div class='col-sm-2'><b>Service</b></div>
				<div class='col-sm-2'><b>Trans ID</b></div>
				<div class='col-sm-2'><b>Rate</b></div>
				<div class='clearfix'></div>

				<hr>

				<?php 

				// check if the repeater field has rows of data
				if( have_rows('service_log' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('service_log', $lead->ID ) ) : the_row();
				
				?>

			       <div class='col-xs-6 col-sm-2'><?php echo get_sub_field('date'); 

							?></div>
				<div class='col-xs-6 col-sm-2'><?php the_sub_field('time'); ?></div>
				<div class='visible-xs'><br><br></div>
				<div class='col-sm-2'><?php the_sub_field('location'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-sm-2'><?php the_sub_field('service'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-sm-2'><?php the_sub_field('trans_id'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-sm-2'>$<?php the_sub_field('rate'); ?></div>
				
				<?php 
					//$client_profit += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT));
					//$total_amount += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT)); ?>
				<div class='clearfix'></div>
				<hr>
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;

?>

		<form method="post" action="" name="add_transaction">
				<div class='col-xs-6 col-sm-2'><input  type="text" name="trans_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" ></div>
				<div class='col-xs-6 col-sm-2'><input type="text" name="trans_time" placeholder="Time" value="<?php echo current_time( 'g:i' ); ?> pm" ></div>
				<div class='col-sm-2'><input type="text" name="trans_location" placeholder="Location" value="My Place"></div>
				<div class='col-sm-4'><input type="text" name="trans_service" placeholder="Service" Value="Room Rent"></div>
				
				<div class='col-sm-2'><span class='amount'>$<input type="text" name="trans_amount" placeholder="" ></span></div>				
				<input type="hidden" name="client_name" value="<?php echo $lead->post_title; ?>">
				<input type="hidden" name="client_city" value="<?php echo get_field( 'lead_city', $lead->ID ); ?>">
				<input type="hidden" name="client_phone" value="<?php echo get_field( 'lead_phone', $lead->ID ); ?>">
				<input type="hidden" name="client_state" value="<?php echo get_field( 'lead_state', $lead->ID ); ?>">
				
				<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
				<input name="client_id" type="hidden" value="<?php echo $lead->ID; ?>" />

				<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
				<input type='hidden' name='insert_transaction' value='true'>
				<input type='hidden' name="update" value='true'>
				<input type="submit" class="pull-right">
			</form>
				
				<div class='clearfix'></div>
				<hr>
			<?php 
				// #################### END Service Log	#########

				?>
				
				<div class='col-xs-6 col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>

					<div class='pull-right'><?php echo "Total: $" . $client_profit; ?></div><br>
					<div class='pull-right'><?php 
								//$due = ((($weeks-1) * $rate)+($security + $rate + $app_fee));

								//echo "DUE-->" . $due;
								$owed = ($due - $client_profit);
								echo "<br>Owed: $" . $owed; 
								
							if( get_field( 'security_applied', $lead->ID ) == "yes"  ){ 
								echo "<br>SECURITY APPLIED!!";
								$final = ((-$owed) + $security);
								echo "<br>FINAL: $" . $final;
							}
				?></div>
					
				</div>
				<?php 
					
				
				
				
					echo "<div class='clearfix'></div><br>";
					echo "<div class='col-xs-12' ><b>Area Code: </b> " . get_field( 'area_code', $lead->ID ) . "</div><br>";
					echo "<div class='col-xs-12' ><b>Description: </b> " . $lead->post_content . "</div><br>";
					echo "Forms:<br>";
			?>
					<div class='col-xs-6'>
						<img src='<?php echo get_field( 'file_1', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<div class='col-xs-6'>
						<img src='<?php echo get_field( 'file_2', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<img src='<?php echo get_field( 'file_3', $lead->ID ); ?>' class='img-responsive'>
			<?php 	
					echo "<div class='clearfix'></div><br>";


					?>

		<form method="post" action="" class='pull-left'>
			<button name="update" type="submit" class='btn btn-danger' value="Remove Lead" />Delete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="post_to_draft" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>

				<?php
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default pull-left'>Edit</a>";

					echo "<a target='_blank' href='/admin/tenant-report/?ID=" . $lead->ID . "' class='btn btn-default pull-left'>FULL REPORT</a>";
				
					echo "<br></div><div class='clearfix'></div>";
				?>
		</div>
<?php				

					}// #END IF Published

?>

<!--  ///////////////////////////////  END Bottom ///////////////////////////////   -->


		

		<?php if ( get_field( "move-out_date", $lead->ID ) ){ ?>
		
		<div id='show-moved-out' style='display: none;'>
			<div class="alert alert-info">
			 <strong>Moved Out</strong> <button id='moved-out<?php echo "-" . $lead->ID; ?>'>View</button>	
			<hr>
			</div>
		</div>

		<?php }else{ ?>

			<div class="alert alert-info">
			  <strong>Success!</strong> Indicates a successful or positive action.
			</div>

			<hr>

		<?php } ?>
		

		

		<?php
				}else{  echo "Private<hr><br>" ; } 
				

				}	//END ELSE MOVE OUT


				}// END FOR EACH LEADS
?>
	</div>
<?php
				echo "<div id='summary'></div><br><br>";
				//print_r( $leads );

				echo "SUMMARY<hr>";
				
				echo $tot_count . "  " . $post->post_name;
				echo "<br><br>TOTAL---> $" .  $total_amount; 
				//echo "<br><br>EXPENSE--> $" . $tot_expense; 
				//echo "<br><br>PROFIT---> $" . ($tot_income - $tot_expense); 

				$tot_paid = $total_amount;

				echo "<br><br>TOTAL Owed---> $" . $tot_owed;

				echo "<br><br>TOTAL Paid---> $" . $tot_paid;

				echo "<br><br>TOTAL Due ---> $" . $tot_due;

				//print_r($names);
				
				$con_cnt = 0;

				foreach( $names as $name ){

					if( $nums[$con_cnt] == "" ){ 
						$con_cnt++;
						continue;

					}else{
						//echo "<br>" . $con_cnt . "->" . $name;
						echo "<br>" . $name;
						$con_cnt++;
					}
				}
	

				$con_cnt = 0;

				foreach( $nums as $num ){
					if( $num == "" ){ 
						 $con_cnt++;
						continue;
						//echo "<br>" . $con_cnt . "->NEEDED"; 

					}else{
						//echo "<br>" . $con_cnt . "->" . $num;
						echo "<br>" . $num;
						$con_cnt++;
					}
					
				}

				echo "<br><br>";


			// Reset Query
			wp_reset_query();


/*********************************************************/


		echo "</div>";



?>