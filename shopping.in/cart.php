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
	header("location:category.php");
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
	function updateQuantity(id,value)
	{
		var xmlhttp,xmlhttp2;
		document.getElementById('loaderAjax').style.display="block";
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			xmlhttp2=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
		}	
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("itemTable").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","web_require/web_ajax/ajax_updateqty.php?id="+id+"&qty="+value, true);
		xmlhttp.send();
		xmlhttp2.onreadystatechange = function()
		{
			if(xmlhttp2.readyState == 4 && xmlhttp2.status == 200)
			{
				document.getElementById("refreshCartUL").innerHTML = xmlhttp2.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp2.open("GET","web_require/web_ajax/ajax_refreshcart.php", true);
		xmlhttp2.send();
	}
	function removeFromSession(id)
	{
		var xmlhttp,xmlhttp2;
		document.getElementById('loaderAjax').style.display="block";
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			xmlhttp2=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
		}	
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("itemTable").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","web_require/web_ajax/ajax_removeitem.php?id="+id, true);
		xmlhttp.send();
		xmlhttp2.onreadystatechange = function()
		{
			if(xmlhttp2.readyState == 4 && xmlhttp2.status == 200)
			{
				document.getElementById("refreshCartUL").innerHTML = xmlhttp2.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp2.open("GET","web_require/web_ajax/ajax_refreshcart.php", true);
		xmlhttp2.send();
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
					<li>Cart</li>
				</ul>
			</div>
			<div class="main-page">
				<h1 class="page-title">Shopping Cart Summary</h1>
				<div class="page-content page-order">
		            <ul class="step">
		                <li class="current-step"><span>01. Summary</span></li>
						<li>&nbsp;</li>
		                <li><span>02. Sign in</span></li>
						<li><span>&nbsp;</span></li>
		                <li><span>03. Shipping Address</span></li>
		            </ul>
		            <div class="heading-counter warning">
						Your shopping cart
		            </div>
		            <div class="order-detail-content">
		                <table class="cart_summary" id="itemTable">
		                    <thead>
		                        <tr>
		                            <th class="cart_product">Product</th>
		                            <th>Description</th>
		                            <th>Avail.</th>
		                            <th>Unit price</th>
		                            <th>Qty</th>
		                            <th>Total</th>
		                            <th class="action"><i class="fa fa-trash-o"></i></th>
		                        </tr>
		                    </thead>
		                    <tbody>
							<?php
							$totalamount=0;
							$maxitems=count($_SESSION['item']['id']);
							for($i=0;$i<$maxitems;$i++)
							{
								$pid=$_SESSION['item']['id'][$i];
								$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$pid' AND status='1' AND deleted='0'")or die(mysql_error());
								if(mysql_num_rows($productinfo)>=1)
								{
									$productinfo=mysql_fetch_array($productinfo);
									/*CALCULATION OF AVAILABILITY*/
									$totalpurchase=0;
									$totalsale=0;
										/*PURCHASE*/
									$purchase=mysql_query("SELECT quantity FROM purchase_record WHERE product_id='$productinfo[id]'")or die(mysql_error());
									if(mysql_num_rows($purchase)>=1)
									{
										while($purchaserow=mysql_fetch_array($purchase))
										{
											$totalpurchase=$totalpurchase+$purchaserow['quantity'];
										}
									}
										/*SALE*/
									$sale=mysql_query("SELECT * FROM sale_order_products WHERE product_id='$productinfo[id]' AND status='DISPATCH'")or die(mysql_error());
									if(mysql_num_rows($sale)>=1)
									{
										while($salerow=mysql_fetch_array($sale))
										{
											$billrecord=mysql_query("SELECT invoice_no FROM sale_order WHERE order_no='$salerow[order_id]' AND invoice_no!=''")or die(mysql_error());
											if(mysql_num_rows($billrecord)>=1)
											{
												$totalsale=$totalsale+$salerow['quantity'];
											}
										}
									}
									$availability=$totalpurchase-$totalsale;
									/*END OF CALCULATION OF AVAILABILITY*/
									echo '<tr>
										<td class="cart_product">
											<a href="#"><img class="img-responsive" src="login/product/'.$productinfo['imgpath1'].'" alt="Product"></a>
										</td>
										<td class="cart_description">
											<p class="product-name"><a href="#">'.$productinfo['product_name'].'</a></p>
										</td>';
										if($availability<=0)
										echo '<td class="cart_avail"><span class="label label-danger">Out of stock</span></td>';
										else
										echo '<td class="cart_avail"><span class="label label-success">In stock</span></td>';
										echo '<td class="price" style="text-align:center;">Rs.'.($productinfo['sale_price']+(($productinfo['sale_price']*$productinfo['tax'])/100)).'</td>
										<td class="qty">
											<input class="form-control input-sm" type="text" value="'.$_SESSION['item']['qty'][$i].'" id="'.$i.'" onkeyup="updateQuantity(this.id,this.value)">
										</td>';
										$price=((($productinfo['sale_price']*$_SESSION['item']['qty'][$i])*$productinfo['tax'])/100)+($productinfo['sale_price']*$_SESSION['item']['qty'][$i]);
										echo '<td class="price">
											<span>Rs.'.$price.'</span>
										</td>
										<td class="action">
											<a href="javascript:removeFromSession('.$i.')">Delete item</a>
										</td>
									</tr>';
									$totalamount=$totalamount+$price;
								}
							}
		                     echo '</tbody>
		                    <tfoot>
		                        <tr>
		                            <td colspan="2" rowspan="2"></td>
		                            <td colspan="3"><strong>Total (Inc.All Taxes)</strong></td>
		                            <td colspan="2"><strong>Rs.'.$totalamount.'</strong></td>
		                        </tr>
		                    </tfoot>';
							?>
		                </table>
		                <div class="cart_navigation">
		                    <a class="button" href="category.php?category=1"><i class="fa fa-angle-left"></i> Continue shopping </a>
		                    <a class="button pull-right" href="step2.php">Continue <i class="fa fa-angle-right"></i></a>
		                </div>
		            </div>
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