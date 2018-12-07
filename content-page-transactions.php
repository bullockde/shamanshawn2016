


<?php  
	$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) { // LOGGED-IN Check


		echo "<div class='container'>";
		echo "<br><br><div class='clearfix'></div>";

	?>

		<div class='row'>
			<div class='col-xs-6'>

				<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
				?>
			</div>	
			<div class='col-xs-6'>
				
				<button id='filter' class='btn btn-lg btn-default pull-right'>Filter</button>
				
			</div><div class='clearfix'></div>
			<hr>




						<!--  #####################   START Filter  ##############-->
		<div id='filter' class='filter' style='display: block;'>
			
		<form id="filter">

			<div class='col-md-1'>
				
		  			City:	
					
			</div>
			<div class='col-md-2'>
				
		  			<input type="text" name="searchterm">	
					
				
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
			<div class='col-md-2'>
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
			<div class='col-md-2'>
				<select name="trans_type">
					<option value="false">Transaction Type</option>
					<option value="155">Massage Service</option>
					<option value="156">Hotel / Travel</option>
					<option value="158">Party / Fun</option>
					<option value="157">Food / Dining </option>
					<option value="159">Adult Entertainment</option>
					<option value="1">Uncategorized</option>
				</select>				
				
			</div>
			<div class='col-md-2'>
								
				<input type="submit">
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

		<?php get_template_part( 'content', 'add-transaction' ); ?>

			
		<div class='col-md-2'><h2>Date</h2></div>
		<div class='col-md-2'><h2>Name</h2></div>
		<div class='col-md-2'><h2>Phone#</h2></div>
		<div class='col-md-2'><h2>City</h2></div>
		<div class='col-md-2'><h2>State</h2></div>
		<div class='col-md-2'><h2>Details</h2></div><br>
		<div class='clearfix'></div>
			<hr>


		<?php
			/*********************************************************/


			// The Query

			$trans_type = 0;
			$trans_type = $_GET['trans_type'];

			//echo "TYPE-->" . $trans_type;

			if( $trans_type != 0 ){ 

				$args = array( 'post_type' => 'transactions','posts_per_page' => -1 , 'category' => $trans_type );

			}else{

				$args = array( 'post_type' => 'transactions', 'posts_per_page' => -1 );

			}

			$leads = get_posts( $args );


			/* VARIABLES
			**********************************************/
			$flex_count = 0;
			$flex_total = 0;
				

			$income_count = 0;
			$expense_count = 0;
			$trans_count = 0;

			$tot_trans = count($leads);
			$tot_income = 0;
			$tot_expense = 0;
			
			$start_date = '-' . $start_date . ' days';


			
			//print_r( $leads );
			foreach( $leads as $lead ){
				//echo get_field( 'trans_service', $lead->ID );
				$mystring = $lead->post_title;
				
				$mystring = get_field( 'trans_service', $lead->ID );
				if( 0 ) { echo "Massage Service!!";  wp_set_post_categories( $lead->ID , 155  );  wp_update_post( $lead->ID ); }
				
				
				/*
				
				$category = get_term_by('slug', $_POST['contact_type'], 'category');
		
				print_r($category);
				wp_set_post_categories( $lead->ID , 155  );

				// Update the post into the database
				wp_update_post( $lead->ID );
				
				
				*/

				$today = strtotime('today');
				$today_end = strtotime('tomorrow');
				$date = '03/12/2015'; #could be (almost) any string date

				//echo '--->' . '-' . $start_date . ' days' . ' *** ' . date("m-d-Y", strtotime( $start_date ));

				$date_timestamp = strtotime($date);

				if ( strtotime( $lead->post_date ) < strtotime( $start_date ) ) {
					#$date occurs today
					break;
				} else if ($date_timestamp < $today_start) {
				    #$date occurs before today
				} else {
				    #$date occurs today
				}
 				
				$trans_count++;
				$public = 1;
				
				$client_id = 0;
				
				$confirmed = false;
				
				if( get_field( 'client_id', $lead->ID ) ){
					echo "Client ID: " . get_field( 'client_id', $lead->ID );
					$confirmed = true; $client_id = get_field( 'client_id', $lead->ID );
					echo "<br>";
				}else{

				?>
					<form method='post' action='' name='insert_client'>
						<input name="date_added" type="hidden" value="<?php echo $lead->post_date; ?>" />
						<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
						<input name="client_name" type="hidden" value="<?php echo $lead->post_title; ?>" />
						<input name="client_phone" type="hidden" value="<?php echo get_field( 'trans_phone', $lead->ID ); ?>" />
						<input name="client_city" type="hidden" value="<?php echo get_field( 'trans_city', $lead->ID ); ?>" />
						<input name="client_state" type="hidden" value="<?php echo get_field( 'trans_state', $lead->ID ); ?>" />
						<input name="trans_date" type="hidden" value="<?php echo mysql2date('n/j/y', $lead->post_date );  ?>" />
						<input name="trans_amount" type="hidden" value="<?php echo get_field( 'trans_amount', $lead->ID ); ?>" />
						<input name="trans_time" type="hidden" value="<?php echo get_field( 'trans_time', $lead->ID ); ?>" />
						<input name="trans_service" type="hidden" value="<?php echo get_field( 'trans_service', $lead->ID ); ?>" />
						<input name="trans_location" type="hidden" value="<?php echo get_field( 'trans_location', $lead->ID ); ?>" />

						<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
						<input type='hidden' name='insert_client' value='true'>
						
						<input type="hidden" name="cur_post_type" value='ssi_contact'>
						<input type="hidden" name="update" value="true">
						<input type='submit' value='Insert Client'>
					</form>
				<?php

					echo "<br>";
				}
				

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>
					
					<div class='col-md-2'> 
					
						<?php echo mysql2date('n/j/y', $lead->post_date ); 

							if( $trans_count == $tot_trans ){
								$start_date = mysql2date('n/j/y', $lead->post_date );
							} 
						?>
					</div>
					<div class='col-md-2'> 

						<?php echo "-"; ?>
						<?php 
							if	( $confirmed )		{ 

							echo "<a target='_blank' href='/admin/report/?ID=" . $client_id . "' class=''>" . $lead->post_title . "</a>";
						
						}elseif	( $lead->post_title )	{ 

								echo "<a target='_blank' href='/admin/report/?ID=" . $lead->ID . "' class=''>" . $lead->post_title . "</a>";
							 }
							else				{ echo 'New Request'; }
						 ?>
						<?php

						$service = get_field( 'trans_service', $lead->ID );
						
						if (strpos($service, 'assa') !== false) {
							echo 'true -- ';
							
							$cat_id = get_cat_ID( strtolower ( 'Massage Service' ) );
							
							echo $cat_id;
							$post_categories = array($cat_id);
							
							wp_set_post_categories( $lead->ID, $post_categories, 1 );
						}
						
						

						echo "<b>Service: </b> " . get_field( 'trans_service', $lead->ID ) . "";  ?>
						
						
						
						
					</div>
					
					<div class='col-md-2'>
						
						<?php echo "-";  ?>

						<?php 
							if( $confirmed )	{ echo get_field( 'lead_phone', $client_id ); }
							else			{ echo get_field( 'trans_phone', $lead->ID ); }
						 ?>
					</div>
					<div class='col-md-2'>

						<?php echo "-"; ?>
						<?php 
							if( /*$confirmed*/ 0 )	{ echo get_field( 'lead_city', $client_id ); }
							else			{ echo get_field( 'trans_city', $lead->ID ); }
						 ?>
					</div>
					
					<div class='col-md-1'>

						<?php echo "-"; ?>
						<?php echo get_field( 'trans_state', $lead->ID ); ?>

						
					</div>
					<div class='col-md-1'>

						<?php echo "-"; ?>
						<?php 
							if(get_field( 'flex_pay', $lead->ID ) == 'Yes'){
								echo "FLEX!";
								
							}
							//echo get_field( 'flex_pay', $lead->ID ); ?>

					</div>
					<div class='col-md-1'>

						<?php

							
			if( get_field( 'flex_pay', $lead->ID ) == 'Yes' ){ 

				echo " "; 

				$flex_count++;
				$flex_total += get_field( 'trans_amount', $lead->ID );
				

			}else if( get_field( 'income_expense', $lead->ID ) == '-' ){ 

				echo "- "; 


				$expense_count++;
				$tot_expense += get_field( 'trans_amount', $lead->ID );
				$trans_total = $trans_total - get_field( 'trans_amount', $lead->ID );

			}else{  

				echo "+ ";  


				$income_count++;
				$tot_income += get_field( 'trans_amount', $lead->ID );
				$trans_total = $trans_total + get_field( 'trans_amount', $lead->ID );

			}
				?>

						
						<?php echo "$"; ?>
						<?php echo get_field( 'trans_amount', $lead->ID ); ?>
						
					</div>
					<div class='col-md-1'>
						<?php 
							$post_categories = wp_get_post_categories( $lead->ID  );
							$cats = array();
								 
							foreach($post_categories as $c){
								$cat = get_category( $c );
								$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
							}
						?>
						
						<button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>View</button>
					</div>
					
					

				<?php

					echo "<br><br><div id='details" . $lead->ID .  "' class='details' style='display: none;'>";


					?>

					
					<div class='col-md-2 hide'>
						
						<?php echo "-"; ?>
						<?php echo get_field( 'trans_email', $lead->ID ); ?>

					</div>

					<?php
					/*if( $lead["2.3"] ){
					echo "<b>Location: </b> " . $lead["2.3"] . ", " . $lead["2.4"] . " " . $lead["2.5"] . "<br><br>";
					}else	{
					echo "<b>Location:</b> Philadelphia, PA<br>";
					}*/


					echo "<div class='col-xs-4' ><b>Time: </b> " . get_field( 'trans_time', $lead->ID ) . "</div>"; 
					echo "<div class='col-xs-4' ><b>Location: </b> " . get_field( 'trans_location', $lead->ID ) . "</div>"; 
					echo "<div class='col-xs-4' ><b>Service: </b> " . get_field( 'trans_service', $lead->ID ) . "</div>"; 

					echo "<div class='clearfix'></div><br>"; 

					echo "<div class='col-xs-12' ><b>Note: </b> " . $lead->post_content . "</div>";
					?>
					<br>
					<b>Photo: </b>
						<a href='<?php echo get_the_post_thumbnail_url($lead->ID); ?>'><img src='<?php echo get_the_post_thumbnail_url($lead->ID); ?>' width='150px' height='150px'></a>
					
				
				
					<form class='update hidden' action='' method="post">
						Client ID:<input type='text' name='client_id'>
						<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
						<input type='hidden' name='updater' value='true'>
						<input type='hidden' name="update" value='true'>
						<input type='submit' name="update" value='Submit'>
					</form>
				<?php
					echo "<div class='clearfix'></div><br>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default'>Edit Transaction</a>";

					echo "<br></div><div class='clearfix'></div><hr>";
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 
					
				}
				echo "<br><br>";
				//print_r( $leads );
	

				echo "TRANSACTION SUMMARY<hr>";
				
				echo $trans_count . "  Transactions Since: " . str_replace( "-", "", $start_date ) /* . "ago"*/;
				echo "<br><br>" . $income_count . " INCOME---> $" . $tot_income; 
				echo "<br><br>" . $expense_count . " EXPENSE--> $" . $tot_expense; 
				echo "<br><br>PROFIT---> $" . ($tot_income - $tot_expense); 
				echo "<br><br>" . $flex_count . " FLEX--> $" . $flex_total; 
				
				

				echo "<br><br>";
			// Reset Query
			wp_reset_query();


/*********************************************************/


		echo "</div>";

} //END LOGGED-IN Check
?>