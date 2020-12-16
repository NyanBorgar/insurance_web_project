<?php
function fun_countrylist()
{
	$arr = array('India','Canada','USA','Pakistan','Bangladesh');
	echo "<select name='country'>
	<option value=''>Select</option>";
	foreach($arr as $val)
	{
		if($val == $country)
		{
		echo "<option value='$val' selected>$val</option>";
		}
		else
		{
		echo "<option value='$val'>$val</option>";
		}
	}
	echo "</select>";
}

function fun_status()
{
	$stat=array('Active','Inactive');
	echo "<select name='status'  class='required input_field'>
	<option value=''>select</option>";
	foreach($stat as $val)
	{
		if($val==$status)
		{
			echo "<option value='$val' selected>$val</option>";
		}
		else
		{
			echo "<option value='$val'>$val</option>";
		}
	}
	echo "</select>";
}
?>