<?php
session_start();
include '../../login/connect.php';
$friend=mysql_real_escape_string(strip_tags($_GET['friend']));
$fname=mysql_real_escape_string(strip_tags($_GET['fname']));
$lname=mysql_real_escape_string(strip_tags($_GET['lname']));
$mobileno=mysql_real_escape_string(strip_tags($_GET['mobileno']));
$emailid=mysql_real_escape_string(strip_tags($_GET['emailid']));
$username=$emailid;
$password=md5($mobileno);
$landlineno=mysql_real_escape_string(strip_tags($_GET['landlineno']));
$faxno=mysql_real_escape_string(strip_tags($_GET['faxno']));
$address=mysql_real_escape_string(strip_tags($_GET['address']));
$country=mysql_real_escape_string(strip_tags($_GET['country']));
$state=mysql_real_escape_string(strip_tags($_GET['state']));
$city=mysql_real_escape_string(strip_tags($_GET['city']));
$pincode=mysql_real_escape_string(strip_tags($_GET['pincode']));
$dateOfRegistration=date('Y-m-d H:i:s');
/*CHECK FOR EMAIL ALREADY REGISTERED OR NOT*/
$customerinfo=mysql_query("SELECT * FROM customer_master WHERE emailid='$emailid'")or die(mysql_error().'validation failed');
if(mysql_num_rows($customerinfo)>=1)
{
	echo 'E-mail ID is already registered';
}
else
{
	if(!empty($friend))
	{
		$friendinfo=mysql_query("SELECT * FROM customer_master WHERE reference_code='$friend'")or die(mysql_error());
		if(mysql_num_rows($friendinfo)>=1)
		{
			$customerid=mysql_query("SELECT MAX(id) FROM customer_master")or die(mysql_error().'customer id');
			$customerid=mysql_fetch_array($customerid);
			$customerid=$customerid[0]+1;
			$referencecode=date('y').str_pad($customerid,5,0,STR_PAD_LEFT).'C'.date('m');
			$insertion=mysql_query("INSERT INTO customer_master VALUES('$customerid','$referencecode','$friend','$fname','$lname','$username','$password','$emailid','$mobileno','$landlineno','$faxno','$address','$city','$state','$pincode','$country','$dateOfRegistration','1','0')")or die(mysql_error().'insertion');
			$_SESSION['user']['id']=$customerid;
			$_SESSION['user']['refcode']=$referencecode;
			$_SESSION['user']['name']=$fname.' '.$lname;
			echo '1';
		}
		else
		{
			echo 'Wrong Friend\'s Reference Code';
		}
	}
	else
	{
		$customerid=mysql_query("SELECT MAX(id) FROM customer_master")or die(mysql_error().'customer id');
		$customerid=mysql_fetch_array($customerid);
		$customerid=$customerid[0]+1;
		$referencecode=date('y').str_pad($customerid,5,0,STR_PAD_LEFT).'C'.date('m');
		$insertion=mysql_query("INSERT INTO customer_master VALUES('$customerid','$referencecode','$friend','$fname','$lname','$username','$password','$emailid','$mobileno','$landlineno','$faxno','$address','$city','$state','$pincode','$country','$dateOfRegistration','1','0')")or die(mysql_error().'insertion');
		$_SESSION['user']['id']=$customerid;
		$_SESSION['user']['refcode']=$referencecode;
		$_SESSION['user']['name']=$fname.' '.$lname;
		echo '1';
	}
}
?>