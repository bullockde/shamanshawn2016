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
		
	
		<div class='clear'></div><br>
		
	<div class='container'>
		
		<?php  /* ################    BEGIN TRIP DETAILS  ################## */ ?>
		
	<hr style='margin: .5em;'>
	
	
		<br><hr>
				
				<b>Places to Go:</b> <br><hr><small>Coming Soon.. </small><hr>
				
				<b>People to See:</b> <br><hr><small>Coming Soon.. </small><hr>
				
				<b>Things to Do:</b> <br><hr><small>Coming Soon.. </small><hr>
				
				
	
		<h4>Travel Log</h4>
		
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
</div><div class='clear'></div>
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


		
		
		
		// ################    #END TRIP DETAILS  ##################//
?>
</div>
	<div class='text-left'>
	
			<?php 
				$args = array( 'post_type' => 'trips' , 'posts_per_page' => -1 , 'order' => 'desc' );
				$trips = get_posts( $args );

				$t_id = 0;

				foreach( $trips as $lead ){
					
					
					if( get_field( 'trip_area_code', $lead->ID ) != get_field( 'trip_area_code', get_the_ID() ) ){ 
							continue; 
					}
?>

		<div class='col-md-12'>
			

			<div class='col-xs-4'><?php echo get_field( 'trip_start_date', $lead->ID ); ?></div>
			<div class='col-xs-4'><?php echo get_field( 'trip_end_date', $lead->ID ); ?></div>
			<div class='col-xs-4'><a href='/trips/<?php echo $lead->post_name; ?>' target='_blank' class='btn btn-block btn-info'> View Trip >></a></div>
			
			
		<div class='clear'></div><hr>
		</div>
			
			<?php } ?>
					
	
		
	
	
		<?php the_content(); ?>
	</div>
</div>

<div class='col-md-4'>
			
			
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- SSI_Zone_300_250 -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:300px;height:250px"
				 data-ad-client="ca-pub-3813829909026031"
				 data-ad-slot="9987321388"></ins>
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






</div><!-- .content-area -->



<?php //get_sidebar(); ?>
<?php get_footer(); ?>