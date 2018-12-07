<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 
 global $post;
?>
<div class='clearfix'></div>

	
	<?php 

		$admin_page = 0;
		if(8383 == $post->post_parent){ $admin_page=1; }
		if(10665 == $post->post_parent){ $sssixxx_page=1; }
		if( get_field( "display_social", $post->ID ) == "Yes" ){ ?>	
	<?php get_template_part( 'content', 'social' ); ?>
	
	<div class='clearfix'></div>
	<?php // get_template_part( 'content', 'contact' ); ?>
	<?php } ?>
	
	
	
	
	<div class='clearfix'></div>
	
	
	<div class='clearfix'></div>

	<?php  get_template_part('content' , 'member-area');  ?> 

	<div class='clearfix'></div>	
	
	
	<?php 
		if( get_field( "display_footer", $post->ID ) != "No" ){ ?>
		
		
		<footer id="colophon" class="site-footer hidden-print" role="contentinfo">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
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
		
			<div class="site-info hidden-print">
				&copy;<?php echo date("Y") ?> <?php bloginfo( 'name' ); ?> | Powered by <a style='text-decoration: underline;' href='http://www.youtube.com/watch?v=9W8tyczXGwI&feature=youtu.be'>Jesus</a>. | <a href='/admin'>Admin Login</a>
				
				
			</div><!-- .site-info -->
			
			
			
			
			
			
			
				<?php 
					if( get_field( "display_random_button", $post->ID ) == "Yes" ){ ?>	
				<?php get_template_part( 'content', 'random' ); ?>
				<?php } ?>
				


				<?php 
				
						if( get_field( "display_admin", $post->ID ) == "Yes" ){ ?>	
				<?php //get_template_part( 'content', 'admin' ); ?>
				<?php } ?>
				
				<?php wp_footer(); ?>
		</footer><!-- .site-footer -->
	
	<?php } ?>
	
	
	

	



	
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	

<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.js"></script>
	
	
	
<script>

jQuery(document).ready(function(){
   jQuery( "button" ).click(function() {
	var id = this.id;
	jQuery("div#" + id ).slideToggle();
	
   });
});
</script>
<script>

jQuery(document).ready(function(){
   jQuery( "button#newpost" ).click(function() {
	
	jQuery("div#post").addClass("show");
	
   });
});
</script>

<script>
jQuery(document).ready(function(){
   jQuery( "button#complete" ).click(function() {
	var id = $(this).val();
	alert(id + " Update - Coming Soon...");
	
   });
});
</script>

<script>
jQuery(document).ready(function(){
jQuery( "button.random"  ).click(function() {
	var id = $(this).val();
 	jQuery( id ).toggle( "explode" );
	
});
});
</script>

</body>

	
</html>