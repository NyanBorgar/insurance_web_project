<?php
include("dbconnection.php");
?>

<select name="ischeme" class="validate-email required input_field form-control">
    <option value="">Select</option>
    <?php
    $sqlstate = "SELECT * FROM insurance_scheme WHERE insurance_type_id='$_GET[itype]'";
    $qsqlstate = mysqli_query($con,$sqlstate);
    while($rsstate = mysqli_fetch_array($qsqlstate))
    {
		if($rsstate[insurance_scheme_id] == $rsedit[insurance_scheme_id])
		{
		echo "<option value='$rsstate[insurance_scheme_id]' selected>$rsstate[insurance_scheme]</option>";
		}
		else
		{
		echo "<option value='$rsstate[insurance_scheme_id]'>$rsstate[insurance_scheme]</option>";
		}
    }
    ?>
</select>