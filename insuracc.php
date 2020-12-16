<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
			$sql = "UPDATE insurance_account SET customer_id='$_POST[cust]',insurance_plan_id='$_POST[iplan]',date_create='$_POST[date]',maturity_date='$_POST[mdate]',policy_term='$_POST[pterm]',sum_assured='$_POST[suma]',profit_ratio='$_POST[profit]',total_amt='$_POST[total]',status='$_POST[status]' WHERE insurance_account_id='$_GET[editid]'";
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
			$sql = "INSERT INTO insurance_account (customer_id, insurance_plan_id,date_create,maturity_date,policy_term,sum_assured, profit_ratio,total_amt,status) VALUES ('$_SESSION[customer_id]','$_POST[insurance_plan_id]', '$_POST[createddate]','$_POST[mdate]','$_POST[month]','$_POST[invstamt]','$_POST[percentage]','$_POST[tamt]','Pending')";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				$insuracc=mysqli_insert_id($con);
				echo "<script>window.location='policypay.php?acc=$insuracc';</script>";
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
	$sqledit = "SELECT * FROM insurance_account WHERE insurance_account_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
if(isset($_GET[policyid]))
{

	$insurplan="SELECT * FROM insurance_plan WHERE insurance_scheme_id='$_GET[policyid]'";
	$insurplan1=mysqli_query($con,$insurplan);
	$rsedit1=mysqli_fetch_array($insurplan1);
	
	$sqlis = "SELECT * FROM insurance_scheme WHERE insurance_scheme_id='$_GET[policyid]'";
	$qsqlis = mysqli_query($con,$sqlis);
	$rsis = mysqli_fetch_array($qsqlis);
	
	$sqlinsurance_type = "SELECT * FROM insurance_type WHERE insurance_type_id='$rsis[insurance_type_id]'";
	$qsqlinsurance_type = mysqli_query($con,$sqlinsurance_type);
	$rsinsurance_type = mysqli_fetch_array($qsqlinsurance_type);
}
$_SESSION[randomid]=rand();
?>
    
<section id="contact-page">
<div class="container">
<div class="center">        
<h2>Insurance Account details</h2>
<p>Kindly confirm before making payment..</p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post" name="contact" action="">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>" />
<input type="hidden" name="insurance_plan_id" value="<?php echo $rsedit1[insurance_plan_id]; ?>" />			
<div align="center">

     <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0">
    
    <tr><td > <div align="left"><label>Insurance type:</label></div></td>
    <td ><input type="text" readonly name="insurance_type" value="<?php echo $rsinsurance_type[insurance_type]; ?>"  class="form-control" required /></td></tr>
    
    <tr><td><div align="left"><label>Insurance scheme:</label></div></td>
    <td ><input type="text" readonly  name="insurance_scheme" value="<?php echo $rsis[insurance_scheme]; ?>"  class="form-control" required   /></td></tr>
    
    <tr><td ><div align="left"><label>No. of years:</label></div></td>
    <td><input type="text" readonly  name="nyear" value="<?php echo $_GET[nyear]; ?>" class="form-control" required /></td></tr>
    
    <tr><td><div align="left"><label>Profit Ratio: (In %)</label></div></td>
    <td><input type="text" readonly   name="percentage" value="<?php echo  $_GET[percentage]; ?>" class="form-control" required /></td></tr>
    
    <tr><td><div align="left"><label>Total Investment Amount:</label></div></td>
    <td><input type="text" readonly   name="invstamt" value="<?php echo $_GET[invstamt]; ?>"  class="form-control" required /></td></tr>
    
    <tr><td><label for="Password4"><div align="left">Premium type:</div>
    </label></td><td><input type="text" readonly   name="month" value="<?php echo $_GET[month]; ?>" class="form-control" required /></td>
    </tr>
    
    <tr><td><label for="Password4"><div align="left">Installment amount:</div></label></td>
    <td><input type="text" readonly   name="installmentamt" value="<?php echo $_GET[instllamt]; ?>"  class="form-control" required   /></td></tr>
    
    <tr><td><div align="left"><label>Interest Amount:</label></div></td>
    <td><input type="text" readonly  name="inttamt" value="<?php echo $_GET[inttamt]; ?>"  class="form-control" required  /></td></tr>
    
    <tr><td><div align="left"><label>Total Amount:</label></div></td>
    <td><input type="text" readonly  name="tamt" value="<?php echo $_GET[tamt]; ?>"  class="form-control" required  /></td></tr>
    
    <tr><td><div align="left"><label>Date Created:</label></div></td>
    <td><input type="date" class="form-control" required   name="createddate" value="<?php echo date("Y-m-d"); ?>" readonly /></td></tr>
    
    <tr>
    <td><div align="left"><label>Maturity Date :</label></div></td>
    <td>
    <?php
    $some_var = date("Y-m-d",strtotime("$_GET[nyear] year"));
    ?>
    <input type="date" name="mdate" readonly class="form-control" required value="<?php echo $some_var ; ?>" /></td>
    </tr>
    
    <tr>
    <td colspan="2">
    <div align="center">
    <?php
    if(isset($_SESSION[customer_id]))
    {
    ?>
    <input type="submit" value="Click here to Proceed" id="submit" name="submit" class="btn btn-primary btn-lg" />
    <?php
    }
    else
    {
    $currenturl = "policyid=$_GET[policyid]&percentage=$_GET[percentage]&nyear=$_GET[nyear]&invstamt=$_GET[invstamt]&month=$_GET[month]&instllamt=$_GET[instllamt]&inttamt=$_GET[inttamt]&tamt=$_GET[tamt]";
    echo "<strong><a href='login.php?$currenturl'>Click here to Login>></a></strong>";
    }
    ?>
    </div></td>
    </tr>
    
    </div>
    </table>
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>