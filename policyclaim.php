<?php
include("header.php");
	
$sqlsettings = "SELECT * FROM settings WHERE settings_id='1'";
$qsqlsettings = mysqli_query($con,$sqlsettings);
$rssettings = mysqli_fetch_array($qsqlsettings);
	
//if($_SESSION[randomid]==$_POST[randomid])
{
	//echo $_POST[bname];
	if(isset($_POST[submit]))
	{
				if(isset($_SESSION[employee_id]))
				{
						$sql =  "UPDATE policy_withdrawal SET particulars='$_POST[particulars]',claim_status='$_POST[claimstatus]' WHERE insurance_account_id='$_GET[insacid]'";
						$qsql = mysqli_query($con,$sql);
						if(mysqli_affected_rows($con) == 1 )
						{
							echo "<script>alert('Policy Claim Record updated successfully...');</script>";
						}
						else
						{
							echo "Failed to insert  record.." . mysqli_error($con);
						}
				}
				else
				{
						 $sql = "INSERT INTO policy_withdrawal (insurance_account_id,claim_amt,claim_date,bank_name,bank_ac_no, branch, branch_code,claim_status) VALUES ('$_POST[insuranceaccid]','$_POST[sumassured]','$dt','$_POST[bname]','$_POST[baccno]','$_POST[branch]','$_POST[bcode]','Pending')";
						$qsql = mysqli_query($con,$sql);
						if(mysqli_affected_rows($con) == 1 )
						{
							echo "<script>alert('Policy Claim request sent successfully...');</script>";
						}
				}
	}
	
}
	$_SESSION[randomid]=rand();
	$sqlinsurance_account = "SELECT * FROM insurance_account where status='Active' AND insurance_account_id='$_GET[insacid]'";
	$qsqlinsurance_account = mysqli_query($con,$sqlinsurance_account);
	$rsinsurance_account = mysqli_fetch_array($qsqlinsurance_account);
	
	
	$sqlpolicy_withdrawal = "SELECT * FROM policy_withdrawal WHERE insurance_account_id='$_GET[insacid]'";
	$qsqlpolicy_withdrawal = mysqli_query($con,$sqlpolicy_withdrawal);
	$rspolicy_withdrawal = mysqli_fetch_array($qsqlpolicy_withdrawal);
?>

