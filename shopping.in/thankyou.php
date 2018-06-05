<?php
session_start();
include 'login/connect.php';
$companytitle=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
if(mysql_num_rows($companytitle)>=1)
{
	$companytitle=mysql_fetch_array($companytitle);
}
if(isset($_POST['orderSubmission']))
{
	if(!isset($_SESSION['item']))
	{
		header("location:index.php");
	}
	if(!isset($_SESSION['user']))
	{
		header("location:step2.php");
	}
	$orderno=date('ymdHis').$_SESSION['user']['id'];
	$orderdate=date('Y-m-d H:i:s');
	$customerid=$_SESSION['user']['id'];
	$fname=mysql_real_escape_string(strip_tags($_POST['fname']));
	$lname=mysql_real_escape_string(strip_tags($_POST['lname']));
	$company=mysql_real_escape_string(strip_tags($_POST['company']));
	$address=mysql_real_escape_string(strip_tags($_POST['address']));
	$country=mysql_real_escape_string(strip_tags($_POST['country']));
	$state=mysql_real_escape_string(strip_tags($_POST['state']));
	$city=mysql_real_escape_string(strip_tags($_POST['city']));
	$pincode=mysql_real_escape_string(strip_tags($_POST['pincode']));
	$paymentmethod=mysql_real_escape_string(strip_tags($_POST['paymentmethod']));
	$comment=mysql_real_escape_string(strip_tags($_POST['comment']));
	$totalamount=0;
	$maxitems=count($_SESSION['item']['id']);
	for($i=0;$i<$maxitems;$i++)
	{
		$productid=$_SESSION['item']['id'][$i];
		$quantity=$_SESSION['item']['qty'][$i];
		$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$productid'")or die(mysql_error().'fetch product');
		$productinfo=mysql_fetch_array($productinfo);
		$totalprice=$quantity*($productinfo['sale_price']+$productinfo['shipping_price']);
		$totalamount=$totalamount+$totalprice;
	}
	$validation=mysql_query("SELECT * FROM customer_master WHERE id='$customerid'")or die(mysql_error());
	if(mysql_num_rows($validation)>=1)
	{
		$customerinfo=mysql_fetch_array($validation);
		$productid=$_SESSION['item']['id'][0];
		$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$productid'")or die(mysql_error().'fetch product');
		$productinfo=mysql_fetch_array($productinfo);
		$query=mysql_query("INSERT INTO sale_order VALUES('','$productinfo[store_id]','$orderno','$orderdate','','','$customerid','$fname','$lname','$company','$address','$city','$pincode','$state','$country','$paymentmethod','$comment','$totalamount')")or die(mysql_error().'insert order');
		$maxitems=count($_SESSION['item']['id']);
		for($i=0;$i<$maxitems;$i++)
		{
			$productid=$_SESSION['item']['id'][$i];
			$quantity=$_SESSION['item']['qty'][$i];
			$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$productid'")or die(mysql_error().'fetch product');
			$productinfo=mysql_fetch_array($productinfo);
			$price=($productinfo['sale_price']+(($productinfo['sale_price']*$productinfo['tax'])/100));
			$totalprice=($price+$productinfo['shipping_price'])*$quantity;
			$query=mysql_query("INSERT INTO sale_order_products VALUES('','$orderno','$productinfo[id]','$productinfo[product_name]','$price','$totalprice','$productinfo[tax]','$quantity','NEW')")or die(mysql_error().'insert order products');
		}
		unset($_SESSION['item']);
		/*========== E-MAIL ===========*/
		$emailmsg=0;
		$to =$customerinfo['emailid'];
		$subject = "Order Confirmation by ".$companytitle['company_name'];
		$orderinfo=mysql_query("SELECT * FROM sale_order WHERE order_no='$orderno'")or die(mysql_error());
		$orderinfo=mysql_fetch_array($orderinfo);
		$message1 = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<title>".$_SERVER['SERVER_NAME']."::".$orderinfo['order_no']."</title>
			</head>
			<body>
			<table width='100%' align='center' cellpadding='0' cellspacing='0'>
			  <tbody>
				<tr>
				  <td align='left' valign='top' bgcolor='#F9F9F9'><p><strong>Hi Customer,</strong><br />
					</p>
					<p>Thank you for your order!<br />
					</p>
					<p>We will send you another email once the items in your order have been shipped. Meanwhile, you can check the status of your order on<a alt='".$companytitle['company_name']."' href='".$_SERVER['SERVER_NAME']."' target='_blank'>&nbsp;".$companytitle['company_name']."</a><br />
					</p>
					<p align='center'><a align='center' href='".$_SERVER['SERVER_NAME']."/login.php' target='_blank'>TRACK ORDER</a></p></td>
				</tr>
			  </tbody>
			</table>
			<table width='100%' align='center' cellpadding='0' cellspacing='0'>
			  <tbody>
				<tr>
				  <td align='left' valign='top' bgcolor=''>
				  <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
					<tbody>
					  <tr>
						<td colspan='4' width='80%' align='center' valign='top'><p>Please find below, the summary of your order<a href='".$_SERVER['SERVER_NAME']."/login.php' target='_blank'>".$orderinfo['order_no']."</a><br />
						</p>
						  </td>
					  </tr>
					  <tr>
						<td colspan='4' align='left' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
						  <tbody>
							<tr>
							  <td width='83%' align='left' valign='middle'>
							  <hr/></td>
							</tr>
						  </tbody>
						</table></td>
					  </tr>
					</tbody>
				  </table></td>
				</tr>
			  </tbody>
			</table>
			<table width='100%' align='center' cellpadding='0' cellspacing='0'>
			  <tbody>
					<tr>
						<th>S.No.</th>
						<th>Product Name</th>
						<th>Seller</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Sub-Amount</th>
					</tr>";
		$sale_product=mysql_query("SELECT * FROM sale_order_products WHERE order_id='$orderinfo[order_no]'")or die(mysql_error());
		$grandtotal=0;
		$courier=0;
		if(mysql_num_rows($sale_product)>=1)
		{
			$s_no=1;
			while($saleprorow=mysql_fetch_array($sale_product))
			{
				$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$saleprorow[product_id]'")or die(mysql_error());
				$productinfo=mysql_fetch_array($productinfo);
				$total=$saleprorow['price']*$saleprorow['quantity'];
				$storename=mysql_query("SELECT storename FROM store_master WHERE id='$productinfo[store_id]'")or die(mysql_error());
				$storename=mysql_result($storename,0,"storename");
				$message2= "<tr>
							<th>".$s_no."</th>
							<th><a href='".$_SERVER['SERVER_NAME']."/product_details.php?id=".$saleprorow['product_id']."' target='_blank'>".$productinfo['product_name']."</a></th>
							<th><a href='".$_SERVER['SERVER_NAME']."/product_details.php?id=".$saleprorow['product_id']."' target='_blank'>".$storename."</a></th>
							<th><a href='".$_SERVER['SERVER_NAME']."/product_details.php?id=".$saleprorow['product_id']."' target='_blank'>".$saleprorow['price']."</a></th>
							<th><a href='".$_SERVER['SERVER_NAME']."/product_details.php?id=".$saleprorow['product_id']."' target='_blank'>".$saleprorow['quantity']."</a></th>
							<th><a href='".$_SERVER['SERVER_NAME']."/product_details.php?id=".$saleprorow['product_id']."' target='_blank'>".$total."</a></th>
			</tr>";
			$s_no=$s_no+1;
			$courier=$saleprorow['total']-($saleprorow['price']*$saleprorow['quantity']);
			$grandtotal=$grandtotal+$total;
			$message1=$message1.$message2;
		}
	}
		  $message3="</tbody>
		</table>
		<table width='100%' align='center' cellpadding='0' cellspacing='0'>
			 <tr>
				<td><p><strong>Delivery Charge Rs.".$courier."</strong></p></td>
			</tr>
			<tr>
				<td><p><strong>Total Rs.".($grandtotal+$courier)."</strong></p></td>
			</tr>
			<tr>
				<td bgcolor='#ffffff'><p>Outstanding Amount Payable on Delivery:<strong>Rs.".($grandtotal+$courier)."</strong></p></td>
			</tr>
		</table>
		<table width='100%' align='center' cellpadding='0' cellspacing='0'>
		  <tbody>
			<tr>
			  <td valign='top' align='left' bgcolor='#ffffff'><table width='100%' cellspacing='0' cellpadding='0'>
				<tbody>
				  <tr>
					<td valign='top' align='left'><p>DELIVERY ADDRESS</p>
					  <p><strong>".$orderinfo['shipping_firstname']."&nbsp;".$orderinfo['shipping_lastname']."</strong></p>
					  <p>".$orderinfo['shipping_address']."<br />
						".$orderinfo['shipping_city']."-".$orderinfo['shipping_postcode']."<br />
						".$orderinfo['shipping_state']."<br />
						".$orderinfo['shipping_country']."</p></td>
				  </tr>
				</tbody>
			  </table></td>
			</tr>
		  </tbody>
		</table>
		</body>
		</html>";
		$message=$message1.$message3;
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// More headers
		$headers .= $companytitle['email_id'] . "\r\n";
		if(mail($to,$subject,$message,$headers))
		$emailmsg=1;
		else
		$emailmsg=0;
		/*========== END OF E-MAIL ===========*/
		header("location:thankyou.php?orderno=".$orderno."&emailmsg=".$emailmsg);
	}
	else
	{
		header("location:step3.php?msg=Customer not found");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="setting/favicon.ico">
	<link rel="stylesheet" type="text/css" href="setting/assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/lib/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/global.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/option3.css" />
	<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<style>
	::-webkit-scrollbar {width:10px;background-color:#FFFFFF;} /* this targets the default scrollbar (compulsory) */
	::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);}
	::-webkit-scrollbar-thumb{background-color:#CCCCFF;outline: 1px solid slategrey;}
	</style>
	<title><?php echo $companytitle['company_name'];?></title>
</head>
<body class="option3" onload="onLoad()">
	<!--LOADER AJAX-->
	<script>
		function onLoad()
		{
			document.getElementById("loaderAjax").style.display="none";
		}
	</script>
	<div id="loaderAjax" style="background:#000;z-index:1000;opacity:0.7;position:fixed;height:100%;width:100%;display:none;">
		<img src="login/setting/images/loading-icons/loading5.gif" style="position:fixed;z-index:3000;top:45%;left:45%;">
	</div>
	<!--END OF LOADER AJAX-->
	<!-- header -->
	<?php include 'web_require/header.php';?>
	<!-- ./header -->
	<div class="container">
		<div class="row">
			<div class="block block-breadcrumbs">
				<ul>
					<li class="home">
						<a href="#"><i class="fa fa-home"></i></a>
						<span></span>
					</li>
					<li>Thank You for shopping</li>
				</ul>
			</div>
			<div class="main-page">
				<h1 class="page-title">Order No. is <?php echo $_GET['orderno'];?></h1>
			</div><!--MAIN DIV-->
		</div>

	</div>
	<!-- footer -->
	<footer id="footer">
		<div class="footer-social">
			<div class="container">
				<div class="row">
					<div class="block-social">
						<ul class="list-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
							<li><a href="#"><i class="fa fa-pied-piper"></i></a></li>
							<li><a href="#"><i class="fa fa-skype"></i></a></li>
						</ul>
					</div>
					<div class="block-payment">
						<ul class="list-logo">
							<li><a href="#"><img src="setting/data/payment1.png" alt="Payment Logo"></a></li>
							<li><a href="#"><img src="setting/data/payment2.png" alt="Payment Logo"></a></li>
							<li><a href="#"><img src="setting/data/payment3.png" alt="Payment Logo"></a></li>
							<li><a href="#"><img src="setting/data/payment4.png" alt="Payment Logo"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="block-coppyright">
						&copy;<?php echo date('Y').'&nbsp;'.$companytitle['company_name'].'.&nbsp; All Rights Reserved';?>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- ./footer -->
	<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
	<script type="text/javascript" src="setting/assets/lib/jquery/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="setting/assets/lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="setting/assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="setting/assets/lib/owl.carousel/owl.carousel.min.js"></script>
	<script type="text/javascript" src="setting/assets/lib/jquery-ui/jquery-ui.min.js"></script>
	<!-- COUNTDOWN -->
	<script type="text/javascript" src="setting/assets/lib/countdown/jquery.plugin.js"></script>
	<script type="text/javascript" src="setting/assets/lib/countdown/jquery.countdown.js"></script>
	<!-- ./COUNTDOWN -->
	<script type="text/javascript" src="setting/assets/js/jquery.actual.min.js"></script>
	<script type="text/javascript" src="setting/assets/js/script.js"></script>
</body>

</html>