			
		<?php
	if( !empty($_POST['add_notes']) ){
		
		//echo "Update Post";
		
		
		$my_post = array(
		  
		  'ID' => $_POST['ID'],
		// 'post_date'	=> $date_added,
		 //'post_type' => $_POST['post_type'] ,
		// 'post_title' => $_POST['post_title'] ,
		 'post_content' => $_POST['notes'] . ' <br>' . current_time( 'm/d/y' ) . ' -- ' . $_POST['post_content'] ,
		// 'post_status' => 'publish'

		);
		

		// Insert the post into the database
		wp_update_post( $my_post );
		
	}	
	
	
	if( $_POST['add_connection'] ) {
	 

      //echo "New Connection Adding!!!";

	  $post_content = '-' . $_POST['post_content'];

	  
		$my_post = array(

			'ID' =>  '',	
			'post_title' => $_POST['post_title'],
			'post_content' => $post_content,
			'post_status' => 'publish',
			'post_type' => 'ssi_connections'
			);
			 
			// Update the post into the database
		$new_contactID = wp_insert_post( $my_post );
		
	//	echo "Added!!! --> " . $new_contactID ;
	
	 
	foreach ($_POST as $param_name => $param_val) {
			add_post_meta($new_contactID, $param_name, $param_val, true);
			update_post_meta( $new_contactID, $param_name, $param_val  );

		}
	 

//	echo "<br> New Contact Added!!!";
	
//	echo "<br> THE-POST--> " ;
//	print_r($my_post);
	
	//echo "<br> THE-CAT--> " ;
	
	$category = get_term_by('slug', $_POST['contact_type'], 'category');
		
		//print_r($category);
		wp_set_post_categories( $new_contactID , $category->term_id  );

		// Update the post into the database
  	wp_update_post( $new_contactID );
	
	//$return_page = $_POST['URI'];
	
	//echo " <br>THE-PAGE--> " ;
	//print_r($return_page);
	
	
	// Update the post into the database
  	
	wp_publish_post( $new_contactID );
	
	
 }//end ssi_new_contact
			/*********************************************************/
			
			$index = 0; 
			$s_count = 0;
			$social_count = array(); 
			
				
			$tot_count = 0;

			$total_amount = 0;

	// The Query
			

				$connections = get_posts( array( 'post_type' => 'ssi_connections' , 'posts_per_page' => -1 ) );
				$contacts = get_posts( array( 'post_type' => 'ssi_contact' , 'posts_per_page' => -1 ) );
				$clients = get_posts( array( 'post_type' => 'ssi_clients' , 'posts_per_page' => -1 ) );
				$family = get_posts( array( 'post_type' => 'ssi_family' , 'posts_per_page' => -1 ) );
				
				$tenants = get_posts( array( 'post_type' => 'tenants' , 'posts_per_page' => -1 ) );
			
				$leads = array_merge($connections,$contacts,$tenants,$clients,$family);
				
				
				
				
				
		if( $_GET['filter'] ){ 
		
			//echo count($leads);
		
			$found = array();
			
			//echo "Here!";
			
			$num1 = $num2 = $num3 = "";
			if( !empty($_GET['phone1']) ){ $num1 = $_GET['phone1'] . "-"; }
			if( !empty($_GET['phone2']) ){ $num2 = $_GET['phone2'] . "-"; }
			if( !empty($_GET['phone3']) ){ $num3 = $_GET['phone3']; }
			
			$phone_num = $num1 . $num2 . $num3;
					
			foreach( $leads as $lead ){
				
				
				//echo "<br>TERM: " . $_GET['searchterm'] . " = " . $lead->post_title;
				$var = $phone_num;
				
				$searchword = get_field( 'MX_user_phone', $lead->ID );
				$searchword2 = get_field( 'lead_phone', $lead->ID );
				//echo "<br>TERM: " . $var . " = " . $searchword;
				if( strpos( $searchword , $var ) ){ 
					array_push( $found, $lead );
					//echo "BINGO!!";
				}else if( strpos( $searchword2 , $var ) ){ 
					array_push( $found, $lead );
					//echo "Not FOUND --" . $_GET['searchterm'];
				}else if( 0 /*strpos( get_field( 'MX_user_phone', $lead->ID ) , strtolower($_GET['searchterm']) )*/ ){ 
					array_push( $found, $lead );
					//echo "Not FOUND --" . $_GET['searchterm'];
				}else{
					//echo "FOUND --" . $_GET['searchterm'];
					//array_push( $found, $lead );
				
				}
			}
			
			$leads = $found;
			
			//echo count($leads);
		}
		
		
		
