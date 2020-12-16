<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
	$sql="UPDATE contact SET customer_id='$_POST[customer]',title='$_POST[title]',message='$_POST[message]',contact_date='$_POST[cdate]',reply='$_POST[reply]' WHERE contact_id='$_GET[editid]'";

$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1 )
	{
		echo "<script>alert('1 record updated successfully...');</script>";
	}
	else
	{
		echo "Failed to update record.." . mysqli_error($con);
	}
}
else
{
	$sql="INSERT INTO contact(customer_id,title,message,contact_date,reply)   VALUES ('$_POST[customer]','$_POST[title]','$_POST[message]','$_POST[cdate]','$_POST[reply]') ";

$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1 )
	{
		echo "<script>alert('Contact Details record inserted successfully...');</script>";
	}
	else
	{
		echo "Failed to insert record.." . mysqli_error($con);
	}
}
}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM contact WHERE contact_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>
<div id="tooplate_main">
    
    <div id="tooplate_content">

            <h2>Contact Details</h2>


        <p>Kindly enter contact credentials..</p>
     
            
            <div id="contact_form">
            
<form method="post" name="contact" action="">
					<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />
                      <label for="Password">Customer:</label>
                       <select name="customer" class="required input_field">
                        <option value="">Select</option>
                        <?php
						$sqlcustomer = "SELECT * FROM customer";
						$qsqlcustomer = mysqli_query($con,$customer);
						while($rscustomer = mysqli_fetch_array($qsqlcustomer))
						{
							if($rscustomer[customer_id] == $rscustomer[customer_id])
							{
							echo "<option value='$rscustomer[customer_id]' selected>$rsstate[customer_name]</option>";
							}
							else
							{
							echo "<option value='$rscustomer[customer_id]'>$rscustomer[customer_name]</option>";
							}
						}
						?>
                       </select></br>
                      
						<label for="author">Title:</label> <input type="text" name="title" class="required input_field" value="<?php echo $rsedit['title']; ?>" />
						<div class="cleaner_h10"></div>
						
                        
                        <label for="Password">Message:</label> <textarea  class="validate-email required input_field" name="message"/> <?php echo $rsedit['message']; ?>
						</textarea><div class="cleaner_h10"></div>
                        
                        <label for="Password">Contact Date:</label> <input type="date" class="validate-email required input_field" name="cdate" value="<?php echo $rsedit['contact_date']; ?>"/>
						<div class="cleaner_h10"></div>
                        
                        <label for="Password">Reply:</label> <textarea  class="validate-email required input_field" name="reply" />
                         <?php echo $rsedit['reply']; ?>						
                         </textarea><div class="cleaner_h10"></div>
                        
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