<?php
include("header.php");
if(isset($_POST[submit]))
{
	$sql = "SELECT * FROM agent WHERE agent_code='$_POST[loginid]' ";
	$var=mysqli_query($con,$sql);	
	if(mysqli_num_rows($var)==1)
	{
		$rs = mysqli_fetch_array($var);
		//echo $rs[email_id];
	 	$msg = "Kindly recover password by entering clicking following link: http://localhost/insurpolicy/agentrecoverpassword.php?id=".$rs[0];
		include("sendmail.php");
		sendmail($rs[email_id],"eInsurance - Password Recovery Mail",$msg,"Raj kiran");
		echo "<script>alert('Password sent on mail');</script>";
	}
	else
	{
		echo "<script>alert('Inavalid login credentials');</script>";	
	}
}
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>AGENT RECOVER PASSWORD</h2>
<p class="lead">Enter the Agent code...</p>
</div>
 
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post" name="contact" action="">
<div align="center">
<table   border="1"  id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
<tr><th><label for="author">Agent code:</label></th><td> <input type="text" name="loginid" class="form-control" required /></td>
<div class="cleaner_h10"></div></tr>
<tr><td colspan="2"><div align="center"><input type="submit" value="Recover Password.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>


</table>
</div>
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>