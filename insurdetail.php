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
      
<h2><font size="+3" color="#990000" ><center><strong><?php echo $rsedit[insurance_scheme]; ?></strong></center></font></h2>
       
<div class="image_wrapper fr_img"><center><img src='<?php echo "insuranceimg/" . $rsedit[img]; ?>' alt='Image 01' width='250' height='250'/></div>        
<p><?php echo $rsedit[note]; ?></p></center>

<div class="center"> 
<div class="cleaner_h30 horizon_divider"></div>
<div class="cleaner_h30"></div><br />
<div align="center">

<form id="main-contact-form" class="contact-form" method="get" action="insuracc.php" name="frminsurdetail" onsubmit="return validateform()">
<table  border="1" id="example" class="table table-striped table-bordered" cellspacing="0">
<caption><strong><font size="+2" color="#000000" >Plan Details:</font></strong></caption>
<tr><th width="182"><p><strong>Policy term - minimum :</strong></th><td width="167"><?php echo $rsedit1['policy_term_min']; ?> years
<input type="hidden" name="policy_term_min" value="<?php echo $rsedit1['policy_term_min']; ?>" /></p></td></tr>
<tr><th> <p><strong>Policy term - Maximum : </strong></th><td><?php echo $rsedit1['policy_term_max']; ?> years
<input type="hidden" name="policy_term_max" value="<?php echo $rsedit1['policy_term_max']; ?>" /></p></td></tr>
<tr><th> <p><strong>Minimum Age: </strong></th><td><?php echo $rsedit1['min_age']; ?>
<input type="hidden" name="min_age" value="<?php echo $rsedit1['min_age']; ?>" /></p></td></tr>
<tr><th> <p><strong>Maximum Age: </strong></th><td><?php echo $rsedit1['max_age']; ?>
<input type="hidden" name="max_age" value="<?php echo $rsedit1['max_age']; ?>" /></p></td></tr>
<tr><th> <p><strong> Minimum Investment amount: </strong></th><td> Rs. <?php echo $rsedit1['sum_assured_min']; ?>
<input type="hidden" name="sum_assured_min" value="<?php echo $rsedit1['sum_assured_min']; ?>" /></p></td></tr>
<tr><th><p><strong>Maximum Investment amount: </strong> </th><td>Rs. <?php echo $rsedit1['sum_assured_max']; ?>
<input type="hidden" name="sum_assured_max" value="<?php echo $rsedit1['sum_assured_max']; ?>" /></p></td></tr>
<tr><th><p><strong>Profit Ratio : </strong></th><td><?php echo $rsedit1['profit_ratio']; ?>%</p> </td></tr>
</br></br>
</table>
</div>
</div> 

<div class="row contact-wrap"> 
    <div class="status alert alert-success" style="display: none"></div>
        <div align="center">
        <h2>Interest Calculator</h2>
        
        <input type="hidden" name="policyid" value="<?php echo $_GET[viewid]; ?>"  />
        <input name="percentage" id="percentage" type="hidden" value="<?php echo $rsedit1['profit_ratio']; ?>"  />
        <?php
		//	$from = new DateTime($rscustomerac[cust_dob]);
		//	$to   = new DateTime('today');
		//	echo $from->diff($to)->y;
			$customerage =  date_diff(date_create($rscustomerac[cust_dob]), date_create('today'))->y;
		if($customerage > $rsedit1['min_age'] && $customerage < $rsedit1['max_age'])
		{
		?>
        <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0">
        
        <tr>
        	<td width="144"><div align="left"><label>No. of years:</label></div></td> 
        	<td width="153"><input type="number" class="form-control" required name="nyear" id="nyear"  min="<?php echo $rsedit1['policy_term_min']; ?>" max="<?php echo $rsedit1['policy_term_max']; ?>"  /><span id="errnyear"></span></td>
        </tr>
        
        <tr>
        	<td><div align="left"><label>Total Investment Amount:</label></div></td>
            <td><input type="text" class="form-control" required name="invstamt" id="invstamt"  /><span id="errninvstamt"></span></td>
        </tr>
        
        <tr>
        	<td><div align="left"><label>Months:</label></div></td>
            <td> <select name="month" id="month" class="form-control" required>
            <option value="">Select </option>
            <?php
            $arr = array("1 Month","3 Month","6 Month","1 Year");
            foreach($arr as $val)
            {
             if($val == $rsedit[status])
             {
             echo "<option value='$val' selected>$val</option>";
             }
             else
             {
             echo "<option value='$val'>$val</option>";
             }
            }
            ?>
            </select></td>
        </tr>
        
        <tr>
        	<td colspan="2"><div align="center"> <button type="button" value="Calculate" id="submit2" name="submit2" class="btn btn-primary btn-lg"  onclick="calculateinterest()">Calculate</button></div>
            </td>
        </tr>
        
        <tr>
        	<td><div align="left"><label>Installment Amount:</label></div></td>
        	<td><input type="text" class="form-control" required name="instllamt" id="instllamt" readonly /></td><div class="cleaner_h10"></div></tr>
        <tr>
        	<td> <div align="left"><label>Interest Amount:</label></div></td>
            <td><input type="text" class="form-control" required name="inttamt" id="inttamt" readonly /></td>
        </tr>
        
        <tr>
        	<td> <div align="left"></div><label>Total Amount:</label></div></td>
        	<td> <input type="text" class="form-control" required name="tamt" id="tamt" readonly /></td>
        </tr>
        
        <tr>
        	<td colspan="2"><div align="center"><button type="submit" name="submit" class="btn btn-primary btn-lg" >Submit</button></div></td>
        </tr>
        
        </table>
        <?php
		}
		else
		{
			if(isset($_SESSION[customer_id]))
			{
			echo "<h2>You are not eligible to Purchase this policy..</h2>";
			}
			else
			{
			?>
            <table border="1" id="example" class="table table-striped table-bordered" cellspacing="0">
        
        <tr>
        	<td width="144"><div align="left"><label>No. of years:</label></div></td> 
        	<td width="153"><input type="number" class="form-control" required name="nyear" id="nyear"  min="<?php echo $rsedit1['policy_term_min']; ?>" max="<?php echo $rsedit1['policy_term_max']; ?>"  /><span id="errnyear"></span></td>
        </tr>
        
        <tr>
        	<td><div align="left"><label>Total Investment Amount:</label></div></td>
            <td><input type="text" class="form-control" required name="invstamt" id="invstamt"  /><span id="errninvstamt"></span></td>
        </tr>
        
        <tr>
        	<td><div align="left"><label>Months:</label></div></td>
            <td> <select name="month" id="month" class="form-control" required>
            <option value="">Select </option>
            <?php
            $arr = array("1 Month","3 Month","6 Month","1 Year");
            foreach($arr as $val)
            {
             if($val == $rsedit[status])
             {
             echo "<option value='$val' selected>$val</option>";
             }
             else
             {
             echo "<option value='$val'>$val</option>";
             }
            }
            ?>
            </select></td>
        </tr>
        
        <tr>
        	<td colspan="2"><div align="center"> <button type="button" value="Calculate" id="submit2" name="submit2" class="btn btn-primary btn-lg"  onclick="calculateinterest()">Calculate</button></div>
            </td>
        </tr>
        
        <tr>
        	<td><div align="left"><label>Installment Amount:</label></div></td>
        	<td><input type="text" class="form-control" required name="instllamt" id="instllamt" readonly /></td><div class="cleaner_h10"></div></tr>
        <tr>
        	<td> <div align="left"><label>Interest Amount:</label></div></td>
            <td><input type="text" class="form-control" required name="inttamt" id="inttamt" readonly /></td>
        </tr>
        
        <tr>
        	<td> <div align="left"></div><label>Total Amount:</label></div></td>
        	<td> <input type="text" class="form-control" required name="tamt" id="tamt" readonly /></td>
        </tr>
        
        </table>
            <?php
			}
		}
		?>
        </form> 
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php");
include("datatables.php");
?>

