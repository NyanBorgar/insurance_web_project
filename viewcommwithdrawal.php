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
if(isset($_GET[stid]))
{
		$sql = "UPDATE commission_master SET status='$_GET[st]' WHERE commission_master_id='$_GET[stid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1 )
		{
			echo "<script>alert(' Withdrawal status updated successfully...');</script>";
		}
}
?>
    <section id="contact-page"> 
        <div class="container">
            <div class="center">        
                <h2>View Commission Withdrawals</h2>
                <p class="lead"></p><br/>
              
            </div> 
<?php
include("datatables.php");
?>
                  <table  border="1"  id="example" class="table" cellspacing="0" width="100%">
                  <thead>
                <tr>
                  <th scope="col">Request Date</th>
                  <th scope="col">Particulars</th>
                  <th scope="col">Withdrawn Amount</th>
                  <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
				$sql = "SELECT * FROM commission_master WHERE transaction_type='Debit' ";
				if(isset($_SESSION[agent_id]))
				{
					$sql = $sql . " AND agent_id='$_SESSION[agent_id]'";
				}				
				$qsql = mysqli_query($con,$sql);
				$totamt =0;
				while($rs = mysqli_fetch_array($qsql))
				{
					$sqlinsurplan = "SELECT * FROM insurance_scheme WHERE insurance_scheme_id='$rs[insurance_scheme_id]'";
					$qsqlinsurplan = mysqli_query($con,$sqlinsurplan);
					$rsinsurplan = mysqli_fetch_array($qsqlinsurplan);
					
				 	$sqlinsurance_account = "SELECT * FROM insurance_account INNER JOIN customer on insurance_account.customer_id = customer.customer_id INNER JOIN insurance_scheme WHERE insurance_account.insurance_account_id='$rs[insurance_account_id]'";
					$qsqlinsurance_account = mysqli_query($con,$sqlinsurance_account);
					$rsinsurance_account = mysqli_fetch_array($qsqlinsurance_account);
					if($rs[status] == 'Active')
					{
                	echo " <tr style='background-color:green;color:white'>"; 
					}
					if($rs[status] == 'Pending')
					{
                	echo " <tr style='background-color:red;color:white'>"; 					
					}
					if($rs[status] == 'Rejected')
					{
                	echo " <tr style='background-color:yellow;color:red'>"; 					
					}
					echo "<td>&nbsp;$rs[transaction_date]</td>
						  <td>&nbsp;";
						  	if(isset($_SESSION[employee_id]))
							{
								echo "<textarea onKeyUp='updparticulars($rs[0],this.value)' onchange='updparticulars($rs[0],this.value)' >".$rs[particulars] . "</textarea>";
						  	}
						  	else
						  	{
								echo $rs[particulars];					
						 	}
					echo "</td>
						  <td>Rs. $rs[commission_amt]</td>
						  <td>$rs[status]";
				if(isset($_SESSION[employee_id]))
				{
					if($rs[status] == "Pending")
					{
					  echo "<br><a style='color:white' href='viewcommwithdrawal.php?st=Active&stid=$rs[0]'>Approve</a> | ";
					  echo "<a style='color:white' href='viewcommwithdrawal.php?st=Rejected&stid=$rs[0]'>Cancel</a> | 
					  <a style='color:white' href='viewcommwithdrawal.php?delid=$rs[0]' onClick='deleteconfirm()'>Delete</a>";
					}
					
				}
					echo "</td></tr>";
						$totamt = $totamt+ $rs[commission_amt];
				}
				?>
                </tbody>
                <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col" >Total Withdrawn amount</th>
                      <th scope="col">Rs. <?php echo $totamt; ?></th>
                      <th scope="col"></th>
                    </tr>
                </thead>
              </table>
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
function updparticulars(commid,text)
{
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxwithdrawal.php?commid="+commid+"&text="+text,true);
        xmlhttp.send();
}
	</script>