<?php
include("header.php");
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM agent WHERE agent_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
if(isset($_GET[insuranceaccid]))
{
	$sqlaccountid = "SELECT * FROM insurance_account WHERE insurance_account_id='$_GET[insuranceaccid]'";
	$qsqlaccountid = mysqli_query($con,$sqlaccountid);
	$rsaccountid = mysqli_fetch_array($qsqlaccountid);
	
	$sqlinsurance_plan = "SELECT * FROM insurance_plan WHERE insurance_plan_id='$rsaccountid[insurance_plan_id]'";
	$qsqlinsurance_plan = mysqli_query($con,$sqlinsurance_plan);
	$rsinsurance_plan = mysqli_fetch_array($qsqlinsurance_plan);
	
	$sqlinsurance_plan = "SELECT * FROM insurance_plan WHERE insurance_plan_id='$rsaccountid[insurance_plan_id]'";
	$qsqlinsurance_plan = mysqli_query($con,$sqlinsurance_plan);
	$rsinsurance_plan = mysqli_fetch_array($qsqlinsurance_plan);
	
	$sqlinsurance_scheme = "SELECT * FROM insurance_scheme WHERE insurance_scheme_id='$rsinsurance_plan[insurance_scheme_id]'";
	$qsqlinsurance_scheme = mysqli_query($con,$sqlinsurance_scheme);
	$rsinsurance_scheme= mysqli_fetch_array($qsqlinsurance_scheme);
	$customer_id = $rsaccountid[customer_id];
}
if(isset($_GET[paymentid]))
{
	$sqlpaymentid = "SELECT * FROM policy_payment WHERE policy_payment_id='$_GET[paymentid]'";
	$qsqlpaymentid = mysqli_query($con,$sqlpaymentid);
	$rspaymentid = mysqli_fetch_array($qsqlpaymentid);
	
	$sqlaccountid = "SELECT * FROM insurance_account WHERE insurance_account_id='$rspaymentid[insurance_account_id]'";
	$qsqlaccountid = mysqli_query($con,$sqlaccountid);
	$rsaccountid = mysqli_fetch_array($qsqlaccountid);
	
	$sqlinsurance_plan = "SELECT * FROM insurance_plan WHERE insurance_plan_id='$rsaccountid[insurance_plan_id]'";
	$qsqlinsurance_plan = mysqli_query($con,$sqlinsurance_plan);
	$rsinsurance_plan = mysqli_fetch_array($qsqlinsurance_plan);
	
	$sqlinsurance_scheme = "SELECT * FROM insurance_scheme WHERE insurance_scheme_id='$rsinsurance_plan[insurance_scheme_id]'";
	$qsqlinsurance_scheme = mysqli_query($con,$sqlinsurance_scheme);
	$rsinsurance_scheme= mysqli_fetch_array($qsqlinsurance_scheme);
	$customer_id = $rsaccountid[customer_id];
	
	/*
	$sqlinsurance_plan = "SELECT * FROM insurance_plan WHERE insurance_plan_id='$rsaccountid[insurance_plan_id]'";
	$qsqlinsurance_plan = mysqli_query($con,$sqlinsurance_plan);
	$rsinsurance_plan = mysqli_fetch_array($qsqlinsurance_plan);
	*/
}
$_SESSION[randomid] = rand();
?>
    
<section id="contact-page">
<div class="container">
<div class="center">        
<h2>Policy Payment Receipt</h2>
<p class="lead"></p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="">
<div align="center">
<div id="printarea">
<table width="606" height="250" border="2">
<tr><td height="61" colspan="2"><div align="center"><img src="images/logo1.jpg" width="600" height="80"/></div></td></tr>

<tr><td width="253" height="99" valign="top"><label for="author"><b>Customer:</b></label> <br />
<?php
$sqlcustomer = "SELECT * FROM customer WHERE customer_id='$customer_id'";
$qsqlcustomer = mysqli_query($con,$sqlcustomer);
$rscustomer = mysqli_fetch_array($qsqlcustomer);
?>
<?php echo $rscustomer[customer_name]; ?><br />
<?php echo $rscustomer[cust_address]; ?><br />
<?php echo $rscustomer[cust_mobile]; ?><br />
</td><td width="337" valign="top"><label for="author"><strong>Branch:</strong><br />
Technopulse,
<br /> 
3rd floor, <br />
City light buiklding,<br />
Mangalore-01
</label></td></tr>
<div class="cleaner_h10"></div>
                
<tr><td height="40"><label for="author"><strong>Date Of Receipt:</strong></label><?php echo  date("d-M-Y",strtotime($rspaymentid[paid_date])); ?></td><td><label for="author"><strong>Installment No.:</strong>
<?php
$sqlpaymentid = "SELECT * FROM policy_payment WHERE insurance_account_id='$rsaccountid[insurance_account_id]'";
$qsqlpaymentid = mysqli_query($con,$sqlpaymentid);
echo mysqli_num_rows($qsqlpaymentid);
?>
</label></td></tr>
<tr><td height="38"><label for="author"><strong>Policy Number:</strong></label> <?php echo $rsaccountid[insurance_account_id]; ?></td><td><label for="author"><strong>Plan Name:</strong> <?php echo $rsinsurance_scheme[insurance_scheme]; ?></label></td></tr>
</table>
<table width="606" height="204" border="2">

<tr><td width="409" height="23" align="center"><strong>
<label for="author3">Particulars</label>
</strong></td>
<td width="181" align="center"><strong>
<label for="author3">Amount</label>
</strong></td></tr>

<tr><td height="115" valign="top">
&nbsp;&nbsp;<strong>Payment method:</strong> <?php echo $rspaymentid[trans_type]; ?><br />
&nbsp;&nbsp;<strong>Payment date:</strong> <?php echo $rspaymentid[paid_date]; ?></td>
<td valign="top" align="center">&nbsp;₹ <?php echo $rspaymentid[paid_amt]; ?></td></tr>

<tr><td height="28" align="right"><label for="author"><strong>Tax: (<?php echo $rspaymentid[tax_amt]; ?>%)</strong>
</label> </td><td align="center" >&nbsp;₹ <?php echo number_format(($rspaymentid[paid_amt]* $rspaymentid[tax_amt]/100), 2); ?></td></tr>

<?php
if( $rspaymentid[penalty_amt] > 0 )
{
?>
	<tr><td height="28" align="right"><label for="author"><strong>Penalty Amt: (<?php echo $rspaymentid[penalty_amt]; ?>%)</strong>
</label> </td><td align="center" >&nbsp;₹ <?php echo $penaltyamt = number_format(($rspaymentid[paid_amt]* $rspaymentid[penalty_amt]/100), 2); ?></td></tr>
<?php
}
?>
<tr><td height="26" align="right"><label for="author"><strong>Total:</strong></label> </td><td align="center" >₹ <?php echo number_format(($rspaymentid[paid_amt]* $rspaymentid[tax_amt]/100)+$rspaymentid[paid_amt]+$penaltyamt, 2); ?></td></tr><div class="cleaner_h10"></div>

</table>
</div>
<br />

 <center><input type="submit" value="Print" id="submit" name="submit" class="btn btn-primary btn-lg" onclick="printarea('printarea') ;" /></center>
</form>
</div>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>

<script type="application/javascript">
function printarea(elem)
{
		var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('</head><body >');
      	mywindow.document.write('<h1>' + document.title  + '</h1>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
}
</script>