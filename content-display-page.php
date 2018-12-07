<?php
/**
 * The template used for displaying "Display" page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	
	<?php
		if( is_front_page() ){ ?>



			<!--<ul class="bxslider">
  				<li><img src="http://shamanshawn.com/wp-content/uploads/2015/09/ssi-cards-maret-branding-slide.png" /></li>
  				<li><img src="http://shamanshawn.com/wp-content/uploads/2015/09/ssi-cards-header1.png" /></li>
  				<li><img src="http://shamanshawn.com/wp-content/uploads/2015/09/SSIList-slide.png" /></li>
  				<li><img src="http://shamanshawn.com/wp-content/uploads/2015/09/ssi-cards-header1.png" /></li>
			</ul>-->
	<?php
			//echo do_shortcode('[print_responsive_slider_plus_lightbox]');

			//wp_cycle();
			// Page thumbnail and title.
			
		}else{
			twentyfourteen_post_thumbnail();
		}
		
	    if( !is_front_page() ){
		the_title( '<br><header class="entry-header-display"><h1 class="entry-title text-center">', '</h1></header><!-- .entry-header -->' );
		}
	?>
	
	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->