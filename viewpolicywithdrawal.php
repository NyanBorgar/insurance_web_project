<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM policy_withdrawal where policy_withdrawal_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Policy withdrawal record deleted successfully..');</script>";
	}
}
?>
<div id="tooplate_main" style="width:1050px;">
   <h2>View Policy Withdrawal</h2>
        <p>view and edit policy withdrawal records</p>
     
            <?php
include("datatables.php");
?>
            <div id="contact_form">
              <table border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th scope="col">Insurance Account</th>
                  <th scope="col">Withdrawal Amount</th>
                  <th scope="col">Withdrawal Date</th>
                  <th scope="col">Bank Name</th>
                  <th scope="col">Bank AC NO</th>
                  <th scope="col">Branch</th>
                  <th scope="col">Branch Code</th>
                  <th scope="col">Withdrawal Status </th>
                  <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
               <?php
				$sql = "SELECT * FROM policy_withdrawal";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqlpp = "SELECT * FROM insurance_account WHERE insurance_account_id='$rs[insurance_account_id]'";
					$qsqlpp = mysqli_query($con,$sqlpp);
					$rspp = mysqli_fetch_array($qsqlpp);		
                	echo " <tr>
						  <td>&nbsp;$rspp[insurance_account_id]</td>
						  <td>&nbsp;$rs[withdrawal_amt]</td>
						  <td>&nbsp;$rs[withdrawal_date]</td>
						  <td>&nbsp;$rs[bank_name]</td>
						  <td>&nbsp;$rs[bank_ac_no]</td>
						  <td>&nbsp;$rs[branch]</td>
						  <td>&nbsp;$rs[branch_code]</td>
						  <td>&nbsp;$rs[withdraw_status]</td>
						  <td>&nbsp;<a href='policywith.php?editid=$rs[policy_withdrawal_id]'>Edit</a> | <a href='viewpolicywithdrawal.php?delid=$rs[policy_withdrawal_id]' onclick='return deleteconfirm()'>Delete</a></td>
						</tr>";
				}
				?>
              </table>
              </tbody>
          </div>
<div class="cleaner"></div>
</div>
<div class="cleaner"></div> 


<?php include("footer.php");
?>
<script type="application/javascript">
function deleteconfirm()
{
	if(confirm("Are you sure you want to delete this record") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}