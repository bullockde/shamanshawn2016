<?php 
/*
Template Name: Users Profile Page
*/




get_header();



$userid = $_GET['ID'];
$user = get_userdata( $userid );

if( is_user_logged_in() && empty($_GET['ID']) ){ 

$user = wp_get_current_user();

}

$current_user = wp_get_current_user();

 ?>


<div class='col-sm-12'>

	<br><br>
	<div class='row info'>
	
	
		<div class='col-sm-6 text-center'>
		
			<div class='col-sm-4'>
					<a href="/user-profile/?ID=<?php echo $user->ID; ?>"><?php echo $user->display_name; ?></a>
									<br><br>
									
				<?php 
				
					if( get_field( 'facebook' , $lead->ID ) != '' ){
						
						
				?>
						<img src="http://graph.facebook.com/<?php echo get_field( 'facebook' , $lead->ID ); ?>/picture" class="hidden img-responsive">
					<?php 

					}

				echo '<a href="/user-profile/?ID=' . $user->ID . '">' . get_avatar($user->ID, 96) . "</a><br>";
				
				 		
					?>
			</div>
			<div class='col-sm-8'>
					
				<div class='clearfix'></div>
							
							
							<br><b>Address:</b> 
					
							<?php 
							if( is_user_logged_in() && get_user_meta($user->ID, 'MX_user_address', "user_" . $user->ID) ){ 
								echo get_user_meta($user->ID, 'MX_user_address', "user_" . $user->ID); 
							
							}else{
								
								echo "- UNKNOWN -" ;
							}
							
							?> 
							
							
							<br>
							<b>Location: </b>
							<?php 
					
												
										$closet = 0;
										if ( is_user_logged_in() &&  get_user_meta($user->ID, 'MX_user_city', 1 ) && get_user_meta($user->ID, 'MX_user_state', 1) ){

																				echo ' <span style="text-transform: capitalize;">' . get_user_meta($user->ID, 'MX_user_city', 1 ) . '</span>, ';
																				echo get_user_meta($user->ID, 'MX_user_state', 1) ;

										}
										else if ( is_user_logged_in() &&  get_user_meta($user->ID, 'MX_user_state', 1) ){
											echo  get_user_meta($user->ID, 'MX_user_state', 1);
										}
										else{
											$closet = 1;
											echo '- UNKNOWN -';
		}				
							
							?>
								 
							
							
							<br><b>Phone#:</b> 
					
							<?php 
							if( is_user_logged_in() &&  get_user_meta($user->ID, 'MX_user_phone', "user_" . $user->ID) ){ 
								echo get_user_meta($user->ID, 'MX_user_phone', "user_" . $user->ID); 
							
							}else{
								
								echo "- UNKNOWN -" ;
							}
							
							?> 
							<br><br><center><b><u>Email</u></b> <br>
							<?php 
							if( is_user_logged_in() &&  get_user_meta($user->ID, 'MX_user_email', "user_" . $user->ID) ){ 
								echo get_user_meta($user->ID, 'MX_user_email', "user_" . $user->ID); 
							
							}else{
								
								echo "- UNKNOWN -" ;
							}
							
							?> </center>
							<div class='clearfix'></div><hr>
			</div>
		</div>
	
		<div class='col-sm-6 '>
	
				<div class='clearfix'></div>
						
							<div class='clearfix'></div><hr>
							

				
				<div class='col-xs-6'>
					<u>Member Since</u><br><br>
					<?php 
					$format = apply_filters( 'wpll_date_format', get_option( 'date_format' ) );
					
					echo mysql2date($format, $user->user_registered ); ?>
				</div>
				<div class='col-xs-6'>
					<u>Last Logged In</u><br><br>
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
	
			
			<div class='col-sm-6 '>


				
				
				
				
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
					
				
			</div>
			<div class='col-sm-6 text-right'>
			<div class='clearfix'></div><hr>
								<?php 
								
								$current_user = wp_get_current_user();
									$admin_user = 0;
										$allowed_roles = array('editor', 'administrator');
									if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {
										$admin_user = 1;
										
										$userid = $_GET['ID'];
										$user = get_userdata( $userid );
										
									}
														
								
								if(  is_user_logged_in() && (  ($userid == $user->ID) || $admin_user ) ){ ?>
								<a href='/edit-profile/?ID=<?php echo  $user->ID; ?>' class='btn btn-warning btn-block'>Edit Profile</a>
								<div class='clearfix'></div>
								<?php } ?>
								<a target='_blank' class='btn btn-danger btn-block' href='/mailbox/?pmaction=newmessage&to=<?php echo $user->ID; ?>'><div class='pmessage upper bold white'>Private Message</div></a>
				
				<div class='clearfix'></div><hr>
				
				<div class='col-xs-6 hidden '>

					<button id='payments' class='btn btn-default btn-block'>Payments</button>
					
				</div>
				<div class='col-xs-6  hidden'>

					<button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>More</button>
					
				</div>

					<div class='clearfix'></div>

			</div>
		</div>
		
	<?php  if( is_user_logged_in() ){ ?>		
		
<!-- *************************************************** -->		

<div class='clearfix'></div>



			<div id='taskslist' style='display: none; '>
		<h3 class='text-center alert-success'><br>Tasklist<br><br></h3> 
		
			<?php get_template_part('content','user-tasklist'); ?>
			
			<div class='clearfix'></div>
			
			
			
			 <form method='post' class='well hidden'>
				<h4 class='text-center underline'>New TASK</h4>
				 <input type='text' name='post_title' placeholder='Enter Title'>
				 <input type='hidden' name='post_type' value='ssi_tasks'>
				 
				  <input type='hidden' name='post_author' value='<?php echo $_GET['ID']; ?>'>
				 
				 
				 <input type='hidden' name='new_post' value='true'>
				 <input type='submit' value='Add New' class='btn-block'>
			 </form>
				 
				 
	</div>	

	<div id='wishlist' style='display: none; '>
		<h3 class='text-center alert-warning'><br>Wishlist<br><br></h3> 
		
			<?php get_template_part('content','user-wishlist'); ?>
			
			<div class='clearfix'></div>
			
			
			
			 <form method='post' class='well hidden'>
			 
				<h4 class='text-center underline'>New WISH</h4>
				 <input type='text' name='post_title' placeholder='Enter Title'>
				 <input type='hidden' name='post_type' value='ssi_wishlists'>
				 
				  <input type='hidden' name='post_author' value='<?php echo $_GET['ID']; ?>'>
				 
				 
				 <input type='hidden' name='new_post' value='true'>
				 <input type='submit' value='Add New'>
			 </form>
			 
			 
	</div>

	

<?php  } ?>	
</div>





	
<?php if( is_user_logged_in() ){ ?>		
	
	
	
	<div class='clearfix'></div><br><br>

	<div class='col-xs-6'>
		<button id='taskslist' class='btn btn-default btn-block hidden-print'>Taskslist</button>
		
		
		 <form method='post' class='well'>
			 
				<h4 class='text-center underline'>New TASK</h4>
				 <input type='text' name='post_title' placeholder='Enter Title'>
				 <input type='hidden' name='post_type' value='ssi_tasks'>
				 
				  <input type='hidden' name='post_author' value='<?php echo $_GET['ID']; ?>'>
				 
				 
				 <input type='hidden' name='new_post' value='true'>
				 <input type='submit' value='Add New' class='btn-block'>
			 </form>
			 
		
		<button id='payments' class='btn btn-default btn-block hidden-print hidden'>Payments</button>
		<button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block hidden-print hidden'>More</button>
	</div>
	<div class='col-xs-6'>
		<button id='wishlist' class='btn btn-default btn-block hidden-print'>Wishlist</button>
		
		
		
		 <form method='post' class='well'>
			 
				<h4 class='text-center underline'>New WISH</h4>
				 <input type='text' name='post_title' placeholder='Enter Title'>
				 <input type='hidden' name='post_type' value='ssi_wishlists'>
				 
				  <input type='hidden' name='post_author' value='<?php echo $_GET['ID']; ?>'>
				 
				 
				 <input type='hidden' name='new_post' value='true'>
				 <input type='submit' value='Add New' class='btn-block'>
			 </form>
			 
			 
			 
			 
		<button id='rental' class='btn btn-default btn-block hidden-print hidden'>Rental Info</button>
		<button id='forms' class='btn btn-default btn-block hidden-print hidden'>Forms</button>
		
		<button id='notes' class='btn btn-default btn-block hidden hidden-print'>Notes</button>
		
	</div>
	
<div class='clearfix'></div><hr><br><br>
	
	
<?php } ?>	
	




	<div class='clearfix'></div>
		
		
		
