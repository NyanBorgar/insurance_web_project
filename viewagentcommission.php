<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM commission_master where commission_master_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Commission record deleted successfully..');</script>";
	}
}
?>
    <section id="contact-page">
      
        <div class="container">
            <div class="center">        
                <h2>View Agent Records</h2>
                <p class="lead">Kindly enter the credentials</p>
              
            </div> 
          <?php
include("datatables.php");
?>
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
              
                   <table border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th scope="col">Insurance Scheme</th>
                  <th scope="col">Agent</th>
                  <th scope="col">Commission Amount</th>
                  <th scope="col">Transaction type</th>
                  <th scope="col">Transaction date</th>
                  <th scope="col">Particulars</th>
                  <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
				$sql = "SELECT * FROM commission_transaction";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqlinsurplan = "SELECT * FROM insurance_plan WHERE insurance_plan_id='$rs[insurance_plan_id]'";
					$qsqlinsurplan = mysqli_query($con,$sqlinsurplan);
					$rsinsurplan = mysqli_fetch_array($qsqlinsurplan);
					
					$sqlagent = "SELECT * FROM agent WHERE agent_id='$rs[agent_id]'";
					$qsqlagent = mysqli_query($con,$sqlagent);
					$rsagent = mysqli_fetch_array($qsqlagent);
					
                		echo " <tr>
						  <td>&nbsp;$rs[insurance_scheme_id]</td>
						  <td>&nbsp;$rsagent[agent_name] - $rsagent[agent_code]</td>
						  <td>&nbsp;$rs[commission_amt]</td>
						  <td>&nbsp;$rs[transaction_type]</td>
						  <td>&nbsp;$rs[transaction_date]</td>
						  <td>&nbsp;$rs[particulars]</td>						 
						  <td>&nbsp;<a href='commast.php?editid=$rs[commission_master_id]'>Edit</a> |  <a href='viewcommast.php?delid=$rs[commission_master_id]' onclick='return deleteconfirm()'>Delete</a></td>
						</tr>";
				}
				?>
              </table>
              </tbody>
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