<section id="printarea">
<div class="container">
<div class="center">        
<?php
if(isset($_GET[btncancel]))
{
?>
<h2>POLICY CANCELLATION REQUEST FORM</h2>
<?php
}
else
{
?>
<h2>POLICY CLAIM REQUEST FORM</h2>
<?php
}
?>
<p class="lead"></p>
</div> 
<div class="row contact-wrap" > 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" name="frmclaim" method="post"  action=""  onsubmit="return validateform()">
<div align="center" >

             <h4>Customer detail</h4>
             <table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th width="4" scope="col">Customer Name</th>
                  <th width="4" scope="col">Customer Address</th>
                  <th width="4" scope="col">Customer Mobile No.</th>
                  <th width="4" scope="col">Login ID</th>
                  
                </tr>
                </thead>
                <tbody>
             <?php
			 $sqlcust="SELECT * FROM customer where customer_id='$rsinsurance_account[customer_id]'";
			$qsqlcust = mysqli_query($con,$sqlcust);
			$rscust = mysqli_fetch_array($qsqlcust);
			 echo " <tr>
						  <td>&nbsp;$rscust[customer_name]</td>
						  <td>&nbsp;$rscust[cust_address]</td>
						  <td>&nbsp;$rscust[cust_mobile]</td>
						  <td>&nbsp;$rscust[login_id]</td>
						</tr>";
			 ?>
             
             
             </tbody>
              </table>
              <h4>Account detail</h4>
              <table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th width="4" scope="col">Account Number</th>
                  <th width="4" scope="col">Insurance type</th>
                  <th width="4" scope="col">Insurance scheme</th>
                  <th width="4" scope="col">Date Create</th>
                  <th width="4" scope="col">Maturity Date</th>
                  <th width="4" scope="col">Policy Term</th>
                </tr>
                </thead>
                <tbody>
                <?php
				
					$sqlinsurplan = "SELECT * FROM insurance_plan WHERE insurance_plan_id='$rsinsurance_account[insurance_plan_id]'";
					$qsqlinsurplan = mysqli_query($con,$sqlinsurplan);
					$rsinsurplan = mysqli_fetch_array($qsqlinsurplan);
					
					$sqlinsurance_scheme = "SELECT * FROM insurance_scheme WHERE insurance_scheme_id='$rsinsurplan[insurance_scheme_id]'";
					$qsqlinsurance_scheme = mysqli_query($con,$sqlinsurance_scheme);
					$rsinsurance_scheme = mysqli_fetch_array($qsqlinsurance_scheme);	
					
					$sqlinsurance_type = "SELECT * FROM insurance_type WHERE insurance_type_id='$rsinsurance_scheme[insurance_type_id]'";
					$qsqlinsurance_type = mysqli_query($con,$sqlinsurance_type);
					$rsinsurance_type = mysqli_fetch_array($qsqlinsurance_type);
					
                	echo " <tr>
						  <td>&nbsp;$rsinsurance_account[0]</td>
						  <td>&nbsp;$rsinsurance_type[insurance_type]</td>
						  <td>&nbsp;$rsinsurance_scheme[insurance_scheme]</td>
						  <td>&nbsp;$rsinsurance_account[date_create]</td>
						  <td>&nbsp;$rsinsurance_account[maturity_date]</td>
						  <td>&nbsp;$rsinsurance_account[policy_term]</td>
						</tr>";
						$datecreated = $rsinsurance_account[date_create];
						$maturitydate = $rsinsurance_account[maturity_date];
						$policy_term = $rsinsurance_account[policy_term];
				?>
              </tbody>
              </table>
              <hr />

<?php
if(isset($_GET[btncancel]))
{
?>             
              <h4>Premium detail</h4>
              <table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th width="4" scope="col">Total Paid amount</th>
                  <th width="4" scope="col">Total Deductions(<?php echo $rssettings[claim_deducation]; ?>%)</th>
                  <th width="4" scope="col">Refundable amount</th>
                </tr>
                </thead>
                <tbody>
                <?php

					$sqlpolicy_payment = "SELECT SUM(paid_amt) FROM policy_payment WHERE insurance_account_id='$_GET[insacid]'";
					$qsqlpolicy_payment = mysqli_query($con,$sqlpolicy_payment);
					$rspolicy_payment = mysqli_fetch_array($qsqlpolicy_payment);
					
                	echo "<tr>
						  <td>&nbsp;₹ " .  round($rspolicy_payment[0]) . " </td>
						  <td>&nbsp;₹ ".   $deductionamt = round(($rssettings[claim_deducation] * $rspolicy_payment[0]) / 100) .  " </td>";
						$refundamt =    round($rspolicy_payment[0] - $deductionamt) ;
					echo " <td>&nbsp;₹ " .  $refundamt . "</td>
						</tr>";
						
						$sumassured =$refundamt;
				?>
              </tbody>
              </table>
<?php
}
else
{
?>
              <h4>Premium detail</h4>
              <table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th width="4" scope="col">Total Premium Amount</th>
                  <th width="4" scope="col">Profit Ratio</th>
                  <th width="4" scope="col">Sum Assured</th>
                </tr>
                </thead>
                <tbody>
                <?php
				$sql = "SELECT * FROM insurance_account where status='Active' AND insurance_account_id='$_GET[insacid]'";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqlinsurplan = "SELECT * FROM insurance_plan WHERE insurance_plan_id='$rs[insurance_plan_id]'";
					$qsqlinsurplan = mysqli_query($con,$sqlinsurplan);
					$rsinsurplan = mysqli_fetch_array($qsqlinsurplan);
					
					$sqlinsurance_scheme = "SELECT * FROM insurance_scheme WHERE insurance_scheme_id='$rsinsurplan[insurance_scheme_id]'";
					$qsqlinsurance_scheme = mysqli_query($con,$sqlinsurance_scheme);
					$rsinsurance_scheme = mysqli_fetch_array($qsqlinsurance_scheme);	
					
					$sqlinsurance_type = "SELECT * FROM insurance_type WHERE insurance_type_id='$rsinsurance_scheme[insurance_type_id]'";
					$qsqlinsurance_type = mysqli_query($con,$sqlinsurance_type);
					$rsinsurance_type = mysqli_fetch_array($qsqlinsurance_type);
					$invamt = $rs[sum_assured];
                	echo "<tr>
						  <td>&nbsp;₹ $rs[sum_assured]</td>
						  <td>&nbsp;$rs[profit_ratio]%</td>
						  <td>&nbsp;₹ $rs[total_amt]</td>
						</tr>";
						$sumassured = $rs[total_amt];
				}
				?>
              </tbody>
              </table>
