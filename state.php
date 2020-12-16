<?php
include("header.php");
if($_SESSION[randomidno]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
			$sql = "UPDATE state SET state='$_POST[state]',status='$_POST[status]' WHERE state_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('1 record UPDATED successfully...');</script>";
			}
			else
			{
				echo "Failed to insert record.." . mysqli_error($con);
			}
		}
		else
		{
			$sql = "INSERT INTO state (state,status) VALUES ('$_POST[state]','$_POST[status]')";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('One record inserted successfully...');</script>";
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
	$sqledit = "SELECT * FROM state WHERE state_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION["randomidno"]=rand();
?>

<section id="contact-page">
<div class="container">

<div class="center">        
<h2>STATE</h2>
<p class="lead"></p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<div align="center">
<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmstate" onsubmit="return validateform()">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomidno]; ?>"  />
<table border="2"  class="table table-striped table-bordered" cellspacing="0" style="width:50%">

<tr><th> <label for="Password">State:</label> </th><td>
<input type="text" class="form-control"  name="state" value="<?php echo $rsedit['state']; ?>" /><span id="idstate"></span>
<div class="cleaner_h10"></div></td></tr>

<tr><th> <label for="Password">Status:</label> </th>
<td>
    <select name="status" class="form-control" >
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
    </select>
</br><span id="idstatus"></span></td></tr>

<tr><td colspan="2"><div align="center">
<button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg" >Submit</button>
</div></td></tr>
				
</table>
</form>
</div>		

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
	
	document.getElementById("idstate").innerHTML = "";
	document.getElementById("idstatus").innerHTML = "";
	
	if(!document.frmstate.state.value.match(alphaspaceExp))
	{
		document.getElementById("idstate").innerHTML = "<font color='red'>Please enter  only alphabets</font>";	
		document.frmstate.state.focus();
		i=1;
	}
	if(document.frmstate.state.value=="")
	{
		document.getElementById("idstate").innerHTML = "<font color='red'>State cannot be empty</font>";	
		document.frmstate.state.focus();
		i=1;
	}
	if(document.frmstate.status.value=="")
	{
		document.getElementById("idstatus").innerHTML = "<font color='red'>Select the status</font>";	
		document.frmstate.status.focus();
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