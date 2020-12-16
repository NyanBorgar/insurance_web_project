<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		$sql = "UPDATE customer SET customer_name='$_POST[custname]',cust_address='$_POST[address]',cust_mobile='$_POST[mobno]',cust_dob='$_POST[dob]',login_id='$_POST[loginid]',nominee='$_POST[nominee]',nominee_relation='$_POST[nomineerelation]',status='$_POST[status]',city_id='$_POST[city]',state_id='$_POST[state]',pin='$_POST[pincode]' WHERE customer_id='$_SESSION[customer_id]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1 )
		{
			echo "<script>alert('1 record pdated successfully...');</script>";
		}
		else
		{
			echo "Failed to insert customer record.." . mysqli_error($con);
		}	
	}
}
if(isset($_SESSION[customer_id]))
{
	$sqledit = "SELECT * FROM customer WHERE customer_id='$_SESSION[customer_id]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
$_SESSION[randomid]=rand();
?>   
   
<section id="contact-page">
<div class="container">
<div class="center">        
<h2>CUSTOMER PROFILE</h2>
<p class="lead">update...</p>
</div> 

<div class="row contact-wrap"> 
<div class="status alert alert-success" style="display: none"></div>

<form  id="main-contact-form" class="contact-form" method="post" name="frmcust" action="" onsubmit="return validateform()">
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />


<div align="center">
<table   id="example" class="table table-striped table-bordered" cellspacing="0" width="50%">

<tr>
<th><div align="left">Customer Name:</div></th><td> <input type="text" name="custname" class="form-control"  maxlength="40" value="<?php echo $rsedit['customer_name']; ?>"/><span id="idcustname"> </span></td>
<div class="cleaner_h10"></div></tr>


<tr> <th> <div align="left">Date Of Birth.:</div></th><td><input type="date" name="dob" class="form-control"  value="<?php echo $rsedit['cust_dob']; ?>"/><span id="iddob"> </span></td><div class="cleaner_h10"></div></tr>

<tr><th> <div align="left">Login ID:</div></th><td><input type="text" name="loginid" class="form-control"  value="<?php echo $rsedit['login_id']; ?>"/><span id="idloginid"> </span></td><div class="cleaner_h10"></div></tr>



<tr><th> <div align="left">Address:</div></th><td><textarea  class="form-control"   name="address"  /><?php echo $rsedit['cust_address']; ?>
</textarea><span id="idaddress"> </span></td><div align="left"></div><div class="cleaner_h10"></div></tr>

<tr><th> <div align="left">Email ID:</div></th><td><input type="email" class="form-control" name="email" value="<?php echo $rsedit['email_id']; ?>" /> <span id="idaddress"> </span><span id="idemail"> </span></td><div align="left"></div><div class="cleaner_h10"></div></tr>

<tr><th><div align="left">State:</div></th><td><select name="state" class="form-control"  onchange="loadcity(this.value)">
<option value="">Select</option>
<?php
$sqlstate = "SELECT * FROM state";
$qsqlstate = mysqli_query($con,$sqlstate);
while($rsstate = mysqli_fetch_array($qsqlstate))
{
if($rsstate[state_id] == $rsedit[state_id])
{
echo "<option value='$rsstate[state_id]' selected>$rsstate[state]</option>";
}
else
{
echo "<option value='$rsstate[state_id]'>$rsstate[state]</option>";
}
}
?>
</select></br><span id="idstate"> </span></td><div align="left"></div>
<div class="cleaner_h10"></div></tr>

<tr><th> <div align="left">City:</div></th>
<td><span id="loadcity">
<select name="city" class="form-control" >

<?php
$sqlstate = "SELECT * FROM city";
$qsqlstate = mysqli_query($con,$sqlstate);
while($rsstate = mysqli_fetch_array($qsqlstate))
{
	if($rsstate[city_id] == $rsedit[city_id])
	{
	echo "<option value='$rsstate[city_id]' selected>$rsstate[city]</option>";
	}
}
?></select>
</span></td>
<div class="cleaner_h10"></div>
</br>
<div align="left"></div></tr>

<tr><th> <div align="left">Pincode:</div></th><td> <input type="text" name="pincode" class="form-control"  value="<?php echo $rsedit['pin']; ?>" /><span id="idpincode"> </span></td>
<div class="cleaner_h10"></div></tr>

<tr><th><div align="left">Mobile No.: </div></th><td><input type="text" name="mobno" class="form-control"  value="<?php echo $rsedit['cust_mobile']; ?>"/><span id="idmobno"> </span></td><div class="cleaner_h10"></div></tr>

<tr><th> <div align="left">Nominee:</div></th><td><input type="text" name="nominee" class="form-control"  value="<?php echo $rsedit['nominee']; ?>"/><span id="idnominee"> </span></td><div class="cleaner_h10"></div></tr>

<tr><th><div align="left">Nominee Relation:</div></th><td><select name="nomineerelation" class="form-control" >
<option value="">Select Relation</option>
<?php
$arr = array("Father","Mother","Brother","Sister","Brother-in-law","Sister-in-law","Wife","Husband","Uncle","Aunt");
foreach($arr as $val)
{
if($val == $rsedit[nominee_relation])
{
echo "<option value='$val' selected>$val</option>";
}
else
{

echo "<option value='$val'>$val</option>";
}
}
?>
</select></br><span id="idnomineerelation"> </span></td>
</tr>

<?php
if(isset($_SESSION[employee_id]))
{
?>
<div class="cleaner_h10"></div>

<tr><th> <div align="left">Status:</div></th>
<td> <select name="status" class="form-control" >
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
</select></br><span id="idstatus"> </span></td></tr>

<?php
}
else
{
echo "<input type='hidden'  name='status' value='Pending' >";
}
?>                     
</div>


</table>                         
<br>
<input type="submit" value="Submit" id="submit" name="submit" class="btn btn-primary btn-lg" />					

</form>
</div><!--/.row-->
</div><!--/.container-->
</section><!--/#contact-page-->

<?php
include("footer.php"); include("datatables.php");
?>
<script type="application/javascript">
function loadcity(stateid)
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
		
        xmlhttp.open("GET","ajaxcity.php?stateid="+stateid,true);
        xmlhttp.send();
		
		xmlhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("loadcity").innerHTML = this.responseText;
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
	
	document.getElementById("idcustname").innerHTML = "";
	document.getElementById("iddob").innerHTML = "";
	document.getElementById("idloginid").innerHTML = "";
	document.getElementById("idaddress").innerHTML = "";
	document.getElementById("idemail").innerHTML = "";
	document.getElementById("idstate").innerHTML = "";
	document.getElementById("idcity").innerHTML = "";
	document.getElementById("idpincode").innerHTML = "";
	document.getElementById("idmobno").innerHTML = "";
	document.getElementById("idnominee").innerHTML = "";
	document.getElementById("idnomineerelation").innerHTML = "";
	
	if(!document.frmcust.custname.value.match(alphaspaceExp))
	{
		document.getElementById("idcustname").innerHTML = "<font color='red'>Customer name should contain only alphabets</font>";	
		document.frmcust.custname.focus();
		i=1;
	}	
	if(document.frmcust.custname.value=="")
	{
		document.getElementById("idcustname").innerHTML = "<font color='red'>Customer name cannot be empty</font>";	
		document.frmcust.custname.focus();
		i=1;
	}	
	
	if(document.frmcust.dob.value=="")
	{
		document.getElementById("iddob").innerHTML = "<font color='red'>Date Of Birth cannot be empty</font>";	
		document.frmcust.dob.focus();
		i=1;
	}
	if(!document.frmcust.loginid.value.match(alphaExp))
	{
		document.getElementById("idloginid").innerHTML = "<font color='red'>Login ID should contain only alphabets</font>";	
		document.frmcust.loginid.focus();
		i=1;
	}	
	if(document.frmcust.loginid.value=="")
	{
		document.getElementById("idloginid").innerHTML = "<font color='red'>Login ID cannot be empty</font>";	
		document.frmcust.loginid.focus();
		i=1;
	}
	
	if(document.frmcust.address.value=="")
	{
		document.getElementById("idaddress").innerHTML = "<font color='red'>Adress cannot be empty</font>";	
		document.frmcust.address.focus();
		i=1;
	}	
	if(document.frmcust.email.value=="")
	{
		document.getElementById("idemail").innerHTML = "<font color='red'>Email Adress cannot be empty</font>";	
		document.frmcust.email.focus();
		i=1;
	}	
	if(document.frmcust.state.value=="")
	{
		document.getElementById("idstate").innerHTML = "<font color='red'>Please select your state</font>";	
		document.frmcust.state.focus();
		i=1;
	}	
	if(document.frmcust.city.value=="")
	{
		document.getElementById("idcity").innerHTML = "<font color='red'>Please select your city</font>";	
		document.frmcust.city.focus();
		i=1;
	}	
	if(document.frmcust.pincode.value=="")
	{
		document.getElementById("idpincode").innerHTML = "<font color='red'>Please enter your pincode</font>";	
		document.frmcust.pincode.focus();
		i=1;
	}
	if(!document.frmcust.mobno.value.match(mobileno))
	{
		document.getElementById("idmobno").innerHTML = "<font color='red'>Mobile number should contain 10 digits</font>";	
		document.frmcust.mobno.focus();
		i=1;
	}		
	if(document.frmcust.mobno.value=="")
	{
		document.getElementById("idmobno").innerHTML = "<font color='red'>Mobile number cannot be empty</font>";	
		document.frmcust.mobno.focus();
		i=1;
	}	
	if(!document.frmcust.nominee.value.match(alphaspaceExp))
	{
		document.getElementById("idnominee").innerHTML = "<font color='red'>Nominee should contain only alphabets</font>";	
		document.frmcust.nominee.focus();
		i=1;
	}
	if(document.frmcust.nominee.value=="")
	{
		document.getElementById("idnominee").innerHTML = "<font color='red'>Nominee cannot be empty</font>";	
		document.frmcust.nominee.focus();
		i=1;
	}	
	if(document.frmcust.nomineerelation.value=="")
	{
		document.getElementById("idnomineerelation").innerHTML = "<font color='red'>Select Nominee relation </font>";	
		document.frmcust.nomineerelation.focus();
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