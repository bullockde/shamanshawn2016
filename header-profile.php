<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.js"></script>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/profile-style.css">
	
	<?php get_template_part( 'ad' , 'google-code' ); ?>
	<?php
	
	
		if( get_field( "header_ad" ) != "Off" ){  
		
			get_template_part( 'ad' , 'google-pagelevel' );
		}
				
				
				
	if( $_POST['post_to_draft'] ){
			post_to_draft();
		}elseif( $updater = $_POST['updater'] ){ 
			//echo "<BR><BR>POST UPDATER--->";
			post_updater();
		}elseif( $_POST['insert_client'] ){ 
			//echo "<BR><BR>POST UPDATER--->";
			insert_client();

		}elseif( $_POST['ssi_insert_post'] ){ 

			ssi_insert_post();
		}elseif( $_POST['insert_transaction'] ){ 
			//echo "<BR><BR>Heder - Insert Trans--->";
			insert_transaction();
		}elseif( $_POST['insert_task'] ){ 
			//echo "<BR><BR>Heder - Insert Trans--->";
			insert_task();
		}elseif( $_POST['task_complete'] ){ 
			//echo "<BR><BR>Heder - Insert Trans--->";
			task_complete();
		}elseif( $_POST['insert_song'] ){ 
			//echo "<BR><BR>Insert Song--->";
			insert_song();
		}elseif( $_POST['move_out'] ){ 
			//echo "<BR><BR>Insert Song--->";
			move_out();
		}elseif( $_POST['ssi_update_cf'] ){ 
			//echo "<BR><BR>Insert Song--->";
			ssi_update_cf();
		
		}elseif( $_POST['ssi_new_contact'] ){ 
			//echo "<BR><BR>Insert Song--->";
			ssi_new_contact();
		
		}elseif( $_POST['ssi_add_user'] ){ 
			//echo "<BR><BR>Insert Song--->";
			ssi_add_user();
		
		}elseif( $_POST['add_social'] ){ 
			//echo "<BR><BR>Insert Song--->";
			add_social();
		
		}elseif( $_POST['fix'] ){
			
				$friends = get_posts( array( 'post_type' => 'friends' , 'posts_per_page' => -1 ) );
				$leads = get_posts( array( 'post_type' => 'leads' , 'posts_per_page' => -1 ) );
				$clients = get_posts( array( 'post_type' => 'clients' , 'posts_per_page' => -1 ) );
			
				$fixers = array_merge($friends,$clients,$leads);

			
			foreach($fixers as $fix){
				if( get_field( 'lead_city', $fix->ID ) == "Richmond" ){ 
					update_field( "field_567d5212671f3", "804" , $fix->ID ); //area_code
				}else if( get_field( 'lead_city', $fix->ID ) == "Lancaster" ){ 
					update_field( "field_567d5212671f3", "717" , $fix->ID ); //area_code
				}else if( get_field( 'lead_city', $fix->ID ) == "Harrisburg" ){ 
					update_field( "field_567d5212671f3", "717" , $fix->ID ); //area_code
				}else if( get_field( 'lead_city', $fix->ID ) == "Philadelphia" ){ 
					update_field( "field_567d5212671f3", "215" , $fix->ID ); //area_code
				}else if( get_field( 'lead_state', $fix->ID ) == "VA" ){ 
					update_field( "field_567d5212671f3", "757" , $fix->ID ); //area_code
				}else if( get_field( 'lead_state', $fix->ID ) == "PA" ){ 
					update_field( "field_567d5212671f3", "215" , $fix->ID ); //area_code
				}else if( get_field( 'lead_state', $fix->ID ) == "DC" ){ 
					update_field( "field_567d5212671f3", "202" , $fix->ID ); //area_code
				}else if( get_field( 'lead_state', $fix->ID ) == "MD" ){ 
					update_field( "field_567d5212671f3", "202" , $fix->ID ); //area_code
				}else if( get_field( 'lead_state', $fix->ID ) == "GA" ){ 
					update_field( "field_567d5212671f3", "404" , $fix->ID ); //area_code
				}
			}

		}
		
		if($_POST['new_event']){
		echo "NEW EVENT!!";
		

				
		$name = $_POST['post_title'];
		
		$catID = get_cat_ID( 'Upcoming Events' );
			//$category =  get_the_category($EventID);
			
			
			$cats = array();
			
			array_push($cats, $catID);
		
		// Create post object
		$my_post = array(
		  'post_title'    => $name,
		  'post_type'  => 'ssi_events',
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => $cats
		);
		 
		// Insert the post into the database
		$postID = wp_insert_post( $my_post );
		
		
		add_post_meta($postID , 'event_date', $_POST['event_date'] );
		
		$start_time = date("ga", strtotime($_POST['event_start'])); 
		
		add_post_meta($postID , 'event_start', $start_time );
		
		$end_time = date("ga", strtotime($_POST['event_end'])); 
		
		add_post_meta($postID , 'event_end', $end_time );
		
		$event_time = $start_time . " - " . $end_time;
		
		add_post_meta($postID , 'event_time', $event_time );
		
		add_post_meta($postID , 'event_location', $_POST['event_location'] );
	
		wp_publish_post( $postID ); 
		wp_update_post( $postID ); 
		
		
		
	}
	
	if($_POST['new_tasklist']){
	
	$date_added = date('Y-m-d H:i:s', strtotime($_POST['date_added']) );
// Create post object
		$my_post = array(
		  
		  'ID' => '',
		 'post_date'	=> $date_added,
		 'post_type' => $_POST['post_type'] ,
		 'post_title' => $_POST['post_title'] ,
		 'post_content' => $_POST['notes'] . ' <br>--' . $_POST['task_details'] ,
		 'post_status' => 'publish'

		);
		

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );
		
		foreach ($_POST as $param_name => $param_val) {
			add_post_meta($post_id, $param_name, $param_val, true);
			update_post_meta( $post_id, $param_name, $param_val  );

		}
		
		//set_post_type( $post_id, 'ssi_staff' );
		
}





 if($_POST['new_post']){
	
	//$date_added = date('Y-m-d H:i:s', strtotime($_POST['date_added']) );
// Create post object
		$my_post = array(
		  
		  'ID' => '',
		// 'post_date'	=> $date_added,
		 'post_type' => $_POST['post_type'] ,
		 'post_title' => $_POST['post_title'] ,
		'post_content' => '',
		 'post_status' => 'publish'

		);
		

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );
		
		foreach ($_POST as $param_name => $param_val) {
			add_post_meta($post_id, $param_name, $param_val, true);
			update_post_meta( $post_id, $param_name, $param_val  );

		}
		
		//set_post_type( $post_id, 'ssi_staff' );
		
}


	?>
