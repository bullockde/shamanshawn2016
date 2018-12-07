<?php


get_header();

?>

<article id='gallery' class=' '>

	<?php 
	the_title( '<header class="entry-header"><h1 class="entry-title text-center">', '</h1></header><!-- .entry-header -->' );

	?>

	<!--  #####################   START Filter  ##############-->
	<div id='ITF-filter' class='filter center hidden '>
			
		<form id="ITF-filter" method="post" action="">
			
			
			<select name="ITFmonth">
				<option value="1">Month</option>
				<option value="1">Jan</option>
				<option value="2">Feb</option>
				<option value="3">Mar</option>
				<option value="4">Apr</option>
				<option value="5">May</option>
				<option value="6">June</option>				
				<option value="7">Jul</option>
				<option value="8">Aug</option>
				<option value="9">Sept</option>
				<option value="10">Oct</option>
				<option value="11">Nov</option>
				<option value="12">Dec</option>				
				
			</select>
			
			<select name="ITFyear">
				<option value="16">Year</option>
				<option value="16">2016</option>
				<option value="15">2015</option>
				<option value="14">2014</option>
				<option value="13">2013</option>
				<option value="12">2012</option>
				<option value="11">2011</option>
				<option value="10">2010</option>
				
			</select>
				
			<input type="submit">
				
			
		</form>
		<br><br><hr>
	</div>
<!--  #####################   END Filter  ##############-->
			<?php
				
				$month = $_POST['ITFmonth'];
				print_r( $month );
				$year = $_POST['ITFyear'];
				print_r( $year );


		$args = array( 'post_type' => 'g_galleries' , 'posts_per_page' => -1 );
		$leads = get_posts( $args );

		//print_r($leads);
		$count = 0;

		foreach( $leads as $lead ){
						
			$thumb_id = get_post_thumbnail_id( $lead->ID );
			$thumb_url_array = wp_get_attachment_image_src(  $thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];


			
				$count++;
			?>

<!--  ###################################  -->
		  <div class='col-md-4 well '>
			<a href='<?php echo $lead->guid; ?>'> <b><?php echo $lead->post_title;   ?></b> <br><br>
			<img src='<?php echo $thumb_url; ?>' class=' aligncenter ' >
			</a>
		 
				<p style="text-align: center;"><a class="btn btn-success btn-md" href="<?php 
				
					echo $lead->guid;
			
				
			 ?>">View Gallery</a></p>
				
<div class='clearfix'></div>
				
			</div>
<!--  ###################################  --> <!--  #Gallery col-md-4  -->



		<?php
			
		
			//if( ($count % 3) == 0 ){  echo "<div class='clear'><hr></div><br>"; }

			}
	
	?>



<div class='clearfix'></div>

		<header class="entry-header"><h1 class="entry-title text-center">Videos</h1></header><br><br>
<?php
		wp_reset_postdata();
		
		$count = 0;

		$args = array(  'post_type' => 'video' , 'posts_per_page' => -1, 'category_name' => 'ssimarketing');

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		
		echo '<form name="songs" style="text-align: left;" action="/music/" method="get">';
	?>
	
		<div class='song col-xs-6'>
			
			<a href='<?php echo '/' . $post->post_name; ?>'>
				<div class='col-xs-12 text-center pic'>

				<img src='http://img.youtube.com/vi/<?php echo get_field('youtube_id'); ?>/0.jpg' alt='Youtube Image'>
				</div>
				<div class='col-xs-12 text-center video-name'>
					<?php  echo $post->post_title; ?>
				</div>
			</a>
			<div class='clearfix'></div>
		</div>
	<?php 
		
					$count++	;
		if( ($count % 2) == 0 ){ ?> <div class='clear'><br></div> <?php }
		
		endforeach; 
		wp_reset_postdata();
		
		

		echo '<div class="clear"></div>';
	?>
	


<div class='clearfix'></div><hr>

 

</article> <!--  #Gallery  -->


<?php

get_footer(); ?>