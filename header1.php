<?php
session_start();
include("dbconnection.php");
include("includes.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>insurance on internet</title> 
<meta name="keywords" content="" />
<meta name="description" content="" />
<!--
Template 2033 Business
http://www.tooplate.com/view/2033-business
-->
<link href="tooplate_style.css" rel="stylesheet" type="text/css" />

</head>
<body> 

<div id="tooplate_header_wrapper">

    <div id="tooplate_header">
    
        <div id="site_title">
         
        	<h1><a href="#"><img src="images/logo2.png"  height="75" /></a> </h1>
        
        </div> <!-- end of site_title -->
        
        <div id="header_phone_no">

			Toll Free: <span>08 324 552 409</span><br/>
             <?php 
				if(isset($_SESSION[customer_id]))
				{
					$sqlcustomerac = "SELECT * FROM customer WHERE customer_id='$_SESSION[customer_id]'";
					$varcustomerac=mysqli_query($con,$sqlcustomerac);
					$rscustomerac = mysqli_fetch_array($varcustomerac);
					echo "Welcome " . $rscustomerac[customer_name];
				?>
                |
            <a href="#">Profile</a>        | 
            <a href="logout.php">Logout</a>        
            <?php
				}
			?>
              <?php 
				if(isset($_SESSION[employee_id]))
				{
					$sqlemployeeac = "SELECT * FROM employee WHERE employee_id='$_SESSION[employee_id]'";
					$varemployeeac=mysqli_query($con,$sqlemployeeac);
					$rsemployeeac = mysqli_fetch_array($varemployeeac);
					echo "Welcome " . $rsemployeeac[emp_name];
				?>
                |
            <a href="#">Profile</a>        | 
            <a href="logout.php">Logout</a>        
            <?php
				}
			?>
             <?php 
				if(isset($_SESSION[agent_id]))
				{
					$sqlagentac = "SELECT * FROM agent WHERE agent_id='$_SESSION[agent_id]'";
					$varagentac=mysqli_query($con,$sqlagentac);
					$rsagentac = mysqli_fetch_array($varagentac);
					echo "Welcome " . $rsagentac[agent_name];
				?>
                |
            <a href="#">Profile</a>        | 
            <a href="logout.php">Logout</a>        
            <?php
				}
			?>
        </div>
        
        <div class="cleaner_h10"></div>
        
        <div id="tooplate_menu">
        	
            <div id="home_menu"><a href="index.php"></a></div>
                
            <ul>
                <li><a href="index.php" class="current">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <?php 
				if(isset($_SESSION[customer_id]))
				{
				?>
                <li><a href="customeraccount.php">Account</a></li>
                <?php
				}
				else if(isset($_SESSION[agent_id]))
				{
				?>
                <li><a href="agentaccount.php">Agent Account</a></li>
                <?php
				}
				else if(isset($_SESSION[employee_id]))
				{
				?>
                <li><a href="employeeaccount.php">Dashboard</a></li>
                <?php
				}
				else
				{
				?>
                <li><a href="login.php">Login</a></li>
                <li><a href="customer.php">Register</a></li>
                <?php
				}
				?>
                <li><a href="contact.php">Contact</a></li>
            </ul>    	
        
        </div> <!-- end of tooplate_menu -->
        
    </div>	  
</div> <!-- end of header_wrapper -->

<div id="tooplate_middle_wrapper1">
	<div id="tooplate_middle_wrapper2">
		<div id="tooplate_middle">

			<h1>BE ACTIVE<span>with the best coffee</span></h1>
			
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut lorem id mauris cursus pellentesque. Donec lobortis magna at orci blandit ac lobortis ipsum vestibulum.</p>
			
			<a href="about.php"><span>+</span> More</a>
			
		</div>
	</div>
</div>