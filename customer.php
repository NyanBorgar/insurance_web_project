<?php
include("header.php");
if($_SESSION[randomid]==$_POST[randomid])
{
	if(isset($_POST[submit]))
	{
		$pwd = md5($_POST[password]);
		if(isset($_GET[editid]))
		{
			$sql = "UPDATE customer SET customer_name='$_POST[custname]',cust_address='$_POST[address]',cust_mobile='$_POST[mobno]',cust_dob='$_POST[dob]',login_id='$_POST[loginid]',password='$pwd',email_id='POST[email]',nominee='$_POST[nominee]',nominee_relation='$_POST[nomineerelation]',status='$_POST[status]',city='$_POST[city]',state='$_POST[state]',pin='$_POST[pincode]' WHERE customer_id='$_GET[editid]'";
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
		else
		{
			$sqlcust=  "SELECT * FROM customer WHERE login_id='$_POST[loginid]'";
			$qssqlcust = mysqli_query($con,$sqlcust);
			if(mysqli_num_rows($qssqlcust) >=1)
			{
				echo "<script>alert('Customer record already exists...');</script>";
			}
			else
			{
				if($_POST[textstate] != "")
				{
					$sql = "INSERT INTO state (state,status) VALUES ('$_POST[textstate]','Inactive')";
					$qsql = mysqli_query($con,$sql);
					$insstateid = mysqli_insert_id($con);
				}
				else
				{
					$insstateid = $_POST[state];
				}
				if($_POST[textcity] != "")
				{
					$sql = "INSERT INTO city (state_id,city,status) VALUES ('$insstateid','$_POST[textcity]','Inactive')";
					$qsql = mysqli_query($con,$sql);
					$inscityid = mysqli_insert_id($con);
				}
				else
				{
					$inscityid = $_POST[city];
				}
				
					$sql = "INSERT INTO customer (customer_name,agent_id,cust_address, cust_mobile, cust_dob, login_id, password,email_id, nominee, nominee_relation, status, city_id, state_id, pin) VALUES ('$_POST[custname]','$_SESSION[referralid]','$_POST[address]','$_POST[mobno]','$_POST[dob]','$_POST[loginid]','$pwd','$_POST[email]','$_POST[nominee]','$_POST[nomineerelation]','$_POST[status]','$inscityid','$insstateid','$_POST[pincode]')";
					$qsql = mysqli_query($con,$sql);
					if(mysqli_affected_rows($con) == 1 )
					{				
							$insid = mysqli_insert_id($con);
							echo "<script>alert('Registration done successfully. Kindly verify your Email ID..');</script>";
							$mailmsg  = ' <strong>Complete the registration by clicking following link : <br> <a href="http://localhost/insurpolicy/login.php?customerid=' . $insid . '&st=Active">Click here to verify</a></strong>
							<hr><table  border="2">					
							<tr>
							<th><div align="left">Customer Name:</div></th><td> ' . $_POST[custname] . ' </span></td>
							<div class="cleaner_h10"></div></tr>					
							<tr> <th> <div align="left">Date Of Birth.:</div></th><td>' . $_POST[dob] . '</td></tr>					
							<tr><th> <div align="left">Login ID:</div></th><td>' . $_POST[loginid] . '</td></tr>					
							<tr><th> <div align="left">Address:</div></th><td>' . $_POST[address] . '</td></tr>					
							<tr><th> <div align="left">Email ID:</div></th><td>' . $_POST[email] . '</td></tr>					
							<tr><th><div align="left">Mobile No.: </div></th><td>' . $_POST[mobno] . '</td></tr>					
							<tr><th> <div align="left">Nominee:</div></th><td>' . $_POST[nominee] . '</td></tr>					
							<tr><th><div align="left">Nominee Relation:</div></th><td>' . $_POST[nomineerelation] . '</td>
							</tr>       
							</table>';			
							include("sendmail.php");
							sendmail($_POST[email],"Email Verification for Customer Registration",$mailmsg,$_POST[custname]);	
							echo "<script>window.location='login.php';</script>";
					}
					else
					{
						echo "Failed to insert customer record.." . mysqli_error($con);
					}
			}
		}
	
	}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM customer WHERE customer_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);

}

	$sqlagent = "SELECT * FROM agent WHERE agent_id='$_SESSION[referralid]'";
	$qsqlagent = mysqli_query($con,$sqlagent);
	$rsagent = mysqli_fetch_array($qsqlagent);

$_SESSION[randomid]=rand();
?>
    
   
<section id="contact-page">
<div class="container"  >
    <div class="center">        
    <h2>CUSTOMER REGISTRATION</h2>
    <p class="lead">Kindly enter the credentials</p>
    </div> 

