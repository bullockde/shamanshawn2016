<?php 

global $post;

get_header(); 

$all_leads = get_posts( array('posts_per_page' => 120 ,   'orderby' => 'modified' , 'order' => 'desc')  );

?>
  

 <?php //wp_list_authors('show_fullname=1&optioncount=1&orderby=post_count&order=DESC&number=3'); ?>
 

		
        <div class="">
        	 <!-- Start the Loop. -->
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 	<!-- Test if the current post is in category 3. -->
 	<!-- If it is, the div box is given the CSS class "post-cat-three". -->
 	<!-- Otherwise, the div box is given the CSS class "post". -->

 	<?php if ( in_category( '3' ) ) : ?>
 		<div class="post-cat-three">
 	<?php else : ?>
 		<div class="post">
 	<?php endif; ?>


 	<!-- Display the Title as a link to the Post's permalink. -->

 	<h2 class="text-center"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	
	
	
	
	
	
	
	
	
 		<?php
		

		//$page_slug = get_the_slug();
		
		//echo "SLUG-->" . $post->post_name;
		
		
		//echo $user->user_nicename;

		
		$args = array( 'post_type' => 'ssi_' . $post->post_name  , 'posts_per_page' => -1 );
		$leads = get_posts( $args );
	

?>


	<?php
		// Page thumbnail and title.
		
		//the_title( '<header class="entry-header"><h1 class="entry-title text-center">', '</h1></header><!-- .entry-header -->' );
	?>
	
	
	<div class='clear'></div>	
		<div id='add-tasklist' style='display: block;' class='text-center <?php if ( !is_user_logged_in()  ) { echo "hidden"; } ?>'>
			
			<button id='add-tasklist' class='hidden-print btn btn-success btn-lg'>Add New</button>
			
		</div>
	<div class='clear'></div>	<hr><br>
<div class='col-xs-12 '>

	<div class='pull-right'>
		<?php if( $leads = get_posts( $args ) ){ echo count($leads) . " " . $post->post_title ; } ?>
	</div>
	


		<div id='add-tasklist' style='display: none;' >
		
			<center><h3>Add New<hr></h3></center>
			
			<div id='addnew' class='addnew clear' style='display: block;'>
				 
				<form method="post" action="" name="add_tasklist">
				<div class='well col-md-6 taskcard'>
				
					<div class='col-md-12'>
						<b>Name:</b><br>
						<input type="text" name="post_title" placeholder="Enter Name" >
					</div>
					<div class='clear'></div><br>
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
					<div class='clear'></div><br>
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
					
					<div class='clear'></div><br>
						<div class='col-md-12'>
						<b>Post Type</b><br> 
						
						
			<?php 
				
					$att = "ssi_" . $post->post_name;
					$options = array('post', 'ssi_tasklists', 'ssi_projects', 'ssi_staff', 'to_do', 'ssi_budgets', 'ssi_investments');

				?>
				<select name="post_type"  style='width: 100%;'>
				<?php 
					foreach($options as $option){
						
						?>
						<option value="<?php echo $option;?>" <?php if ($att == $option) echo "selected='selected'";?>><?php echo $option;?></option>
						<?php
					}
				?>
				</select>
						
					</div>
					<div class='clear'></div><hr>
					
					<div class='col-sm-3 hidden ' >
								<b>Posted By: </b><br> <?php 
								$author = wp_get_current_user();
								//$recent_author = get_current_user( 'ID', $lead->post_author );
								//print_r($author);
								
								
								echo $author->user_nicename; ?> 
								<div class='clear'></div><br>
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
								<div class='clear'></div><br>
							</div>	
							 <div class='col-sm-4'>
							 
								<div class='col-xs-9'>
									<input type="text" name="target_hours" placeholder=".25" >
								</div>
								<div class='col-xs-3'>
									Hrs
								</div>
								<div class='clear'></div><br>
							 </div>
							 
							<div class='col-md-4'>
								<input type="text" name="target_budget" placeholder="$$$" >
								<div class='clear'></div><br>
							</div>
						<div class='clear'></div><br>
						<div class='col-md-6'>
						<b>Start Date</b><br>
						<input  type="text" name="date_added" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					</div>
						<div class='col-md-6'>
						<b>Target Date</b><br>
						<input  type="text" name="target_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					</div>
					<div class='clear'></div><br>
						<b>Notes:</b>
						<textarea name="notes" id="" cols="30" rows="3"></textarea>
							<input type="submit" class="btn btn-block">
					
				</div>	

								<input type='hidden' name='new_tasklist' value='1'>
								



				</form>
					
				</div>
		</div>
	
	
	
	
	
	
	
<?php
		echo "<br><hr>";
		
		foreach( $leads as $lead ){
			
			//echo ++$count . ". " . $lead->post_title;
			
			//if($is_admin ){ }else if( ($user->ID != $lead->post_author)  ){ continue; }
		
			echo "<br>";
			
			?>
			<a target='_blank' href='/<?php echo $post->post_name; ?>/<?php echo $lead->post_name; ?>'>
			
				<div class='col-xs-3 text-center'>
				
				
					<center>
					
					<u>
					<?php 
							$Private = get_field( 'ssi_private', $lead->ID );
							
							if( $Private == "Yes" ){ echo "Private"; }else{ echo "Public";}
						?>
					</u>
					<br><br>
					</center>
					<?php
						if(get_field('youtube_id', $lead->ID)){
					?>
								<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/default.jpg' alt='Youtube Image'  class='circle'>
							<?php
							
							
						}else if( get_field('MX_user_id' ,$lead->ID) ){ //the post does not have featured image, use a default image
							
							echo get_avatar( get_field('MX_user_id' ,$lead->ID) );
							
						
							
						}else if( has_post_thumbnail( $lead->ID ) ) { //the post does not have featured image, use a default image
							$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $lead->ID ), 'thumbnail' );

							?>
								<img src='<?php echo esc_attr( $thumbnail_src[0] ) ; ?>' alt='Youtube Image'  class='circle'>
							<?php
							echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
						}

					?>
					
				</div>
				<div class='col-xs-6 text-left'>
					<center><?php  echo ++$count . ". " . $lead->post_title; ?>
					
					</center>
					
					<table border="1" style='margin: 0 auto; width: 100%;'>
