<?php
include '../connect.php';
$customerid=mysql_real_escape_string($_GET['id']);
$customerinfo=mysql_query("SELECT * FROM store_master WHERE id='$customerid'")or die(mysql_error());
if(mysql_num_rows($customerinfo)>=1)
{
	$customerinfo=mysql_fetch_array($customerinfo);
	if($customerinfo['status']==0)
	$query=mysql_query("UPDATE store_master SET status='1' WHERE id='$customerid'")or die(mysql_error());
	else
	$query=mysql_query("UPDATE store_master SET status='0' WHERE id='$customerid'")or die(mysql_error());
	header("location:a_store.php?msg=status changed");
}
else
{
	header("location:a_store.php?msg=Store not found");
}
?>