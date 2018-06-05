<?php
session_start();
include 'login/connect.php';
$companytitle=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
if(mysql_num_rows($companytitle)>=1)
{
	$companytitle=mysql_fetch_array($companytitle);
}
if(!isset($_SESSION['item']))
{
	header("location:index.php");
}
else if(0>=count($_SESSION['item']['id']))
{
	header("location:index.php?success");
}
if(!isset($_SESSION['user']))
{
	header("location:step2.php");
}
$userid=$_SESSION['user']['id'];
$userinfo=mysql_query("SELECT * FROM customer_master WHERE id='$userid'")or die(mysql_error());
if(mysql_num_rows($userinfo)>=1)
{
	$userinfo=mysql_fetch_array($userinfo);
}
else
{
	header("location:cart.php");
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
	<script>
	function selectState(myvalue)
	{
		var xmlhttp;
		document.getElementById('loaderAjax').style.display="block";
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}	
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("state").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","web_require/web_ajax/ajax_state.php?country="+myvalue, true);
		xmlhttp.send();
	}
	function selectCity(myvalue)
	{
		var xmlhttp;
		document.getElementById('loaderAjax').style.display="block";
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}	
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("city").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","web_require/web_ajax/ajax_district.php?state="+myvalue, true);
		xmlhttp.send();
	}
	</script>
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
					<li>Shipping Information</li>
				</ul>
			</div>
			<div class="main-page">
				<h1 class="page-title">Shipping Information</h1>
				<div class="page-content page-order">
		            <ul class="step">
		                <li><span>01. Summary</span></li>
						<li>&nbsp;</li>
		                <li><span>02. Sign in</span></li>
						<li><span>&nbsp;</span></li>
		                <li class="current-step"><span>03. Shipping Address</span></li>
		            </ul>
		            <div class="heading-counter warning">
						Shipping Address
		            </div>
		            <div class="order-detail-content">
		                <div class="row">
							<div class="col-sm-12">
								<form action="thankyou.php" method="post">
									<div class="box-border">
										<h4>Shipping Information</h4>
										
										<div class="row">
											<div class="col-md-6">
												<label>First Name</label>
												<input type="text" name="fname" value="<?php echo $userinfo['fname'];?>" autofocus required/>
											</div>
											<div class="col-md-6">
												<label>Last Name</label>
												<input type="text" name="lname" value="<?php echo $userinfo['lname'];?>" autofocus required/>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>Company Name</label>
												<input type="text" name="company">
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>Address</label>
												<textarea name="address" maxlength="138" autofocus required/><?php echo $userinfo['residential_address'];?></textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>Country</label>
												<select name="country" id="country" onchange="selectState(this.value)" autofocus required/>
													<option value="">--Select--</option>
													<?php
														$country=mysql_query("SELECT DISTINCT(country) FROM pre_area")or die(mysql_error());
														if(mysql_num_rows($country)>=1)
														{
															while($row=mysql_fetch_array($country))
															{
																if($row['country']==$userinfo['country'])
																echo '<option value="'.$row['country'].'" selected/>'.$row['country'].'</option>';
																else
																echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
															}
														}
													?>
												</select>
											</div>
											<div class="col-md-6">
												<label>State</label>
												<select name="state" id="state" onchange="selectCity(this.value)" autofocus required/>
													<option value="<?php echo $userinfo['state'];?>"><?php echo $userinfo['state'];?></option>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>City</label>
												<select name="city" id="city" autofocus required/>
													<option value="<?php echo $userinfo['city'];?>"><?php echo $userinfo['city'];?></option>
												</select>
											</div>
											<div class="col-md-6">
												<label>Pincode</label>
												<input type="number" name="pincode" id="pincode" value="<?php echo $userinfo['pincode'];?>" autofocus required/>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>Payment Method</label>
												<select name="paymentmethod" id="paymentmethod" autofocus required/>
													<option value="">--Select--</option>
													<option value="Cash On Delivery">Cash On Delivery</option>
													<option value="Debit Card">Debit Card</option>
													<option value="Credit Card">Credit Card</option>
													<option value="Internet Banking">Internet Banking</option>
												</select>
											</div>
											<div class="col-md-6">
												<label>Comment</label>
												<textarea name="comment" id="comment"></textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<button class="button" type="submit" name="orderSubmission"><i class="fa fa-lock"></i>Continue</button>
											</div>
										</div>
									</div>
								</form>
							</div>
			            </div>
		            </div>
		        </div>
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