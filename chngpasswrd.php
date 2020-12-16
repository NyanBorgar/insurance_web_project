<?php
include("header.php");

?>
<section id="contact-page">
<div class="container">
<div class="center">        
<h2></h2>
<p class="lead">Kindly enter the credentials</p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post" name="contact" action="">
<div align="center">
<table border="2">

<tr><th><label for="author">Old Password:</label></th><td> <input type="text" name="loginid" class="form-control" required /></td>
<div class="cleaner_h10"></div></tr>
                    
<tr><th><label for="Password">New Password:</label> </th><td><input type="password" class="form-control" required name="password" /></td>
<div class="cleaner_h10"></div></tr>

<tr><th><label for="Password">Confirm Password:</label> </th><td><input type="password" class="form-control" required name="password" /></td>
<div class="cleaner_h10"></div></tr>

<tr><td colspan="2"><div align="center"><input type="submit" value="Login.." id="submit" name="submit" class="btn btn-primary btn-lg" /></div></td></tr>

</table>
</div>
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php");
?>