<th colspan='3'>

<center><h3>Current Stats </h3></center>
<?php


//$userID = get_field( 'MX_user_id', $lead->ID );

$userID = $lead->post_author;
$users = array($userID);


$counts = count_many_users_posts($users);
//echo 'Posts made by user: ' . $counts[$userID];
if( !get_field( 'MX_user_id', $lead->ID ) ){ echo "-- No USER ID --"; }




	
						
						
						//echo "HERE=--- " . count($leads);
						$user = get_user_by('id', $userID);
						
					//	print_r($user);
						
						$updates = 0 ; 
						foreach( $all_leads as $update ){ 
								
								
								
								if( get_post_meta( $update->ID, 'MX_modified_user', 1) == $user->display_name ){ $updates++; } 
						
						
						}
						//echo "<h3>Updates</h3>";
						
						//echo $updates . "<br>";
						
						?>
						
						

<?php


//echo 'Posts made by user: ' . $counts[2473];
?>
</th>
<tr>
<td>-</td>
<td>Post #</td>
<td>Amount Earned</td>
</tr>

<tr>
<td>New Posts</td>
<td><?php echo $counts[$userID]; ?></td>
<td>$<?php 

$post_count =  $counts[$userID];

$money = $post_count * 0.25;
$money = number_format((float)$money, 2, '.', '');
$post_money = $money;
echo $post_money; 


?>
</td>
</tr>

<tr>
<td>Updates</td>
<td>
<?php echo $updates; ?></td>
<td>$<?php 



$money = $updates * 0.05;
$money = number_format((float)$money, 2, '.', '');
$updates_money = $money;
echo $updates_money; 


?></td>
</tr>

<tr>
<td><h4>Total</h4></td>
<td><h4>

<?php 

echo ($post_count+ $updates);
?>


</h4></td>
<td><h4>

$<?php 


$money = ($post_money + $updates_money);
$money = number_format((float)$money, 2, '.', '');
$total_money = $money;
echo $total_money;


?>
</h4></td>
</tr>
</table> 
					
					
					
					
					
					
					
					
					
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
				
				<div class='clear'></div>
			</div>
			
			
				<div class='pull-right hidden'>
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
				<div class='col-xs-3 text-center'>
					<button class='pull-right1  btn btn-block'> >> </button>
					<br>
									
		<?php 
				
				$email = get_field('MX_user_email' ,$lead->ID);
						 $user = get_user_by_email($email);
				
				if( get_user_by_email($email) ){
					
					?>

			<a  target='_blank' href='/user-profile?ID=<?php 
				
				$email = get_field('MX_user_email' , $lead->ID);
						 $user = get_user_by_email($email);
				
				echo $user->ID; ?>' class='btn btn-default btn-block'>View Profile</a>
				<?php	
				}else if( get_field('MX_user_id' ,$lead->ID) ){
				?>

			<a  target='_blank' href='/user-profile/?ID=<?php echo get_field('MX_user_id' ,$lead->ID); ?>' class='btn btn-default btn-block'>View Profile</a>
				<?php
				}
				else{
					?>
			
			<a  target='_blank' href='/claim?claimID=<?php echo $lead->ID; ?>' class='btn btn-default btn-block'>Claim Profile</a>
				<?php
				}
				
				

				?>
				<a  target='_blank' href='/admin/' class='btn btn-default btn-block'>ADMIN Panel >></a>
				<a  target='_blank' href='/help' class='btn btn-default btn-block'>FAQ's >></a>
			<a  target='_blank' href='/post' class='btn btn-success btn-block'>New Post >></a>

				</div>
			</a>
			
			<div class="clear"></div><hr>
			
			<?php
			
		}
			 
?>
</div>
 
	


 


 	<!-- Display the Post's content in a div box. -->

 	<div class="entry">
 		<?php the_content(); 

			if( is_page('category') ){
				$args = array(
  'orderby' => 'name',
  'order' => 'ASC'
  );
$categories = get_categories($args);
  foreach($categories as $category) { 
	echo "<img src='" .  z_taxonomy_image_url($category->term_id)  . "'>";
    echo '<p>Category: <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </p> ';
   // echo '<p>'. $category->description . '</p>';
    echo '<p> Post Count: '. $category->count . '</p><br><br>';  } 

			}



		?>	

		
 	</div>


 	<!-- Stop The Loop (but note the "else:" - see next line). -->

 <?php endwhile; else : ?>


 	<!-- The very first "if" tested to see if there were any Posts to -->
 	<!-- display.  This "else" part tells what do if there weren't any. -->
 	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>


 	<!-- REALLY stop The Loop. -->
 <?php endif; ?>

				
        </div>

        <div class="clear"></div>
        	<!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->

 	
        </div>
        
     </div>
    
<?php 

//get_template_part('content', 'member-area'); 
?>
<hr>

<center>Posted<br><small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small></center>
<?php

get_footer(); ?>