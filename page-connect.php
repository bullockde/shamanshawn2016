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

get_header('acf'); 


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


$show_alerts = get_field( 'show_alerts' , $post->ID );

$email_alerts = 0;
$user_add = 0;

$type_alerts = 0;

$cnt_friends = $cnt_family = $cnt_followers = $cnt_tenants = $cnt_leads = $cnt_clients = $cnt_tenants = 0;
?> 
<div class="header text-center">

	<img src='http://shamanshawn.com/wp-content/uploads/ssi-cover-photo.jpg'>
	
	<br><br><h1>#SSIConnect</h1>
	By <a target='_blank' href='http://shamanshawninc.com'>Shaman Shawn Inc.<br><br>
</div>

	<div class='clearfix'></div><hr>
	
	
	<div class='container'>
	
		<div class='row hidden'>
			<div class='col-xs-6 '>
				<?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>	
			<div class='col-xs-6'>
				<button id='newpost' class='btn btn-lg btn-default pull-right'>Add New</button>
				<button id='filter' class='btn btn-lg btn-default pull-right'>Filter</button>
				<a href='#summary' class='btn btn-lg btn-default pull-right'>Summary</a>
			</div><div class='clearfix'></div>
			<hr>
		</div>
		
		

		
<?php get_template_part('content','search-monster'); ?>

		<div class='clearfix'></div>
	

<div id='summary' class='hidden'>


<div class='clearfix'></div>
<?php 

		$index = 0;
		foreach( $social as $site => $link ){
			
			if( 1 /*get_field( $site , $lead->ID )*/ ){ 
?>
			
				<div class="col-xs-1 pad0">
					<a target='_blank' href='<?php echo $link; ?><?php echo get_field( $site , $lead->ID ); ?>'><img src='
<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $site; ?>.png' class='img-responsive aligncenter'><br>

	<center><?php echo $social_count[$index]; ?></center>

					</a>
				</div>
<?php 
			} 
			
			$index++;
				
		}
	
?> 

<div class='clearfix'></div>

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


<br><br>

<?php				
				
				//print_r( $leads );

				
				echo $tot_count . " --  " . $post->post_name;
				echo "<br>" . ($tot_count-$email_alerts) .  " --- emails<br>";
				
				echo "<br><br>TOTAL---> $" .  $total_amount; 
				//echo "<br><br>EXPENSE--> $" . $tot_expense; 
				//echo "<br><br>PROFIT---> $" . ($tot_income - $tot_expense); 

				//print_r($names);
				//print_r($names);
				$con_cnt = 0;

				foreach( $names as $name ){

					if( $nums[$con_cnt] == "" ){ 
						$con_cnt++;
						continue;

					}else{
						echo "<br>" . $con_cnt . "->" . $name;
						echo "<br>" . $name;
						$con_cnt++;
					}
				}
	

				$con_cnt = 0;

				foreach( $nums as $num ){
					if( $num == "" ){ 
						 $con_cnt++;
						continue;
						//echo "<br>" . $con_cnt . "->NEEDED"; 

					}else{
						echo "<br>" . $con_cnt . "->" . $num;
						echo "<br>" . $num;
						$con_cnt++;
					}
					
				}

				echo "<br><br>";


			// Reset Query
			wp_reset_query();


/*********************************************************/



?>
</div><br><br>
</div>


<?php 
			get_template_part( 'content', 'projectlist' );
?>
<!-- Vehicles
<center>
<?php get_template_part( 'content', 'vehicles' ); ?>
</center>			
			-->


<div class='clear'> </div>

<?php

