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

global $post;
 
get_header(); 

	$post_type = 'ssi_' . $post->post_name ; 

	

			$type_name = get_post_type_object($post_type);
			
			//print_r($type_name);
			
		 //  echo '<hr>' . $type_name->labels->name . '<hr>';

?> 

		
		<?php

	////////////////////////// #COMPLEX IFS   /////////////////////
	if( is_page('about') ){

		get_template_part( 'content', 'about' ); 
		
		get_template_part( 'content', 'ssi-banner-ad' );
		//get_template_part( 'content', 'staff' );
		?>
			<br>
			<div class='col-md-6'>
			<iframe width="100%" height="250" src="https://www.youtube.com/embed/ZjMvqfAOVyQ" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class='col-md-6'>
				<blockquote>I am Shaman Shawn.
				</blockquote>
				<blockquote>My Mission is to use my life story and my credentials as tools to both inspire people and educate people on things I learn along the way.  My  Ultimate Goal is to Invoke thought in order to Induce Positive Change.
				</blockquote>
				<blockquote>I am committed to providing high quality service, to enable any client to reach a better and more fulfilled level of life than they can achieve on their own. 
				</blockquote>
			</div>
			
			
		<?php
	}else if( is_page('my-life') ){

		 get_template_part( 'content', 'life' );

	}else if( is_page('journey') ){

		get_template_part( 'content', 'journey' );

	}else if( is_page('memory-lane') ){

		 get_template_part( 'content', 'journey' );

	}else if( is_page('services') ){

		 get_template_part( 'content', 'page-services' );

	}else if( is_page('coaching') ){

		 get_template_part( 'content', 'coaching' );
	?>


	<?php 
	}else if( is_page('members') ){

		get_template_part( 'content', 'members' );
		

	}else if( is_page('donate') ){

		get_template_part( 'content', 'donate' );
		

	}else if( is_page('lifestyle') ){
		
		get_template_part( 'content', 'lifestyle' );
		//get_template_part( 'content', 'ssi-banner-ad' );

	}else if( is_page( array('818','request')) ){
	
		 get_template_part( 'content', 'help-page' ); 

	}else if( is_page( 'deals' ) ){

		get_template_part( 'content', 'deals' );
		get_template_part( 'content', 'ssi-banner-ad' );
	}else if( is_page('members') ){

		get_template_part( 'content', 'members' );
		
	}

	
	if( is_page('admin') ){

		get_template_part( 'content', 'admin' );

	}else if( is_page( 'transactions' ) ){

		 get_template_part( 'content', 'page-transactions' ); 

	}else if( is_page('autos') ){

		get_template_part( 'content', 'autos' );

	}
	
	
	
	
  ////////////////////////// #COMPLEX IFS   /////////////////////

?>
		
		<?php //get_template_part( 'content', 'complex-ifs' ); ?>
	
				<div class='clearfix'></div>



		<div class='col-md-12'>
		<?php
		
		
		// Start the loop.
		while ( have_posts() ) : the_post();
		
		
		// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );
		?>
		</div>
		<hr>
		

			<?php
			
			
			
		

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>
<div class="clearfix"></div>

