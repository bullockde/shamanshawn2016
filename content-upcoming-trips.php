<div class='clearfix'></div>
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

				echo "<div class='col-xs-6'>" . $trip->post_title . "</div>";
							echo "<div class='col-xs-6'>" . get_field( 'trip_start_date', $trip->ID ) . '</div><br>';

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
<div class='clearfix'></div>