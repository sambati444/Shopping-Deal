<?php
if(!isset($_GET['email']))
{
	$emailmsg=0;
	$to ='revboard@nic.in';
	$subject = "Web Enquiry";
	$message="Name:".$_POST['fullname']."<br/>Message".$_POST['message'];
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// More headers
	$headers .= 'From: '.$_POST['emailid']. "\r\n";
	if(mail($to,$subject,$message,$headers))
	$emailmsg=1;
	else
	$emailmsg=0;
	header("location:http://boardofrevenue.mp.gov.in?msg=".$emailmsg);
}
?>