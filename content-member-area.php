<?php

	if ( !is_user_logged_in()  ) {
		
		 
 ?>
			
				
				
				<div class='well'>
							
					
					
					<div id='join' style='display: block;' class='text-center'>
					<h4>Join Today - 100% FREE!</h4><hr>
					<a href='/join' class='btn btn-success btn-lg btn-block hidden1'>Join Now</a>
					
					<button id='join' class='btn btn-success btn-lg btn-block hidden'>Join Now</button>
					</div>
					<div id='join' style='display: none;'>
					
						<center><h3>Join Today - 100% FREE!</h3></center>
						<?php echo do_shortcode("[wpmem_form register]"); ?>
					</div>
					
					<br>
					
					
					<div id='login' style='display: block;' class='text-center'>
						<center><h4>Already A Member?</h4></center><hr>
						
						<a href='/login' class='btn btn-success btn-lg btn-block hidden1'>Login Here</a>
						<button id='login' class='btn btn-success btn-lg btn-block hidden'>Login Here</button>
					</div>
					<div id='login' style='display: none;' >
					
						<center><h3>Member Login</h3></center>
						
						<?php echo do_shortcode("[wpmem_form login]"); ?>
					</div>
					
				</div>
			
			
		<div class='clear'></div>
		
<?php

	}else{
			$current_user = wp_get_current_user();
		?>	
		
			<div class=' '>

				<div class='well'>
				
					<center>Members Area</center>
					<div class='clear'></div><hr>
					
					
					
							<div class='col-sm-6 '>


				
				
				<div class='col-sm-4 text-center'>
					<a href="/user-profile/?ID=<?php echo $current_user->ID; ?>"><?php echo $current_user->display_name; ?></a>
									<br><br>
									
				<?php 
				
					if( get_field( 'facebook' , $lead->ID ) != '' ){
						
						
				?>
						<img src="http://graph.facebook.com/<?php echo get_field( 'facebook' , $lead->ID ); ?>/picture" class="hidden img-responsive">
					<?php 

					}

				echo '<a href="/user-profile/?ID=' . $current_user->ID . '">' . get_avatar($current_user->ID, 96) . "</a><br>";
				
				 		
					?>
				</div>
				<div class='col-sm-8 '>
	
		<div class='clear'></div>
					
					
					<br><b>Address:</b> 
			
					<?php 
					if( get_user_meta($current_user->ID, 'MX_user_address', "user_" . $current_user->ID) ){ 
						echo get_user_meta($current_user->ID, 'MX_user_address', "user_" . $current_user->ID); 
					
					}else{
						
						echo "- UNKNOWN -" ;
					}
					
					?> 
					
					
					<br>
					<b>Location: </b>
					<?php 
			
										
								$closet = 0;
								if ( get_user_meta($current_user->ID, 'MX_user_city', 1 ) && get_user_meta($current_user->ID, 'MX_user_state', 1) ){

																		echo ' <span style="text-transform: capitalize;">' . get_user_meta($current_user->ID, 'MX_user_city', 1 ) . '</span>, ';
																		echo get_user_meta($current_user->ID, 'MX_user_state', 1) ;

								}
								else if ( get_user_meta($current_user->ID, 'MX_user_state', 1) ){
									echo  get_user_meta($current_user->ID, 'MX_user_state', 1);
								}
								else{
									$closet = 1;
									echo '- UNKNOWN -';
}				
					
					?>
						 
					
					
					<br><b>Phone#:</b> 
			
					<?php 
					if( get_user_meta($current_user->ID, 'MX_user_phone', "user_" . $current_user->ID) ){ 
						echo get_user_meta($current_user->ID, 'MX_user_phone', "user_" . $current_user->ID); 
					
					}else{
						
						echo "- UNKNOWN -" ;
					}
					
					?> 
					<br><br><center><b><u>Email</u></b> <br>
					<?php 
					if( get_user_meta($current_user->ID, 'MX_user_email', "user_" . $current_user->ID) ){ 
						echo get_user_meta($current_user->ID, 'MX_user_email', "user_" . $current_user->ID); 
					
					}else{
						
						echo "- UNKNOWN -" ;
					}
					
					?> </center>
					<div class='clear'></div><hr>
					

		
		<div class='col-sm-12 text-center'>
			<u>Member Since</u><br>
			<?php echo mysql2date('M j, Y', $current_user->user_registered ); ?><br><br>
		</div>
		<div class='col-sm-5 hidden text-center'>
			<u>Last Logged In</u><br>
			<?php
					$last_login = (int) get_user_meta( $current_user->ID , 'when_last_login' , true );
					if ( $last_login ) {
						$format = apply_filters( 'wpll_date_format', get_option( 'date_format' ) );
						$value  = date_i18n( $format, $last_login );
						echo $value;
					}else{
						echo "Never";
					}
			
			?><br>
		</div>
		<div class='clear'></div>
	
	
	</div>
				<div class='col-xs-8 '>

					
				
					<div class='clear'></div><br>
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
					
				
			</div>
					
		<div class='col-sm-6 text-center ht-cta-buttons'>
					
			<div class='clear'></div>			
					<a target='_blank' href='/user-profile/?ID=<?php echo  $current_user->ID; ?>' class='ht-cta-button1 btn  btn-block'>View Profile</a>
					
					<a target='_blank' href='/edit-profile/?ID=<?php echo  $current_user->ID; ?>' class='ht-cta-button1 btn  btn-block'>Edit Profile</a>
					
					<a target='_blank' href='/members/<?php echo $current_user->user_nicename; ?>/profile/change-avatar/' class='ht-cta-button2 btn btn-block '>Update Photo</a>
					<div class='clear'></div><hr>	
				
					
					<?php echo do_shortcode("[wpmem_form login]"); ?>
				</div>		
				<div class='clear'></div>
				</div>
			<div class='clear'></div>
			</div>
		<div class='clear'></div>
		
		<?php
	}
 ?>	

