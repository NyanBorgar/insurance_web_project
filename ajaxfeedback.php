<?php
include("dbconnection.php");
$sqledit = "UPDATE contact SET reply='$_GET[replymsg]' WHERE contact_id='$_GET[empid]'";
mysqli_query($con,$sqledit);
//echo mysqli_affected_rows($con);
?>