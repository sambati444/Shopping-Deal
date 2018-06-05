<?php
session_start();
include '../../login/connect.php';
$country=mysql_real_escape_string($_GET['country']);
$state=mysql_query("SELECT DISTINCT(state) FROM pre_area WHERE country='$country' ORDER BY state")or die(mysql_error());
if(mysql_num_rows($state)>=1)
{
	echo '<option value="">Select</option>';
	while($row=mysql_fetch_array($state))
	{
		echo '<option value="'.$row['state'].'">'.$row['state'].'</option>';
	}
}
?>