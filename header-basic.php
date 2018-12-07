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

?>
<?php 



	if( $_POST['post_to_draft'] ){
			post_to_draft();
		}elseif( $updater = $_POST['updater'] ){ 
			//echo "<BR><BR>POST UPDATER--->";
			post_updater();
		}elseif( $_POST['insert_client'] ){ 
			//echo "<BR><BR>POST UPDATER--->";
			insert_client();
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

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" style='min-width: 900px;'>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

	
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>



	
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
	
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '446684948850502',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<?php get_template_part('ad' , 'google-code'); ?>
</head>




<body <?php body_class(); ?> >


		<a class="skip-link screen-reader-text" href="#content"><?php  _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<header id="masthead" class="site-header hidden1" role="banner">
		
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
				<div class="header-image hidden1">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				</div><!-- .header-image -->
			<?php endif; // End header image check. ?>
			
			<div class="header text-center">

				
			</div>
			
			<div class="site-header-main hidden-print">
				<div class="site-branding">
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

				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
					<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'twentysixteen' ); ?></button>

					<div id="site-header-menu" class="site-header-menu">
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
			</div><!-- .site-header-main -->

			
		</header><!-- .site-header -->