<div class="row contact-wrap"  > 
<form  id="main-contact-form" class="contact-form" method="post" name="frmcust" action="" onsubmit="return validateform()" >
<input type="hidden" name="randomid" value="<?php echo $_SESSION[randomid]; ?>"  />


<div align="center">
    <table   border=2" id="example" class="table table-striped table-bordered" cellspacing="0" style="width:70%" >
    
    <tr>
    <th><div align="left">Customer Name:</div></th><td> <input type="text" name="custname" class="form-control"  maxlength="40" value="<?php echo $rsedit['customer_name']; ?>"/><span id="idcustname"> </span></td></tr>
    
    
    <tr> <th> <div align="left">Date Of Birth.:</div></th><td><input type="date" name="dob" class="form-control"   max="<?php
        echo date("Y-m-d",mktime(0,0,0,date(m),date(d),date(Y)-18));
        ?>" value="<?php echo $rsedit['cust_dob']; ?>"/><span id="iddob"> </span></td></tr>
    
    <tr><th> <div align="left">Login ID:</div></th><td><input type="text" name="loginid" class="form-control"  value="<?php echo $rsedit['login_id']; ?>"/><span id="idloginid"> </span></td></tr>
    
    <tr><th><div align="left">Password:</div></th><td><input type="password" class="form-control"  name="password" value="<?php echo $rsedit['password']; ?>"/><span id="idpassword"> </span></td></tr>
    
    <tr><th> <div align="left">Confirm Password:</div></th><td> <input type="password" class="form-control" name="cpassword" /><span id="idcpassword"> </span></td></tr>
    
    <tr><th> <div align="left">Address:</div></th><td><textarea  class="form-control"   name="address"  /><?php echo $rsedit['cust_address']; ?>
    </textarea><span id="idaddress"> </span></td></tr>
    
    <tr><th> <div align="left">Email ID:</div></th><td><input type="email" class="form-control" name="email" /><span id="idemail"> </span></td></tr>
    
    <tr><th><div align="left">State:</div></th><td><select name="state" class="form-control"  onchange="loadcity(this.value)">
    <option value="">Select</option>
    <?php
    $sqlstate = "SELECT * FROM state WHERE status='Active'";
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
    <option value="Others">Others</option>
    </select>
    
