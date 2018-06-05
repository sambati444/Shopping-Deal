<?php
session_start();
include '../../login/connect.php';
if(isset($_GET['productid']))
{
	$productid=mysql_real_escape_string($_GET['productid']);
	if(isset($_SESSION['compare']))
	{
		if(!in_array($productid,$_SESSION['compare']))
		{
			$items=count($_SESSION['compare']);
			if($items>=3)
			{
				echo $items;
			}
			else
			{
				$_SESSION['compare'][$items]=$productid;
				echo count($_SESSION['compare']);
			}
		}
	}
	else
	{
		$_SESSION['compare'][0]=$productid;
	}
}
else
{
	if(isset($_SESSION['compare']))
	echo count($_SESSION['compare']);
	else
	echo 0;
}
?>