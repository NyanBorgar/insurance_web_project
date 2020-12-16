<?php
include("header.php");
if(isset($_SESSION[employee_id]))
{
	echo "<script>window.location.assign('employeeaccount.php');</script>";
}
if(isset($_POST[submit]))
{
	$pwd = md5($_POST[password]);
	$sql = "SELECT * FROM employee WHERE login_id='$_POST[loginid]'  && password='$pwd' && status='Active' AND emp_type='Admin'";
	$var=mysqli_query($con,$sql);
	
	if(mysqli_num_rows($var)==1)
	{
		$rs= mysqli_fetch_array($var);
		$_SESSION[employee_id]=$rs[employee_id];
		$_SESSION[emp_type]=$rs[emp_type];
		echo "<script>window.location.assign('empacc.php');</script>";
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
<center><img src="images/admin_login.gif" /></center>
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>
<form id="main-contact-form" class="contact-form" method="post" name="contact" action="">

<div align="center">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
    
    <tr><th><label for="author">Login ID:</label></th><td> <input type="text" name="loginid" class="form-control" required /></td>
    <div class="cleaner_h10"></div></tr>
                            
    <tr><th><label for="Password">Password:</label> </th><td><input type="password" class="form-control" required name="password" /></td>
    <div class="cleaner_h10"></div></tr>
    
    <tr><td colspan="2"><div align="center"><input type="submit" value="Login.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>
    
    </table>
</div>
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>