<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
			$sql="UPDATE contact SET customer_id='$_POST[customer]',title='$_POST[title]',message='$_POST[description]',contact_date='$_POST[cdate]',reply='$_POST[reply]' WHERE contact_id='$_GET[editid]'";
		
		$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('1 record updated successfully...');</script>";
			}
			else
			{
				echo "Failed to update record.." . mysqli_error($con);
			}
		}
		else
		{
			$sql="INSERT INTO contact(customer_id,title,message,contact_date)   VALUES ('$_SESSION[customer_id]','$_POST[title]','$_POST[description]','$dt') ";		
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('Feedback sent successfully...');</script>";
			}
		}
	}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM contact WHERE contact_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>Feedback</h2>
<p class="lead">Please give us Your Feedback...</p>
</div> 
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="">
<div align="center">
<table  border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />
            
<tr><td><strong>Title:</strong><input type="text" name="title" class="form-control" required name="acode" value="<?php echo $rsedit['title']; ?>" /></td><div class="cleaner_h10"></div></tr>

<tr><td> <strong>Message:</strong>
<script src="richtexteditor/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<textarea name="description" id="descriptions" class="form-control"  rows="6" placeholder=" Description *"></textarea>
</td></tr>

<tr><td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg"  >Post Feedback</button></div></td></tr>				

</table>
</div>		
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>