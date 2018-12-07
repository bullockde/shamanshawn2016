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

$tasklist_ID = 0;


if( $_GET['ID'] ){ 

	$tasklist_ID = $_GET['ID'] ; 

	?>
	<?php
	//$staff = get_posts( array( 'post_type' => 'ssi_staff', 'posts_per_page' => -1 , 'order' => 'desc') );
	$tasklists = get_posts( array( 'post_type' => 'ssi_tasks', 'posts_per_page' => -1 , 'order' => 'desc') );

?>


	<?php the_title( '<header class="entry-header text-center"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' ); ?>
	
	<div class='h4 ' style='text-transform: capitalize; text-align: center;'>
				
					<?php echo get_the_title( $_GET['ID'] ) ; ?>
			
					<?php
		if( !$_GET['print'] ){
			?>
			<center>
			<a href='?ID=<?php echo $_GET['ID']; ?>&person=<?php echo $_GET['person']; ?>&print=1' class='hidden-print btn btn-default btn-sm'>Print</a>
			</center>
			<?php
			}
		?>	
		</div>

	
	<?php
	
}

 ?>

<div id="main-content" class="main-content report">

<?php
	
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}

?>


		<?php 	
		
		$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {
		
		
			//echo $author->user_nicename;
	if( !$_GET['print'] ){
		get_template_part('content','goals');
		
	}
		get_template_part('content','tasklist');
		

		?>
		
			<hr>


		<?php		


				echo "<div id='latest'></div><br><br>";

			?>
	
			
			
<div class='clearfix'></div>


			<?php edit_post_link( __( 'Edit', 'twentysixteen' ), '<span class="edit-link">', '</span>' ); ?>
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();?>

			
				<?php
						the_content();
					//get_template_part( 'content', 'page' );

					
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>

		
</div><!-- #primary -->

<div class='clearfix'></div><hr>

	


<?php

}else{ ?>
		
			<div class='container'>
			<?php echo do_shortcode("[wpmem_form login]"); ?><hr>
			<?php echo do_shortcode("[wpmem_form register]"); ?>
			</div>
			
	<?php }
//get_sidebar();
get_footer();