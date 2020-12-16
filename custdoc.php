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
if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		$filename = rand(). $_FILES[doc][name];
		move_uploaded_file($_FILES[doc][tmp_name],"docs/".$filename);

		$sql = "INSERT INTO customer_document (customer_id,document_type,document_path) VALUES ('$_SESSION[customer_id]','$_POST[dtype]','$filename')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1 )
		{
			echo "<script>alert('Document uploaded successfully...');</script>";
		}
		else
		{
			echo "Failed to insert  record.." . mysqli_error($con);
		}
	}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM customer_document WHERE cust_doc_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>CUSTOMER DOCUMENT</h2>
<p class="lead">Upload the documents</p>
</div> 
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmcustdoc" onsubmit="return validateform()" enctype="multipart/form-data">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />

<div align="center">
<table   id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%" > 

<tr><th> <label for="Password">Document Type:</label></th><td>  
<select name="dtype" class="form-control"  >
<option value="">Select document type</option>
<?php
$arr = array("Aadhar Card","Voter ID","Ration Card");
foreach($arr as $val)
{
	echo "<option value='$val'>$val</option>";
}
?>
</select></br><span id="iddtype"></span></td></tr><div class="cleaner_h10"></div>

<tr><th> <label for="Password">Document:</label></th><td> <input type="file" name="doc" class="form-control"   value="<?php echo $rsedit['document_path']; ?>"/></br><span id="iddoc"></span></td></tr><div class="cleaner_h10"></div>

<tr><td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg" onclick="submit()" >Submit</button></div></td></tr>				

</table>
<hr />
 <table  border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
                <thead>
                <tr>
                  <th scope="col">Document Type</th>
                  <th scope="col">Document Path</th>
                  <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
               <?php
			 	$sql = "SELECT * FROM customer_document  WHERE customer_id='$_SESSION[customer_id]'";
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
          
</div>		
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>
<script type="application/javascript">
function validateform()
{
	var i=0;
	
	var alphaExp = /^[a-zA-Z]+$/;	//Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/;	//Variable to validate only alphabets with space
	var alphanumericExp = /^[a-zA-Z0-9]+$/;	//Variable to validate only alphanumerics
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	var mobileno = /^\d{10}$/;
	
	document.getElementById("idcust").innerHTML = "";
	document.getElementById("iddtype").innerHTML = "";
	document.getElementById("iddoc").innerHTML = "";
		
	if(document.frmcustdoc.cust.value=="")
	{
		document.getElementById("idcust").innerHTML = "<font color='red'>Enter customer name</font>";	
		document.frmcustdoc.cust.focus();
		i=1;
	}	
	
	if(document.frmcustdoc.dtype.value=="")
	{
		document.getElementById("iddtype").innerHTML = "<font color='red'>Select document type</font>";	
		document.frmcustdoc.dtype.focus();
		i=1;
	}
	if(document.frmcustdoc.doc.value=="")
	{
		document.getElementById("iddoc").innerHTML = "<font color='red'>Choose a document</font>";	
		document.frmcustdoc.doc.focus();
		i=1;
	}
	
	
	if(i==0)
	{
		return true;
	}
	else
	{
		return false;	
	}
}
</script>