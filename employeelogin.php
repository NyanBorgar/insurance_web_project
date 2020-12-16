<?php
include("header.php");
if(isset($_SESSION[employee_id]))
{
	echo "<script>window.location.assign('employeeaccount.php');</script>";
}
if(isset($_POST[submit]))
{
	$sql = "SELECT * FROM employee WHERE login_id='$_POST[loginid]'  && password='$_POST[password]' AND emp_type='Employee'";
	$var=mysqli_query($con,$sql);
	
	if(mysqli_num_rows($var)==1)
	{
		$rs= mysqli_fetch_array($var);
	$_SESSION[employee_id]=$rs[employee_id];
	
		echo "<script>window.location.assign('employeeaccount.php');</script>";
	}
	else
	{
	echo "<script>alert('Inavalid login password');</script>";	
		}
}
?>
<div id="tooplate_main">
    
    <div id="tooplate_content">

            <h2>Employee Login Panel</h2>
        <p>Kindly enter login credentials..</p>
           <center> <img src="images/login-1.png" /></center>
<div id="contact_form">

<form method="post" name="contact" action="">

    <label for="author">Login ID:</label> <input type="text" name="loginid" class="required input_field" />
    <div class="cleaner_h10"></div>
                                
    <label for="Password">Password:</label> <input type="password" class="validate-email required input_field" name="password" />
    <div class="cleaner_h10"></div>
    
    <input type="submit" value="Login.." id="submit" name="submit" class="submit_btn float_l" />
    
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
