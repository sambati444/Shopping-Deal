<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
if($_SESSION['myusername']=='')
{
	header("location:../");
}
header("location:home.php");
?>