if( !$_GET['filter'] ){ 

		$num_posts = 30;
		if( $_GET['all'] ){ $num_posts = -1; }
		$order = 'desc';
		
		$orderby = 'modified';
		
		if( $_GET['order'] ){ $order = $_GET['order']; }
		
		$args = array( 'post_type' => 'ssi_connections'  , 'posts_per_page' => $num_posts, 'orderby'=> 'modified', 'order' => $order  );
		
		$connections = get_posts( $args );

		?>
	
		
		<hr>
		<center>
		<h4><u><?php echo count($connections); ?></u> Connections</h4>

		<p>As of <?php  
		$d=strtotime("yesterday");
		echo date("m/d/y", $d); ?></p>
		</center>
		<hr>
		<?php
			$names = array();
			$nums = array();
			$emails = array();
			
			foreach( $connections as $lead ){
				
				//if( get_field( 'lead_city', $lead->ID ) != "Washington" )   continue; 
			
					$tot_count++;

					$public = 1;

					

					//echo "<div class='row'><div class='col-xs-6'>";
					//echo "<div class='col-xs-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){

					?>
					
<div class='contact-print container'>


<?php 

	array_push( $names, $lead->post_title );
	array_push( $nums, get_field( 'MX_user_phone', $lead->ID ));


 ?>

	
<div class='clearfix'></div>

					<div class='col-xs-12 col-sm-2'>
						<div class='clearfix'></div>
						<?php
						$img_url = get_the_post_thumbnail_url($lead->ID);
						
						
						?> 
						<img src='<?php echo $img_url; ?>'>
						 <div class='clearfix'></div>
					</div>
					<div class='col-xs-6 col-sm-2'> 

						<?php echo ++$count . " - "; ?>
						
						<a href='/admin/report/?ID=<?php echo $lead->ID; ?>' target='_blank' ><?php echo $lead->post_title; ?></a>
						
						
							<div class='clearfix'></div>
					</div>
					<div class='col-xs-3 hidden'>
						
						<?php echo get_field( 'MX_user_email', $lead->ID ); ?>
						
						<div class='clearfix'></div>
					</div>
					<div class='col-xs-6 col-sm-2'>
						
						<a href="tel:<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>"><?php echo get_field( 'MX_user_phone', $lead->ID ); ?></a>
						
						<div class='clearfix'></div>
					</div>
					<div class='col-xs-12 col-sm-2'>
						<div class='clearfix'></div>
						<?php /* echo get_field( 'area_code', $lead->ID ); */?> 
						<?php 
							if(get_field( 'address', $lead->ID )){
								
								echo get_field( 'address', $lead->ID ) . ", ";
							}
 ?>						<?php echo get_field( 'MX_user_city', $lead->ID ); ?>
						 <?php echo get_field( 'MX_user_state', $lead->ID ); ?>

						 <div class='clearfix'></div>
					</div>
					
					
					
					
					
					<div class='col-xs-12 col-sm-2 hidden'>
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
					
					<div class='col-xs-6 col-sm-2 '>	
				
					<div class='clearfix'></div><br>
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
				<div class='col-xs-6 col-sm-2 '>	
				
					<div class='clearfix'></div>
		
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
					
			<?php
					$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {
		?>
		
		
		
			<button id='details<?php echo $lead->ID; ?>' class='btn  btn-block btn-default hidden1 '>Details</button>
			
	<?php }
			?>
					
					<div class='clearfix'></div>
				</div>
					
				<div class='col-xs-6 col-sm-2 hidden'>	
					<a href='/admin/report/?ID=<?php echo $lead->ID; ?>' target='_blank' class='btn  btn-block btn-default hidden1 '>Report ></a>
					<div class='clearfix'></div>
				</div>
				
				<div class='pull-right'>
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

					
				<div class='col-sm-3' >
					<b>Name: </b> 
					
					<input type="text" name="post_title" placeholder="<?php echo $lead->post_title; ?>" value="<?php echo $lead->post_title; ?>">
				</div>
				<div class='col-sm-2' >
					<b>Phone: </b> 
					
					<input type="text" name="MX_user_phone" placeholder="Phone"  value="<?php echo get_field( 'MX_user_phone', $lead->ID ); ?>">
				</div>
				<div class='col-sm-3' >
					<b>Email: </b> 
					
					
					<input type="text" name="MX_user_email" placeholder="Email" value="<?php echo get_field( 'MX_user_email', $lead->ID ); ?>">

				</div>
				<div class='col-sm-2' >
					<b>Rate: </b> 
					
					<input type="text" name="MX_user_rate" placeholder="Rate"  value="<?php echo get_field( 'MX_user_rate', $lead->ID ); ?>">
				</div>
				<div class='col-sm-2'>
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
					
				<div class='col-sm-12'> 
						<b>Location: </b> <br>
						
						<div class='col-sm-2'> 
								
						
						 <input type="text" name="MX_user_area_code" placeholder="Area Code" value="<?php echo get_field( 'MX_user_area_code', $lead->ID ); ?>">
					</div>
					<div class='col-sm-3 hidden1'>
						
						 <input type="text" name="MX_user_address" placeholder="Address" value="<?php echo get_field( 'MX_user_address', $lead->ID ); ?>">

					</div>
					
					
					<div class='col-sm-2'>
	
						<input type="text" name="MX_user_city" placeholder="City" Value="<?php echo get_field( 'MX_user_city', $lead->ID ); ?>">

					</div>
					<div class='col-sm-1'>

						<input type="text" name="MX_user_state" placeholder="State" value="<?php echo get_field( 'MX_user_state', $lead->ID ); ?>">

					</div>
					<div class='col-sm-2'>
						 <input type="text" name="MX_user_zip" placeholder="Zip Code" value="<?php echo get_field( 'MX_user_zip', $lead->ID ); ?>">
					</div>
					<div class='col-sm-2'>
						 <input type="text" name="MX_user_apt_num" placeholder="Apt #" value="<?php echo get_field( 'MX_user_apt_num', $lead->ID ); ?>">
					</div>
				</div>	
					
					<div class='clearfix'></div><hr>
	
					
	<div class=' col-xs-12'>			
				<div class='info'>
				<u>Details</u><br>
				
				
						
				<div class='col-sm-4' >
					<b>Last Seen: </b> 
					
					<input type="text" name="MX_user_last_seen" value="<?php echo date('n/j/y', strtotime( get_field( 'MX_user_last_seen', $lead->ID ) ) ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Last Contacted: </b> 
					
					<input type="text" name="MX_user_last_contacted" placeholder="Last Contacted" value="<?php echo date('n/j/y', strtotime( get_field( 'MX_user_last_contacted', $lead->ID ) ) ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Added: </b> 
					
					
					<input type="text" name="date_added" placeholder="Date Added" value="<?php echo mysql2date('n/j/y', $lead->post_date ); ?>">
				</div>
				
				
				<div class='col-sm-12' >
					<b>D.O.B: </b> 
					
					<input width="100" type="text" name="lead_dob" placeholder="D.O.B" value="<?php echo get_field( 'MX_user_dob', $lead->ID ); ?>">
				</div>
				
		</div>		
	</div>			
			<div class='clearfix'></div>
				
				<input type='hidden' name='ID' value='<?php echo $lead->ID; ?>'>
				<input type='hidden' name='edit_profile' value='1'>
				
	<div class=' col-xs-12 hidden'>			
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
	<div class="col-xs-12 hidden">		
					<h3>Full Details</h3><div class='clearfix'></div><hr>
					
	<div class="prof-info col-sm-6">
			
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

		<div class="prof-info col-sm-6">
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
		
		
		<div class="prof-info col-sm-6">
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
				
		<div class="prof-info col-sm-6">
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
		
		<div class="prof-info col-sm-6">
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
				
		<div class="prof-info col-sm-6">
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
		
		<div class="prof-info col-sm-6">
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
		
		<div class="prof-info col-sm-6">
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
						
						
	
	<div class="prof-info col-sm-6 hidden">
		<div class='clearfix'></div><br>
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
											
								<!--					<div class="prof-info col-sm-6">
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
					
					<textarea name="notes">
						<?php echo $lead->post_content; ?>
					</textarea>

					
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
				<div class='col-xs-6 col-sm-2'><b>Date</b></div>
				<div class='col-xs-6 col-sm-2'><b>Time</b></div>
				<div class='col-sm-2'><b>Location</b></div>
				<div class='col-sm-2'><b>Service</b></div>
				<div class='col-sm-2'><b>Trans ID</b></div>
				<div class='col-sm-2'><b>Rate</b></div>
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

			      <div class='col-xs-6 col-sm-2'>
				   <?php echo get_sub_field('date'); ?></div>
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
				<div class=' col-sm-2'>
						
					<input  type="text" name="trans_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					<div class='clearfix'></div>
				</div>
				<div class=' col-sm-2'>
					<input type="text" name="trans_time" placeholder="Time" value="<?php echo current_time( 'g:i' ); ?> pm" >
					<div class='clearfix'></div>
				</div>
				<div class='col-sm-2'>
					<div class='clearfix'></div>
					<input type="text" name="trans_location" placeholder="Location" value="My Place">
					<div class='clearfix'></div>
				</div>
				<div class='col-sm-4'>
					<div class='clearfix'></div>
					<input type="text" name="trans_service" placeholder="Service" Value="Service">
					<div class='clearfix'></div>
				</div>
				
				<div class='col-xs-6 col-sm-1'>
					<div class='clearfix'></div>
					<input type="text" name="trans_amount" placeholder="Rate">
					<div class='clearfix'></div>
				</div>
		<div class='col-xs-6 col-sm-1'>
			<div class='clearfix'></div>
			<input type="radio" name="income_expense" value="+">+<br>
			<input type="radio" name="income_expense" value="-">-
		</div>		
				<input type="hidden" name="client_name" value="<?php echo $lead->post_title; ?>">
				<input type="hidden" name="client_city" value="<?php echo get_field( 'lead_city', $lead->ID ); ?>">
				<input type="hidden" name="client_phone" value="<?php echo get_field( 'lead_phone', $lead->ID ); ?>">
				<input type="hidden" name="client_state" value="<?php echo get_field( 'lead_state', $lead->ID ); ?>">
				
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
				<div class='col-xs-6 col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'>&nbsp;</div>
				
				<div class='col-sm-3'><div class='pull-right'><?php echo "Total: $" . $client_profit; ?></div></div>
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

<div class='col-sm-2 hidden'><?php echo $services . " - - Total: $" . $client_profit; ?></div>
<?php				
				
					
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 

				}
}
?>