?>

		
<div class='number_search text-center'>

<?php if( /*!$_GET['filter'] */ 0 ){ ?>
<hr>
<h4><u><?php echo count($leads); ?></u> Members</h4>

<p>As of <?php  
$d=strtotime("yesterday");
echo date("m/d/y", $d); ?></p>
<?php } ?>
<hr>
	<div id='newpost' class='clear' style='display: block;'>

		<?php  
			
	
			//echo "Phone: " . $phone_num;
		?>
		

<?php if(!$_GET['filter']){ ?>
<br>
			<fieldset>
				
				<legend><h5>Add/Search by Phone #</h5></legend>
				
<form id="filter">
			
			<div class='screening text-center ' style='display: inline;'>
			
				
				<input id="phone1" class="phone" name="phone1" type="tel" maxlength="3" placeholder="555" size="3" value=""/>
			   <input id="phone2" class="phone" name="phone2" type="tel" maxlength="3" placeholder="555" size="3" value=""/>
				<input id="phone3" class="phone" name="phone3" type="tel" maxlength="4" placeholder="5555" size="4" value=""/>
	
			</div>
				<input name='filter' value='1' type='hidden'>
			<br><br>
			<center>	
			<input type='submit' class='' >
			</center>		

		</form>
			</fieldset>
<?php } ?>
		
		

	</div>
</div>



