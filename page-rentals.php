<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 
 global $post;
 
 $postID  = 0;
 if($_GET['new_property']){
 // Create post object
	$my_post = array(
	  'post_title'    => wp_strip_all_tags( $_GET['post_title'] ),
	  'post_type'  => 'ssi_rentals',
	  'post_status'   => 'publish',
	  'post_author'   => 1,

	);
	 
	// Insert the post into the database
	$postID = wp_insert_post( $my_post );
	
		$catID = get_cat_ID( 'property' );
							//$category =  get_the_category($EventID);
							$cats = array();
							
							array_push($cats, $catID);
							
							//echo "<br>HERE-->" . $EventName . "-- " . $EventID . "-- " . $catID;
							
							//print_r($cats);
							wp_set_post_categories( $postID ,$cats , 0 ); 
							
		
	
 }
  if($_GET['new_room']){
 // Create post object
	$my_post = array(
	  'post_title'    => wp_strip_all_tags( $_GET['post_title'] ),
	  'post_type'  => 'ssi_rentals',
	  'post_status'   => 'publish',
	  'post_author'   => 1,

	);
	 
	// Insert the post into the database
	$postID = wp_insert_post( $my_post );
	
		$catID = get_cat_ID( 'rooms' );
							//$category =  get_the_category($EventID);
							$cats = array();
							
							array_push($cats, $catID);
							
							//echo "<br>HERE-->" . $EventName . "-- " . $EventID . "-- " . $catID;
							
							//print_r($cats);
							wp_set_post_categories( $postID ,$cats , 0 ); 
							update_post_meta( $postID ,'property_id', property_ID  );
					
	
 }
 foreach($_GET as $key => $term ){
	
	
//	echo $term;
	
	update_post_meta( $postID ,$key, $term  );
 }
 
 
 
 $available = 0;
 $cur_roommates = 0;
 
 $folks = get_posts( array (
						
					   'posts_per_page'         =>  -1,
					  // 'post_type' => 'party_guests',
						'category_name'                  => 'ssi_tenants',
						'post_status'                => 'draft',
						'order' => 'asc',
						//'offset' => 2
					   // 'meta_key'               => 'vortex_system_likes',
						//'categories'	=>	array( -147 ),
					)     );
					
					foreach( $folks as $lead ){
						set_post_type( $lead->ID , 'ssi_tenants' );
						//wp_publish_post( $lead->ID ); 
					}
				/*	
					 $all_folks = get_posts( array (
						
					   'posts_per_page'         =>  -1,
					  // 'post_type' => 'party_guests',
						'category_name'                  => 'tenant',
						//'post_status'                => 'draft',
						'order' => 'asc',
						//'offset' => 2
					   // 'meta_key'               => 'vortex_system_likes',
						//'categories'	=>	array( -147 ),
					)     );
					
					foreach( $folks as $lead ){
					//	update_field( "lead_phone", $user[4] , $newLead );
					}
					
 */

get_header('new-network');

//get_template_part( 'content', 'rentals' );

 ?> 
<div class='clearfix'></div>

