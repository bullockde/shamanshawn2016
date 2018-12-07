<?php
/**
 * 
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
		<div id="content" class="" role="main">

<div id='p'>
			
			<?php
				
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.

				if( is_page( array('admin' , 'connect' , 'entertainment' ) ) || $post->post_parent == '8383' ){  // IF ADMIN SECTION
					//echo 'CHILD OF Admin';
				
		$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
		if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) { // LOGGED-IN Check

				echo '<div class="container">';

		/*	if( 1 ){ 

				$clients = get_posts( array( 'post_type' => 'clients' , 'posts_per_page' => -1 ) );
				$friends = get_posts( array( 'post_type' => 'friends' , 'posts_per_page' => -1 ) );
				$family = get_posts( array( 'post_type' => 'family' , 'posts_per_page' => -1 ) );

				$followers = get_posts( array( 'post_type' => 'followers' , 'posts_per_page' => -1 ) );
				$leads = get_posts( array( 'post_type' => 'leads' , 'posts_per_page' => -1 ) );
				
				$tenants = get_posts( array( 'post_type' => 'tenants' , 'posts_per_page' => -1 ) );
			
				$leads = array_merge($clients,$friends,$leads,$family,$tenants,$followers);

			}else{
				$args = array( 'post_type' => $post->post_name , 'posts_per_page' => -1 );
				$leads = get_posts( $args );
			}


		*/

		$type = $_GET['type'];
		$tenant_id = $_GET['ID'];

		
	
	$leads = get_posts( array( 'post_type' => $type , 'post__in' => array($tenant_id) ) );

	//$leads = get_post( $tenant_id , ARRAY_A );

	//print_r( $leads );
	foreach( $leads as $lead ){


			?>


		<div class='row info'>
			
			<div class='col-xs-6 '>


				
				<?php if($lead->post_title){ 

								echo "<strong>" . $lead->post_title . "</strong>"; 
							
								array_push( $names, $lead->post_title );

							}else{ echo 'New Request'; } 
				?>
				<div class='col-xs-4 '>
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
				<div class='col-xs-8 '>
					<?php 
					echo '<br><br>Phone#: ' . get_field( 'lead_phone', $lead->ID ); 
					array_push( $nums, get_field( 'lead_phone', $lead->ID ) );

					echo '<br>Email: ' . get_field( 'lead_email', $lead->ID );
					?>
				</div>
					
				
			</div>
			<div class='col-xs-6 '>
				
	
				<div class='col-sm-6'>

					
					
					<button id='payments' class='btn btn-default btn-block'>View Payments</button>
					
				<?php

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
				</div>
				<div class='col-sm-6'>

					<button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>More</button>
				</div>

					<div class='clear'></div>

			</div>
		</div>

		<div class='row admin'>
			<?php 
				echo "<div id='details" . $lead->ID .  "' class='details' style='display: none;'>";
				?>
				
			<?php 	
					echo "<div class='clear'></div><br>";
					
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
				echo "<div class='clear'></div><br>";
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


			?>
		</div>

	<?php 

		if( get_field( 'security_deposit', $lead->ID ) ){ $security = get_field( 'security_deposit', $lead->ID ); }
		else{ $security = (2 * $rate); }
			
			
			$deposit = ($security + $rate + $app_fee);
	?>
		
		<div id='payments' class='row payment' style='display: none;'>
			<h2>Payment Info</h2> 
			<div class='col-md-12 '>
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
				<div class='col-xs-6 col-sm-2'><input  type="text" name="trans_date" placeholder="Date" ></div>
				<div class='col-xs-6 col-sm-2'><input type="text" name="trans_time" placeholder="Time" ></div>
				<div class='col-sm-2'><input type="text" name="trans_location" placeholder="Location" ></div>
				<div class='col-sm-4'><input type="text" name="trans_service" placeholder="Service" ></div>
				<div class='col-sm-2'><input type="text" name="trans_amount" placeholder="Rate" ></div>
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
			</div>
		</div>

		<div class='row rental'>
			<h2>Rental Info</h2>
			<div class='col-xs-6 col-md-4 '>
							<?php 

							

			echo "Rate (weekly) -->$" . get_field( 'room_rate', $lead->ID );

			echo "<br>App Fee--->$" . get_field( 'app_fee', $lead->ID );

			echo "<br>Security --->$" . $security;

			echo "<br>Deposit--->$" . $deposit; //first + last + security
						
						?>
			</div>
			<div class='col-xs-6 col-md-4 '>
										
<!--  ///////////////////////////////  DATE MAGIC  ///////////////////////////////   -->
	<?php  			
		
			echo "MOVEIN: " . get_field( "move-in_date", $lead->ID );

		if( get_field( "move-out_date", $lead->ID ) ){ echo "<br>MOVEOUT: " . get_field( "move-out_date", $lead->ID ); }
			
			
			$rate = get_field( 'room_rate', $lead->ID );

			//$s_date = mysql2date('n/j/y', $lead->post_date );

			$s_date = date('Y-m-d H:i:s', strtotime(  $lead->post_date  ) );
			
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

			$diff=date_diff($date1,$date2);
	
			$tot_days = $diff->format("%a");
			//echo "TOTAL DAYS--->" . $tot_days;

			$weeks = floor($tot_days/7);

			$days = $tot_days - ($weeks*7);

			$app_fee = get_field( 'app_fee', $lead->ID );

			echo "<br>WEEKS-> " . $weeks . " DAYS-> " . $days;

	
			

	?>

<!--  ///////////////////////////////  #DATE MAGIC  ///////////////////////////////   -->


			<?php 
				echo "<div class='col-sm-12' ><b>Last Seen: </b> " . date('n/j/y', strtotime( get_field( 'last_seen', $lead->ID ) ) ) . "</div>"; 
					echo "<div class='col-sm-12' ><b>Last Contacted: </b> " . date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ) . "</div>"; 
					echo "<div class='col-sm-12' ><b>Added: </b> " . mysql2date('n/j/y', $lead->post_date ) . "</div>"; 
			?>

			</div>
	
			<div class='col-md-4 '>
				<h2 class='visible-xs'>Payment Summary</h2>

				<?php 

						$due = ((($weeks-1) * $rate)+($security + $rate + $app_fee));
						echo "<br>DUE--->$" . $due;
					?>
				<div class='pull-right'><?php echo "Total Paid: $" . $client_profit; ?></div><br>
					<div class='pull-right'><?php 
								$owed = ($due - $client_profit);
								echo "<br>Owed: $" . $owed; 
								
							if( get_field( 'security_applied', $lead->ID ) == "yes"  ){ 
								echo "<br>SECURITY APPLIED!!";
								$final = ((-$owed) + $security);
								echo "<br>FINAL: $" . $final;
							}
				?></div>
			</div>


		</div>
		<div class='row summary'>
			
			<div class='col-md-6 '>
				<h2>Notes</h2>

				<?php echo "<div class='col-xs-12' ><b>Description: </b> " . $lead->post_content . "</div><br>";		
				?>
			</div>
			
		</div>
	<?php

////////////////////////// TENANT REPORT /////////////////////////	

					if( get_field( "move-out_date", $lead->ID ) != "" ){ 

						
						array_push( $moved_out, $lead );
						


					 }else{
					
					$tot_count++;

					$public = 1;

					

		if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>
					
					
				<?php
					
					

					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 
				


				}	//END ELSE MOVE OUT
				}// END FOR EACH LEADS

////////////////////////// #TENANT REPORT /////////////////////////
				the_content();
				echo '</div>';
					
		} //END LOGGED-IN Check
					
				}else{
					
					get_template_part( 'content', 'page' );
				
				}
					
				endwhile;
			?>
		<br><br><br>
		</div><!-- #content -->
	</div><!-- #primary -->
	<div class='clear'></div>
</div><!-- #main-content -->

<?php

get_footer();