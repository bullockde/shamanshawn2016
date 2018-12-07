<?php		

		$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {

		if( is_page('tenant-report') ){ }
		else{

		wp_reset_postdata();
		//$args = array(  'category_name' => 'songs-that-touch-the-soul' , 'posts_per_page' => -1);

		//$fix_count = 0;

		//$myposts = get_posts( $args );

		

		/*foreach ( $myposts as $post ) : setup_postdata( $post ); 
			if(!get_field('youtube_id')){ $fix_count++; }
		endforeach; 

		wp_reset_postdata();
		*/

?>
		
		<?php
		

		//$contact_form1 = GFFormsModel::get_leads( '27' );

		//contact_form2 = GFFormsModel::get_leads( '29' );
		//$night_users = GFFormsModel::get_leads( '22' );

		//$flesh_users = GFFormsModel::get_leads( '3' );


		//$contact_form = array_merge( $contact_form1, $contact_form2 );
		//echo "<br><br>SSIxXx: " . count($ssixxx_users) . " NightShow: " . count($night_users) . " Flesh: " . count($flesh_users) . "<br><br>";

		$count = 1;

		foreach($contact_form2 as $user){
			
			//print_r($user);
			//echo "<hr>" ;


/*
			//$website = "http://example.com";
$userdata = array(
	'first_name' => $user[1],
    'user_login'  =>  $user[2] ,
    'user_email'    =>  $user[3],
    'user_pass'   =>  $user[4]  // When creating an user, `user_pass` is expected.
);

$user_id = wp_insert_user( $userdata ) ;

// Create post object
*/

$content = $user[1] . " --NUM: " . $user[2] . " --ID# " . $user[3] . " --PHONE: " . $user[4] . " -- " . $user[5] . " -- EM Contact" . $user[6] . " -- JOB: " . $user[12] . " -- Employed Since: " . $user[13] . " -- Addr: " . $user[14.1] . " - " . $user[14.2] . " - " . $user[14.3] . " - " . $user[14.4] . " - " . $user[14.5] . " - " . $user[14.6];

//echo $content;
//echo "<hr>" ;

$my_post = array(
  'post_date' => $user[date_created],
  'post_title'    => $user[1],
  'post_type'    => 'tenants',
  'post_content'  => $content,
  'post_status'   => 'pending',
  'post_author'   => 1,
  //'post_category' => array( 170 )
);
 
// Insert the post into the database
$newLead = wp_insert_post( $my_post );
/*
//On success
if ( ! is_wp_error( $newLead ) ) {
    echo "Created!! : " . $newLead;
}else{  echo "Add FAILED!!"; }
//update_field( "field_58443d1806a52", $user[3] , $newLead );
//update_field( "field_561246bdee4a8", $user[3] , $newLead );

*/


/*
			//echo $count++ . " ... ";

			echo "Name:" . $user["1.3"] . " " . $user["1.6"] . ' ... <br>';

			echo "Email:" . $user[2] . ' ... <br>';
			
			echo "Phone:" . $user[3] . ' ... <br>';

			echo "Content:" . $user[4] . ' ... <br>';

			echo "Date:" . $user[date_created] . '<br>';
			
			echo "IP:" . $user[ip] . '<br>';
			*/
		}
		
		
		//echo '<hr>';
		//$leads2 = GFFormsModel::get_leads( '8' );

		
		
		
		
	?>
	
	
<div class=''>
	
	
	<?php 
	
		$form_transfers = get_posts( array(  'post_status' => 'pending', 'category' => 170 , 'posts_per_page' => -1 ) );
		
		foreach($form_transfers as $transfers){ set_post_type( $transfers->ID , 'ssi_contact' ); }
		
		$review_transfers = get_posts( array(  'post_status' => 'pending', 'category' => 171 , 'posts_per_page' => -1 ) );
		
		foreach($review_transfers as $transfers){ set_post_type( $transfers->ID , 'ssi_reviews' ); }
		
		
		//echo "-->" . count($form_transfers);
	?>
	
	
	<div class=' text-center'>
	
		<h1>Admin Area</h1>
		
		<div class='clearfix'></div><hr>
			<div class=' col-md-4'>
				<strong>Messages</strong><br>
				
				<div class='col-md-6'>
				
					<?php 
						$contacts = get_posts( array( 'post_type' => 'ssi_contact' , 'post_status' => 'pending', 'category' => 170 , 'posts_per_page' => -1 ) );
						
					?>
					<?php echo "Unread<br>" . count($contacts); ?>
				</div>
				<div class='col-md-6'>
					<?php 
						$contacts = get_posts( array( 'post_type' => 'ssi_contact' , 'category' => 170 , 'posts_per_page' => -1 ) );
						
					?>
					<?php echo "Replied<br>" . count($contacts); ?>
				</div>
				
				<div class='clearfix'></div>
				<a href='/admin/messages' class='btn btn-info btn-block' target='_blank'> All Messages >> </a>
				
			</div>
			<div class=' col-md-4'>
				<strong>Contacts</strong><br>
				<div class='col-md-6'>
					<?php 
						$contacts = get_posts( array( 'post_type' => 'ssi_contact' , 'posts_per_page' => -1 ) );
						
					?>
					<?php echo "Contacts<br>" ; ?> <?php echo count($contacts) ; ?>
				</div>
				<div class='col-md-6'>
					<?php 
						$clients = get_posts( array( 'post_type' => 'ssi_clients' ,'posts_per_page' => -1 ) );
						
					?>
					<?php echo "Clients<br>" ; ?> <?php echo count($clients) ; ?>
				</div>
				
				<div class='col-xs-12'>
				
				<a href='/admin/contacts' class='btn btn-info btn-block' target='_blank'> All Contacts >> </a>
				
				</div>
				<div class='col-xs-6 hidden'>
				
				<a href='/admin/clients' class='btn btn-info btn-block' target='_blank'> All Clients >> </a>
				</div>
				
				<div class='clearfix'></div>
			</div>
			<div class=' col-md-4'>
				<strong>Tasks</strong><br>
				<div class='col-md-6'>
					<?php 
						$contacts = get_posts( array( 'post_type' => 'ssi_tasks' ,'posts_per_page' => -1 ) );
						
					?>
					<?php echo "To-Do<br>" . count($contacts); ?> 
					
					
				</div>
				<div class='col-md-6'>
					<?php 
						$contacts = get_posts( array( 'post_type' => 'ssi_tasks' , 'post_status' => 'draft' ,'posts_per_page' => -1 ) );
						
					?>
					<?php echo "Completed<br>" . count($contacts); ?> 
				</div>
				
				<div class='clearfix'></div>
				<a href='/admin/to-do' class='btn btn-info btn-block' target='_blank'> All Tasks >> </a>
			</div>
			
			<div class='clear'><br><br><br></div>
		</div>


		<div class='col-md-4'>
		
					<h3> <a href='/projects' target='_blank'>#SSIProjects</a> </h3><hr>
			

<hr>
	<?php 
		$projects = get_posts( array('post_type' => 'ssi_projects', 'posts_per_page' => -1, 'orderby' => 'modified') );
		
		foreach($projects as $site){ 
	?>
			<b><?php echo $site->post_title; ?>:</b><span class='pull-right'><a target='_blank' href='<?php echo get_field( 'website_link', $site->ID ); ?>'>Click Here</a></span><br>
			<hr style='margin: 0;'>
	<?php 
		}
	?>
	
			<br>
			
			<div class='clearfix'></div>
		</div>

		<div class='col-md-4'>
			
			<h3>#SSIStats/Admin</h3><hr>


			<b>Trips:</b><span class='pull-right'><a target='_blank' href='/admin/report/?type=trips'>Click Here</a></span><br>
			<b>Transactions:</b><span class='pull-right'><a target='_blank' href='/admin/transactions/'>Click Here</a></span><br>
			<b>Tenants:</b><span class='pull-right'><a target='_blank' href='/admin/tenants/'>Click Here</a></span><br>
			<b>Google Ads:</b><span class='pull-right'><a target='_blank' href='https://www.google.com/adsense/'>Click Here</a></span><br>
			<b>Juicy Ads:</b><span class='pull-right'><a target='_blank' href='http://www.juicyads.com/'>Click Here</a></span><br>
			<b>ExoClick Ads:</b><span class='pull-right'><a target='_blank' href='http://www.exoclick.com/'>Click Here</a></span><br>
			<b>Google Analytics:</b><span class='pull-right'><a target='_blank' href='https://www.google.com/analytics/web/'>Click Here</a></span>
			
			<br><br>

			<h3>Webmaster Tools:</h3><hr>
			<b>GoDaddy:</b><span class='pull-right'><a target='_blank' href='https://www.godaddy.com/'>Click Here</a></span><br>
			<b>Linode:</b><span class='pull-right'><a target='_blank' href='https://www.linode.com/'>Click Here</a></span><br>	
			<b>SendGrid:</b><span class='pull-right'><a target='_blank' href='https://app.sendgrid.com/'>Click Here</a></span><br>
			<b>SMS Global:</b><span class='pull-right'><a target='_blank' href='https://mxt.smsglobal.com/login/'>Click Here</a></span><br>
			
			
			
			
		</div>


		<div class='col-md-4'>
		
			<h3>Staff Tools</h3><hr>	

			<b>Jobs:</b><span class='pull-right'><a target='_blank' href='/jobs/'>Click Here</a></span><br>
			<b>Requests: <?php echo count( $requests ); ?></b><span class='pull-right'><a target='_blank' href='/request/'>Click Here</a></span><br>
		
			<b>Newsletter:</b><span class='pull-right'><a target='_blank' href='/newsletter/'>Click Here</a></span><br>
			<b>Passwords: </b><span class='pull-right'><a target='_blank' href='/admin/passwords/'>Click Here</a></span><br>

			<b>Notes: </b><span class='pull-right'><a target='_blank' href='/admin/notes/'>Click Here</a></span>
			
			<br><br>
			
			<h3>Quick Links</h3><hr>
			
			<b>FaceBook:</b><span class='pull-right'><a target='_blank' href='https://www.facebook.com/ShamanShawnInc/'>Click Here</a></span><br>
			<b>Twitter:</b><span class='pull-right'><a target='_blank' href='https://twitter.com/shamanshawninc'>Click Here</a></span><br>
			<b>Adam4Adam:</b><span class='pull-right'><a target='_blank' href='http://www.adam4adam.com/'>Click Here</a></span><br>
			<b>BGCLive:</b><span class='pull-right'><a target='_blank' href='http://bgclive.com/'>Click Here</a></span><br>
			<b>InstaGram:</b><span class='pull-right'><a target='_blank' href='https://instagram.com/'>Click Here</a></span><br>
			
			<b>LinkedIn:</b><span class='pull-right'><a target='_blank' href='https://www.linkedin.com/pub/shaman-shawn/53/296/58b'>Click Here</a></span><br>
			<b>Youtube:</b><span class='pull-right'><a target='_blank' href='https://www.youtube.com/channel/UChPquIqMjch7rEcoSnmN_AA'>Click Here</a></span><br>
			<b>MeetUp:</b><span class='pull-right'><a target='_blank' href='http://www.meetup.com/TreatYourselfMassage/'>Click Here</a></span><br>
			<b>Rent A Friend:</b><span class='pull-right'><a target='_blank' href='http://rentafriend.com/'>Click Here</a></span><br>
			<b>Seeking Arrangement:</b><span class='pull-right'><a target='_blank' href='https://www.seekingarrangement.com/'>Click Here</a></span><br>
			<b>Air BnB:</b><span class='pull-right'><a target='_blank' href='https://www.airbnb.com/'>Click Here</a></span><br>



			<br>
			
			
		</div>
		

		<?php get_template_part('content' , 'add-post-types'); ?>
</div>

<?php 
		
		}
	}

?>
