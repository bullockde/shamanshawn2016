<?php 
	
		echo "<div class='container'>";
		echo "<br><br><div class='clearfix'></div>";

	?>

		<div class='row'>
			<div class='col-xs-6'>

				<?php
				the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
				?>
			</div>	
			<div class='col-xs-6'>

				
				<button id='newtrip' class='btn btn-lg btn-default pull-right'>New Trip</button>
			</div><div class='clearfix'></div>
			<hr>


			<!--  #####################   START Filter  ##############-->
		<div id='filter' class='filter' style='display: none;'>
			
		<form id="filter">
			<div class='col-md-3'>
				
		  			City:<input type="text" name="searchterm">	
					<input type="submit">
				
			</div>
			<div class='col-md-2'>
				<select name="start_date">
				<option value="false">Days Ago</option>
				<option value="1">1 day ago</option>
				<option value="3">3 days ago</option>
				<option value="5">5 days ago</option>
				<option value="7">7 days ago</option>
				<option value="30">30 days ago</option>				
				<option value="9999">ALL TIME</option>
				</select>
			</div>
			<div class='col-md-4'>
				<select name="term">
				<option value="false">Filter Location</option>
				<option value="404">Atlanta, GA</option>
				<option value="717">Harrisburg, PA</option>
				<option value="215">Philadelphia, PA</option>
				<option value="717">Lancaster, PA</option>
				<option value="717">York, PA</option>
				<option value="215">Allentown, PA</option>
				
				<option value="202">Washington, DC</option>
				<option value="757">Norfolk, VA</option>
				<option value="804">Richmond, VA</option>
				</select>
			</div>
			<div class='col-md-3'>
				<select name="trans_type">
					<option value="false">Transaction Type</option>
					<option value="404">Massage Service</option>
					<option value="717">Hotel / Travel</option>
					<option value="215">Party / Fun</option>
					<option value="717">Food / Dining </option>
					<option value="717">Adult Entertainment</option>
					
				</select>				
				
			</div>
		</form>
			<br><br><hr>
		</div>
<!--  #####################   END Filter  ##############-->

			<?php 
				$start_date = 9999;

				if( isset( $_GET['start_date'] ) ){ $start_date = $_GET['start_date']; }
			?>
		</div>

		<div id='newtrip' class='clear' style='display: none;'>
			<form id='insert_lead' method='post'>
			
		<input type="hidden" name="cur_post_type" value="trips">

	
		<div class='col-md-2'><input type="text" name="client_name" placeholder="Enter Name"></div>
		<div class='col-md-2'><input type="text" name="start_date" placeholder="Start Date"></div>
		<div class='col-md-2'><input type="text" name="end_date" placeholder="End Date"></div>
		<div class='col-md-2'><input type="text" name="trip_state" placeholder="PA"></div>
		<div class='col-md-2'><input type="text" name="trip_area_code" placeholder="Area Code"></div>
		<div class='col-md-1'><input type="submit" value="Add"></div><br>
		<div class='clearfix'></div>
		
		<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		
		<input type='hidden' name='insert_client' value='true'>
		<input type='hidden' name="update" value='true'>
		
		<div class='clearfix'></div>
			</form>
	</div><!--  #END new trip  -->
	
		<div class='col-md-2'><h2>Date</h2></div>
		<div class='col-md-3'><h2>Location</h2></div>
		<div class='col-md-2'><h2>Income</h2></div>
		<div class='col-md-2'><h2>Expense</h2></div>
		<div class='col-md-2'><h2>Profit</h2></div><br>
		<div class='clearfix'></div>
			<hr>
		<?php
			/*********************************************************/


			// The Query

			$args = array( 

				'post_type' => 'ssi_trips',
				'posts_per_page' => 10

			 );
			$leads = get_posts( $args );

			//print_r($leads);


			/* VARIABLES
			**********************************************/
			
			$trans_count = 0;

			$tot_trans = count($leads);
			$tot_income = 0;
			$tot_expense = 0;


			
