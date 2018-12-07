<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div class='clearfix'></div>
<article id="post-<?php the_ID(); ?>" class='container'>	

	<?php
		// Page thumbnail and title.
		//twentysixteen_post_thumbnail();
		//the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
	?>

	<br>

	<div class="">
		<div class='hidden'>
			<div class='col-xs-6'>
				<?php the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' ); ?>
			</div>	
			<div class='col-xs-6'>
				<button id='newpost' class='btn btn-lg btn-default pull-right'>New Post</button>
			</div><div class='clearfix'></div>
			<hr>
		</div>

		<div id='newpost' class='clear' style='display: none;'>
		<?php		

				echo do_shortcode('[gravityform id="11" name="Request Line"]');

				echo "<div id='latest'></div><br><br>";

			?>
		</div>
			
		<div class='col-md-2'><h2>Date</h2></div>
		<div class='col-md-6'><h2>Title</h2></div>
		<div class='col-md-2'><h2>Details</h2></div>
		<div class='col-md-2'><h2>Apply</h2></div><br>
			<hr>
			<?php	
			//	the_content();

/*********************************************************/


			// The Query

			$args = array( 

				'post_type' => 'request',
				'posts_per_page' => -1

			 );
			$leads2 = get_posts( $args );

			//print_r( $leads2 );
			foreach( $leads2 as $lead ){
					

					$public = 1;

					
					
					//echo "<hr>";
					//echo "-->" . strcmp( $lead["24"] , "Private Request (will NOT be shown on the website)" );

					//echo "<div class='row'><div class='col-md-6'>";
					//echo "<div class='col-md-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( $lead->post_status == 'publish' ){
					?>
					<div class='col-md-2'> <?php echo mysql2date('n/j/y', $lead->post_date ); ?><span class='pull-right'><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span></div>
					<div class='col-md-6'><?php if($lead->post_title){ echo $lead->post_title; }else{ echo 'New Request'; } ?></div>
					<div class='col-md-2'><button id='details<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>Details</button></div>
					<div class='col-md-2'><a target='_blank' href='<?php echo "/apply?title=" . $lead->post_title ; ?>' class='btn btn-default btn-block'>Apply</a></div>

				<?php

					echo "<br><br><div id='details" . $lead->ID .  "' class='details' style='display: none;' >";
					
					/*if( $lead["2.3"] ){
					echo "<b>Location: </b> " . $lead["2.3"] . ", " . $lead["2.4"] . " " . $lead["2.5"] . "<br><br>";
					}else	{
					echo "<b>Location:</b> Philadelphia, PA<br>";
					}*/
					echo "<div class='col-xs-6' ><b>Posted By: </b> " . get_field( 'username', $lead->ID ) . "</div>"; 
					echo "<div class='col-xs-6' ><b>Budget: </b>  $" . get_field( 'request_budget', $lead->ID ) . "</div>"; 

					?>

		<form method="post" action="" class='pull-right'>
			<button name="update" type="submit" class='btn ' value="Request Complete" />Request Complete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>

				<?php
					echo "<div class='clearfix'></div><br>";
					echo "<div class='col-xs-12' ><b>Description: </b> " . $lead->post_content . "</div>";
					
					echo "<div class='clearfix'></div><br>";
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default'>Edit Request</a>";

					echo "<a target='_blank' href='/apply?title=" . $lead->post_title . "' class='btn btn-default'>Apply Now!</a>";

					
					
								

					echo "<br></div><hr>";
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 
					
				}
				echo "<br><br>";
				//print_r( $leads );


			// Reset Query
			wp_reset_query();


/*********************************************************/

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
		?>
	
	</div><!-- .entry-content -->
	<div class='clearfix'></div>
</article><!-- #post-## -->
<div class='clearfix'></div>