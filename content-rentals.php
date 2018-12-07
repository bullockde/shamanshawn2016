<div id='rentals' class=' services rentals'>
		
		<div class='container '>
			<h2><center>#SSI Rentals</center></h2><hr>
			

			<img src='http://shamanshawn.com/wp-content/uploads/SSI-HOUSE.png' class=' aligncenter hidden'>
			<img src='http://shamanshawn.com/wp-content/uploads/rooms-per-week-ad.jpg' class='  aligncenter '>
			
			<div class='clear'></div>
			<div class="col-md-6 hidden text-center">
				
				<?php
				$house = get_posts( array('post_type' => 'ssi_rentals' , 'include' => array('12778') ) );
					//echo get_the_post_thumbnail( '12778' );	
					
				?>
				
			</div>
			<div class="col-md-12">
				<?php 
				
					
						
						
				$rooms = get_posts( array('post_type' => 'ssi_rentals' , 'category_name' => 'property', 'posts_per_page' => -1 ) );
					
					foreach( $rooms as $lead ){ //print_r($lead); 
					
					//$cats = get_the_category($lead->ID); 
					
					//print_r($cats);
						?> 
						
						
						<div class='well'>

		<div class='col-xs-12 blk text-center'><?php echo $lead->post_title; ?></div>
				<div class='clear'></div><hr>
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
			
			
		<div class='clear'></div>
		</div>
		<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Type:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('property_type', $lead->ID ); ?></div>
						<div class='clear'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Beds:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('property_beds', $lead->ID ); ?></div>
						<div class='clear'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Baths:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('property_baths', $lead->ID ); ?></div>
					<div class='clear'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Lease:</b></div>
					<div class='col-xs-6'><?php echo get_field('property_range', $lead->ID ); ?></div>
						<div class='clear'></div><hr>
					<div class='col-xs-6'><b>Parking:</b></div>
					<div class='col-xs-6'><?php echo get_field('property_parking', $lead->ID ); ?></div>
						<div class='clear'></div><hr>
					<div class='col-xs-6'><b>Reviews:</b></div>
					<div class='col-xs-6'><?php echo get_field('property_reviews', $lead->ID ); ?></div>
					<div class='clear'></div><hr>
				</div>
				
							<div class='clear'></div>

			</div>
			
			<div class='clear'></div>
					<div class='col-xs-12 h4 blk text-center'>Neighborhood: <?php echo get_field('property_neighborhood', $lead->ID );
					
					?></div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3 text-center'>
		
			<h4>Total Rooms</h4>
			<h3 class='blk'><?php echo get_field('product_price', $lead->ID ); ?> <!--<small class='blk'>/wk</small>--></h3>
		<br><?php echo get_field('rental_security_deposit', $lead->ID ); ?>3	` Available<br><hr>
			
			<a href='/rentals' class='btn btn-lg btn-default btn-block'>More Info >></a>
			
			
		<div class='clear'></div>
		</div>
		
		<div class='clear'></div>
	</div>	
						
						
					
						<?php
						
						
						
						
						
					}
				?>

				
			</div>
		</div>
	
	</div><!--  #Rentals  -->