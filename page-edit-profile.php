<?php 
/*
Template Name: Users Profile Page
*/




if( is_user_logged_in() ){ 

	$current_user = wp_get_current_user();
	$userid = $current_user->ID;
}else{
	$userid = $_GET['ID'];
}

$user = get_userdata( $userid );
$current_user = get_userdata( $userid );
	
	
$admin_user = 0;
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $current_user->roles ) ) {
		$admin_user = 1;

	}
	


	


//$current_user = wp_get_current_user();
//$current_user = $current_user[0];

						
//print_r( $userid . "==" .  $current_user->ID );	

			

	$userData = array( 'MX_user_city' ,'MX_user_state' ,'MX_user_zip_code' ,'MX_user_age' ,'MX_height_ft' ,'MX_height_in' ,'MX_weight' ,'MX_body_type' ,'MX_ethnicity' ,'MX_sex' ,'MX_sexual_orientation' ,'MX_position' ,'MX_endowment' ,'MX_circumcised' ,'MX_out' ,'MX_body_hair' ,'MX_hair_color' ,'MX_eye_color'  );
	
	//$usermeta =  get_user_meta($current_user->ID, $current_user->ID); 
	//print_r($usermeta);
	if( $_POST['edit_profile'] ){
		
		foreach ($_POST as $param_name => $param_val) {
			add_user_meta( $current_user->ID, $param_name, $param_val );
			update_user_meta( $current_user->ID, $param_name, $param_val );
			update_field($param_name, $param_val , "user_" . $current_user->ID );
			//echo "'MX_$param_name' ,";
		}
		
		if( $_POST['display_name'] ){
			wp_update_user( array( 'ID' => $userid, 'display_name' => $_POST['display_name'] ) );
		}
		//$vars =  get_queried_object();
		// print_r($vars);
		
		echo "<h1 class='text-center'> PROFILE UPDATED!! </h1>";
		//wp_update_user( array( 'ID' => $current_user->ID  ) );
		
		wp_redirect( '/user-profile/?ID=' . $userid );
	}else if(  get_user_meta($current_user->ID, $current_user->ID, 'MX_MX_user_age') == ''){
		//$usermeta =  get_user_meta($current_user->ID, $current_user->ID); 
			
			//print_r($usermeta);
		foreach ($userData as $param_name) {
			
			if( $param_val == "" ) $param_val = "-";
			
			add_user_meta( $current_user->ID, $param_name, "-" );
			
			//update_user_meta( $current_user->ID, $param_name, "-" );
			//update_field($param_name, "-" , "user_" . $current_user->ID );
			//update_field($param_name, $param_val , "user_" . $current_user->ID );
			//echo "Param: $param_name; Value: $param_val<br />\n";
		}
		wp_update_user( array( 'ID' => $current_user->ID  ) );
		
	}
	
	
get_header();	

						
								