<input type="text" name="textstate" id="textstate"  class="form-control" placeholder="Enter state" style='display:none'/>

    </br><span id="idstate"> </span></td></tr>
    
    <tr><th> <div align="left">City:</div></th>
    <td><span id="loadcity">
    <select name="city" class="form-control" ></select>    
    </span><span id="idcity"> </span>
    <input type="text" name="textcity" id="textcity"  class="form-control" placeholder="Enter city" style='display:none'/>
	</td></tr>
    
    <tr><th> <div align="left">Pincode:</div></th><td> <input type="text" name="pincode" class="form-control"  value="<?php echo $rsedit['pin']; ?>" /><span id="idpincode"> </span></td></tr>
    
    <tr><th><div align="left">Mobile No.: </div></th><td><input type="text" name="mobno" class="form-control"  value="<?php echo $rsedit['cust_mobile']; ?>"/><span id="idmobno"> </span></td><div class="cleaner_h10"></div></tr>
    
    <tr><th> <div align="left">Nominee:</div></th><td><input type="text" name="nominee" class="form-control"  value="<?php echo $rsedit['nominee']; ?>"/><span id="idnominee"> </span></td><div class="cleaner_h10"></div></tr>
    
    <tr><th><div align="left">Nominee Relation:</div></th><td><select name="nomineerelation" class="form-control" >
    <option value="">Select</option>
    <?php
    $arr = array("Father","Mother","Brother","Sister","Brother-in-law","Sister-in-law","Wife","Husband","Uncle","Aunt");
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
    </select><span id="idnomineerelation"> </span></td>
    </tr>
    
    <?php
    if(isset($_SESSION[customer_id]))
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
    
    <?php
    if(isset($_SESSION[referralid]))
    {
    ?>
    <tr>
        <th> <div align="left">Agent Code:</div></th>
        <td><input type="text" readonly name="agent_code" class="form-control"  value="<?php echo $rsagent[agent_code]; ?>"/></td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <th colspan="2"><center><input type="submit" value="Submit" id="submit" name="submit" class="btn btn-primary btn-lg" /></center></th>
      </tr>
    </table>                         

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
	if(stateid==="Others")
    {
       document.getElementById('textstate').style.display='block';
       document.getElementById('textcity').style.display='block';       
    }
    else
    {
       document.getElementById('textstate').style.display='none'; 
       document.getElementById('textcity').style.display='none';              
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
}

function loadotherscity(cityid)
{
	if(cityid==="Others")
    {
       document.getElementById('textcity').style.display='block';       
    }
    else
    {
       document.getElementById('textcity').style.display='none';              
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
	var mailformat = /^\w+([\.-]?w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	
	
	document.getElementById("idcustname").innerHTML = "";
	document.getElementById("iddob").innerHTML = "";
	document.getElementById("idloginid").innerHTML = "";
	document.getElementById("idpassword").innerHTML = "";
	document.getElementById("idcpassword").innerHTML = "";
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
		document.frmcust.dob.focus();
		i=1;
	}	
	if(document.frmcust.loginid.value=="")
	{
		document.getElementById("idloginid").innerHTML = "<font color='red'>Login ID cannot be empty</font>";	
		document.frmcust.dob.focus();
		i=1;
	}
	if(!document.frmcust.password.value.match(alphanumericExp))
	{
		document.getElementById("idpassword").innerHTML = "<font color='red'>Please input alphabets or numbers</font>";	
		document.frmcust.dob.focus();
		i=1;
	}
	if(document.frmcust.password.value.length <=7 && document.frmcust.password.value.length <=14)
	{
		document.getElementById("idpassword").innerHTML = "<font color='red'>Please input between 7-14 characters </font>";	
		document.frmcust.dob.focus();
		i=1;
	}	
	if(document.frmcust.password.value=="")
	{
		document.getElementById("idpassword").innerHTML = "<font color='red'>Password cannot be empty</font>";	
		document.frmcust.dob.focus();
		i=1;
	}	
	if(document.frmcust.password.value!=document.frmcust.cpassword.value)
	{
		document.getElementById("idcpassword").innerHTML = "<font color='red'>Password and Confirm Password should be same </font>";	
		document.frmcust.dob.focus();
		i=1;
	}
	if(document.frmcust.cpassword.value=="")
	{
		document.getElementById("idcpassword").innerHTML = "<font color='red'>Confirm Password cannot be empty</font>";	
		document.frmcust.dob.focus();
		i=1;
	}	
	if(document.frmcust.address.value=="")
	{
		document.getElementById("idaddress").innerHTML = "<font color='red'>Adress cannot be empty</font>";	
		document.frmcust.dob.focus();
		i=1;
	}	
	if(!document.frmcust.email.value.match(mailformat))
	{
		document.getElementById("idemail").innerHTML = "<font color='red'>Email-ID cannot be empty</font>";	
		document.frmcust.email.focus();
		i=1;
	}	
	if(document.frmcust.email.value=="")
	{
		document.getElementById("idemail").innerHTML = "<font color='red'>Email-ID cannot be empty</font>";	
		document.frmcust.email.focus();
		i=1;
	}	
	if(document.frmcust.state.value=="")
	{
		document.getElementById("idstate").innerHTML = "<font color='red'>Please select your state</font>";	
		document.frmcust.dob.focus();
		i=1;
	}	
    if(document.frmcust.state.value != "Others")
    {
		if(document.frmcust.city.value=="")
		{
		document.getElementById("idcity").innerHTML = "<font color='red'>Please select your city</font>";	
		document.frmcust.dob.focus();
		i=1;
		}
    }	
	if(!document.frmcust.pincode.value.match(numericExpression))
	{
		document.getElementById("idpincode").innerHTML = "<font color='red'>Please input only numbers</font>";	
		document.frmcust.dob.focus();
		i=1;
	}
	if(document.frmcust.pincode.value=="")
	{
		document.getElementById("idpincode").innerHTML = "<font color='red'>Please enter your pincode</font>";	
		document.frmcust.dob.focus();
		i=1;
	}
	if(!document.frmcust.mobno.value.match(mobileno))
	{
		document.getElementById("idmobno").innerHTML = "<font color='red'>Mobile number should contain 10 digits</font>";	
		document.frmcust.dob.focus();
		i=1;
	}		
	if(document.frmcust.mobno.value=="")
	{
		document.getElementById("idmobno").innerHTML = "<font color='red'>Mobile number cannot be empty</font>";	
		document.frmcust.dob.focus();
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
		document.frmcust.dob.focus();
		i=1;
	}	
	if(document.frmcust.nomineerelation.value=="")
	{
		document.getElementById("idnomineerelation").innerHTML = "<font color='red'>Select Nominee relation </font>";	
		document.frmcust.dob.focus();
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