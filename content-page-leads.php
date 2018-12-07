<?php 
		echo "<div class='container'>";
			
		echo "<br><br><div class='clear'></div>";
		
	?>
		<div class='row'>
			<div class='col-xs-6'>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>	
			<div class='col-xs-6'>
				<button id='newpost' class='btn btn-lg btn-default pull-right'>Add New</button>
				<button id='filter' class='btn btn-lg btn-default pull-right'>Filter</button>
				<a href='#summary' class='btn btn-lg btn-default pull-right'>Summary</a>
			</div><div class='clear'></div>
			<hr>
		</div>
	

<button id='add_trans' class='btn btn-info btn-block'>Add Transaction</button><br>

<div id='add_trans' class='clear' style='display: none;'>
				<form id='inert_transaction' method='post'>
		<div class='col-md-2'><input  type="text" name="trans_date" placeholder="Date (mm/dd/yy)"  value="<?php echo current_time( 'm/d/y' ); ?>"></div>
		<div class='col-md-2'><input type="text" name="client_name" placeholder="Name" value="!No Name!"></div>
		<div class='col-md-2'><input type="text" name="client_phone" placeholder="Phone"></div>
		<div class='col-md-2'><input type="text" name="client_city" placeholder="City"></div>
		<div class='col-md-1'><input type="text" name="client_state" placeholder="State"></div>

		<div class='col-md-2'>
<select name="meeting_place" form="insert_lead">
  <option value="A4A">Adam4Adam</option>
  <option value="BP">BackPage</option>
  <option value="CL">Craigslist</option>
  <option value="Xtube">Xtube</option>
<option value="CB">Chaturbate</option>
<option value="Other">Other</option>

</select>


</div>
		
		<div class='col-md-1'>
			<input type="submit" class="btn btn-sm btn-block" value="Add">
			<div class='clear'></div>
			
		</div>
		
		
		<div id='Details' style='display: none;'>
		<div class='clear'></div>

		<div class='col-md-1'><input type="text" name="trans_amount" placeholder="Rate"></div>
		<div class='col-md-1'>
			<input type="radio" name="income_expense" value="+">+<br>
			<input type="radio" name="income_expense" value="-">-
			
		</div>
		<div class='col-sm-1' ><input type="text" name="area_code" placeholder="Area"></div>
		<div class='col-sm-2' ><input type="text" name="last_seen" placeholder="Last Seen"></div>
		<div class='col-sm-2' ><input type="text" name="last_contacted" placeholder="Last Contacted"></div>
		<div class='col-sm-2' ><input type="text" name="post_date" placeholder="Added"></div>
		<div class='col-sm-3' ><input type="text" name="notes" placeholder="Notes"></div>
		<div class='clear'></div>
		</div>
		<input type="hidden" name="cur_post_type" value="<?php echo $post->post_name; ?>">
		<input type='hidden' name='insert_client' value='true'>
		<input type='hidden' name="update" value='true'>
		
		
	</form>
			<hr>
			<button id='Details' class='btn btn-sm btn-default btn-block'>Full Form</button>

			

		</div><!--  #END Transaction  -->



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
		<div class='clear'></div>
		<hr>

		<div class='col-sm-2' ><input type="text" name="area_code" placeholder="Area"></div>
		<div class='col-sm-2' ><input type="text" name="last_seen" placeholder="Last Seen"></div>
		<div class='col-sm-2' ><input type="text" name="last_contacted" placeholder="Last Contacted"></div>
		<div class='col-sm-3' ><input type="text" name="post_date" placeholder="Added"></div>
		<div class='col-sm-3' ><input type="text" name="notes" placeholder="Notes"></div>


		<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		
		<input type='hidden' name='insert_client' value='true'>
		<input type='hidden' name="update" value='true'>
		
		<div class='clear'></div>
	</form>
	<br><hr>
