
    <div id='simple-people' class="">
				<br class='hidden-xs'>

					<?php
	
						$args = array(
						
							//'meta_key' => 'wp-last-login',
							//'orderby'  => 'meta_value_num',
							'order' => 'DESC',
						
						);
						
						$blogusers =  new WP_User_Query( $args );
						
						$total_users = count($blogusers);
						$count = 0;
						
						$pic_users = array();
						
						$temp_users = array();
				
						if( $photo ){
							
							$args = array( 
											'item_id' =>  $user->ID, 
											
										); 
									  
									// NOTICE! Understand what this does before running. 
									$result = bp_core_fetch_avatar($args);
									
									
							foreach ($blogusers as $user) {
								if( bp_core_fetch_avatar($args) ){
										$result = bp_core_fetch_avatar($args);
										
										echo "RESULTS=" . $result;
										array_push( $pic_users , $user );
								}
							}
							$blogusers = $pic_users;
							
						}
						
						
						$paged = get_query_var('paged');
						
						if( !isset($username) || $username == "" ){ 
								$number = 12;
								
								$pages_before = ($total_users / $number);
								$pages = floor($total_users / $number);
								
								if( $pages_before > $pages ){ $pages++; }
								
								$blogusers = array_slice($blogusers, ($paged * $number) , $number);
								
								$total_users_slice = count($blogusers);
								
						}

						
					?>
					
					
					<h2 class='text-center'>Members Online</h2><hr>
	<div id='members-search' class='home-beta mini users text-center' style='display:none;'>

				<div class='members-search'>
				
				
 <!--   START HOMEPAGE -->

	
			<h4> Member Search </h4>
				<form name='state-filter'  >
							 
							<b class='hidden'>Filter By State:</b>
							
							<select name='state' class='hidden' >
								<option value="<?php echo $_GET['state']; ?>"> Choose a State </option>
								<option value="Alabama">Alabama</option><option value="Alaska">Alaska</option><option value="Arizona">Arizona</option><option value="Arkansas">Arkansas</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="DC">DC</option><option value="Delaware">Delaware</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Hawaii">Hawaii</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Iowa">Iowa</option><option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option><option value="Louisiana">Louisiana</option><option value="Maine">Maine</option><option value="Maryland">Maryland</option><option value="Massachusetts">Massachusetts</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Mississippi">Mississippi</option><option value="Missouri">Missouri</option><option value="Montana">Montana</option><option value="Nebraska">Nebraska</option><option value="Nevada">Nevada</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="New York">New York</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option><option value="Rhode Island">Rhode Island</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas">Texas</option><option value="Utah">Utah</option><option value="Vermont">Vermont</option><option value="Virginia">Virginia</option><option value="Washington">Washington</option><option value="West Virginia">West Virginia</option><option value="Wisconsin">Wisconsin</option><option value="Wyoming">Wyoming</option>
							<select>
							
							<b>Only Members w/</b> <input type='checkbox' name='photo' value='1'>Pics <input type='checkbox' name='no_social' value='1'>Social
							<br><br>
							<input type='text' name='user' placeholder='Enter Username' >
							
							<input type='submit' value='Filter'>
							
							

							
					</form>
					<br>
					<a href='/members'>View All Members</a>


<div class='clearfix'></div><hr>

	</div>