<?php
		//print_r($leads);
		
		$is_admin = 0;
		
		
		$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
		if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) { 
			
			$is_admin = 1;
		}


			
			?>
			
			
				<div class='clearfix'></div>	<hr>
		<div id='add-tasklist' style='display: block;' class='text-center'>
			
			<button id='add-tasklist' class='hidden-print btn btn-success btn-lg'>Add New</button>
			
		</div>
		<div id='add-tasklist' style='display: none;' >
		
			<center><h3>Add New<hr></h3></center>
			
			<div id='addnew' class='addnew clear' style='display: block;'>
				 
				<form method="post" action="" name="add_tasklist">
				<div class='well col-md-6 col-md-offset-3 taskcard'>
					<div class='col-md-12'>
						<b>Post Type</b><br> 
						
						<select name="post_type" value="ssi_tasklists" style='width: 100%;'>
						
							<option value="ssi_tasklists">- Select -</option>
							<option value="ssi_projects"> New Project </option>
							<option value="ssi_staff"> New Staff </option>
							<option value="ssi_tasklists">New Tasklist</option>
							<option value="ssi_budgets">New Budget</option>
							<option value="to_do">New Task</option>
							<?php
									//$projects = get_posts( array('post_type' => 'ssi_projects', 'posts_per_page' => -1, 'orderby' => 'modified') );
									
									
									foreach( $projects as $lead ){
										
										?>
										
										
										<option value="<?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?>"><?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?></option>
										<?php
									}
										
								?>
							</select>
					</div>
					<div class='col-md-12'>
						<b>Name:</b><br>
						<input type="text" name="post_title" placeholder="Enter Name" >
					</div>
					<div class='clearfix'></div><br>
					<div class='col-md-12'>
						<b>Project</b><br> 
						
						<select name="assigned_project" style='width: 100%;'>
						
							<option value="-">No Project</option>
							<?php
									$projects = get_posts( array('post_type' => 'ssi_projects', 'posts_per_page' => -1, 'orderby' => 'modified') );
									
									
									foreach( $projects as $lead ){
										
										?>
										
										
										<option value="<?php echo $lead->ID; ?>"><?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?></option>
										<?php
									}
										
								?>
							</select>
					</div>
					<div class='clearfix'></div><br>
		<div class='col-md-12'>
						<b>Mission</b><br> 
						
						<select name="assigned_mission" style='width: 100%;'>
						
							<option value="-">No Mission</option>
							<?php
								

									foreach( $tasklists as $lead ){
										
										?>
										
										
										<option value="<?php echo $lead->ID; ?>"><?php echo $lead->ID; ?> - <?php echo $lead->post_title; ?></option>
										
										<?php
									}
										
								?>
							</select>
					</div>
					<div class='clearfix'></div><hr>
					
					<div class='col-sm-3 hidden ' >
								<b>Posted By: </b><br> <?php 
								$author = wp_get_current_user();
								//$recent_author = get_current_user( 'ID', $lead->post_author );
								//print_r($author);
								
								
								echo $author->user_nicename; ?> 
								<div class='clearfix'></div><br>
							</div>
							<div class='col-sm-4' >
								<b>Assigned To: </b><br> <select name="assigned_to" style='width: 100%;'>
									
									<option value="all">All</option>
								<?php
								$staff = get_posts( array('post_type' => 'ssi_staff', 'posts_per_page' => -1, 'orderby' => 'modified') );

									foreach( $staff as $lead ){
										
										?>
										<option value="<?php echo $lead->post_name; ?>"><?php echo $lead->post_title; ?></option>
										<?php
									}
										
								?>
									
									
									
								</select> 
								<div class='clearfix'></div><br>
							</div>	
							 <div class='col-sm-4'>
							 
								<div class='col-xs-9'>
									<input type="text" name="target_hours" placeholder=".25" >
								</div>
								<div class='col-xs-3'>
									Hrs
								</div>
								<div class='clearfix'></div><br>
							 </div>
							 
							<div class='col-md-4'>
								<input type="text" name="target_budget" placeholder="$$$" >
								<div class='clearfix'></div><br>
							</div>
						<div class='clearfix'></div><br>
						<div class='col-md-6'>
						<b>Start Date</b><br>
						<input  type="text" name="date_added" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					</div>
						<div class='col-md-6'>
						<b>Target Date</b><br>
						<input  type="text" name="target_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					</div>
					<div class='clearfix'></div><br>
						<b>Notes:</b>
						<textarea name="notes" id="" cols="30" rows="3"></textarea>
							<input type="submit" class="btn btn-block">
					
				</div>	

								<input type='hidden' name='new_tasklist' value='1'>
								



				</form>
					
				</div>
		</div>
			
			
			
			
			
		<?php
		

		//$page_slug = get_the_slug();
		
		//echo "SLUG-->" . $post->post_name;
		
		
		//echo $user->user_nicename;

		
		$args = array( 'post_type' => 'ssi_' . $post->post_name  , 'posts_per_page' => -1 );
		$leads = get_posts( $args );
	
		//print_r($leads);
		
		foreach( $leads as $lead ){
			
		
			
			?>
			<div class='well'>
			
				<div class='col-sm-3 text-center'>
				
				<a target='_blank' href='<?php echo $lead->guid; ?>'>
					<?php
						if(get_field('youtube_id', $lead->ID)){
					?>
								<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg' alt='Youtube Image'  class='circle'>
							<?php
							
						}else if( has_post_thumbnail( $lead->ID ) ) { //the post does not have featured image, use a default image
							$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $lead->ID ), 'small' );

							?>
								<img src='<?php echo esc_attr( $thumbnail_src[0] ) ; ?>' alt='Youtube Image'  class=''>
							<?php
							echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
						}

					?>
					</a>
				</div>
				<div class='col-sm-6 text-left'>
					<h4><?php  echo ++$count . ". " . $lead->post_title; ?></h4>
					<br>
					
					<?php  echo $lead->post_content; ?>

					<br><br>
					
					
					<br>
					Posted By: 
					
					<?php 
					
				//	echo get_the_author_meta( $lead->ID ); 
					
					?>
					<?php $author_id=$lead->post_author; ?>
					<img src="<?php echo get_avatar_url( $author_id ); ?>" width="25" height="25" class="  circle avatar" alt="<?php echo the_author_meta( 'display_name' , $author_id ); ?>" />
					<?php the_author_meta( 'display_name' , $author_id ); ?> 
					<br><br>
					
					
					<?php 
					
							$Private = get_field( 'ssi_private', $lead->ID );
							
							if( $Private == "Yes" ){ echo "Private"; }else{ echo "Public";}
						?></u> -
					<?php
						$cats = get_the_category( $lead->ID ); 
					
					//print_r($cats );
					foreach( $cats as $cat ){ echo $cat->cat_name . " " . $post->post_title; }
					
					
					?>
					
					
						<div class='col-sm-12  hidden'>
				<h4 class='visible-xs'>Budget Summary</h4>
				
				
				<div class=' well'>
			
				<div class='col-xs-6'>
					Income:
				</div>
				<div class='col-xs-6'>
					$
					<?php 
					
						echo $tot_income;
							?>
				</div>
					<div class='clear'><br></div>
				<div class='col-xs-6'>
					Expense: 
				</div>
				<div class='col-xs-6'>
					$
					<?php 
						echo $tot_expense;
						
							?>
				</div>
					<div class='clear'><br></div>
				<div class='col-xs-6'>
					Left Over:
				</div>
				<div class='col-xs-6'>
					$
					<?php 
							echo $client_profit;
							?>
				</div>
				
				<div class='clearfix'></div>
			</div>
			
			
				<div class='pull-right hidden1'>
					<?php 
						
						$due = ((($weeks) * $rate)+($security + $rate + $app_fee));
						echo "Invested --->$" . $initial_investment;
					
					

						$tot_owed  += $due;

						echo "<br>Left Over--->$" . $client_profit;
						
						$percent = round((float)$return_rate * 100 ) . '%';
						echo "<br>Return rate --->$" . $percent;
						echo "<br>Return Amount --->$" . $return_amount;
						
						
						$owed = ($due - $client_profit);

					$banked = $loss = 0;
					

					if( $owed < 0 || get_field( "move-out_date", $lead->ID ) ){
						if( $owed < 0 ){ 
							$banked = (-$owed);
							//echo "<br>BANKED: $" . $banked;
						 }
						else{ 
							$loss = $owed; 
							//echo "<br>LOSS: $" . $loss;

							
						}
						if( get_field( 'security_applied', $lead->ID ) == "yes"  ){ 
								//echo "<br>SECURITY APPLIED!!";
								$final = ((-$loss) + $security);
								//echo "<br>FINAL: $" . $final;
							}

						$owed = 0; 
					}
					//	echo "<br><br>Owed: $" . $owed; 
				
						

						$tot_due += $owed;
					?>
				
				</div>
			</div>
					
					
					
					
					
					
					
					
					
					
				</div>
				<div class='col-sm-3 text-center'>
					<a target='_blank' href='<?php echo $lead->guid; ?>'>
					<button class='btn-block'> >> </button>
					</a>
				</div>
			
			
			<div class="clearfix"></div>
			</div>
			
			
			<br><br>
			<?php
		
		}
		
		//get_template_part( 'content', 'budgets' );
		
		
		
		
		
?>
<div class="clear"></div><br><br>

	<?php
		// Page thumbnail and title.
		
		//the_title( '<header class="entry-header"><h1 class="entry-title text-center">', '</h1></header><!-- .entry-header -->' );
	?>
	

	
	
		
		
				<div class='clearfix'></div>
	
		<?php //get_template_part( 'content', 'member-area' ); ?>
	


<?php //get_sidebar(); ?>
<?php get_footer(); ?>