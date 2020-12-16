<?php
include("header.php");
/*
if(isset($_SESSION[customer_id]))
{
	echo "<script>window.location.assign('customeraccount.php');</script>";
}
*/

if(isset($_GET[customerid]))
{
	$sql = "UPDATE customer SET status='Active' WHERE customer_id='$_GET[customerid]' ";
	$var=mysqli_query($con,$sql);
	echo "<script>alert('Your account has been activated successfully..');</script>";	
	echo "<script>window.location='login.php';</script>";
}
if(isset($_POST[submit]))
{
		$pwd = md5($_POST[password]);
	$sql = "SELECT * FROM customer WHERE login_id='$_POST[loginid]'  && password='$pwd' && status='Active'";
	$var=mysqli_query($con,$sql);	
	if(mysqli_num_rows($var)==1)
	{
		$rs= mysqli_fetch_array($var);
		$_SESSION[customer_id] = $rs[customer_id];
		
		if(isset($_GET[policyid]))
		{
			$currenturl = "insuracc.php?policyid=$_GET[policyid]&percentage=$_GET[percentage]&nyear=$_GET[nyear]&invstamt=$_GET[invstamt]&month=$_GET[month]&instllamt=$_GET[instllamt]&inttamt=$_GET[inttamt]&tamt=$_GET[tamt]";
			echo "<script>window.location='" . $currenturl  . "';</script>";
		}
		else
		{
			echo "<script>window.location.assign('customeracc.php');</script>";
		}
	}
	else
	{
	echo "<script>alert('Inavalid login password');</script>";	
	}
}
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2</h2>
<p class="lead"></p>
</div>
<center> <img src="images/culogin.gif" /></center>
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post" name="contact" action="">
<div align="center">
    <table   border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
    <tr><th><label for="author">Login ID:</label></th><td> <input type="text" name="loginid" class="form-control" required /></td>
    <div class="cleaner_h10"></div></tr>
                            
    <tr><th><label for="Password">Password:</label> </th><td><input type="password" class="form-control" required name="password" /></td>
    <div class="cleaner_h10"></div></tr>
    
    <tr><td colspan="2"><div align="center"><input type="submit" value="Login.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>
    
    <tr><td colspan="2">
    <div align="center"><strong>Did you forgot password?</strong><br /><input type="button" onclick="window.location='forgotpassword.php';" value="CLick here to Recover Password.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>
    
    </table>
</div>
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>