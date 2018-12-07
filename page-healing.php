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
<br><br>
<?php 
		
			if( get_field( "display_title", $post->ID ) == "No" ){   
		
					//Nothing
			}else{ 

				the_title( '<h1 class="entry-title text-center">', '</h1>' ); 

			}
		
		 ?><hr>
<div class='clear'></div>

<div  class="single-post companion container">
			<div id='healing'></div>
		<div class='col-md-5'>

			
			
			<img src='http://man-x-scape.com/wp-content/uploads/2016/11/man-x-scape-healing.jpg' class='img-responsive'>
			<br>
			
		</div>
		<div class='col-md-7'>
		

				Energy Healing is all about accepting that you are an energy being. A being that is much more complicated than just a physical body. A being that exists in multiple dimensions at the same time. Accepting and understanding this, we can then utilise various techniques to restore your energy flow to the optimum balance across all those dimensions.  <br> <br> 

			<strong>I Heal using a Variety of Techniques:</strong>

	
			<ul>
				<li>Reiki</li>
				<li>I.E.T</li>
				<li>Massage</li>
				<li>Meditation</li>
				<li>Energy Work</li>
				<li>Kenesthetic Healing</li>
			</ul>
					<br>
					
						<center>
			<br><small>( Any Budget - Any Time )</small><br>
					<a target='_blank' href="/book" class="btn btn-lg btn-danger">Request A Session >></a></center>
		</div>
		
		
	
	</div>
	
	<div class='clear'> </div><br><br>
			

	</div><!-- // container -->
<?php get_template_part('content', 'ssi-banner-ad'); ?>

	<?php //get_template_part('content', 'coaching'); ?>
	
<section id='coaching' class='services coaching hidden1'>
		
		<div class='container'>
		<h2>S.H.A.M.E - 2 - F.A.M..E Personal Coaching</h2><hr>
			<div class="col-md-6">
			
				<img class='img-responsive aligncenter' src='/wp-content/uploads/SHAME-results.png'> 
				
				<iframe width="100%" height="250" src="https://www.youtube.com/embed/ZjMvqfAOVyQ" frameborder="0" allowfullscreen></iframe>
				
				

				
			</div>
			<div class="col-md-6">
				
				
				My Life Coaching Program  that I refer to as "SHAME2FAME Coaching" is hand written and was developed and organized by me starting in 2015 and has evolved over time. The program is designed to Assist people in getting where "THEY Want To Go" as it relates to the  <br> <br> 

			<strong>8 Major Areas of Life:</strong>
&nbsp;
	
			<ul>
				<li>Home (Physical Environment)</li>
				<li>Career</li>
				<li>Money</li>
				<li>Health</li>
				<li>Romance</li>
				<li>Fun &amp; Leisure</li>
				<li>Friends &amp; Family</li>
				<li>Personal Growth</li>
			</ul>
					<br>
				More info can be found at 

					<a target='_blank' href='/coaching/' class='btn btn-md btn-warning'>SHAME 2 FAME</a>
					 
				
			</div>
		</div>
	
</section><!--  #Services  -->
	
	
<?php get_footer(); ?>