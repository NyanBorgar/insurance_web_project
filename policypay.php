<?php
include("header.php");
//Tax amount
$sqltax="SELECT * FROM tax WHERE tax_id='1'";
$qsqltax=mysqli_query($con,$sqltax);
$rstax=mysqli_fetch_array($qsqltax);
$tax=$rstax[tax_perc];


$sqlsettings = "SELECT * FROM settings WHERE settings_id='1'";
$qsqlsettings = mysqli_query($con,$sqlsettings);
$rssettings = mysqli_fetch_array($qsqlsettings);

if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
		
			$sql = "UPDATE policy_payment SET insurance_account_id='$_POST[iacc]',paid_amt='$_POST[pamt]',tax_amt='$_POST[tamt]',paid_date='$_POST[pdate]',trans_type='$_POST[ttype]',card_holder='$_POST[cardholder]',card_no='$_POST[cardno]',exp_date='$_POST[expiredate]',particulars='$_POST[part]',status='Active' WHERE policy_payment_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1 )
		{
			echo "<script>alert('1 Record updated successfully...');</script>";
		}
		else
		{
			echo "Failed to insert  record.." . mysqli_error($con);
		}
	
		}
		else
		{
			$comamt=0;
			$insamt=	str_replace(',', '', $_POST[insamt]);
			if($_POST[penaltypercentage] != 0)
			{
				$penaltypercentage = $_POST[penaltypercentage];
			}
			$sql = "INSERT INTO policy_payment (insurance_account_id,paid_amt,tax_amt,paid_date,trans_type,card_holder,card_no,exp_date,particulars,status,penalty_amt) VALUES ('$_POST[insuranceaccid]','$insamt','$tax','$_POST[pdate]','$_POST[ttype]','$_POST[cardholder]','$_POST[cardno]','$_POST[expiredate]-01','$_POST[part]','Active','$penaltypercentage')";
			$qsql = mysqli_query($con,$sql);
			$insid = mysqli_insert_id($con);		
			
			if(mysqli_affected_rows($con) == 1 )
			{			
				$sql = "UPDATE insurance_account set status='Active' WHERE insurance_account_id='$_POST[insuranceaccid]'";
				$qsql = mysqli_query($con,$sql);
			
				$sql = "SELECT * FROM insurance_account INNER JOIN insurance_plan ON  insurance_account.insurance_plan_id =insurance_plan.insurance_plan_id WHERE  insurance_account.insurance_account_id='$_POST[insuranceaccid]'";
				$qsql = mysqli_query($con,$sql);
				$rs = mysqli_fetch_array($qsql);

				$sqlcustomer = "SELECT * FROM customer WHERE customer_id='$rs[customer_id]' AND agent_id!='0'";
				$qsqlcustomer = mysqli_query($con,$sqlcustomer);
				$rscustomer = mysqli_fetch_array($qsqlcustomer);				
				
				$sqlpolicy_payment = "SELECT * FROM policy_payment WHERE insurance_account_id='$_POST[insuranceaccid]'";
				$qsqlpolicy_payment = mysqli_query($con,$sqlpolicy_payment);
				$rspolicy_payment = mysqli_fetch_array($qsqlpolicy_payment);
				
				$sqlinsurance_scheme = "SELECT * FROM insurance_scheme WHERE insurance_scheme_id='$rs[insurance_scheme_id]'";
				$qsqlinsurance_scheme= mysqli_query($con,$sqlinsurance_scheme);
				$rsinsurance_scheme = mysqli_fetch_array($qsqlinsurance_scheme);
				
				if(mysqli_num_rows($qsqlpolicy_payment) == 1)
				{
				$agent_commission = $rsinsurance_scheme[agent_commission];	
				}
				else
				{
				$agent_commission = $rsinsurance_scheme[agent_commission2];
				}
				
				$comamt=$insamt * $agent_commission /100;
				
				if(mysqli_num_rows($qsqlcustomer) >= 1)	
				{				
					$sql = "INSERT INTO commission_master (insurance_scheme_id,insurance_account_id,agent_id,commission_amt,transaction_type,transaction_date,particulars,status) VALUES ('$rs[insurance_scheme_id]','$_POST[insuranceaccid]','$rscustomer[agent_id]','$comamt','Credit','$dt','','Active')";
					mysqli_query($con,$sql);
					echo mysqli_error($con);
				}
				
				echo "<script>alert('Policy payment done successfully...');</script>";
			 	echo "<script>window.location='policyreceipt.php?paymentid=$insid&insuranceaccid=$_GET[acc]';</script>"; 
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
	$sqledit = "SELECT * FROM policy_payment WHERE policy_payment_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
if(isset($_GET[acc]))
{
	$eqlinsurance_account="SELECT * FROM  insurance_account WHERE insurance_account_id='$_GET[acc]'";
	$qsqlinsurance_account=mysqli_query($con,$eqlinsurance_account);
	$rsinsurance_account=mysqli_fetch_array($qsqlinsurance_account);	
	/*
		$d1 = $rsinsurance_account["date_create"];
		$d2 = $rsinsurance_account["maturity_date"];		
		$diff =date_diff($d1,$d2);		
		echo "testtes".$diff->y;
	*/
	$diff = abs(strtotime($rsinsurance_account["maturity_date"]) - strtotime($rsinsurance_account["date_create"]));
	$noofyears = floor($diff / (365*60*60*24));	
	
	if($rsinsurance_account["policy_term"] == "1 Month")
	{
		$instllamt = $rsinsurance_account["sum_assured"] / ($noofyears * 12);		
	}
	else if($rsinsurance_account["policy_term"] == "3 Month")
	{
		$instllamt = $rsinsurance_account["sum_assured"] / ($noofyears * 4);		
	}
	else if($rsinsurance_account["policy_term"] == "6 Month")
	{
		$instllamt = $rsinsurance_account["sum_assured"] / ($noofyears * 2);		
	}
	else if($rsinsurance_account["policy_term"] == "1 Year")
	{
		$instllamt = $rsinsurance_account["sum_assured"] / ($noofyears * 1);		
	}

$taxamt=$instllamt*$tax/100;
		
		$penaltyamt=0;
		$now = strtotime(date("Y-m-d")); // or your date as well
		$your_date =  strtotime($_GET["paydt"]);
		$datediff = $now -  $your_date;
		if(isset($_GET["paydt"]))
		{
		$penaltydays = floor($datediff / (60 * 60 * 24));	
		}
		else
		{
			$penaltydays = 0;
		}
		if($penaltydays > 30)
		{
		$penaltyamt = number_format(($instllamt * $rssettings[penalty_amt])/100, 2);
		}
		
$totalamt=$instllamt+$taxamt+$penaltyamt;
}

$_SESSION[randomid]=rand();
	
		


?>

<section id="contact-page">
<div class="container" >
<div class="center">        
<h2>POLICY PAYMENT</h2>
<p class="lead"></p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmpay" onsubmit="return validateform()">
<div align="center">
    <table  border="1" id="example" class="table table-striped table-bordered" cellspacing="0" >
    <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />
    <input type="hidden" name="insuranceaccid" value="<?php echo $_GET[acc]; ?>"  /> 
    
    <tr><th> <label for="Password"> Date:</label> </th><td><input type="date" class="form-control" required readonly name="pdate" value="<?php echo date("Y-m-d"); ?>" />
    <div class="cleaner_h10"></div></td></tr>
    
    <tr><th> <label for="author">Installment Amount:</label> </th><td><input type="text" name="insamt" class="form-control" required readonly value="<?php echo number_format($instllamt, 2) ?>" /><div class="cleaner_h10"></div></td></tr>
                        
                        
    <tr><th> <label for="Password">Tax Amount:(<?php echo $tax; ?>%)</label> </th><td><input type="text" class="form-control" required name="tamt" value="<?php echo number_format($taxamt, 2); ?>"  readonly="readonly" /><div class="cleaner_h10"></div></td></tr>
    
    
<?php
		if($penaltydays > 30)
		{
?>    
    <tr><th> <label for="Password">Penalty for delay payment:(<?php echo $rssettings[penalty_amt]; ?>%)<input type="hidden" name="penaltypercentage" value="<?php echo $rssettings[penalty_amt]; ?>"  /></label> </th><td><input type="text" class="form-control" required name="penaltyamt" value="<?php echo $penaltyamt; ?>"  readonly="readonly" /><div class="cleaner_h10"></div></td></tr>  
<?php
		}
?>
    <tr><th> <label for="Password">Total Amount:</label></th><td><input type="text" class="form-control" required name="tamt" value="<?php echo number_format($totalamt, 2); ?>"  readonly="readonly" /><div class="cleaner_h10"></div></td></tr>
    
    <tr><th>  <label for="Password">Payment Type:</label> </th><td>
    <select name="ttype" class="form-control" >
    <option value="">Select payment type</option>
    <?php
    $arr = array("Credit card","Debit card","VISA","Master card");
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
    </select></br><span id="idttype"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th> <label for="Password">Card Holder:</label> </th><td><input type="text" class="form-control"  name="cardholder" value="<?php echo $rsedit['card_holder']; ?>" /><span id="idcardholder"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th>  <label for="Password">Card Number:</label> </th><td><input type="text" class="form-control"  name="cardno" value="<?php echo $rsedit['card_no']; ?>" /><span id="idcardno"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th>  <label for="Password">CVV Number:</label> </th><td><input type="text" class="form-control"  name="cvvno" value="<?php echo $rsedit['card_no']; ?>" /><span id="idcvvno"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th>   <label for="Password">Expire Date:</label></th><td> <input type="month" class="form-control"  name="expiredate" value="<?php echo $rsedit['exp_date']; ?>" /><span id="idexpiredate"></span><div class="cleaner_h10"></div></td></tr>
    
    <?php
    if(isset($_SESSION[agent_id]))
    {
    ?>
    <tr><th> <label for="Password">Particulars:</label></th><td> <textarea  class="form-control"  name="part" /><?php echo $rsedit['particulars']; ?></textarea><span id="idpart"></span><div class="cleaner_h10"></div></td></tr>
    <?php
    }
    else
    {
    ?>
    <input type="hidden" name="part" value=" " /><span id="idpart"></span>
    <?php
    }
    ?>
    <tr><td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg" onclick="submit()" >Submit</button></div></td></tr>				
    
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

function validateform()
{
	var i=0;
	
	var alphaExp = /^[a-zA-Z]+$/;	//Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/;	//Variable to validate only alphabets with space
	var alphanumericExp = /^[a-zA-Z0-9]+$/;	//Variable to validate only alphanumerics
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	var mobileno = /^\d{10}$/;

	document.getElementById("idttype").innerHTML = "";
	document.getElementById("idcardholder").innerHTML = "";
	document.getElementById("idcardno").innerHTML = "";
	document.getElementById("idexpiredate").innerHTML = "";
	document.getElementById("idpart").innerHTML = "";
	document.getElementById("idcvvno").innerHTML = "";

	
	
	if(document.frmpay.ttype.value=="")
	{
		document.getElementById("idttype").innerHTML = "<font color='red'>Select payment type</font>";	
		document.frmpay.ttype.focus();
		i=1;
	}
	if(!document.frmpay.cardholder.value.match(alphaspaceExp))
	{
		document.getElementById("idcardholder").innerHTML = "<font color='red'>Card holder should contain only alphabets</font>";	
		document.frmpay.cardholder.focus();
		i=1;
	}
	if(document.frmpay.cardholder.value=="")
	{
		document.getElementById("idcardholder").innerHTML = "<font color='red'>Card holder cannot be empty</font>";	
		document.frmpay.cardholder.focus();
		i=1;
	}
	if(!document.frmpay.cardno.value.match(numericExpression))
	{
		document.getElementById("idcardno").innerHTML = "<font color='red'>Card number should contain only numeric values</font>";	
		document.frmpay.cardno.focus();
		i=1;
	}	
	if(document.frmpay.cardno.value.length !=16)
	{
		document.getElementById("idcardno").innerHTML = "<font color='red'>Card number should contain 16 digits</font>";	
		document.frmpay.cardno.focus();
		i=1;
	}	
	if(document.frmpay.cardno.value=="")
	{
		document.getElementById("idcardno").innerHTML = "<font color='red'>Card number cannot be empty</font>";	
		document.frmpay.cardno.focus();
		i=1;
	}
	if(!document.frmpay.cvvno.value.match(numericExpression))
	{
		document.getElementById("idcvvno").innerHTML = "<font color='red'>CVV number should contain only numerics</font>";	
		document.frmpay.cvvno.focus();
		i=1;
	}
	if(document.frmpay.cvvno.value.length !=3)
	{
		document.getElementById("idcvvno").innerHTML = "<font color='red'>CVV Number should contain 3 digits</font>";	
		document.frmpay.cvvno.focus();
		i=1;
	}
	
	if(document.frmpay.cvvno.value=="")
	{
		document.getElementById("idcvvno").innerHTML = "<font color='red'>CVV number cannot be empty</font>";	
		document.frmpay.cvvno.focus();
		i=1;
	}
	
	if(document.frmpay.expiredate.value=="")
	{
		document.getElementById("idexpiredate").innerHTML = "<font color='red'>Expire Date cannot be empty</font>";	
		document.frmpay.expiredate.focus();
		i=1;
	}	
	if(document.frmpay.part.value=="")
	{
		document.getElementById("idpart").innerHTML = "<font color='red'>Particulars cannot be empty</font>";	
		document.frmpay.part.focus();
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