<?php
/**
 * Template Name: No Content
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

<?php get_template_part( 'content', 'complex-ifs' ); ?>
	
<?php get_footer(); ?>