<script type="application/javascript">
	
function calculateinterest()
{
	if(document.getElementById("month").value == "1 Month")
	{
		document.getElementById("instllamt").value = parseFloat(document.getElementById("invstamt").value / (document.getElementById("nyear").value * 12)).toFixed(2);
document.getElementById("inttamt").value = parseFloat((document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
			document.getElementById("tamt").value =     parseFloat( parseFloat(document.getElementById("invstamt").value)  + (document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
	}
	else if(document.getElementById("month").value == "3 Month")
	{
		document.getElementById("instllamt").value = parseFloat(document.getElementById("invstamt").value / (document.getElementById("nyear").value * 4)).toFixed(2);
		document.getElementById("inttamt").value = parseFloat((document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
			document.getElementById("tamt").value =     parseFloat( parseFloat(document.getElementById("invstamt").value)  + (document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
	}
	else if(document.getElementById("month").value == "6 Month")
	{
		document.getElementById("instllamt").value = parseFloat(document.getElementById("invstamt").value / (document.getElementById("nyear").value * 2)).toFixed(2);
		document.getElementById("inttamt").value = parseFloat((document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
			document.getElementById("tamt").value =     parseFloat( parseFloat(document.getElementById("invstamt").value)  + (document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
	}
	else if(document.getElementById("month").value == "1 Year")
	{
		document.getElementById("instllamt").value = parseFloat(document.getElementById("invstamt").value / (document.getElementById("nyear").value * 1)).toFixed(2);
		document.getElementById("inttamt").value = parseFloat((document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
			document.getElementById("tamt").value =     parseFloat( parseFloat(document.getElementById("invstamt").value)  + (document.getElementById("invstamt").value * document.getElementById("percentage").value) / 100).toFixed(2);
		
	}
}
function validateform()
{
	var i=0;
	
	var alphaExp = /^[a-zA-Z]+$/;	//Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/;	//Variable to validate only alphabets with space
	var alphanumericExp = /^[a-zA-Z0-9]+$/;	//Variable to validate only alphanumerics
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	var mobileno = /^\d{10}$/;
	if(parseFloat(document.frminsurdetail.invstamt.value) < parseFloat(document.frminsurdetail.sum_assured_min.value) )
	{
		document.getElementById("errninvstamt").innerHTML = "<font color='red'>Entered amount is  less than Min. Investment amount.</font>";
		document.frminsurdetail.invstamt.focus();
		i=1;
	}
	if( parseFloat(document.frminsurdetail.invstamt.value) > parseFloat(document.frminsurdetail.sum_assured_max.value))
	{
		document.getElementById("errninvstamt").innerHTML = "<font color='red'>Entered amount is  greater than Max. Investment amount...</font>";		
		document.frminsurdetail.invstamt.focus();
		i=1;
	}		
	
	if(i==0)
	{
		return true;
	}
	else
	{
		return false;	
	}
}
// policy_term_max min_age max_age sum_assured_min sum_assured_max nyear invstamt month frminsurdetail
</script>