<?php
			//get_template_part( 'content', 'filter-contact' );

			$names = array();
			$nums = array();
			$emails = array();
			
			if( !count($leads) ){ 
			
			?> 
				<div class='text-center'>
					
				<div id='newpost' class='clear' style='display: block;'>	
					<h5>Sorry.. (<?php echo $phone_num;  ?>) not found.</h3>
					<br><br>
				</div>	
			<!--  # ADD NEW CONTACT  -->			
					<div id='newpost' class='clear' style='display: none;'>

<?php /*$lead = get_post(11975);*/ ?>
<div class='well contact taskcard'>
		
<form method="post" action="">		
		<div class='clearfix'></div>
		<div class='col-md-2'> 
			Name:<br>
			<input type="text" name="post_title" placeholder="Enter Name" class="text-center" required>

		</div>
		<div class='col-md-3'>
			Email:<br>
			<input type="text" name="MX_user_email" placeholder="Enter Email" placeholder="<?php echo get_field( 'MX_user_email', $lead->ID ); ?>" class="text-center">

		</div>
		<div class='col-md-2'>
			Phone #:<br>
			<input type="text" name="MX_user_phone" placeholder="1-555-555-5555" value="1-<?php echo $phone_num;  ?>" class="text-center" required>

		</div>
		<div class='col-md-2'>
			City:<br>
			<input type="text" name="MX_user_city" placeholder="Enter City" class="text-center">

		</div>
		<div class='col-md-1'>
			State:<br>
			<input type="text" name="MX_user_state" placeholder="VA" class="text-center">

		</div>
		<div class='col-md-2'>
			Zip:<br>
			<input type="text" name="MX_user_zip" placeholder="123456" class="text-center">
		</div>
					
<div class='clearfix'></div>
	
<div id='details' class='details' style='display: none;'>	
				
					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>


				<div class='col-sm-4' >
					<b>Last Seen: </b> 
					
					<input type="text" name="last_seen" placeholder="Last Seen" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Last Contacted: </b> 
					
					<input type="text" name="last_contacted" placeholder="Last Contacted" placeholder="<?php echo date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ); ?>" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Added: </b> 

					<input type="text" name="date_added" placeholder="Date Added" placeholder="<?php echo mysql2date('n/j/y', $lead->post_date ); ?>" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				
				<div class='clearfix'></div>
				<hr>
				
				<div class='info hidden'>
				<u>Details</u><br>
				
				<b>Area Code: </b> <input type="text" name="area_code" placeholder="Area Code" placeholder="<?php echo get_field( 'area_code', $lead->ID ); ?>">
				

				<b>D.O.B: </b> <input width="100" type="text" name="dob" placeholder="D.O.B" placeholder="<?php echo get_field( 'MX_user_dob', $lead->ID ); ?>">
				
				</div>

			<div class='clearfix'></div>
				

</div>

<div id='addsocial<?php echo $lead->ID; ?>' style='display: block;' class='text-center number_search'>
		
	<!--	
		SOCIAL Network

		<select name="site">
				<option value="">Choose a Network</option>
		
	<?php 
		foreach( $social as $site => $link ){				
	?>		
				<option value="<?php echo $site; ?>"><?php echo $site; ?></option>
		
	<?php 		
		}
	?>
				<option value="other">Other</option>
		</select>

			<input type="text" name="username" placeholder="Enter Username" class='text-center'>
			
		-->	
			<input name="add_connection" type="hidden" value="1" />

	<input type="submit" class="btn btn-block" value="Add it Now!" />
</div>

	
</form>						

<div class='clearfix'></div>
	

</div><!-- END Well Contact-->

	<hr>
</div>

				<div id='newpost' class='clear' style='display: block;'>	
					<button id='newpost' class='btn'> Add it Now! </button>
				</div>
				</div>
				
				
<!--  ADD NEW CONTACT -->



					
				
				
				
			
			<?php
			
			}
			
			foreach( $leads as $lead ){
				
					
				
					if(!$_GET['filter']){ break; }
			
					$tot_count++;

					$public = 1;

					

					//echo "<div class='row'><div class='col-md-6'>";
					//echo "<div class='col-md-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){

					?>
					
<div class='well contact taskcard'>

<div class='text-center h4'>

	Member: <u>Verified</u>
	
	

</div>
<div class='text-center '>


		<small>
			<b>Updated:</b> <?php 
				
				$date_format = get_option( 'date_format' );
				
				echo get_the_modified_date( $date_format ,$lead->ID); 
				
				?>
		</small>		
</div>
			<div class='clearfix'></div><hr>
			<div class=' '>


			
				<div class='col-sm-4 '>
				<?php 
				
					if( get_field( 'MX_user_facebook' , $lead->ID ) != '' ){
						
						
				?>
						<img src="http://graph.facebook.com/<?php echo get_field( 'MX_user_facebook' , $lead->ID ); ?>/picture" class="hidden circle">
					<?php 

					}
				
				
				  if ( has_post_thumbnail($lead->ID) ) {
			
					
 					$thumbnail_id = get_post_thumbnail_id( $lead->ID);
					if( 1 /*$thumbnail_id == 10286 */ ){
				?>
						
				<img src='http://shamanshawn.com/wp-content/uploads/2015/11/blank-face.jpe' class='circle aligncenter'>
				<?php

							
    					 }else{	
						 ?>
						 <div class='circle aligncenter'>
						 <?php  echo get_the_post_thumbnail( $lead->ID ); ?>
						 </div>
						 <?php
						 } 
				  } 
							
					?>
				</div>
				<div class='col-sm-8 '>
				
					<div class=' well'> 
					
					<div class='col-sm-4 '>
						<b>Name</b>
					</div>
					<div class='col-sm-8 '>
						  <center><?php 
						  if( !is_user_logged_in() ){	
								?>
								
								- PRIVATE -
								
								<?php
								}else{
									
									echo $lead->post_title;
									?>
					
								<?php
							
							}
						  
						  
						   ?> </center>
					</div>		
					
					<div class='col-sm-4 '>
						<b>Phone</b>
					</div>
					<div class='col-sm-8 '>
						 <center><?php
							if( !is_user_logged_in() ){
							
								if( get_field( 'MX_user_phone', $lead->ID ) ){
									
								?>
								
								- PRIVATE -
								
								<?php
								}else{
									?>
								
								 - Phone needed -
								
								<?php
								}

							}else{
								
									?>	
								<a href="tel:<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>"><?php echo get_field( 'MX_user_phone', $lead->ID ); ?></a>
								
								<?php
								
							}
						
						?></center>
					</div>	
					
						<div class='col-sm-4 '>
						<b>Email</b> 
					</div>
					<div class='col-sm-8 '>
						<center><?php
							if( !is_user_logged_in() ){
							
								if( get_field( 'MX_user_email', $lead->ID ) ){
									
								?>
								
								- PRIVATE -
								
								<?php
								}else{
									?>
								
								 N/A
								
								<?php
								}

							}else{
								
									if( get_field( 'MX_user_email', $lead->ID ) ){
									
								?>
								
								<a href="tel:<?php echo get_field( 'MX_user_email', $lead->ID ); ?>"><?php echo get_field( 'MX_user_email', $lead->ID ); ?></a>
								
								<?php
								}else{
									?>
								
								 N/A
								
								<?php
								}
									?>	-
								
								
								<?php
								
							}
						
						?></center>
					</div>	
					
						
					<div class='col-sm-4 '>
						<b>Address </b>
					</div>
					<div class='col-sm-8 '>
						<center> - Hidden - </center>
					<?php 
							if(get_field( 'MX_user_address', $lead->ID )){
								
								//echo get_field( 'MX_user_address', $lead->ID ) . ", ";
							}
 ?><?php //echo get_field( 'MX_user_city', $lead->ID ); ?>
						 <?php //echo get_field( 'MX_user_state', $lead->ID ); ?> 
						 <?php //echo get_field( 'MX_user_zip', $lead->ID ); ?>
						 
					</div>	
						
					
					<div class='clearfix'></div>
					<div class='col-sm-4 '>
						<b>Location</b> 
					</div>
					<div class='col-sm-8 '>
						 <center><?php echo get_field( 'MX_user_city', $lead->ID ); ?>
						 <?php echo get_field( 'MX_user_state', $lead->ID ); ?> 
						 </center>
					</div>	
					<div class='clearfix'></div>
				</div>

					<div class='clearfix'></div>
					
					
		
					<?php 
					
		
		
		//$social = get_posts( array( 'post_type' => 'ssi_social' , 'posts_per_page' => -1, 'order' => 'asc' ) );

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
		
					<div class='clearfix'></div>

			
		

<div class='pull-right hidden'>
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
			<?php
				}

 ?>
