<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		$sql = "UPDATE employee SET emp_type='$_POST[etype]',emp_name='$_POST[ename]',login_id='$_POST[loginid]',status='$_POST[status]' WHERE employee_id='$_SESSION[employee_id]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1 )
		{
			echo "<script>alert('Employee profile updated successfully...');</script>";
		}
		else
		{
			echo "Failed to update record.." . mysqli_error($con);
		}
	}
}
if(isset($_SESSION[employee_id]))
{
	$sqledit = "SELECT * FROM employee WHERE employee_id='$_SESSION[employee_id]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>EMPLOYEE PANEL</h2>
<p class="lead">Kindly enter the credentials</p>
</div> 
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmemp" onsubmit="return validateform()">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />

<div align="center">
<table id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
<tr><th><label for="Password">Employee Type:</label> </th><td><select name="etype" class="form-control" readonly>
<?php
    $sqlstate = "SELECT * FROM employee";
    $qsqlstate = mysqli_query($con,$sqlstate);
    while($rsstate = mysqli_fetch_array($qsqlstate))
    {
    if($rsstate[employee_id] == $rsedit[employee_id])
    {
    echo "<option value='$rsstate[employee_id]' selected>$rsstate[emp_type]</option>";
    }
    }
    ?>
</select><span id="idetype"></span></td><div class="cleaner_h10"></div></tr>
            
<tr><th><label for="Password">Employee Name:</label> </th><td><input type="text" class="form-control"  name="ename"  value="<?php echo $rsedit['emp_name']; ?>" /><span id="idename"></span></td><div class="cleaner_h10"></div></tr>

<tr><th><label for="Password">Login ID:</label>  </th><td><input type="text" class="form-control"  name="loginid" value="<?php echo $rsedit['login_id']; ?>" /><span id="idloginid"></span></td><div class="cleaner_h10"></div></tr>



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