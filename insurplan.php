<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		if(isset($_GET[editid]))
		{
			$sql = "UPDATE insurance_plan SET insurance_type_id='$_POST[itype]',insurance_scheme_id='$_POST[ischeme]',policy_term_min='$_POST[min]',policy_term_max='$_POST[max]',min_age='$_POST[amin]',max_age='$_POST[max]',sum_assured_min='$_POST[smin]',sum_assured_max='$_POST[smax]',profit_ratio='$_POST[profit]',status='$_POST[status]' WHERE insurance_plan_id='$_GET[editid]'";
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
			$sql = "INSERT INTO insurance_plan (insurance_type_id,insurance_scheme_id,policy_term_min,policy_term_max,min_age, max_age,sum_assured_min,sum_assured_max,profit_ratio,status) VALUES ('$_POST[itype]','$_POST[ischeme]','$_POST[mini]','$_POST[maxi]','$_POST[amin]','$_POST[amax]','$_POST[smin]','$_POST[smax]','$_POST[profit]','$_POST[status]')";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1 )
			{
				echo "<script>alert('Insurance plan record inserted successfully...');</script>";
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
	$sqledit = "SELECT * FROM insurance_plan WHERE insurance_plan_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>

<section id="contact-page">
<div class="container">
<div class="center">        
<h2>Adding Insurance Plan</h2>
<p class="lead"></p>
</div> 
<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form id="main-contact-form" class="contact-form" method="post"  action="" name="frmplan" onsubmit="return validateform()">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />

<div align="center">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" style="width:70%">
    
    <tr><th><label for="Password">Insurance Type:</label></th><td> <select name="itype" class="form-control" onchange="loadscheme(this.value)">
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
    </select></br><span id="iditype"></span></td></tr>
    
    <tr><th><label for="Password">Insurance Scheme:</label></th><td> <span id="loadscheme">
    <select name="ischeme" class="form-control" ></select>
    </span><span id="idischeme"> </span></td></tr>
    
    <tr><td colspan="2"> <label for="Password">Policy Term:</label></td></tr>
                   
    <tr><th><label for="Password">Minimum:</label> </th><td><input type="text" class="form-control"  name="mini" value="<?php echo $rsedit['policy_term_min']; ?>"/><span id="idmini"></span>
    <div class="cleaner_h10"></div></td></tr>
    
    <tr><th><label for="Password">Maximum:</label> </th><td> <input type="text" class="form-control"  name="maxi" value="<?php echo $rsedit['policy_term_max']; ?>"/><span id="idmaxi"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><td colspan="2">  <label for="Password">Age:</label></td></tr>
                 
    <tr><th><label for="Password">Minimum:</label> </th><td> <input type="text" class="form-control"  name="amin"value="<?php echo $rsedit['min_age']; ?>" /><span id="idamin"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th> <label for="Password">Maximum:</label> </th><td> <input type="text" class="form-control"  name="amax" value="<?php echo $rsedit['max_age']; ?>" /><span id="idamax"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><td colspan="2"> <label for="author">Total Investment Amount:</label> </td></tr>
    
    <tr><th> <label for="Password">Minimum:</label> </th><td> <input type="text" class="form-control"  name="smin" value="<?php echo $rsedit['sum_assured_min']; ?>"/><span id="idsmin"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th> <label for="Password">Maximum:</label> </th><td> <input type="text" class="form-control"  name="smax" value="<?php echo $rsedit['sum_assured_max']; ?>" /><span id="idsmax"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th> <label for="author">Profit Ratio:</label>  </th><td><input type="text" name="profit" class="form-control"  value="<?php echo $rsedit['profit_ratio']; ?>"/><span id="idprofit"></span><div class="cleaner_h10"></div></td></tr>
    
    <tr><th> <label for="Password">Status:</label> </th><td> <select name="status" class="form-control" >
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
include("footer.php"); 
?>

<script type="application/javascript">
function loadscheme(itype)
{
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else 
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
		
        xmlhttp.open("GET","ajaxscheme.php?itype="+itype,true);
        xmlhttp.send();
		
		xmlhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("loadscheme").innerHTML = this.responseText;
            }
        };
}

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
	document.getElementById("idmini").innerHTML = "";
	document.getElementById("idmaxi").innerHTML = "";
	document.getElementById("idamin").innerHTML = "";
	document.getElementById("idamax").innerHTML = "";
	document.getElementById("idsmin").innerHTML = "";
	document.getElementById("idsmax").innerHTML = "";
	document.getElementById("idprofit").innerHTML = "";
	document.getElementById("idstatus").innerHTML = "";
	
		
	if(document.frmplan.itype.value=="")
	{
		document.getElementById("iditype").innerHTML = "<font color='red'>Select insurance type</font>";	
		document.frmplan.itype.focus();
		i=1;
	}	
	if(document.frmplan.ischeme.value=="")
	{
		document.getElementById("idischeme").innerHTML = "<font color='red'>Select insurance scheme</font>";	
		document.frmplan.ischeme.focus();
		i=1;
	}	
	if(!document.frmplan.mini.value.match(numericExpression))
	{
		document.getElementById("idmini").innerHTML = "<font color='red'>Enter only numbers</font>";	
		document.frmplan.mini.focus();
		i=1;
	}	
	if(document.frmplan.mini.value=="")
	{
		document.getElementById("idmini").innerHTML = "<font color='red'>Enter minimum policy-term</font>";	
		document.frmplan.mini.focus();
		i=1;
	}	
	if(!document.frmplan.maxi.value.match(numericExpression))
	{
		document.getElementById("idmaxi").innerHTML = "<font color='red'>Enter only numbers</font>";	
		document.frmplan.maxi.focus();
		i=1;
	}	
	if(document.frmplan.maxi.value=="")
	{
		document.getElementById("idmaxi").innerHTML = "<font color='red'>Enter maximum policy-term</font>";	
		document.frmplan.maxi.focus();
		i=1;
	}	
	if(!document.frmplan.amin.value.match(numericExpression))
	{
		document.getElementById("idamin").innerHTML = "<font color='red'>Enter only numbers</font>";	
		document.frmplan.amin.focus();
		i=1;
	}	
	if(document.frmplan.amin.value=="")
	{
		document.getElementById("idamin").innerHTML = "<font color='red'>Enter maximum age</font>";	
		document.frmplan.amin.focus();
		i=1;
	}	
	if(!document.frmplan.amax.value.match(numericExpression))
	{
		document.getElementById("idamax").innerHTML = "<font color='red'>Enter only numbers</font>";	
		document.frmplan.amax.focus();
		i=1;
	}	
	if(document.frmplan.amax.value=="")
	{
		document.getElementById("idamax").innerHTML = "<font color='red'>Enter maximum age</font>";	
		document.frmplan.amax.focus();
		i=1;
	}	
	if(!document.frmplan.smin.value.match(numericExpression))
	{
		document.getElementById("idsmin").innerHTML = "<font color='red'>Enter only numbers</font>";	
		document.frmplan.smin.focus();
		i=1;
	}	
	if(document.frmplan.smin.value=="")
	{
		document.getElementById("idsmin").innerHTML = "<font color='red'>Enter maximum age</font>";	
		document.frmplan.smin.focus();
		i=1;
	}	
	if(!document.frmplan.smax.value.match(numericExpression))
	{
		document.getElementById("idsmax").innerHTML = "<font color='red'>Enter only numbers</font>";	
		document.frmplan.smax.focus();
		i=1;
	}	
	if(document.frmplan.smax.value=="")
	{
		document.getElementById("idsmax").innerHTML = "<font color='red'>Enter maximum age</font>";	
		document.frmplan.smax.focus();
		i=1;
	}	
	if(!document.frmplan.profit.value.match(numericExpression))
	{
		document.getElementById("idprofit").innerHTML = "<font color='red'>Enter only numbers</font>";	
		document.frmplan.profit.focus();
		i=1;
	}	
	if(document.frmplan.profit.value=="")
	{
		document.getElementById("idprofit").innerHTML = "<font color='red'>Enter maximum policy term</font>";	
		document.frmplan.profit.focus();
		i=1;
	}	
	if(document.frmplan.status.value=="")
	{
		document.getElementById("idstatus").innerHTML = "<font color='red'>Enter maximum policy term</font>";	
		document.frmplan.status.focus();
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