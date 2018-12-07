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