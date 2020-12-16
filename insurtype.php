<?php
include("header.php");
//if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		$imgname = rand(). $_FILES[img][name];
		move_uploaded_file($_FILES[img][tmp_name],"insuranceimg/".$imgname);
		if(isset($_GET[editid]))
		{
			$sql = "UPDATE insurance_type SET insurance_type='$_POST[itype]',status='$_POST[status]',img='$imgname' WHERE insurance_type_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('1 record updated successfully...');</script>";
			}
			else
			{
				echo "Failed to insert agent record.." . mysqli_error($con);
			}
		}
		else
		{
			$sql = "INSERT INTO insurance_type (insurance_type,img, status) VALUES ('$_POST[itype]','$imgname','$_POST[status]')";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('Insurance type record inserted successfully...');</script>";
			}
			else
			{
				echo "Failed to insert agent record.." . mysqli_error($con);
			}
		}
	}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM insurance_type WHERE insurance_type_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>Adding Insurance Type</h2>
<p class="lead">...</p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmtype" onsubmit="return validateform()" enctype="multipart/form-data" >
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />

<div align="center">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" style="width:50%">
    
    <tr><th> <label for="Password">Insurance Type:</label></th><td><input type="text" name="itype" class="form-control"  value="<?php echo $rsedit['insurance_type']; ?>" /></br><span id="iditype"></span></td></tr>
    
    <tr><th> <label for="Password">Image:</label></th><td><input type="file" name="img" id="img" class="form-control" /></br><span id="iditype"></span>
    <?php
    if(isset($_GET[editid]))
    {
        if($rsedit[img] != "")
        {
        echo "<img src='insuranceimg/$rsedit[img]'></img>";
        }
    }
    ?>
    </td></tr>
    
    <tr><th> <label for="Password">Status:</label> </th><td><select name="status" class="form-control" >
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
    </select></br><span id="idstatus"></span></td></tr>
    
    <tr><td colspan="2"><div align="center">
    <button type="submit" name="submit" class="btn btn-primary btn-lg" >Submit</button>
    </div></td></tr>
                    
    </table>
</div>		
</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>

<script type="application/javascript">
function validateform()
{
	var i=0;
	
	var alphaExp = /^[a-zA-Z]+$/;	//Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/;	//Variable to validate only alphabets with space
	var alphanumericExp = /^[a-zA-Z0-9]+$/;	//Variable to validate only alphanumerics
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	var mobileno = /^\d{10}$/;
	
	document.getElementById("iditype").innerHTML = "";
	document.getElementById("idstatus").innerHTML = "";
	
	if(!document.frmtype.itype.value.match(alphaspaceExp))
	{
		document.getElementById("iditype").innerHTML = "<font color='red'>Enter only alphabets</font>";	
		document.frmtype.itype.focus();
		i=1;
	}
		
	if(document.frmtype.itype.value=="")
	{
		document.getElementById("iditype").innerHTML = "<font color='red'>Select Insurance Type</font>";	
		document.frmtype.itype.focus();
		i=1;
	}	
		
	if(document.frmtype.status.value=="")
	{
		document.getElementById("idstatus").innerHTML = "<font color='red'>Select status</font>";	
		document.frmtype.status.focus();
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
</script>