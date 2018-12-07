<button id='add_trans' class='btn btn-info btn-block'>Add Transaction</button><br>

<div id='add_trans' class='clear' style='display: none;'>
				<form id='inert_transaction' method='post'>
		<div class='col-md-2'><input  type="text" name="trans_date" placeholder="Date (mm/dd/yy)"  value="<?php echo current_time( 'm/d/y' ); ?>"></div>
		<div class='col-md-2'><input type="text" name="client_name" placeholder="Name" value="!No Name!"></div>
		<div class='col-md-2'><input type="text" name="client_phone" placeholder="Phone"></div>
		<div class='col-md-2'><input type="text" name="client_city" placeholder="City"></div>
		<div class='col-md-1'><input type="text" name="client_state" placeholder="State"></div>
		<div class='col-md-1'><input type="text" name="trans_amount" placeholder="Rate"></div>
		<div class='col-md-1'>
			<input type="radio" name="income_expense" value="+">+<br>
			<input type="radio" name="income_expense" value="-">-
			
		</div>
		<div class='col-md-1'>
			<input type="submit" class="btn btn-sm btn-block" value="Add">
			<div class='clear'></div>
			
		</div>
		
		
		<div id='Details' style='display: none;'>
		<div class='clear'></div>
		<div class='col-sm-1' ><input type="text" name="area_code" placeholder="Area"></div>
		<div class='col-sm-2' ><input type="text" name="last_seen" placeholder="Last Seen"></div>
		<div class='col-sm-2' ><input type="text" name="last_contacted" placeholder="Last Contacted"></div>
		<div class='col-sm-2' ><input type="text" name="post_date" placeholder="Added"></div>
		<div class='col-sm-3' ><input type="text" name="notes" placeholder="Notes"></div>
		<div class='clear'></div>
		</div>
		<input type='hidden' name='insert_transaction' value='true'>
		<input type='hidden' name="update" value='true'>
		
		
	</form>
			<hr>
			<button id='Details' class='btn btn-sm btn-default btn-block'>Full Form</button>

			

		</div><!--  #END Transaction  -->