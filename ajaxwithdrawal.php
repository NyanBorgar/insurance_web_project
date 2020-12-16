<?php
include("dbconnection.php");
$sql = "UPDATE commission_master set particulars='$_GET[text]' where commission_master_id='$_GET[commid]'";
$qsql = mysqli_query($con,$sql);
?>