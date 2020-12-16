<?php include("header.php");
?>
<div id="tooplate_main">
    
    <div id="tooplate_content">

            <h2>Contact Information</h2>


        <p>Kindly enter login credentials..</p>
     
            
            <div id="contact_form">
            
					<form method="post" name="contact" action="">
					
						<label for="author">Old Password:</label> <input type="text" name="oldpass" class="required input_field" />
						<div class="cleaner_h10"></div>
													
						<label for="Password"> New Password:</label> <input type="newpass" class="validate-email required input_field" name="password" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password"> Confirm Password:</label> <input type="confirmpass" class="validate-email required input_field" name="password" />
						<div class="cleaner_h10"></div>
                        
						<input type="submit" value="Change Password.." id="submit" name="submit" class="submit_btn float_l" />
						
					</form>
			</div>           
            
    </div>
    
       <?php include("sidebar.php");
	   ?>
            
            
        
		<div class="cleaner"></div>

</div>

    <div class="cleaner"></div>  

<?php include("footer.php");
?>
