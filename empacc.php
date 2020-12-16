<?php
include("header.php");
?>

<section id="services" class="service-item">
<div class="container">
<div class="center wow fadeInDown">
<h2>DASHBOARD</h2>
<p class="lead">Records</p>
</div>

<div class="row">

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/agent1.jpg"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">Agent </h3>
<p>
<?php
$sql = "SELECT * FROM agent where status='Active'";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?>
</p>
 <a class="preview" href="viewagent.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/employee.png" height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">Employee </h3>
<p> <?php
$sql = "SELECT * FROM employee where status='Active'";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewemployee.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>  

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/cust.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading" >Customer </h3>
<p> <?php
$sql = "SELECT * FROM customer where status='Active'";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewcustomer.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/custdoc.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">Customer Doc</h3>
<p>  <?php
$sql = "SELECT * FROM customer_document ";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewcustdocu.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/insurtype.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">Insurance Type </h3>
<p> <?php
$sql = "SELECT * FROM insurance_type WHERE status='Active'";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewinsurtype.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>


<div class="col-sm-6 col-md-4">
    <div class="media services-wrap wow fadeInDown">
        <div class="pull-left">
        	<img class="img-responsive" src="images/plan.png"  height="120" width="100">
        </div>
        <div class="media-body">
        	<h3 class="media-heading">Insurance Plan</h3>
        	<p>
				<?php
                $sql = "SELECT * FROM insurance_plan WHERE status='Active'";
                $qsql = mysqli_query($con,$sql);
                echo "No. of records - ".mysqli_num_rows($qsql);
                ?>
            </p>
        	<a class="preview" href="viewinsurplan.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
        </div>
    </div>
</div>   

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/account.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">Insurance Account</h3>
<p> <?php
$sql = "SELECT * FROM insurance_account where status='Active'";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewinsuranceaccount.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>   

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/pay.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">Policy payment</h3>
<p> <?php
$sql = "SELECT * FROM policy_payment where status='Active'";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewpolicypay.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>   

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/claim.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">Policy Claim</h3>
<p> <?php
$sql = "SELECT * FROM policy_withdrawal ";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewpolicyclaim.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>   

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/agent1.jpg"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">Commission </h3>
<p> <?php
$sql = "SELECT * FROM commission_master ";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewagentcommission.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>   

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/agent1.jpg"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">Query</h3>
<p> <?php
$sql = "SELECT * FROM contact";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewqueries.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>   

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/state.png"  height="100" width="100">
</div>
<div class="media-body">
<h3 class="media-heading">State</h3>
<p> <?php
$sql = "SELECT * FROM state where status='Active'";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewstate.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>



<div class="col-sm-6 col-md-4">
    <div class="media services-wrap wow fadeInDown">
        <div class="pull-left">
        	<img class="img-responsive" src="images/p7.jpeg"  height="100" width="100">
        </div>
        <div class="media-body">
            <h3 class="media-heading">Insurance Scheme</h3>
            <p> <?php
            $sql = "SELECT * FROM insurance_scheme where status='Active'";
            $qsql = mysqli_query($con,$sql);
            echo "No. of records - ".mysqli_num_rows($qsql);
            ?></p>
            <a class="preview" href="viewinsurscheme.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
        </div>
    </div>
</div>        

<div class="col-sm-6 col-md-4">
<div class="media services-wrap wow fadeInDown">
<div class="pull-left">
<img class="img-responsive" src="images/city.png"  height="80" width="80">
</div>
<div class="media-body">
<h3 class="media-heading">City</h3>
<p><?php
$sql = "SELECT * FROM city where status='Active'";
$qsql = mysqli_query($con,$sql);
echo "No. of records - ".mysqli_num_rows($qsql);
?></p>
<a class="preview" href="viewity.php" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
</div>
</div>
</div>                                              
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#services-->



<?php
include("footer.php");?>