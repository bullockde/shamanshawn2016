<?php




add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

//Lets add Open Graph Meta Info


add_theme_support('post-thumbnails'); 


function insert_fb_in_head() {
	global $post;
	
	//echo "POST TYPE:" . $post->post_type;
//print_r($post);
	if ( !is_singular()) //if it is not a post or a page
		return;
        echo '<meta property="fb:admins" content="100003777409426"/>';
	echo '<meta property="fb:app_id" content="446684948850502"/>';
	
	
	 if(get_field('youtube_id', $post->ID)){
		echo '<meta property="og:title" content="#SSIPlaylist - ' . get_the_title() . ' | #TheZone | Shaman Shawn Inc"/>';
		echo '<meta property="og:description" content="' . "#SSIPlaylist allows you to Create A Custom playlist for every Occasion .. Check it out for a minute or two!.. ;-) .. Nobody has to know.. lol " . get_the_excerpt($post->ID) . '"/>';
	}else{

		echo '<meta property="og:title" content="' . get_the_title() . ' | ' . get_bloginfo("title") . '"/>';
		echo '<meta property="og:description" content="' . "Lets Make 2018 Great! .. Thanks for your Support!.. Shaman Shawn Inc - #SSI2018 " . get_the_excerpt($post->ID) . '"/>';
	}

	
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="Shaman Shawn Inc"/>';
		
	if( $post->post_type == 'ssi_trips' || in_category( 'trips' , $post->ID ) ) { //the post does not have featured image, use a default image
		$youtube_image = "http://shamanshawn.com/wp-content/uploads/SSI-Trips-FI.png";
		echo '<meta property="og:image" content="' . $youtube_image . '"/>';
	}else if(get_field('youtube_id', $post->ID)){
		$youtube_image = "http://img.youtube.com/vi/" .  get_field('youtube_id', $post->ID) . "/0.jpg";
		echo '<meta property="og:image" content="' . $youtube_image . '"/>';
		
	}else if( has_post_thumbnail( $post->ID ) ) { //the post does not have featured image, use a default image
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}else if($post->post_type == 'ssi_jobs'){
		$youtube_image = "http://shamanshawn.com/wp-content/uploads/2015/06/job-opportunitiesss-580x297.jpg";
		echo '<meta property="og:image" content="' . $youtube_image . '"/>';
		
	}else {
		$default_image="http://shamanshawn.com/wp-content/uploads/SSI-Makover-cover-Final-meech.jpg"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
		
	}
	echo "";
	
	
	

}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

