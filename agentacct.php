<?php include("header.php");
if(!isset($_SESSION[agent_id]))
{
	echo "<script>window.location.assign('agentlogin.php');</script>";
}
?>
<section id="services" class="service-item">
<div class="container">
<div class="center wow fadeInDown">
<h2>Welcome  </h2>

<p class="lead"> <?php 
				if(isset($_SESSION[agent_id]))
				{
					$sqlagentac = "SELECT * FROM agent WHERE agent_id='$_SESSION[agent_id]'";
					$varagentac=mysqli_query($con,$sqlagentac);
					$rsagentac = mysqli_fetch_array($varagentac);
					echo  $rsagentac[agent_name];
				}
				?>
                
                 </p>
               
</div>

<br/>
<div class="row">


<br/><br/>
<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/agent1.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><a class="preview" href="agentprofile.php" rel="prettyPhoto">Profile </a>
<p>

</p>

</div>
</div>
</div>

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/marketing.png" height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="agentmail.php" rel="prettyPhoto">Marketing</a></h3>
<p></p>

</div>
</div>
</div>  



<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/viewcust.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="viewcustomer.php" rel="prettyPhoto">View  Customers</a></h3>
<p> </p>

</div>
</div>
</div>

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/custinsur.jpg"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="viewagentinsuranceaccount.php" rel="prettyPhoto">Insurance Account</a></h3>
<p></p>
</div>
</div>
</div>


<div class="col-sm-6 col-md-4">
    <div class="media services-wrap wow fadeInDown">
        <div class="pull-left">
        	<img class="img-responsive" src="images/viewpay.png" width="100">
        </div>
        <div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="viewpolicypay.php" rel="prettyPhoto"> Policy Payment</a></h3>
        	<p>
				
            </p>
        </div>
    </div>
</div>   

    
    <div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/claim.png"  height="150" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="viewpolicyclaim.php" rel="prettyPhoto">Policy Claim</a></h3>

<p></p>

</div>
</div>
</div>

 <div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/viewcom1.jpg"  height="150" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="viewcommast.php" rel="prettyPhoto">View Commission</a></h3>

<p></p>

</div>
</div>
</div>

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/viewcom.jpg"  height="150" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="viewcommwithdrawal.php" rel="prettyPhoto">View Commission Withdrawal</a></h3>

<p></p>

</div>
</div>
</div>

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/withdraw.jpg"  height="150" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="commission_withdrawal.php" rel="prettyPhoto"> Withdrawal Amount</a></h3>

<p></p>

</div>
</div>
</div>

    
</div><!--/.row-->
<center> <a href="logout.php"> <img class="img-responsive" src="images/logout.jpg"  height="150" width="100"></a></center>
</div><!--/.container-->
</section><!--/#services-->



<?php
include("footer.php");?>