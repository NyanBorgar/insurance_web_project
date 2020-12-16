<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM employee where employee_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Employee record deleted successfully..');</script>";
	}
}
?>
    <section id="contact-page">
       <?php
include("datatables.php");
?> 
        <div class="container">
            <div class="center">        
                <h2>View Employee Records</h2>
                <p class="lead"></p>
              
            </div> 
          
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
              
                 <table border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th scope="col">Emp Type</th>
                  <th scope="col">Emp Name</th>
                  <th scope="col">Login ID</th>
                  <th scope="col">Password</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
               <?php
				$sql = "SELECT * FROM employee";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
                	echo " <tr>
						  <td>&nbsp;$rs[emp_type]</td>
						  <td>&nbsp;$rs[emp_name]</td>
						  <td>&nbsp;$rs[login_id]</td>
						  <td>&nbsp;$rs[password]</td>
						  <td>&nbsp;$rs[status]</td>
						  <td>&nbsp;<a href='employee.php?editid=$rs[employee_id]'>Edit</a> |  <a href='viewemployee.php?delid=$rs[employee_id]' onclick='return deleteconfirm()'>Delete</a></td>
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