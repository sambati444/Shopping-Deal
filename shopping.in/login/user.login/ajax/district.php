<?php
include '../../connect.php';
$state=mysql_real_escape_string($_GET['state']);
$state=mysql_query("SELECT DISTINCT(district) FROM pre_area WHERE state='$state' ORDER BY district")or die(mysql_error());
if(mysql_num_rows($state)>=1)
{
	echo '<option value="">Select</option>';
	while($row=mysql_fetch_array($state))
	{
		echo '<option value="'.$row['district'].'">'.$row['district'].'</option>';
	}
}
?>