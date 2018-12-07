<!--  #####################   START Filter  ##############-->
<div id='filter' class='filter' style='display: none;'>
			
<form id="filter" method="get">
		<div class='col-md-2'>
				
		  			City:<input type="text" name="searchterm">	
					
				
		</div>
		<div class='col-md-2'>
			<select name="meeting_place">
				<option value="false">Social</option>
				<option value="adam4adam">Adam4Adam</option>
				<option value="backpage">BackPage</option>
				<option value="craigslist">Craigslist</option>
				<option value="xtube">Xtube</option>
				<option value="chaturbate">Chaturbate</option>
				<option value="other">Other</option>
			</select>
		</div>
		<div class='col-md-2'>
			<select name="start_date">
			<option value="false">Days Ago</option>
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
			<option value="false">Filter Location</option>
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

			<br><br><hr>
			
			<?php 
			
			//###########  START FILTER Search Guts   ###########


		//if( $_GET['term'] != '' )$term = $_GET['term'];

		//if( $_GET['searchterm'] != '' )$searchterm = $_GET['searchterm'];
		
		if( $_GET['meeting_place'] != '' )$met = $_GET['meeting_place'];

		$filter = 1;
		
		
		
		
		if( isset($searchterm) ){
				
			$filtered = array();
			foreach( $leads as $lead ){
				if( strcasecmp ( get_field( 'area_code', $lead->ID ) , $searchterm ) == 0  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;

			$filter = 0;
		}
		
		if( isset($term) ){
				
			$filtered = array();
			foreach( $leads as $lead ){
				if( strcasecmp ( get_field( 'area_code', $lead->ID ) , $term ) == 0  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;
		}
		
		if( isset($met) ){
				
			$filtered = array();
			foreach( $leads as $lead ){
				if( get_field( 'adam4adam', $lead->ID )  ){
					array_push( $filtered, $lead );
				}
			}
			$leads = $filtered;
		}
//###########   END FILTER Search Guts   ###########

			print_r( $leads );

			
			
			?>
</div>
<!--  #####################   END Filter  ##############-->