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

get_header(); 


$upcoming_events = get_posts( array (  
						
					   'posts_per_page'         =>  -1,
					   'post_type' => 'ssi_events',
					   'category_name' => 'lgbteam',
						'orderby'  => 'post_date',
					   'meta_key'   => 'event_date',
						'order' => 'desc', 

					)     );


if( $_POST['add_connection'] ) {
	 

      //echo "New Connection Adding!!!";

	  $post_content = '-' . $_POST['post_content'];

	  
		$my_post = array(

			'ID' =>  '',	
			'post_title' => $_POST['post_title'],
			'post_content' => $post_content,
			'category_name' => 'lgbteam',
			'post_status' => 'publish',
			'post_type' => 'ssi_contact'
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
	
	<br><h4>www.TheNewSSI.com<br><small>Collaborate. Innovate. Elevate!</small></h4>
	<!-- By <a target='_blank' class=' pull-right'  href='http://shamanshawninc.com'>Shaman Shawn Inc.</a><br>-->
	<div class='clearfix'></div><br>
</div>

	<div class='clearfix'></div><hr>
	
	
	

	<div class=''>
	<div class='clearfix'></div>
		
		
		

		
<?php get_template_part('content','welcome'); ?>


<?php get_template_part( 'content', 'search' ); ?>
		<div class='clearfix'></div>
	<?php get_template_part( 'content', 'ssi-banner-ad' ); ?>
			
		<?php
		
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
				
				$tenants = get_posts( array( 'post_type' => 'ssi_tenants' , 'posts_per_page' => -1 ) );
			
				$leads = array_merge($connections,$contacts,$tenants,$clients,$family);
				
				//$user_count = get_user_count();
							
				$result = count_users();
				//echo 'There are ' . $result['total_users'] . ' total users';
				foreach($result['avail_roles'] as $role => $count){
					
						//echo ', ' . $count . ' are ' . $role . 's';
						//echo '.';
				}
				

				$leads_count = count($leads);
				$member_count = $result['total_users'] + $leads_count;

				

				
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
<?php get_template_part('content','wwss'); ?>
		
		<?php //get_template_part('content','upcoming-trips'); ?>
		
		
		
		
		
		
		
		


<?php 
			

			//get_template_part( 'content', 'filter-contact' );
	
?>



<div class='clear'> </div>

							<?php get_template_part( 'content', 'ssi-banner-ad' ); ?>

<br><br>
	<?php get_template_part( 'content', 'creations' ); ?>


	
	<div class='clear'> </div>
	<br><br>
							<?php get_template_part( 'content', 'ssi-banner-ad' ); ?>
	
	
	<br>
			
<div class='report number_search text-center hidden1'>

<?php if(!$_GET['filter']){ ?>
<hr>
<h3><u><?php echo $member_count; ?></u> Members<br><small>
As of <?php  
$d=strtotime("today");
echo date("m/d/y", $d); ?>
</small></h3>


<?php } ?>
<hr>

	<?php get_template_part('content','search-monster'); ?>








	<div id='newpost' class='clear' style='display: block;'>

		<?php  
			
	
			//echo "Phone: " . $phone_num;
		?>
		
		<div id='search' class='clear' style='display: none;'>	
				<button id='search' class='btn btn-default btn-sm'> Search </button>
			</div>
		

<?php if(!$_GET['filter']){ ?>

	<div id='search' style='display: none;'>

			<fieldset>
				
				<legend>Add/Search by Phone #</legend>
				
<form id="filter">
			
			<div class='screening text-center ' style='display: inline;'>
			
				
				<input id="phone1" class="phone" name="phone1" type="tel" maxlength="3" placeholder="555" size="3" value=""/>
			   <input id="phone2" class="phone" name="phone2" type="tel" maxlength="3" placeholder="555" size="3" value=""/>
				<input id="phone3" class="phone" name="phone3" type="tel" maxlength="4" placeholder="5555" size="4" value=""/>
	
			</div>
				<input name='filter' value='1' type='hidden'>
			<br><br>
			<center>	
			<input type='submit' class='btn-block' >
			</center>		

		</form>
			</fieldset>
			<button id='search' class='btn btn-default btn-sm hidden'> x close</button>
		</div>
<?php } ?>
		
		

	</div>
</div>


	
	
	
	
	
	
	
	
	<div class='clearfix'></div>














<div class='clearfix'></div>


<div class='well text-center hidden'>


<div class="clear"></div>
	
	<h4> Upcoming Events </h4><br><hr>
	

	<?php 
			
		$found = 0;
		
		$count = 0;
		
		if(count($upcoming_events) == 0){ 	
			?>
			<center>- No Upcoming Events -</center>
			<?php	
		}
		
		foreach( $upcoming_events as $lead ){
		
	?>
	<div class='clearfix'></div>
		<div class='col-sm-10 col-sm-offset-1 text-center well hidden'>		
			
				<h3><?php echo $lead->post_title; ?><hr></h3>
				
				<div class='col-sm-6 '>	
					<?php echo get_the_post_thumbnail($lead->ID); ?>
				
				</div>
				<div class='col-sm-6 '>			
					<div class='clearfix'></div><br>
					
					<div class='col-xs-6 '>
						<h3><u>Date</u></h3>

						<?php date_default_timezone_set("America/New_York"); 

						echo date("M jS", strtotime(get_field('event_date', $lead->ID)));
						?> 
														
														
					</div>
					<div class='col-xs-6 '>
						<h3><u>Time</u></h3>
						<?php echo get_field( 'event_time', $lead->ID ); ?>
					</div>
					<div class='clear '></div><br>
						
						<h3><u>Location</u></h3> 
						<?php echo get_field( 'event_location', $lead->ID ); ?>
									
						<br><br>
				
				<br>
				<h4><?php echo get_field( 'event_price' , $lead->ID); ?></h4>
			

				<div class='clearfix'></div><hr>
					
						<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-rsvp btn-info btn-lg btn-block'><br> Full Details >><br><br></a>
				
						<div class='clearfix'></div>
				
				</div>
						<div class='clearfix'></div>
				
				
				<img src='<?php echo get_field( 'event_flyer', $lead->ID ); ?>' class=' img-responsive'>	
						<div class='clearfix'></div>
		</div>					
				<div class='col-sm-10 col-sm-offset-1 text-center well'>		
			
				<h3><?php echo $lead->post_title; ?></h3>
				<div class='clearfix'></div><hr>
				<div class='col-sm-2 '>	
					<?php echo get_the_post_thumbnail($lead->ID); ?>
					<br><br>
				</div>
				<div class='col-sm-7 '>			
					<div class='clearfix'></div>
					
					<div class='col-xs-6 '>
						<h5><u>Date</u></h5>

						<?php date_default_timezone_set("America/New_York"); 

						echo date("M jS", strtotime(get_field('event_date', $lead->ID)));
						?> 
														
														
					</div>
					<div class='col-xs-6 '>
						<h5><u>Time</u></h5>
						<?php echo get_field( 'event_time', $lead->ID ); ?>
					</div>
					<div class='clear '></div><br>
						
						<h5><u>Location</u></h5> 
						<?php echo get_field( 'event_location', $lead->ID ); ?>
									
						<br><br>
				
				<br>
				<h4><?php echo get_field( 'event_price' , $lead->ID); ?></h4>
			

				
						<div class='clearfix'></div>
				
				</div>
				<div class='col-sm-3 '>	
					<a href='/<?php echo $lead->post_type; ?>/<?php echo $lead->post_name; ?>' class='btn btn-rsvp btn-info btn-lg btn-block'><br> Full Details >><br><br></a>
				
				</div>
						<div class='clearfix'></div>
				
				
				<img src='<?php echo get_field( 'event_flyer', $lead->ID ); ?>' class=' img-responsive hidden'>	
						
		</div>					
			
			
			
			<div class='clearfix'></div>	
		
						
						
						<div class='clearfix'></div>
						
					
			<div class='well h4 hidden'>
						<div class='text-center'>

				
				
				<div class='col-xs-3 '><h3>Date</h3></div>
				
				<div class='col-xs-6 '><h3>Event</h3></div>
							
				<div class='col-xs-3'><h3>RSVP's</h3></div>

				
				
				
				<div class='clearfix'></div>
		

<?php 

				$current_party_date = '';
				$count = 1;
				
				


				// check if the repeater field has rows of data
				if( have_rows('party_stats' , $lead->ID ) ):

			 	// loop through the rows of data
				    while ( have_rows('party_stats',  $lead->ID ) ) : the_row();
				
				?>
				<?php if($count > 1){ continue; } ?>
				<hr>
			<div class='<?php if($count == 1){ echo "h2 current-party"; } ?> '>
				
				<div class='col-xs-3 '><?php echo get_field('event_date' ,  $lead->ID); ?></div>
				<div class='col-xs-6 '>
					<?php echo $lead->post_title; ?>
						
				</div>
				
				<div class='col-xs-3'>
					<?php echo get_field('event_rsvps' ,  $lead->ID); ?>
				</div>
				
			
				<div class='clearfix'></div>
			</div>	
		
	
				
			
				<?php
				    endwhile;

				else :

				     // no rows found

				endif;
				
				
				

?>
	</div>
						
			
						
						
						</div>
						
						
								
								<?php
		}
					
					$past = 0;
		
		?>
	
	<?php get_template_part('content','new-event'); ?>	
	
	<div class='clearfix'></div><hr>
	
	
</div>	
	
	
	
	

	
	

<?php

if( !$_GET['filter'] ){ 

		$num_posts = 30;
		if( $_GET['all'] ){ $num_posts = -1; }
		$order = 'desc';
		
		$orderby = 'modified';
		
		if( $_GET['order'] ){ $order = $_GET['order']; }
		
		$args = array( 'post_type' => 'ssi_contact'  , 'posts_per_page' => $num_posts, 'orderby'=> 'modified', 'order' => $order  );
		
		$connections = get_posts( $args );

		?>
	
		
		<hr>
		<center>
		<h4>Recent Members</h4>
		</center>
		<hr>
<?php  if ( is_user_logged_in()  ) { ?>		
			<div id='new-member' class='well contact taskcard' style='display: none;'>
		
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
<br>
					<input type="submit" class="btn btn-block" value="Add Member" />
				</div>


					
					
				</form>						

				<div class='clearfix'></div>
				<center>		
				<button id='new-member' class='btn-sm btn-default '> x close </button>
				</center>
				<div class='clearfix'></div>
		</div><!-- END Well Contact-->
				
			<div id='new-member'  style='display: block;'>
				<button id='new-member' class='btn-lg btn-block '> (+) New Member </button><br><hr>
				<div class='clearfix'></div>
			</div>
		
		
		
		
		<?php
		$count = 0;
}
			$names = array();
			$nums = array();
			$emails = array();
			
			foreach( $connections as $lead ){
				
				//if( !in_category( 'lgbteam', $lead->ID ) ){ continue; }
				/*
				
				$oldData = array( 'lead_email' ,'lead_phone' ,'lead_state' ,'lead_address' ,'lead_city' ,'lead_dob'   );
								
								$userData = array( 'MX_user_email' ,'MX_user_phone' ,'MX_user_state' ,'MX_user_address' ,'MX_user_city' ,'MX_user_dob'   );
								
								$index = 0;
								foreach ($oldData  as $param_name ) {
									
									add_post_meta( $current_user->ID, $userData[$index], "-" );
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
				//if( get_field( 'lead_city', $lead->ID ) != "Washington" )   continue; 
			
					$tot_count++;

					$public = 1;

					

					//echo "<div class='row'><div class='col-xs-6'>";
					//echo "<div class='col-xs-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){

					?>
					
<div class='contact-print '>


<?php 

	array_push( $names, $lead->post_title );
	array_push( $nums, get_field( 'MX_user_phone', $lead->ID ));


 ?>

	
<div class='clearfix'></div>
			<?php 
				
				$email = get_field('MX_user_email' ,$lead->ID);
						 $user = get_user_by_email($email);
				
				if(get_user_by_email($email)){
					
					?>

			<a  target='_blank' href='/user-profile?ID=<?php 
				
				$email = get_field('MX_user_email' , $lead->ID);
						 $user = get_user_by_email($email);
				
				echo $current_user->ID; ?>' class='btn btn-default btn-block hidden'>
				
				
					<?php echo get_avatar($current_user->ID); ?>
					View Profile
				</a>
				<?php
					
					
				}
				?>
				<div class='col-md-3 col-sm-3 text-center'> 
					
						<?php echo "" . ++$count . "<br> "; ?>
						
						
						
				
						<?php echo get_avatar($user->ID); ?>
						
						<div class='clearfix'></div><br>
					
				</div>
				<div class='col-sm-6 well'> 
					<b>Name:</b> <?php echo $lead->post_title; ?> <br>
					<b>Phone:</b> <?php
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
						
						?><br>
						
					<b>Email:</b> <?php
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
								
									?>	
								<a href="tel:<?php echo get_field( 'MX_user_email', $lead->ID ); ?>"><?php echo get_field( 'MX_user_email', $lead->ID ); ?></a>
								
								<?php
								
							}
						
						?><br>
						
					<b>Loc:</b> <?php echo get_field( 'MX_user_city', $lead->ID ); ?>
						 <?php echo get_field( 'MX_user_state', $lead->ID ); ?> <br>
				</div>
				
			
					
					
					
					
					<div class='col-xs-12 col-sm-2 '>
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
				<a target='_blank' class=' pull-right'  href='<?php echo get_field( 'website_link' , $site->ID ); ?><?php echo get_field( "MX_user_" . $site->post_name , $lead->ID ); ?>'><img width='20' src='
<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $site->post_name; ?>.png'  class=''>
</a>


			<?php 		}
			$index++;
			?>	
			<?php 		
		}
		
	?>				<div class='clearfix'></div>
						
					</div>
					
				
				<div class='col-xs-12 col-sm-2 '>	
				
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
				$current_user = $user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $current_user->roles ) ) {
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
   // echo esc_html( $categories[0]->name );
	
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
	
					
	<div class=' col-xs-12 hidden'>			
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
				
			<div class='clearfix'></div>
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
						
				<div class='clearfix'></div>		
					
						
						
						
						
		<div class="prof-info col-sm-6 hidden">
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
				<a target='_blank' class=' pull-right'  href='<?php echo get_field( 'website_link' , $site->ID ); ?><?php echo get_field( "MX_user_" . $site->post_name , $lead->ID ); ?>'><img width='20' src='
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
		<textarea name="notes"><?php echo $lead->post_content; ?></textarea>

					
					</div><br>
			
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
	
				<button name="ssi_update_cf" type="submit" class='btn btn-info btn-block' value="Update" />Update</button>
			</form>	
				

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
					echo "<a target='_blank' class=' pull-right'  href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default pull-left'>Edit Lead</a>";
				

?> 
	<div class='clearfix'></div>
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
	
	
<hr>	


<div class='clearfix'></div>

	<?php get_template_part( 'content', 'member-area' ); ?>
		<div class='clearfix'></div>
<center> 
	<br>
	<br><br>
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