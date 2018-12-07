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

get_header('no-ads');

$show_alerts = get_field( 'show_alerts' , $post->ID );

$email_alerts = 0;
$user_add = 0;

$type_alerts = 0;

$cnt_friends = $cnt_family = $cnt_followers = $cnt_tenants = $cnt_leads = $cnt_clients = $cnt_tenants = 0;





if( $_POST['edit_user'] ){  
		
		foreach ($_POST as $param_name => $param_val) {
	
			post_meta( $_POST['ID'], $param_name, $param_val  );

		}

		//$vars =  get_queried_object();
		// print_r($vars);
		
		echo "<h1 class='text-center'> PROFILE UPDATED!! </h1>";
		//wp_user( array( 'ID' => $current_user->ID  ) );
		
		//wp_redirect( '/user-profile/?ID=' . $userid );
	}


?> 

	
<?php 
	$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {		
		

	?><div class=''>
	
	<div class='clearfix'></div>
		

<div id='newpost' class='clear' style='display: none;'>

<?php /*$lead = get_post(11975);*/ ?>
<div class='well contsct taskcard'>

	
		<div class='clearfix'></div>
	<form method="post" action="">		
		<div class='clearfix'></div>
		
		
			
				<div class='col-xs-4' >
					<b>Name: </b> 
					
					<input type="text" name="post_title" placeholder="Name" >
				</div>
				<div class='col-xs-3' >
					<b>Phone: </b> 
					
					<input type="text" name="MX_user_phone" placeholder="Phone"  value="<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>">
				</div>
				<div class='col-xs-3' >
					<b>Email: </b> 
					
					
					<input type="text" name="MX_user_email" placeholder="Email" value="<?php echo get_field( 'MX_user_email', $lead->ID ); ?>">

				</div>
				<div class='col-xs-2'>
					<b>Type: </b> 
					<br>
					<?php 
				
					$att = get_post_meta($lead->ID, 'contact_type', 1);
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
				
					<div class='clearfix'></div><hr>
					
				<div class='col-xs-12'> 
						<b>Location: </b> <br>
						
						<div class='col-xs-2'> 
								
						
						 <input type="text" name="MX_user_area_code" placeholder="Area Code" value="<?php 
						 
						
						 
						 echo get_field( 'MX_user_area_code', $lead->ID ); ?>">
					</div>
					<div class='col-xs-3 hidden1'>
						
						 <input type="text" name="MX_user_address" placeholder="Address" value="<?php echo get_field( 'MX_user_address', $lead->ID ); ?>">

					</div>
					
					
					<div class='col-xs-2'>
	
						<input type="text" name="MX_user_city" placeholder="City" Value="<?php echo get_field( 'MX_user_city', $lead->ID ); ?>">

					</div>
					<div class='col-xs-1'>

						<input type="text" name="MX_user_state" placeholder="State" value="<?php echo get_field( 'MX_user_state', $lead->ID ); ?>">

					</div>
					<div class='col-xs-2'>
						 <input type="text" name="MX_user_zip" placeholder="Zip Code" value="<?php echo get_field( 'MX_user_zip', $lead->ID ); ?>">
					</div>
					<div class='col-xs-2'>
						 <input type="text" name="MX_user_apt_num" placeholder="Apt #" value="<?php echo get_field( 'MX_user_apt_num', $lead->ID ); ?>">
					</div>
					
				</div>	
					
					<div class='clearfix'></div><hr>
					

		<div class='col-xs-2'>
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
			<input name="new_contact" type="hidden" value="true" />


		</div>
					
<div class='clearfix'></div>
	
	<div id='details' class='details' style='display: block;'>	
				
					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>


				<div class='col-xs-4' >
					<b>Last Seen: </b> 
					
					<input type="text" name="last_seen" placeholder="<?php echo date('n/j/y', strtotime( get_field( 'last_seen', $lead->ID ) ) ); ?>" value="<?php echo current_time( 'm/d/y' ); ?>" >
				</div>
				<div class='col-xs-4' >
					<b>Last Contacted: </b> 
					
					<input type="text" name="last_contacted" placeholder="Last Contacted" placeholder="<?php echo date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ); ?>" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				<div class='col-xs-4' >
					<b>Added: </b> 

					<input type="text" name="date_added" placeholder="Date Added" placeholder="<?php echo mysql2date('n/j/y', $lead->post_date ); ?>" value="<?php echo current_time( 'm/d/y' ); ?>" >
				</div>
				
				<div class='clearfix'></div>
				<hr>
				
				<div class='info'>
				<u>Details</u><br>
				
				

				<b>D.O.B: </b> <input width="100" type="text" name="MX_user_dob" placeholder="D.O.B" placeholder="<?php echo get_field( 'MX_user_dob', $lead->ID ); ?>">
				
				</div>
				
				<div class='col-xs-12' >
					<b>Tasklist ID: </b> 
					
					<input type="text" name="ssi_tasklist_ID" placeholder="Enter ID" value="<?php echo get_field( 'ssi_tasklist_ID', $lead->ID ); ?>">
				</div>

			<div class='clearfix'></div>
<div class='clearfix'></div><br><br>
				
				<input type='hidden' name='ID' value='<?php echo $lead->ID; ?>'>
				<input type='hidden' name='edit_profile' value='1'>
				
				
			<h3>Basic Stats</h3><hr>	
				<div class=' col-xs-6'>
				Age:
			</div>
			<div class=' col-xs-6'>
				 <input type='text' name='MX_user_age' value='<?php echo get_post_meta(  $lead->ID, 'MX_user_age', 1); ?>'>
			</div>
			<div class=' col-xs-6'>
				Height:
			</div>
			<div class=' col-xs-6'>
			<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_height_ft', 1);
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
				
					$att = get_post_meta($lead->ID, 'MX_user_height_in', 1);
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
				<input type='text' name='MX_user_weight' value='<?php echo get_post_meta($lead->ID, 'MX_user_weight', 1); ?>'>
			</div>	
				
				
				
				
			<div class='clearfix'></div><br><br>	
			
					<h3>Full Details</h3><div class='clearfix'></div><hr>
					
	<div class="prof-info col-xs-6">
			
			<div class="col-xs-6">
				<b>Orientation</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_sexual_orientation', 1);
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

		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Ethnicity</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_ethnicity', 1);
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
		
		
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Sex</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_sex', 1);
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
				
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Hair Color</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_hair_color', 1);
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
		
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Out?</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_out', 1);
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
				
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Body Hair</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_body_hair', 1);
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
		
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Body Type</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_body_type', 1);
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
		
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Eye Color</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_eye_color', 1);
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
									
						
				<div class='clearfix'></div>		
				<br>		
						
							<div class="prof-info col-xs-6">
											<h3>Adult Stats</h3>
											<hr>
											
			<div class=' col-xs-6'>
				Position:
			</div>
			<div class=' col-xs-6'>
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_position', 1);
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
				
					$att = get_post_meta($lead->ID, 'MX_user_endowment', 1);
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
				
					$att = get_post_meta($lead->ID, 'MX_user_circumcised', 1);
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
						
			<div class='clearfix'></div>			
														

																	</div>


			<div class='clearfix'></div>

<div class='well '>


	<?php
		$social = get_posts( array( 'post_type' => 'ssi_social' , 'posts_per_page' => -1, 'order' => 'asc' ) );
		
		foreach($social as $lead){
			
			?>
			
			<b><?php echo $lead->post_title; ?>: </b> <input type="text" name="MX_user_<?php echo $lead->post_name; ?>" placeholder="<?php echo $lead->post_title; ?> Username" >
			<br>
			<?php
			
		}
	?>
	
	<!--
	<b>Adam4Adam: </b> <input type="text" name="MX_user_adam4adam" placeholder="Username" >
	<br>
	<b>Kik Username: </b> <input type="text" name="MX_user_kik" placeholder="Username" >
	<br>
	<div id='addsocial<?php echo $lead->ID; ?>' style='display: block;'>
		<div class='clearfix'></div><hr>
		ADD SOCIAL FORM
		
		
			<select name="site">
					<option value="">Social</option>
		
		
		<?php
				$social = get_posts( array( 'post_type' => 'ssi_social' , 'posts_per_page' => -1, 'order' => 'asc' ) );
				
				foreach($social as $lead){
					
					?>
					<option val="<?php echo $lead->post_name; ?>"><?php echo $lead->post_title; ?></option>
					<?php
					
				}
			?>
					
				<option value="other">Other</option>
			</select>
		
			<input type="text" name="username">
		-->		
		
		
		<div class='clearfix'></div><hr>
		<b>Notes:</b>
		<textarea name="notes" id="" cols="30" rows="3"></textarea>
		
		
		<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
	
	</div>
	<div class='clearfix'></div>
</div>


<br>
	<button name="ssi_new_contact" type="submit" class='btn btn-info btn-lg pull-right' value="Update" />Add Contact</button>
	
	</form>						

<div class='clearfix'></div>

</div><!-- END Well Contact-->
<div class='clearfix'></div>

</div>

		<div class='clearfix'></div>
	
				
		<?php
		
			/*********************************************************/
			
			$index = 0; 
			$s_count = 0;
			$social_count = array(); 
			
				
			$tot_count = 0;

			$total_amount = 0;

	// The Query
				$num_posts = 30;
				if( $_GET['all'] ){ $num_posts = -1; }
				$order = 'desc';
				
				$orderby = 'modified';
				
				if( $_GET['order'] ){ $order = $_GET['order']; }
				
				$args = array( 'post_type' => 'ssi_contact'  , 'posts_per_page' => $num_posts, 'orderby'=> 'modified', 'order' => $order  );
				
				$args4 = array( 'post_type' => 'tenants'  , 'posts_per_page' => $num_posts, 'orderby'=> 'modified', 'order' => $order  );
				
				$args3 = array( 'post_type' => 'ssi_family'  , 'posts_per_page' => $num_posts, 'orderby'=> 'modified', 'order' => $order  );
				
				$args2 = array( 'post_type' => 'ssi_clients'  , 'posts_per_page' => $num_posts,  /*'orderby'=> 'modified' */'orderby'=> 'meta_value_num', 'meta_key' => 'client_profit' ,'order' => $order  );
				
				$contacts = get_posts( $args );
				$clients = get_posts( $args2 );
				$family = get_posts( $args3 );
				$tenants = get_posts( $args4 );
				$leads = array_merge($clients , $contacts, $tenants ,$family)
				//$leads = get_posts( $args );
			
			
		
?>

<!--  #####################   START Filter  ##############-->

			
<form id="filter">
		<div class='col-xs-12'>
					<input type="hidden" name="all" value="true">
		  			<input type="text" placeholder="Search... " name="searchterm">	
					
				
		</div>
		
	<div id='filter' class='filter' style='display: none;'>
		<div class='col-xs-2'>
			<select name="meeting_place">
				<option value="">Social</option>
		
		
		<?php
				$social = get_posts( array( 'post_type' => 'ssi_social' , 'posts_per_page' => -1, 'order' => 'asc' ) );
				
				foreach($social as $lead){
					
					?>
					<option val="<?php echo $lead->post_name; ?>"><?php echo $lead->post_title; ?></option>
					<?php
					
				}
			?>
					
				<option value="other">Other</option>
			</select>
		</div>
		<div class='col-xs-2'>
			<select name="start_date">
			<option value="">Days Ago</option>
			<option value="1">1 day ago</option>
			<option value="3">3 days ago</option>
			<option value="5">5 days ago</option>
			<option value="7">7 days ago</option>
			<option value="30">30 days ago</option>				
			<option value="9999">ALL TIME</option>
			</select>
		</div>
		<div class='col-xs-4'>
			<select name="MX_user_area_code">
			<option value="">Filter Location</option>
			
			<?php
				$locations = get_posts( array( 'post_type' => 'ssi_locations' , 'posts_per_page' => -1 ) );
				
				foreach($locations as $lead){
					
					?>
					<option value="<?php echo get_field( 'trip_area_code', $lead->ID); ?>"><?php echo get_field( 'trip_area_code', $lead->ID); ?> - <?php echo get_field( 'trip_city', $lead->ID); ?>, <?php echo get_field( 'trip_state', $lead->ID); ?></option>
					<?php
					
				}
			?>
			
			</select>
		</div>
		
		<div class='col-xs-2'>
					
					<?php 
				
					$att = $categories[0]->name;
					$options = array( 'Client', 'Lead',  'Friend',  'Follower', 'Family', 'Landscape', 'Other' );

				?>
				<select name="contact_type" >
					<option value="" <?php if ($att == $option) echo "selected='selected'";?>>Filter Type</option>
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
			<input name='filter' value='true' type="hidden">
			<input type="submit" class="btn-block">
</form>

		
			
			<?php 
			
			//###########  START FILTER Search Guts   ###########


		$filter = 1;
		
		
		
		
		if( !empty($_GET['searchterm']) ){
				
				
				//echo "searchterm SET!";
			$filtered = array();
		/*	foreach( $leads as $lead ){
				
				
				if (preg_match("/" . $_GET['searchterm'] . "/i", $lead->post_title)) {
					//echo "A match was found.";
					array_push( $filtered, $lead );
				}
			}
			
			*/
			
			//$found = array();
	
			foreach( $leads as $lead ){
				//echo "<br>TERM: " . $_GET['searchterm'] . " = " . $lead->post_title;
				$var = $_GET['searchterm'];
				
				$searchword = get_field( 'MX_user_phone', $lead->ID );
				//echo "<br>TERM: " . $var . " = " . $searchword;
				if( strpos( $searchword , $var ) ){ 
					array_push( $filtered, $lead );
					//echo "BINGO!!";
				}else if( strpos( strtolower($lead->post_title) , strtolower($_GET['searchterm']) ) === false ){ 
				
					//echo "Not FOUND -->" . $_GET['searchterm'];
				}else if( strpos( get_field( 'MX_user_phone', $lead->ID ) , strtolower($_GET['searchterm']) ) ){ 
					array_push( $filtered, $lead );
					//echo "Not FOUND -->" . $_GET['searchterm'];
				}else{
					//echo "FOUND -->" . $_GET['searchterm'];
					array_push( $filtered, $lead );
				
				}
			}
			
			
		
			
			
			
			$leads = $filtered;

			$filter = 0;
		}
		
		if( !empty($_GET['MX_user_area_code']) ){
				
				
				//echo "term SET!";
			$filtered = array();
			foreach( $leads as $lead ){
				if (preg_match("/" . $_GET['MX_user_area_code'] . "/i", get_field( 'MX_user_area_code', $lead->ID) )) {
					//echo "A match was found.";
					//echo get_field( 'MX_user_area_code', $lead->ID);
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;
		}
		
		if( !empty($_GET['meeting_place']) ){
				
				
				//echo "meeting_place SET!";
				
				
				
			$filtered = array();
			foreach( $leads as $lead ){
				if( get_field( $_GET['meeting_place'], $lead->ID )  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;
		}
		
		
		
		if( !empty($_GET['contact_type']) ){
				
				
				//echo "meeting_place SET!";
				
			$filtered = array();
			foreach( $leads as $lead ){
				
				$categories = get_the_category($lead->ID);
				
				
				if( $categories[0]->name == $_GET['contact_type']  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;
		}
//###########   END FILTER Search Guts   ###########

			//print_r( count($leads) );

			//$leads = array();
			
			?>

<!--  #####################   END Filter  ##############-->

<div class='title-block'>
			<div class='col-xs-6'>
			
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					
					
						
			</div>
		
			
				
			<div class='col-xs-6 hidden-print'>
			
		
			
				<button id='newpost' class='btn  btn-default pull-right'>Add New >></button>
				<button id='filter' class='btn  btn-default pull-right'>Filter</button>
				<a href='#summary' class='btn  btn-default pull-right'>Summary</a>
			</div><div class='clearfix'></div>
			
			<div class='pull-right'>
				<u><?php echo count($leads); ?></u> Contacts
				
			</div>
			<hr>
		</div>

	
	<div class='col-xs-6 hidden'>
		<a href='?all=1' target='_blank' class='pull-right'> Show All >> </a>
	</div>
	
	<div class='clearfix'></div>

	<div class='col-xs-12 hidden-xs text-center'>
		<div class='col-xs-2 '> Name </div>
		<div class='col-xs-3  hidden'> Email </div>
		<div class='col-xs-2 '> Phone# </div>
		<div class='col-xs-2 '>Location </div>

		<div class='col-xs-2 hidden-print'> Social </div><br>
		<div class='clearfix'></div>
	</div>
	
	

<?php 
			
			
			
			
			//get_template_part( 'content', 'filter' );
			
			
			
			
			$names = array();
			$nums = array();
			$emails = array();
			
			foreach( $leads as $lead ){
				
				//if( get_field( 'MX_user_city', $lead->ID ) != "Washington" )   continue; 
			
					$tot_count++;

					$public = 1;

						/*
				
				$oldData = array( 'MX_user_email' ,'MX_user_phone' ,'MX_user_state' ,'MX_user_address' ,'MX_user_city' ,'MX_user_dob'   );
								
								$userData = array( 'MX_user_email' ,'MX_user_phone' ,'MX_user_state' ,'MX_user_address' ,'MX_user_city' ,'MX_user_dob'   );
								
								$index = 0;
								foreach ($oldData  as $param_name ) {
									
									add_post_meta( $user->ID, $userData[$index], "-" );
									if(get_field($param_name, $lead->ID)){
										$param_val =	get_field($param_name,  $lead->ID);
										update_post_meta( $lead->ID, $userData[$index], $param_val );
										//update_field($param_name, $param_val , "user_" . $current_user->ID );
										//echo "'MX_$param_name' ,";
									}
									$index++;
								}
						
			
								$index = 0;
				
				*/

					//echo "<div class='row'><div class='col-xs-6'>";
					//echo "<div class='col-xs-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){

					?>
					
<div class='contact-print report'>


<?php 

	array_push( $names, $lead->post_title );
	array_push( $nums, get_field( 'MX_user_phone', $lead->ID ));


 ?>

	
<div class='clearfix'></div>

<div class='col-xs-3'> 

						<?php echo ++$count . " - "; ?>
						
						<?php echo $lead->post_title; ?>
						
						
							
							
					</div>
					<div class='col-xs-3 hidden'>
						
						<?php echo get_field( 'MX_user_email', $lead->ID ); ?>
						
						<div class='clearfix'></div>
					</div>
					<div class='col-xs-4 col-xs-3'>
						
						<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>
						
						<div class='clearfix'></div>
					</div>
					<div class=' col-xs-4'>
						<div class='clearfix'></div>
						<?php /* echo get_field( 'MX_user_area_code', $lead->ID ); */?> 
						<?php 
							if(get_field( 'MX_user_address', $lead->ID )){
								
								echo get_field( 'MX_user_address', $lead->ID ) . ", ";
							}
							if(get_field( 'address', $lead->ID )){
								
								//update_field( 'MX_user_address', get_field( 'address', $lead->ID ), $lead->ID );
							}
							
							
 ?><?php echo get_field( 'MX_user_city', $lead->ID ); ?>
						 <?php echo get_field( 'MX_user_state', $lead->ID ); ?>

						 <div class='clearfix'></div>
					</div>
					
					
					
					
					
					<div class='col-xs-12 col-xs-2  hidden-print'>
						<div class='clearfix'></div>
<?php 
		$index = 0;
		
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
<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $site->post_name; ?>.png'  class=''>
</a>


			<?php 		}
			$index++;
			?>	
			<?php 		
		}
		
	?>				<div class='clearfix'></div>
						
					</div>
					
					<div class='col-xs-2 '>	
				
					
					<?php  
					
					
					
							if(get_field( 'MX_user_rate', $lead->ID )){
								
								echo "Rate: $" . get_field( 'MX_user_rate', $lead->ID );
							}
							
							if(get_field( 'client_profit', $lead->ID )){
								
								echo " -- ^ $" . get_field( 'client_profit', $lead->ID ) . "<br>";
							}
							
					?>
				
					<div class='clearfix'></div>
				</div>
				<div class='col-xs-6 col-xs-2 hidden-print'>	
				
					<div class='clearfix'></div>
					<button id='details<?php echo $lead->ID; ?>' class='btn  btn-block btn-default hidden1  '>Details</button>
				
					<div class='clearfix'></div>
				</div>
					
				<div class='col-xs-6 col-xs-2 hidden'>	
					<a href='/admin/report/?ID=<?php echo $lead->ID; ?>' target='_blank' class='btn  btn-block btn-default hidden1 '>Report ></a>
					<div class='clearfix'></div>
				</div>
				
				<div class='pull-right hidden-print'>
<?php  

$categories = get_the_category($lead->ID);

//print_r( $categories );
 
if ( ! empty( $categories ) ) {
    echo esc_html( $categories[0]->name );
	
	if( $categories[0]->name == 'Friend' ){
		$cnt_friends++;
		
	}else if( $categories[0]->name == 'Follower' ){
		$cnt_followers++;
		
	}else if( $categories[0]->name == 'Lead' ){
		$cnt_leads++;
		
	}else if( $categories[0]->name == 'Family' ){
		$cnt_family++;
		
	}else if( $categories[0]->name == 'Client' ){
		$cnt_clients++;
		
	}else if( $categories[0]->name == 'Tenant' ){
		
		$cnt_tenants++;
		
	}if( $categories[0]->name == 'Contact' ){
		$type_alerts++;
		
	}

		//wp_set_post_categories( $lead->ID , $categories[0]->term_id  );
}else if( $show_alerts ){ 
				//$type_alerts++;
				//wp_set_post_categories( $lead->ID , array(98) );
			?> 
				<div class="alert alert-warning">
				  <strong>Warning!</strong> - No Type
				</div>
				
			
	<?php } ?>
</div>
					
<div class='clearfix'></div><hr>

<div id='details<?php echo $lead->ID; ?>' class='details' style='display: none;'>

					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>

				<?php
					
					/*if( $lead["2.3"] ){
					echo "<b>Location: </b> " . $lead["2.3"] . ", " . $lead["2.4"] . " " . $lead["2.5"] . "<br><br>";
					}else	{
					echo "<b>Location:</b> Philadelphia, PA<br>";
					}*/

				?>
				
				
		<form id="update" method='post'>	

					
				<div class='col-xs-3' >
					<b>Name: </b> 
					
					<input type="text" name="post_title" placeholder="<?php echo $lead->post_title; ?>" value="<?php echo $lead->post_title; ?>">
				</div>
				<div class='col-xs-2' >
					<b>Phone: </b> 
					
					<input type="text" name="MX_user_phone" placeholder="Phone"  value="<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>">
				</div>
				<div class='col-xs-3' >
					<b>Email: </b> 
					
					
					<input type="text" name="MX_user_email" placeholder="Email" value="<?php echo get_field( 'MX_user_email', $lead->ID ); ?>">

				</div>
				<div class='col-xs-2' >
					<b>Rate: </b> 
					
					<input type="text" name="MX_user_rate" placeholder="Rate"  value="<?php echo get_field( 'MX_user_rate', $lead->ID ); ?>">
				</div>
				<div class='col-xs-2'>
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
				
					<div class='clearfix'></div><hr>
					
				<div class='col-xs-12'> 
						<b>Location: </b> <br>
						
						<div class='col-xs-2'> 
								
						
						 <input type="text" name="MX_user_area_code" placeholder="Area Code" value="<?php  echo get_field( 'MX_user_area_code', $lead->ID ); ?>">
					</div>
					<div class='col-xs-3 hidden1'>
						
						 <input type="text" name="address" placeholder="Address" value="<?php echo get_field( 'address', $lead->ID ); ?>">

					</div>
					
					
					<div class='col-xs-2'>
	
						<input type="text" name="MX_user_city" placeholder="City" Value="<?php echo get_field( 'MX_user_city', $lead->ID ); ?>">

					</div>
					<div class='col-xs-1'>

						<input type="text" name="MX_user_state" placeholder="State" value="<?php echo get_field( 'MX_user_state', $lead->ID ); ?>">

					</div>
					<div class='col-xs-2'>
						 <input type="text" name="zip_code" placeholder="Zip Code" value="<?php echo get_field( 'zip_code', $lead->ID ); ?>">
					</div>
					<div class='col-xs-2'>
						 <input type="text" name="apt_num" placeholder="Apt #" value="<?php echo get_field( 'apt_num', $lead->ID ); ?>">
					</div>
				</div>	
					
					<div class='clearfix'></div><hr>
	
					
	<div class=' col-xs-12'>			
				<div class='info'>
				<u>Details</u><br>
				
				
						
				<div class='col-xs-4' >
					<b>Last Seen: </b> 
					
					<input type="text" name="last_seen" value="<?php echo date('n/j/y', strtotime( get_field( 'last_seen', $lead->ID ) ) ); ?>">
				</div>
				<div class='col-xs-4' >
					<b>Last Contacted: </b> 
					
					<input type="text" name="last_contacted" placeholder="Last Contacted" value="<?php echo date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ); ?>">
				</div>
				<div class='col-xs-4' >
					<b>Added: </b> 
					
					
					<input type="text" name="date_added" placeholder="Date Added" value="<?php echo mysql2date('n/j/y', $lead->post_date ); ?>">
				</div>
				
				
				<div class='col-xs-12' >
					<b>D.O.B: </b> 
					
					<input width="100" type="text" name="MX_user_dob" placeholder="D.O.B" value="<?php echo get_field( 'MX_user_dob', $lead->ID ); ?>">
				</div>
				<div class='col-xs-12' >
					<b>Tasklist ID: </b> 
					
					<input type="text" name="ssi_tasklist_ID" placeholder="Enter ID" value="<?php echo get_field( 'ssi_tasklist_ID', $lead->ID ); ?>">
				</div>
				
		</div>		
	</div>			
			<div class='clearfix'></div><br><br>
				
				<input type='hidden' name='ID' value='<?php echo $lead->ID; ?>'>
				<input type='hidden' name='edit_profile' value='1'>
				
	<div class=' col-xs-12'>			
			<h3>Basic Stats</h3><hr>	
				<div class=' col-xs-6'>
				Age:
			</div>
			<div class=' col-xs-6'>
				 <input type='text' name='MX_user_age' value='<?php echo get_post_meta(  $lead->ID, 'MX_user_age', 1); ?>'>
			</div>
			<div class=' col-xs-6'>
				Height:
			</div>
			<div class=' col-xs-6'>
			<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_height_ft', 1);
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
				
					$att = get_post_meta($lead->ID, 'MX_user_height_in', 1);
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
				<input type='text' name='MX_user_weight' value='<?php echo get_post_meta($lead->ID, 'MX_user_weight', 1); ?>'>
			</div>	
				
				
		</div>			
				
			<div class='clearfix'></div><br><br>	
	<div class="col-xs-12">		
					<h3>Full Details</h3><div class='clearfix'></div><hr>
					
	<div class="prof-info col-xs-6">
			
			<div class="col-xs-6">
				<b>Orientation</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_sexual_orientation', 1);
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

		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Ethnicity</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_ethnicity', 1);
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
		
		
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Sex</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_sex', 1);
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
				
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Hair Color</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_hair_color', 1);
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
		
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Out?</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_out', 1);
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
				
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Body Hair</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_body_hair', 1);
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
		
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Body Type</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_body_type', 1);
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
		
		<div class="prof-info col-xs-6">
			<div class="col-xs-6">
				<b>Eye Color</b>
			</div>
			<div class="col-xs-6">
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_eye_color', 1);
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
						
				<div class='clearfix'></div>		
				<br>		
						
						
						
						
		<div class="prof-info col-xs-6">
											<h3>Adult Stats</h3>
											<hr>
											
			<div class=' col-xs-6'>
				Position:
			</div>
			<div class=' col-xs-6'>
				<?php 
				
					$att = get_post_meta($lead->ID, 'MX_user_position', 1);
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
				
					$att = get_post_meta($lead->ID, 'MX_user_endowment', 1);
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
				
					$att = get_post_meta($lead->ID, 'MX_user_circumcised', 1);
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
											
								<!--					<div class="prof-info col-xs-6">
														<h3>Style</h3>
														<hr>
															 <input type='text' name='MX_user_style' value='<?php echo get_post_meta($lead->ID, 'MX_user_style', 1); ?>'>
														</div>	
								-->
													
																		
																	

		<div class='clearfix'></div><hr>
		

<?php 
		//$index = 0;
		
		
		
		
		foreach( $social as $site ){ // print_r($site->post_name);				
			?>		
	
			<?php 
			//echo get_field( $lead->post_name  , $lead->ID );
			
			if(/* get_field( $site->post_name  , $lead->ID ) || get_field( "MX_user_" . $site->post_name , $lead->ID ) */ 1){ 

				//$social_count[$index]++;	
				$param_name = "MX_user_" . $site->post_name;
				$param_val = get_field( $site->post_name , $lead->ID );
				//update_post_meta( $lead->ID, $param_name, $param_val  );
				
			?>
				<br>
				<a target='_blank' href='<?php echo get_field( 'website_link' , $site->ID ); ?><?php echo get_field( "MX_user_" . $site->post_name , $lead->ID ); ?>'><img width='20' src='
<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $site->post_name; ?>.png'  class=''><?php echo get_field( "MX_user_" . $site->post_name , $lead->ID ); ?>
</a>
			<input type='text' name='MX_user_<?php echo $site->post_name; ?>' value='<?php echo get_field( $param_name , $lead->ID ); ?>'>


			<?php 		}
			//$index++;
			?>	
			<?php 		
		}
		
	?>			

			
			
			<div class='col-xs-12' >
			
					<b>Notes: </b> 
					<?php echo $lead->post_content; ?>
					<textarea name="post_content" placeholder="Add Notes.."></textarea>

					
					</div><br>
			
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
	
				<button name="ssi_update_cf" type="submit" class='btn btn-info btn-block' value="Update" />Update</button>
			</form>	
				
	<div class=' col-xs-12'>			
			<h3>Service Log:</h3><hr>				
				
				<?php 
					
					
				// ####################   Service Log	#########

				$client_profit = 0;

				?>
				<div class='clear'><br><br></div>
				<div class='col-xs-6 col-xs-2'><b>Date</b></div>
				<div class='col-xs-6 col-xs-2'><b>Time</b></div>
				<div class='col-xs-2'><b>Location</b></div>
				<div class='col-xs-2'><b>Service</b></div>
				<div class='col-xs-2'><b>Trans ID</b></div>
				<div class='col-xs-2'><b>Rate</b></div>
				<div class='clearfix'></div>

				<hr>

				<?php 
			$services = 0; 
				// check if the repeater field has rows of data
				if( have_rows('service_log' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('service_log', $lead->ID ) ) : the_row();
				$services++;
				?>

			      <div class='col-xs-6 col-xs-2'>
				   <?php echo get_sub_field('date'); ?></div>
				<div class='col-xs-6 col-xs-2'><?php the_sub_field('time'); ?></div>
				<div class='visible-xs'><br><br></div>
				<div class='col-xs-2'><?php the_sub_field('location'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-xs-2'><?php the_sub_field('service'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-xs-2'><?php the_sub_field('trans_id'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-xs-2'>$<?php the_sub_field('rate'); ?></div>
				
				<?php 
					$client_profit += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT));
					$total_amount += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT)); ?>
				<div class='clearfix'></div>
				<hr>
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;

?>

		<button id='add_payment' class='btn btn-info btn-block'>Add Payment</button><br>

	<div id='add_payment' class='' style='display: none;'>
		<form method="post" action="" name="add_transaction">
				<div class=' col-xs-2'>
						
					<input  type="text" name="trans_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					<div class='clearfix'></div>
				</div>
				<div class=' col-xs-2'>
					<input type="text" name="trans_time" placeholder="Time" value="<?php echo current_time( 'g:i' ); ?> pm" >
					<div class='clearfix'></div>
				</div>
				<div class='col-xs-2'>
					<div class='clearfix'></div>
					<input type="text" name="trans_location" placeholder="Location" value="My Place">
					<div class='clearfix'></div>
				</div>
				<div class='col-xs-4'>
					<div class='clearfix'></div>
					<input type="text" name="trans_service" placeholder="Service" Value="Service">
					<div class='clearfix'></div>
				</div>
				
				<div class='col-xs-6 col-xs-1'>
					<div class='clearfix'></div>
					<input type="text" name="trans_amount" placeholder="Rate">
					<div class='clearfix'></div>
				</div>
		<div class='col-xs-6 col-xs-1'>
			<div class='clearfix'></div>
			<input type="radio" name="income_expense" value="+">+<br>
			<input type="radio" name="income_expense" value="-">-
		</div>		
				<input type="hidden" name="client_name" value="<?php echo $lead->post_title; ?>">
				<input type="hidden" name="client_city" value="<?php echo get_field( 'MX_user_city', $lead->ID ); ?>">
				<input type="hidden" name="client_phone" value="<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>">
				<input type="hidden" name="client_state" value="<?php echo get_field( 'MX_user_state', $lead->ID ); ?>">
				
				<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
				<input name="client_id" type="hidden" value="<?php echo $lead->ID; ?>" />

				<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
				<input type='hidden' name='insert_transaction' value='true'>
				<input type='hidden' name="update" value='true'>
				
				<input type="submit" class="pull-right">
				<div class='clearfix'></div>
			</form>
			
			<div class='clearfix'></div>
		</div>
		
			<div class='clearfix'></div>
	</div>
				<div class='clearfix'></div>
				<hr>
			<?php 
				// #################### END Service Log	#########

				?>
				<div class='clearfix'></div>
				<div class='col-xs-6 col-xs-3'>&nbsp;</div>
				
				<div class='col-xs-3'>&nbsp;</div>
				
				<div class='col-xs-3'>&nbsp;</div>
				
				<div class='col-xs-3'><div class='pull-right'><?php echo "Total: $" . $client_profit; ?></div></div>
				<?php 
					
				update_post_meta( $lead->ID ,'client_profit' , $client_profit );
				
				
					echo "<div class='clearfix'></div><br>";
						
			/*		echo "Forms:<br>";
			?>
			
			
		
			
		<?php if( get_field( 'file_1', $lead->ID ) ){ ?>
			<a target="_blank" href="<?php echo get_field( 'file_1', $lead->ID ); ?>">Client Intake (Front) </a><br>
		<?php } ?>
		<?php if( get_field( 'file_2', $lead->ID ) ){ ?>
			<a target="_blank" href="<?php echo get_field( 'file_2', $lead->ID ); ?>">Client Intake (Back)</a><br>
		<?php } ?>

		
			
			<div class='clearfix'></div>
					<div class='col-xs-6'>
					
						
						
						<img src='<?php echo get_field( 'file_1', $lead->ID ); ?>' class='img-responsive'>	
					</div>
					<div class='col-xs-6'>
					
						<img src='<?php echo get_field( 'file_2', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<img src='<?php echo get_field( 'file_3', $lead->ID ); ?>' class='img-responsive'>
			<?php 	
					echo "<div class='clearfix'></div><br>";
					*/
			?>
			
<div class='clearfix'></div>

		<form method="post" action="" class='pull-left'>
			<button name="update" type="submit" class='btn btn-danger' value="Remove Lead" />Delete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="post_to_draft" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
		
	

				<?php
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default pull-left'>Edit Lead</a>";
				

?> 
	<div class='clearfix'></div><hr>
</div>
	
	<div class='clearfix'></div>

</div><!-- END Well Contact-->

<div class='col-xs-2 hidden'><?php echo $services . " - - Total: $" . $client_profit; ?></div>
<?php				
				
					
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 

				}
				
				
?>
<div id='summary'></div><br><br>
<hr>SUMMARY<hr>

<?php  if( $show_alerts ){ ?>
	
	No Email = <?php  echo $email_alerts; ?> <br>
	Add Users = <?php  echo $user_add; ?> <br><br>
	
	No Type = <?php  echo $type_alerts; ?> <br><br>
	
	
	
	Friends <?php  echo $cnt_friends; ?> <br>
	Family <?php  echo $cnt_family; ?> <br>
	Tenants <?php   echo count($cnt_tenants); ?> <br>
	Leads <?php  echo $cnt_leads; ?> <br>
	Cients <?php  echo $cnt_clients; ?> <br>
	Followers <?php  echo $cnt_followers; ?> <br>
	
<?php  } ?>


<?php 

		
				//echo "HERE-->";
				//print_r($social_count);
				
				 echo "<div class='clearfix'></div>";
		$index = 0;
		
		
		$social = get_posts( array( 'post_type' => 'ssi_social' , 'posts_per_page' => -1, 'order' => 'asc' ) );
		
		foreach( $social as $lead ){
			
			
			?>		
			
				<div class="hidden-xs col-xs-1 pad0"><a target='_blank' href='<?php echo get_field( 'website_link' , $lead->ID ); ?><?php echo get_field( $lead->post_name , $lead->ID ); ?>'><img src='
<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $lead->post_name; ?>.png' width='30' class=' '><br>

	<center><?php echo $social_count[$index]; ?></center>

</a></div>
			<?php 
			
			$index++;
			
			?>	
			<?php 		
		}
	
	?>

<?php	
				
				//print_r( $leads );

			//	echo "<div class='clearfix'></div><hr>SUMMARY<hr>";
				
				//echo $tot_count . "  " . $post->post_name;
				//echo "<br><br>TOTAL---> $" .  $total_amount; 
				//echo "<br><br>EXPENSE--> $" . $tot_expense; 
				//echo "<br><br>PROFIT---> $" . ($tot_income - $tot_expense); 

				//print_r($names);
				//print_r($names);
				$con_cnt = 0;
	?>
	<button id='numbers'>Show Numbers</button>
	<div id='numbers' style='display:none;'>
	<div class='col-xs-3'>
	<?php
				foreach( $names as $name ){

					if( $nums[$con_cnt] == "" ){ 
						$con_cnt++;
						continue;

					}else{
						//echo "<br>" . $con_cnt . "->" . $name;
						echo "<br>" . $name;
						$con_cnt++;
					}
				}
	
	
	?>
	</div>
	<div class='col-xs-3'>
	<?php

				$con_cnt = 0;

				foreach( $nums as $num ){
					if( $num == "" ){ 
						 $con_cnt++;
						continue;
						echo "<br>" . $con_cnt . "->NEEDED"; 

					}else{
						//echo "<br>" . $con_cnt . "->" . $num;
						echo "<br>" . $num;
						$con_cnt++;
					}
					
				}
?>
	</div>
	
	</div>
	<?php
				echo "<br><br>";


			// Reset Query
			wp_reset_query();


/*********************************************************/



?>

</div>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">	

		<?php

		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

</div><!-- .content-area -->

	<?php }else{ ?>
		
			<?php get_template_part('content', 'member-area'); ?>
			
	<?php } ?>
<?php get_footer(); ?>