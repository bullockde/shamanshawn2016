<div class='clear'></div>

<button id='whatsnew2' class='explode btn random btn-block'>Another Button</button>
					
					
	<div id='whatsnew2' class='random well' style='display: none;'>
		<?php
				wp_reset_query();
				query_posts(array('orderby' => 'rand', 'posts_per_page' => 1));
				
				$count = 0;
				if (have_posts()) :
				while (have_posts()) : the_post(); 
				
					if( $count++ >= 1 )continue;
			?>
				
			<div class='text-center'>
				<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			<?php

		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
		$thumb_url = $thumb_url_array[0];


		 if ( $thumb_url == 'http://shamanshawn.com/wp-content/uploads/Home2016-featured.png' ){


		} else { 

			echo "<center>";
				twentysixteen_post_thumbnail(); 
			echo "</center>";
		}

	?>
			
				<?php
					$format = get_post_format( get_the_ID() );

					if( $format == 'video' || in_category( 'music' , get_the_ID() ) || in_category( 'songs-that-touch-the-soul' , get_the_ID() ) ){
					get_template_part( 'template-parts', 'content-video' );
					}else{
					the_content(); 
					}
				?>
			</div>
		<?php get_template_part( 'content', 'random-3' ); ?>
	<?php 
	
		wp_reset_query();
		endwhile;
		endif; ?>
	</div>

	<div class='clear'></div>