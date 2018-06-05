<?php
include '../connect.php';
$customerid=mysql_real_escape_string($_GET['id']);
$customerinfo=mysql_query("SELECT * FROM store_master WHERE id='$customerid'")or die(mysql_error());
if(mysql_num_rows($customerinfo)>=1)
{
	$query=mysql_query("UPDATE store_master SET deleted='1' WHERE id='$customerid'")or die(mysql_error());
	header("location:a_store.php?msg=deleted");
}
else
{
	header("location:a_store.php?msg=Store not found");
}
?>