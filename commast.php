<?php
include("header.php");
if($_SESSION[randomid] == $_POST[randomid])
{
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql = "UPDATE commission_master SET insurance_scheme_id='$_POST[ischeme]',agent_id='$_POST[agent],commission_amt='$_POST[camt]',transaction_type='$_POST[ttype]',transaction_date='$_POST[tdate]',particulars='$_POST[particulars]',status='$_POST[status]' WHERE commission_master_id='$_GET[editid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1 )
	{
		echo "<script>alert(' 1 record updated successfully...');</script>";
	}
	else
	{
		echo "Failed to insert  record.." . mysqli_error($con);
	}
	}
	else
	{
	$sql = "INSERT INTO commission_master (insurance_scheme_id,agent_id,commission_amt,transaction_type,transaction_date,particulars,status) VALUES ('$_POST[ischeme]','$_POST[agent]',$_POST[camt]','$_POST[ttype]','$_POST[tdate]','$_POST[particulars]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1 )
	{
		echo "<script>alert(' record inserted successfully...');</script>";
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
	$sqledit = "SELECT * FROM commission_master WHERE commission_master_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid] = rand();
?>
<div id="tooplate_main">
    
    <div id="tooplate_content">

            <h2>Agent Commission Details</h2>


        <p>Kindly enter credentials..</p>
     
            
            <div id="contact_form">
            
<form method="post" name="contact" action="">
					
						 <input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />
									
                        
                        <label for="Password">Insurance scheme:</label>
                         <select name="ischeme" class="validate-email required input_field" >
                          <option value="">Select</option>
                          <?php
						$sqlinsurplan = "SELECT * FROM insurance_scheme WHERE status='Active'";
						$qsqlinsurplan = mysqli_query($con,$sqlinsurplan);
						while($rsinsurplan = mysqli_fetch_array($qsqlinsurplan))
						{
							if($rsstate[insurance_scheme_id] == $rsinsurplan[insurance_scheme_id])
							{
							echo "<option value='$rsinsurplan[insurance_scheme_id]' selected>$rsinsurplan[insurance_scheme]</option>";
							}
							else
							{
							echo "<option value='$rsinsurplan[insurance_scheme_id]'>$rsinsurplan[insurance_scheme]</option>";
							}
						}
						?>
                         </select></br>
                         <div class="cleaner_h10"></div>
                         <label for="Password">Agent:</label> <input type="text" class="validate-email required input_field" name="agent"  value="<?php echo $rsedit['agent_id'];?>" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Commission Amount:</label> <input type="text" class="validate-email required input_field" name="camt"  value="<?php echo $rsedit['commission_amt'];?>" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Transaction Type:</label> <input type="text" class="validate-email required input_field" name="ttype"  value="<?php echo $rsedit['transaction_type'];?>" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Transaction Date:</label> <input type="date" class="validate-email required input_field" name="tdate"  value="<?php echo $rsedit['transaction_date'];?>" />
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Particulars:</label> <textarea  class="validate-email required input_field" name="particulars"  /><?php echo $rsedit['articulars']; ?>
						</textarea><div class="cleaner_h10"></div>
                         
                        
                        <label for="Password">Status:</label>  <select name="status">
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