if( ($userid == $current_user->ID) ||  $admin_user ){



 ?>
 
 <hr>
<h2 class="post-title text-center"><?php wp_title(""); ?></h2>   <hr>


	
		<div id='profile' class='profile'>
			<?php
						
						
						if( 0 ) {
							echo "<div id='coming-soon'>You Must <a href='/register/'><u>Register</u></a> or <a href='/login'><u>Log IN</u></a> to View your Profile.</div>";
						}else{
						
							echo "<div>";
 ?>
								<div class="col-sm-3 text-center">
								
								<div class="link upper bold white">
									<center><a href="/user-profile/?ID=<?php echo $current_user->ID; ?>">
								<?php
								echo  $current_user->display_name;
								?>
								<br><br>
								<?php echo get_avatar($current_user->ID, 150); ?>
										</a></center>
									</div><br>
									<a href='/members/<?php echo $current_user->user_nicename; ?>/profile/change-avatar/' class='btn btn-block btn-warning'>Upload Image</a>
									
									<a href='/members/<?php echo $current_user->user_nicename; ?>/profile/change-avatar/' class='btn btn-warning btn-block hidden'>Change Photo</a>
									

</div>
<div class='col-sm-9 hidden'>
<?php

 							
								echo '<div id="user">' ;
									echo '<div class="link upper bold white"> <a href="/user-profile/?ID=' . $current_user->ID . '">' . $current_user->display_name . "</div>";
									echo '<a href="/user-profile/?ID=' . $current_user->ID . '">' . get_avatar($current_user->ID, 96) . "</a><br>";

								if ( get_user_meta($current_user->ID, 'MX_city', "user_" . $current_user->ID ) && get_user_meta($current_user->ID, 'MX_state', "user_" . $current_user->ID ) ){

										echo '<b>Location:</b> ' . get_user_meta($current_user->ID, 'MX_city', "user_" . $current_user->ID ) . ', ';
										echo get_user_meta($current_user->ID, 'MX_state', "user_" . $current_user->ID ) . '<br><br>';

}
else if ( get_user_meta($current_user->ID, 'MX_state', "user_" . $current_user->ID ) ){
	echo '<b>Location:</b> ' . get_user_meta($current_user->ID, 'MX_state', "user_" . $current_user->ID ) . ', ' . get_user_meta($current_user->ID, 'MX_country', "user_" . $current_user->ID ) . '<br><br>';
}
else{
	echo '<b>Location:</b> In The Closet <br><br>';
}
										
										echo '<b>Country:</b> ' . get_user_meta($current_user->ID, 'MX_country', "user_" . $current_user->ID ) . '<br>';
										
										
										
										echo '<b>Zip:</b> ' . get_user_meta($current_user->ID, 'MX_zip_code', "user_" . $current_user->ID ) . '<br><br>';


									echo "Member Since<br>" . mysql2date('M j, Y', $current_user->user_registered );

									
									$last_login = (int) get_user_meta($current_user->ID , 'wp-last-login' , true );
										if ( $last_login ) {
											$format = apply_filters( 'wpll_date_format', get_option( 'date_format' ) );
											$value  = date_i18n( $format, $last_login );
											echo "<br><br>Last Logged In<br>" . $value;

											
										}else{
											echo "<br><br>Last Logged In<br> Never";
										}
									
								echo '</div>';
								$count++;
					

			
						

 ?>
 </div>
	<br><div id='user-info'>
			<div id='user-personal'>
		
		<form method='post'>
		
		
		
	<div class='col-xs-8 text-center '>
	
		
		<div class='clear'></div><hr>
		

	
	</div>
	
	
		
		<div class='clear'></div>
				
				<input type='hidden' name='ID' value='<?php echo $userid; ?>'>
				<input type='hidden' name='edit_profile' value='1'>
	<div class="personal-info hidden">			
			<div class="prof-info col-sm-6">
				<h3>Age</h3>
				<hr>
					 <input type='text' name='MX_user_age' value='<?php echo get_user_meta(  $current_user->ID, 'MX_user_age', 1); ?>'>
				</div>
				<div class="prof-info col-sm-6">
					<h3>Height</h3>
					<hr>
						 <input type='text' name='MX_height_ft' value='<?php echo get_user_meta($current_user->ID, 'MX_height_ft', 1) . "' " . get_user_meta(  $current_user->ID, 'MX_height_in', 1) . '"' ; ?>' size='2'> ft
						  <input type='text' name='MX_height_in' value='<?php echo get_user_meta( $current_user->ID, 'MX_height_in', 1) . "' " . get_user_meta($current_user->ID, $current_user->ID, 'MX_height_in', 1) . '"' ; ?>' size='2'> in
					</div>
					<div class="prof-info col-sm-6">
						<h3>Weight</h3>
						<hr>
							<input type='text' name='MX_weight' value='<?php echo get_user_meta($current_user->ID, 'MX_weight', 1); ?>'>
						</div>

						<div class="prof-info col-sm-6">
							<h3>Body Type</h3>
							<hr>
								 <input type='text' name='MX_body_type' value='<?php echo get_user_meta($current_user->ID, 'MX_body_type', 1); ?>'>
							</div>
							<div class="prof-info col-sm-6">
								<h3>Ethnicity</h3>
								<hr>
									 <input type='text' name='MX_ethnicity' value='<?php echo get_user_meta($current_user->ID, 'MX_ethnicity', 1); ?>'>
								</div>
								<div class="prof-info col-sm-6">
									<h3>Sex</h3>
									<hr>
										<input type='text' name='MX_sex' value='<?php echo get_user_meta($current_user->ID, 'MX_sex', 1); ?>'>
									</div>							<div class="prof-info col-sm-6">
										<h3>Orientation</h3>
										<hr>
											<input type='text' name='MX_sexual_orientation' value='<?php echo get_user_meta($current_user->ID, 'MX_sexual_orientation', 1); ?>'>
										</div>
										
										
		<div class="prof-info col-sm-6">
											<h3>Adult Stats</h3>
											<hr>
											
			<div class=' col-xs-6'>
				Position:
			</div>
			<div class=' col-xs-6'>
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_position', 1);
					$options = array( '-', 'Top', 'Vers/Top', 'Vers', 'Vers/Bttm', 'Bottom');

				?>
				<select name="MX_user_position" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
			</div>
			<div class=' col-xs-6'>
				Endowment:
			</div>
			<div class=' col-xs-6'>
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_endowment', 1);
					$options = array('-',  '4', '4.5', '5', '5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '12.5', '13+');

				?>
				<select name="MX_user_endowment" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
					 inches
			</div>
											
			<div class=' col-xs-6'>
				Cut / Uncut:
			</div>
			<div class=' col-xs-6'>
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_circumcised', 1);
					$options = array('-',  'Cut', 'Uncut');

				?>
				<select name="MX_user_circumcised" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
			</div>
												
												
	</div>								
										
										
										
								
								<!--					<div class="prof-info col-sm-6">
														<h3>Style</h3>
														<hr>
															 <input type='text' name='MX_style' value='<?php echo get_user_meta($current_user->ID, 'MX_style', 1); ?>'>
														</div>	
								-->
														<div class="prof-info col-sm-6">
															<h3>Out?</h3>
															<hr>
																 <input type='text' name='MX_out' value='<?php echo get_user_meta($current_user->ID, 'MX_out', 1); ?>'>
															</div>									<div class="prof-info col-sm-6">
																<h3>Body Hair</h3>
																<hr>
																	 <input type='text' name='MX_body_hair' value='<?php echo get_user_meta($current_user->ID, 'MX_body_hair', 1); ?>'>
																</div>	

																<div class="prof-info col-sm-6">
																	<h3>Hair Color</h3>
																	<hr>
																		<input type='text' name='MX_hair_color' value='<?php echo get_user_meta($current_user->ID, 'MX_hair_color', 1); ?>'>
																	</div>						
																	<div class="prof-info col-sm-6">
																		<h3>Eye Color</h3>
																		<hr>
																			 <input type='text' name='MX_eye_color' value='<?php echo get_user_meta($current_user->ID, 'MX_eye_color', 1); ?>'>
																		</div>
																		
																	</div>

																	
																		<div class='clear'></div><br>
																	<?php
									 
									// check if the repeater field has rows of data
									if( have_rows('additional_images', 1) ):
									
										// loop through the rows of data
										while ( have_rows('additional_images', 1) ) : the_row();
											// display a sub field value
											?>
																	<a href="#" onClick="jkpopimage('<?php the_sub_field("image", 1); ?>', 615, 500, 'InstaFliXXX Image for: <?php echo $current_user->display_name; ?>'); return false"><img style='width: 208px; height: 150px;' src='<?php the_sub_field("image", 1); ?>'></a>

																				<?php
										endwhile;
									 
									else :
									 
										// no rows found
									 
									endif;
									 
								?>


																				<div class='clear'></div>


																				<div class='profile-social hidden'>
																					<?php $add_social = 0; ?>
																					<h3>Lets Get Social... Bitch!!!</h3>
																					<table border="1">

																						<?php if( get_user_meta($current_user->ID, 'MX_facebook_profile_link', 1) ){ ?>
																						<tr>
																							<td>Facebook</td>
																							<td><?php echo get_user_meta($current_user->ID, 'MX_facebook_profile_link', "user_" . $current_user->ID); $add_social += 1;?></td>

																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_twitter_link', "user_" . $current_user->ID)   ){ ?>
																						<tr>
																							<td>Twitter</td>
																							<td><?php echo "<a target='_blank' href='http://twitter.com/" . get_user_meta($current_user->ID, 'MX_twitter_link', "user_" . $current_user->ID) . "'>" . get_user_meta($current_user->ID, 'MX_twitter_link', "user_" . $current_user->ID) . "</a>"; $add_social += 1; ?></td>

																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_instagram_link', "user_" . $current_user->ID)  && $add_social < 4 ){ ?>
																						<tr>
																							<td>Instagram</td>
																							<td><?php echo "<a target='_blank' href='http://instagram.com/" . get_user_meta($current_user->ID, 'MX_instagram_link', "user_" . $current_user->ID) . "'>" . get_user_meta($current_user->ID, 'MX_instagram_link', "user_" . $current_user->ID) . "</a>"; $add_social += 1; ?></td>

																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_kik_name', "user_" . $current_user->ID)    ){ ?>
																						<tr>
																							<td>KIK</td>
																							<td><?php echo get_user_meta($current_user->ID, 'MX_kik_name', "user_" . $current_user->ID);  $add_social += 1; ?></td>

																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_vine_username', "user_" . $current_user->ID)     ){ ?>
																						<tr>
																							<td>Vine</td>
																							<td><?php echo get_user_meta($current_user->ID, 'MX_vine_username', "user_" . $current_user->ID);  $add_social += 1; ?></td>
																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_snapchat_username', "user_" . $current_user->ID)    ){ ?>
																						<tr>
																							<td>Snapchat</td>
																							<td><?php echo get_user_meta($current_user->ID, 'MX_snapchat_username', "user_" . $current_user->ID); $add_social += 1; ?></td>
																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_skype_username', "user_" . $current_user->ID)    ){ ?>
																						<tr>
																							<td>Skype</td>
																							<td><?php echo get_user_meta($current_user->ID, 'MX_skype_username', "user_" . $current_user->ID);  $add_social += 1; ?></td>
																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_oovoo_username', "user_" . $current_user->ID)   ){ ?>
																						<tr>
																							<td>ooVoo</td>
																							<td><?php echo get_user_meta($current_user->ID, 'MX_oovoo_username', "user_" . $current_user->ID);  $add_social += 1; ?></td>
																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_adam4adam_username', "user_" . $current_user->ID)  && $add_social < 5){ ?>
																						<tr>
																							<td>Adam4Adam</td>
																							<!--<td><?php echo get_user_meta($current_user->ID, 'MX_adam4adam_username', "user_" . $current_user->ID);  $add_social += 1; ?></td>
											-->
																							<td><?php echo "<a target='_blank' href='http://www.adam4adam.com/?p=" . get_user_meta($current_user->ID, 'MX_adam4adam_username', "user_" . $current_user->ID) . "'>" . get_user_meta($current_user->ID, 'MX_adam4adam_username', "user_" . $current_user->ID) . "</a>"; $add_social += 1; ?></td>

																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_bgc_username', "user_" . $current_user->ID)    ){ ?>
																						<tr>
																							<td>BGC Live</td>
																							<td><?php echo "<a target='_blank' href='http://bgclive.com/" . get_user_meta($current_user->ID, 'MX_bgc_username', "user_" . $current_user->ID) . "'>" . get_user_meta($current_user->ID, 'MX_bgc_username', "user_" . $current_user->ID) . "</a>"; $add_social += 1; ?></td>
																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_grindr_username', "user_" . $current_user->ID)    ){ ?>
																						<tr>
																							<td>Grindr</td>
																							<td><?php echo get_user_meta($current_user->ID, 'MX_grindr_username', "user_" . $current_user->ID);  $add_social += 1; ?></td>
																						</tr>
																						<?php }
									
										if( get_user_meta($current_user->ID, 'MX_jackd_username', "user_" . $current_user->ID)    ){ ?>	
																						<tr>
																							<td>Jack'd</td>
																							<td><?php echo get_user_meta($current_user->ID, 'MX_jackd_username', "user_" . $current_user->ID);  $add_social += 1; ?></td>
																						</tr>
																						<?php } 
									
										if( get_user_meta($current_user->ID, 'MX_facetime_username', "user_" . $current_user->ID)   ){ ?>	
																						<tr>
																							<td>Facetime</td>
																							<td><?php echo get_user_meta($current_user->ID, 'MX_facetime_username', "user_" . $current_user->ID);  $add_social += 1;?></td>
																						</tr>
																						<?php } 
										if( !$add_social ){ ?>	
																						<tr>
																							<td><center>This User has not added any Social Media</center></td>

																						</tr>
																						<?php } ?>
																					</table> 



																				</div>


</div>

		<?php } ?>
	</div>

				
</div>				
				<div class='clear'></div>
				
				
	
				<div class='col-sm-3' >
					<b>Alias / Nickname: </b> 
					
					<input type="text" name="display_name" placeholder="Display Name" value="<?php echo  $current_user->display_name; ?>">
				</div>
				<div class='col-sm-2' >
					<b>First Name: </b> 
					
					<input type="text" name="MX_user_first_name" placeholder="First Name" value="<?php echo get_user_meta($current_user->ID, 'MX_user_first_name', "user_" . $current_user->ID); ?>">
				</div>
				<div class='col-sm-2' >
					<b>Last Name: </b> 
					
					<input type="text" name="MX_user_last_name" placeholder="Last Name" value="<?php echo get_user_meta($current_user->ID, 'MX_user_last_name', "user_" . $current_user->ID); ?>">
				</div>
				<div class='col-sm-2' >
					<b>Phone: </b> 
					
					<input type="text" name="MX_user_phone" placeholder="Phone"  value="<?php echo get_user_meta($current_user->ID, 'MX_user_phone', "user_" . $current_user->ID); ?>">
				</div>
				<div class='col-sm-3' >
					<b>Email: </b> 
					
					
					<input type="text" name="MX_user_email" placeholder="Email" value="<?php echo get_user_meta($current_user->ID, 'MX_user_email', "user_" . $current_user->ID); ?>">

				</div>
				<div class='col-sm-2 hidden' >
					<b>Rate: </b> 
					
					<input type="text" name="MX_user_rate" placeholder="Rate"  value="<?php echo get_user_meta($current_user->ID, 'MX_user_rate', "user_" . $current_user->ID); ?>">
				</div>
				<div class='col-sm-2 hidden'>
					<b>Type: </b> 
					<br>
					<?php 
				
					$att = $categories[0]->name;
					$options = array( '-', 'Client', 'Lead',  'Friend',  'Follower', 'Family', 'Landscape', 'Other' );

				?>
				<select name="contact_type" >
					
				<?php 
					foreach($options as $option){
						
						?>
						
						
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
		</div>
				
					<div class='clear'></div><hr>
					
				<div class='col-sm-12'> 
						<b>Location: </b> <br>
						
						<div class='col-sm-2'> 
								
						
						 <input type="text" name="MX_user_area_code" placeholder="Area Code" value="<?php echo get_user_meta($current_user->ID, 'MX_user_area_code', "user_" . $current_user->ID); ?>">
					</div>
					<div class='col-sm-3 hidden1'>
						
						 <input type="text" name="MX_user_address" placeholder="Address" value="<?php echo get_user_meta($current_user->ID, 'MX_user_address', "user_" . $current_user->ID); ?>">

					</div>
					
					
					<div class='col-sm-2'>
	
						<input type="text" name="MX_user_city" placeholder="City" Value="<?php echo get_user_meta($current_user->ID, 'MX_user_city', "user_" . $current_user->ID); ?>">

					</div>
					<div class='col-sm-1'>

						<input type="text" name="MX_user_state" placeholder="State" value="<?php echo get_user_meta($current_user->ID, 'MX_user_state', "user_" . $current_user->ID); ?>">

					</div>
					<div class='col-sm-2'>
						<input type="text" name="MX_user_zip" placeholder="Zip" value="<?php echo get_user_meta($current_user->ID, 'MX_user_zip', "user_" . $current_user->ID); ?>">				
				</div>	
					<div class='col-sm-2'>
						 <input type="text" name="MX_user_apt_num" placeholder="Apt/Suite #
						 " value="<?php echo get_user_meta($current_user->ID, 'MX_user_apt_num', "user_" . $current_user->ID); ?>">
					</div>
					<div class='clear'></div><hr>
	
					
	<div class=' col-xs-12 hidden'>			
				<div class='info'>
				<u>Details</u><br>
				
				
						
				<div class='col-sm-4' >
					<b>Last Seen: </b> 
					
					<input type="text" name="MX_user_last_seen" value="<?php echo date('n/j/y', strtotime( get_user_meta( 'MX_user_last_seen', "user_" . $current_user->ID ) ) ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Last Contacted: </b> 
					
					<input type="text" name="MX_user_last_contacted" placeholder="Last Contacted" value="<?php echo date('n/j/y', strtotime( get_user_meta( 'MX_user_last_contacted', "user_" . $current_user->ID ) ) ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Added: </b> 
					
					
					<input type="text" name="date_added" placeholder="Date Added" value="<?php echo mysql2date('n/j/y', $lead->post_date ); ?>">
				</div>
				
				
				<div class='col-sm-12' >
					<b>D.O.B: </b> 
					
					<input width="100" type="text" name="lead_dob" placeholder="D.O.B" value="<?php echo get_user_meta( 'MX_user_dob', "user_" . $current_user->ID ); ?>">
				</div>
				
		</div>		
	</div>			
			<div class='clear'></div>
				
				<input type='hidden' name='ID' value='<?php echo "user_" . $current_user->ID; ?>'>
				<input type='hidden' name='edit_profile' value='1'>
				
	<div class=' col-xs-12 hidden'>			
			<h3>Basic Stats</h3><hr>	
				<div class=' col-xs-6'>
				Age:
			</div>
			<div class=' col-xs-6'>
				 <input type='text' name='MX_user_age' value='<?php echo get_post_meta(  "user_" . $current_user->ID, 'MX_user_age', 1); ?>'>
			</div>
			<div class=' col-xs-6'>
				Height:
			</div>
			<div class=' col-xs-6'>
			<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_height_ft', 1);
					$options = array( '-', '4', '5',  '6',  '7' );

				?>
				<select name="MX_user_height_ft" >
					
				<?php 
					foreach($options as $option){
						
						?>
						
						
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
			
				ft
				
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_height_in', 1);
					$options = array( '-', '1', '2',  '3',  '4', '5',  '6',  '7', '8', '9', '10', '11');

				?>
				<select name="MX_user_height_in" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
				
						 in
				
				
			</div>
			<div class=' col-xs-6'>
				Weight:
			</div>
			<div class=' col-xs-6'>
				<input type='text' name='MX_user_weight' value='<?php echo get_post_meta("user_" . $current_user->ID, 'MX_user_weight', 1); ?>'>
			</div>	
				
				
		</div>			
				
			<div class='clear'></div>
	<div class="col-xs-12 hidden">		
					<h3>Full Details</h3><div class='clear'></div><hr>
					
	<div class="prof-info col-sm-6">
			
			<div class="col-xs-6">
				<b>Orientation</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_sexual_orientation', 1);
					$options = array( '-', 'Gay', 'Bi', 'Trans', 'DL' );

				?>
				<select name="MX_user_sexual_orientation" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>

			</div>
		</div>

		<div class="prof-info col-sm-6">
			<div class="col-xs-6">
				<b>Ethnicity</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_ethnicity', 1);
					$options = array('-', 'Native American', 'Asian', 'Black', 'Latino', 'Middle Eastern', 'Mixed', 'Pacific Islander', 'White', 'Other' );

				?>
				<select name="MX_user_ethnicity" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>

			</div>
		</div>
		
		
		<div class="prof-info col-sm-6">
			<div class="col-xs-6">
				<b>Sex</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_sex', 1);
					$options = array('-', 'Guy', 'Girl', 'Trans' );

				?>
				<select name="MX_user_sex" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>

			</div>
		</div>
				
		<div class="prof-info col-sm-6">
			<div class="col-xs-6">
				<b>Hair Color</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_hair_color', 1);
					$options = array('-', 'Black', 'Blond', 'Red' , 'Gray', 'White', 'Bald', 'Mixed', 'Shaved');

				?>
				<select name="MX_user_hair_color" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>

			</div>
		</div>
		
		<div class="prof-info col-sm-6">
			<div class="col-xs-6">
				<b>Out?</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_out', 1);
					$options = array('-', 'Yes', 'No');

				?>
				<select name="MX_user_out" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>

			</div>
		</div>		
				
		<div class="prof-info col-sm-6">
			<div class="col-xs-6">
				<b>Body Hair</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_body_hair', 1);
					$options = array('-', 'Smooth', 'Shaved', 'Buzzed', 'Some Hair', 'Hairy', 'Bear');

				?>
				<select name="MX_user_body_hair" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>

			</div>
		</div>	
		
		<div class="prof-info col-sm-6">
			<div class="col-xs-6">
				<b>Body Type</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_body_type', 1);
					$options = array('-', 'Slim', 'Average', 'Swimmers', 'Athletic', 'Muscular', 'Bodybuilder', 'Large');

				?>
				<select name="MX_body_type" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>

			</div>
		</div>
		
		<div class="prof-info col-sm-6">
			<div class="col-xs-6">
				<b>Eye Color</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_eye_color', 1);
					$options = array('-', 'Brown', 'Green', 'Gray', 'Hazel', 'Blue', 'Other');

				?>
				<select name="MX_eye_color" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>

			</div>
		</div>
	</div>								
						
						
	
	<div class="prof-info col-sm-6 hidden">
		<div class='clear'></div><br>
											<h3>Adult Stats</h3>
											<hr>
											
			<div class=' col-xs-6'>
				Position:
			</div>
			<div class=' col-xs-6'>
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_position', 1);
					$options = array( '-', 'Top', 'Vers/Top', 'Vers', 'Vers/Bttm', 'Bottom');

				?>
				<select name="MX_user_position" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
			</div>
			<div class=' col-xs-6'>
				Endowment:
			</div>
			<div class=' col-xs-6'>
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_endowment', 1);
					$options = array('-',  '4', '4.5', '5', '5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '12.5', '13+');

				?>
				<select name="MX_user_endowment" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
					 inches
			</div>
											
			<div class=' col-xs-6'>
				Cut / Uncut:
			</div>
			<div class=' col-xs-6'>
				<?php 
				
					$att = get_post_meta("user_" . $current_user->ID, 'MX_user_circumcised', 1);
					$options = array('-',  'Cut', 'Uncut');

				?>
				<select name="MX_user_circumcised" >
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
			</div>
												
												
	</div>
											
								<!--					<div class="prof-info col-sm-6">
														<h3>Style</h3>
														<hr>
															 <input type='text' name='MX_user_style' value='<?php echo get_post_meta("user_" . $current_user->ID, 'MX_user_style', 1); ?>'>
														</div>	
								-->
													
																		
																	

		<div class='clear'></div>
		

<?php 
		//$index = 0;
		
		
		
		
		foreach( $social as $site ){ // print_r($site->post_name);				
			?>		
	
			<?php 
			//echo get_user_meta( $lead->post_name  , "user_" . $current_user->ID );
			
			if(/* get_user_meta( $site->post_name  , "user_" . $current_user->ID ) || get_user_meta( "MX_user_" . $site->post_name , "user_" . $current_user->ID ) */ 1){ 

				//$social_count[$index]++;	
				$param_name = "MX_user_" . $site->post_name;
				$param_val = get_user_meta( $site->post_name , "user_" . $current_user->ID );
				//update_post_meta( "user_" . $current_user->ID, $param_name, $param_val  );
				
			?>
				<br>
				<a target='_blank' href='<?php echo get_user_meta( 'website_link' , $site->ID ); ?><?php echo get_user_meta( "MX_user_" . $site->post_name , "user_" . $current_user->ID ); ?>'><img width='20' src='
<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $site->post_name; ?>.png'  class=''><?php echo get_user_meta( "MX_user_" . $site->post_name , "user_" . $current_user->ID ); ?>
</a>
			<input type='text' name='MX_user_<?php echo $site->post_name; ?>' value='<?php echo get_user_meta( $param_name , "user_" . $current_user->ID ); ?>'>


			<?php 		}
			//$index++;
			?>	
			<?php 		
		}
		
	?>			
		
			
			
			<div class='col-xs-12' >
			
					<b>Notes: </b> 
					
					<textarea name="notes" placeholder='Notes ..'><?php echo $lead->post_content; ?></textarea>

					
					</div>
					
					<div class='clear'></div><br>
			
			<input name="ID" type="hidden" value="<?php echo "user_" . $current_user->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />

			<div class='col-sm-12' >
					<b>Tasklist ID: </b> 
					
					<input type="text" name="ssi_tasklist_ID" placeholder="Enter ID" value="<?php echo get_user_meta($current_user->ID , 'ssi_tasklist_ID' , true ); ?>">
				</div>
				
				
				
		<input type='submit' value='Update Profile' class='btn btn-lg btn-success btn-block' style='padding: 1em; font-size: 2em;'>
	</form>

	
	
																		</div>
																		<div class='col-md-4 hidden'>
																			&nbsp;
																		</div>
																		<?php// get_sidebar('left'); ?>

																	</div>
<br><br>
<div class='clear'></div>


		<div class="paginator hidden"><center>															
		  <a class='pull-left' href='/people'>&lsaquo; ALL Members</a>
				<a class='pull-right' href='/user-profile/?ID=<?php echo ($userid+1);?>'>Next >></a>
		</center>
            </div>
			<div class='clear'></div>
			<br><br>
<?php 


}else{
?>
	
	<h1 class='text-center'> You May only EDIT your Profile! </h1>
	
	<br>
	<center>
	<?php echo do_shortcode('[wpmem_form login]'); ?>
	</center>
	<center><a href='/people' class='btn btn-lg btn-danger'> << Back </a>
<?php
}

get_footer(); ?>