/* ####################  START Trip  ########################### */		
			foreach( $leads as $lead ){

		
				
			$trip_inc = 0;
			$trip_exp = 0;
			$trip_prof = 0;


	

/* ###################   START Service Log  ############################ */

			
			$args = array( 

				'post_type' => 'ssi_transactions',
				'posts_per_page' => 100

			 );
			$trip_trans = get_posts( $args );

			
		foreach( $trip_trans as $trans ){ 

				$start_date = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $lead->ID )) );
			$end_date = date( 'm/d/y' , strtotime(get_field( 'trip_end_date', $lead->ID )) );
				
				$before = strtotime($start_date);
				$current = strtotime( date( 'm/d/y' , strtotime( $trans->post_date) ) );
				$after = strtotime($end_date);



	if ( $before <= $current ){  if($current <= $after ){  


		if( get_field( 'exclude_trans', $trans->ID ) == 'Yes' ){ }else{

				
		
		?>


		<?php

							if( get_field( 'income_expense', $trans->ID ) == '-' ){ 

				$tot_expense += get_field( 'trans_amount', $trans->ID );
				$trip_exp += get_field( 'trans_amount', $trans->ID );
				

			}else{  

				$tot_income += get_field( 'trans_amount', $trans->ID );
				$trip_inc += get_field( 'trans_amount', $trans->ID );
				

			}
				?>
		
		<?php 
	

/* ####################  END trans  ########################### */
	} } } // END IF DATE CHECK
				
		
				
			}
					
				echo "<br></div><div class='clearfix'></div>";
				
					

				$today = strtotime('today');
				$today_end = strtotime('tomorrow');
				$date = '03/12/2015'; #could be (almost) any string date


				$date_timestamp = strtotime($date);
				
				$trans_count++;
				$public = 1;
				
				$client_id = 0;
				
				$confirmed = false;
				
				if( get_field( 'client_id', $lead->ID ) ){
					//echo "Client ID: " . get_field( 'client_id', $lead->ID );
					$confirmed = true; $client_id = get_field( 'client_id', $lead->ID );
					echo "<br>";
				}

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>
	


	<div class='col-md-1'> 
					
						<?php
							echo date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $lead->ID )) );

							 //echo mysql2date('n/j/y', $lead->post_date ); 

							if( $trans_count == $tot_trans ){
								$start_date = mysql2date('n/j/y', $lead->post_date );
							} 
						?>
					</div>
					<div class='col-md-1'> 
					
						<?php 
							echo date( 'm/d/y' , strtotime(get_field( 'trip_end_date', $lead->ID )) );

							//echo mysql2date('n/j/y', $lead->post_date ); 

							if( $trans_count == $tot_trans ){
								$start_date = mysql2date('n/j/y', $lead->post_date );
							} 
						?>
					</div>
					<div class='col-md-3'> 

						<?php echo "-"; ?>
						<?php 
							if	( $lead->post_title )	{ 
							
							
							
							echo $lead->post_title; }
						 ?>
						 
						 
						<?php  ?>
					</div>
					<div class=' col-md-2'>
						
						<?php 
						
						echo get_field( 'trip_connections', $lead->ID );
					 ?>
						 Connections
						
					</div>
					<div class='col-md-1'>
						
						<?php echo "+ $";  ?>

						<?php 
							 echo $trip_inc; 
						 ?>
					</div>
					<div class='col-md-1'>

						<?php echo "- $"; ?>
						<?php 
							 echo $trip_exp; 
						 ?>
					</div>
					<div class='col-md-1'>

						<?php echo "$"; ?>
						<?php echo $trip_inc-$trip_exp; ?>

					</div>
					
					<div class='col-md-1'>

						
						<button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>View</button>
					</div>



<!--  ################################################################  -->

				<?php

					echo "<br><br><div id='details" . $lead->ID .  "' class='details' style='display: none;'>";

					?>


		<div class='col-md-2'><h2>Date</h2></div>
		<div class='col-md-2'><h2>Name</h2></div>
		<div class='col-md-2'><h2>Phone#</h2></div>
		<div class='col-md-2'><h2>City</h2></div>
		<div class='col-md-2'><h2>State</h2></div>
		<div class='col-md-2'><h2>Amount</h2></div><br>
		<div class='clearfix'></div>
			<hr>
		<?php 

