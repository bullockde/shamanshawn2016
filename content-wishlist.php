<section id='requests' class='bg-alt text-center'>

	<div class='container'>
	
			
			<div class="page-header">
					<h2>Our Wish List</h2>
				</div>

<div class="clear"></div>
      
                <?php $args = array( 'category_name' => 'requests' , 'numberposts' => -1 );

                $rand_posts = get_posts( $args );

                foreach( $rand_posts as $post ){ ?>
            
                <div class="post well" id="post-<?php the_ID(); ?>">

				<div class=' clear'></div>
					
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
						<u>Budget</u> <br>$<?php echo get_post_meta($post->ID, 'service_max_budget', true) ?>
					</div>
                    
					
				
				<div class='clear'></div><br>
								
					<u>The WISH</u><br> 
                  <?php 
				  $my_postid = $post->ID;//This is page id or post id
					$content_post = get_post($my_postid);
					$content = $content_post->post_content;
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
					
					if( get_post_meta($post->ID, 'wish_public', true ) == "YES" ){ 
					
						echo $content; 
						
					}else{ echo "- PRIVATE -<br>" ; }
					
					
				  ?> <br>
				  
				  
				 <strong><u>STATUS</u></strong><br> Pending!
                    
					<?php if( is_user_logged_in() ){ ?> 	
						<div class='clear'></div>
						
						<div class="link"><a href="<?php the_permalink() ?>"><?php short_title('...', '34'); ?></a></div>
					
                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(240,180), array('alt' => get_the_title(), 'title' => '')); ?></a><br>
					
					<div class=' clear'></div><br>
				<u>Requested Services</u> <br><?php $services = get_post_meta($post->ID, 'service_recieved');
						foreach($services as $service) echo $service . "<br>";
				?>
					
					<u>Age</u> <br><?php echo get_post_meta($post->ID, 'ad_age', true) ?><br>
					<u>Height</u> <br><?php echo get_post_meta($post->ID, 'ad_height', true) ?><br>
					<u>Weight</u> <br><?php echo get_post_meta($post->ID, 'ad_weight', true) ?><br>
					<u>Phone</u> <br><?php echo get_post_meta($post->ID, 'client_phone', true) ?><br>
					
					<u>Email</u> <br><?php echo get_post_meta($post->ID, 'client_email', true) ?><br>
						
					<?php } ?>
				
                </div>
				
				<?php } ?>
            
            <div class="clear"></div>
			<a target='_blank' href="/wish" class="btn btn-lg btn-info btn-block">Make A WISH >>></a>
			<div class="clear"></div><br>
			
		</div>
</section>