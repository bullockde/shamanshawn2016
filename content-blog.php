<section id='blog' class='visible-xs1 visible-md1'>
	<div class='container'>
			<div class="text-center">
				<h2>Blog Posts</h2><br>
			</div>
			<div class="well text-center">
					
					<?php
$args = array( 'posts_per_page' => 4 );

		$count = 1;
		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			
			<div class='col-md-3 blog-post'>
				<a href="<?php the_permalink(); ?>">
					
						<?php 
						  the_post_thumbnail('small', array( 'class' => 'img-responsive ','alt' => get_the_title(), 'title' => ''));
						
						the_title(); ?>
						
						<div class='visible-xs visible-sm'><hr></div>
					
				</a>
				<div class='clearfix'></div><br>
			</div>
		<?php
			
			if( ($count % 4) == 0 ){ ?> <div class='clear hidden-xs hidden-sm'></div> <?php }
			$count++;
		endforeach; 
		wp_reset_postdata();?>
		<div class='clearfix'></div>
						

			
		</div>
		
				<a href='/blog' class='btn-block btn btn-lg btn-warning'>View All >></a>
	</div><!-- // container -->		
</section><!-- // Blog SPace -->