<div id='autos' class='services autos text-center'>
		
				
			<div class='container text-center'>
	
		
			<div class="col-xs-1 col-sm-3">
				<br>
				
			</div>
			<div class="col-xs-10 col-sm-6">
				
			
				<img class='img-responsive aligncenter' src='/wp-content/uploads/rooms-per-week-ad.jpg'>
				
			</div>
			
		</div>
	
		
		
		<?php if ( is_user_logged_in()  ) { ?>
					
					<button id='new-property' class=" hidden">ADD Property</button>
					
					<a class="btn-block btn hidden" href="http://shamanshawn.com/wp-content/uploads/TipsTricksoftheHouse-Updated42617.pdf">Tips &amp; Tricks of the House - Updated 4/26/17</a>


		<?php } ?>
			<hr>
			
			<h4>Our Rooms</h4>
			
			

				<div id='new-property' style='display: none;'>
				<div class='well'>
				
				
				<form method='get'>
				
						
						<input type='hidden' name='new_property' value='1'>

		<div class='col-xs-12 h3 blk text-center'>Property Address: <input type='text' name='post_title'>
		
		</div>
				<div class='clearfix'></div><hr>
		<div class='col-sm-3'>
		
		<div class='well'>
		
		<?php
				$thumb_id = get_post_thumbnail_id( $lead->ID );
			$thumb_url_array = wp_get_attachment_image_src(  $thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];

				 
				
			?>
				<h4>Property Photo</h4><br><br>
					<img src='#'>
				<center>
				<?php //wp_handle_upload( $file ); ?>

				<input type='file' name="thumbnail" id="thumbnail"></center>
				<?php
				
				//set_post_thumbnail( $lead->ID , $attach_id);
				?>
				</div>
		
				<br><br>
			
			
		<div class='clearfix'></div>
		</div>
		<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Type:</b></div>
					<div class='col-sm-8 col-xs-6'>
					
						<select name='property_type'>
						  <option value="row">Row Home</option>
						  <option value="apt">Apartment</option>
						  <option value="single">Single Family</option>
						  <option value="multi">Multi-Family</option>
						</select>
					</div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Beds:</b></div>
					<div class='col-sm-8 col-xs-6'>
						<input type='text' name='property_beds'>
					</div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Baths:</b></div>
					<div class='col-sm-8 col-xs-6'>
						<input type='text' name='property_baths'>
					</div>
					<div class='clearfix'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Lease:</b></div>
					<div class='col-xs-6'>
						<select name='property_range' value='Weekly'>
						  <option value="Daily" >Daily</option>
						  <option value="Weekly" selected>Weekly</option>
						  <option value="Monthly">Monthly</option>
						  <option value="Yearly">Yearly</option>
						</select>
					</div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Parking:</b></div>
					<div class='col-xs-6'>
						<select name='property_parking' value='Street'>
						  <option value="None" >None</option>
						  <option value="Street" selected>Street</option>
						  <option value="Driveway">Driveway</option>
						  <option value="Garage">Garage</option>
						</select>
					</div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Reviews:</b></div>
					<div class='col-xs-6'><input type='text' name='property_reviews' value='0'></div>
					<div class='clearfix'></div><hr>
				</div>
				
							<div class='clearfix'></div>

			</div>
			
			<div class='clearfix'></div>
					<div class='col-xs-12 h4 blk text-center'>Neighborhood: <?php echo get_field('property_neighborhood', $lead->ID );
					
					?><input type='text' name='property_neighborhood'></div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3 text-center'>
		
					<h4>Total Rooms</h4>
					<h1 class='blk'><?php echo get_field('product_price', $lead->ID ); ?> <!--<small class='blk'>/wk</small>--></h1>
				<br><?php echo get_field('rental_security_deposit', $lead->ID ); ?><input type="number" name="rooms_available" value="0" min="0" max="10"> Available<br><hr>
					
					
					<input type='submit' value='Submit Property' class='btn btn-lg btn-default btn-block'>
					
				<div class='clearfix'></div>
				</div>
				
				<div class='clearfix'></div>
				
				</form>
			</div>
					</div>
	</div>

	<div class='clearfix'></div>
			

	<div class='text-center rentals'>


