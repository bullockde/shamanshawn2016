<?php 
 if( is_user_logged_in() ){
	$user = $current_user = wp_get_current_user();
	$pg = '/edit-profile/?ID=' . $user->ID;
	
	
	update_post_meta( $_GET['claimID'], 'MX_user_email', $user->user_email );
	wp_redirect( $pg );
}

get_header(); ?>
   
    <div class="">

            <?php if(have_posts()) { ?>
   
                <?php while (have_posts()) : the_post(); ?>                    
                
                <div class="single-post" id="post-<?php the_ID(); ?>">
					<br>
					
                      <h2 class="post-title text-center"><?php wp_title(""); ?></h2>   <hr>
                    <div class='col-md-6 text-center'>
						<h3>Are you <?php echo get_the_title($_GET['claimID']); ?>?</h3>
						<?php 
					$img_url =	get_the_post_thumbnail_url( $_GET['claimID'] );
					
					
					//echo $img_url;
					
					$default ='SSI-Homepage-2017';
					echo '<br>';
					
					//echo $default;

							if( strpos( $img_url , $default ) ){
								echo get_avatar( $_GET['claimID'], 150 );
								
							}else{
								
								echo get_the_post_thumbnail( $_GET['claimID'], 'thumbnail' );
							}
							 ?>
						<br><br>
						<button id='claim'>Claim Profile >></button>
						
						<br><br><br><br>
					</div>
					<div class='col-md-6 '>
					
						<div id='claim' style='display: none;'>
					
							<div class='clear'></div>
							<?php get_template_part( 'content', 'member-area' ); ?>
							<div class='clear'></div>
							
						</div>
						
				
	<br><br><br><br>
	
		<center> 
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- SSI2018_300_250 -->
				<ins class="adsbygoogle"
					 style="display:inline-block;width:300px;height:250px"
					 data-ad-client="ca-pub-9799103274848934"
					 data-ad-slot="8211309974"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
		</center>
		<br><br><br><br>
					</div>
					
					<div class='clear'></div>
					 

                </div>
                    
                <?php endwhile; ?>
                  <?php } ?>	  
                <div class="clear"></div>

        
    </div>
    
<?php get_footer(); ?>
