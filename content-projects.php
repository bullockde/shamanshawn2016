<div class='container'>	
		<br><br><br>
		<center>
			<img title='Projects' src='/wp-content/uploads/SSI-Projects-header.png'>
		</center><br>

<?php

	

		echo "<hr>";
	$count = 0;
	
	$post_type = "ssi_" . $post->post_name;
	
			$args = array( 

				'post_type' => "ssi_projects",
				'posts_per_page' => 3,
				'orderby' => 'modified',
				

			 );
	
			 
			$projects = get_posts( $args );
		
			$count = 0;
					
			foreach($projects as $brand){
				?> 
				
				<div class='clearfix'></div><br><br>
				<div class='col-md-6'> 
					<div class='col-md-offset-2 col-md-8'> 
					<?php
					
						echo get_the_post_thumbnail( $brand->ID);
						
					
					?>
					</div>
				</div>
				
				<div class='col-md-5'> 
				<?php
					
					//echo get_the_post_thumbnail($brand->ID);
					echo "<h3>" . $brand->post_title . "</h3>";
					echo "<p>" . $brand->post_excerpt . "</p>";
				?>
					<div class='clear'><br><br></div>
					
					<div class=' clear'></div>
				<div class='col-xs-5'>
				<b>Project Contact:</b>
				
				</div>
				<div class='col-xs-7'> 
					<a href="<?php echo get_field('project_contact_link', $brand->ID ); ?>" target="_blank"><?php echo get_field('project_contact', $brand->ID ); ?></a>
					
				</div>
				<div class='clear'><br></div>
				<div class=' clear'></div>
				<div class='col-xs-5'>
				<b>Website Link:</b>
				
				</div>
				<div class='col-xs-7'> 
					<a href="<?php echo get_field('project_link', $brand->ID ); ?>" target="_blank"><?php echo get_field('project_link_title', $brand->ID ); ?></a>
					
				</div>
				<div class='clear'><br></div>
				<div class=' clear'></div>
				<div class='col-xs-5'>
				<b>Project Dates:</b>
				
				</div>
				<div class='col-xs-7'> 
					<?php echo get_field('project_start_date', $brand->ID ); ?>
					 -- <?php if( get_field('project_start_date',$brand->ID ) != 'on-going' ){ echo "Current";}else{ echo get_field('project_end_date', $brand->ID ); } ?>
					
				</div>
				
				<div class='clear'><br></div>
		<!--		<div class='col-md-5'> 
				<b>Highlights:</b>
				</div>
				<div class='col-md-7'> 
					<?php echo get_field('project_budget', get_the_ID() ); ?>

				</div>
		
				<div class='clear'><br></div>
				<div class='col-md-12'>
				<a href='/web' class='btn btn-default'> Web Hosting </a>
				
				</div>
		-->			<div class='clear'><hr></div>
					<a href='/<?php echo $brand->post_type; ?>/<?php echo $brand->post_name; ?>' class='btn btn-info btn-block'>More Details >> </a>
				</div>
				
			<div class='clearfix'></div><br><br>
				
				<?php
				$count++;
				if( ($count % 1) == 0 ){ ?> <div class='clear'><hr></div> <?php }
			}



	 
		
	$args = array( 

				'post_type' => "ssi_projects",
				'posts_per_page' => -1,
				'orderby' => 'modified',
				

			 );
	
			 
			$projects = get_posts( $args );
	
	
	 ?>
	 
	 			<a href='/projects/'><div class='ssi btn btn-block col-xs-12'>View All <?php echo "<u>" . count($projects) . "</u>"; ?> Projects >></div></a>

</div>
<div class='clearfix'></div><br><br>