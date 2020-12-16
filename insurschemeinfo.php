<?php
include("header.php");
if(isset($_GET[viewid]))
{
	$sqledit = "SELECT * FROM insurance_scheme WHERE insurance_scheme_id='$_GET[viewid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	$insurplan="SELECT * FROM insurance_plan WHERE insurance_scheme_id='$_GET[viewid]'";
	$insurplan1=mysqli_query($con,$insurplan);
	$rsedit1=mysqli_fetch_array($insurplan1);
}
?>
<section id="contact-page" style="background-color:#CCC">
<div class="container">
<h2><font size="+4" color="#990000" ><center><strong><?php
$sql="SELECT * FROM insurance_type WHERE insurance_type_id='$_GET[insurancetypeid]'";
$qsql=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($qsql);
echo $rs[insurance_type]; 
?></strong></center></font></h2><br/>



<ul>
<?php
$sql="SELECT * FROM insurance_scheme WHERE status='Active' ";
	if(isset($_GET[insurancetypeid]))
	{
	$sql=$sql." AND insurance_type_id='$_GET[insurancetypeid]'";
	}
	$qsql=mysqli_query($con,$sql);
	while($rs=mysqli_fetch_array($qsql))
	{
	
		echo " <h2><center><font size='+2' color='#903' ><b><strong><a href='insurdetail.php?viewid=$rs[insurance_scheme_id]'>$rs[insurance_scheme]</a></strong></b></font><center></h2>
		<div class='image_wrapper fl_img'><a href='insurdetail.php?viewid=$rs[insurance_scheme_id]'><br />
		<center><img src='insuranceimg/$rs[img]' alt='Image 01' width='500' height='250'/></center></a></div>
		<p>$rs[note]</p>
		
		<div class='button float_r'><a href='insurdetail.php?viewid=$rs[insurance_scheme_id]'><center><b>More...</b></center></a></div>
		<div class='cleaner_h30 horizon_divider'></div>
		<div class='cleaner_h30'></div><br/><hr/>"; 
	}
?><br />

</ul>
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>