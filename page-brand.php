<?php
/**
 * Template Name: Basic Layout
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

	

	<?php 
	
		if( is_page('projects') ){
			
			?><br><br><br>
			<center>
			<img title='Projects' src='/wp-content/uploads/SSI-Projects-header.png'>
			</center><br>
			<?php 
			
			
		}
		$projects = array();
		$sites = array();
		//twentysixteen_post_thumbnail();

		echo "<hr>";
			if( get_field( "display_title", $post->ID ) == "No" ){   }else{ 
			
				the_title( '<h1 class="entry-title text-center">', '</h1>' ); 

			}

		echo "<hr>";
	$count = 0;
	
	$post_type = "ssi_" . $post->post_name;
	if(is_page('brands')){
		$args = array( 

				'post_type' => $post_type,
				'category_name' => 'ssibrands',
				'posts_per_page' => -1,
				'orderby' => 'modified'

			 );
	}else{
			 $args = array( 

				'post_type' => $post_type,
				
				'posts_per_page' => -1,
				'orderby' => 'modified'

			 );
	}
			 
		
			$leads = get_posts( $args );
			
			
			$count = 0;
			
			foreach($leads as $brand){
				?> 
				<div class='col-md-6'> 
					<div class='col-md-offset-2 col-md-8'> 
					<?php
					
						echo get_the_post_thumbnail( $brand->ID);
						
					
					?>
					</div>
				</div>
				
				<div class='col-md-5'> 
				<?php
					
					//echo get_the_post_thumbnail($brand->ID);
					echo "<h3>" . $brand->post_title . "</h3>";
					echo "<p>" . $brand->post_excerpt . "</p>";
				?>
					<div class='clear'><br><br></div>
					
					<div class=' clear'></div>
				<div class='col-xs-5'>
				<b>Project Contact:</b>
				
				</div>
				<div class='col-xs-7'> 
					<a href="<?php echo get_field('project_contact_link', $brand->ID ); ?>" target="_blank"><?php echo get_field('project_contact', $brand->ID ); ?></a>
					
				</div>
				<div class='clear'><br></div>
				<div class=' clear'></div>
				<div class='col-xs-5'>
				<b>Website Link:</b>
				
				</div>
				<div class='col-xs-7'> 
					<a href="<?php echo get_field('project_link', $brand->ID ); ?>" target="_blank"><?php echo get_field('project_link_title', $brand->ID ); ?></a>
					
				</div>
				<div class='clear'><br></div>
				<div class=' clear'></div>
				<div class='col-xs-5'>
				<b>Project Dates:</b>
				
				</div>
				<div class='col-xs-7'> 
					<?php echo get_field('project_start_date', $brand->ID ); ?>
					 -- <?php if( get_field('project_start_date',$brand->ID ) != 'on-going' ){ echo "Current";}else{ echo get_field('project_end_date', $brand->ID ); } ?>
					
				</div>
				
				<div class='clear'><br></div>
		<!--		<div class='col-md-5'> 
				<b>Highlights:</b>
				</div>
				<div class='col-md-7'> 
					<?php echo get_field('project_budget', get_the_ID() ); ?>

				</div>
		
				<div class='clear'><br></div>
				<div class='col-md-12'>
				<a href='/web' class='btn btn-default'> Web Hosting </a>
				
				</div>
		-->			<div class='clear'><hr></div>
					<a href='/<?php echo $post_type; ?>/<?php echo $brand->post_name; ?>' class='btn btn-info btn-block'>More Details >> </a>
				</div>
				
			
				
				<?php
				$count++;
				if( ($count % 1) == 0 ){ ?> <div class='clear'><hr></div> <?php }
			}
	
	 ?>


<div id="primary" class="">
	<main id="main" class="container" role="main">	



		<?php


		//$args = array( 'post_type' => 'ssi_clients' , 'posts_per_page' => -1 );
		//$leads = get_posts( $args );
			 

		//print_r($leads);

		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			//get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				//comments_template();
			}

			// End of the loop.
		endwhile;
		?>
		
		

	</main><!-- .site-main -->
	
	

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>