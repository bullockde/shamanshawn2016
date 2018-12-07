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

get_header();

$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {

		
	?>
	<br><br>
<div class="content">

			

	<?php
			get_template_part('content', 'admin');
	
	
				// Start the Loop.
				while ( have_posts() ) : the_post();?>

			
				<?php
						the_content();
				

					
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
			
			<div class='clearfix'></div><hr>

	
</div><!-- #main-content -->

<?php

		
	}
	
		 
	
	
	
?> 
	
<?php	
get_footer();

?> 