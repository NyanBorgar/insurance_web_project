<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM city where city_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('City record deleted successfully..');</script>";
	}
}
?>
    <section id="contact-page">
       <?php
include("datatables.php");
?> 
        <div class="container">
            <div class="center">        
                <h2>View City Records</h2>
                <p class="lead"></p><br/>
              
            </div> 
          
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
              
                  <table  border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
                <tr>
                  <th scope="col">State </th>
                  <th scope="col">City</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                 <?php
				$sql = "SELECT * FROM city";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
						$sqlstate = "SELECT * FROM state WHERE state_id='$rs[state_id]'";
						$qsqlstate = mysqli_query($con,$sqlstate);
						$rsstate = mysqli_fetch_array($qsqlstate);
                	echo " <tr>
						  <td>&nbsp;$rsstate[state]</td>
						  <td>&nbsp;$rs[city]</td>
						  <td>&nbsp;$rs[status]</td>
						  
						  <td>&nbsp;<a href='city.php?editid=$rs[city_id]'>Edit</a> | <a href='viewcity.php?delid=$rs[city_id]' onclick='return deleteconfirm()'>Delete</a></td>
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
</script>