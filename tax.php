<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
			$sql = "UPDATE tax SET tax_perc='$_POST[tperc]' WHERE tax_id='1' ";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('1 record UPDATED successfully...');</script>";
			}
	}
}

$sqledit = "SELECT * FROM tax WHERE tax_id='1'";
$qsqledit = mysqli_query($con,$sqledit);
$rsedit = mysqli_fetch_array($qsqledit);

$_SESSION[randomid]==rand();
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>TAX PANEL</h2>
<p class="lead"></p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmtax" onsubmit="return validateform()">
<div align="center">
<table id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />
	
<tr><th><label for="author">Tax Percentage:</label></th><td><input type="text" name="tperc" class="form-control"  value="<?php echo $rsedit['tax_perc']; ?>"/><span id="idtperc"></span><div class="cleaner_h10"></div></td></tr>

<tr><td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg" >Update..</button></div></td></tr>
				
</table><br/><br/>
</div>		
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); 
?>

<script>
function validateform()
{
	var i=0;
	
	var alphaExp = /^[a-zA-Z]+$/;	//Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/;	//Variable to validate only alphabets with space
	var alphanumericExp = /^[a-zA-Z0-9]+$/;	//Variable to validate only alphanumerics
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	var mobileno = /^\d{10}$/;
	var decimal = /^[-+]?[0-9]+\.[0-9]+$/;
	
	document.getElementById("idtperc").innerHTML = "";
	
	
	if(document.frmtax.tperc.value=="")
	{
		document.getElementById("idtperc").innerHTML = "<font color='red'>Tax percentage cannot be empty</font>";	
		document.frmtax.custname.focus();
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