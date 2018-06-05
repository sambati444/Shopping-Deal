<?php
include '../../connect.php';
$categoryid=mysql_real_escape_string($_GET['categoryid']);
$state=mysql_query("SELECT * FROM manage_subcategory WHERE category_id='$categoryid' ORDER BY name")or die(mysql_error());
if(mysql_num_rows($state)>=1)
{
	echo '<option value="">Select</option>';
	while($row=mysql_fetch_array($state))
	{
		$categoryname=mysql_query("SELECT name FROM manage_category WHERE id='$categoryid'");
		$categoryname=mysql_result($categoryname,0,"name");
		echo '<option value="'.$row['id'].'">'.$categoryname.'/'.$row['name'].'</option>';
	}
}
?>