<?php
session_start();
include '../../login/connect.php';
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
	$myid=$_SESSION['user']['id'];
	$insertion=mysql_query("UPDATE customer_master SET fname='$fname',lname='$lname',mobileno='$mobileno',landlineno='$landlineno',faxno='$faxno',residential_address='$address',city='$city',state='$state',pincode='$pincode',country='$country' WHERE id='$myid'")or die(mysql_error().'insertion');
	$_SESSION['user']['name']=$fname.' '.$lname;
	echo '1';
}
else
{	
	
	echo 'Error Occured';
}
?>