function ssi_add_user(){
	
	$lead = get_post( $_POST['ID'] ); 
	
	//print_r($lead);
	
	if( get_field( "area_code", $lead->ID ) == '215' ){ $role = 'contact_215'; }
	else if( get_field( "area_code", $lead->ID ) == '717' ){ $role = 'contact_717'; }
	else if( get_field( "area_code", $lead->ID ) == '804' ){ $role = 'contact_804'; }
	else if( get_field( "area_code", $lead->ID ) == '202' ){ $role = 'contact_202'; }
	else if( get_field( "area_code", $lead->ID ) == '404' ){ $role = 'contact_404'; }
	else if( get_field( "area_code", $lead->ID ) == '757' ){ $role = 'contact_757'; }
	else if( get_field( "area_code", $lead->ID ) == '856' ){ $role = 'contact_856'; }
	else{ $role = 'contact'; }
	
	
		$username = explode(' ', $lead->post_title);
		$email = get_field( "lead_email", $lead->ID );
		
		if( count($username) == 1 ){ $first_name = $username[0]; $last_name = ''; }
		else if( count($username) == 2 ){ $first_name = $username[0]; $last_name = $username[1]; }
		else if( count($username) == 3 ){ $first_name = $username[0]; $last_name = $username[2]; }
		else{ $first_name = ''; $last_name = ''; }
		
		
		if( get_user_by('login', $username[0] ) ){ $name = $username[0] . "_" . get_field( "area_code", $lead->ID ); }
		else{  $name = $username[0]; }
			
			$userdata = array(
				'user_login'  =>  $name,
				'role'    =>  $role,
				'user_email' => $email,
				'user_pass'   =>  NULL,  // When creating an user, `user_pass` is expected.
				
				'first_name' => $first_name,
				'last_name' => $last_name,
			);
			
		$user_id = wp_insert_user( $userdata ) ;
				

			//On success
			if ( ! is_wp_error( $user_id ) ) {
				echo "<br>User created : ". $user_id;
			}else{
				echo "<br>User Add FAILED!! ";
			}
	
	
} /** Add Users **/
function post_to_draft() 
   {
      
		$postID = $_POST['ID'];
		$postURI = $_POST['URI'];
		
		$header_loc = "Location:" + $postURI;

		  $my_post = array(
      			'ID'           => $postID,
     			 'post_status'   => 'draft',
			'URI' => $postURI
      			
 		 );

		// Update the post into the database
  		wp_update_post( $my_post );
		
		//echo "URL-----" . $postURI;

		wp_redirect( $postURI );
		exit;
	
 }//end post_to_draft

 
 function add_social(){
	 
	echo "<br> --- ENTER ADD SOCIAL ---";
	
	echo "<br> ---" . $_POST['site'] . "<br> ---" . $_POST['username'] . "<br> ---" . $_POST['ID'] ;
	
    update_field( $_POST['site'], $_POST['username'] , $_POST['ID'] ) ;

	$my_post = get_post( $_POST['ID']  );
	
	echo " THE-POST--> " ;
	print_r($my_post);

		// Update the post into the database
  	wp_update_post( $my_post );
	
	$return_page = $_POST['URI'];
	
	echo " <br>THE-PAGE--> " ;
	print_r($return_page);
	
	wp_redirect( $return_page );
	exit;
 }//end add social
 
 
function task_complete() 
   {
      
		$postID = $_POST['ID'];
		$postURI = $_POST['URI'];
		
		$header_loc = "Location:" + $postURI;
		
		
		update_field( "field_57bd3f84bf68d", $_POST['trans_date'] , $postID ); //date_complete


		  $my_post = array(
      			'ID'           => $postID,
     			 'post_status'   => 'draft',
				 
			'URI' => $postURI
      			
 		 );

		// Update the post into the database
  		wp_update_post( $my_post );
		
		//echo "URL-----" . $postURI;

		wp_redirect( $postURI );
		exit;
	
 }//end task_complete
 