<?php
}
?>
              
              <hr />
<input type="hidden" name="insuranceaccid" value="<?php echo $_GET[insacid]; ?>" >
<input type="hidden" name="sumassured" value="<?php echo $sumassured; ?>" >
<h4>Kindly enter bank details to Claim policy</h4>
<?php
if(mysqli_num_rows($qsqlpolicy_withdrawal) >=1)
{
?> 
    <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" >
    
    <tr><th width="48%"><label for="Password">Bank Name:</label>  </th><td width="52%"><?php echo $rspolicy_withdrawal[bank_name]; ?><span id=""></span></td></tr>
    
    <tr><th> <label for="Password">Bank Account No.:</label> </th><td><?php echo $rspolicy_withdrawal[bank_ac_no]; ?></td></tr>
    
    <tr><th> <label for="Password">Branch:</label> </th><td><?php echo $rspolicy_withdrawal[branch]; ?></td></tr>
    
    <tr><th> <label for="Password">Branch Code:</label>  </th><td><?php echo $rspolicy_withdrawal[branch_code]; ?></td></tr>			
    
    </table>


<?php
if(isset($_SESSION[employee_id]))
{
?>
    <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" >
    <tr><th><label for="Password">Claim Status:</label>  </th><td>
     <select name="claimstatus" class="form-control" >
    <?php
    $arr = array("Completed","Pending");
    foreach($arr as $val)
    {
        if($val == $rspolicy_withdrawal[claim_status])
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
    <div class="cleaner_h10"></div></td></tr>
    
    <tr><th> <label for="Password">Particulars.:</label> </th><td> 
    <textarea name="particulars"  class="form-control" ><?php echo $rspolicy_withdrawal['particulars']; ?></textarea>
    <div class="cleaner_h10"></div></td></tr>	
    
    <tr><td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg" onclick="submit()" >Complete Claim Request</button></div></td></tr>
    
    </table>
<?php
}
else
{
?>

    <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" >
    <tr><th width="48%"><label for="Password">Receivable Amount:</label>  </th><td width="52%"><?php echo " ₹ " . $sumassured; ?></td></tr>
    <tr><th width="48%"><label for="Password">Claim Status:</label>  </th><td width="52%"><?php echo $rspolicy_withdrawal['claim_status']; ?></td></tr>
    
    <tr><th> <label for="Password">Particularts:</label> </th><td><?php echo $rspolicy_withdrawal['particulars']; ?><div class="cleaner_h10"></div></td></tr>	
    
    </table><br />
    
<center><input type="button" value="Print" id="submit" name="submit" class="btn btn-primary btn-lg" onclick="printarea('printarea') ;" /></center>
<?php
}
?>
<?php
}
else
{
?>
    <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" >    
    <tr><th><label for="Password">Bank Name:</label>  </th><td><input type="text" class="form-control" name="bname" value="<?php echo $rsedit['bank_name']; ?>" /><div class="cleaner_h10"></div><span id="idbname"></span></td></tr>    
    <tr><th> <label for="Password">Bank Account No.:</label> </th><td> <input type="text" class="form-control"  name="baccno" value="<?php echo $rsedit['bank_ac_no']; ?>" /><div class="cleaner_h10"></div><span id="idbaccno"></span></td></tr>    
    <tr><th> <label for="Password">Branch:</label> </th><td> <input type="text" class="form-control"  name="branch" value"<?php echo $rsedit['branch']; ?>" /><div class="cleaner_h10"></div><span id="idbranch"></span></td></tr>    
    <tr><th> <label for="Password">Branch Code:</label>  </th><td><input type="text" class="form-control"  name="bcode" value"<?php echo $rsedit['branch_code']; ?>"/><div class="cleaner_h10"></div><span id="idbcode"></span></td></tr>    
    <tr><td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg" onclick="submit()" >Click Here to Send request</button></div></td></tr>				
    </table>
<?php
}
?>
</div>		
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php");
include("datatables.php");
?>

<script type="application/javascript">

function validateform()
{
	var i=0;
	
	var alphaExp = /^[a-zA-Z]+$/;	//Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/;	//Variable to validate only alphabets with space
	var alphanumericExp = /^[a-zA-Z0-9]+$/;	//Variable to validate only alphanumerics
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	var cardno = /^\d{10}$/;
	
	document.getElementById("idbname").innerHTML = "";
	document.getElementById("idbaccno").innerHTML = "";
	document.getElementById("idbranch").innerHTML = "";
	document.getElementById("idbcode").innerHTML = "";
	
	if(!document.frmclaim.bname.value.match(alphaspaceExp))
	{
		document.getElementById("idbname").innerHTML = "<font color='red'>Bank name should contain only alphabets</font>";	
		document.frmclaim.bname.focus();
		i=1;
	}	
	
	if(document.frmclaim.bname.value=="")
	{
		document.getElementById("idbname").innerHTML = "<font color='red'>Bank name cannot be empty</font>";	
		document.frmclaim.bname.focus();
		i=1;
	}	
	if(!document.frmclaim.baccno.value.match(numericExpression))
	{
		document.getElementById("idbaccno").innerHTML = "<font color='red'>Bank accno should contain only numbers</font>";	
		document.frmclaim.baccno.focus();
		i=1;
	}	
	if(document.frmclaim.baccno.value=="")
	{
		document.getElementById("idbaccno").innerHTML = "<font color='red'>Bank name cannot be empty</font>";	
		document.frmclaim.baccno.focus();
		i=1;
	}	
	if(!document.frmclaim.branch.value.match(alphaspaceExp))
	{
		document.getElementById("idbranch").innerHTML = "<font color='red'>Branch name should contain only alphabets</font>";	
		document.frmclaim.branch.focus();
		i=1;
	}	
	if(document.frmclaim.branch.value=="")
	{
		document.getElementById("idbranch").innerHTML = "<font color='red'>Bank name cannot be empty</font>";	
		document.frmclaim.branch.focus();
		i=1;
	}	
	if(!document.frmclaim.bcode.value.match(numericExpression))
	{
		document.getElementById("idbcode").innerHTML = "<font color='red'>Bank code should contain only numeric values</font>";	
		document.frmclaim.bcode.focus();
		i=1;
	}
	if(document.frmclaim.bcode.value=="")
	{
		document.getElementById("idbcode").innerHTML = "<font color='red'>Bank name cannot be empty</font>";	
		document.frmclaim.bcode.focus();
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

</script><script type="application/javascript">
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