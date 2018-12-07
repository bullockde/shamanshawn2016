<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?> 


	<div class='clearfix'></div>
	<br><br>
	<?php //the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
	<div class='col-md-4 col-md-offset-4'>

		<?php twentysixteen_post_thumbnail(); ?>

	</div>
	<div class='clearfix'></div><hr>

<div id='trips' class='about wwss <?php if( !is_front_page() ){ ?> page-pad <?php } ?>'>
		
		<div class='container'>
					
			
			
			<div class='clear visible-xs'></div>
			
			<div class="col-md-6 col-md-offset-3">
				
				<div class='text-center now'>

					<!--  #  Visiting: Atlanta, GA
					<br><small>Gained</small><br>
					13 New Connections
					<br>
					since 2/17/16

					-->

					<b>Now Visiting</b> <br>
					
				<!--	<br><small>Gained</small><br>
					3 New Connections
					<br>
					since 3/18/16
				-->

			<?php 
				$args = array( 'post_type' => 'ssi_trips' , 'posts_per_page' => -1 , 'order' => 'ASC' );
				$trips = get_posts( $args );

				$t_id = 0;

				foreach( $trips as $trip ){

			

			$s_date = date('Y-m-d', strtotime(  get_field( 'trip_start_date', $trip->ID ) ) );
			
			if( get_field( 'trip_start_date', $trip->ID ) != "" ){

				$e_date = get_field( 'trip_end_date', $trip->ID );
				$e_date = date('Y-m-d', strtotime(  $e_date ) );

			}else{
				
				$e_date = date('Y-m-d', strtotime(  current_time( 'mysql' ) ) );
				
			}

			$c_date = date('Y-m-d', strtotime(  current_time( 'mysql' ) ) );

			//echo "<br> SD==>" . $s_date . "<br> ED==>" . $e_date . "<br> CD==>" . $c_date;

			
			if(  ( strtotime( $c_date ) <= strtotime( $e_date ) ) &&  ( strtotime( $c_date ) >= strtotime( $s_date ) )   ){
				//echo "<br>BEFORE<br>";

				
				$t_id = $trip->ID;

				echo "<div class='col-md-6'>" . $trip->post_title . "</div>";
				echo "<div class='col-md-6'>Since " . get_field( 'trip_start_date', $trip->ID ) . '</div><br>';
 				//break;
			}else{
				//echo "<br>AFTER<br>";
			}
		
		}
	?>
					

					<div class='clearfix'></div>
				</div>

				<iframe src="<?php if( get_field( 'trip_map_code', $t_id ) ){ echo get_field( 'trip_map_code', $t_id ); }else{  ?>

			https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25908287.28120036!2d-114.99060097005477!3d37.56371601472886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sus!4v1467601917813


				
		<?php	} ?>" height="300" frameborder="0" style="width: 100%" allowfullscreen></iframe>
			
			</div>
			
			


		</div>
		
		<div class='clearfix'></div><hr><br>
		
		<div id="trips" class="trips col-md-12">
				
				
				<div id="wwss" class='text-center wwss about now'>

					<h3>Upcoming Trips:</h3>
					<?php 
						//$args = array( 'post_type' => 'ssi_trips' , 'posts_per_page' => -1 , 'order' => 'ASC');
						//$trips = get_posts( $args );
						
						$args = array( 'post_type' => 'ssi_trips' , 'posts_per_page' => -1 , 'order' => 'ASC' );
						$trips = get_posts( $args );

						foreach( $trips as $trip ){


			$s_date = date('Y-m-d', strtotime(  get_field( 'trip_start_date', $trip->ID ) ) );
			
			if( get_field( 'trip_start_date', $trip->ID ) != "" ){

				$e_date = get_field( 'trip_end_date', $trip->ID );
				$e_date = date('Y-m-d', strtotime(  $e_date ) );

			}else{
				
				$e_date = date('Y-m-d', strtotime(  current_time( 'mysql' ) ) );
				
			}
			//echo "<br> SD==>" . $s_date . "ED==>" . $e_date;

			if( strtotime( $s_date ) > strtotime( current_time( 'mysql' ) ) ){
				//echo "<br>BEFORE<br>";

				echo "<div class='col-sm-6'>" . $trip->post_title . "</div>";
							echo "<div class='col-sm-6'>" . get_field( 'trip_start_date', $trip->ID ) . '</div><br>';

			}else{
				//echo "<br>AFTER<br>";
			}
		
/*
			$date1 = date_create( $s_date );
			$date2 = date_create( $e_date );

			$diff=date_diff($date1,$date2);
	
			$tot_days = $diff->format("%a");
			echo "<br>TOTAL DAYS--->" . $tot_days;

*/

							
						}
					?>
			<div class='clearfix'></div><br>
					
					<a href='/wwss/'><div class='btn col-xs-6'>All Trips</div></a>

				<a href='/gallery/'><div class='btn col-xs-6'>Gallery</div></a>
				
					<div class='clearfix'></div>
				</div>
			
			</div>
	
	</div><!-- #about -->

