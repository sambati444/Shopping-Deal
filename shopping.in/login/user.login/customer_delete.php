<?php
include '../connect.php';
if(isset($_GET['id']))
{
	$customerid=mysql_real_escape_string($_GET['id']);
	$customerinfo=mysql_query("SELECT * FROM customer_master WHERE id='$customerid'")or die(mysql_error());
	if(mysql_num_rows($customerinfo)>=1)
	{
		$query=mysql_query("UPDATE customer_master SET deleted='1' WHERE id='$customerid'")or die(mysql_error());
		header("location:customerinfo.php?msg=Customer deleted successfully");
	}
	else
	{
		header("location:customerinfo.php?msg=Customer not found");
	}
}
else if(isset($_POST['AllAction']))
{
	$selection=$_POST['selection'];
	$countelement=count($selection);
	for($i=0;$i<$countelement;$i++)
	{
		$customerid=$selection[$i];
		$query=mysql_query("UPDATE customer_master SET deleted='1' WHERE id='$customerid'")or die(mysql_error());
	}
	header("location:customerinfo.php?msg=Customer deleted successfully");
}
else
{
	header("location:customerinfo.php?msg=Customer not found");
}
?>