<br>

			<?php 
				$args = array( 'post_type' => 'ssi_rentals' , 'category_name' => 'property', 'posts_per_page' => -1 , 'order' => 'ASC' );
				$property = get_posts( $args );

				$t_id = 0;

				foreach( $property as $lead ){
?>

<div class='well'>

		<div class='col-xs-12 h3 blk text-center'><?php echo $lead->post_title; ?></div>
				<div class='clearfix'></div><hr>
		<div class='col-sm-3'>
		
		<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>
		
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
				
				
				<small>All Photos >></small></a>
		
				<br><br>
			
			
		<div class='clearfix'></div>
		</div>
		<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Type:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('property_type', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Beds:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('property_beds', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Baths:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('property_baths', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Lease:</b></div>
					<div class='col-xs-6'><?php echo get_field('property_range', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Parking:</b></div>
					<div class='col-xs-6'><?php echo get_field('property_parking', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Reviews:</b></div>
					<div class='col-xs-6'><?php echo get_field('property_reviews', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				
							<div class='clearfix'></div>

			</div>
			
			<div class='clearfix'></div>
					<div class='col-xs-12 h4 blk text-center'>Neighborhood: <?php echo get_field('property_neighborhood', $lead->ID );
					
					?></div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3 text-center'>
		
			<h4>Total Rooms</h4>
			<h1 class='blk'><?php echo get_field('property_beds', $lead->ID ); ?> <!--<small class='blk'>/wk</small>--></h1>
		<br><?php 
		
		
		 echo get_field('rooms_available', $lead->ID );  ?> Available!!<br><hr>
			
			<button id='rooms<?php echo $property_ID; ?>' class='btn btn-lg btn-default btn-block'>More Info >></button>
			
			
		<div class='clearfix'></div>
		</div>
		
			<div class='clearfix'></div>
	</div>	
			
		
	<div id='rooms<?php echo $property_ID; ?>' class='container' style='display: none;'>	
		<?php 
		
			$args = array( 'post_type' => 'ssi_rentals' , 'category_name' => 'rooms', 'posts_per_page' => -1 , 'order' => 'ASC' );
				$rooms = get_posts( $args );

				$t_id = 0;
				
				$property_ID = $lead->ID;

				foreach( $rooms as $lead ){
					
					if(get_field('property_id', $lead->ID ) != $property_ID ){ continue; }
		
		?>
		
			<div class='well hidden1'>

		<div class='col-xs-12 h3 blk'><?php echo $lead->post_title; ?></div>
				<div class='clearfix'></div>
		<div class='col-sm-3'>
		
		<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>
		
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
				
				
				<small>All Photos >></small></a>
		
				<br>
			
			
		<div class='clearfix'></div>
		</div>
		<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Type:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_room_type', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Floor:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_floor', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Furnished:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_furnished', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Heater:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_heater', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>A/C:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_ac', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Reviews:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_reviews', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				
							<div class='clearfix'></div>

			</div>
			
			<div class='clearfix'></div>
					<div class='col-xs-12 h4 blk'><?php 
					
				 
					
					if( get_field('rental_available', $lead->ID ) == 'Yes' ){ 
					
						if( $_GET['switch'] ){ 
						
						update_post_meta( $lead->ID ,'rental_available', 'No' ); 
						echo "Not Available!";
						}
						
					  }else{ 
					
					if( $_GET['switch'] ){ update_post_meta( $lead->ID ,'rental_available', 'Yes' );
						echo "Available!"; 
					}
					
					} 
					
					?>
					
						<br>
					<a href='?switch=true&ID=<?php echo $lead->ID; ?>' class='btn btn-default'>Switch</a>
					
					</div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3'>
		
			<h4>PRICE</h4>
			<h1 class='blk'>$<?php echo get_field('rental_rate', $lead->ID ); ?> <small class='blk'>/wk</small></h1>
			<br>Security Deposit: $<?php echo get_field('rental_security_deposit', $lead->ID ); ?><br><hr>
			
			<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-md btn-default btn-block'>More Info >></a>
			
			
		<div class='clearfix'></div>
		</div>
		
		<div class='clearfix'></div>
	</div>	
		
		
				<?php } ?>
		
		
		
		
		
		<button id='new-room<?php echo $property_ID; ?>'>ADD ROOM</button>
			<hr>
		<div id='new-room<?php echo $property_ID; ?>' style='display: none;'>
					<div class='well'>
				
				
				<form method='get'>
				
						
						<input type='hidden' name='new_room' value='1'>
						<input type='hidden' name='property_ID' value='<?php echo $property_ID; ?>'>

		<div class='col-xs-12 h3 blk text-center'>Room Title <input type='text' name='post_title'>
		
		</div>
				<div class='clearfix'></div><hr>
		<div class='col-sm-3'>
		
		<div class='well'>
		
		<?php
				$thumb_id = get_post_thumbnail_id( $lead->ID );
			$thumb_url_array = wp_get_attachment_image_src(  $thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];

				 
				
			?>
				<h4>Property Photo</h4><br><br>
					<img src='#'>
				<center>
				<?php //wp_handle_upload( $file ); ?>

				<input type='file' name="thumbnail" id="thumbnail"></center>
				<?php
				
				//set_post_thumbnail( $lead->ID , $attach_id);
				?>
				</div>
		
				<br><br>
			
			
		<div class='clearfix'></div>
		</div>
		<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Type:</b></div>
					<div class='col-sm-8 col-xs-6'>
					
						<select name='rental_room_type' value="Private">
						  <option value="Shared">Shared</option>
						  <option value="Private">Private</option>
						
						</select>
					</div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Floor:</b></div>
					<div class='col-sm-8 col-xs-6'>
						<select name='rental_floor' value="Upstairs">
						  <option value="Upstairs">Upstairs</option>
						  <option value="Private">Downstairs</option>
							<option value="Basement">Basement</option>
						</select>
					</div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Furnished:</b></div>
					<div class='col-sm-8 col-xs-6'>
						<select name='rental_furnished' value="No">
						  <option value="Fully">Fully</option>
						  <option value="Partially">Partially</option>
							<option value="No">No</option>
						</select>
					</div>
					<div class='clearfix'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Heater:</b></div>
					<div class='col-xs-6'>
						<select name='rental_heater' value='Yes'>
						  <option value="Yes" >Yes</option>
						  <option value="No" >No</option>
						
						</select>
					</div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>A/C:</b></div>
					<div class='col-xs-6'>
						<select name='rental_ac' value='Yes'>
						  <option value="Yes" >Yes</option>
						  <option value="No" >No</option>
						
						</select>
					</div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Reviews:</b></div>
					<div class='col-xs-6'><input type='text' name='property_reviews' value='0'></div>
					<div class='clearfix'></div><hr>
				</div>
				
							<div class='clearfix'></div>

			</div>
			
			<div class='clearfix'></div>
					<div class='col-xs-12 h4 blk text-center'>Available: <select name='rental_available' value='Yes'>
						  <option value="Yes" >Yes</option>
						  <option value="No" >No</option>
						
						</select></div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3 text-center'>
		
					<h4>Price</h4>
					<h1 class='blk'><input type="number" name="rental_rate" value="0" > <small class='blk'>/wk</small></h1>
				<br><hr>
					Security Deposit $<input type="number" name="rental_security_deposit" value="0" >
					
					<input type='submit' value='Submit Property' class='btn btn-lg btn-default btn-block'>
					
				<div class='clearfix'></div>
				</div>
				
				<div class='clearfix'></div>
				
				</form>
			</div>
		</div>
		
		</div>
		
		
		
	
			<?php
			}
			
		
		
	?>
					


	</div>
	
	<div class='clearfix'></div>
	
	
	
			

	<div class='container text-center roommates hidden'>

		<hr>
			<h4>
				Our Roommates
			</h4>
		<hr>
<br>




			<?php 
				$args = array( 'post_type' => 'ssi_tenants' , 'posts_per_page' => -1 , 'order' => 'asc' );
				$roommates = get_posts( $args );

				$count = 1;

				foreach( $roommates as $lead ){
					
						if( get_field( "move-out_date", $lead->ID ) == "" ){ 
							$cur_roommates++;
							
						}else{
							 continue; 
						}
					
					
					 
					$rate = get_field( 'room_rate', $lead->ID );
					
					$s_date = date('Y-m-d H:i:s', strtotime(  $lead->post_date  ) );
			
			if( get_field( "move-out_date", $lead->ID ) != "" ){
				
				
				

				$s_date = date('Y-m-d', strtotime(  $lead->post_date  ) );
				$e_date = date("Y-m-d H:i:s", strtotime( get_field( "move-out_date", $lead->ID ) ));

				$e_date = get_field( "move-out_date", $lead->ID );
				$e_date = date('Y-m-d', strtotime(  $e_date ) );

			}else{
				
				$e_date = current_time( 'mysql' );
				
			}
			//echo "SD==>" . $s_date . "ED==>" . $e_date;

			$date1 = date_create( $s_date );
			$date2 = date_create( $e_date );

			$diff=date_diff($date1,$date2);
	
			$tot_days = $diff->format("%a");
			//echo "TOTAL DAYS--->" . $tot_days;

			$weeks = floor($tot_days/7);

			$days = $tot_days - ($weeks*7);
					
			$months = floor($weeks/4);		
					
			//$weeks = $weeks - ($months*4);
					
					
?>
	
	<div class='well green'>
	<div class='col-xs-12 col-sm-1'>
		<br class='visible-sm hidden-xs'><br class='visible-sm hidden-xs'>
		<div class='circle h4 red'> <?php echo $count++; ?>  </div>
		<br>
	</div>
	<div class='col-xs-6 col-sm-2'>
		<u><b>CodeNAME</b></u><br>
		<?php 
		
		//echo strlen($lead->post_title);
/*		$first_name = explode(' ',$lead->post_title,-1);
		$first_name = $first_name[0];
		$length = strlen($first_name);
		$len = $length-3;
		//echo $first_name;
		echo substr( $lead->post_title, 0, 3 ); 
		
		while( $len > 1 ){
			echo "~";
			$len--;
		}
		echo substr( $lead->post_title, $length-1, 1 ); 
		
	*/	
			//echo strlen($lead->post_title);
		//$first_name = explode(' ',$lead->post_title,-1);
		//$first_name = $first_name[0];
		//$length = strlen($first_name);
		//$len = $length-2;
		//echo $first_name;
		//echo substr( $lead->post_title, 0, 2 ); 
		
		echo $lead->post_title;
		?>
	</div>
	<div class='col-xs-6 col-sm-3'>
		<u><b>ROOM</b></u><br>
		Judson - <?php echo get_field( "room_rented", $lead->ID ); ?>
	</div>
	<div class='clear visible-xs'></div>
	<div class=' col-sm-3'>
	
	<br class='visible-xs'><br class='visible-xs'>
	
	
		<u><b>DATES</b></u><br>
		<?php echo  get_field( "move-in_date", $lead->ID );
		
		
		
			if( get_field( "move-out_date", $lead->ID ) ){ 

				echo " - " . get_field( "move-out_date", $lead->ID ); 
			}else{ echo " - Current";  }
		?>
	</div>
	
	<div class='col-sm-3'>
	
	<br class='visible-xs'><br class='visible-xs'>
		<u><b>RANGE</b></u><br>
		<?php echo "<u>" . $weeks . "</u> WEEKS &nbsp;&nbsp; <u>" . $days . "</u> DAYS"; ?>
		<br><small>( <?php echo $months;  ?> Months = <?php
		
		//$years = floor($months/12);
		
		$years = round( ($months/12) , 2 );
		echo $years;
	//	echo '<br><br>';
		
	//	$total_months = $years * 12 * 4;
		
	//	echo $total_months;
	//	echo '<br><br>';
		
	//	echo ( ( $weeks - $total_months ) / 4 );
		
	//	echo '<br><br>';
		
	//	echo $weeks - $total_months;
		//echo round( ($months/12) , 2 );  
		
		
		?> Years: )</small>
	</div>
	
	<div class='clearfix'></div>

	<?php if($rate == 0){ ?>
		<br>
		<div class='alert-success text-center '> #SSI H.O.U.S.E - GRANT </div>
		<?php }else{ ?> <?php } ?>
		
		<br>
		
		<a target='_blank' href='/?p=<?php echo $lead->ID; ?>' class='btn btn-info btn-block'> View Profile</a>
		
	</div>
					

	
	<div class='well hidden'>

		<div class='col-xs-12 h3 blk'><?php //echo $lead->post_title; ?></div>
				<div class='clearfix'></div><hr>
		<div class='col-sm-3'>
		
		<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>
		
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
				
				
				<small>All Photos >></small></a>
		
				<br><br>
			
			
		<div class='clearfix'></div>
		</div>
		<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Type:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_room_type', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Floor:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_floor', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Furnished:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_furnished', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Heater:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_heater', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>A/C:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_ac', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Reviews:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_reviews', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				
							<div class='clearfix'></div>

			</div>
			
			<div class='clearfix'></div>
					<div class='col-xs-12 h4 blk'><?php  if( get_field('rental_available', $lead->ID ) == 'No' ){ echo "Not Available!"; }else{ echo "Available!"; } 

					?>
					
				
					
					</div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3'>
		
			<h4>PRICE</h4>
			<h1 class='blk'>$<?php echo get_field('product_price', $lead->ID ); ?> <small class='blk'>/wk</small></h1>
			<br>Security Deposit: $<?php echo get_field('rental_security_deposit', $lead->ID ); ?><br><hr>
			
			<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>More Info >></a>
			
			
		<div class='clearfix'></div>
		</div>
		
		<div class='clearfix'></div>
	</div>		
			<?php
			}
			
		
		
	?>
					


	</div>
	
	

	
	
	
	
	
	
	
	
	
		<div class='container text-center wishlist hidden'>

		<hr>
			<h4>
				Past Roommates
			</h4>
		<hr>
<br>




			<?php 
				$args = array( 'post_type' => 'ssi_tenants' , 'post_status' => 'publish', 'order' => 'desc','posts_per_page' => -1  );
				$moved = get_posts( $args );

				$count = 1;

				foreach( $moved as $lead ){
					
					$rate = get_field( 'room_rate', $lead->ID );
					
					$s_date = date('Y-m-d H:i:s', strtotime(  $lead->post_date  ) );
					
					if( get_field( "move-out_date", $lead->ID ) == "" ){
						continue;
					}
			
			if( get_field( "move-out_date", $lead->ID ) != "" ){
				
				
				

				$s_date = date('Y-m-d', strtotime(  $lead->post_date  ) );
				$e_date = date("Y-m-d H:i:s", strtotime( get_field( "move-out_date", $lead->ID ) ));

				$e_date = get_field( "move-out_date", $lead->ID );
				$e_date = date('Y-m-d', strtotime(  $e_date ) );

			}else{
				
				$e_date = current_time( 'mysql' );
				
			}
			//echo "SD==>" . $s_date . "ED==>" . $e_date;

			$date1 = date_create( $s_date );
			$date2 = date_create( $e_date );

			$diff=date_diff($date1,$date2);
	
			$tot_days = $diff->format("%a");
			//echo "TOTAL DAYS--->" . $tot_days;

			$weeks = floor($tot_days/7);

			$days = $tot_days - ($weeks*7);
					
			$months = floor($weeks/4);		
					
			//$weeks = $weeks - ($months*4);
					
					
?>
	
	<div class='well red'>
	<div class='col-xs-12 col-sm-1'>
		<br class='visible-sm hidden-xs'><br class='visible-sm hidden-xs'>
		<div class='circle h4 '> <?php echo $count++; ?>  </div>
		<br>
	</div>
	<div class='col-xs-6 col-sm-2'>
		<u><b>NAME</b></u><br><br>
		<?php 
		
		//echo strlen($lead->post_title);
		$first_name = explode(' ',$lead->post_title,-1);
		$first_name = $first_name[0];
		$length = strlen($first_name);
		$len = $length-2;
		//echo $first_name;
		echo substr( $lead->post_title, 0, 2 ); 
		
		while( $len > 1 ){
			echo "~";
			$len--;
		}
		echo substr( $lead->post_title, $length-1, 1 ); 
		?>
	</div>
	<div class='col-xs-6 col-sm-3'>
		<u><b>ROOM</b></u><br><br>
		Judson - <?php echo get_field( "room_rented", $lead->ID ); ?>
	</div>
	<div class='clear visible-xs hidden-sm'><br></div>
	<div class=' col-sm-3'>
		<u><b>DATES</b></u><br><br>
		<?php echo  get_field( "move-in_date", $lead->ID );
			
			if( get_field( "move-out_date", $lead->ID ) ){ 

				echo " - " . get_field( "move-out_date", $lead->ID ); 
			}else{ echo " - Current";  }
		?>
	</div>
	<div class='clear visible-xs hidden-sm'><br></div>
	<div class='col-sm-3'>
		<u><b>RANGE</b></u><br><br>
		<?php echo "<u>" . $weeks . "</u> WEEKS &nbsp;&nbsp; <u>" . $days . "</u> DAYS"; ?>
		<br><small>(Months: <?php echo $months; ?>)</small>
	</div>
	
	<div class='clearfix'></div>
	<?php
	$phone = get_field('lead_phone', $lead->ID );
	//if( $phone != "" ){ echo "<br><br>" . get_field("lead_phone", $lead->ID ); } 
	
	
	//echo "<br><br>";
	
	$phone = preg_replace( '/[^0-9]/', '', $phone );
	
	//$len = strlen($phone);
	
//	echo $len;
	//echo "<br><br>";
	
	//echo $phone;
	
	
	
	$length = strlen($first_name);
		$len = $length-2;
		//echo $first_name;
		//echo substr( $lead->post_title, 0, 2 ); 
		
		while( $len > 1 ){
			//echo "~";
			$len--;
		}
		//echo substr( $lead->post_title, $length-1, 1 ); 
		
	//	echo "<br><br>";
		
		
	if($len == 11){ 
	
	$country_code = substr( $phone, 0, 1 );
	$area_code = substr( $phone, 1, 3 );
	$first3 = substr( $phone, 4, 3 );
	$last4 = substr( $phone, 7, 4 );
	
	$phone =  $country_code . "-" . $area_code . "-" . $first3 . "-" . $last4; 
	$phone =  $country_code + "-" + $area_code + "-" + $first3 + "-" + $last4; 
	
	}
	elseif($len == 10){ 
	
	
	$country_code = "1";
	$area_code = substr( $phone, 1, 3 );
	$first3 = substr( $phone, 4, 3 );
	$last4 = substr( $phone, 7, 4 );
	
	$phone =  $country_code . "-" . $area_code . "-" . $first3 . "-" . $last4; 
	$phone =  $country_code + "-" + $area_code + "-" + $first3 + "-" + $last4; 
	
	
	}
	
	//echo "<br><br>";
	
	//echo $phone;
	
	?>
	<?php if($rate == 1){ ?>
		<br>
		<div class='alert-danger text-center '> #SSI H.O.U.S.E - GRANT </div>
		<?php }else{ ?> <?php } ?>
		
	</div>
					

	
	<div class='well hidden'>

		<div class='col-xs-12 h3 blk'><?php //echo $lead->post_title; ?></div>
				<div class='clearfix'></div><hr>
		<div class='col-sm-3'>
		
		<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>
		
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
				
				
				<small>All Photos >></small></a>
		
				<br><br>
			
			
		<div class='clearfix'></div>
		</div>
		<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Type:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_room_type', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Floor:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_floor', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Furnished:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_furnished', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Heater:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_heater', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>A/C:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_ac', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Reviews:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_reviews', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				
							<div class='clearfix'></div>

			</div>
			
			<div class='clearfix'></div>
					<div class='col-xs-12 h4 blk'><?php if( get_field('rental_available', $lead->ID ) == 'No' ){ echo "Not Available!"; }else{ echo "Available!"; } 
					
					
					
					?>
					
						<br>
					<a href='?switch=1&ID=<?php echo $lead->ID; ?>' class='btn btn-default'>Switch</a>
					
					</div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3'>
		
			<h4>PRICE</h4>
			<h2 class='blk'>$<?php echo get_field('product_price', $lead->ID ); ?> <small class='blk'>/wk</small></h2>
			<br>Security Deposit: $<?php echo get_field('rental_security_deposit', $lead->ID ); ?><br><hr>
			
			<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>More Info >></a>
			
			
		<div class='clearfix'></div>
		</div>
		
		<div class='clearfix'></div>
	</div>		
			<?php
			}
			
		
		
	?>
						<div class='clearfix'></div><hr>
		
	<div class='clearfix'></div>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		<div class='container text-center wishlist hidden'>

		<hr>
			<h4>
				Our Wait List
			</h4>
		<hr>
<br>




			<?php 
				$args = array( 'post_type' => 'ssi_tenants' , 'post_status' => 'pending', 'order' => 'desc','posts_per_page' => -1  );
				$waitlist = get_posts( $args );

				$count = 1;

				foreach( $waitlist as $lead ){
					
					$rate = get_field( 'room_rate', $lead->ID );
					
					$s_date = date('Y-m-d H:i:s', strtotime(  $lead->post_date  ) );
			
			if( get_field( "move-out_date", $lead->ID ) != "" ){
				
				
				

				$s_date = date('Y-m-d', strtotime(  $lead->post_date  ) );
				$e_date = date("Y-m-d H:i:s", strtotime( get_field( "move-out_date", $lead->ID ) ));

				$e_date = get_field( "move-out_date", $lead->ID );
				$e_date = date('Y-m-d', strtotime(  $e_date ) );

			}else{
				
				$e_date = current_time( 'mysql' );
				
			}
			//echo "SD==>" . $s_date . "ED==>" . $e_date;

			$date1 = date_create( $s_date );
			$date2 = date_create( $e_date );

			$diff=date_diff($date1,$date2);
	
			$tot_days = $diff->format("%a");
			//echo "TOTAL DAYS--->" . $tot_days;

			$weeks = floor($tot_days/7);

			$days = $tot_days - ($weeks*7);
					
			$months = floor($weeks/4);		
					
			//$weeks = $weeks - ($months*4);
					
					
?>
	
	<div class='well yellow'>
	<div class='col-xs-12 col-sm-1'>
		<br class='visible-sm hidden-xs'><br class='visible-sm hidden-xs'>
		<div class='circle h4 red'> <?php echo $count++; ?>  </div>
		<br>
	</div>
	<div class='col-xs-6 col-sm-2'>
		<u><b>NAME</b></u><br><br>
		<?php 
		
		//echo strlen($lead->post_title);
		$first_name = explode(' ',$lead->post_title,-1);
		$first_name = $first_name[0];
		$length = strlen($first_name);
		$len = $length-2;
		//echo $first_name;
		echo substr( $lead->post_title, 0, 2 ); 
		
		while( $len > 1 ){
			echo "~";
			$len--;
		}
		echo substr( $lead->post_title, $length-1, 1 ); 
		?>
	</div>
	<div class='col-xs-6 col-sm-3'>
		<u><b>ROOM</b></u><br><br>
		Judson - <?php echo get_field( "room_rented", $lead->ID ); ?>
	</div>
	<div class='clear visible-xs hidden-sm'><br></div>
	<div class=' col-sm-3'>
		<u><b>DATES</b></u><br><br>
		<?php echo  get_field( "move-in_date", $lead->ID );
			
			if( get_field( "move-out_date", $lead->ID ) ){ 

				echo " - " . get_field( "move-out_date", $lead->ID ); 
			}else{ echo " - Current";  }
		?>
	</div>
	<div class='clear visible-xs hidden-sm'><br></div>
	<div class='col-sm-3'>
		<u><b>RANGE</b></u><br><br>
		<?php echo "<u>" . $weeks . "</u> WEEKS &nbsp;&nbsp; <u>" . $days . "</u> DAYS"; ?>
		<br><small>(Months: <?php echo $months; ?>)</small>
	</div>
	
	<div class='clearfix'></div>
	<?php
	$phone = get_field('lead_phone', $lead->ID );
	//if( $phone != "" ){ echo "<br><br>" . get_field("lead_phone", $lead->ID ); } 
	
	
	//echo "<br><br>";
	
	$phone = preg_replace( '/[^0-9]/', '', $phone );
	
	//$len = strlen($phone);
	
//	echo $len;
	//echo "<br><br>";
	
	//echo $phone;
	
	
	
	$length = strlen($first_name);
		$len = $length-2;
		//echo $first_name;
		//echo substr( $lead->post_title, 0, 2 ); 
		
		while( $len > 1 ){
			//echo "~";
			$len--;
		}
		//echo substr( $lead->post_title, $length-1, 1 ); 
		
	//	echo "<br><br>";
		
		
	if($len == 11){ 
	
	$country_code = substr( $phone, 0, 1 );
	$area_code = substr( $phone, 1, 3 );
	$first3 = substr( $phone, 4, 3 );
	$last4 = substr( $phone, 7, 4 );
	
	$phone =  $country_code . "-" . $area_code . "-" . $first3 . "-" . $last4; 
	$phone =  $country_code + "-" + $area_code + "-" + $first3 + "-" + $last4; 
	
	}
	elseif($len == 10){ 
	
	
	$country_code = "1";
	$area_code = substr( $phone, 1, 3 );
	$first3 = substr( $phone, 4, 3 );
	$last4 = substr( $phone, 7, 4 );
	
	$phone =  $country_code . "-" . $area_code . "-" . $first3 . "-" . $last4; 
	$phone =  $country_code + "-" + $area_code + "-" + $first3 + "-" + $last4; 
	
	
	}
	
	//echo "<br><br>";
	
	//echo $phone;
	
	?>
	<?php if($rate == 1){ ?>
		<br>
		<div class='alert-danger text-center '> #SSI H.O.U.S.E - GRANT </div>
		<?php }else{ ?> <?php } ?>
		
	</div>
					

	
	<div class='well hidden'>

		<div class='col-xs-12 h3 blk'><?php //echo $lead->post_title; ?></div>
				<div class='clearfix'></div><hr>
		<div class='col-sm-3'>
		
		<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>
		
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
				
				
				<small>All Photos >></small></a>
		
				<br><br>
			
			
		<div class='clearfix'></div>
		</div>
		<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Type:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_room_type', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Floor:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_floor', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Furnished:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_furnished', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Heater:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_heater', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>A/C:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_ac', $lead->ID ); ?></div>
						<div class='clearfix'></div><hr>
					<div class='col-xs-6'><b>Reviews:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_reviews', $lead->ID ); ?></div>
					<div class='clearfix'></div><hr>
				</div>
				
							<div class='clearfix'></div>

			</div>
			
			<div class='clearfix'></div>
					<div class='col-xs-12 h4 blk'><?php if( get_field('rental_available', $lead->ID ) == 'No' ){ echo "Not Available!"; }else{ echo "Available!"; } 
					
					
					
					?>
					
						<br>
					<a href='?switch=1&ID=<?php echo $lead->ID; ?>' class='btn btn-default'>Switch</a>
					
					</div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3'>
		
			<h4>PRICE</h4>
			<h2 class='blk'>$<?php echo get_field('product_price', $lead->ID ); ?> <small class='blk'>/wk</small></h2>
			<br>Security Deposit: $<?php echo get_field('rental_security_deposit', $lead->ID ); ?><br><hr>
			
			<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>More Info >></a>
			
			
		<div class='clearfix'></div>
		</div>
		
		<div class='clearfix'></div>
	</div>		
			<?php
			}
			
		
		
	?>
						<div class='clearfix'></div><hr>
				<a href='/rental-application' class='btn btn-lg btn-info btn-block'>Join Our Wait-List >></a>
				<hr>
	<div class='clearfix'></div>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="col-xs-10 col-xs-offset-1 ">
				
				<img class='img-responsive aligncenter' src='http://shamanshawn.com/wp-content/uploads/SSI-HOUSE.png'>
				
				
				
			</div>
			
				<br><br>
	
	
	<div class="popular-cities container">
				
					<div class="col-xs-12">
						<h1>Popular Cities</h1>
					</div>
			
				
							<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/nevada/las+vegas.html" title="Las Vegas, NV">Las Vegas</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/georgia/atlanta.html" title="Atlanta, GA">Atlanta</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/illinois/chicago.html" title="Chicago, IL">Chicago</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/california/los+angeles.html" title="Los Angeles, CA">Los Angeles</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/texas/austin.html" title="Austin, TX">Austin</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/arizona/phoenix.html" title="Phoenix, AZ">Phoenix</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/florida/orlando.html" title="Orlando, FL">Orlando</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/new+york/new+york.html" title="New York, NY">New York</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/florida/jacksonville.html" title="Jacksonville, FL">Jacksonville</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/virginia/virginia+beach.html" title="Virginia Beach, VA">Virginia Beach</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/texas/san+antonio.html" title="San Antonio, TX">San Antonio</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/ohio/columbus.html" title="Columbus, OH">Columbus</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/indiana/indianapolis.html" title="Indianapolis, IN">Indianapolis</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/california/sacramento.html" title="Sacramento, CA">Sacramento</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/pennsylvania/philadelphia.html" title="Philadelphia, PA">Philadelphia</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/arizona/scottsdale.html" title="Scottsdale, AZ">Scottsdale</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/d.c./washington.html" title="Washington, DC">Washington</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/colorado/colorado+springs.html" title="Colorado Springs, CO">Denver</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/california/san+jose.html" title="San Jose, CA">San Jose</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/arizona/mesa.html" title="Mesa, AZ">Mesa</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/california/long+beach.html" title="Long Beach, CA">Long Beach</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/arizona/tucson.html" title="Tucson, AZ">Tucson</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/virginia/norfolk.html" title="Norfolk, VA">Norfolk</a>
			</div>
		</div>	
			<div class="col-xs-4 col-md-2">
			<div class="btn city-btn">
				<a href="/virginia/fairfax.html" title="Fairfax, VA">Fairfax</a>
			</div>
		</div>	
				
				
			</div>
			<br><br>
		
			
			<div class='container well green text-center'>
				<h4>Room Statistics<br><small>(Real Time)</small></h4><hr>
				<div class='col-xs-6 col-sm-3'>
					Total Rooms<br>
					<?php
						echo count($rooms);
					?>
				</div>
				
				<div class='col-xs-6 col-sm-3'>
					Available<br>
					<?php
						echo $available;
					?>
				</div>
				<div class='visible-xs hidden-sm'><br></div>
				<div class='col-xs-6 col-sm-3'>
					Roommates<br>
					<?php
						echo count($roommates);
					?>
				</div>
				<div class='col-xs-6 col-sm-3'>
					Wait List<br>
					<?php
						echo count($waitlist);
					?>
				</div>
				<div class='clear'><br></div><hr>
				<a href='/rental-application' class='btn btn-lg btn-info btn-block'>Join Our Wait-List >></a>
			</div>
			
			

</div><!-- .content-area -->

	<br>
<?php

		
	get_template_part('content' , 'member-area' );

get_footer('admin'); ?> 