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
    <section id="contact-page">
       <?php
include("datatables.php");
?> 
        <div class="container">
            <div class="center">        
                <h2>View Policy Claim Records</h2>
                <p class="lead"></p><br/>
              
            </div> 
          
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
               <div id="printarea">
                  <table border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Insurance Account</th>
                  <th scope="col">Withdrawal Date</th>
                  <th scope="col">Bank details</th>
                  <th scope="col">Withdrawal Amount</th>
                  <th scope="col">Withdrawal Status </th>
                  <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
               <?php
				$sql = "SELECT * FROM policy_withdrawal INNER JOIN insurance_account ON policy_withdrawal.insurance_account_id = insurance_account.insurance_account_id INNER JOIN customer ON customer.customer_id = insurance_account.customer_id WHERE insurance_account.status='Active'";
				if(isset($_SESSION[agent_id]))
				{
					$sql =  $sql . " AND customer.agent_id= '$_SESSION[agent_id]'";
				}
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqlpp = "SELECT * FROM insurance_account WHERE insurance_account_id='$rs[insurance_account_id]'";
					$qsqlpp = mysqli_query($con,$sqlpp);
					$rspp = mysqli_fetch_array($qsqlpp);		
                	echo " <tr>
						  <td>&nbsp;$rs[customer_name]</td>
						  <td>&nbsp;$rspp[insurance_account_id]</td>
						  <td>&nbsp;$rs[claim_date]</td>
						  <td>Bank name: $rs[bank_name]<br>A/c No.: $rs[bank_ac_no]<br>Branch: $rs[branch]<br>
Branch code: $rs[branch_code]</td>
						  <td>&nbsp;Rs. $rs[claim_amt]</td>
						  <td>&nbsp;$rs[claim_status]</td>
						  <td>&nbsp;<a href='policyclaim.php?insacid=$rspp[insurance_account_id]'>View</a> </td>
						</tr>";
				}
				?>
              </table>
              </tbody>
              </div>
               <center><input type="submit" value="Print" id="submit" name="submit" class="btn btn-primary btn-lg" onclick="printarea('printarea') ;" /></center>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

    <?php
	include("footer.php"); include("datatables.php");
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