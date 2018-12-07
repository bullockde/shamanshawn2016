
			<?php 
				$args = array( 'post_type' => 'ssi_vehicles' , 'posts_per_page' => 8 , 'order' => 'RAND' );
				$trips = get_posts( $args );

				$t_id = 0;

				foreach( $trips as $lead ){
?>
	<div class='well'>

		<div class='col-xs-12 h3 red'><?php echo $lead->post_title; ?></div>
				<div class='clear'></div><hr>
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
			
			
		<div class='clear'></div>
		</div>
		<div class='col-sm-6'>
			
		

			
			<div class='text-left'>
				<div class='col-sm-6'>
					<div class='col-sm-4 col-xs-6'><b>Year:</b></div>
					<div class='col-sm-8 col-xs-6'>1995</div>
						<div class='clear'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Make:</b></div>
					<div class='col-sm-8 col-xs-6'>Dodge</div>
						<div class='clear'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Model:</b></div>
					<div class='col-sm-8 col-xs-6'>Grand Caravan SE</div>
					<div class='clear'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Mileage:</b></div>
					<div class='col-xs-6'>101 K</div>
						<div class='clear'></div><hr>
					<div class='col-xs-6'><b>Condition:</b></div>
					<div class='col-xs-6'>Fair</div>
						<div class='clear'></div><hr>
					<div class='col-xs-6'><b>Transmission:</b></div>
					<div class='col-xs-6'>Automatic</div>
					<div class='clear'></div><hr>
				</div>
				
							<div class='clear'></div>

			</div>
			
			<div class='clear'></div>
					<div class='col-xs-12 h4 red'>Kelly Blue Book: $2,895</div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3'>
		
			<h4>PRICE</h4>
			<h1 class='red'>$125 <small class='red'>/wk</small></h1>
			<br>$500 Down + 20 weeks<br><hr>
			
			<a target='_blank' href='/vehicle/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>More Info >></a>
			
			
		<div class='clear'></div>
		</div>
		
		<div class='clear'></div>
	</div>		
	<?php }?>
					
<div class='clear'></div>