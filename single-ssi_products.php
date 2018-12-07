<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?> 


<div id='rentals' class=' services rentals'>
		
		<div class='container '>
			<?php 
			$current = get_posts( array('post_type' => 'ssi_products' ,'include' => array( $post->ID )  ) );
			$house = get_posts( array('post_type' => 'ssi_products' , 'include' => array('12778') ) );
			
			echo "<h3><center>Eclectic 1930's Row Home - " . $current[0]->post_title . "</center></h3><hr>" ; ?>
			
			
			<div class='clear'></div>
			<div class="col-md-6 text-center">
				
				<?php
				
					echo get_the_post_thumbnail( $post->ID, $size = 'medium' );	
					
				?>
				
			</div>
			<div class="col-md-6">
				<?php 
				
				
				//print_r($current);
						
						$house_content = apply_filters( 'the_content', $current[0]->post_content );
						
						echo $house_content;
						
				?>

				<a href='/rental-application' class='btn btn-info btn-lg btn-block' target='_blank'> Submit Online Application >> </a>
			</div>
			<div class='clear'><hr><br></div>
				<center><h4>More Rooms</h4></center>
				<div class='clear'></div><hr>
			

	<div class='container text-center rentals'>


<br>




			<?php 
				$args = array( 'post_type' => 'ssi_products' , 'category_name' => 'rooms' , 'posts_per_page' => 8 , 'order' => 'ASC' );
				$trips = get_posts( $args );

				$t_id = 0;

				foreach( $trips as $lead ){
?>
	<div class='well'>

		<div class='col-xs-12 h3 blk'><?php echo $lead->post_title; ?></div>
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
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_room_type', $lead->ID ); ?></div>
						<div class='clear'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Floor:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_floor', $lead->ID ); ?></div>
						<div class='clear'></div><hr>
					<div class='col-sm-4 col-xs-6'><b>Furnished:</b></div>
					<div class='col-sm-8 col-xs-6'><?php echo get_field('rental_furnished', $lead->ID ); ?></div>
					<div class='clear'></div><hr>
				</div>
				<div class='col-sm-6'>
					<div class='col-xs-6'><b>Heater:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_heater', $lead->ID ); ?></div>
						<div class='clear'></div><hr>
					<div class='col-xs-6'><b>A/C:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_ac', $lead->ID ); ?></div>
						<div class='clear'></div><hr>
					<div class='col-xs-6'><b>Reviews:</b></div>
					<div class='col-xs-6'><?php echo get_field('rental_reviews', $lead->ID ); ?></div>
					<div class='clear'></div><hr>
				</div>
				
							<div class='clear'></div>

			</div>
			
			<div class='clear'></div>
					<div class='col-xs-12 h4 blk'><?php if( get_field('rental_available', $lead->ID ) == 'No' ){ echo "Not Available!"; }else{ echo "Available!"; } 
					
					?></div><br>
					
			
			

			
		
		</div>
		<div class='col-sm-3'>
		
			<h4>PRICE</h4>
			<h1 class='blk'>$<?php echo get_field('product_price', $lead->ID ); ?> <small class='blk'>/wk</small></h1>
			<br>Security Deposit: $<?php echo get_field('rental_security_deposit', $lead->ID ); ?><br><hr>
			
			<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-lg btn-default btn-block'>More Info >></a>
			
			
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
<?php// get_template_part('content','rentals'); ?>

<?php get_footer(); ?>