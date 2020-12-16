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

<div id="tooplate_main">
    
    <div id="tooplate_content">
    
        <h2><?php echo $rsedit[insurance_scheme]; ?></h2>
                   
        <div class="image_wrapper fr_img"><img src="images/tooplate_image_01.jpg" alt="Image 01" /></div>        
        <p><?php echo $rsedit[note]; ?></p>
        
        
		<div class="cleaner_h30 horizon_divider"></div>
        <div class="cleaner_h30"></div>
        
        <p><strong>Policy term - minimum : </strong><?php echo $rsedit1['policy_term_min']; ?> years</p>
        <p><strong>Policy term - Maximum : </strong><?php echo $rsedit1['policy_term_max']; ?> years</p>
        <p><strong>Minimum Age: </strong><?php echo $rsedit1['min_age']; ?></p>
        <p><strong>Maximum Age: </strong><?php echo $rsedit1['max_age']; ?> </p>
        <p><strong>Sum Assured - Minimum : </strong> Rs. <?php echo $rsedit1['sum_assured_min']; ?></p>
        <p><strong>Sum Assured - Maximum : </strong> Rs. <?php echo $rsedit1['sum_assured_max']; ?></p>
        <p><strong>Profit Ratio : </strong><?php echo $rsedit1['profit_ratio']; ?>%</p> 
        </br></br>
         <div id="contact_form">
        <h2>Interest Calculator</h2>
        
<form method="get" action="insuracc.php">
					<input type="hidden" name="policyid" value="<?php echo $_GET[viewid]; ?>"  />
<input name="percentage" id="percentage" type="hidden" value="<?php echo $rsedit1['profit_ratio']; ?>"  />
       <table width="512" border="" >
  <tr>
    <td width="179"><label for="Password2">No. of years:</label></td>
    <td width="317"><input type="number" class="validate-email required input_field" name="nyear" id="nyear"  min="<?php echo $rsedit1['policy_term_min']; ?>" max="<?php echo $rsedit1['policy_term_max']; ?>"  /></td>
  </tr>
  <tr>
    <td>Total Investment Amount:</td>
    <td><input type="text" class="validate-email required input_field" name="invstamt" id="invstamt"  /></td>
  </tr>
  <tr>
    <td><label for="Password4">Months:</label></td>
    <td><select name="month" id="month">
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
    <td colspan="2"><input type="button" value="Calculate" id="submit2" name="submit2" class="submit_btn float_l" onclick="calculateinterest()" /></td>
    </tr>
      <tr>
    <td>Installment Amount:</td>
    <td><input type="text" class="validate-email required input_field" name="instllamt" id="instllamt" readonly="readonly" /></td>
  </tr>
  <tr>
    <td>Interest Amount:</td>
    <td><input type="text" class="validate-email required input_field" name="inttamt" id="inttamt" readonly="readonly" /></td>
  </tr>
  <tr>
    <td>Total Amount:</td>
    <td><input type="text" class="validate-email required input_field" name="tamt" id="tamt" readonly="readonly" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" value="Submit" id="submit" name="submit" class="submit_btn float_l" />
    </div></td>
    </tr>
</table>
</form>

    
    <tr>
    
    <br>
    </form>
                    </table>
      </div>
    </div>
    
        <?php include("sidebar.php");
		?>
        
		<div class="cleaner"></div>

</div>

    <div class="cleaner"></div>
  
<?php include("footer.php");
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
</script>