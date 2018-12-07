<?php get_header(); ?>
   
    <div class="main">
    
        <div class="container">
		
			<div class="single-post text-center" id="post-<?php the_ID(); ?>">

			<?php if(have_posts()) { ?>
   
                <?php while (have_posts()) : the_post(); ?>                    

                
					<br>
					 <h2 class="post-title"><?php wp_title(""); ?></h2>   <hr>
					 
				 <button id='new-review' class="btn btn-danger btn-lg">Submit A Review</button>
				  
				  
				<div id='new-review' style='display: none; text-align: center;'>
					<hr>
                    <?php the_content(); ?> 
				</div>

				 
				 
			<?php endwhile; ?>
                    
                <div class="clear"></div><hr>
 <?php if( is_user_logged_in() ){ 
 
	$args = array( 'post_type' => 'ssi_reviews' , 'post_status' => 'pending' , 'posts_per_page' => -1 );
}else{ 
	$args = array( 'post_type' => 'ssi_reviews' , 'posts_per_page' => -1 );
}

                $rand_posts = get_posts( $args );

                foreach( $rand_posts as $post ){ ?>
            
                <div class="post well" id="post-<?php the_ID(); ?>">
                    
					
					<div class="link"><a href="<?php the_permalink() ?>"><?php //short_title('...', '34'); ?></a></div>
					
                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php // the_post_thumbnail(array(240,180), array('alt' => get_the_title(), 'title' => '')); ?></a><br>
                    
                    <?php if ( get_post_meta($post->ID, 'duration', true) ) : ?><div class="duration"><?php echo get_post_meta($post->ID, 'duration', true) ?></div><?php endif; ?>
                        
                    
                    
				
				
					<div class='hidden'>
						<u><b>Overall Rating</b></u> <br><?php echo get_post_meta($post->ID, 'service_rating', true) ?>
					</div>
					<div class='clear'></div><br>
								
					<u><b>Client Feedback</b></u> <br> 
                  <?php 
				  $my_postid = $post->ID;//This is page id or post id
					$content_post = get_post($my_postid);
					$content = $content_post->post_content;
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
					echo $content;
				  
				  ?> <br>
				
					<div class='hidden'>
                        <strong>Session Stats</strong>
				<div class=' clear'></div>
					<div class='col-md-4 col-xs-6'>
						<u>Date</u> <br><?php echo get_post_meta($post->ID, 'service_date', true) ?>
					</div>
					<div class='col-md-4 col-xs-6'>
						<u>Time</u> <br><?php echo get_post_meta($post->ID, 'service_time', true) ?>
					</div>
				<div class=' clear visible-xs'></div>
					<div class='col-md-4 col-xs-12'>
						<u>Length</u> <br><?php echo get_post_meta($post->ID, 'service_length', true) ?>
					</div>
                    
					<div class=' clear'></div><br>
				<u>Services Recieved</u> <br><?php echo get_post_meta($post->ID, 'service_recieved', true) ?>
                    </div>
                </div>

				<?php } ?>
            
            <div class="clear"></div>
                    
                <?php }
        
                else { ?>
        
                    <h2>Sorry, no posts matched your criteria</h2>
        
                <?php } ?>
				
			</div>

		
		
        </div>
        <div class="clear"></div>
        
    </div>
    
<?php get_footer(); ?>
