<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		 $pwd = md5($_POST[password]);
		if(isset($_GET[editid]))
		{
			$sql = "UPDATE employee SET emp_type='$_POST[etype]',emp_name='$_POST[ename]',login_id='$_POST[loginid]',password='$pwd',status='$_POST[status]' WHERE employee_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('Admin record updated successfully...');</script>";
			}
			else
			{
				echo "Failed to insert  record.." . mysqli_error($con);
			}
		}
		else
		{
		$sql = "INSERT INTO employee (emp_type,emp_name,login_id,password,status) VALUES ('$_POST[etype]','$_POST[ename]','$_POST[loginid]','$pwd','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1 )
		{
			echo "<script>alert('Employee record inserted successfully...');</script>";
		}
		else
		{
			echo "Failed to insert  record.." . mysqli_error($con);
		}
		}
	}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM employee WHERE employee_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>Adding Employee Record</h2>
<p class="lead">Kindly enter the credentials</p>
</div> 
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmemp" onsubmit="return validateform()">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />

<div align="center">
<table id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
<tr><th><label for="Password">Employee Type:</label> </th><td><select name="etype" class="form-control" >
<option value="">Select </option>
<?php
$arr = array("Admin","Employee");
foreach($arr as $val)
{
if($val == $rsedit[status])
{
echo "<option value='$val' selected>$val</option>";
}
else
{
echo "<option value='$val'>$val</option>";
}
}
?>
</select><span id="idetype"></span></td><div class="cleaner_h10"></div></tr>
            
<tr><th><label for="Password">Employee Name:</label> </th><td><input type="text" class="form-control"  name="ename"  value="<?php echo $rsedit['emp_name']; ?>" /><span id="idename"></span></td><div class="cleaner_h10"></div></tr>

<tr><th><label for="Password">Login ID:</label>  </th><td><input type="text" class="form-control"  name="loginid" value="<?php echo $rsedit['login_id']; ?>" /><span id="idloginid"></span></td><div class="cleaner_h10"></div></tr>

<tr><th> <label for="Password">Password:</label> </th><td> <input type="password" class="form-control"  name="password" value="<?php echo $rsedit['password']; ?>" /><span id="idpassword"></span></td><div class="cleaner_h10"></div>
</tr>
<tr><th><label for="Password">Confirm Password:</label>  </th><td><input type="password" class="form-control"  name="cpassword" /><span id="idcpassword"></span></td><div class="cleaner_h10"></div></tr>

<tr><th><label for="Password">Status:</label>  </th><td> <select name="status" class="form-control" >
<option value="">Select status</option>
<?php
$arr = array("Active","Inactive");
foreach($arr as $val)
{
if($val == $rsedit[status])
{
echo "<option value='$val' selected>$val</option>";
}
else
{
echo "<option value='$val'>$val</option>";
}
}
?>
</select><span id="idstatus"></span></br></td></tr>

<tr><td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg" onclick="submit()" >Submit</button></div></td></tr>				

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
	
	document.getElementById("idetype").innerHTML = "";
	document.getElementById("idename").innerHTML = "";
	document.getElementById("idloginid").innerHTML = "";
	document.getElementById("idpassword").innerHTML = "";
	document.getElementById("idcpassword").innerHTML = "";
	document.getElementById("idstatus").innerHTML = "";
		
	if(document.frmemp.etype.value=="")
	{
		document.getElementById("idetype").innerHTML = "<font color='red'>Select the employee type</font>";	
		document.frmemp.etype.focus();
		i=1;
	}	
	if(!document.frmemp.ename.value.match(alphaspaceExp))
	{
		document.getElementById("idename").innerHTML = "<font color='red'>Employee name should contain only alphabets</font>";	
		document.frmemp.ename.focus();
		i=1;
	}
	if(document.frmemp.ename.value=="")
	{
		document.getElementById("idename").innerHTML = "<font color='red'>Employee cannot cannot be empty</font>";	
		document.frmemp.ename.focus();
		i=1;
	}
	if(!document.frmemp.loginid.value.match(alphaExp))
	{
		document.getElementById("idloginid").innerHTML = "<font color='red'>Login ID should contain only alphabets</font>";	
		document.frmemp.loginid.focus();
		i=1;
	}	
	if(document.frmemp.loginid.value=="")
	{
		document.getElementById("idloginid").innerHTML = "<font color='red'>Login ID cannot be empty</font>";	
		document.frmemp.loginid.focus();
		i=1;
	}
	if(!document.frmemp.password.value.match(alphanumericExp))
	{
		document.getElementById("idpassword").innerHTML = "<font color='red'>Please input alphabets or numbers</font>";	
		document.frmemp.password.focus();
		i=1;
	}
	if(document.frmemp.password.value.length <=7 && document.frmemp.password.value.length <=14)
	{
		document.getElementById("idpassword").innerHTML = "<font color='red'>Please input between 7-14 characters </font>";	
		document.frmemp.password.focus();
		i=1;
	}	
	if(document.frmemp.password.value=="")
	{
		document.getElementById("idpassword").innerHTML = "<font color='red'>Password cannot be empty</font>";	
		document.frmemp.password.focus();
		i=1;
	}	
	if(document.frmemp.password.value!=document.frmemp.cpassword.value)
	{
		document.getElementById("idcpassword").innerHTML = "<font color='red'>Password and Confirm Password should be same </font>";	
		document.frmemp.cpassword.focus();
		i=1;
	}
	if(document.frmemp.cpassword.value=="")
	{
		document.getElementById("idcpassword").innerHTML = "<font color='red'>Confirm Password cannot be empty</font>";	
		document.frmemp.cpassword.focus();
		i=1;
	}	
	if(document.frmemp.status.value=="")
	{
		document.getElementById("idstatus").innerHTML = "<font color='red'>Select status</font>";	
		document.frmemp.status.focus();
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