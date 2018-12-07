<?php get_header(); ?>
   
    <div class="main">
    
        <div class="container">
		
			<div class="single-post text-center" id="post-<?php the_ID(); ?>">

			<?php if(have_posts()) { ?>
   
                <?php while (have_posts()) : the_post(); ?>                    

                
					<br>
					 <h2 class="post-title"><?php wp_title(""); ?></h2>   <hr>
					 
				 <a href='/request' class="btn btn-danger btn-lg">Request A Session >></a>
				  
				  
				<div id='new-review' style='display: none; text-align: center;'>
					<hr>
                    <?php the_content(); ?> 
				</div>

				 
				 
			<?php endwhile; ?>
                    
                <div class="clear"></div><hr>
      <?php get_template_part( 'content', 'help-page' ); ?>
                <?php 
				
				
				
				$args = array( 'category_name' => 'requests' , 'numberposts' => -1 );

                $rand_posts = get_posts( $args );

                foreach( $rand_posts as $post ){ ?>
            
                <div class="post well" id="post-<?php the_ID(); ?>">


                        <strong>Session Request</strong>
				<div class=' clear'></div><br>
					<div class='col-md-3 col-xs-6'>
						<u>Date</u> <br><?php echo get_post_meta($post->ID, 'service_date', true) ?>
					</div>
					<div class='col-md-3 col-xs-6'>
						<u>Time</u> <br><?php echo get_post_meta($post->ID, 'service_time', true) ?>
					</div>
				<div class=' clear visible-xs'><br></div>
					<div class='col-md-3 col-xs-6'>
						<u>Length</u> <br><?php echo get_post_meta($post->ID, 'service_length', true) ?>
					</div>
					<div class='col-md-3 col-xs-6'>
						<u>Budget</u> <br>$<?php echo get_post_meta($post->ID, 'service_min_budget', true) ?> - $<?php echo get_post_meta($post->ID, 'service_max_budget', true) ?>
					</div>
                    
					<div class=' clear'></div><br>
				<u>Services Recieved</u> <br><?php $services = get_post_meta($post->ID, 'service_recieved');
						foreach($services as $service) echo $service . "<br>";
				?>
				
				<div class='clearfix'></div><br>
								
					<u><b>Experience</b></u> <br> 
                  <?php 
				  $my_postid = $post->ID;//This is page id or post id
					$content_post = get_post($my_postid);
					$content = $content_post->post_content;
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
					echo $content;
				  
				  ?> <br>
                    
					<?php if( is_user_logged_in() ){ ?> 	
						<div class='clearfix'></div>
						
						<div class="link"><a href="<?php the_permalink() ?>"><?php short_title('...', '34'); ?></a></div>
					
                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(240,180), array('alt' => get_the_title(), 'title' => '')); ?></a><br>
					
					<u>Age</u> <br><?php echo get_post_meta($post->ID, 'ad_age', true) ?>
					<u>Height</u> <br><?php echo get_post_meta($post->ID, 'ad_height', true) ?>
					<u>Weight</u> <br><?php echo get_post_meta($post->ID, 'ad_weight', true) ?>
					<u>Phone</u> <br><?php echo get_post_meta($post->ID, 'client_phone', true) ?>
					
					<u>Email</u> <br><?php echo get_post_meta($post->ID, 'client_email', true) ?>
						
					<?php } ?>
				
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