</div>


	<?php get_template_part( 'content', 'filter' ); ?>


		<div class='clear'></div>
	

	
		<div class='col-md-2'><h2>Name</h2></div>
		<div class='col-md-3'><h2>Email</h2></div>
		<div class='col-md-2'><h2>Phone#</h2></div>
		<div class='col-md-2'><h2>City</h2></div>
		<div class='col-md-1'><h2>State</h2></div>
		<div class='col-md-2'><h2>Details</h2></div><br>
		<div class='clear'></div>
		
			<br><hr>
			
		<?php
			/*********************************************************/
			
			$tot_count = 0;

			$total_amount = 0;

	// The Query
			

		if( is_page('contacts') ){ 

				$clients = get_posts( array( 'post_type' => 'clients' , 'posts_per_page' => -1 ) );
				$friends = get_posts( array( 'post_type' => 'friends' , 'posts_per_page' => -1 ) );
				$family = get_posts( array( 'post_type' => 'family' , 'posts_per_page' => -1 ) );

				$followers = get_posts( array( 'post_type' => 'followers' , 'posts_per_page' => -1 ) );
				$leads = get_posts( array( 'post_type' => 'leads' , 'posts_per_page' => -1 ) );
				
				$tenants = get_posts( array( 'post_type' => 'tenants' , 'posts_per_page' => -1 ) );
			
				$leads = array_merge($clients,$friends,$leads,$family,$tenants,$followers);
			}else{
				$args = array( 'post_type' => 'ssi_contact', 'category-name' => $post->post_name , 'posts_per_page' => -1, 'orderby'=> 'modified' );
				$leads = get_posts( $args );
			}

		
			

			//$clients = get_posts(array( /*'post_type' => 'ssi_contact',*/ 'posts_per_page' => -1, 'orderby'=> 'modified', 'category' => 169 ));
			
			$clients = get_posts( array( 'post_type' => 'ssi_contact', 'posts_per_page' => -1, 'category-name' => $post->post_name, 'orderby'=> 'modified' ));
			//print_r($clients);
			
			$Temp = array();
			foreach($clients as $client){
				
				//print_r($client);
				if( has_category($post->post_name, $client->ID) ){ 
					//echo " HERE <br><br>" ;
				
					//array_push( , );
				}
				//echo " <hr>" ;
			}
			
			//print_r($clients);
			
			
		
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
			
			foreach( $leads as $lead ){
			
					$tot_count++;

					$public = 1;

					

					//echo "<div class='row'><div class='col-md-6'>";
					//echo "<div class='col-md-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>
					<div class='col-md-2'> 

						<?php if( get_user_by('email', get_field( "lead_email", $lead->ID ) ) ){
							
							$user = get_user_by('email', get_field( "lead_email", $lead->ID ));
							
							
					echo "User ID: " . $user->ID . "<br>";
				
				}else{ 
						?>
						
							<?php 
		
		if( get_field( "lead_email", $lead->ID ) && !get_user_by('email', get_field( "lead_email", $lead->ID ) ) ){ 
		
		?>
		
		<form method="post" action="" class=''>
			<button name="ssi_add_user" type="submit" class='btn btn-warning' value="Add User" />Add User</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form> 
		<br>
		<?php }
		
		?>
		
						<?php 

				}

						?>
						<?php if($lead->post_title){ 

							?>
						
						<a href='/admin/report?<?php ?>'> </a>

							<?php

						echo "<a target='_blank' href='/admin/report/?ID=" . $lead->ID . "&type=" . $lead->post_type . "' class=''>" . $lead->post_title . "</a>";
															
								array_push( $names, $lead->post_title );

							}else{ echo 'New Request'; } ?>


					</div>
					<div class='col-md-3'>
						
						<?php echo "&nbsp;"; ?>
						<?php echo get_field( 'lead_email', $lead->ID ); ?>
					
						
<!--  ///////////////////////////////  DATE MAGIC  ///////////////////////////////   -->
	<?php  			
		if( is_page('tenants') ){ 

			$s_date = mysql2date('n/j/y', $lead->post_date );
			$e_date = "01/06/16";

			$rate = get_field( 'room_rate', $lead->ID );

			$date1 = date_create( $s_date );
			$date2 = date_create( $e_date );

			$diff=date_diff($date1,$date2);
	
			$days = $diff->format("%a");

			echo "TOTAL DAYS--->" . $days;

			$weeks = floor($days/7);

			$app_fee = 25;

			echo "<br>TOTAL WEEKS--->" . $weeks;

			echo "<br>Security (return) --->$" . (2 * $rate);

			echo "<br>Deposit--->$" . ((3 * $rate) + $app_fee); //first + last + security
			
			
			echo "<br>DUE--->$" . (($weeks-1) * $rate);

			echo "<br>Balance--->$" . ((($weeks-1) * $rate)+((3 * $rate) + $app_fee));
		}//  #END IF
	?>

<!--  ///////////////////////////////  #DATE MAGIC  ///////////////////////////////   -->

					</div>
					<div class='col-md-2'>
						
						<?php echo "&nbsp;"; ?>
						<?php 

							echo get_field( 'lead_phone', $lead->ID ); 
							array_push( $nums, get_field( 'lead_phone', $lead->ID ) );
						?>

					</div>
					<div class='col-md-2'>

						<?php echo "&nbsp;"; ?>
						<?php echo get_field( 'lead_city', $lead->ID ); ?>

					</div>
					<div class='col-md-1'>

						<?php echo "&nbsp;"; ?>
						<?php 
							if ( get_field( 'lead_state', $lead->ID ) == 'Pennsylvania' ) {
								echo "PA"; 
							}else{
								echo get_field( 'lead_state', $lead->ID ); 
							}



						?>

					</div>
					<div class='col-md-2'>

						
						<button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>Details</button>
					</div>
					
<div class='clear'></div>
				<?php

					echo "<br><br><div id='details" . $lead->ID .  "' class='details' style='display: none;'>";

				?>

					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>

				<?php
					
					/*if( $lead["2.3"] ){
					echo "<b>Location: </b> " . $lead["2.3"] . ", " . $lead["2.4"] . " " . $lead["2.5"] . "<br><br>";
					}else	{
					echo "<b>Location:</b> Philadelphia, PA<br>";
					}*/

				?>
				
				
		<form id="update" method='post'>		
				<div class='col-sm-4' >
					<b>Last Seen: </b> 
					
					<input type="text" name="update_last_seen" value="<?php echo date('n/j/y', strtotime( get_field( 'last_seen', $lead->ID ) ) ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Last Contacted: </b> 
					
					<input type="text" name="update_last_contacted" placeholder="Last Contacted" value="<?php echo date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Added: </b> 
					
					
					<input type="text" name="update_date_added" placeholder="Date Added" value="<?php echo mysql2date('n/j/y', $lead->post_date ); ?>">
				</div>
				
				<div class='clear'></div>
				<hr>
				
				<div class='info'>
				<u>Details</u><br>
				
				<b>Area Code: </b> <input type="text" name="update_area_code" placeholder="Area Code" value="<?php echo get_field( 'area_code', $lead->ID ); ?>">
				
				
				
				<b>D.O.B: </b> <input width="100" type="text" name="update_dob" placeholder="D.O.B" value="<?php echo get_field( 'lead_dob', $lead->ID ); ?>">
				
				</div>
				
			
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
	
				<button name="ssi_update_cf" type="submit" class='btn btn-info' value="Update" />Update</button>
			</form>	
				
				
				
				<?php 
					
					
				// ####################   Service Log	#########

				$client_profit = 0;

				?>
				<div class='clear'><br><br></div>
				<div class='col-xs-6 col-sm-2'><b>Date</b></div>
				<div class='col-xs-6 col-sm-2'><b>Time</b></div>
				<div class='col-sm-2'><b>Location</b></div>
				<div class='col-sm-2'><b>Service</b></div>
				<div class='col-sm-2'><b>Trans ID</b></div>
				<div class='col-sm-2'><b>Rate</b></div>
				<div class='clear'></div>

				<hr>

				<?php 

				// check if the repeater field has rows of data
				if( have_rows('service_log' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('service_log', $lead->ID ) ) : the_row();
				
				?>

			       <div class='col-xs-6 col-sm-2'><?php echo get_sub_field('date'); ?></div>
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
					$client_profit += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT));
					$total_amount += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT)); ?>
				<div class='clear'></div>
				<hr>
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;

