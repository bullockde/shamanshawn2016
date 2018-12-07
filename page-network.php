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

get_header(); ?> 

	

<div class='col-md-12'>
		
					<h3><center> Our Network </center></h3><hr>
			
	<?php 
		$sites = get_posts( array('post_type' => 'ssi_projects', 'posts_per_page' => -1) );
		
		foreach($sites as $site){ 
	?>
			<b><?php echo $site->post_title; ?>:</b><span class='pull-right'><a target='_blank' href='<?php echo get_field( 'website_link', $site->ID ); ?>'>Click Here</a></span><br>
	
	<?php 
		}
	?>
	
			<br>
			
			
		</div>
		<div class='clear'> </div>
		<?php get_template_part( 'content', 'ssi-network' ); ?>

<?php get_footer(); ?>