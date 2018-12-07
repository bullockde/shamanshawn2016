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


<div id="primary" class="container text-center">

<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
	<div class='clear'> </div>
	
		<div class='col-md-8 '> 
	<div class='trip-header'>
	
		<div class='col-md-4'>
			
			<div style="display:inline-block;width:100%;">
				<?php 
						
						
			$thumb_id = get_post_thumbnail_id( $post->ID );
			$thumb_url_array = wp_get_attachment_image_src(  $thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];

				 
				
				if( get_post_thumbnail_id( $post->ID ) ){
					?>
					<img src='<?php echo $thumb_url; ?>' class='' >
					<?php
					
				}
				if( strpos($post->post_title, 'philly') > -1 ){
					?>
					<img src='http://shamanshawn.com/wp-content/uploads/philly-city-hall-150x150.jpg' class='' >
					<?php
					
				}
			
			
			?>

			
				
				
				
				
			</div>
	
		
	
		</div>
		<div class='col-md-8'>
			
			<center><img src='http://shamanshawn.com/wp-content/uploads/ssi-trips-header.png' class='img-responsive'></center>
			
	
		</div>
		
	
		<div class='clearfix'></div><br>
		
	<div class='container'>
		
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
			
			$start_date = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $lead->ID )) );
			
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
				
				if( get_field( 'client_id', $lead->ID ) ){
					//echo "Client ID: " . get_field( 'client_id', $lead->ID );
					$confirmed = true; $client_id = get_field( 'client_id', $lead->ID );
					echo "<br>";
				}

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>
	


	<div class='col-xs-6 col-sm-4'> 
					<strong>Dates</strong><hr style='margin: .5em;'>
						<?php
							echo date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $lead->ID )) );
							echo " - ";
							echo date( 'm/d/y' , strtotime(get_field( 'trip_end_date', $lead->ID )) );
							
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
					
					
					<div class='hidden col-xs-4 col-sm-2'>
						<strong>Inc (+)</strong><hr style='margin: .5em;'>
						<?php echo "+$";  ?>

						<?php 
							 echo $trip_inc; 
						 ?>
					</div>
					<div class='hidden col-xs-4 col-sm-2'>
						<strong>Exp (-)</strong><hr style='margin: .5em;'>
						<?php echo "-$"; ?>
						<?php 
							 echo $trip_exp; 
						 ?>
					</div>
					<div class='hidden col-xs-4 col-sm-2'>
						<strong>Profit</strong><hr style='margin: .5em;'>
						<?php echo "$"; ?>
						<?php echo $trip_inc-$trip_exp; ?>

					</div>
					
					<div class='hidden col-md-1'>

						
						<button id='details<?php echo $lead->ID; ?>' class='hidden btn btn-default btn-block'>View</button>
					</div>


		
			<div class='clearfix'></div>
<!--  ################################################################  -->
<div id='details<?php echo $lead->ID; ?>"' class='hidden1 text-center' style='display: block;'>
				<div class='clear visible-xs'></div>
			
	
<br><br><hr>
		<h3>Trip Log</h3>
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

				$start_date = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $lead->ID )) );
			$end_date = date( 'm/d/y' , strtotime(get_field( 'trip_end_date', $lead->ID )) );
				
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
	<div class='text-left'>
		<?php the_content(); ?>
	</div>
</div>

<div class='col-md-4'>
			
			
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- SSI2018_300_250 -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:300px;height:250px"
				 data-ad-client="ca-pub-9799103274848934"
				 data-ad-slot="8211309974"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
			
			<br> 
			<br>
		<center>
			<iframe src='//www.groupon.com/content-assembly/render/1c0b7de0-e548-11e6-b6fb-35f34cb5e0e9' width='325' height ='480' frameBorder='0' scrolling='no'></iframe>
		</center>
		
	
		</div>



	</div>

	<div class='clearfix'></div><hr>
	<div class='container text-center'>
		<h2>Past Trips</h2>
		
	</div>
<hr>

<br>




			<?php 
				$args = array( 'post_type' => 'trips' , 'posts_per_page' => 8 , 'order' => 'RAND' );
				$trips = get_posts( $args );

				$t_id = 0;

				foreach( $trips as $lead ){
?>

		<div class='col-md-6'>
			<div class='  col-xs-3 text-center'><b><u>Location</u></b></div>
			<div class='col-xs-5 text-center'><b><u>Trip Dates</u></b></div>
			
			<div class='clear'><br></div>
			<div class='col-xs-1 col-xs-offset-'>(<?php echo get_field( 'trip_area_code', $lead->ID ); ?>)</div>
			<div class='col-xs-3'><?php echo $lead->post_title; ?></div>
			
			
			<div class='col-xs-2'><?php echo get_field( 'trip_start_date', $lead->ID ); ?></div>
			<div class='col-xs-2'><?php echo get_field( 'trip_end_date', $lead->ID ); ?></div>
			<div class='col-xs-3'><a href='/trips/<?php echo $lead->post_name; ?>' target='_blank' class='btn btn-block btn-info'> View Trip >></a></div>
			
			
		<div class='clearfix'></div><hr>
		</div>
			
			<?php
			}
			
		
		
	?>
					




</div><!-- .content-area -->



<?php //get_sidebar(); ?>
<?php get_footer(); ?>