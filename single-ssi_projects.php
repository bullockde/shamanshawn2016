<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

 
get_header(); ?> 


<div class='container'> 
	<br><br>
	
	<div  class="col-md-12">
		<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
			?>
			
			
			<div class='col-md-4'> 
				<?php twentysixteen_post_thumbnail();  ?>
			</div>
			<div class='col-md-8'> 
				
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title hidden-xs">', '</h1>' ); ?>
					<?php the_title( '<h1 class="entry-title text-center visible-xs">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				
				
				<div class=' clear'></div>
				<div class='col-xs-5'>
				<b>Project Contact:</b>
				
				</div>
				<div class='col-xs-7'> 
					<a href="<?php echo get_field('project_contact_link', get_the_ID() ); ?>" target="_blank"><?php echo get_field('project_contact', get_the_ID() ); ?></a>
					
				</div>
				<div class='clear'><br></div>
				<div class=' clear'></div>
				<div class='col-xs-5'>
				<b>Website Link:</b>
				
				</div>
				<div class='col-xs-7'> 
					<a href="<?php echo get_field('project_link', get_the_ID() ); ?>" target="_blank"><?php echo get_field('project_link_title', get_the_ID() ); ?></a>
					
				</div>
				<div class='clear'><br></div>
				<div class=' clear'></div>
				<div class='col-xs-5'>
				<b>Project Date:</b>
				
				</div>
				<div class='col-xs-7'> 
					<?php echo get_field('project_start_date', get_the_ID() ); ?>
					 -- <?php if( get_field('project_start_date', get_the_ID() ) != 'on-going' ){ echo "Current";}else{ echo get_field('project_end_date', get_the_ID() ); } ?>
					
				</div>
				<div class='clear'><br></div>
				
			</div>
			<div class='clear'> <hr> </div>
	</div>
	
	
	
	<div class=' col-md-12 monthly report'>

			
				<?php 

				// check if the repeater field has rows of data
				if( have_rows('stats_highlights' , get_the_ID() ) ):

			 	// loop through the rows of data
				    while ( have_rows('stats_highlights', get_the_ID() ) ) : the_row();
				
				?>
				
				<h2 class='text-center'><?php echo get_sub_field('month'); ?> 2017 - Monthly Report</h2><hr>
				

			       <div class='col-sm-7 '>Homepage Snapshot<br><br><img src='<?php echo get_sub_field('homepage'); ?>'><br><br></div>
				<div class='col-sm-2 col-xs-6'><u>Site Statistics</u><br><br><?php the_sub_field('stats_chart'); ?></div>
				
				<div class='col-sm-3 col-xs-6'><u>Top 5 States</u><br><br><?php 
				
				$count = 1;
				 
				while ( have_rows('stats_top_5_states', get_the_ID() ) ) : the_row();
				
					echo $count++ . ". ";
					the_sub_field('state'); 
					echo "<hr style='margin: .7em 0;'>";
					
				 endwhile;
				 
				 ?>
				 <br>
				 <u>Top 5 Pages</u><br><br><?php 
				 
				 $count = 1;
				 while ( have_rows('stats_top_5_pages', get_the_ID() ) ) : the_row();
					
					echo $count++ . ". ";
				?>
					<a target='_blank' href='<?php echo get_field('project_link', get_the_ID() ); ?><?php the_sub_field('page_link'); ?>'>
					<?php the_sub_field('page_link'); ?>
					</a>
					<hr style='margin: .7em 0;'>
					
				<?php
					
				 endwhile;
				 
				 ?>
				 </div>
				<div class='visible-xs'><br></div>
				
				
				<?php 
					$client_profit += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT));
					$total_amount += str_replace(['+', '-'], '', filter_var( get_sub_field('rate') , FILTER_SANITIZE_NUMBER_INT)); ?>
				<div class='clear'></div>
				<hr>
				

				<?php
				    endwhile;

				else :

				    // no rows found

				endif;

?>
			
	
	</div>
	
	
	
	<div  class="clear"></div>
	
	<div  class="col-md-8">
		
			
			<?php
			
			
			the_content();
			
			
			echo "<div class='clear'></div><br><br>";
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				if ( is_singular( 'attachment' ) ) {
					// Parent post navigation.
					the_post_navigation( array(
						'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen' ),
					) );
				} elseif ( is_singular( 'post' ) ) {
					// Previous/next post navigation.
					the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentysixteen' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Next post:', 'twentysixteen' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentysixteen' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Previous post:', 'twentysixteen' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					) );
				}

				// End of the loop.
			endwhile;
			?>


		<?php //get_sidebar( 'content-bottom' ); ?>
		
		

	</div><!-- .content-area -->

	<div class='col-md-4'> 
		<center>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- SSI2018_300_600_sky -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:300px;height:600px"
				 data-ad-client="ca-pub-9799103274848934"
				 data-ad-slot="9445055504"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</center>
		<div class='text-center'> Advertisement </div>
	</div>
	
	
	
	<div class='clear'></div><br><br><hr>
		<?php get_template_part( 'content', 'projects' ); ?>
</div>
<?php get_footer(); ?>