</div>


<!--  ADD USER MODULE  -->	

<?php if( get_field( "MX_user_email", $lead->ID ) ){
	
	//echo "USER HAS EMAIL--" . get_field( "MX_user_email", $lead->ID );
	
		if( $user = get_user_by('email', get_field( "MX_user_email", $lead->ID )) ){ 
			//echo "User ID: " . $user->ID . "<br>";
		 }else{
			 $user_add++;
			?>
		
		<form method="post" action="" class=''>
			<button name="ssi_add_user" type="submit" class='btn btn-warning hidden' value="Add User" />Add User</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form> 
		<br>
		<?php
		}
		
			}else if( $show_alerts ){ 
				$email_alerts++;
			?> 
				<div class="alert alert-warning">
				  <strong>Warning!</strong> - No User Email 
				</div>
			<?php
				}
		
		?>
<!--  # ADD USER MODULE  -->	


<div class='hidden1'>
		
</div>
	<form method="post" action="">		
		<div class='clearfix'></div>
					<div class='col-md-2'> 

						Name:<br>
						<input type="text" name="post_title" placeholder="Enter Name" class="text-center">

					</div>
					<div class='col-md-3'>
						Email:<br>
						<input type="text" name="MX_user_email" placeholder="Enter Email"  class="text-center">

					</div>
					<div class='col-md-2'>
						Phone:<br>
						<input type="text" name="MX_user_phone" placeholder="Enter Phone" value="<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>" class="text-center">

					</div>
					<div class='col-md-2'>
						City:<br>
						<input type="text" name="MX_user_city" placeholder="Enter City" value="<?php echo get_field( 'MX_user_city', $lead->ID ); ?>" class="text-center">

					</div>
					<div class='col-md-1'>
						State:<br>
						<input type="text" name="MX_user_state" placeholder="Enter State" value="<?php echo get_field( 'MX_user_state', $lead->ID ); ?>" class="text-center">

					</div>
					<div class='col-md-2 '>
						Zip:<br>
						<input type="text" name="MX_user_zip" placeholder="Enter Zip" value="<?php echo get_field( 'MX_user_zip', $lead->ID ); ?>" class="text-center">

	
						
					</div>
					<div class='col-md-2 hidden'>
