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
?>

	
<div class='clear'></div>
		<br><br>
			<center>
					<a href='/inc' class='text-center'><< Return Home</a>
			</center>
		<br><br>

		<footer id="colophon" class="site-footer hidden" role="contentinfo">
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
				<nav class="social-navigation hidden" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
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
		
			<div class="site-info">
				&copy;<?php echo date("Y") ?> Shaman Shawn Inc. | Powered by <a style='text-decoration: underline;' href='http://www.youtube.com/watch?v=9W8tyczXGwI&feature=youtu.be'>Jesus</a>. | <a href='/admin'>Admin Login</a>
				
				
			</div><!-- .site-info -->
			
		</footer><!-- .site-footer -->
	<div class='clear'></div>

	

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64309065-1', 'auto');
  ga('send', 'pageview');

</script>

<?php wp_footer(); ?>

<!-- jQuery library (served from Google) -->
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>

<!-- FlexSlider -->
  <script defer src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>

  <script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
	controlNav: false,
      });
    });
  </script>

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