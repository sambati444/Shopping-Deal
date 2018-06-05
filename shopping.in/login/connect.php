<?php
date_default_timezone_set("Asia/Kolkata");
/*DATABASE CONNECTION*/
mysql_connect("localhost","root","")or die("Can't connect with database server.");
mysql_select_db("shoppingdeal")or die("Can't select Database.");
$conn=mysql_connect("localhost","root","")or die("Can't connect with database server.");
?>