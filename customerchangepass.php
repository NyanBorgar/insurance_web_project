<?php
include("header.php");
if(isset($_POST[submit]))
{
	$npassword = md5($_POST[npassword]);
	$oldpass = md5($_POST[oldpass]);
	$sql = "UPDATE customer SET password='$npassword' WHERE password='$oldpass' AND customer_id='$_SESSION[customer_id]'";
	$qsql  = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password updated successfully');</script>";
	}
	else
	{
		echo "<script>alert('Failed to update password..');</script>";
	}
}
?>
<section id="contact-page">
<div class="container">
<div class="center">        
<h2></h2>
<p class="lead">Kindly enter the credentials</p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmemp" onsubmit="return validateform()">
<div align="center">
<table id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">

<tr><th><label for="author">Old Password:</label></th><td> <input type="password" class="form-control"   name="oldpass"/><span id="idoldpass"></span></td>
<div class="cleaner_h10"></div></tr>
                    
<tr><th><label for="Password">New Password:</label> </th><td><input type="password" class="form-control"  name="npassword" /><span id="idnpassword"></span></td>
<div class="cleaner_h10"></div></tr>

<tr><th><label for="Password">Confirm Password:</label> </th><td><input type="password" class="form-control"  name="cpassword" /><span id="idcpassword"></span></td>
<div class="cleaner_h10"></div></tr>

<tr><td colspan="2"><div align="center"><input type="submit" value="Change Password.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>

</table>
</div>
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); 
?>
<script type="application/javascript">
function validateform()
{
	var i=0;
	
	var alphaExp = /^[a-zA-Z]+$/;	//Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/;	//Variable to validate only alphabets with space
	var alphanumericExp = /^[a-zA-Z0-9]+$/;	//Variable to validate only alphanumerics
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	var mobileno = /^\d{10}$/;
	
	document.getElementById("idoldpass").innerHTML = "";
	document.getElementById("idnpassword").innerHTML = "";
	document.getElementById("idcpassword").innerHTML = "";
	

	if(!document.frmemp.oldpass.value.match(alphanumericExp))
	{
		document.getElementById("idoldpass").innerHTML = "<font color='red'>Please input alphabets or numbers</font>";	
		document.frmemp.oldpass.focus();
		i=1;
	}

    if(document.frmemp.oldpass.value.length <=8 && document.frmemp.oldpass.value.length <=16)
	{
		document.getElementById("idoldpass").innerHTML = "<font color='red'>Please input between 8-16 characters </font>";	
		document.frmemp.oldpass.focus();
		i=1;
	}	
	if(document.frmemp.oldpass.value=="")
	{
		document.getElementById("idoldpass").innerHTML = "<font color='red'>Old Password cannot be empty</font>";	
		document.frmemp.oldpass.focus();
		i=1;
	}	
	

	if(!document.frmemp.npassword.value.match(alphanumericExp))
	{
		document.getElementById("idnpassword").innerHTML = "<font color='red'>Please input alphabets or numbers</font>";	
		document.frmemp.npassword.focus();
		i=1;
	}	
	if(document.frmemp.npassword.value.length <=8 && document.frmemp.npassword.value.length <=16)
	{
		document.getElementById("idnpassword").innerHTML = "<font color='red'>Please input between 8-16 characters </font>";	
		document.frmemp.npassword.focus();
		i=1;
	}	
	if(document.frmemp.npassword.value=="")
	{
		document.getElementById("idnpassword").innerHTML = "<font color='red'>New Password cannot be empty</font>";	
		document.frmemp.npassword.focus();
		i=1;
	}	
	if(document.frmemp.npassword.value!=document.frmemp.cpassword.value)
	{
		document.getElementById("idcpassword").innerHTML = "<font color='red'>New Password and Confirm Password should be same </font>";	
		document.frmemp.cpassword.focus();
		i=1;
	}
	if(document.frmemp.cpassword.value=="")
	{
		document.getElementById("idcpassword").innerHTML = "<font color='red'>Confirm Password cannot be empty</font>";	
		document.frmemp.cpassword.focus();
		i=1;
	}		


	if(i==0)
	{
		return true;
	}
	else
	{
		return false;	
	}
}
</script>