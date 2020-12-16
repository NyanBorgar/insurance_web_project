<?php
session_start();
include("header.php");
if($_POST[randomid] == $_SESSION[randomidno])
{	
	if(isset($_POST[submit]))
	{
		include("sendmail.php");
		$mailid = $_POST[email];
		$subject = $_POST[subject];
		$msg = $_POST[msg] . " <br>  <strong>Kinldy refer the following link to register: </strong>" . $_POST[link] ;
		$projectitle = "eInsurance";		
		sendmail($mailid,$subject, $msg, $projectitle);
	}
		
/*
		if(isset($_POST[submit]))
		{
				$mailmsg  = $_POST[msg] . " <br><br><hr> Kindly join with the following link: ".$_POST[link];			
				include("sendmail.php");
				sendmail($_POST[email],$_POST[subject],$mailmsg,'eInsurance');	
		}	
*/		
}
$_SESSION["randomidno"]=rand();
?>

<section id="contact-page">
<div class="container">

-<div class="center">        
<h2>Send Mail</h2>
</div> 


<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmstate" onsubmit="return validateform()">
    <div align="center">
    <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0"  >
    <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomidno]; ?>"  />
    
    <tr><th> <label for="Password">Email ID:</label> 
    <input type="email" class="form-control"  name="email" /><span id="idstate"></span>
    <div class="cleaner_h10"></div></th></tr>
    
    <tr><th> <label for="Password">Subject:</label>
      <input type="text" name="subject"  class="form-control" >      </span></th><div class="cleaner_h10"></div></tr>
     
    <tr><th> <label for="Password">Message:</label>
      <textarea  class="form-control"  name="msg" rows="10"/></textarea><span id="idaaddress"> </span></th><div class="cleaner_h10"></div></tr>
    
    <tr><th> <label for="Password">Refferel Link:</label>
      <textarea  class="form-control"  name="link" readonly/><?php echo "http://localhost/insurpolicy/customer.php?referralid=".$_SESSION[agent_id]; ?></textarea><span id="idaaddress"> </span></th><div class="cleaner_h10"></div></tr>
    
    
    <tr><td><div align="center">
    <button type="submit" name="submit" class="btn btn-primary btn-lg" >Send Mail</button>
    </div></td></tr>
                    
    </table>
    </div>		
</form>
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php");
?>

