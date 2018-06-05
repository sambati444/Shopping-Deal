<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
include '../connect.php';
$orderno=mysql_real_escape_string($_GET['orderno']);
$id=mysql_real_escape_string($_GET['id']);
$status=mysql_real_escape_string(strip_tags($_GET['status']));
$query=mysql_query("UPDATE sale_order_products SET status='$status' WHERE order_id='$orderno' AND id='$id'")or die(mysql_error());
header("location:sale_order_detail.php?orderno=".$orderno)
?>