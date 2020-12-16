<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM insurance_account where insurance_account_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Insurance account record deleted successfully..');</script>";
	}
}
			$sqlinsurance_account = "SELECT * FROM insurance_account where status='Active' AND insurance_account_id='$_GET[insacid]'";
				$qsqlinsurance_account = mysqli_query($con,$sqlinsurance_account);
				$rsinsurance_account = mysqli_fetch_array($qsqlinsurance_account);

	$sqlpolicy_withdrawal = "SELECT * FROM policy_withdrawal WHERE insurance_account_id='$_GET[insacid]'";
	$qsqlpolicy_withdrawal = mysqli_query($con,$sqlpolicy_withdrawal);
	$rspolicy_withdrawal = mysqli_fetch_array($qsqlpolicy_withdrawal);
?>
    <section id="contact-page">
       <?php
include("datatables.php");
?> 
        <div class="container">
            <div class="center">        
              <h2>Insurance Account detail</h2>              
            </div> 
          
            <div class="row contact-wrap" > 
                <div class="status alert alert-success" style="display: none"></div>
             <h4>Customer detail</h4>
             <table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th width="4" scope="col">Customer Name</th>
                  <th width="4" scope="col">Customer Address</th>
                  <th width="4" scope="col">Email-ID</th>
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
						  <td>&nbsp;$rscust[email_id]</td>
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
                  <th width="4" scope="col">Premium Type</th>
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
                	echo " <tr>
						  <td>&nbsp;₹ $rs[sum_assured]</td>
						  <td>&nbsp;$rs[profit_ratio]%</td>
						  <td>&nbsp;₹ $rs[total_amt]</td>
						</tr>";
						$sumassured = $rs[total_amt];
				}
				?>
              </tbody>
              </table>
              <hr />
             <h4>Payment detail</h4>          
            <table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
  				 <tr>
                  <th width="245" scope="col"><center><strong>Installment No.</strong></center></th>
                  <th width="410" scope="col">Installment Date</th>
                  <th width="410" scope="col">Installment Amount</th>
                  <th width="347" scope="col">Paid date</th>
                  <th width="280" scope="col">Payment status</th>
                  <th width="280" scope="col">Receipt</th>                  
                </tr>
                <?php
if($policy_term == "1 Month")		
{			 
	$ts1 = strtotime($datecreated);
	$ts2 = strtotime($maturitydate);
	
	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);
	
	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);
	
	$date1 = date('d', $ts1);
	$date2 = date('d', $ts2);
	
	$nyear = $year2 - $year1;
	
	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
	$incmonth=1;
	$paymonth = $nyear * 12;
}
else if($policy_term == "3 Month")		
{			 
	$ts1 = strtotime($datecreated);
	$ts2 = strtotime($maturitydate);
	
	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);
	
	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);
	
	$date1 = date('d', $ts1);
	$date2 = date('d', $ts2);
	
	$nyear = $year2 - $year1;
	
	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
	$incmonth=3;	
	$paymonth = $nyear* 4;
}
else if($policy_term == "6 Month")		
{			 
	$ts1 = strtotime($datecreated);
	$ts2 = strtotime($maturitydate);
	
	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);
	
	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);
	
	$date1 = date('d', $ts1);
	$date2 = date('d', $ts2);
	
	 $nyear = $year2 - $year1;
	
	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
	$incmonth=6;	
	$paymonth = $nyear* 2;
}
else if($policy_term == "1 Year")		
{			 
	$ts1 = strtotime($datecreated);
	$ts2 = strtotime($maturitydate);
	
	$year1 = date('Y', $ts1);
	$year2 = date('Y', $ts2);
	
	$month1 = date('m', $ts1);
	$month2 = date('m', $ts2);
	
	$date1 = date('d', $ts1);
	$date2 = date('d', $ts2);
	
	$nyear = $year2 - $year1;
	
	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
	$incmonth=12;	
	$paymonth = $nyear;
}
$paynext = "";
$installmentno = 1;

				for($i=0; $i<$diff; $i=$i+$incmonth)
				{					
				?>
                    <tr>
                      <td width="245"><center><strong><?php echo $installmentno ; ?></strong></center></td>
                      <td width="410">
                      <?php
							echo date("d-M-Y",mktime(0,0,0,$month2+$i,$date1,$year1));
					  ?>
                      </td>
                      <td width="347">
					<?php              
                            echo  "₹ ".round($invamt / $paymonth, 2);
                    ?>	
                      </td>
                      <td width="410">
                      <?php
					  		//###############
							$sqlpolicy_payment = "SELECT * FROM policy_payment where insurance_account_id='$_GET[insacid]' ";
							$qsqlpolicy_payment = mysqli_query($con,$sqlpolicy_payment);
								$rspolicy_payment = mysqli_fetch_array($qsqlpolicy_payment);
							if(mysqli_num_rows($qsqlpolicy_payment) >= $installmentno )
							{
								echo $rspolicy_payment[paid_date];
							}
							else
							{
								if($paynext == "")
								{	
									if(mysqli_num_rows($qsqlpolicy_withdrawal) == 0)
									{
									echo "<a href='policypay.php?acc=$_GET[insacid]&paydt=" . date("Y-m-d",mktime(0,0,0,$month2+$i,$date1,$year1)) ."'>Make Payment</a>";														
									}
									$paynext="set";
								}
							}
					  ?>
                      </td>
                      <td width="280">
                      <?php
					  if(mysqli_num_rows($qsqlpolicy_payment) >= $installmentno )
							{
								echo "Paid";
							}
							else
							{
								echo "Pending";
							}
					  ?>
                      </td>      
                      <td width="280">
                      <?php
					  if(mysqli_num_rows($qsqlpolicy_payment) >= $installmentno)
							{
								$insno=$i+1;
								echo "<a href='policyreceipt.php?paymentid=$rspolicy_payment[policy_payment_id]&insno=". $insno ."'>Download</a>";
							}
					  ?>                      
                      </td>                	
                    </tr>
                <?php
				$installmentno = $installmentno +1;
				}
				?>
                </table>

