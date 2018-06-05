<?php
session_start();
include 'login/connect.php';
if(isset($_POST['submission']))
{
	$productid=mysql_real_escape_string(strip_tags($_GET['productid']));
	$customerid=$_SESSION['user']['id'];
	$review=mysql_real_escape_string(strip_tags($_POST['review']));
	$productinfo=mysql_query("SELECT product_name FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
	if(mysql_num_rows($productinfo)>=1)
	{
		if(!empty($customerid))
		{
			$query=mysql_query("INSERT INTO product_review VALUES ('','$productid','$customerid','$review')")or die(mysql_error());
			header("location:product_details.php?id=".$productid);
		}
		else
		{
			header("location:product_details.php?msg=Please login again. Session is expired&id=".$productid);
		}
	}
	else
	{
		header("location:index.php?msg=product not found");
	}
}
else
{
	header("location:index.php?msg=Wrong entry");
}
?>