function post_updater() 
   {
      
		$postID = $_POST['ID'];
		$client_id = $_POST['client_id'];

		update_field( 'client_id', $client_id, $postID );
		
		// Update the post into the database
  		wp_update_post( $my_post );
		
		wp_redirect( $postURI );
		exit;
	
 }//end post_updater

 
 function ssi_update_cf() {
	 
	 

		foreach ($_POST as $param_name => $param_val) {
			
			update_post_meta( $_POST['ID'], $param_name, $param_val  );

		}
	
		$my_post = get_post( $_POST['ID']  );
	
		$category = get_term_by('slug', $_POST['contact_type'], 'category');
		
		//print_r($category);
		wp_set_post_categories( $_POST['ID'] , $category->term_id  );
		
		$post_content = $my_post->post_content . '<br>----<br>' . current_time( 'm/d/y' ) . '<br>----<br> - ' . $_POST['post_content'];

		$post_title = $my_post->post_title;
		
		if( !empty($_POST['post_title']) ){ $post_title = $_POST['post_title']; } 
		$my_post = array(

			'ID' =>  $_POST['ID'],	
			'post_title' => $post_title,
			'post_content' => $post_content,
			'post_status' => 'publish',
			//'post_type' => $_POST['post_type']
			);
			
		// Update the post into the database
		wp_update_post( $my_post );

	
 }//end ssi_update_cf
 
 //add_action( 'save_post', 'ssi_new_contact', 10, 3 );
 function ssi_new_contact() {
	 

     // echo "New Contact Adding!!!";

	  $post_content = '-' . $_POST['post_content'];

	  
		$my_post = array(

			'ID' =>  '',	
			'post_title' => $_POST['post_title'],
			'post_content' => $post_content,
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
 
 
 
function move_out(){

		//echo "<BR><BR><BR>Move Out Function";


		$post_id = $_POST['ID'];

		//echo "--->" . $post_id;

		$date_added = $_POST['move_out_date'];

		//echo "--->" . $date_added;

		update_field( "field_56946535d781c", $date_added , $post_id );
}

function insert_client() 
   {
      
		//echo "<BR><BR><BR>Insert Client";

		$postID = $_POST['ID'];
		$client_id = $_POST['client_id'];

		$date_added = $_POST['date_added'];

		$trans_date = $_POST['trans_date'];
		$trans_amount = $_POST['trans_amount'];
		$trans_time = $_POST['trans_time'];
		$trans_service = $_POST['trans_service'];
		$trans_location = $_POST['trans_location'];

		$notes = $_POST['notes'];

		$postURI = $_POST['URI'];


		// Create post object
		$my_post = array(

		'ID' => '',		
		 'post_date'	=> $date_added,
		 'post_title' => $_POST['client_name'] ,
		 'post_content' => $notes . "--" . get_post_field('post_content', $postID) ,
		 'post_status' => 'publish'

		);

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );

		set_post_type( $post_id, $_POST['cur_post_type'] );

	if( $_POST['cur_post_type'] == 'trips'){

		update_field( "field_565e6b9158aa5", $_POST['start_date'] , $post_id );
		update_field( "field_565e6bab58aa6", $_POST['end_date'] , $post_id );
		update_field( "field_5665daffed560", $_POST['trip_state'] , $post_id );
		update_field( "field_5714c1226836d", $_POST['trip_area_code'] , $post_id );
		

		//header( $postURI );
		//exit;
		
	}
		
		//echo "New Client ID: " . $post_id;
		// Add field value
		update_field( "field_56120eb91c6ab", $_POST['client_email'] , $post_id );
		update_field( "field_561246bdee4a8", $_POST['client_phone'] , $post_id );
		update_field( "field_56120ea81c6aa", $_POST['client_city'] , $post_id );
		update_field( "field_56120e8a1c6a9", $_POST['client_state'] , $post_id );
		update_field( "field_5620520a18334", $_POST['trans_amount'] , $post_id );
		update_field( "field_567d5212671f3", $_POST['area_code'] , $post_id ); 


	$new_post = get_post( $post_id );
	$last_date = date("m/d/y", strtotime($new_post->post_date) );

	//echo "-->" . $last_date;
	
	if( $_POST['last_seen'] != '' ){
		update_field( "field_5656666d84821", $_POST['last_seen'] , $post_id );
	}else{
		update_field( "field_5656666d84821", $last_date , $post_id );
	}

	if( $_POST['last_contacted'] != '' ){
		update_field( "field_5656669d84822", $_POST['last_contacted'] , $post_id );
	}else{
		update_field( "field_5656669d84822", $last_date , $post_id );
	}

	if( $trans_date != '' ){
		$field_key = "field_56415f3cbceaf";
		$value = get_field( $field_key, $post_id );
		$value[] = array("date" => $trans_date , "location" => $trans_location , "time" => $trans_time , "service" => $trans_service , "trans_id" => $postID ,"rate" => $trans_amount );
		update_field( $field_key, $value, $post_id );

		
	}

		
		//echo "THIS POST ID: " . $postID;
		update_field( "field_56512b1afcceb", $post_id , $postID );

		//wp_reset_query();
		
		//wp_redirect( $postURI );
		//exit;
	
 }//end insert_client
 
function ssi_insert_post() {
	 

      //echo "New Connection Adding!!!";

	  $post_content = '-' . $_GET['post_content'];

	  
		$my_post = array(

			'ID' =>  '',	
			'post_title' => $_GET['post_title'],
			'post_content' => $post_content,
			'post_status' => 'publish',
			'post_type' => $_GET['post_type']
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
	
	//$category = get_term_by('slug', $_POST['contact_type'], 'category');
		
		//print_r($category);
	//	wp_set_post_categories( $new_contactID , $category->term_id  );

		// Update the post into the database
  //	wp_update_post( $new_contactID );
	
	//$return_page = $_POST['URI'];
	
	//echo " <br>THE-PAGE--> " ;
	//print_r($return_page);
	
	
	// Update the post into the database
  	
	wp_publish_post( $new_contactID );
	
	
 }//end ssi_new_contact
 
function insert_task() 
   {
      
		//echo "<br><br><br><br>-->INSERT TASK<br><br>";

	//	wp_reset_query();
		// Update post 37
		$postID = $_POST['ID'];
		$client_id = $_POST['client_id'];


		$date_added = $_POST['trans_date'];

		//echo "DATE-->" . $date_added;

		$date_added = date('Y-m-d H:i:s', strtotime($date_added) );

		//echo "DATE-->" . $date_added;

//exit;
		$trans_amount = $_POST['trans_amount'];
		$trans_time = $_POST['trans_time'];
		$trans_service = $_POST['trans_service'];
		$trans_location = $_POST['task_details'];

		$postURI = $_POST['URI'];

		//echo "Post URI-->" . $postURI;

		// Create post object
		$my_post = array(
		  
		  'ID' => '',
		 'post_date'	=> $date_added,
		 'post_title' => $_POST['trans_service'] ,
		 'post_content' => $_POST['notes'] . ' <br>--' . $_POST['task_details'] ,
		 'post_status' => 'publish'

		);
		

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );
		
		foreach ($_POST as $param_name => $param_val) {
			add_post_meta($post_id, $param_name, $param_val, true);
			update_post_meta( $post_id, $param_name, $param_val  );

		}
		
		set_post_type( $post_id, 'to_do' );

		//echo "--->New Transaction ID: " . $post_id;
		// Add field value
		update_field( "field_56202cbadb9a0", $_POST['client_phone'] , $post_id );
		update_field( "field_56202ce4db9a1", $_POST['client_city'] , $post_id );
		update_field( "field_56202cf5db9a2", $_POST['client_state'] , $post_id );
		update_field( "field_56202d2fdb9a4", $trans_amount , $post_id );
		update_field( "field_563b012c7be2a", $_POST['income_expense'] , $post_id );
		update_field( "field_56549946e545f", $trans_service , $post_id );
		update_field( "field_56549914e545d", $trans_time , $post_id );
		update_field( "field_56549930e545e", $trans_location , $post_id );
		update_field( "field_577e669017e48", $_POST['assigned_to'] , $post_id );
		
		$field_key = "field_56415f3cbceaf";
		$value = get_field( $field_key, $postID);

		
		$value[] = array("date" => date("m-d-Y", strtotime($date_added) ) , "location" => $trans_location , "time" => $trans_time , "service" => $trans_service, "trans_id" => $post_id , "rate" => $trans_amount );
		update_field( $field_key, $value, $postID );

		//echo "THIS POST ID: " . $postID;
		update_field( "field_56512b1afcceb", $post_id , $postID );


		update_field( "field_56512b1afcceb", $client_id , $post_id );
		//update_field( "last_contacted", $date_added , $post_id );

		
		//echo "<br><br><br><br>-->INSERT TRANSACTION DONE<br><br>";


		//wp_reset_query();
		
		//header( $postURI );
		//exit;
	
 }//end insert_transaction

function insert_transaction() 
   {
      
		//echo "<br><br><br><br>-->INSERT TRANSACTION<br><br>";

	//	wp_reset_query();
		// Update post 37
		$postID = $_POST['ID'];
		$client_id = $_POST['client_id'];

	
		$date_added = $_POST['trans_date'];

		//echo "DATE-->" . $date_added;

		$date_added = date('Y-m-d H:i:s', strtotime($date_added) );

		//echo "DATE-->" . $date_added;

//exit;
		$trans_amount = $_POST['trans_amount'];
		$trans_time = $_POST['trans_time'];
		$trans_service = $_POST['trans_service'];
		$trans_location = $_POST['trans_location'];

		$postURI = $_POST['URI'];

		//echo "Post URI-->" . $postURI;

		// Create post object
		$my_post = array(
		  
		  'ID' => '',
		 'post_date'	=> $date_added,
		 'post_title' => $_POST['client_name'] ,
		 'post_content' => get_post_field('post_content', $postID) ,
		 'post_status' => 'publish'

		);
		

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );
		
		set_post_type( $post_id, 'ssi_transactions' );
		
		foreach ($_POST as $param_name => $param_val) {
			add_post_meta($post_id, $param_name, $param_val, true);
			update_post_meta( $post_id, $param_name, $param_val  );

		}

		//echo "--->New Transaction ID: " . $post_id;
		// Add field value
		update_field( "field_56202cbadb9a0", $_POST['client_phone'] , $post_id );
		update_field( "field_56202ce4db9a1", $_POST['client_city'] , $post_id );
		update_field( "field_56202cf5db9a2", $_POST['client_state'] , $post_id );
		update_field( "field_56202d2fdb9a4", $trans_amount , $post_id );
		update_field( "field_563b012c7be2a", $_POST['income_expense'] , $post_id );
		update_field( "field_56549946e545f", $trans_service , $post_id );
		update_field( "field_56549914e545d", $trans_time , $post_id );
		update_field( "field_56549930e545e", $trans_location , $post_id );
		update_field( "field_57467e24917c2", $_POST['meeting_place'] , $post_id );
		
		if( $_POST['trans_amount'] != '' ){
		
			$field_key = "field_56415f3cbceaf";
			$value = get_field( $field_key, $postID);

		
			$value[] = array("date" => date("m-d-Y", strtotime($date_added) ) , "location" => $trans_location , "time" => $trans_time , "service" => $trans_service, "trans_id" => $post_id , "rate" => $trans_amount , "income_expense" => $_POST["income_expense"] );
			update_field( $field_key, $value, $postID );
	
		}

		//echo "THIS POST ID: " . $postID;
		update_field( "field_56512b1afcceb", $post_id , $postID );


		update_field( "field_56512b1afcceb", $client_id , $post_id );
		//update_field( "last_contacted", $date_added , $post_id );

		
		//echo "<br><br><br><br>-->INSERT TRANSACTION DONE<br><br>";


		//wp_reset_query();
		
		//header( $postURI );
		//exit;
	
 }//end insert_transaction

