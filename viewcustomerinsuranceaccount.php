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
?>
    <section id="contact-page">
       <?php
include("datatables.php");
?> 
        <div class="container">
            <div class="center">        
                <h2>View Insurance Account detail</h2>              
            </div> 
          
            <div class="row contact-wrap" > 
                <div class="status alert alert-success" style="display: none"></div>
              
                  <table  border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th width="4" scope="col">Account Number</th>
                  <th width="4" scope="col">Insurance type</th>
                  <th width="4" scope="col">Insurance scheme</th>
                  <th width="4" scope="col">Date Create</th>
                  <th width="4" scope="col">Maturity Date</th>
                  <th width="4" scope="col">Premium Type</th>
                  <th width="4" scope="col">Total Premium Amount</th>
                  <th width="4" scope="col">Profit Ratio</th>
                  <th width="4" scope="col">Sum Assured</th>
                  <th width="4" scope="col">View</th>
                </tr>
                </thead>
                <tbody>
                <?php
				$sql = "SELECT * FROM insurance_account where status='Active' AND customer_id='$_SESSION[customer_id]'";
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
					
                	echo " <tr>
						  <td>&nbsp;$rs[0]</td>
						  <td>&nbsp;$rsinsurance_type[insurance_type]</td>
						  <td>&nbsp;$rsinsurance_scheme[insurance_scheme]</td>
						  <td>&nbsp;$rs[date_create]</td>
						  <td>&nbsp;$rs[maturity_date]</td>
						  <td>&nbsp;$rs[policy_term]</td>
						  <td>&nbsp;₹ $rs[sum_assured]</td>
						  <td>&nbsp;$rs[profit_ratio]%</td>
						  <td>&nbsp;₹ $rs[total_amt]</td>
						  <td>&nbsp;<a href='viewcustomerinsuranceaccountmore.php?insacid=$rs[0]'>View More</a></td>
						</tr>";
				}
				?>
              </table>
              </tbody>
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