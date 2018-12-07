<?php
/**
 * Template Name: Homepage
 *

 */

get_header(); 



?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "url": "http://www.shamanshawn.com",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://query.shamanshawn.com/search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Organization",
  "url" : "http://www.shamanshawn.com",
  "logo" : "http://shamanshawn.com/wp-content/uploads/2015/08/2015-08-06-09.29.35.jpg",
  "contactPoint" : [{
    "@type" : "ContactPoint",
    "telephone" : "+1-267-712-9124",
    "contactType" : "customer service"
  }]
}
</script>
<div id='homepage' class=''>
	<?php


	?>

	<section class='tag-line welcome hidden'>
		Healer. Entrepreneur.<br class='visible-xs'> Life Coach. 
	</section>
	
	<?php //get_template_part( 'content', 'welcome' ); ?>
	
	<?php get_template_part( 'content', 'jumbo' ); ?>
	

	<?php //get_template_part( 'content', 'staff' ); ?>
	

	
	<?php get_template_part( 'content', 'ssi-banner-ad' ); ?>
	<?php //get_template_part( 'content', 'connections' ); ?>
	<?php get_template_part( 'content', 'projects' ); ?>
	<section class='tag-line  '>
		<div class='container'>	
		Starting a New Project?? .. <a href='/contact' > Lets Chat >> </a>
		</div>
	</section>
	
	
	<?php //get_template_part( 'content', 'search' ); ?>
	
	<?php //get_template_part( 'content', 'blog' ); ?>
	<section class='tag-line hidden '>
		<div class='container'>	
		Take A Trip .. Enjoy The Journey!
		</div>
	</section>
	<?php //get_template_part( 'content', 'wwss' ); ?>
	
	<?php //get_template_part( 'content', 'songs' ); ?>
	<?php //get_template_part( 'content', 'deals' ); ?>
	
	

	

</div>

<?php get_footer(); ?>