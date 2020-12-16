<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM insurance_scheme where insurance_scheme_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Insurance scheme record deleted successfully..');</script>";
	}
}
?>
    <section id="contact-page">
       <?php
include("datatables.php");
?> 
        <div class="container">
            <div class="center">        
                <h2>View Insurance Scheme</h2>
                <p class="lead"></p>
              
            </div> 
          
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
              
                   <table  border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th width="11%" scope="col">Image</th>
                  <th width="23%" scope="col">Insurance type</th>
                  <th width="22%" scope="col">Agent Commission</th>               
                  <th width="28%" scope="col">Insurance scheme and Note</th>
                  <th width="7%" scope="col">Status</th>
                  <th width="9%" scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
				$sql = "SELECT * FROM insurance_scheme";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqlinsurplan = "SELECT * FROM insurance_type WHERE insurance_type_id='$rs[insurance_type_id]'";
					$qsqlinsurplan = mysqli_query($con,$sqlinsurplan);
					$rsinsurplan = mysqli_fetch_array($qsqlinsurplan);
                	echo " <tr>
						  <td><img src='insuranceimg/$rs[img]' width='50' height='50' ></td>
						  <td>&nbsp;$rsinsurplan[insurance_type]</td>
						  <td align='center'><strong>Commission for New Registration:</strong> <br><strong>$rs[agent_commission]%</strong><hr>
						  		<strong>Commission for Installment Payment:</strong><br> <strong>$rs[agent_commission2]%</strong>
						  </td>
						  
						  <td><strong>$rs[insurance_scheme]</strong><br>$rs[note]</td>
						  <td>&nbsp;$rs[status]</td>
						  <td>&nbsp;<a href='insurscheme.php?editid=$rs[insurance_scheme_id]'>Edit</a> |  <a href='viewinsurscheme.php?delid=$rs[insurance_scheme_id]' onclick='return deleteconfirm()'>Delete</a></td>
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