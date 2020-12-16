<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM policy_payment where policy_payment_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Policy payment record deleted successfully..');</script>";
	}
}
?>
    <section id="contact-page">
       <?php
include("datatables.php");
?> 
        <div class="container">
            <div class="center">        
                <h2>View Policy payment</h2>
                <p class="lead"></p><br/>
              
            </div> 
          
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form method="get" action="">
                    <table  border="1"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th width="4" scope="col">From Date</th>
                            <td width="4" scope="col"><input type="date"  class="form-control" name="fdate"  value="<?php echo $_GET[fdate]; ?>"/></td>
                              <th width="4" scope="col">To Date</th>
                            <td width="4" scope="col"><input type="date"  class="form-control" name="tdate"  value="<?php echo $_GET[tdate]; ?>"  /></td>
                              <th width="4" scope="col"><input type="submit" name="btnsearch"  class="form-control" value="Search" /</th>
                            </tr>
                        </thead>
                    </table>
                </form>
              <div id="printarea">
                 <table border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                 <th scope="col">Customer</th>
                  <th scope="col">Insurance <br>Account No.</th>
                  <th scope="col">Paid Amount</th>
                  <th scope="col">Tax Amount</th>
                  <th scope="col">Total Amount</th>
                  <th scope="col">Paid Date</th>
                  <th scope="col">Trans Type</th>
                  <th scope="col">Particulars</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
               <?php
				$sql = "SELECT * FROM policy_payment INNER JOIN insurance_account ON insurance_account.insurance_account_id=policy_payment.insurance_account_id INNER JOIN customer ON customer.customer_id=insurance_account.customer_id where policy_payment.status!='' ";
				if(isset($_SESSION[agent_id]))
				{
					$sql  = $sql. " AND customer.agent_id='$_SESSION[agent_id]'";
				}
				if(isset($_GET[btnsearch]))
				{
					$sql = $sql . " AND policy_payment.paid_date between '$_GET[fdate]' AND '$_GET[tdate]'";
				}
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{					
					$tottaxamt=  round(($rs[tax_amt]*$rs[paid_amt]/100),2);
					$totamt = round($rs[paid_amt] + $tottaxamt,2);
										
					$sqlpp = "SELECT * FROM insurance_account WHERE insurance_account_id='$rs[insurance_account_id]'";
					$qsqlpp = mysqli_query($con,$sqlpp);
					$rspp = mysqli_fetch_array($qsqlpp);	
					
					$sqlcust="SELECT * FROM customer where customer_id='$rspp[customer_id]'";
					$qsqlcust = mysqli_query($con,$sqlcust);
					$rscust = mysqli_fetch_array($qsqlcust);
					
                	echo " <tr>
					<td>&nbsp;	$rscust[customer_name]</td>
						  <td>&nbsp;$rspp[insurance_account_id]</td>
						  <td>&nbsp;Rs. $rs[paid_amt]</td>
						  <td>&nbsp;Rs. $tottaxamt</td>
						  <td>&nbsp;Rs. " . $totamt . "</td>
						  <td>&nbsp;$rs[paid_date]</td>
						  <td>&nbsp;$rs[trans_type]</td>
						  <td>&nbsp;$rs[particulars]</td>
						  <td>&nbsp;$rs[status]</td>";
						  
					echo "<td>&nbsp; ";
					if(isset($_SESSION[employee_id]))
					{
					echo "<a href='viewpolicypay.php?delid=$rs[policy_payment_id]' onclick='return deleteconfirm()'>Delete</a> | ";
					}
					echo "<a href='policyreceipt.php?paymentid=$rs[policy_payment_id]&insno=". $insno ."'>Download</a></td>";
					
						echo "</tr>";
				}
				?>
                              </tbody>
              </table></div>

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