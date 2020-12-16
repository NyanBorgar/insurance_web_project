<?php
include("header.php");
if(isset($_SESSION[agent_id]))
{
	echo "<script>window.location.assign('agentaccount.php');</script>";
}
if(isset($_GET[agentid]))
{
	$sql = "UPDATE agent SET status='Active' WHERE agent_id='$_GET[agentid]' ";
	$var=mysqli_query($con,$sql);
	echo "<script>alert('Your account has been activated successfully..');</script>";	
}
if(isset($_POST[submit]))
{
		$pwd = md5($_POST[password]);
	$sql = "SELECT * FROM agent WHERE agent_code='$_POST[agent_code]'  && password='$pwd'";
	$var=mysqli_query($con,$sql);
	if(mysqli_num_rows($var)==1)
	{
		$rs= mysqli_fetch_array($var);
	   $_SESSION[agent_id]=$rs[agent_id];
	
		echo "<script>window.location.assign('agentacct.php');</script>";
	}
	else
	{
	echo "<script>alert('Inavalid login password');</script>";	
	}
}
?>
<section id="contact-page">
<div class="container">
<div class="center">        
<h2></h2>
<p class="lead"></p>
</div> 
  <center> <img src="images/agentlogin.jpg" height="150"  width="350"/></center>
<div id="contact_form">
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post" name="contact" action="">

<div align="center">
    <table   id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
    
    <tr><th><label for="author">Agent Code:</label></th><td> <input type="text" name="agent_code" class="form-control" required /></td>
    <div class="cleaner_h10"></div></tr>
                            
    <tr><th><label for="Password">Password:</label> </th><td><input type="password" class="form-control" required name="password" /></td>
    <div class="cleaner_h10"></div></tr>
    
    <tr><td colspan="2"><div align="center"><input type="submit" value="Login.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>
    
    <tr><td colspan="2">
    <div align="center"><strong>Did you forgot password?</strong><br /><input type="button" onclick="window.location='agentforgotpassword.php';" value="Click here to Recover Password.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>
    </table>
</div>
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->
<?php
include("footer.php"); 
?>