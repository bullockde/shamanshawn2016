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

	}else if( is_page( 'support' ) ){

		get_template_part( 'content', 'portfolio' );
		get_template_part( 'content', 'ssi-banner-ad' );
			echo "<br><br>";

			while ( have_posts() ) : the_post();
				get_template_part( 'content', 'page' );
			endwhile;

		get_template_part( 'content', 'deals' );

	}else if( is_page( 'my-blog' ) ){

		get_template_part( 'content', 'portfolio' );
		get_template_part( 'content', 'ssi-banner-ad' );

	}else if( is_page( 'deals' ) ){

		get_template_part( 'content', 'deals' );
		get_template_part( 'content', 'ssi-banner-ad' );
	}else if( is_page( 'member-login' ) ){

		get_template_part( 'content', 'members' );
		get_template_part( 'content', 'ssi-banner-ad' );
	}else if( is_page('members') ){

		get_template_part( 'content', 'members' );
		
	}else if( is_page('rentals') ){

		get_template_part( 'content', 'rentals' );


	}else if( is_page('users') ){

	?>

	<div class='col-md-6 '>

		<center>Users Page</center>


	</div>
		
	<?php
	}	
	if( is_page('admin') ){

		get_template_part( 'content', 'admin' );

	}else if( is_page( array('leads', 'friends', 'followers' ) ) ){

		
		 get_template_part( 'content', 'page-leads' );

	}else if( is_page( 'transactions' ) ){

		 get_template_part( 'content', 'page-transactions' ); 

	}else if( is_page('trip-reports') ){

		get_template_part( 'content-page', 'trips' );

	}else if( is_page('craetions') ){

		get_template_part( 'content', 'creations' );

	}
  ////////////////////////// #COMPLEX IFS   /////////////////////

?>