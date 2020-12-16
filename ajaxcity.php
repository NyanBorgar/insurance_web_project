<?php
include("dbconnection.php");
?>

<select name="city" class="validate-email required input_field form-control"  onchange="loadotherscity(this.value)">
    <option value="">Select</option>
    <?php
    $sqlstate = "SELECT * FROM city WHERE state_id='$_GET[stateid]' And status='Active'";
    $qsqlstate = mysqli_query($con,$sqlstate);
    while($rsstate = mysqli_fetch_array($qsqlstate))
    {
		if($rsstate[city_id] == $rsedit[city_id])
		{
		echo "<option value='$rsstate[city_id]' selected>$rsstate[city]</option>";
		}
		else
		{
		echo "<option value='$rsstate[city_id]'>$rsstate[city]</option>";
		}
    }
    ?>
    <option value="Others">Others</option>
</select>