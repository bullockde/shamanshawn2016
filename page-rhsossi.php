<?php
/*
Template Name: RHSoSSI Page
*/


get_header();

?>


<div id='gallery' class=' '>
	

		
<div class='zone'>
	<div class='col-md-8 ad content text-center'>

		<a href='/rhsossi/'><img src='/wp-content/uploads/2015/10/RHSoSSI-leader1.png' class='img-responsive'></a>


		<div class='clear'></div>

		
		<div class='col-md-3'><a href='/music/' class='btn btn-default btn-block'> Music </a></div>
		<div class='col-md-3'><a href='/tv/' class='btn btn-default btn-block'> TV </a></div>
		<div class='col-md-3'><a href='/rhsossi/' class='btn btn-default btn-block'> Videos </a></div>
		<div class='col-md-3'><a href='/ssixxx/' class='btn btn-default btn-block'> SSIxXx</a></div>
	</div>
	<div class='col-md-4 ad'>
		Ad<br>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- SSI_Zone -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3813829909026031"
     data-ad-slot="6008753785"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

	</div>
	<div class='clear'></div>
</div>


<div class='clear'></div>


<div class='clear'></div>

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
			<div class='clear'></div>
		</div>
	<?php 
		
					$count++	;
		if( ($count % 2) == 0 ){ ?> <div class='clear'><br></div> <?php }
		
		endforeach; 
		wp_reset_postdata();
		
		
	?>
	

<div class="clear"></div>




</div> <!--  #Gallery  -->


<?php

get_footer(); ?>