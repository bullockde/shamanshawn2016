<div class='clearfix'></div>

<?php 
	
wp_reset_query();
	if( is_page('memory-lane') ){ 
	
		$args = array( 'post_type' => 'ssi_events' , 'posts_per_page' => -1 , 'order' => 'desc' , 'category_name' => 'my-journey'); 
		
	}else{
		
		$args = array( 'post_type' => 'ssi_events' , 'posts_per_page' => -1 , 'order' => 'asc', 'category_name' => 'my-journey' );
		
	}
		$leads = get_posts( $args );

		$count = 0;

		foreach( $leads as $lead ){
			
		?>
		<div class=' journey text-center' >
			<div class='clearfix'></div><br><br>
		<?php		
			
	
			echo mysql2date('Y', $lead->post_date );
			
		?>

		<h2><?php echo "<br><br>" . $lead->post_title;  ?></h2>
		
		<?php
			echo "<br><br>" . get_the_post_thumbnail( $lead->ID , 'medium'  );

			echo "<br><br>" . $lead->post_content;

			//echo "'" . mysql2date('y', $lead->post_date );

			echo "<br>";
			
			if( is_user_logged_in() ){ edit_post_link( 'edit', '','',  $lead->ID );  }
	

			echo "";
		?>
		
		<div class='clearfix'></div><br><br>
		</div><br><br>
		<?php	
		}
wp_reset_query();
?>
<div class='clearfix'></div>