function insert_song() 
   {
      
		echo "<BR><BR><BR>Insert Song";

		$postID = $_POST['ID'];
		$postURI = $_POST['URI'];

		// Create post object
		$my_post = array(

		 'ID' => '',		
		 'post_date'	=> $_POST['date_added'] ,
		 'post_title' => $_POST['song_name'] ,
		 'post_content' => '',
		 'post_status' => 'publish'

		);

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );

		if( $_POST['cur_post_type'] == 'video') { set_post_type( $post_id, 'video' ); }
		else{ set_post_type( $post_id, 'music' ); }
		

		set_post_format( $post_id , 'video' );

		// Add field value
		update_field( "field_56059e2a326c2", $_POST['youtube_id'] , $post_id );
	

	//	wp_reset_query();
		
		//wp_redirect( $postURI );
		//exit;
	
 }//end insert_song

function checkVideoExists( $videoId ) {
        $headers = get_headers('http://img.youtube.com/vi/' . $videoId . '/default.jpg');
        if (!strpos($headers[0], '200')) {
           // echo "The YouTube video you entered does not exist";

	  $my_post = array(
      			'ID'           => $videoId,
     			 'post_status'   => 'draft',
			'URI' => $postURI
      			
 		 );

		// Update the post into the database
  		wp_update_post( $my_post );
            return false;

        }
	return true;
}
add_action('wp_enqueue_scripts', 'my_register_javascript', 100);

function my_register_javascript() {
  wp_register_script('mediaelement', plugins_url('wp-mediaelement.min.js', __FILE__), array('jquery'), '4.8.2', true);
  wp_enqueue_script('mediaelement');
}
?>