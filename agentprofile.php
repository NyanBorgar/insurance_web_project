<?php
include("header.php");
if($_SESSION[randomid] == $_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		$sql = "UPDATE agent SET agent_name='$_POST[aname]',agent_code='$_POST[acode]',agent_address='$_POST[aaddress]',email_id='$_POST[email]',Qualification='$_POST[qualification]'  WHERE agent_id = '$_SESSION[agent_id]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1 )
		{
			echo "<script>alert('1 record updated successfully...');</script>";
		}
		else
		{
			echo "Failed to update agent record.." . mysqli_error($con);
		}
		
	}
}
if(isset($_SESSION[agent_id]))
{
	$sqledit = "SELECT * FROM agent WHERE agent_id='$_SESSION[agent_id]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid] = rand();
?>

<section id="contact-page" >
<div class="container">
<div class="center">        
<h2>Profile Details</h2>
<p class="lead"></p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  name="frmagent"  onsubmit="return validateform()">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />

<div align="center">
<table   id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">

<tr><th><label>Agent Name:</label></th><td><input type="text" name="aname" class="form-control"  value="<?php echo $rsedit['agent_name']; ?>" /><span id="idaname"> </span></td>
<div class="cleaner_h10"></div></tr>

                
<tr><th><label>Agent Code:</label></th><td><input type="text" name="acode" class="form-control"  value="<?php echo $rsedit['agent_code']; ?>" /><span id="idacode"> </span><div class="cleaner_h10"></div></td></tr>


<tr><th> <label for="Password">Agent Address:</label></th><td><textarea  class="form-control"  name="aaddress"/><?php echo $rsedit['agent_address']; ?>
</textarea><span id="idaaddress"> </span></td><div class="cleaner_h10"></div></tr>

<tr><th><label>Email ID:</label></th><td><input type="email" name="email" class="form-control"  value="<?php echo $rsedit['email_id']; ?>" /><span id="idemail"> </span><div class="cleaner_h10"></div></td></tr>

<tr><th><label>Qualification:</label></th><td><input type="type" name="qualification" class="form-control"  value="<?php echo $rsedit['Qualification']; ?>" /><span id="idqualification"> </span><div class="cleaner_h10"></div></td></tr>

<?php
if(isset($_SESSION[employee_id]))
{
?>
<tr>
    <th><label for="Password">Status:</label></th>
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
        </select></br><span id="idstatus"> </span>
    </td>
</tr>
<?php
}
else
{
?>
<input type="hidden" name="status" value="Pending" />
<?php
}
?>
<tr><td colspan="2"><div align="center">
<button type="submit" name="submit" class="btn btn-primary btn-lg" >Submit</button>
</div></td></tr>	
			
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
	
	document.getElementById("idaname").innerHTML = "";
	document.getElementById("idacode").innerHTML = "";
	document.getElementById("idaaddress").innerHTML = "";
	document.getElementById("idemail").innerHTML = "";
	document.getElementById("idqualification").innerHTML = "";
	document.getElementById("idstatus").innerHTML = "";
	
	if(!document.frmagent.aname.value.match(alphaspaceExp))
	{
		document.getElementById("idaname").innerHTML = "<font color='red'>Agent name should only contain alphabets</font>";	
		document.frmagent.aname.focus();
		i=1;
	}
	if(document.frmagent.aname.value=="")
	{
		document.getElementById("idaname").innerHTML = "<font color='red'>Agent code cannot be empty</font>";	
		document.frmagent.aname.focus();
		i=1;
	}
	if(!document.frmagent.acode.value.match(alphaExp))
	{
		document.getElementById("idacode").innerHTML = "<font color='red'>Agent code should only contain alphabets</font>";	
		document.frmagent.acode.focus();
		i=1;
	}
	if(document.frmagent.acode.value=="")
	{
		document.getElementById("idacode").innerHTML = "<font color='red'>Agent code cannot be empty</font>";	
		document.frmagent.acode.focus();
		i=1;
	}

	if(document.frmagent.aaddress.value=="")
	{
		document.getElementById("idaaddress").innerHTML = "<font color='red'>Address cannot be empty</font>";	
		document.frmagent.aaddress.focus();
		i=1;
	}
	if(document.frmagent.email.value=="")
	{
		document.getElementById("idemail").innerHTML = "<font color='red'>Email Address cannot be empty</font>";	
		document.frmagent.aaddress.focus();
		i=1;
	}
	
	if(document.frmagent.qualification.value=="")
	{
		document.getElementById("idqualification").innerHTML = "<font color='red'>Qualification cannot be empty</font>";	
		document.frmagent.qualification.focus();
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