<?php
if( is_user_logged_in() && current_user_can( 'manage_options' ) ){
		$args = array(
		   'public'   => true,
		   '_builtin' => false
		);

		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'

		//$post_types = get_post_types( $args, $output, $operator ); 

		foreach ( $post_types  as $post_type ) {
			
			
			
			
			

			$type_name = get_post_type_object($post_type);
			
			//print_r($type_name);
			
		   
		   
		   $all = get_posts( array(
					'post_per_page' => 10,
					'author' => $_GET['ID'],
				   'post_type' =>  $post_type,
				));
				
				
				
		if( count($all) == 0  ){ continue; }		
		
				echo '<hr>' . $type_name->labels->name . '<hr>';
				
				foreach ( $all  as $lead ) {
					?>
					<a target='_blank' href='/?p=<?php echo $lead->ID; ?>' class='btn btn-block btn-default'><span class='pull-left'> <?php echo $lead->post_title; ?> </span><span class='pull-right'>GO >> </span>
						<div class='clearfix'></div>
					</a>
					<?php
				}
				
		//		 echo '<p>' . $post_type . '</p>';
				 
				 ?>
				 <form method='post'>
					 <input type='text' name='post_title' placeholder='Enter Title'>
					 <input type='hidden' name='post_type' value='<?php echo $post_type; ?>'>
					 
					  <input type='hidden' name='post_author' value='<?php echo $_GET['ID']; ?>'>
					 
					 
					 <input type='hidden' name='new_post' value='true'>
					 <input type='submit' value='Add New'>
				 </form>
				 
					<a target='_blank' href='/?p=<?php echo $lead->ID; ?>' class='btn btn-block btn-info'>See All></a>
					<?php
					
					
					
					
					
					
					
		}
		
}else{
	get_template_part('content' , 'member-area');
}

?>
		
		
		
				<div class='clearfix'></div>



<br><br>	

	<div class="paginator ">
		<center>															
			<a class='pull-left' href='/people'>
				&lsaquo; ALL Members
			</a>
			<a class='pull-right' href='/user-profile/?ID=<?php echo ($userid+1);?>'>
				Next >>
			</a>
		</center>
			<div class='clearfix'></div>
     </div>
<br><br>

	

<?php get_footer(); ?>