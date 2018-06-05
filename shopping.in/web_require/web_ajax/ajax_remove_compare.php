<?php
session_start();
$sessionid=mysql_real_escape_string($_GET['sessionid']);
array_splice($_SESSION['compare'],$sessionid,1);
?>