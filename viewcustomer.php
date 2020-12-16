<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM customer where customer_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer record deleted successfully..');</script>";
	}
}
?>

       <?php
include("datatables.php");
?> 
        <div class="container">
            <div class="center">        
                <h2>View Customer Records</h2>
                              <p class="lead"></p>

            </div> 
          
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                   <div id="printarea">
                  <table border="1"  id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Cust DOB</th>
                  <th scope="col">Login ID</th>
                  <th scope="col">Address</th>
                  <th scope="col">Mobile</th>
                  <th scope="col">Nominee</th>
                  <th scope="col">Nominee Relation</th>
                  <th scope="col">Status</th>
                  <th scope="col">Document</th>
                  <?php
				  if(isset($_SESSION[employee_id]))
				  {
				  ?>
                  <th scope="col">Action</th>
                  <?php
				  }
				  ?>
                </tr>
                </thead>
                <tbody>
                </div>
               <?php
				$sql = "SELECT * FROM customer where customer_id != '' ";
				if(isset($_SESSION[agent_id]))
				{
					$sql  = $sql . " and agent_id='$_SESSION[agent_id]'";
				}
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqlstate="SELECT * FROM state where state_id='$rs[state_id]'";
					$qsqlstate = mysqli_query($con,$sqlstate);
					$rsstate = mysqli_fetch_array($qsqlstate);
					
					$sqlcity="SELECT * FROM city where city_id='$rs[city_id]'";
					$qsqlcity = mysqli_query($con,$sqlcity);
					$rscity = mysqli_fetch_array($qsqlcity);
					
                	echo " <tr>
						  <td>&nbsp;$rs[customer_name]</td>
						  <td>&nbsp;$rs[cust_dob]</td>
						  <td>&nbsp;$rs[login_id]</td>
						  <td>&nbsp;$rs[cust_address]<br />$rscity[city]<br />$rsstate[state]<br />PIN - $rs[pin]</td>
						  <td>&nbsp;$rs[cust_mobile]</td>
						  <td>&nbsp;$rs[nominee]</td>
						  <td>&nbsp;$rs[nominee_relation]</td>
						  <td>&nbsp;$rs[status]</td>
							 <td>&nbsp;<a href='viewcustdocu.php?custdocid=$rs[customer_id]'>View Documents</a></td>";
								if(isset($_SESSION[employee_id]))
								{
							  echo " <td>&nbsp; <a href='customer.php?editid=$rs[customer_id]'>Edit</a> |  <a href='viewcustomer.php?delid=$rs[customer_id]' onclick='return deleteconfirm()'>Delete</a></td>";
								}
						echo "</tr>";
				}
				?>
                </tbody>
              </table>
               <center><input type="submit" value="Print" id="submit" name="submit" class="btn btn-primary btn-lg" onclick="printarea('printarea') ;" /></center>
          <br/>
          <br/><br/><br/>
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