<!--   END HOMEPAGE -->	

				
				
				
				
				
					<?php //include('members-search.php'); ?>		
				</div>	
			

					<?php
	
					$username = $_GET['user'];
					if( !isset($username) || $username == "" ) {	
						$photo = $_GET['photo'];
						$state = $_GET['state'];
						$flip = $_GET['flip'];
						
						$no_social = $_GET['no_social'];
						
					}

						
						$args = array(
						
							//'number' => -1,
							'meta_key' => 'wp-last-login',
							'orderby'  => 'meta_value_num',
							//'orderby'  => 'registered',
							'order' => 'DESC',
							//'date_query' => array( array( 'after' => '12/25/16' ) )  ,
							
						) ;
						
						$ordered_users =  new WP_User_Query( $args );

						
						$blogusers = $ordered_users->get_results();
						
						$total_results = count($blogusers);

						//print_r( $blogusers );
						$count = 0;
						
						$pic_users = array();
						
						$temp_users = array();
			
						if( $photo ){
	
							foreach ($blogusers as $user) {
								
								
								
								
								
								
								
								
								$args = array( 'item_id' => $user->ID, 'no_grav' => true,'html'=> false );
								
								

								if ( bp_core_fetch_avatar( $args ) != bp_core_avatar_default( $args ) ){
									
									//echo "<br><br>" . bp_core_avatar_default( $args ) ;
									//	$result = bp_core_fetch_avatar(array( 'item_id' => $user->ID , 'no_grav' => true,'html'=> false ));
										
									//	echo "<br>RESULTS=" . $result;
										array_push( $pic_users , $user );
								}
								
							}
							$blogusers = $pic_users;
							
						}
			
					
						?>
					
						
						<div class='results container ' >
								
							<button id='members-search' class='btn btn-default'>Member Search</button>
						<?php
									if($username) echo " containing  <em>" . $username . "</em>&nbsp;&nbsp;&nbsp;";
									if($state) echo " in <u>" . $state . "</u>&nbsp;&nbsp;&nbsp;";
									if($photo) echo " &#x2714; Pix";
									if($no_social) echo " &#x2714; Social";
									echo "<span style='float: right;'>" . $total_results ." Results</span>";
						
						
						?>
						</div>
							<div class='clearfix'></div><hr>
						<?php
						
						
						foreach ($blogusers as $user) {

							$oldData = array( 'user_city' ,'user_state' ,'user_zip_code' ,'user_age' ,'height_ft' ,'height_in' ,'weight' ,'body_type' ,'ethnicity' ,'sex' ,'sexual_orientation' ,'position' ,'endowment' ,'circumcised' ,'out' ,'body_hair' ,'hair_color' ,'eye_color'  );
								
								$userData = array( 'MX_user_city' ,'MX_user_state' ,'MX_user_zip_code' ,'MX_user_age' ,'MX_height_ft' ,'MX_height_in' ,'MX_weight' ,'MX_body_type' ,'MX_ethnicity' ,'MX_sex' ,'MX_sexual_orientation' ,'MX_position' ,'MX_endowment' ,'MX_circumcised' ,'MX_out' ,'MX_body_hair' ,'MX_hair_color' ,'MX_eye_color'  );
								
								$index = 0;
								foreach ($oldData  as $param_name ) {
									
									//add_user_meta( $user->ID, $userData[$index], "-" );
									if(get_field($param_name, "user_" . $user->ID)){
										$param_val =	get_field($param_name, "user_" . $user->ID);
										update_user_meta( $user->ID, $userData[$index], $param_val );
										//update_field($param_name, $param_val , "user_" . $current_user->ID );
										//echo "'MX_$param_name' ,";
									}
									$index++;
								}
							
							//update_user_meta( $user->ID, 'wp-last-login', time() );

									if( (!isset($username) || $username == "") ||  preg_match("/" . $username . "/i", $user->display_name) ){

									$social = 0;
							
							if( get_field('facebook_profile_link', "user_" . $user->ID) ) $social++;
							if( get_field('twitter_link', "user_" . $user->ID) ) $social++;
							if( get_field('instagram_link', "user_" . $user->ID) ) $social++;
							if( get_field('kik_name', "user_" . $user->ID) ) $social++;
							if( get_field('vine_username', "user_" . $user->ID) ) $social++;
							if( get_field('snapchat_username', "user_" . $user->ID) ) $social++;
							if( get_field('skype_username', "user_" . $user->ID) ) $social++;
							if( get_field('oovoo_username', "user_" . $user->ID) ) $social++;
							if( get_field('adam4adam_username', "user_" . $user->ID) ) $social++;
							if( get_field('bgc_username', "user_" . $user->ID) ) $social++;
							if( get_field('grindr_username', "user_" . $user->ID) ) $social++;
							if( get_field('jackd_username', "user_" . $user->ID) ) $social++;
							if( get_field('facetime_username', "user_" . $user->ID) ) $social++;
								
						?>		
						
						
	<div class="col-xs-6 col-md-3 person text-center well ">
						
						<a href="/user-profile/?ID=<?php echo $user->ID; ?>">
						<div id="user-mini">
							<div class="link upper bold white">
								<?php echo substr($user->display_name, 0, 15); ?>
								
								<span class='hidden' style='float:right; background: #ffffff; padding: 0 2px; color: #ff0000; '>S: <?php echo $social; ?></span>
							</div>
				<?php	

				
								//echo '<a href="/user-profile/?ID=' . $user->ID . '"><div id="user-mini">' ;
									//	echo '<div class="link upper bold white">'  . substr($user->display_name, 0, 15) . " <span style='float:right; background: #ffffff; padding: 0 2px; color: #ff0000; '>S: " . $social . "</span></div>";
	?>
<center>
<?php	

		if( get_user_meta($user->ID, 'MX_user_age' , 1) ){
					echo get_user_meta($user->ID, 'MX_user_age' , 1) . ' | ';
		}else{
					echo 'Old | ';
		}
		if( get_user_meta($user->ID, 'MX_height_ft' , 1) ){
					echo get_user_meta($user->ID, 'MX_height_ft' , 1) . "' " . get_user_meta($user->ID, 'MX_height_in' , 1) . '" | ' ;
		}else{
					echo 'Short | ' ;
		}
		if( get_user_meta($user->ID, 'MX_weight' , 1) ){
					echo get_user_meta($user->ID, 'MX_weight' , 1) . "<br><br>";
		}else{
					echo 'Fat <br><br>';
		}
			?>
</center>
<?php									

										echo '<div class="mini-left">';
										//userphoto($user->ID, '<div class="photo porn">', '</div>', array(style => '') ) ;
								?> 
								<div class=" porn">
									<center>
								<?php		
										echo get_avatar($user->ID, 150);
								?> 
									</center>
								</div>
								<?php		
										//mt_profile_img();
										
											if ( !function_exists( 'bp_core_fetch_avatar' ) ) { 
											require_once '/bp-core/bp-core-avatars.php'; 
										} 
										  
										// An array of arguments. All arguments are technically optional; some will, if not provided, be auto-detected by bp_core_fetch_avatar(). This auto-detection is described more below, when discussing specific arguments. 
										$args = array( 
											'item_id' =>  $user->ID, 
											'object' => '', 
											'type' => '' 
										); 
									  
									// NOTICE! Understand what this does before running. 
									$result = bp_core_fetch_avatar($args);

											//print_r($result);
										echo "</div>";
										
										$closet = 0;
				
								
	
					echo "<div class='clear full-login upper bold text-left'>";
								$last_login = (int) get_user_meta( $user->ID, 'wp-last-login' , true );
											if ( $last_login ) {
												$format = apply_filters( 'wpll_date_format', get_option( 'date_format' ) );
												$value  = date_i18n( $format, $last_login );
												echo "<br>Last Here <span style='float: right;'>" . $value . "</span>";
											}else{
												echo "<br>Joined <span style='float: right;'>" . mysql2date($format, $user->user_registered ) . "</span>";
											}
					echo "</div>";
					echo "<div class='clear full upper bold white'>";
										
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
									echo 'In The Closet ';
								}				
	
					echo "<br></div>";
						
									echo '</div></a></div>';
									$count++;
									if( ($count % 2) == 0 ){ 
						?>					
				
								<div class='visible-xs'></div>

						<?php		}else if( ($count % 4) == 0 ){ 
						?>					
				
								<div class='clearfix'></div>

						<?php		}else{
							
							?> 
							
							<?php
									}
								}// END STATE IF

						} //End For-each 

					?>

				<div class=' clear'></div>
					<div class="paginator clear  h3">
                    
                        <?php 
						
						//echo "PAGES->" . $pages;
						if (function_exists("pagination")) {
								
                               if(  !isset($username) || $username == ""  ) pagination($pages);
                            
                            } ?>

                    </div>

        

        <div class="clear"></div>
        
    </div>

