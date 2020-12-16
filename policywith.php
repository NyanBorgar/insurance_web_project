<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
	$sql =  "UPDATE policy_withdrawal SET insurance_account_id='$_POST[iacc]' ,withdrawal_amt='$_POST[wamt]', withdrawal_date='$_POST[wdate]',bank_name='$_POST[bname]',bank_ac_no='$_POST[baccno]',branch='$_POST[branch]',branch_code='$_POST[bcode]',withdraw_status='$_POST[status]' WHERE policy_withdrawal_id='$_GET[editid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1 )
	{
		echo "<script>alert('1 Record updated successfully...');</script>";
	}
	else
	{
		echo "Failed to insert  record.." . mysqli_error($con);
	}
	}
	else
	{
		$sql = "INSERT INTO policy_withdrawal (insurance_account_id,withdrawal_amt,withdrawal_date,bank_name,bank_ac_no, branch, branch_code,withdraw_status) VALUES ('$_POST[iacc]','$_POST[wamt]','$_POST[wdate]','$_POST[bname]','$_POST[baccno]','$_POST[branch]','$_POST[bcode]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1 )
	{
		echo "<script>alert('Record inserted successfully...');</script>";
	}
	else
	{
		echo "Failed to insert  record.." . mysqli_error($con);
	}
}
}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM policy_withdrawal WHERE policy_withdrawal_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>
<div id="tooplate_main">
    
    <div id="tooplate_content">

            <h2>Policy Withdrawal</h2>


        <p>Kindly enter login credentials..</p>
     
            
            <div id="contact_form">
            
<form method="post" name="contact" action="">
					
                    
                    <label for="Password">Insurance Account:</label> <select name="iacc" >
                    
                     <option value="">Select</option>
                          <?php
						$sqlpp = "SELECT * FROM insurance_account";
						$qsqlpp = mysqli_query($con,$sqlpp);
						while($rspp = mysqli_fetch_array($qsqlpp))
						{
							if($rspp[insurance_account_id] == $rspp[insurance_account_id])
							{
							echo "<option value='$rspp[insurance_account_id]' selected>$rspp[insurance_account_id]</option>";
							}
							else
							{
							echo "<option value='$rspp[insurance_account_id]'>$rspp[insurance_account_id]</option>";
							}
						}
						?>
                        </select></br>
                    
                    
              						
						<label for="Password">Withdrawal Amount:</label> <input type="text" class="validate-email required input_field" name="wamt" value="<?php echo $rsedit['withdrawal_amt']; ?>" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Date:</label> <input type="date" class="validate-email required input_field" name="wdate" value"<?php echo $rsedit['withdrawal_date']; ?>" />
						<div class="cleaner_h10"></div>
                      
                    
													
						<label for="Password">Bank Name:</label> <input type="text" class="validate-email required input_field" name="bname" value="<?php echo $rsedit['bank_name']; ?>" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Bank Account No.:</label> <input type="text" class="validate-email required input_field" name="baccno" value="<?php echo $rsedit['bank_ac_no']; ?>" />
						<div class="cleaner_h10"></div>
                        
                        
                        <label for="Password">Branch:</label> <input type="text" class="validate-email required input_field" name="branch" value"<?php echo $rsedit['branch']; ?>" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Branch Code:</label> <input type="text" class="validate-email required input_field" name="bcode" value"<?php echo $rsedit['branch_code']; ?>"/>
						<div class="cleaner_h10"></div>
                        
                        
                        <label for="Password"> Withdrawal Status:</label>  <select name="status">
                         <option value="">Select status</option>
						 <?php
						 $arr = array("Active","Inactive");
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
                         </select></br>
                        
						<br><input type="submit" value="Submit" id="submit" name="submit" class="submit_btn float_l" />
						
					</form>
			</div>           
            
    </div>
    
       <?php include("sidebar.php");
	   ?>
            
            
        
		<div class="cleaner"></div>

</div>

    <div class="cleaner"></div>  

<?php include("footer.php");
?>