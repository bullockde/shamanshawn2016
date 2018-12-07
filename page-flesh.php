<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 */

get_header(); ?>



<section id="ITF" class="flesh container">
<br>
<?php

	the_title( '<header class="entry-header"><h1 class="entry-title text-center">', '</h1></header><!-- .entry-header -->' );
	

	
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}

	
?>


	<div id="primary" class="content-area">
		<div id="content" class="" role="main">
			
			
<!--  #####################   START Filter  ##############-->
	<div id='ITF-filter' class='filter center'>
			
		<form id="ITF-filter" method="post" action="">
			
			
			<select name="ITFmonth">
				<option value="1">Month</option>
				<option value="1">Jan</option>
				<option value="2">Feb</option>
				<option value="3">Mar</option>
				<option value="4">Apr</option>
				<option value="5">May</option>
				<option value="6">June</option>				
				<option value="7">Jul</option>
				<option value="8">Aug</option>
				<option value="9">Sept</option>
				<option value="10">Oct</option>
				<option value="11">Nov</option>
				<option value="12">Dec</option>				
				
			</select>
			
			<select name="ITFyear">
				<option value="16">Year</option>
				<option value="16">2016</option>
				<option value="15">2015</option>
				<option value="14">2014</option>
				<option value="13">2013</option>
				<option value="12">2012</option>
				<option value="11">2011</option>
				<option value="10">2010</option>
				
			</select>
				
			<input type="submit">
				
			
		</form>
		<br><br><hr>
	</div>
<!--  #####################   END Filter  ##############-->
			<?php
				
				$month = $_POST['ITFmonth'];
				print_r( $month );
				$year = $_POST['ITFyear'];
				print_r( $year );
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					
				
					get_template_part( 'content', 'page' );
					
				?>
				

				<?php
				

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
				
			?>
		<br>
		</div><!-- #content -->
	</div><!-- #primary -->
	

</section><!-- #main-content -->

<?php

get_footer();