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


 
 
 
get_header('profile'); 


 


?>



<div id="primary" class="">
	<main id="main" class="" role="main">
	

		<div class='clearfix'></div>
		
		
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			//get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>
	
		
		<div class='clearfix'></div>



<div id="primary" class="container report">


	
<?php 
if( get_field( 'MX_user_ID', $_GET['ID'] ) ){
	$report_user_ID = get_field( 'MX_user_ID',  $_GET['ID'] );
	$has_user = 1;
	$user = get_userdata( $report_user_ID );
}else if( is_user_logged_in() ){
	echo "--" . $user->ID;
	$has_user = 1;
	$user = wp_get_current_user();
}


if( $has_user ){ 

	//echo "--" . $user->ID;
?>
<div class='col-xs-8 '>


				
				
				<div class='col-xs-4 text-center'>
					<?php echo $user->display_name; ?>
									<br><br>
									
				<?php 
				
					if( get_field( 'facebook' , $lead->ID ) != '' ){
						
						
				?>
						<img src="http://graph.facebook.com/<?php echo get_field( 'facebook' , $lead->ID ); ?>/picture" class="hidden img-responsive">
					<?php 

					}
				?>
				<div class='circle'>
				<?php echo  get_avatar($user->ID, 96) . "<br>"; ?>
				
				</div>
				<?php		
				
					?>
				</div>
				<div class='col-xs-8 '>
	
		<div class='clearfix'></div>
					
					
					<br><b>Address:</b> 
			
					<?php 
					if( get_user_meta($user->ID, 'MX_user_address', "user_" . $user->ID) ){ 
						echo get_user_meta($user->ID, 'MX_user_address', "user_" . $user->ID); 
					
					}else{
						
						echo "- UNKNOWN -" ;
					}
					
					?> 
					
					
					<br>
					<b>Location: </b>
					<?php 
			
										
								$closet = 0;
								if ( get_user_meta($user->ID, 'MX_user_city', 1 ) && get_user_meta($user->ID, 'MX_user_state', 1) ){

																		echo ' <span style="text-transform: capitalize;">' . get_user_meta($user->ID, 'MX_user_city', 1 ) . '</span>, ';
																		echo get_user_meta($user->ID, 'MX_user_state', 1) ;

								}
								else if ( get_user_meta($user->ID, 'MX_user_state', 1) ){
									echo  get_user_meta($user->ID, 'MX_user_state', 1);
								}
								else{
									$closet = 1;
									echo '- UNKNOWN -';
}				
					
					?>
						 
					
					
					<br><b>Phone#:</b> 
			
					<?php 
					if( get_user_meta($user->ID, 'MX_user_phone', "user_" . $user->ID) ){ 
						echo get_user_meta($user->ID, 'MX_user_phone', "user_" . $user->ID); 
					
					}else{
						
						echo "- UNKNOWN -" ;
					}
					
					?> 
					<br><br><center><b><u>Email</u></b> <br>
					<?php 
					if( get_user_meta($user->ID, 'MX_user_email', "user_" . $user->ID) ){ 
						echo get_user_meta($user->ID, 'MX_user_email', "user_" . $user->ID); 
					
					}else{
						
						echo "- UNKNOWN -" ;
					}
					
					?> </center>
					<div class='clearfix'></div>

		
		
	
	</div>
				<div class='col-xs-8 '>

					
				
					<div class='clearfix'></div><br>
					<?php 
					
		
		
		$social = get_posts( array( 'post_type' => 'ssi_social' , 'posts_per_page' => -1, 'order' => 'asc' ) );

		foreach( $social as $site ){ // print_r($site->post_name);				
			?>		
	
			<?php 
			//echo get_field( $lead->post_name  , $lead->ID );
			
			if( get_field( $site->post_name  , $lead->ID ) || get_field( "MX_user_" . $site->post_name , $lead->ID ) ){ 

				$social_count[$index]++;	
				$param_name = "MX_user_" . $site->post_name;
				$param_val = get_field( $site->post_name , $lead->ID );
				//update_post_meta( $lead->ID, $param_name, $param_val  );
				
			?>
				<a target='_blank' href='<?php echo get_field( 'website_link' , $site->ID ); ?><?php echo get_field( "MX_user_" . $site->post_name , $lead->ID ); ?>'><img width='20' src='
<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $site->post_name; ?>.png'  class=''>/<?php echo get_field( "MX_user_" . $site->post_name , $lead->ID ); ?>
</a>
<br>

			<?php 		}
			$index++;
			?>	
			<?php 		
		}

		
					
		$index = 0;
		foreach( $social as $site => $link ){				
			?>	

			
			<?php			if( get_field( $site , $lead->ID ) ){ 

				$social_count[$index]++;	
				
				
			?>
			<a target='_blank' href='<?php echo $link; ?><?php echo get_field( $site , $lead->ID ); ?>'>
				<div class="col-xs-12 pad0">
				
					<img width='15' src='<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $site; ?>.png' class=''>
					
					/<?php echo get_field( $site , $lead->ID ); ?>

				</div>
				 
				
			</a>
			<?php 		}
			$index++;
			?>	
			<?php 		
		}
	?>
					
				</div>
				
<div class='clearfix'></div>
					

		
		<div class='col-xs-6 hidden-print'><hr>
			<u>Member Since</u>: 
			<?php echo mysql2date('M j, Y', $user->user_registered ); ?>
		</div>
		<div class='col-xs-6 hidden-print'><hr>
			<u>Last Logged In</u>: 
			<?php
					$last_login = (int) get_user_meta( $user->ID , 'wp-last-login' , true );
					if ( $last_login ) {
						$format = apply_filters( 'wpll_date_format', get_option( 'date_format' ) );
						$value  = date_i18n( $format, $last_login );
						echo $value;
					}else{
						echo "Never";
					}
			
			?>
		</div>
		<div class='clearfix'></div>
				
					
				
			</div>
			<div class='col-sm-4 text-center'>
				<?php 
				
				$date_format = get_option( 'date_format' );
				
				//echo get_the_modified_date( $date_format ,$lead->ID); 
				
				?>
				<b>Updated:</b> <?php echo date( $date_format ); ?>
				<div class='clearfix'></div><hr class='hidden-print'>
				
				<div class='clearfix'></div>
		
					<div class='col-xs-6'>
	
				
				
								<button id='payments' class='btn btn-default btn-block hidden-print'>Payments</button>
								<button id='tasklist' class='btn btn-default btn-block hidden-print'>Taskslist</button>
								<button id='budget' class='btn btn-default btn-block hidden-print'>Budget</button>
								<button id='notes' class='btn btn-default btn-block hidden-print'>Notes</button>
							</div>
							<div class='col-xs-6'>
								<button id='rental' class='btn btn-default btn-block hidden-print'>Rental Info</button>
								<button id='forms' class='btn btn-default btn-block hidden-print'>Forms</button>
								<button id='wishlist' class='btn btn-default btn-block hidden-print'>Wishlist</button>
								<button id='more' class='btn btn-default btn-block hidden-print'>More</button>
								
							</div>

					<div class='clearfix'></div><hr>
			</div>

<?php } ?>


<div class='clearfix'></div>
		
		<div class='col-xs-6'>

					<button id='payments' class='btn btn-default btn-block hidden-print'>Payments</button>
					<button id='tasklist' class='btn btn-default btn-block hidden-print'>Taskslist</button>
					<button id='budget' class='btn btn-default btn-block hidden-print'>Budget</button>
					<button id='notes' class='btn btn-default btn-block hidden-print'>Notes</button>
				</div>
				<div class='col-xs-6'>
					<button id='rental' class='btn btn-default btn-block hidden-print'>Rental Info</button>
					<button id='forms' class='btn btn-default btn-block hidden-print'>Forms</button>
					<button id='wishlist' class='btn btn-default btn-block hidden-print'>Wishlist</button>
					<button id='more' class='btn btn-default btn-block hidden-print'>More</button>
					
				</div>

	
	<div class='clearfix'></div>

			<?php get_template_part('content' , 'add-post-types'); ?>
		
		
		
<?php //get_sidebar(); ?>
<?php get_footer('profile'); ?>