<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
						<button name="ssi_cf" type="submit" class='btn btn-info' value="Update" />Update</button>
	
						
					</div>
					
					
						
	
	</form>						



	<a target='_blank' href='/wp-admin/post.php?post=<?php echo $lead->ID;  ?>&action=edit' class='btn btn-default pull-left hidden'>Edit Lead</a>

	<form method="post" action="" class='pull-left hidden'>
			<button name="update" type="submit" class='btn btn-danger' value="Remove Lead" />Delete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="post_to_draft" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
		
	

<button id='details<?php echo $lead->ID; ?>' class='btn btn-default pull-right hidden'>Details</button>


	
				<?php

					echo "<br><br><div id='details" . $lead->ID .  "' class='details hidden' style='display: none;'>";

				?>

					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>

				<?php
					
					/*if( $lead["2.3"] ){
					echo "<b>Location: </b> " . $lead["2.3"] . ", " . $lead["2.4"] . " " . $lead["2.5"] . "<br><br>";
					}else	{
					echo "<b>Location:</b> Philadelphia, PA<br>";
					}*/

				?>
				
				
		<form id="update" method='post'>		
				<div class='col-sm-4' >
					<b>Last Seen: </b> 
					
					<input type="text" name="last_seen" value="<?php echo date('n/j/y', strtotime( get_field( 'last_seen', $lead->ID ) ) ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Last Contacted: </b> 
					
					<input type="text" name="last_contacted" placeholder="Last Contacted" value="<?php echo date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Added: </b> 
					
					
					<input type="text" name="date_added" placeholder="Date Added" value="<?php echo mysql2date('n/j/y', $lead->post_date ); ?>">
				</div>
				
				<div class='clearfix'></div>
				
				
				<div class='info'>
				<u>Details</u><br>
				
				<b>Area Code: </b> <input type="text" name="area_code" placeholder="Area Code" value="<?php echo get_field( 'area_code', $lead->ID ); ?>">
				
				
				
				<b>D.O.B: </b> <input width="100" type="text" name="dob" placeholder="D.O.B" value="<?php echo get_field( 'MX_user_dob', $lead->ID ); ?>">
				
				</div>
				
			
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
	
				<button name="ssi_cf" type="submit" class='btn btn-info' value="Update" />Update</button>
			</form>	
				
				
				
				<?php 
					
					
				// ####################   Service Log	#########

				$client_profit = 0;

				?>
				<div class='clear'><br><br></div>
				<div class='col-xs-6 col-sm-2'><b>Date</b></div>
				<div class='col-xs-6 col-sm-2'><b>Time</b></div>
				<div class='col-sm-2'><b>Location</b></div>
				<div class='col-sm-2'><b>Service</b></div>
				<div class='col-sm-2'><b>Trans ID</b></div>
				<div class='col-sm-2'><b>Rate</b></div>
				<div class='clearfix'></div>

				<hr>

				<?php 

				// check if the repeater field has rows of data
				if( have_rows('service_log' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('service_log', $lead->ID ) ) : the_row();
				
				?>

			       <div class='col-xs-6 col-sm-2'><?php echo get_sub_field('date'); ?></div>
				<div class='col-xs-6 col-sm-2'><?php the_sub_field('time'); ?></div>
				<div class='visible-xs'><br><br></div>
				<div class='col-sm-2'><?php the_sub_field('location'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-sm-2'><?php the_sub_field('service'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-sm-2'><?php the_sub_field('trans_id'); ?></div>
				<div class='visible-xs'><br></div>
				<div class='col-sm-2'>$<?php the_sub_field('rate'); ?></div>
				
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
				<div class='col-xs-6 col-sm-2'><input  type="text" name="trans_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" ></div>
				<div class='col-xs-6 col-sm-2'><input type="text" name="trans_time" placeholder="Time" value="<?php echo current_time( 'g:i' ); ?> pm" ></div>
				<div class='col-sm-2'><input type="text" name="trans_location" placeholder="Location" value="My Place"></div>
				<div class='col-sm-4'><input type="text" name="trans_service" placeholder="Service" Value="Service"></div>
				
				<div class='col-md-1'><input type="text" name="trans_amount" placeholder="Rate"></div>
		<div class='col-md-1'>
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
			</form>
		</div>
				<div class='clearfix'></div>
				<hr>
			<?php 
				// #################### END Service Log	#########

				?>
				
				<div class='col-xs-6 col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'><div class='pull-right'><?php echo "Total: $" . $client_profit; ?></div></div>

				
			<div class='clearfix'></div><br>
			
		Forms:<br>
			
		<?php if( get_field( 'file_1', $lead->ID ) ){ ?>
			<a target="_blank" href="<?php echo get_field( 'file_1', $lead->ID ); ?>">Client Intake (Front) </a><br>
		<?php } ?>
		<?php if( get_field( 'file_2', $lead->ID ) ){ ?>
			<a target="_blank" href="<?php echo get_field( 'file_2', $lead->ID ); ?>">Client Intake (Back)</a><br>
		<?php } ?>

		
			
	
			
			
			
										<?php 

				// check if the repeater field has rows of data
				if( have_rows('ssi_forms_uploader' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('ssi_forms_uploader', $lead->ID ) ) : the_row();
				
				?>

			       <div class='col-xs-2 text-center'><?php the_sub_field('ssi_form_title'); ?><br>
				   <a href='<?php the_sub_field('ssi_form_upload'); ?>' target='_blank'> <img src='<?php the_sub_field('ssi_form_upload'); ?>' class='img-responsive'></a>
				   (<?php echo get_sub_field('ssi_form_date'); ?>)
				   </div>
						
				
				
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;

?>


					<div class='col-xs-6'>
					
						
						
						<img src='<?php echo get_field( 'file_1', $lead->ID ); ?>' class='img-responsive'>	
					</div>
					<div class='col-xs-6'>
					
						<img src='<?php echo get_field( 'file_2', $lead->ID ); ?>' class='img-responsive'>
					</div>
					<img src='<?php echo get_field( 'file_3', $lead->ID ); ?>' class='img-responsive'>
		

		<form method="post" action="" class='pull-left'>
			<button name="update" type="submit" class='btn btn-danger' value="Remove Lead" />Delete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="post_to_draft" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
		
	<a target='_blank' href='/wp-admin/post.php?post=<?php echo $lead->ID;  ?>&action=edit' class='btn btn-default pull-left'>Edit Lead</a>
 

</div>


<div class='well hidden'>

<?php 
		$index = 0;
		foreach( $social as $site => $link ){				
			?>		
			<?php if( get_field( $site , $lead->ID ) ){ 

				$social_count[$index]++;	
				
				
			?>
				
			<div class="">
				
				<a target='_blank' href='<?php echo $link; ?><?php echo get_field( $site , $lead->ID ); ?>'>
				
				<img  width='25' src='
<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $site; ?>.png' class='pull-left'>/<?php echo get_field( $site , $lead->ID ); ?>
				</a>
				
				<div class='clear'> </div>


			</div>
			<?php 		}
			$index++;
			?>	
			<?php 		
		}
	?>
	
	
	
	
	<?php array_push( $names, $lead->post_title ); ?>
					
	<div class='clearfix'></div><hr>

	<a target='_blank' href='/admin/report/?ID=<?php echo $lead->ID; ?>' class='btn btn-info pull-right'>Full Report</a>
	
	<button id='addsocial<?php echo $lead->ID; ?>' class='btn btn-default'>Add Social</button>
	
	
	<div id='addsocial<?php echo $lead->ID; ?>' style='display: none;'>
		<br><hr>
		ADD SOCIAL FORM
		<form id='add-social' method='post'> 
			<select name="site">
				<option value="">Social</option>
		
				<?php 
		foreach( $social as $site => $link ){				
			?>		
				<option value="<?php echo $site;?>"><?php echo $site; ?></option>
		
			<?php 		
		}
	?>
				<option value="other">Other</option>
			</select>
			
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input type="hidden" name="add_social" value="true">
			<input type="text" name="username">
			<input type="submit">
		</form>
	</div>
	<div class='clearfix'></div>
	
	
</div>


	<div class='clearfix'></div><hr>
	<div class='text-center '>
				
		<?php 
				
				$email = get_field('MX_user_email' ,$lead->ID);
						 $user = get_user_by_email($email);
				
				if(get_user_by_email($email)){
					
					?>

			<a  target='_blank' href='/user-profile?ID=<?php 
				
				$email = get_field('MX_user_email' , $lead->ID);
						 $user = get_user_by_email($email);
				
				echo $user->ID; ?>' class='btn btn-default btn-block'>View Profile</a>
				<?php	
				}
				else{
					?>

			<a  target='_blank' href='/claim?claimID=<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>Claim Profile</a>
				<?php
				}
				 ?>
	

	</div>
	<div class='clearfix'></div><hr>
	
	<div class='text-center hidden1'>
				
	
		
		Client Reviews
		<br> <small>.. coming soon ..</small>
		
			<?php 	
					echo "<div class='clearfix'></div><br>";
					
					
					echo "<div class='col-xs-12 hidden' ><b>Notes: </b> " . $lead->post_content . "</div><br>";


					?>
					
				<?php
					echo "<div class='clearfix'></div><br><br>";
					
					$content = $lead->post_content;
					
					$content = apply_filters('the_content', $content);
					
					//echo "<div class='col-xs-12 text-left' ><b><u>Notes</u></b><br>" . $content . "";
			?>
			<div class='col-xs-12 text-left' >
				<b><u>Notes</u></b><br>
			
				<?php echo $content; ?>
			<form method='post'>	
				<textarea name="post_content" placeholder="More notes .."></textarea>
				
				<input type='hidden' name='notes' value='<?php echo $content; ?>'>
				<input type='hidden' name='ID' value='<?php echo $lead->ID; ?>'>
				<input type='hidden' name='add_notes' value='1'>
				<input type='submit' value='Add Notes'>
			</form>
			</div>
					
					<div class='clearfix'></div>
	</div>
</div><!-- END Well Contact-->


<?php				
				
					
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 

				}
				
				
?>
<div class='clearfix'></div><hr>