?>

		<button id='add_payment' class='btn btn-info btn-block'>Add Payment</button><br>

	<div id='add_payment' class='' style='display: none;'>
		<form method="post" action="" name="add_transaction">
				<div class='col-xs-6 col-sm-2'><input  type="text" name="trans_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" ></div>
				<div class='col-xs-6 col-sm-2'><input type="text" name="trans_time" placeholder="Time" value="<?php echo current_time( 'g:i a' ); ?>" ></div>
				<div class='col-sm-2'><input type="text" name="trans_location" placeholder="Location" value="My Place"></div>
				<div class='col-sm-4'><input type="text" name="trans_service" placeholder="Service" Value="Service"></div>
				
				<div class='col-md-1'><input type="text" name="trans_amount" placeholder="Rate"></div>
		<div class='col-md-1'>
			<input type="radio" name="income_expense" value="+">+<br>
			<input type="radio" name="income_expense" value="-">-
		</div>		
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
		</div>
				<div class='clear'></div>
				<hr>
			<?php 
				// #################### END Service Log	#########

				?>
				
				<div class='col-xs-6 col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'><div class='pull-right'><?php echo "Total: $" . $client_profit; ?></div></div>
				<?php 
					
				
				
				
					echo "<div class='clear'></div><br>";
						
					echo "Forms:<br>";
			?>
			
			
		
			
		<?php if( get_field( 'file_1', $lead->ID ) ){ ?>
			<a target="_blank" href="<?php echo get_field( 'file_1', $lead->ID ); ?>">Client Intake (Front) </a><br>
		<?php } ?>
		<?php if( get_field( 'file_2', $lead->ID ) ){ ?>
			<a target="_blank" href="<?php echo get_field( 'file_2', $lead->ID ); ?>">Client Intake (Back)</a><br>
		<?php } ?>

		
			
			<div class='clear'></div>
					<div class='col-xs-6'>
					
						
						
						<img src='<?php echo get_field( 'file_1', $lead->ID ); ?>' class='img-responsive'>	
					</div>
					<div class='col-xs-6'>
					
						<img src='<?php echo get_field( 'file_2', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<img src='<?php echo get_field( 'file_3', $lead->ID ); ?>' class='img-responsive'>
			<?php 	
					echo "<div class='clear'></div><br>";
					
					
					echo "<div class='col-xs-12' ><b>Notes: </b> " . $lead->post_content . "</div><br>";


					?>

		<form method="post" action="" class='pull-left'>
			<button name="update" type="submit" class='btn btn-danger' value="Remove Lead" />Delete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="post_to_draft" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
		
	

				<?php
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default pull-left'>Edit Lead</a>";
				
					echo "<br></div><div class='clear'></div><hr>";
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 

				}
				
				
?>
<div id='summary'></div><br><br>



<?php 
				
				//print_r( $leads );

				echo "SUMMARY<hr>";
				
				echo $tot_count . "  " . $post->post_name;
				echo "<br><br>TOTAL---> $" .  $total_amount; 
				//echo "<br><br>EXPENSE--> $" . $tot_expense; 
				//echo "<br><br>PROFIT---> $" . ($tot_income - $tot_expense); 

				//print_r($names);
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



?>

</div>