<?php get_template_part('ad' , 'google-code'); ?>
	
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<div class="site-header-main">
				<div class="site-branding hidden">
					<?php //twentysixteen_the_custom_logo(); ?>

					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

			
			</div><!-- .site-header-main -->

			
			
			<?php
				if( get_field( "display_menu", $post->ID ) != "No" ){   
				
			?>
		<header id="masthead" class="site-header" role="banner">	
			
			
			<div class="col-xs-8 col-md-4"> 
				<div class="">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php  echo $description; ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
			</div>
			<div class="col-xs-4 col-md-8"> 
				
				<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'twentysixteen' ); ?></button>
				
			</div>

				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
					

					<div id="site-header-menu" class="site-header-menu">
					
					
					
					<div class='clear visible-xs'></div>
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'menu_class'     => 'primary-menu',
									 ) );
								?>
							</nav><!-- .main-navigation -->
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>',
									) );
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>
					</div><!-- .site-header-menu -->
					
						<div class="clear"></div>
						


						<div class='clearfix'></div>

						</header><!-- .site-header -->
				<?php endif; 
				
				}
				?>
		
			
			
									<?php
	if( get_field( "display_header", $post->ID ) == "Yes" ){  
	
?>
			
			<?php if ( get_header_image() ) : ?>
				<?php
					/**
					 * Filter the default twentysixteen custom header sizes attribute.
					 *
					 * @since Twenty Sixteen 1.0
					 *
					 * @param string $custom_header_sizes sizes attribute
					 * for Custom Header. Default '(max-width: 709px) 85vw,
					 * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
					 */
					$custom_header_sizes = apply_filters( 'twentysixteen_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
				?>
				<div class="header-image">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				</div><!-- .header-image -->
			<?php endif; // End header image check. ?>


		<div class="clear"></div>

<?php	}	 ?>	

	
						
<div class='clearfix'></div>

<?php

	if( get_field( "display_tagline", $post->ID ) == "Yes" ){  
	
?>

	<section class='tag-line welcome'>
			<center><a href='/'> <img src='/wp-content/uploads/ShamanShawn-nolink-transparent.png' class='header img-responsive'>
		<!-- Spiritual & LifeStyle<br> -->
		<h4>Healer. Entrepreneur. Life Coach.</h4></a> </center>
		<a target='_blank' href='/music/biz-markie-just-a-friend/#primary'> <img style='position: absolute; right: 15px; top: 225px;' width='50px' class='pull-right visible-xs1 hidden' src='/wp-content/uploads/African-American-Baby-sml200.png'></a> 
		
		<div class='clearfix'></div>
	</section>
<?php
	}
	
?>
	
		</header><!-- .site-header -->

	
