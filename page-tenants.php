<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header('no-ads');


		
	?>
	<br><br>
<div id="main-content" class="">

			
				<h1 class='text-center entry-title'>Tenant Portal</h1>
				
				<div class='clearfix'></div><hr>

	<?php
	
	$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {

	
		get_template_part( 'content', 'page-tennants' );
		
			//get_template_part('content', 'admin');
	
	
				// Start the Loop.
				while ( have_posts() ) : the_post();?>

			
				<?php
						the_content();
					//get_template_part( 'content', 'admin' );

					
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						//comments_template();
					}
				endwhile;
			?>
			
			<div class='clearfix'></div><hr>

	<?php echo do_shortcode("[wpmem_form login]"); ?>
</div><!-- #main-content -->

<?php

		
	}else{ ?>
		
			<div class='container'>
			
				<div class='clearfix'></div>
		
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
			
	<?php }
	
get_footer();

?> 