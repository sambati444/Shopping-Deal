<?php
session_start();
include 'login/connect.php';
$companytitle=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
if(mysql_num_rows($companytitle)>=1)
{
	$companytitle=mysql_fetch_array($companytitle);
}
if(!isset($_SESSION['compare']))
{
	header("location:index.php");
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
		function removeFromCompare(id)
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
					window.location="compare.php";
					document.getElementById('loaderAjax').style.display="none";
				}
			}
			xmlhttp.open("GET","web_require/web_ajax/ajax_remove_compare.php?sessionid="+id, true);
			xmlhttp.send();
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
					<li>Compare products</li>
				</ul>
			</div>
			<div class="main-page">
				<h1 class="page-title">Compare Products</h1>
				<div class="page-content">
		            <table class="table table-bordered table-compare">
		                <tbody>
						<tr>
		                    <td class="compare-label">Product Image</td>
							<?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								$productid=$_SESSION['compare'][$i];
								$productinfo=mysql_query("SELECT imgpath1 FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
								$productinfo=mysql_fetch_array($productinfo);
								echo '<td class="text-center">
									<a href="#"><img src="login/product/'.$productinfo['imgpath1'].'"></a>
								</td>';
							}
							?>
		                </tr>
		                <tr>
		                    <td class="compare-label">Product Name</td>
							<?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								$productid=$_SESSION['compare'][$i];
								$productinfo=mysql_query("SELECT product_name FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
								$productinfo=mysql_fetch_array($productinfo);
								echo '<td>
									<a href="#">'.$productinfo['product_name'].'</a>
								</td>';
							}
							?>
		                </tr>
						<tr>
		                    <td class="compare-label">Product Code</td>
							<?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								$productid=$_SESSION['compare'][$i];
								$productinfo=mysql_query("SELECT id FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
								$productinfo=mysql_fetch_array($productinfo);
								echo '<td>
									<a href="#">MYAVA1500'.$productinfo['id'].'</a>
								</td>';
							}
							?>
		                </tr>
		                <tr>
		                    <td class="compare-label">Price</td>
							<?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								$productid=$_SESSION['compare'][$i];
								$productinfo=mysql_query("SELECT sale_price,tax FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
								$productinfo=mysql_fetch_array($productinfo);
								$saleprice=$productinfo['sale_price']+(($productinfo['sale_price']*$productinfo['tax'])/100);
			                    echo '<td class="price">Rs.'.$saleprice.'/-</td>';
							}
							?>
		                </tr>
		                <tr>
		                    <td class="compare-label">Description</td>
							<?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								$productid=$_SESSION['compare'][$i];
								$productinfo=mysql_query("SELECT description FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
								$productinfo=mysql_fetch_array($productinfo);
								echo '<td>'.$productinfo['description'].'</td>';
							}
							?>
						</tr>
		                <tr>
		                    <td class="compare-label">Manufacturer</td>
							<?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								$productid=$_SESSION['compare'][$i];
								$productinfo=mysql_query("SELECT manufactured_by FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
								$productinfo=mysql_fetch_array($productinfo);
								$manufacturer=mysql_query("SELECT * FROM manage_manufacturer_master WHERE id='$productinfo[manufactured_by]'")or die(mysql_error());
								$manufacturer=mysql_fetch_array($manufacturer);
								$manufacturer=$manufacturer['name'];
								echo '<td>'.$manufacturer.'</td>';
							}
							?>
		                </tr>
						<!--
		                <tr>
		                    <td class="compare-label">Availability</td>
		                    <td class="instock">Instock (20 items)</td>
		                    <td class="outofstock">Out of stock</td>
		                    <td class="instock">Instock (20 items)</td>
		                </tr>
						-->
		                <tr>
		                    <td class="compare-label">Weight</td>
		                    <?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								$productid=$_SESSION['compare'][$i];
								$productinfo=mysql_query("SELECT weight,weight_type_id FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
								$productinfo=mysql_fetch_array($productinfo);
								$weighttype=mysql_query("SELECT * FROM manage_weight_type WHERE id='$productinfo[weight_type_id]'")or die(mysql_error());
								$weighttype=mysql_result($weighttype,0,"name");
								echo '<td>'.$productinfo['weight'].' '.$weighttype.'</td>';
							}
							?>
		                </tr>
		                <tr>
		                    <td class="compare-label">Width</td>
							<?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								$productid=$_SESSION['compare'][$i];
								$productinfo=mysql_query("SELECT width,length_type_id FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
								$productinfo=mysql_fetch_array($productinfo);
								$weighttype=mysql_query("SELECT * FROM manage_length_type WHERE id='$productinfo[length_type_id]'")or die(mysql_error());
								$weighttype=mysql_result($weighttype,0,"name");
								echo '<td>'.$productinfo['width'].' '.$weighttype.'</td>';
							}
							?>
		                </tr>
						<tr>
		                    <td class="compare-label">Height</td>
							<?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								$productid=$_SESSION['compare'][$i];
								$productinfo=mysql_query("SELECT height,length_type_id FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
								$productinfo=mysql_fetch_array($productinfo);
								$weighttype=mysql_query("SELECT * FROM manage_length_type WHERE id='$productinfo[length_type_id]'")or die(mysql_error());
								$weighttype=mysql_result($weighttype,0,"name");
								echo '<td>'.$productinfo['height'].' '.$weighttype.'</td>';
							}
							?>
		                </tr>
		                <tr>
		                    <td class="compare-label">Action</td>
							<?php
							$count=count($_SESSION['compare']);
							for($i=0;$i<$count;$i++)
							{
								echo '<td class="action">
									<button class="button button-sm" onclick="removeFromCompare('.$i.')"><i class="fa fa-close"></i></button>
								</td>';
							}
							?>
						</tr>
		            </tbody></table>
		        </div>
			</div>
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