<?php
 $matdate = strtotime($maturitydate);
 $currdate = strtotime($dt);
if($currdate >= $matdate)
{
?>                
                <form method="get" action="policyclaim.php">
                <input type="hidden" name="insacid" value="<?php echo $_GET[insacid]; ?>" >
                <input type="hidden" name="sumassured" value="<?php echo $sumassured; ?>" >
                    <table  border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                         <tr>
                          <th width="245" scope="col">
	<?php
	if(mysqli_num_rows($qsqlpolicy_withdrawal) ==0)
	{
	?>                          
			   <center><input type="submit" name="btnclaim" value="Click here to Claim policy"  class="btn btn-primary btn-lg" ></center>
	<?php
	}
	else
	{
	?>           
			   <center><input type="submit" name="btnclaim" value="View report"  class="btn btn-primary btn-lg" ></center>           
	<?php
	}
?>                          
                          </th>
                          </tr>
                    </table> 
            	</form> 
<?php
}
else
{
?>
				<form method="get" action="policyclaim.php">
                	<input type="hidden" name="insacid" value="<?php echo $_GET[insacid]; ?>" >
                	<input type="hidden" name="sumassured" value="<?php echo $sumassured; ?>" >
<?php
	if(mysqli_num_rows($qsqlpolicy_withdrawal) ==0)
	{  
?>
			   		<center><input type="submit" name="btncancel" value="Cancel Policy"  class="btn btn-primary btn-lg" ></center>  
               
	<?php
	}
	else
	{
	?>           
             	 <center><input type="submit" name="btncancel" value="View report"  class="btn btn-primary btn-lg" ></center>        
<?php
	}
?>
				</form>
<?php
}
?>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

<?php
include("footer.php");
include("datatables.php");
?>
<script type="application/javascript">
function deleteconfirm()
{
	if(confirm("Are you sure want to delete this record") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function calculateinterest()
{

	if(document.getElementById("month").value == "3 Month")
	{
		document.getElementById("instllamt").value = parseFloat(document.getElementById("invstamt").value / (document.getElementById("nyear").value * 4)).toFixed(2);
		document.getElementById("inttamt").value = parseFloat((document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
			document.getElementById("tamt").value =     parseFloat( parseFloat(document.getElementById("invstamt").value)  + (document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
	}
	else if(document.getElementById("month").value == "6 Month")
	{
		document.getElementById("instllamt").value = parseFloat(document.getElementById("invstamt").value / (document.getElementById("nyear").value * 2)).toFixed(2);
		document.getElementById("inttamt").value = parseFloat((document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
			document.getElementById("tamt").value =     parseFloat( parseFloat(document.getElementById("invstamt").value)  + (document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
	}
	else if(document.getElementById("month").value == "1 Year")
	{
		document.getElementById("instllamt").value = parseFloat(document.getElementById("invstamt").value / (document.getElementById("nyear").value * 1)).toFixed(2);
		document.getElementById("inttamt").value = parseFloat((document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
			document.getElementById("tamt").value =     parseFloat( parseFloat(document.getElementById("invstamt").value)  + (document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
	}
}
</script>