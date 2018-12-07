	<div class='clearfix'></div>
		
		
		
<?php
if( is_user_logged_in() && current_user_can( 'manage_options' ) ){
		$args = array(
		   'public'   => true,
		   '_builtin' => false
		);

		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'

		$post_types = get_post_types( $args, $output, $operator ); 

		foreach ( $post_types  as $post_type ) {

			$type_name = get_post_type_object($post_type);
			
			//print_r($type_name);
			
		   echo '<hr>' . $type_name->labels->name . '<hr>';
		   
		   $all = get_posts( array(
					'post_per_page' => 10,
					'author' => $_GET['ID'],
				   'post_type' =>  $post_type,
				));
				foreach ( $all  as $lead ) {
					?>
					<a target='_blank' href='/?p=<?php echo $lead->ID; ?>' class='btn btn-block btn-default'><span class='pull-left'> <?php echo $lead->post_title; ?> </span><span class='pull-right'>GO >> </span>
						<div class='clearfix'></div>
					</a>
					<?php
				}
				
		//		 echo '<p>' . $post_type . '</p>';
				 
				 ?>
				
				 
				 
				 
				 <br><br><h4 class='text-center'>Add New <?php echo $type_name->labels->name; ?></h4><br>
				 <form method='post' action='<?php echo get_permalink(); ?>' class='well'>
					 <input type='text' name='post_title' placeholder='Enter Title'><br><br>
					  <textarea type='text' name='post_content' placeholder='Enter Details..'></textarea><br><br>
					 
					 <input type='text' name='website_link' placeholder='www.YourWebsite.com'><br><br>
					 
					 
					 <div class='clearfix'></div><br>
						<div class='col-md-6'>
						<b>Start Date</b><br>
						<input  type="text" name="date_added" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					</div>
						<div class='col-md-6'>
						<b>Target Date</b><br>
						<input  type="text" name="target_date" placeholder="mm/dd/yy" value="<?php echo current_time( 'm/d/y' ); ?>" >
					</div>
					<div class='clearfix'></div><br>
					
					
					
					
					 <input type='hidden' name='post_type' value='<?php echo $post_type; ?>'>
					 <input type='hidden' name='ID' value='<?php echo $post->ID; ?>'>
					 <input type='hidden' name='new_post' value='true'>
					 <input type='submit' value='Add New' class='btn-block'>
				 </form>
				 
				 
				 
					<a target='_blank' href='/?p=<?php echo $lead->ID; ?>' class='btn btn-block btn-info'>See All></a>
					<?php
		}
		
}else{
	get_template_part('content' , 'member-area');
}

?>
		
		
		
				<div class='clearfix'></div>


