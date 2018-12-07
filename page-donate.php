<?php get_header('no-ads'); ?>
   
    <div class="main">
    
        <div class=""><br><br>
		
             
                
                <div class="single-post text-center h4" id="post-10850">
                        
						
						<?php 
						
							$_POST['dollars'];
							$_POST['cents'];
							
							$amount = $_POST['dollars'] . $_POST['cents'];
							
							
							
							if( isset($_POST['dollars']) ){ 
							
								//echo "AMOUNT = " . $amount;
								?> 
								<h2>Online Payment Gateway</h2>
								<center><img src='/wp-content/uploads/hostiso-stripe-1.png'  class=''></center><br><br>
								<?php
								echo "<h1>PAY $" . $_POST['dollars'] . "." . $_POST['cents'] . "</h1><br>";
								echo do_shortcode('[stripe name="Stripe Payment" description="Online Booking" amount="' . $amount . '"]');
							}else{
								?> 
								<h3>Donate </h3>
								<center><img src='/wp-content/uploads/hostiso-stripe-1.png' class=''></center>
								<br><br>
								<h4>Donation Amount?</h4>
						<form method="post" class='inline-block'>
							$<input type="number" name="dollars" placeholder="00" min="00" max="9000" value="00">.<input type="number" name="cents" placeholder="00" value="00" step="01" min="00" max="99">
							<input type="submit" value=">>">
						</form>
								
								<?php
							}
						?>
						<br>
                    <?php// the_content(); ?> 

                </div>
                    
               
    <div class='clearfix'></div><br>

<?php get_footer(); ?>
