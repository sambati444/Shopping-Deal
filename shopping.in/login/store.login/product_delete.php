<?php
include '../connect.php';
$customerid=mysql_real_escape_string($_GET['id']);
$customerinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$customerid'")or die(mysql_error());
if(mysql_num_rows($customerinfo)>=1)
{
	$customerinfo=mysql_fetch_array($customerinfo);
	$query=mysql_query("UPDATE manage_product_master SET deleted='1' WHERE id='$customerid'")or die(mysql_error());
	header("location:product_view.php?msg=product deleted");
}
else
{
	header("location:product_view.php?msg=product not found");
}
?>