<?php

	if ( !is_user_logged_in()  ) {
 ?>

		<div class='container'>
			
				<div class='clearfix'></div><hr>
				
		
				<div class='well'>
					
					
					<a href='/join' class='btn btn-success btn-lg btn-block hidden'>Join Now</a>
					
					<div id='join' style='display: block;' class='text-center'>
					<h4>Join Today - 100% FREE!</h4><hr>
					<button id='join' class='btn btn-success btn-lg btn-block'>Join Now</button>
					</div>
					<div id='join' style='display: none;'>
					
						<center><h3>Join Today - 100% FREE!</h3></center>
						<?php echo do_shortcode("[wpmem_form register]"); ?>
					</div>
					
					<br>
					

					<div id='login' style='display: block;' class='text-center'>
						<center><h4>Already A Member?</h4></center><hr>
						<button id='login' class='btn btn-success btn-lg btn-block'>Login Here</button>
					</div>
					<div id='login' style='display: none;' >
					
						<center><h3>Member Login</h3></center>
						
						<?php echo do_shortcode("[wpmem_form login]"); ?>
					</div>
					
				</div>
			
			</div>
		<div class='clearfix'></div>
		
<?php

	}
 ?>


<center>
	<a href='/connect'><< Start Over</a><br><br>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Free_Client_Screening_300_250 -->
	<ins class="adsbygoogle"
		 style="display:inline-block;width:300px;height:250px"
		 data-ad-client="ca-pub-9799103274848934"
		 data-ad-slot="7835689850"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	
	<br>
	
	<a href="http://info.flagcounter.com/e7TV"><img src="http://s04.flagcounter.com/countxl/e7TV/bg_FFFFFF/txt_000000/border_CCCCCC/columns_3/maxflags_9/viewers_0/labels_0/pageviews_1/flags_0/percent_0/" alt="Flag Counter" border="0"></a>

	<br><br>
	
</center>



<?php get_footer('acf'); ?>