<?php
include("header.php");
if(isset($_POST[submit]))
{
	$sql = "INSERT INTO agent (agent_name,agent_code,password,agent_address,status) VALUES ('$_POST[aname]','$_POST[acode]','$_POST[password]','$_POST[aaddress]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1 )
	{
		echo "<script>alert('Agent Registration record inserted successfully...');</script>";
	}
	else
	{
		echo "Failed to insert agent record.." . mysqli_error($con);
	}
}

?>
<div id="tooplate_main">
    
    <div id="tooplate_content">

            <h2>Agent Panel</h2>
        <p>Kindly enter agent details ..</p>
     
            
            <div id="contact_form">
            		<form method="post" name="contact" action="">
					
						<label for="author">Agent Name:</label> <input type="text" name="aname" class="required input_field" />
						<div class="cleaner_h10"></div>
													
						<label for="Password">Agent Code:</label> <input type="text" class="validate-email required input_field" name="acode" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Password:</label> <input type="password" class="validate-email required input_field" name="password" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Confirm Password:</label> <input type="password" class="validate-email required input_field" name="cpassword" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Agent Address:</label> <textarea  class="validate-email required input_field" name="aaddress" />
						</textarea><div class="cleaner_h10"></div>
                        
                        <label for="Password">Status:</label> <select name="status"><option>Active</option><option>Inactive</option></select></br>
                        
						<br><input type="submit" value="Submit" id="submit" name="submit" class="submit_btn float_l" />						
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