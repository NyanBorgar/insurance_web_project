<?php
session_start();
$dt = date("Y-m-d");
if(isset($_GET['referralid']))
{
	$_SESSION[referralid] = $_GET[referralid];	
}
error_reporting(0);
include("dbconnection.php");
include("includes.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>eInsurance</title>
	
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body class="homepage">

    <header id="header" >
        <div class="top-bar" >
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                   <img src="images/logo2.png"   height="80" width="300"  alt="logo">
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>                            
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                                 <?php 
				if(isset($_SESSION[customer_id]))
				{
					$sqlcustomerac = "SELECT * FROM customer WHERE customer_id='$_SESSION[customer_id]'";
					$varcustomerac=mysqli_query($con,$sqlcustomerac);
					$rscustomerac = mysqli_fetch_array($varcustomerac);
					echo "Welcome " . $rscustomerac[customer_name];
				?>
                |
            <a href="customerprofile.php">Profile</a>        | 
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
					 echo "  Welcome " . $rsemployeeac[emp_name];
				?>
                |
            <a href="empprofile.php">Profile</a>        | 
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
            <a href="agentprofile.php">Profile</a>        | 
            <a href="logout.php">Logout</a>      
            <?php
				}
			?>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                    <?php 
				if(isset($_SESSION[customer_id]))
				{
				?>
                <li><a href="customeracc.php">ACCOUNT</a></li>                       
                		<li class="dropdown"> <a href="#" >Customer Profile<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                <li><a href="customerprofile.php">Profile</a></li> 
                                 <li><a href="custdoc.php">Documents</a></li> 
                                <li><a href="customerchangepass.php">Change Password</a></li>
                             </ul>
                              <li class="dropdown">
                            <a href="insurschemeinfo.php" >Insurance palns<i class="fa fa-angle-down"></i></a>
                               <ul class="dropdown-menu">
                                    
                                     <?php
                        $sqlinsurance_type = "SELECT * FROM insurance_type where status='Active'";
                        $qsqlinsurance_type = mysqli_query($con,$sqlinsurance_type);
                        while($rsinsurancy_type = mysqli_fetch_array($qsqlinsurance_type))
                        {
                            echo "<li><a href='insurschemeinfo.php?insurancetypeid=$rsinsurancy_type[insurance_type_id]'>$rsinsurancy_type[insurance_type]</a></li>";
                        }
                        ?>                                                                        
                              </ul>
                              </li>
                              <li><a href="viewcustomerinsuranceaccount.php">Insurance Account</a></li> 
                              
                            	<ul class="dropdown-menu">
                                	<li><a href="customerprofile.php">Profile</a></li> 
                                 	<li><a href="custdoc.php">Documents</a></li> 
                                	<li><a href="customerchangepass.php">Change Password</a></li>
                             	</ul> 
                        
                        <li class="dropdown"> <a href="#" >QUERIES<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                				<li><a href="feedback.php">Enquiry</a></li>
                                <li><a href="viewqueries.php">View Feedback</a></li>  
                             </ul>
                       </li>
                        
                            	<ul class="dropdown-menu">
                                	<li><a href="customerprofile.php">Profile</a></li> 
                                 	<li><a href="custdoc.php">Documents</a></li> 
                                	<li><a href="customerchangepass.php">Change Password</a></li>
                             	</ul> 
                        <li><a href="logout.php">Logout</a></li>    
                <?php
				}
				else if(isset($_SESSION[agent_id]))
				{
				?>
                		<li><a href="agentacct.php">AGENT ACCOUNT</a></li>
                       <li class="dropdown"> <a href="#" >ACCOUNT<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                <li><a href="agentprofile.php">Profile</a></li> 
                                <li><a href="agentchngpasswrd.php">Change Password</a></li>
                               
                             </ul>
               			</li>
                 		<li><a href="agentmail.php">MARKETING</a></li>
                        <li class="dropdown"> <a href="#" >INSURANCE<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                               <li><a href="viewcustomer.php">View Customers</a></li> 
                                <li><a href="viewagentinsuranceaccount.php">Insurance Account</a></li> 
                               <li><a href="viewpolicypay.php">View Policy Payment</a></li> 
                                <li><a href="viewpolicyclaim.php">View Policy Claim</a></li> 
                             </ul>
                       </li>
                       <li class="dropdown"> <a href="#" >ACCOUNT<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu" style="width:250px;"> 
                                <li><a href="viewcommast.php">VIEW COMMISSION</a></li> 
                                <li><a href="viewcommwithdrawal.php">VIEW COMMISSION WITHDRAWAL</a></li> 
                                <li><a href="commission_withdrawal.php">WITHDRAW AMOUNT</a></li> 
                             </ul>
               			</li>
                        
                        <li><a href="logout.php">Logout</a></li>  
                <?php
				}
				else if(isset($_SESSION[employee_id]))
				{
					if($_SESSION[emp_type]  == "Admin")
					{
				?>
                		<li><a href="empacc.php">DASHBOARD</a></li> 
                        
                        <li class="dropdown"> <a href="#" >AGENT<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu" style="width:250px;">
                                <li><a href="agent.php">Add Agent</a></li> 
                                <li><a href="viewagent.php">View Agent</a></li> 
                                <li><a href="viewcommast.php">VIEW COMMISSION</a></li> 
                                <li><a href="viewcommwithdrawal.php">VIEW COMMISSION WITHDRAWAL</a></li> 
                             </ul>
                       </li>
                        <li class="dropdown"> <a href="#" >INSURANCE<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                               <li><a href="viewcustomer.php">View Customers</a></li> 
                                <li><a href="viewadmininsuracc.php">Insurance Account</a></li> 
                               <li><a href="viewpolicypay.php">View Policy Payment</a></li> 
                                <li><a href="viewpolicyclaim.php">View Policy Claim</a></li> 
                             </ul>
                       </li>
                        <li class="dropdown"> <a href="#" >QUERIES<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                <li><a href="viewqueries.php">View Feedback</a></li>  
                             </ul>
                       </li>
                     	<li class="dropdown"> <a href="#" >INSURANCE TYPE<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                <li><a href="insurtype.php">Add Insurance Type</a></li> 
                                <li><a href="viewinsurtype.php">View Insurance Type</a></li> 
                                <li><a href="insurscheme.php">Add Insurance Scheme</a></li> 
                                <li><a href="viewinsurscheme.php">View Insurance Scheme</a></li> 
                               <li><a href="insurplan.php">Add Insurance Plan</a></li> 
                                <li><a href="viewinsurplan.php">View Insurance plan</a></li> 
                             </ul>
                   		</li>
                        <li class="dropdown"> <a href="#" >SETTINGS<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                   <li><a href="tax.php">Tax Settings</a></li> 
                                   <li><a href="insurancesettings.php">Insurance settings</a></li> 
                                 <li><a href="city.php">Add City</a></li> 
                                 <li><a href="viewcity.php">View City</a></li> 
                                 <li><a href="state.php">Add State</a></li> 
                                 <li><a href="viewstate.php">View State</a></li> 
                             </ul>
                       </li>
                       <li class="dropdown"> <a href="#" >ACCOUNT<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                <li><a href="employeeprofile.php">Profile</a></li> 
                                <li><a href="adminchangepass.php">Change Password</a></li>
                                 <li><a href="employee.php">Add Employee</a></li> 
                                <li><a href="viewemployee.php">View Employee</a></li> 
                             </ul>
               			</li>
                        <li><a href="logout.php">Logout</a></li>  
                <?php
					}
					if($_SESSION[emp_type]  == "Employee")
					{
				?>
                		<li><a href="empacc.php">DASHBOARD</a></li> 
                        <li class="dropdown"> <a href="#" >AGENT<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu" style="width:250px;">
                                <li><a href="agent.php">Add Agent</a></li> 
                                <li><a href="viewagent.php">View Agent</a></li> 
                                <li><a href="viewcommast.php">VIEW COMMISSION</a></li> 
                                <li><a href="viewcommwithdrawal.php">VIEW COMMISSION WITHDRAWAL</a></li> 
                             </ul>
                       </li>
                        <li class="dropdown"> <a href="#" >INSURANCE<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                               <li><a href="viewcustomer.php">View Customers</a></li> 
                                <li><a href="viewadmininsuracc.php">Insurance Account</a></li> 
                               <li><a href="viewpolicypay.php">View Policy Payment</a></li> 
                                <li><a href="viewpolicyclaim.php">View Policy Claim</a></li> 
                             </ul>
                       </li>
                       <li class="dropdown"> <a href="#" >ACCOUNT<i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                <li><a href="employeeprofile.php">Profile</a></li> 
                                <li><a href="adminchangepass.php">Change Password</a></li>
                             </ul>
               			</li>
                        <li><a href="logout.php">Logout</a></li>  
                <?php
					}
				}
				else
				{
				?>
                        <li class="active"><a href="index.php">HOME</a></li>
                        <li><a href="about.php">ABOUT US</a></li>
                        <li><a href="services.php">SERVICES</a></li>   
                            <li><a href="login.php">LOGIN</a></li>
                            <li><a href="customer.php">REGISTER</a></li>
                        <li class="dropdown">
                            <a href="insurschemeinfo.php" >INSURANCE PLANS<i class="fa fa-angle-down"></i></a>
                               <ul class="dropdown-menu">
                                    
                        <?php
                        $sqlinsurance_type = "SELECT * FROM insurance_type where status='Active'";
                        $qsqlinsurance_type = mysqli_query($con,$sqlinsurance_type);
                        while($rsinsurancy_type = mysqli_fetch_array($qsqlinsurance_type))
                        {
                            echo "<li><a href='insurschemeinfo.php?insurancetypeid=$rsinsurancy_type[insurance_type_id]'>$rsinsurancy_type[insurance_type]</a></li>";
                        }
                        ?>                                                                        
                              </ul>
                        </li>
                        <li class="dropdown"><a href="agentlogin.php" >AGENT LOGIN</a></li>
                		<li><a href="feedback.php">CONTACT</a></li>
                        
                <?php
				}
				?>
               </li>

                                               
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->