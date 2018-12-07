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

get_header(); ?> 

<?php 
	$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator');
	if ( is_user_logged_in() && array_intersect($allowed_roles, $user->roles ) ) {		
			$social = array(
		
			'adam4adam' => 'https://www.adam4adam.com/profile/view/', 
			'facebook' => 'https://www.facebook.com/', 
			'instagram' => 'https://www.instagram.com/', 
			'kik' => '', 
			'vine' => 'https://vine.co/u/', 
			'meetup' => 'http://www.meetup.com/', 
			'linkedin' => 'https://www.linkedin.com/pub/', 
			'bgclive' => '',
			'xtube' => 'http://www.xtube.com/profile/',
			'tumblr' => 'http://www.xtube.com/profile/',
			
		);
			
			
		
	?>
	
	<div class='container'>
	<br><br><div class='clear'></div>
		<div class='row'>
			<div class='col-xs-6'>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>	
			<div class='col-xs-6'>
				<button id='newpost' class='btn btn-lg btn-default pull-right'>Add New</button>
				<button id='filter' class='btn btn-lg btn-default pull-right'>Filter</button>
				<a href='#summary' class='btn btn-lg btn-default pull-right'>Summary</a>
			</div><div class='clear'></div>
			<hr>
		</div>

<div id='newpost' class='clear' style='display: none;'>

<?php /*$lead = get_post(11975);*/ ?>
<div class='well contact taskcard'>
		<div class='col-md-2 text-center'> Name </div>
		<div class='col-md-3 text-center'> Email </div>
		<div class='col-md-2 text-center'> Phone# </div>
		<div class='col-md-2 text-center'> City </div>
		<div class='col-md-1 text-center'> State </div>
		<div class='col-md-2 text-center'> &nbsp; </div><br>
		<div class='clear'></div>
	<form method="post" action="">		
		<div class='clear'></div>
					<div class='col-md-2'> 

						<input type="text" name="post_title" value="John Doe">

					</div>
					<div class='col-md-3'>
						
						<input type="text" name="update_lead_email" placeholder="Email" placeholder="<?php echo get_field( 'lead_email', $lead->ID ); ?>">

					</div>
					<div class='col-md-2'>
						
						<input type="text" name="update_lead_phone" placeholder="1-555-555-5555">

					</div>
					<div class='col-md-2'>
	
						<input type="text" name="update_lead_city" placeholder="Philadelphia">

					</div>
					<div class='col-md-1'>

						<input type="text" name="update_lead_state" placeholder="PA">

					</div>
					<div class='col-md-2'>
			
		


					</div>
					
<div class='clear'></div>
	
	<br><br><div id='details' class='details' style='display: block;'>	
				
					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>


				<div class='col-sm-4' >
					<b>Last Seen: </b> 
					
					<input type="text" name="update_last_seen" placeholder="Last Seen" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Last Contacted: </b> 
					
					<input type="text" name="update_last_contacted" placeholder="Last Contacted" placeholder="<?php echo date('n/j/y', strtotime( get_field( 'last_contacted', $lead->ID ) ) ); ?>" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				<div class='col-sm-4' >
					<b>Added: </b> 

					<input type="text" name="update_date_added" placeholder="Date Added" placeholder="<?php echo mysql2date('n/j/y', $lead->post_date ); ?>" value="<?php echo current_time( 'm/d/y' ); ?>">
				</div>
				
				<div class='clear'></div>
				<hr>
				
				<div class='info'>
				<u>Details</u><br>
				
				<b>Area Code: </b> <input type="text" name="update_area_code" placeholder="Area Code" placeholder="<?php echo get_field( 'area_code', $lead->ID ); ?>">
				

				<b>D.O.B: </b> <input width="100" type="text" name="update_dob" placeholder="D.O.B" placeholder="<?php echo get_field( 'lead_dob', $lead->ID ); ?>">
				
				</div>

			<div class='clear'></div>
				

</div>

<div class='clear'></div>
<div class='well '>

	<div id='addsocial<?php echo $lead->ID; ?>' style='display: block;'>
		<div class='clear'></div><hr>
		ADD SOCIAL FORM
		
		
			<select name="site">
				<option value="">Social</option>
		
				<?php 
		foreach( $social as $site => $link ){				
			?>		
				<option value="<?php echo $site;?>"><?php echo $site; ?></option>
		
			<?php 		
		}
	?>
				<option value="other">Other</option>
			</select>
			
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
	
			
			<input type="text" name="username">
			
		
	</div>
	<div class='clear'></div>
</div>


<br>
	<button name="ssi_new_contact" type="submit" class='btn btn-info btn-lg pull-right' value="True" />Add Contact</button>
	
	</form>						

<div class='clear'></div>

</div><!-- END Well Contact-->

	<hr>
</div>

		<div class='clear'></div>
	
			
		<?php
		
			/*********************************************************/
			
			$index = 0; 
			$s_count = 0;
			$social_count = array(); 
			
				
			$tot_count = 0;

			$total_amount = 0;

	// The Query
			

	
				
				
			
		
?>

<!--  #####################   START Filter  ##############-->
<div id='filter' class='filter' style='display: block;'>
			
<form id="filter">
		<div class='col-md-2'>
				
		  			<input type="text" placeholder="Search... " name="searchterm">	
					
				
		</div>
		<div class='col-md-2'>
			<select name="meeting_place">
				<option value="">Social</option>
		
				<?php 
		foreach( $social as $site => $link ){				
			?>		
				<option value="<?php echo $site;?>"><?php echo $site; ?></option>
		
			<?php 		
		}
	?>
				
				<option value="other">Other</option>
			</select>
		</div>
		<div class='col-md-2'>
			<select name="start_date">
			<option value="">Days Ago</option>
			<option value="1">1 day ago</option>
			<option value="3">3 days ago</option>
			<option value="5">5 days ago</option>
			<option value="7">7 days ago</option>
			<option value="30">30 days ago</option>				
			<option value="9999">ALL TIME</option>
			</select>
		</div>
		<div class='col-md-4'>
			<select name="term">
			<option value="">Filter Location</option>
			<option value="404">Atlanta, GA</option>
			<option value="717">Harrisburg, PA</option>
			<option value="215">Philadelphia, PA</option>
			<option value="717">Lancaster, PA</option>
			<option value="717">York, PA</option>
			<option value="215">Allentown, PA</option>
			
			<option value="202">Washington, DC</option>
			<option value="757">Norfolk, VA</option>
			<option value="804">Richmond, VA</option>
			</select>
		</div>
			<input name='filter' value='true' type="hidden">
			<input type="submit">
</form>

			<br><hr>
			
			<?php 
			
			//###########  START FILTER Search Guts   ###########


		$filter = 1;
		
		$found = array();
		
		if( !empty($_GET['searchterm']) ){ 
					
			foreach( $leads as $lead ){
				//echo "<br>TERM: " . $_GET['searchterm'] . " = " . $lead->post_title;
				if( strpos( strtolower($lead->post_title) , strtolower($_GET['searchterm']) ) === false ){ 
				
					//echo "Not FOUND -->" . $_GET['searchterm'];
				}else{
					//echo "FOUND -->" . $_GET['searchterm'];
					array_push( $found, $lead );
				
				}
			}
			
			$leads = $found;
		}else if( !empty($_GET['searchterm']) ){
				
				
				//echo "searchterm SET!";
			$filtered = array();
			foreach( $leads as $lead ){
				if( strcasecmp ( get_field( 'area_code', $lead->ID ) , $searchterm ) == 0  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;

			$filter = 0;
			
		}else if( !empty($_GET['term']) ){
				
				
				//echo "term SET!";
			$filtered = array();
			foreach( $leads as $lead ){
				if( strcasecmp ( get_field( 'area_code', $lead->ID ) , $term ) == 0  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;
		}else if( !empty($_GET['meeting_place']) ){
				
				
				//echo "meeting_place SET!";
				
				
				
			$filtered = array();
			foreach( $leads as $lead ){
				if( get_field( $_GET['meeting_place'], $lead->ID )  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;
		}
		
		
		
//###########   END FILTER Search Guts   ###########

			//print_r( count($leads) );

			//$leads = array();
			
			?>
</div>
<!--  #####################   END Filter  ##############-->



<?php 
			
			
			
			
			//get_template_part( 'content', 'filter' );
			
			
				$unread = get_posts( array( 'post_type' => 'ssi_contact' , 'post_status' => 'pending', 'category' => 170 , 'posts_per_page' => -1 ) );	
				
				$read = get_posts( array( 'post_type' => 'ssi_contact' , 'category' => 170 , 'posts_per_page' => -1 ) );
			
				$leads = array_merge($unread,$read);
				
				//print_r($leads);
			
			$names = array();
			$nums = array();
			$emails = array();
			
			foreach( $leads as $lead ){
				
				
			
					$tot_count++;

					$public = 1;

					

					//echo "<div class='row'><div class='col-md-6'>";
					//echo "<div class='col-md-6'> Name: " . $member[1] . "<br><br>";

				if(  get_field( 'public_private_request', $lead->ID ) == 0  ||  is_user_logged_in()  ){ 
					if( 1 /*$lead->post_status == 'publish'*/ ){

					?>
					
<div class='well contact taskcard'>
		<div class='col-md-2 text-center'> Name </div>
		<div class='col-md-3 text-center'> Email </div>
		<div class='col-md-2 text-center'> Phone# </div>
		<div class='col-md-2 text-center'> City </div>
		<div class='col-md-1 text-center'> State </div>
		<div class='col-md-2 text-center'> &nbsp; </div><br>
		<div class='clear'></div>
	<form method="post" action="">		
		<div class='clear'></div>
					<div class='col-md-2'> 

						
						<input type="text" name="update_post_title" value="<?php echo $lead->post_title; ?>">

					
							
							


					</div>
					<div class='col-md-3'>
						
						<input type="text" name="update_lead_email" placeholder="Email" value="<?php echo get_field( 'lead_email', $lead->ID ); ?>">
						


					</div>
					<div class='col-md-2'>
						
						<input type="text" name="update_lead_phone" value="<?php echo get_field( 'lead_phone', $lead->ID ); ?>">

					</div>
					<div class='col-md-2'>
	
						<input type="text" name="update_lead_city" value="<?php echo get_field( 'lead_city', $lead->ID ); ?>">

					</div>
					<div class='col-md-1'>

						<input type="text" name="update_lead_state" value="<?php echo get_field( 'lead_state', $lead->ID ); ?>">

					</div>
					<div class='col-md-2'>
<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
						<button name="ssi_update_cf" type="submit" class='btn btn-info' value="Update" />Update</button>
	
						
					</div>
					
					
						
	
	</form>						
<div class='clear'></div>


<?php if( get_user_by('email', get_field( "lead_email", $lead->ID ) ) ){
							
							$user = get_user_by('email', get_field( "lead_email", $lead->ID ));
							
							
					echo "User ID: " . $user->ID . "<br>";
				
				}else{ 
						
		if( get_field( "lead_email", $lead->ID ) && !get_user_by('email', get_field( "lead_email", $lead->ID ) ) ){ 
		
		?>
		
		<form method="post" action="" class=''>
			<button name="ssi_add_user" type="submit" class='btn btn-warning' value="Add User" />Add User</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form> 
		<br>
		<?php } ?>
		
		<?php } ?>
		
		
				<?php

					echo "<div id='details" . $lead->ID .  "' class='' style='display: block;'>";

				?>

					<?php //echo mysql2date('n/j/y', $lead->post_date ); ?><span class=' '><?php if(  get_field( 'public_private_request', $lead->ID ) == 1 ){ echo "PRIVATE"; } ?></span>

				<?php
					
					/*if( $lead["2.3"] ){
					echo "<b>Location: </b> " . $lead["2.3"] . ", " . $lead["2.4"] . " " . $lead["2.5"] . "<br><br>";
					}else	{
					echo "<b>Location:</b> Philadelphia, PA<br>";
					}*/

				?>
				
	
					<div class='col-xs-6'>
					
							
					</div>
					<div class='col-xs-6'>
					
						
					</div>
					
			<?php 	
					echo "<div class='clear'></div><br>";
					
					
					echo "<div class='col-xs-12' ><b>Notes: </b> " . $lead->post_content . "</div><br>";

			?>

		<form method="post" action="" class='pull-left'>
			<button name="update" type="submit" class='btn btn-danger' value="Remove Lead" />Delete</button>
			<input name="ID" type="hidden" value="<?php echo $lead->ID; ?>" />
			<input name="post_to_draft" type="hidden" value="true" />
			<input name="URI" type="hidden" value="<?php echo get_page_link(); ?>" />
		</form>
		
	

				<?php
					echo "<a target='_blank' href='/wp-admin/post.php?post=" . $lead->ID . "&action=edit' class='btn btn-default pull-left'>Edit Lead</a>";
				
				
				

				
				
				
?> 

</div>

<div class='clear'></div><br>


</div><!-- END Well Contact-->
<?php				
				
					
					//print_r( $lead );
					//echo "<hr>";
					}// #END IF Published
				}else{  echo "Private<hr><br>" ; } 

				}
				
				
?>
<div id='summary'></div><br><br>



<?php 

		
				//echo "HERE-->";
				//print_r($social_count);
				
				 echo "<div class='clear'></div>";
		$index = 0;
		foreach( $social as $site => $link ){
			
			
			?>		
			
			
			<?php if( 1 /*get_field( $site , $lead->ID )*/ ){ ?>
			
				<div class="col-xs-1 pad0"><a target='_blank' href='<?php echo $link; ?><?php echo get_field( $site , $lead->ID ); ?>'><img src='
<?php echo get_stylesheet_directory_uri(); ?>/images/icons/icon-<?php echo $site; ?>.png' class='img-responsive aligncenter'><br>

	<center><?php echo $social_count[$index]; ?></center>

</a></div>
			<?php } 
			
			$index++;
			
			?>	
			<?php 		
		}
	
				
				
				//print_r( $leads );

				echo "<div class='clear'></div><hr>SUMMARY<hr>";
				
				echo $tot_count . "  " . $post->post_name;
				echo "<br><br>TOTAL---> $" .  $total_amount; 
				//echo "<br><br>EXPENSE--> $" . $tot_expense; 
				//echo "<br><br>PROFIT---> $" . ($tot_income - $tot_expense); 

				//print_r($names);
				//print_r($names);
				$con_cnt = 0;

				foreach( $names as $name ){

					if( $nums[$con_cnt] == "" ){ 
						$con_cnt++;
						continue;

					}else{
						echo "<br>" . $con_cnt . "->" . $name;
						echo "<br>" . $name;
						$con_cnt++;
					}
				}
	

				$con_cnt = 0;

				foreach( $nums as $num ){
					if( $num == "" ){ 
						 $con_cnt++;
						continue;
						//echo "<br>" . $con_cnt . "->NEEDED"; 

					}else{
						echo "<br>" . $con_cnt . "->" . $num;
						echo "<br>" . $num;
						$con_cnt++;
					}
					
				}

				echo "<br><br>";


			// Reset Query
			wp_reset_query();


/*********************************************************/



?>

</div>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">	

		<?php


		//$args = array( 'post_type' => 'ssi_clients' , 'posts_per_page' => -1 );
		//$leads = get_posts( $args );
			 

		//print_r($leads);

		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php //get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

	<?php } ?>
<?php get_footer(); ?>