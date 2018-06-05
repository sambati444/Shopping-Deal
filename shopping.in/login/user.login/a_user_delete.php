<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
include '../connect.php';
/*LOGIN VALIDATION*/
if($_SESSION['myusername']=='')
{
	header("location:../index.php?msg=Session expired");
}
if($_SESSION['permission_administrator']==0)
{
	header("location:home.php?prohibited");
}
$userid=mysql_real_escape_string(strip_tags($_GET['id']));
$userinfo=mysql_query("SELECT * FROM ais_users WHERE id='$userid'")or die(mysql_error());
if(mysql_num_rows($userinfo)>=1)
{
	$userinfo=mysql_fetch_array($userinfo);
	$updation=mysql_query("UPDATE ais_users SET deleted='1' WHERE id='$userid'")or die(mysql_error());
	header("location:a_user_view.php?msg=User deleted successfully");
}
else
{
	header("location:a_user_view.php?error");
}
?>