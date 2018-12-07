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
 
 	//if( is_front_page() && isset($_COOKIE["site_entered"]) ){ $pg = "/profile/"; wp_redirect($pg); exit; }
	
	//if( is_user_logged_in() && is_page('join') ){ $pg = "/profile/"; wp_redirect($pg); exit; }
	
	//if( is_user_logged_in() && is_page('login') ){ $pg = "/profile/"; wp_redirect($pg); exit; }
	
	
	
		
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
		
		}
		
			$requests = get_posts( 
				
					array(	
						'category_name' => 'requests',
						'posts_per_page'   => -1,  
						'post_status'                => 'publish',
						//'date_query' => array(  'before' => '1 month ago'  ) 
					) 
				);
				foreach( $requests as $request ){ set_post_type( $request->ID, 'ssi_requests' ); }

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
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	


<!-- Google Analytics Code -->		

<?php  get_template_part( 'ad', 'google-analytics-code' ); ?>

<!-- END Google Analytics Code -->	
</head>

<body <?php body_class(); ?>>

		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<div class="">
				<div class="text-center">
				

					<?php if ( is_front_page() && is_home() ) : ?>
					
					<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>

					
						<h1 class="site-title hidden"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
					
					<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>

					
						<p class="site-title hidden"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description' );
					
					 ?>
						<p class="description hidden"><?php echo $description; ?></p>
					<?php ?>
				</div><!-- .site-branding -->

				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?><center>
					<button id="menu-toggle" class="menu-toggle text-center hidden"><?php _e( 'Menu', 'twentysixteen' ); ?></button>
					</center>
					<div id="site-header-menu" class="site-header-menu text-center hidden">
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
				<?php endif; ?>
				
				<center><a href='/'><< Return Home</a></center>
			<!--	
				<hr>
					
					<center>
		This Blog has <u><?php $args = array(
						
							//'number' => -1,
							//'meta_key' => 'wp-last-login',
							//'orderby'  => 'meta_value_num',
							//'orderby'  => 'registered',
							'order' => 'DESC',
							//'date_query' => array( array( 'after' => '12/25/16' ) )  ,
							
						) ;
						
						$ordered_users =  new WP_User_Query( $args );

						
						$blogusers = $ordered_users->get_results();
						
						$total_results = count($blogusers);
						
						echo $total_results;
						
						?></u> Followers!
						</center>
						-->
						<hr>
			</div><!-- .site-header-main -->

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
		</header><!-- .site-header -->

		<div id="content" class="site-content">
