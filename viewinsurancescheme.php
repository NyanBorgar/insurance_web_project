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
<div id="tooplate_main" style="width:1050px;">
      <h2>View Insurance Scheme</h2>
        <p>view and edit insurance scheme records</p>
<?php
include("datatables.php");
?>
            
            <div id="contact_form">
              <table  border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th scope="col">Insurance type</th>
                  <th scope="col">Insurance scheme</th>
                  <th scope="col">Registration Commission</th> 
                  <th scope="col">Renewal Commission</th>                 
                  <th scope="col">Note</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
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
						  <td>&nbsp;$rsinsurplan[insurance_type]</td>
						  <td>&nbsp;$rs[insurance_scheme]</td>
						  <td>&nbsp;$rs[agent_commission]%</td>
						  <td>&nbsp;$rs[agent_commission2]%</td>
						  <td>&nbsp;$rs[note]</td>
						  <td>&nbsp;$rs[status]</td>
						  <td>&nbsp;<a href='insurscheme.php?editid=$rs[insurance_scheme_id]'>Edit</a> |  <a href='viewinsurancescheme.php?delid=$rs[insurance_scheme_id]' onclick='return deleteconfirm()'>Delete</a></td>
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