<?php
include("header.php");
if($_SESSION[randomid] == $_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
			$sql = "UPDATE commission_master SET insurance_scheme_id='$_POST[ischeme]',agent_id='$_POST[agent],commission_amt='$_POST[camt]',transaction_type='$_POST[ttype]',transaction_date='$_POST[tdate]',particulars='$_POST[particulars]',status='$_POST[status]' WHERE commission_master_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1 )
		{
			echo "<script>alert(' 1 record updated successfully...');</script>";
		}
		else
		{
			echo "Failed to insert  record.." . mysqli_error($con);
		}
		}
		else
		{
			$sql = "INSERT INTO commission_master (agent_id,commission_amt,transaction_type,transaction_date,status) VALUES ('$_SESSION[agent_id]','$_POST[wamt]','Debit','$dt','Pending')";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('Withdrawal request sent successfully...');</script>";
			}
			else
			{
				echo "Failed to insert  record.." . mysqli_error($con);
			}
		}
	}
}

	$sqlcommission_master = "SELECT SUM(commission_amt) FROM commission_master WHERE agent_id='$_SESSION[agent_id]' AND transaction_type='Credit'";
	$qsqlcommission_master = mysqli_query($con,$sqlcommission_master);
	$rscommission_master = mysqli_fetch_array($qsqlcommission_master);
	$sqlwithdrawal = "SELECT SUM(commission_amt) FROM commission_master WHERE agent_id='$_SESSION[agent_id]' AND transaction_type='Debit'";
	$qsqlwithdrawal = mysqli_query($con,$sqlwithdrawal);
	$rswithdrawal = mysqli_fetch_array($qsqlwithdrawal);

$_SESSION[randomid] = rand();
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>Withdrawal Request</h2>
<p class="lead">Kindly details for withdrawal request</p>
</div> 
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmcom" onsubmit="return validateform()">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />

<div align="center">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">

<tr><th><label for="Password">You can withdraw upto:</label></th><td>  <input type="text" class="form-control"   name="camt" id="camt"  value="<?php echo $rscommission_master[0]-$rswithdrawal[0];?>" readonly /><span id="idcamt"></span></td></tr>

<tr><th><label for="Password">Enter Withdrawal Amount:</label></th><td>  <input type="text" class="form-control"   name="wamt" id="wamt"  value="<?php echo $rsedit['commission_amt'];?>" onKeyUp="calculatebalance()" /><span id="idwamt"></span></td></tr>

<tr><th><label for="Password">Balance Amount:</label></th><td>  <input type="text" class="form-control"   name="bamt" id="bamt"  value="<?php echo $rsedit['commission_amt'];?>" readonly /><span id="idbamt"></span></td></tr>

<tr><td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg" onclick="submit()" >Send withdrawal Request</button></div></td></tr>				

</table>
</div>		
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>
<script type="application/javascript">
function calculatebalance()
{
	//camt wamt bamt
	document.getElementById("bamt").value =  parseFloat(document.getElementById("camt").value) - parseFloat(document.getElementById("wamt").value);
}
function validateform()
{
	var i=0;
	
	var alphaExp = /^[a-zA-Z]+$/;	//Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/;	//Variable to validate only alphabets with space
	var alphanumericExp = /^[a-zA-Z0-9]+$/;	//Variable to validate only alphanumerics
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	var mobileno = /^\d{10}$/;
	
	document.getElementById("idischeme").innerHTML = "";
	document.getElementById("idagent").innerHTML = "";
	document.getElementById("idcamt").innerHTML = "";
	document.getElementById("idttype").innerHTML = "";
	document.getElementById("idtdate").innerHTML = "";
	document.getElementById("idparticulars").innerHTML = "";
	document.getElementById("idstatus").innerHTML = "";
	
	if(document.frmcom.ischeme.value=="")
	{
		document.getElementById("idischeme").innerHTML = "<font color='red'>Select insurance scheme</font>";	
		document.frmcom.ischeme.focus();
		i=1;
	}	
	if(document.frmcom.agent.value=="")
	{
		document.getElementById("idagent").innerHTML = "<font color='red'>Agent Name cannot be empty</font>";	
		document.frmcom.agent.focus();
		i=1;
	}	
	if(document.frmcom.camt.value=="")
	{
		document.getElementById("idcamt").innerHTML = "<font color='red'>Commission Amount cannot be empty</font>";	
		document.frmcom.camt.focus();
		i=1;
	}	
	if(document.frmcom.ttype.value=="")
	{
		document.getElementById("idttype").innerHTML = "<font color='red'>Enter transaction type</font>";	
		document.frmcom.ttype.focus();
		i=1;
	}	
	if(document.frmcom.tdate.value=="")
	{
		document.getElementById("idtdate").innerHTML = "<font color='red'>Enter transaction date</font>";	
		document.frmcom.tdate.focus();
		i=1;
	}	
	if(document.frmcom.particulars.value=="")
	{
		document.getElementById("idparticulars").innerHTML = "<font color='red'>Particulars cannot be empty</font>";	
		document.frmcom.particulars.focus();
		i=1;
	}	
	if(document.frmcom.status.value=="")
	{
		document.getElementById("idstatus").innerHTML = "<font color='red'>Select status</font>";	
		document.frmcom.status.focus();
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