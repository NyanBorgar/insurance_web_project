<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM agent where agent_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Agent record deleted successfully..');</script>";
	}
}
?>
    <section id="contact-page">
      
        <div class="container">
            <div class="center">        
                <h2>View Agent Records</h2>
                <p class="lead"></p><br/>
            </div> 
            
<table  border="1" id="example" class="table table-striped table-bordered" cellspacing="0" >
   <thead>
    <tr>
      <th scope="col">Agent Name</th>
      <th scope="col">Agent code</th>
      <th scope="col">Address</th>
       <th scope="col">Email-Id</th>
        <th scope="col">Qualification</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
</thead>
    <tbody>
     <?php
    $sql = "SELECT * FROM agent";
    $qsql = mysqli_query($con,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
        echo " <tr>
              <td>&nbsp;$rs[agent_name]</td>
              <td>&nbsp;$rs[agent_code]</td>
              <td>&nbsp;$rs[agent_address]</td>
			  <td>&nbsp;$rs[email_id]</td>
			  <td>&nbsp;$rs[Qualification]</td>
               <td>&nbsp;$rs[status]</td>
              <td>&nbsp;<a href='agent.php?editid=$rs[agent_id]'>Edit</a> |  <a href='viewagent.php?delid=$rs[agent_id]' onclick='return deleteconfirm()'>Delete</a></td>
            </tr>";
    }
    ?>
    </tbody>
</table>
        </div><!--/.container-->
    </section><!--/#contact-page-->

    <?php
	include("footer.php"); include("datatables.php");
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
</script>