/* ###################   START Service Log  ############################ */

			
			$args = array( 

				'post_type' => 'ssi_transactions',
				'posts_per_page' => -1

			 );
			$trip_trans = get_posts( $args );

			
		foreach( $trip_trans as $trans ){ 

				$start_date = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $lead->ID )) );
			$end_date = date( 'm/d/y' , strtotime(get_field( 'trip_end_date', $lead->ID )) );
				
				$before = strtotime($start_date);
				$current = strtotime( date( 'm/d/y' , strtotime( $trans->post_date) ) );
				$after = strtotime($end_date);



	if ( $before <= $current ){  if($current <= $after ){ 


 	if( get_field( 'exclude_trans', $trans->ID ) == 'Yes' ){ }else{
		
		?>

		<div class='col-md-2'> 
					
						<?php echo mysql2date('n/j/y', $trans->post_date ); 

							if( $trans_count == $tot_trans ){
								$start_date = mysql2date('n/j/y', $trans->post_date );
							} 
						?>
					</div>
					<div class='col-md-2'> 

						<?php echo "-"; ?>
						<?php 
						$client_id = 0;
						
						if( get_field( 'client_id', $trans->ID ) ){
							$client_id = get_field( 'client_id', $trans->ID );
					
						}
						
							if	( $trans->post_title )	{ 
							
							
							?>
							
							
							<a href='/admin/report/?ID=<?php echo $client_id; ?>' target='_blank' ><?php echo $trans->post_title; ?></a>
							<?php
							}
							else				{ echo 'New Request'; 
							
							
						//	if	( $lead->post_title == 'New Request'  )	{ 
									echo "HERE";
							  $my_post = array(
								  'ID'           => $trans->ID,
								  'post_status'   => 'draft',
								 // 'post_content' => 'This is the updated content.',
							  );

							// Update the post into the database
							 // wp_update_post( $my_post );
						//	}
							
							
							
							
							}
						 ?>
						<?php  ?>
					</div>
					
					<div class='col-md-2'>
						
						<?php echo "-";  ?>

						<?php 
							if( $confirmed )	{ echo get_field( 'lead_phone', $client_id ); }
							else			{ echo get_field( 'trans_phone', $trans->ID ); }
						 ?>
					</div>
					<div class='col-md-2'>

						<?php echo "-"; ?>
						<?php 
							if( /*$confirmed*/ 0 )	{ echo get_field( 'lead_city', $client_id ); }
							else			{ echo get_field( 'trans_city', $trans->ID ); }
						 ?>
					</div>
					<div class='col-md-1'>

						<?php echo "-"; ?>
						<?php echo get_field( 'trans_state', $trans->ID ); ?>

					</div>
					<div class='col-md-2'>

						<?php

							if( get_field( 'income_expense', $trans->ID ) == '-' ){ 

				echo "- "; 
				

			}else{  

				echo "+ ";  
			}
				?>

						
						<?php echo "$"; ?>
						<?php echo get_field( 'trans_amount', $trans->ID ); ?>
						
					</div>
					<div class='col-md-1'>

						
						<button id='details<?php echo $trans->ID; ?>' class='btn btn-default btn-block'>View</button>
					</div>

			<?php 

				echo "<br><br><div id='details" . $trans->ID .  "' class='details' style='display: none;'>";


					?>

					
					<div class='col-md-2 hide'>
						
						<?php echo "-"; ?>
						<?php echo get_field( 'trans_email', $trans->ID ); ?>

					</div>

					<?php
					
					echo "<div class='col-xs-4' ><b>Time: </b> " . get_field( 'trans_time', $trans->ID ) . "</div>"; 
					echo "<div class='col-xs-4' ><b>Location: </b> " . get_field( 'trans_location', $trans->ID ) . "</div>"; 
					echo "<div class='col-xs-4' ><b>Service: </b> " . get_field( 'trans_service', $trans->ID ) . "</div>"; 

					echo "<div class='clearfix'></div><br>"; 

					echo "<div class='col-xs-12' ><b>Note: </b> " . $trans->post_content . "</div>";
					
				?>


				


				<?php
					echo "<div class='clearfix'></div><br>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $trans->ID . "&action=edit' class='btn btn-default'>Edit</a>";

					echo "<br></div>";

				?>

		<?php 
		echo "<hr><br>"; 

/* ####################  END trans  ########################### */
	} } } // END IF DATE CHECK
				
		
				
			}
					
				?>
					<?php get_template_part( 'content', 'add-transaction' ); ?>
				<?php

					
					echo "<div class='clearfix'></div><br>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default'>Edit Trip</a>";

					echo "<br></div><div class='clearfix'></div>";
				
					?>



<!--  #########################################################  -->


			<?php
					echo "<hr>";
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 
					
				}
				echo "<br><br>";
				
/* ####################  END Trip  ########################### */	
	

				echo "SUMMARY<hr>";
				
				echo $trans_count . "  Trips Since: " . str_replace( "-", "", $start_date ) /* . "ago"*/;
				echo "<br><br>INCOME---> $" . $tot_income; 
				echo "<br><br>EXPENSE--> $" . $tot_expense; 
				echo "<br><br>PROFIT---> $" . ($tot_income - $tot_expense); 

				echo "<br><br>";
			// Reset Query
			wp_reset_query();


/*********************************************************/


		echo "</div>";
?>