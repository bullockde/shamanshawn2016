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

<div id="main-content" class="main-content">

<?php
	
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}

	
?>
	
			<hr>
		
			
		<div class='col-md-6'><img src='http://shamanshawn.com/wp-content/uploads/SSI-Logo-Banner-New-QR.png' class='img-responsive aligncenter pull-right' width='350'></div>
		<div class='col-md-6'>
			
			<h4><u>2nd Meeting - Sept 1, 2016</u> (Outline)</h4>
			<div class='clear'></div>
			<div class='h4'>
				1. Purpose / Goal<br>
				2. Announcements / Events <br>
				3. Staff Ratings <br>
				4. HOUSE Tracker<br>
				5. Q&A / Comments<br>
				6. Company Stats<br>
				7. Goal Tracker<br>
				8. Company (Investing)

			</div>
		</div>

<div class='hidden '>
<h3><center>Shaman Shawn Inc’s <br>First Meeting (Outline)</center></h3><br>
<center>July 7, 2016</center><br><hr>
<center>
<ul class='h4 hidden'>
	<li>1. Purpose / Goal<br></li>
	<li>2. Announcements<br></li>
	<li>3. Upcoming Events<br></li>
	<li>4. HOUSE Tracker<br></li>
	<li>5. Goal Tracker</li>

</ul>
</div>		

</center>
<div class='clear'></div>

<hr>
				<div class='clear'></div>

<h1 class='entry-title'><center>#SSI Mission Tracker 5000</center></h1> <hr>

<div class='col-md-8'>
	<img src='http://shamanshawn.com/wp-content/uploads/SSI-HOUSE.png' class='img-responsive aligncenter'>
</div>
<div class='col-md-4'>
	<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();?>

			
				<?php
						the_content();
					//get_template_part( 'content', 'page' );

					
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						//comments_template();
					}
				endwhile;
			?>
</div>

<div class='clear'></div>

<hr>

<?php get_template_part('content', 'ssi-banner-ad'); ?>


<h3><center>H.O.U.S.E Tracker</center></h3>
<div class='clear'></div>

<hr>


<div class='well col-md-4 mh-425 '>Bills / Budget<hr>

	<div class='col-md-4'>Bill<hr></div>
	<div class='col-md-4'>Amount<hr></div>
	<div class='col-md-4'>Due<hr></div>
<div class='clear'></div>

<hr>
	<div class='col-md-4'> House Taxes </div>
	<div class='col-md-4'> $1686.47 </div>
	<div class='col-md-4'> ASAP</div>
<div class='clear'></div>

<hr>
	<div class='col-md-4'> PECO Electric </div>
	<div class='col-md-4'> $1200 </div>
	<div class='col-md-4'> ASAP </div>
	
<div class='clear'></div>

<hr>
	<div class='col-md-4'> Water Bill </div>
	<div class='col-md-4'> $1591.19 </div>
	<div class='col-md-4'> ASAP </div>

<div class='clear'></div>
	
<hr>
	<div class='col-md-8'> Total </div>
	<div class='col-md-4'> $4477.66 </div>
<div class='clear'></div>
</div>
<div class='well col-md-4 mh-425'>Shopping List<hr>

	<ul>
		<li>Replace Beers</li>
		<li>Replace Vodka</li>
		<li>Bowls</li>
	</ul>
</div>
<div class='well col-md-4 mh-425'>Maintenance<hr>
	<ul>
		<li>Trash Weekly</li>
		<li>Sweep Weekly</li>
		
	</ul>
</div>

<div class='clear'></div>

	
	</div><!-- #primary -->
	<?php // get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
	}else{ 
	
		wp_login_form();  
	}
	
get_footer('admin');

?> 