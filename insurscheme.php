<?php
include("header.php");
if($_SESSION[randomid] == $_POST[randomid])
{
if(isset($_POST[submit]))
	{
		$note = mysqli_real_escape_string($con,$_POST[note]);
		$imgname = rand(). $_FILES[img][name];
		move_uploaded_file($_FILES[img][tmp_name],"insuranceimg/".$imgname);
		if(isset($_GET[editid]))
		{
		$sql = "UPDATE insurance_scheme SET insurance_type_id='$_POST[itype]',insurance_scheme='$_POST[ischeme]',";
		if($_FILES[img][name] != "")
		{
		$sql = $sql . "img='$imgname',";
		}
		$sql = $sql . "agent_commission='$_POST[agent_commission]', agent_commission2='$_POST[agent_commission2]',note='$note',status='$_POST[status]' WHERE insurance_scheme_id='$_GET[editid]'";
		//echo $sql;
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('Insurance scheme record UPDATED successfully...');</script>";
			}
			else
			{
				echo "Failed to update  record.." . mysqli_error($con);
			}
		}
		else
		{
			$sql = "INSERT INTO insurance_scheme (insurance_type_id,insurance_scheme,img,agent_commission,agent_commission2,note,status) VALUES ('$_POST[itype]','$_POST[ischeme]','$imgname ','$_POST[agent_commission]','$_POST[agent_commission2]','$note','$_POST[status]')";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('Insurance scheme record inserted successfully...');</script>";
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
	$sqledit = "SELECT * FROM insurance_scheme WHERE insurance_scheme_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid] = rand();
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>Adding Insurance Scheme</h2>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmscheme" onsubmit="return validateform()" enctype="multipart/form-data">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />

<div align="center">
    <table cellspacing="0" class="table table-striped table-bordered" id="example" style="width:100%">
    
    <tr><th>  <label for="Password">Insurance type:</label></th><td>
    <select name="itype" class="form-control">
    <option value="">Select</option>
    <?php
    $sqlinsurplan = "SELECT * FROM insurance_type WHERE status='Active'";
    $qsqlinsurplan = mysqli_query($con,$sqlinsurplan);
    while($rsinsurplan = mysqli_fetch_array($qsqlinsurplan))
    {
    if($rsinsurplan[insurance_type_id] == $rsedit[insurance_type_id])
    {
    echo "<option value='$rsinsurplan[insurance_type_id]' selected>$rsinsurplan[insurance_type]</option>";
    }
    else
    {
    echo "<option value='$rsinsurplan[insurance_type_id]'>$rsinsurplan[insurance_type]</option>";
    }
    }
    ?>
    </select><span id="iditype"></span></br></td></tr>
    
    <tr><th><label for="author">Insurance Scheme:</label> </th><td><input type="text" name="ischeme" class="form-control"    value="<?php echo $rsedit['insurance_scheme']; ?>"  /><span id="idischeme"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th> <label for="Password">Image:</label></th><td><input type="file" name="img" id="img" class="form-control" /></br><span id="iditype"></span>
    <?php
    if(isset($_GET[editid]))
    {
        if($rsedit[img] != "")
        {
        echo "<img src='insuranceimg/$rsedit[img]'  width='300px' height='250px'></img>";
        }
    }
    ?>
    </td></tr>
    <tr><th> <label for="author">Commission for New Registration:<br />(in percentage %)</label> </th><td><input type="number" min="0" max="100" name="agent_commission" class="form-control"    value="<?php echo $rsedit['agent_commission']; ?>" /><span id="idagent_commission"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th> <label for="author">Commission for Installment Payment:<br />(in percentage %)</label> </th><td><input type="number" min="0" max="100" name="agent_commission2" class="form-control"    value="<?php echo $rsedit['agent_commission2']; ?>" /><span id="idagent_commission"></span><div class="cleaner_h10"></div></td></tr>
    
    
    <tr><th><label for="Password">Note:</label>
     <script src="richtexteditor/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script> </th><td><textarea name="note" id="note" class="form-control" ><?php echo $rsedit['note']; ?></textarea><span id="idnote"></span> <div class="cleaner_h10"></div></td></tr>
    
    <tr><th><label for="Password">Status:</label>  </th><td><select name="status" class="form-control"    >
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
	document.getElementById("idischeme").innerHTML = "";
	document.getElementById("idagent_commission").innerHTML = "";
	document.getElementById("idstatus").innerHTML = "";
	
	if(document.frmscheme.itype.value=="")
	{
		document.getElementById("iditype").innerHTML = "<font color='red'>Select Insurance Type</font>";	
		document.frmscheme.itype.focus();
		i=1;
	}
	if(!document.frmscheme.ischeme.value.match(alphaspaceExp))
	{
		document.getElementById("idischeme").innerHTML = "<font color='red'>Insurance scheme should contain only alphabets</font>";	
		document.frmscheme.ischeme.focus();
		i=1;
	}		
	if(document.frmscheme.ischeme.value=="")
	{
		document.getElementById("idischeme").innerHTML = "<font color='red'>Enter insurance scheme</font>";	
		document.frmscheme.ischeme.focus();
		i=1;
	}	
	if(document.frmscheme.agent_commission.value=="")
	{
		document.getElementById("idagent_commission").innerHTML = "<font color='red'>Agent commission cannot be empty</font>";	
		document.frmscheme.agent_commission.focus();
		i=1;
	}	
	
	if(document.frmscheme.status.value=="")
	{
		document.getElementById("idstatus").innerHTML = "<font color='red'>Select status</font>";	
		document.frmscheme.status.focus();
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