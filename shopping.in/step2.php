<?php
session_start();
include 'login/connect.php';
$companytitle=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
if(mysql_num_rows($companytitle)>=1)
{
	$companytitle=mysql_fetch_array($companytitle);
}
if(isset($_SESSION['user']['name']))
{
	header("location:step3.php");
}
if(!isset($_SESSION['item']))
{
	header("location:index.php?");
}
if(isset($_POST['signin']))
{
	$username=mysql_real_escape_string($_POST['username']);
	$password=md5(mysql_real_escape_string($_POST['password']));
	$login=mysql_query("SELECT * FROM customer_master WHERE username='$username' OR reference_code='$username' AND password='$password' AND deleted='0'")or die(mysql_error());
	if(mysql_num_rows($login)>=1)
	{
		$login=mysql_fetch_array($login);
		if($login['status']==0)
		{
			header("location:step2.php?msg=Inactive account");
		}
		else
		{
			$_SESSION['user']['id']=$login['id'];
			$_SESSION['user']['refcode']=$login['reference_code'];
			$_SESSION['user']['name']=$login['fname'].' '.$login['lname'];
			header("location:step3.php?msg=Success");
		}
	}
	else
	{
		header("location:step2.php?msg=Wrong username or password");
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
	<style>
	.fa-close{color:#FF0000;font-size:10px;}
	</style>
	<?php include 'web_require/step2_javascript.php';?>
</head>
<body class="option3" onload="onLoad()">
	<input type="hidden" value="0" id="trigger">
	<!--LOADER AJAX-->
	<script>
		function onLoad()
		{
			document.getElementById("fnameError").style.display="none";
			document.getElementById("lnameError").style.display="none";
			document.getElementById("mobilenoError").style.display="none";
			document.getElementById("emailidError").style.display="none";
			document.getElementById("landlinenoError").style.display="none";
			document.getElementById("faxnoError").style.display="none";
			document.getElementById("addressError").style.display="none";
			document.getElementById("countryError").style.display="none";
			document.getElementById("stateError").style.display="none";
			document.getElementById("cityError").style.display="none";
			document.getElementById("pincodeError").style.display="none";
			document.getElementById("msgOnError").style.display="none";
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
					<li>Sign In/ Sign Up</li>
				</ul>
			</div>
			<div class="main-page">
				<h1 class="page-title">Sign In/ Sign Up</h1>
				<div class="page-content page-order">
		            <ul class="step">
		                <li><span>01. Summary</span></li>
						<li>&nbsp;</li>
		                <li class="current-step"><span>02. Sign in</span></li>
						<li><span>&nbsp;</span></li>
		                <li><span>03. Shipping Address</span></li>
		            </ul>
		            <div class="heading-counter warning" id="msgOnError" style="color:#FF0000;">Error Occured!!!<!--MSG FOR ERROR--></div>
		            <div class="order-detail-content">
		                <div class="row">
							<div class="col-sm-6">
								<div class="box-border">
									<h4>Create an account</h4>
									<small>Please enter your email address to create an account.</small>
										<div class="row">
											<div class="col-md-12">
												<label>Friend Reference Code</label>
												<input type="text" name="friend" id="friend">
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>First Name</label>
												<input type="text" name="fname" id="fname" onkeyup="fname(this.value)"/>
												<i class="fa fa-close" id="fnameError"></i>
											</div>
											<div class="col-md-6">
												<label>Last Name</label>
												<input type="text" name="lname" id="lname" onkeyup="lname(this.value)"/>
												<i class="fa fa-close" id="lnameError"></i>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>Mobile No.</label>
												<input type="text" name="mobileno" id="mobileno" maxlength="10" onkeyup="mobileno(this.value)"/>
												<i class="fa fa-close" id="mobilenoError"></i>
											</div>
											<div class="col-md-6">
												<label>E-Mail ID</label>
												<input type="text" name="emailid" id="emailid" onkeyup="emailid(this.value)"/>
												<i class="fa fa-close" id="emailidError"></i>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>Landline No.</label>
												<input type="text" name="landlineno" id="landlineno" onkeyup="landlineno(this.value)">
												<i class="fa fa-close" id="landlinenoError"></i>
											</div>
											<div class="col-md-6">
												<label>Fax No.</label>
												<input type="text" name="faxno" id="faxno" onkeyup="faxno(this.value)">
												<i class="fa fa-close" id="faxnoError"></i>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>Address</label>
												<textarea name="address" id="address" onkeyup="address(this.value)"/></textarea>
												<i class="fa fa-close" id="addressError"></i>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>Country</label>
												<select name="country" id="country" onchange="selectState(this.value),country(this.value)" />
													<option value="">--Select--</option>
													<?php
														$country=mysql_query("SELECT DISTINCT(country) FROM pre_area")or die(mysql_error());
														if(mysql_num_rows($country)>=1)
														{
															while($row=mysql_fetch_array($country))
															{
																echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
															}
														}
													?>
												</select>
												<i class="fa fa-close" id="countryError"></i>
											</div>
											<div class="col-md-6">
												<label>State</label>
												<select name="state" id="state" onchange="selectCity(this.value),state(this.value)" />
													<option value="">--Select--</option>
												</select>
												<i class="fa fa-close" id="stateError"></i>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>City</label>
												<select name="city" id="city" onchange="city(this.value)"/>
													<option value="">--Select--</option>
												</select>
												<i class="fa fa-close" id="cityError"></i>
											</div>
											<div class="col-md-6">
												<label>Pincode</label>
												<input type="text" name="pincode" id="pincode" onkeyup="pincode(this.value)"/>
												<i class="fa fa-close" id="pincodeError"></i>
											</div>
										</div>
										<hr/>
										<div class="row">
											<div class="col-md-12">
												<button class="button" onclick="return formSubmission()" name="signup" id=="signup"><i class="fa fa-user"></i> Create an accout</button>
											</div>
										</div>
								</div>
							</div>
							<div class="col-sm-6">
								<form action="" method="post">
									<div class="box-border">
										<h4>Already registered?</h4>
										<?php
											if(isset($_GET['msg']))
											{
												echo '<font color="red">'.$_GET['msg'].'</font>';
											}
										?>
										<p>
											<label>Email address</label>
											<input type="text" name="username" />
										</p>
										<p>
											<label>Password</label>
											<input type="password" name="password" />
										</p>
										<p>
											<a href="#">Forgot your password?</a>
										</p>
										<p>
											<button class="button" type="submit" name="signin"><i class="fa fa-lock"></i> Sign in</button>
										</p>
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