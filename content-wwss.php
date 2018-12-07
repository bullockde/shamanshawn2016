<div class='clearfix'></div>

<section id='wwss' class='text-center about wwss<?php if( !is_front_page() ){ ?> page-pad <?php } ?>'>
		
		<div class='container'>
					

			<h1 class="entry-title">Where in the World is Shaman Shawn?</h1><hr>
			<div class="col-md-6">
				
				<div class='text-center now'>


					Now Visiting <hr>
					

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
				echo "<div class='col-md-6'>Since " . get_field( 'trip_start_date', $trip->ID ) . '</div>';
 				//break;
			}else{
				//echo "<br>AFTER<br>";
			}
		
		}
	?>
					

					<div class='clearfix'></div><hr>
					
					<small>Completed - <a target='_blank' href='/?p=<?php echo $trip->ID; ?>'><u><?php echo get_field( 'trip_connections', $t_id ); ?></u></a> Connections</small><br>
			
				</div>

				<iframe src="<?php if( get_field( 'trip_map_code', $t_id ) ){ echo get_field( 'trip_map_code', $t_id ); }else{  ?>

			https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25908287.28120036!2d-114.99060097005477!3d37.56371601472886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sus!4v1467601917813


				
		<?php	} ?>" height="300" frameborder="0" style="width: 100%" allowfullscreen></iframe>

			</div>
			<div class='clear visible-xs'></div>
			<div class="col-md-6">
				
				<div class='text-center now'>

					<h3>Upcoming Trips</h3><hr>
					<?php 
						$args = array( 'post_type' => 'ssi_trips' , 'posts_per_page' => -1 , 'order' => 'ASC');
						$trips = get_posts( $args );
						
						$count = 0;

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
				$count++;
				
				echo "<div class='col-sm-6'>" . $trip->post_title . "</div>";
							echo "<div class='col-sm-6'>" . get_field( 'trip_start_date', $trip->ID ) . '</div><br>';

			}else{
				
		
			}
			
	
						}
						
						if($count == 0){ echo "- No Trips Planned"; }
					?>
			<div class='clearfix'></div><hr>
					
					<a href='/trips/'><div class='btn col-xs-12'>All Trips</div></a>

				<a href='/gallery/'><div class='btn col-xs-12'>Gallery</div></a>
				
					<div class='clearfix'></div><hr>
					<center>
						<iframe src='//www.groupon.com/content-assembly/render/de03bdc0-e653-11e6-b6fb-35f34cb5e0e9' width='468' height ='60' frameBorder='0' scrolling='no' style='margin: 0;'></iframe>
					</center>
				</div>
				
			
	
			</div>
<div class='clearfix'></div>

			<a href='/journey/'><div class='btn btn-block col-xs-12'>My Journey</div></a>
		</div>
	
	</section>

<div class='clearfix'></div>