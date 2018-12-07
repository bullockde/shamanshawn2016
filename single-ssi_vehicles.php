<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 
 global $post;

get_header(); ?> 


	<div class='container text-center autos'>

		

<br><br>




			<?php 
				$args = array( 'post_type' => 'ssi_vehicles' , 'posts_per_page' => 8 , 'order' => 'RAND' );
				//$trips = get_posts( $args );

				$t_id = 0;

				
?>
	<div class='well'>

		<?php the_title( '<h1 class="entry-title text-center red">', '</h1>' ); ?>
				<div class='clearfix'></div>
		
		<div class='col-sm-10 '>
			<div class=' well'>
			

			<div class='col-sm-3'>
		<?php
				$thumb_id = get_post_thumbnail_id( get_the_ID() );
			$thumb_url_array = wp_get_attachment_image_src(  $thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];

				 
				
				if( get_post_thumbnail_id( get_the_ID() ) ){
					?>
					<img src='<?php echo $thumb_url; ?>' class='' >
					<?php
					
				}
				?>
				<br>
				(25 Photos)
				<br>
			
			
		<div class='clearfix'></div>
		</div>
			<div class='col-sm-9 text-left'>
				<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Year:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field( 'MX_vehicle_year'  , get_the_ID() ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Make:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field( 'MX_vehicle_make'  , get_the_ID() ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Model:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field( 'MX_vehicle_model'  , get_the_ID() ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Mileage:</b></div>
					<div class='col-xs-6'><?php echo get_field( 'MX_vehicle_mileage'  , get_the_ID() ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Condition:</b></div>
					<div class='col-xs-6'><?php echo get_field( 'MX_vehicle_condition'  , get_the_ID() ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Transmission:</b></div>
					<div class='col-xs-6'><?php echo get_field( 'MX_vehicle_transmission'  , get_the_ID() ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				
							<div class='clearfix'></div>

			</div>
			</div>
			<div class='clearfix'></div>
		
		</div>
			<div class='clear'> </div>
					
			<div class='col-sm-6 h4 well'>
				Kelly Blue Book: $<?php echo get_field( 'MX_vehicle_kbb'  , get_the_ID() ); ?><br>
				<a href='http://shamanshawn.com/wp-content/uploads/kbb-dodge-grand-caravan-95-report.pdf' target='_blank' class='btn btn-lg btn-default btn-block'>
				
				<img src='http://shamanshawn.com/wp-content/uploads/kbb-dodge-grand-caravan-95.jpg'>
				</a>
				<a href='http://shamanshawn.com/wp-content/uploads/kbb-dodge-grand-caravan-95-report.pdf' target='_blank' class='btn btn-lg btn-default btn-block'>View Report</a>
			</div>
			<div class='col-sm-6 h4 well'>Our Price: $2,800
				<br>
				<a href='http://shamanshawn.com/wp-content/uploads/CARFAX-Vehicle-History-Report-for-this-1995-DODGE-CARAVAN-SE_-2B4GH4537SR209176.pdf' target='_blank' class='btn btn-lg btn-default btn-block'>
				
				<img src='http://shamanshawn.com/wp-content/uploads/free-carfax-report.jpg' width='285'>
				</a>
				<a href='http://shamanshawn.com/wp-content/uploads/CARFAX-Vehicle-History-Report-for-this-1995-DODGE-CARAVAN-SE_-2B4GH4537SR209176.pdf' target='_blank' class='btn btn-lg btn-default btn-block'>View Report</a>
			
			
			</div>
			
			<div class='clear'> </div>

					
			<div class='col-sm-6 '>
			
			<br>
				<center>	
			
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- SSI2018_300_250 -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:300px;height:250px"
				 data-ad-client="ca-pub-9799103274848934"
				 data-ad-slot="8211309974"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
				<br>Advertisement
				</center>
			</div>
			<div class='col-sm-6 well'><h4><u>Weekly Payment Option!</u></h4>
				<br>
				
				<b>As Low As</b>
			<h1 class='red'>$<?php echo get_field( 'MX_vehicle_weekly'  , get_the_ID() ); ?><small class='red'>/wk</small></h1>
			<br>$<?php echo get_field( 'MX_vehicle_down'  , get_the_ID() ); ?> Down + <?php echo get_field( 'MX_vehicle_term'  , get_the_ID() ); ?> weeks<br><hr>
			
			<a href='/contact' class='btn btn-lg btn-info btn-block'>Contact Us >></a>
			
			</div>
			
			<div class='clear'> </div><hr>
			
		
		</div>
		<div class='col-sm-2'>
		
		<center>
			<img src='http://shamanshawn.com/wp-content/uploads/car-fox-adv-trans.png'>
			
			<img src='http://shamanshawn.com/wp-content/uploads/carfax-oneowner.png'>
			<br>
			<!--
			<img src='http://shamanshawn.com/wp-content/uploads/carfax-1-owner.jpg'>
			
			<img src='http://shamanshawn.com/wp-content/uploads/carfax-maintained-full.png'>
			
			<br>
			
			-->
			<br><br><br>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- SSI2018_160_600_sky -->
				<ins class="adsbygoogle"
					 style="display:inline-block;width:160px;height:600px"
					 data-ad-client="ca-pub-9799103274848934"
					 data-ad-slot="6758796340"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			
			
		</center>
		<div class='text-center'> Advertisement </div>
		
			
			
			
		<div class='clearfix'></div>
		</div>
		
		<div class='clearfix'></div>
	</div>		
			<?php
		
			
		
		
	?>
					


</div>


<div class='clear'> </div><hr>

					


<hr>

<div id="primary" class="container text-center">


		<div class='col-md-12'> 
	<div class='trip-header'>
	
	
		<div class='clearfix'></div><br>
		
	<div class='container'>
	
	Vehicle Log
		
		<?php  /* ################    BEGIN TRIP DETAILS  ################## */ ?>
		
	<hr style='margin: .5em;'>
		
		<?php
			/*********************************************************/


			// The Query

			$args = array( 

				'post_type' => 'trips',
				'posts_per_page' => -1

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

			//echo " HERE!";
			
			$start_date = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', get_the_ID() )) );
			
			$trip_start = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $post->ID )) );
			
			if( !($start_date == $trip_start) ){ continue;; }
		
				
			$trip_inc = 0;
			$trip_exp = 0;
			$trip_prof = 0;


	

/* ###################   START Service Log  ############################ */

			
			$args = array( 

				'post_type' => 'transactions',
				'posts_per_page' => -1

			 );
			$trip_trans = get_posts( $args );

			
		foreach( $trip_trans as $trans ){ 

				$start_date = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', get_the_ID() )) );
			$end_date = date( 'm/d/y' , strtotime(get_field( 'trip_end_date', get_the_ID() )) );
				
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
					
			
			?>
</div><div class='clearfix'></div>
<?php			
					

				$today = strtotime('today');
				$today_end = strtotime('tomorrow');
				$date = '03/12/2015'; #could be (almost) any string date


				$date_timestamp = strtotime($date);
				
				$trans_count++;
				$public = 1;
				
				$client_id = 0;
				
				$confirmed = false;
				
				if( get_field( 'client_id', get_the_ID() ) ){
					//echo "Client ID: " . get_field( 'client_id', get_the_ID() );
					$confirmed = true; $client_id = get_field( 'client_id', get_the_ID() );
					echo "<br>";
				}

				if(  get_field( 'public_private_request', get_the_ID() ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>
	


	<div class='col-xs-6 col-sm-4'> 
					<strong>Dates</strong><hr style='margin: .5em;'>
						<?php
							echo date( 'm/d/y' , strtotime(get_field( 'trip_start_date', get_the_ID() )) );
							echo " - ";
							echo date( 'm/d/y' , strtotime(get_field( 'trip_end_date', get_the_ID() )) );
							
							 //echo mysql2date('n/j/y', $lead->post_date ); 

							if( $trans_count == $tot_trans ){
								$start_date = mysql2date('n/j/y', $lead->post_date );
							} 
						?>
					</div>
				
				
					<div class='col-xs-6 col-sm-2'> 

						<strong>Location</strong><hr style='margin: .5em;'>
						<?php 
							if	( $lead->post_title )	{ echo $lead->post_title; }
						 ?>
						<?php  ?>
					</div>
					
					<div class='clear visible-xs'></div>
					<hr style='color: #000;' class='visible-xs'>
					
					
					<div class='col-xs-4 col-sm-2'>
						<strong>Inc (+)</strong><hr style='margin: .5em;'>
						<?php echo "+$";  ?>

						<?php 
							 echo $trip_inc; 
						 ?>
					</div>
					<div class='col-xs-4 col-sm-2'>
						<strong>Exp (-)</strong><hr style='margin: .5em;'>
						<?php echo "-$"; ?>
						<?php 
							 echo $trip_exp; 
						 ?>
					</div>
					<div class='col-xs-4 col-sm-2'>
						<strong>Profit</strong><hr style='margin: .5em;'>
						<?php echo "$"; ?>
						<?php echo $trip_inc-$trip_exp; ?>

					</div>
					
					<div class='hidden col-md-1'>

						
						<button id='details<?php echo get_the_ID(); ?>' class='hidden btn btn-default btn-block'>View</button>
					</div>



<!--  ################################################################  -->
<div id='details<?php echo get_the_ID(); ?>"' class='text-center' style='display: block;'>
				<div class='clear visible-xs'></div>
<br><br><hr>
		<h3>Transaction Log</h3>
<hr>
		<div class='col-xs-2'><b>Date</b></div>
		<div class='col-xs-4'><b>Service</b></div>
		
		<div class='col-xs-3'><b>Location</b></div>
		
		<div class='col-xs-2'><b>Inc/Exp</b></div><br>
		<div class='clearfix'></div>
			<hr>
		<?php 

/* ###################   START Service Log  ############################ */

			
			$args = array( 

				'post_type' => 'transactions',
				'posts_per_page' => -1

			 );
			$trip_trans = get_posts( $args );

			
		foreach( $trip_trans as $trans ){ 

				$start_date = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', get_the_ID() )) );
			$end_date = date( 'm/d/y' , strtotime(get_field( 'trip_end_date', get_the_ID() )) );
				
				$before = strtotime($start_date);
				$current = strtotime( date( 'm/d/y' , strtotime( $trans->post_date) ) );
				$after = strtotime($end_date);



	if ( $before <= $current ){  if($current <= $after ){ 


 	if( get_field( 'exclude_trans', $trans->ID ) == 'Yes' ){ }else{
		
		?>

		<div class='col-xs-2'> 
					
						<?php echo mysql2date('n/j/y', $trans->post_date ); 

							if( $trans_count == $tot_trans ){
								$start_date = mysql2date('n/j/y', $trans->post_date );
							} 
						?>
					</div>
					<div class='col-xs-4'> 
					
					<?php  

						$categories = get_the_category($trans->ID);

						//print_r( $categories );
						 
						if ( ! empty( $categories ) ) {
							echo esc_html( $categories[0]->name );
						}
						
						?>

						<?php //echo get_field( 'trans_service', $trans->ID );  ?>
						
					</div>
					
		
					<div class='col-xs-3 col-sm-2 '>

						
						<?php 
							if( /*$confirmed*/ 0 )	{ echo get_field( 'lead_city', $client_id ); }
							else			{ echo get_field( 'trans_city', $trans->ID ); }
						 ?>
					</div>
					<div class='hidden-xs col-sm-1  '>

						
						<?php echo get_field( 'trans_state', $trans->ID ); ?>

					</div>
					<div class='col-xs-3'>

						<?php

							if( get_field( 'income_expense', $trans->ID ) == '-' ){ 

				echo "Exp ( - ) "; 
				

			}else{  

				echo "Inc ( + ) ";  
			}
				?>

						
						<?php //echo "$"; ?>
						<?php //echo get_field( 'trans_amount', $trans->ID ); ?>
						
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
	<hr style='margin: .5em;'>
	
		<?php 
	

/* ####################  END trans  ########################### */
	} } } // END IF DATE CHECK
				
		
				
			}

					?>
</div><div class='clearfix'></div>


<!--  #########################################################  -->
<hr> 

			<?php
					echo "";
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 
					
				}
				
				
/* ####################  END Trip  ########################### */	

			// Reset Query
			wp_reset_query();


/*********************************************************/


		echo "</div>";
		
		
		// ################    #END TRIP DETAILS  ##################//
?>
</div>




	</div>

	<div class='clearfix'></div><hr>
		<div class='container text-center autos'>
		<h2>Our Vehicles</h2>
		
	
<hr>

<br>




			<?php 
				$args = array( 'post_type' => 'ssi_vehicles' , 'posts_per_page' => 8 , 'order' => 'RAND' );
				$trips = get_posts( $args );

				$t_id = 0;

				foreach( $trips as $lead ){
?>
				<div class='well'>

					<div class='col-xs-12 h3 red'><?php echo $lead->post_title; ?></div>
							<div class='clearfix'></div><hr>
					<div class='col-sm-3'>
					<?php
							$thumb_id = get_post_thumbnail_id( $lead->ID );
						$thumb_url_array = wp_get_attachment_image_src(  $thumb_id, 'thumbnail', true);
						$thumb_url = $thumb_url_array[0];

							 
							
							if( get_post_thumbnail_id( $lead->ID ) ){
								?>
								<img src='<?php echo $thumb_url; ?>' class='' >
								<?php
								
							}
							?>
							<br>
							(25 Photos)
							<br><br>
						
						
					<div class='clearfix'></div>
					</div>
					<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Year:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field( 'MX_vehicle_year'  , $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Make:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field( 'MX_vehicle_make'  , $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Model:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field( 'MX_vehicle_model'  , $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Mileage:</b></div>
					<div class='col-xs-6'><?php echo get_field( 'MX_vehicle_mileage'  , $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Condition:</b></div>
					<div class='col-xs-6'><?php echo get_field( 'MX_vehicle_condition'  , $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Transmission:</b></div>
					<div class='col-xs-6'><?php echo get_field( 'MX_vehicle_transmission'  , $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				
							<div class='clearfix'></div>

			</div>
			
			<div class='clearfix'></div>
					<div class='col-xs-12 h4 red'>Kelly Blue Book: $<?php echo get_field( 'MX_vehicle_kbb'  , $lead->ID ); ?></div><br>
					
			
			

			
		
		</div>
					<div class='col-sm-3'>
		
			<h4>PRICE</h4>
			<h1 class='red'>$<?php echo get_field( 'MX_vehicle_weekly'  , $lead->ID ); ?> <small class='red'>/wk</small></h1>
			<br>$<?php echo get_field( 'MX_vehicle_down'  , $lead->ID ); ?> Down + <?php echo get_field( 'MX_vehicle_term'  , $lead->ID ); ?> weeks<br><hr>
			
			<a href='/vehicle/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>More Info >></a>
			
			
		<div class='clearfix'></div>
		</div>
					
					<div class='clearfix'></div>
				</div>		
						<?php
						}
						
					
					
				?>
								


			</div>		




</div><!-- .content-area -->



<?php //get_sidebar(); ?>
<?php get_footer(); ?>