<?php
session_start();
ini_set("max_execution_time","180");//SET MAXIMUM EXECUTION TIME 3 MINUTES
include 'login/connect.php';
$companytitle=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
if(mysql_num_rows($companytitle)>=1)
{
	$companytitle=mysql_fetch_array($companytitle);
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
		function compareProduct(myvalue)
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
					if(xmlhttp.responseText==3)
					{
						window.location="compare.php";
					}
					document.getElementById('loaderAjax').style.display="none";
				}
			}
			xmlhttp.open("GET","web_require/web_ajax/ajax_compare.php?productid="+myvalue, true);
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
	<div class="row">
		<!-------SLIDER------->
			<?php
				/*DYNAMIC Cascading Stylesheet*/
				$banner=mysql_query("SELECT * FROM ais_indexbanner ORDER BY rand()")or die(mysql_error());
				if(mysql_num_rows($banner)>=1)
				{
					$banner=mysql_fetch_array($banner);
					echo '<style>
					.banner{
					background: url(login/setting/images/indexbanner/'.$banner['indexbanner'].') no-repeat  center fixed;
					background-size: cover;
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					-ms-background-size: cover;
					min-height:320px;
					text-align:center;
					}
					</style>';
				}
				else
				{
					echo '<style>
					.banner{
					background: url(login/setting/images/indexbanner/default.jpg) no-repeat  center fixed;
					background-size: cover;
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					-ms-background-size: cover;
					min-height:320px;
					text-align:center;
					}
					</style>';
				}
				/*END OF CSS FOR SHOPPINGDEAL.IN*/
			?>
			<div class="banner">
			</div>
		<!----END OF SLIDER--->
	</div>
	<div class="container">
		<?php
			$catedata=mysql_query("SELECT * FROM manage_category WHERE deleted='0'")or die(mysql_error());
			if(mysql_num_rows($catedata)>=1)
			{
				while($caterow=mysql_fetch_array($catedata))
				{
					$provalidate=mysql_query("SELECT * FROM manage_product_master WHERE category_id='$caterow[id]' AND status='1' AND deleted='0' ORDER BY id DESC")or die(mysql_error());
					if(mysql_num_rows($provalidate)>=1)
					{
						echo '<div class="row">
							<div class="col-sm-12 col-md-12">
							<!-- new-arrivals -->
								<div class="block3 block-new-arrivals">
												<div class="block-head">
													<h3 class="block-title">'.$caterow['name'].'</h3>
													<ul class="nav-tab default">
									</ul>
												</div>
												<div class="block-inner">
													<div class="tab-container">';
													echo '<div id="tab-1" class="tab-panel active">';
													echo '<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive=\'{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4}}\'>';
														$product=mysql_query("SELECT * FROM manage_product_master WHERE category_id='$caterow[id]' AND status='1' AND deleted='0' ORDER BY id DESC")or die(mysql_error());
														if(mysql_num_rows($product)>=1)
														{
															$maxrow=mysql_num_rows($product);
															if($maxrow>6)
															{
																$maxrow=6;
															}
															for($i=0;$i<$maxrow;$i++)
															{
																echo '<li class="product">
																	<div class="product-container">
																		<div class="product-left">
																			<div class="product-thumb">
																				<a class="product-img" href="product_details.php?id='.mysql_result($product,$i,"id").'"><img src="login/product/'.mysql_result($product,$i,'imgpath1').'"></a>
																				<a title="Quick View" href="product_details.php?id='.mysql_result($product,$i,"id").'" class="btn-quick-view">Quick View</a>
																			</div>
																		</div>
																		<div class="product-right">
																			<div class="product-name">
																				<a href="product_details.php?id='.mysql_result($product,$i,"id").'">'.mysql_result($product,$i,'product_name').'</a>
																			</div>
																			<div class="price-box">
																				<span class="product-price">Rs.'.round(mysql_result($product,$i,'sale_price')+((mysql_result($product,$i,'sale_price')*mysql_result($product,$i,'tax'))/100)).'</span>';
																				if(mysql_result($product,$i,'old_sale_price')>0)
																				{
																					echo '<span class="product-price-old">Rs.'.mysql_result($product,$i,'old_sale_price').'</span>';
																				}
																			echo '</div>
																			<div class="product-button">
																				<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.mysql_result($product,$i,"id").')">Add Compare</a>
																				<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.mysql_result($product,$i,"id").'">Buy<span class="icon"></span></a>
																			</div>
																		</div>
																	</div>
																</li>';
															}
														echo '</ul>';
														}
													echo '</div>';
												echo '</div>
											</div>
								</div>
							<!-- end-of-new-arrivals -->
							</div>
						</div>';
					}
				}
			}
		?>
	</div>
	<div class="container">
		<div class="row">
			<!-- banner -->
			
            <!-- ./banner -->
            <!-- ./popular cat -->
			<div class="col-sm-8 col-md-12 col-lg-2">
           
				<div style="margin-top:10px;" class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":4},"768":{"items":2},"1000":{"items":4},"1200":{"items":4}}'>					
					<?php
					$popularcate=mysql_query("SELECT * FROM ais_popular_cate")or die(mysql_error());
					if(mysql_num_rows($popularcate)>=1)
					{
						while($popurow=mysql_fetch_array($popularcate))
						{
							echo '<div class="page-banner">
									<ul class="list-banner">
										<li><a href="#"><img style="height:120px;" src="login/popular_category/'.$popurow['image'].'"></a></li>
									</ul>
									
								</div>';
								
						}
					}
					?>
				</div>
			</div>
			<!----POPULAR CATEGORY--->
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
						Copyright &copy; <?php echo date('Y').' '.$companytitle['company_name'];?>. All Rights Reserved.
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