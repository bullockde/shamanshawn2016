<div class='clear'></div>	
	
	<div class="stats">
	
	
		<?php $args = array(
						
							//'number' => -1,
							//'meta_key' => 'wp-last-login',
							//'orderby'  => 'meta_value_num',
							//'orderby'  => 'registered',
							'order' => 'DESC',
							//'date_query' => array( array( 'after' => '12/25/16' ) )  ,
							
						) ;
						
						$ordered_users =  new WP_User_Query( $args );

						
						$blogusers = $ordered_users->get_results();
						
						$total_results = count($blogusers);
						
				
				
			
			
			$fantasies = get_posts(array(  'post_type' => 'ssi_fantasies' , 'posts_per_page' => -1 , 'post_status' => array('publish', 'pending'), 'category_name' => 'fantasy' )); 
			$blogs = get_posts(array(  'post_type' => 'post' , 'posts_per_page' => -1 )); 
			$events = get_posts(array(  'post_type' => 'ssi_events' , 'posts_per_page' => -1 )); 
			$models = get_posts(array(  'post_type' => 'ssi_models' , 'posts_per_page' => -1 , 'post_status' => array('publish', 'pending') ));
			$projects = get_posts(array(  'post_type' => 'ssi_projects' , 'posts_per_page' => -1 ));
			$photos = get_posts(array(  'post_type' => 'ssi_photos' , 'posts_per_page' => -1 ));
			$videos = get_posts(array( 'post_type' => 'ssi_videos' , 'posts_per_page' => -1 ));
			$requests = get_posts(array( 'post_type' => 'ssi_requests' , 'post_status' => array('draft' , 'pending', 'publish') , 'posts_per_page' => -1 ));
			$thots = get_posts(array(  'post_type' => array('ssi_models', 'ssi_requests') , 'posts_per_page' => -1 , 'orderby' => 'modified', 'order' => 'asc' , 'post_status' => array('publish', 'pending') ));
			//$series = get_posts(array(  'category_name' => 'series', 'posts_per_page' => -1 )); 
			
			$series =  get_categories('child_of=226&hide_empty=1');
		?>
		
		<div class="col-md-2 col-xs-6 text-center  ">
			<a target='black' href='/blog'>						
			<figure>
			  <img src="/wp-content/uploads/2016/11/reviews-1-e1478870034226.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($blogs); ?></h3> <h4>Blogs ></h4></figcaption>
			</figure>
			</a>
		</div>
		<div class="col-md-2 col-xs-6 text-center   hidden">
			<a target='black' href='/models'>						
			<figure>
			  <img src="/wp-content/uploads/2016/11/reviews-1-e1478870034226.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($series); ?></h3> <h4>Series ></h4></figcaption>
			</figure>
			</a>
		</div>	
		<div class="col-md-2 col-xs-6 text-center  ">
			<a target='black' href='/walls'>						
			<figure>
			  <img src="/wp-content/uploads/2016/11/reviews-1-e1478870034226.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($series); ?></h3> <h4>Walls ></h4></figcaption>
			</figure>
			</a>
		</div>
		<div class="col-md-2 col-xs-6 text-center  ">
			<a target='black' href='/wishlist'>						
			<figure>
			  <img src="/wp-content/uploads/2016/11/reviews-1-e1478870034226.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($fantasies); ?></h3> <h4>Fantasies ></h4></figcaption>
			</figure>
			</a>
		</div>	
		
		<div class="col-md-2 col-xs-6 text-center  ">
									
			<a target='black' href='/requests'>
			<figure>
			 
			
			
			  <img src="/wp-content/uploads/2016/11/man-x-scape-shawn-e1478869098864.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($requests); ?></h3> <h4>Requests ></h4></figcaption>
			</figure>
			</a>						
		</div>
		
		
		<div class=" col-md-2 col-xs-6 text-center  ">
			<a target='black' href='/photos'>						
			<figure>
				 <img src="/wp-content/uploads/2016/11/14642200_853702041432368_4968411123150703434_n-e1478868844240.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			 
			  <figcaption><h3><?php echo count($photos); ?></h3> <h4>Photos ></h4></figcaption>
			</figure>
			</a>						
		</div>
		<div class="col-md-2 col-xs-6 text-center  ">
			<a target='black' href='/video-gallery'>						
			<figure>
				 <img src="/wp-content/uploads/2016/11/14642200_853702041432368_4968411123150703434_n-e1478868844240.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			 
			  <figcaption><h3><?php echo count($videos); ?></h3> <h4>Videos ></h4></figcaption>
			</figure>
			</a>						
		</div>
		<div class="col-md-2 col-xs-6 text-center  ">
									
			<a target='black' href='/events'>
			<figure>

			  <img src="/wp-content/uploads/2016/11/man-x-scape-shawn-e1478869098864.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($events); ?></h3> <h4>Events ></h4></figcaption>
			</figure>
			</a>						
		</div>
		

		
		<div class="col-md-2 col-xs-6 text-center  ">
			<a target='black' href='/models'>						
			<figure>
			  <img src="/wp-content/uploads/2016/11/reviews-1-e1478870034226.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($models); ?></h3> <h4>Models ></h4></figcaption>
			</figure>
			</a>
		</div>	
		
		<div class="col-md-2 col-xs-6 text-center  ">
			<a target='black' href='/thots'>						
			<figure>
			  <img src="/wp-content/uploads/2016/11/reviews-1-e1478870034226.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($thots); ?></h3> <h4>THOTs ></h4></figcaption>
			</figure>
			</a>
		</div>
		<div class="col-md-2 col-xs-6 text-center  ">
			<a target='black' href='/pros'>						
			<figure>
			  <img src="/wp-content/uploads/2016/11/reviews-1-e1478870034226.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($models); ?></h3> <h4>PROs ></h4></figcaption>
			</figure>
			</a>
		</div>	
			
		
		<div class="col-md-2 col-xs-6 text-center  ">
			<a target='black' href='/projects'>						
			<figure>
			  <img src="/wp-content/uploads/2016/11/reviews-1-e1478870034226.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo count($projects); ?></h3> <h4>Projects ></h4></figcaption>
			</figure>
			</a>
		</div>	
		
		<div class="col-md-2 col-xs-6 text-center  ">
									
			<a target='black' href='/members'>
			<figure>
			  <img src="/wp-content/uploads/2016/11/deep350_350-e1478869245737.jpg" class="img-thumbnail hidden" alt="The Pulpit Rock" width="304" height="228">
			  <figcaption><h3><?php echo $total_results; ?></h3><h4>Members ></h4></figcaption>
			</figure>
			</a>
		</div>
					
								
		<div class='clear visible-xs visible-sm'></div>
								
					
					
								
								
	</div><!-- // stats -->
	
<div class='clear'></div>