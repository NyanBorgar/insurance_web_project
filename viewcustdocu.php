<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM customer_document where cust_doc_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer document deleted successfully..');</script>";
	}
}
?>
    <section id="contact-page">
       <?php
include("datatables.php");
?> 
        <div class="container">
            <div class="center">        
                <h2>View Customer documents</h2>
                <p class="lead"></p><br/>
              
            </div> 
          
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>            
                  <table  border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th scope="col">Document Type</th>
                  <th scope="col">Document </th>
                  <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
               <?php
			 	$sql = "SELECT * FROM customer_document  WHERE customer_id='$_GET[custdocid]'";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
                	echo " <tr>
						  <td>&nbsp;$rs[document_type]</td>
						  <td>&nbsp;<a href='docs/$rs[document_path]' download>Download</a></td>
						  <td>&nbsp; <a href='custdoc.php?delid=$rs[cust_doc_id]' onclick='return deleteconfirm()'>Delete</a></td>
						</tr>";
				}
				?>
              </tbody>
              </table>
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