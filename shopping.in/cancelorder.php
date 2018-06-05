<?php
session_start();
include 'login/connect.php';
if(!isset($_SESSION['user']))
{
	header("location:index.php?session expired");
}
if(isset($_GET['orderno'])&&isset($_GET['id']))
{
	$orderno=mysql_real_escape_string($_GET['orderno']);
	$id=mysql_real_escape_string($_GET['id']);
	$query=mysql_query("UPDATE sale_order_products SET status='CANCEL' WHERE id='$id'")or die(mysql_error());
	header("location:orderdetail.php?orderno=".$orderno);
}
else
{
	header("location:myaccount.php?msg=Order not found");
}
?>