<div class='clearfix'></div><br><br>
<div id="primary" class="container">
			
			

		<?php


		$args = array( 'post_type' => 'ssi_trips' , 'posts_per_page' => -1 );
		$trips = get_posts( $args );
			 
		foreach( $trips as $lead ){
			
				$s_date = date('Y-m-d', strtotime(  get_field( 'trip_start_date', $lead->ID ) ) );
			
			if( get_field( 'trip_start_date', $lead->ID ) != "" ){

				$e_date = get_field( 'trip_end_date', $lead->ID );
				$e_date = date('Y-m-d', strtotime(  $e_date ) );

			}else{
				
				$e_date = date('Y-m-d', strtotime(  current_time( 'mysql' ) ) );
				
			}
			//echo "<br> SD==>" . $s_date . "ED==>" . $e_date;

			if( strtotime( $s_date ) > strtotime( current_time( 'mysql' ) ) ){
				continue;

			}
	?>
<hr>
			<div class='col-md-4 col-xs-6'><b>Location</b></div>
			<div class='col-md-3 col-xs-6'><b>Trip Dates</b></div>
			
			<div class='clearfix'></div>
			<div class='col-md-1'>(<?php echo get_field( 'trip_area_code', $lead->ID ); ?>)</div>
			<div class='col-md-3'><?php echo $lead->post_title; ?></div>
			
			
			<div class='col-md-1'><?php echo get_field( 'trip_start_date', $lead->ID ); ?></div>
			<div class='col-md-1'> -- </div>
			<div class='col-md-1'><?php echo get_field( 'trip_end_date', $lead->ID ); ?></div>
			
	<?php
	
	$start_date = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $lead->ID )) );
			
			$trip_start = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $lead->ID )) );
			
			if( !($start_date == $trip_start) ){ continue;; }
		
			$connections = 0;	
			$trip_inc = 0;
			$trip_exp = 0;
			$trip_prof = 0;


	

/* ###################   START Service Log  ############################ */

			
			$args = array( 

				'post_type' => 'ssi_transactions',
				'posts_per_page' => -1

			 );
		//	$trip_trans = get_posts( $args );

			
			
		foreach( $trip_trans as $trans ){ 

				$start_date = date( 'm/d/y' , strtotime(get_field( 'trip_start_date', $lead->ID )) );
			$end_date = date( 'm/d/y' , strtotime(get_field( 'trip_end_date', $lead->ID )) );
				
				$before = strtotime($start_date);
				$current = strtotime( date( 'm/d/y' , strtotime( $trans->post_date) ) );
				$after = strtotime($end_date);



	if ( $before <= $current ){  if($current <= $after ){  


		if( get_field( 'exclude_trans', $trans->ID ) == 'Yes' ){ }else{

				$connections++;
		
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
					//echo "<br>";
				}

		
					?>
				
	<div class='hidden col-md-1'>
						
						<?php 
						
						
						echo "+ $";  ?>

						<?php 
							 echo $trip_inc; 
							 
							// update_post_meta( $lead->ID, 'trip_income', $trip_inc );
						 ?>
					</div>
					<div class=' col-md-2'>
						
						<?php 
						
						echo get_field( 'trip_connections', $lead->ID );
					 ?>
						 Connections
						
					</div>
					<div class='hidden col-md-2'>

						<?php echo "- $"; ?>
						<?php 
							 echo $trip_exp; 
							 // update_post_meta( $lead->ID, 'trip_expense', $trip_exp );
						 ?>
					</div>
					<div class='hidden1 col-md-1'>

						<?php echo "$"; ?>
						<?php //echo $trip_inc-$trip_exp; 
						echo get_field( 'trip_profit', $lead->ID );
						$profit = $trip_inc-$trip_exp;
					//	 update_post_meta( $lead->ID, 'trip_profit', $profit  );
						 
						//  update_post_meta( $lead->ID, 'trip_connections', $connections  );
						?>

					</div>
					<div class='col-md-1'><a href='/trips/<?php echo $lead->post_name; ?>' target='_blank' class='btn btn-info'> View Trip </a></div>	<div class='clear'> </div>

					<div class='hidden col-md-1'>

						
						<button id='details<?php echo $lead->ID; ?>' class='hidden btn btn-default btn-block'>View</button>
					</div>
					
					<?php
			
			
		}
		

		//print_r($leads);

		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			echo "<div class='clearfix'></div><br> <br> " ;
			the_content();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</div>


	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php //get_sidebar(); ?>

	<div class="col-md-6 col-md-offset-3">
				
				<center>
			<!--	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<ins class="adsbygoogle"
					 style="display:block; text-align:center;"
					 data-ad-layout="in-article"
					 data-ad-format="fluid"
					 data-ad-client="ca-pub-9799103274848934"
					 data-ad-slot="2444532882"></ins>
				<script>
					 (adsbygoogle = window.adsbygoogle || []).push({});
				</script>
				-->
				<iframe src='//www.groupon.com/content-assembly/render/63c81e10-e645-11e6-b6fb-35f34cb5e0e9' width='468' height ='400' frameBorder='0' scrolling='no'></iframe>
				
				</center>
				
			
			</div>
<div class='clearfix'></div>



<?php get_footer('admin'); ?>