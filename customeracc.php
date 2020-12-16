<?php
include("header.php");
if(!isset($_SESSION[customer_id]))
{
	echo "<script>window.location.assign('login.php');</script>";
}
?>

<section id="services" class="service-item">
<div class="container">
<div class="center wow fadeInDown">
<h2>Welcome  </h2>

<p class="lead"><?php 
				if(isset($_SESSION[customer_id]))
				{
					$sqlcustomerac = "SELECT * FROM customer WHERE customer_id='$_SESSION[customer_id]'";
					$varcustomerac=mysqli_query($con,$sqlcustomerac);
					$rscustomerac = mysqli_fetch_array($varcustomerac);
					echo  $rscustomerac[customer_name];  
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
<img class="img-responsive" src="images/custprofile.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><a class="preview" href="customerprofile.php" rel="prettyPhoto">Profile </a>
<p>

</p>

</div>
</div>
</div>

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/custdoc1.ico" height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="custdoc.php" rel="prettyPhoto">Documents</a></h3>
<p></p>

</div>
</div>
</div>  



<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/custinsur.jpg"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="viewcustomerinsuranceaccount.php" rel="prettyPhoto">Insurance Account</a></h3>
<p> </p>

</div>
</div>
</div>

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/custfeed.jpg"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="feedback.php" rel="prettyPhoto">Query or Feedback</a></h3>
<p></p>
</div>
</div>
</div>


<div class="col-sm-6 col-md-4">
    <div class="media services-wrap wow fadeInDown">
        <div class="pull-left">
        	<img class="img-responsive" src="images/feed.jpg" width="100">
        </div>
        <div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="viewqueries.php" rel="prettyPhoto">View Feedback</a></h3>
        	<p>
				
            </p>
        </div>
    </div>
</div>   

    
    <div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/chngpass.gif"  height="150" width="100">
</div>
<div class="media-body">
<h3 class="media-heading"><h3 class="media-heading"><a class="preview" href="customerchangepass.php" rel="prettyPhoto">Change Password</a></h3>

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