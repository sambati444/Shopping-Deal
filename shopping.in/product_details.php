<?php
session_start();
include 'login/connect.php';
$companytitle=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
if(mysql_num_rows($companytitle)>=1)
{
	$companytitle=mysql_fetch_array($companytitle);
}
$productid=mysql_real_escape_string($_GET['id']);
$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$productid' AND status='1' AND deleted='0'")or die(mysql_error());
if(mysql_num_rows($productinfo)>=1)
{
	$productinfo=mysql_fetch_array($productinfo);
	$seller=mysql_query("SELECT * FROM store_master WHERE id='$productinfo[store_id]'")or die(mysql_error());
	if(mysql_num_rows($seller)>=1)
	{
		$seller=mysql_result($seller,0,"storename");
	}
	else
	{
		$seller=$companytitle['company_name'];
	}
}
else
{
	header("location:category.php?category=1&msg=Product not found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $companytitle['company_name'];?></title>
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
    <link rel="stylesheet" href="setting/main.css" type="text/css">
	<style>
	::-webkit-scrollbar {width:10px;background-color:#FFFFFF;} /* this targets the default scrollbar (compulsory) */
	::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);}
	::-webkit-scrollbar-thumb{background-color:#CCCCFF;outline: 1px solid slategrey;}
	</style>
	<script type="text/javascript" src="setting/jquery-1.4.1.js"></script>
    <script type="text/javascript">
	var currentImage;
    var currentIndex = -1;
    var interval;
    function showImage(index){
        if(index < $('#bigPic img').length){
        	var indexImage = $('#bigPic img')[index]
            if(currentImage){   
            	if(currentImage != indexImage ){
                    $(currentImage).css('z-index',2);
                    clearTimeout(myTimer);
                    $(currentImage).fadeOut(250, function() {
					    myTimer = setTimeout("showNext()", 3000);
					    $(this).css({'display':'none','z-index':1})
					});
                }
            }
            $(indexImage).css({'display':'block', 'opacity':1});
            currentImage = indexImage;
            currentIndex = index;
            $('#thumbs li').removeClass('active');
            $($('#thumbs li')[index]).addClass('active');
        }
    }
    
    function showNext(){
        var len = $('#bigPic img').length;
        var next = currentIndex < (len-1) ? currentIndex + 1 : 0;
        showImage(next);
    }
    
    var myTimer;
    
    $(document).ready(function() {
	    myTimer = setTimeout("showNext()", 3000);
		showNext(); //loads first image
        $('#thumbs li').bind('click',function(e){
        	var count = $(this).attr('rel');
        	showImage(parseInt(count)-1);
        });
	});
	</script>
	<script>
	function showPrice(qty,saleprice)
	{
		document.getElementById('totalPrice').innerHTML=qty*saleprice;
	}
	</script>
	<script>
	function addSession(id,price)
	{
		var qty=document.getElementById('qty').value;
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
				document.getElementById("main-menu").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","web_require/web_ajax/ajax_addtosession.php?id="+id+"&qty="+qty+"&price="+price, true);
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
					<?php
					$categoryname=mysql_query("SELECT name FROM manage_category WHERE id='$productinfo[category_id]'")or die(mysql_error());
					$categoryname=mysql_result($categoryname,0,"name");
					$subcategoryname=mysql_query("SELECT name FROM manage_subcategory WHERE id='$productinfo[sub_category_id]'")or die(mysql_error());
					$subcategoryname=mysql_result($subcategoryname,0,"name");
					echo '<li><a href="#">'.$categoryname.'</a><span></span></li>
					<li>'.$subcategoryname.'</li>';
					?>
				</ul>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-3">
					<div class="block block-sidebar">
						<div class="block-head">
							<h5 class="widget-title">Catalog</h5>
						</div>
						<div class="block-inner">
							<div class="block-filter">
								<div class="block-sub-title">Categories</div>
								<div class="block-filter-inner">
									<ul class="check-box-list">
										<?php
												/*CATEGORIES LINK*/
												$query=mysql_query("SELECT * FROM manage_category WHERE status='1' AND deleted='0'")or die(mysql_error());
												if(mysql_num_rows($query)>=1)
												{
													while($row=mysql_fetch_array($query))
													{
														$sub=mysql_query("SELECT id,name FROM manage_subcategory WHERE category_id='$row[id]'")or die(mysql_error());
														if(mysql_num_rows($sub)>=1)
														{
															echo '<li>
																<label for="c1">
																<a href="category.php?category='.$row['id'].'" style="font-weight:bold;">'.$row['name'].'</a>';
																
																echo '<span class="count">('.mysql_num_rows($sub).')</span>
																</label>';
																/*SUB CATEGORIES*/
																while($subrow=mysql_fetch_array($sub))
																{
																	echo '<li><a href="category.php?subcategory='.$subrow['id'].'">'.$subrow['name'].'</a></li>';
																}
															echo '</li>';
														}
													}
												}
											/*END OF CATEGORIES LINK*/
											?>
	                                </ul>
								</div>
							</div>
						</div>
					</div>
					<!-- specail -->
					<div class="block block-specail3">
						<div class="block-head">
							<h4 class="widget-title">Special</h4>
						</div>
						<div class="block-inner">
							<ul class="products kt-owl-carousel" data-items="1" data-autoplay="true" data-loop="true" data-nav="true">
							<?php
								$special=mysql_query("SELECT * FROM manage_product_master WHERE special='1' AND status='1' AND deleted='0'")or die(mysql_error());
								if(mysql_num_rows($special)>=1)
								{
									$maxrow=mysql_num_rows($special);
									for($i=0;$i<$maxrow;$i++)
									{
										echo '<li class="product">
												<div class="product-container">
													<div class="product-left">
														<div class="product-thumb">
															<a class="product-img" href="product_details.php?id='.mysql_result($special,$i,'id').'"><img src="login/product/'.mysql_result($special,$i,'imgpath1').'" alt="Product"></a>
															<a title="Quick View" href="product_details.php?id='.mysql_result($special,$i,'id').'" class="btn-quick-view">Quick View</a>
														</div>
														<div class="product-status">
															<span class="new">New</span>
														</div>
													</div>
													<div class="product-right">
														<div class="product-name">
															<a href="product_details.php?id='.mysql_result($special,$i,'id').'">'.mysql_result($special,$i,'product_name').'</a>
														</div>
														<div class="price-box">
															<span class="product-price">Rs.'.round(mysql_result($special,$i,'sale_price')+((mysql_result($special,$i,'sale_price')*mysql_result($special,$i,'tax'))/100)).'</span>';
															if(mysql_result($special,$i,'old_sale_price')>0)
															{
																echo '<span class="product-price-old">Rs.'.mysql_result($special,$i,'old_sale_price').'</span>';
															}
														echo '</div>
														<div class="product-button">
															<a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
															<a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
															<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.mysql_result($special,$i,'id').'">Buy<span class="icon"></span></a>
														</div>
													</div>
												</div>
											</li>';
									}
								}
								?>
							</ul>
						</div>
					</div>
					<!-- ./specail -->
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9" style="padding-top:20px;">
				<div class="col-xs-12 col-sm-5 col-md-6">
                <div id='body'>
			<div id="bigPic">
				<?php
				if(!empty($productinfo['imgpath1']))
				echo '<img src="login/product/'.$productinfo['imgpath1'].'" style="width:90%; height:295px;" alt="" />';
				if(!empty($productinfo['imgpath2']))
				echo '<img src="login/product/'.$productinfo['imgpath2'].'" style="width:90%; height:295px;"alt="" />';
				if(!empty($productinfo['imgpath3']))
				echo '<img src="login/product/'.$productinfo['imgpath3'].'" style="width:90%; height:295px;" alt="" />';
				if(!empty($productinfo['imgpath4']))
				echo '<img src="login/product/'.$productinfo['imgpath4'].'" style="width:90%; height:295px;" alt="" />';
				?>
			</div>
			<ul id="thumbs">
				<?php
				if(!empty($productinfo['imgpath1']))
				echo '<li class="active" rel="1"><img src="login/product/'.$productinfo['imgpath1'].'" alt="" /></li>';
				if(!empty($productinfo['imgpath2']))
				echo '<li rel="2"><img src="login/product/'.$productinfo['imgpath2'].'" alt="" /></li>';
				if(!empty($productinfo['imgpath3']))
				echo '<li rel="3"><img src="login/product/'.$productinfo['imgpath3'].'" alt="" /></li>';
				if(!empty($productinfo['imgpath4']))
				echo '<li rel="4"><img src="login/product/'.$productinfo['imgpath4'].'" alt="" /></li>';
				?>
			</ul>
		</div>
                </div>
				<?php
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
				?>
                <div class="col-xs-12 col-sm-3 col-md-4">
                <h3><?php echo $productinfo['product_name'];?></h3>
                <div><strong>Seller:</strong><?php echo $seller;?></div>
                <div class="price-box">
				<span class="product-price" style="font-size:16px;">Rs.<?php echo ($productinfo['sale_price']+(($productinfo['sale_price']*$productinfo['tax'])/100));?>/-</span>
				<?php
					if($productinfo['old_sale_price']>0)
					echo '<span class="product-price-old">Rs.'.$productinfo['old_sale_price'].'/-</span>';
				?>
				</div>
                <div>&nbsp;</div>
                <strong>Qty:</strong><input style="width:80px;" id="qty" name="qty" class="form-control input-sm" type="text" value="1" onkeyup="showPrice(this.value,<?php echo ($productinfo['sale_price']+(($productinfo['sale_price']*$productinfo['tax'])/100));?>)">
                <div>&nbsp;</div>
				 <div class="price-box">
					<span class="product-price"><strong>Total Price:</strong> <span style="color:#000000; font-size:16px;">Rs.
						<span id="totalPrice"><?php echo ($productinfo['sale_price']+(($productinfo['sale_price']*$productinfo['tax'])/100));?></span>
					/-</span></span>
					<?php
						/*if($availability<=0)
						{
							echo '<br/><strong><font size="3" color="coral">Out Of Stock</font></strong>';
						}*/
					?>
				 </div>
                <div>&nbsp;</div>
                 <div class="product-button">
					<a class="button-radius btn-add-cart" title="Add to Cart" href="javascript:addSession('<?php echo $productinfo['id'];?>','<?php echo $productinfo['sale_price'];?>')">Add to Cart<span class="icon"></span></a>
		         </div>
                </div>
				<!--DETAILS-->
                <div class="col-xs-12 col-sm-8 col-md-12" style=" margin-top:20px; border-radius:8px; padding:10px; border:#CCCCCC solid 1px;">
					<h5><strong>Description</strong></h5>
					<p>
						<?php echo $productinfo['description'];?>
					</p>
					<?php
					/*echo '<!----->
					<hr>
					<strong>Availability&nbsp;:&nbsp;</strong>';
					if($availability<=0)
					echo 'Out Of Stock';
					else
					echo $availability;
					echo '<br/>
					<!----->';*/
					?>
					<!----->
					<hr>
					<strong>Manufactured By&nbsp;:&nbsp;</strong>
					<?php
						$manufacturedby=mysql_query("SELECT * FROM manage_manufacturer_master WHERE id='$productinfo[manufactured_by]'")or die(mysql_error());
						if(mysql_num_rows($manufacturedby)>=1)
						{
							$manufacturedby=mysql_fetch_array($manufacturedby);
							$manufacturedby=$manufacturedby['name'];
						}
						else
						{
							$manufacturedby='';
						}
					echo $manufacturedby;?><br/>
					<!----->
					<strong>Marketed By&nbsp;:&nbsp;</strong>
					<?php
						$marketedby=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE id='$productinfo[marketed_by]'")or die(mysql_error());
						if(mysql_num_rows($marketedby)>=1)
						{
							$marketedby=mysql_fetch_array($marketedby);
							$marketedby=$marketedby['name'];
						}
						else
						{
							$marketedby='';
						}
					echo $marketedby;?><br/>
					<!----->
					<hr>
					<strong>Weight&nbsp;:&nbsp;</strong>
					<?php
						$type=mysql_query("SELECT * FROM manage_weight_type WHERE id='$productinfo[weight_type_id]'")or die(mysql_error());
						if(mysql_num_rows($type)>=1)
						{
							$type=mysql_fetch_array($type);
							$type=$type['name'];
						}
						else
						{
							$type='';
						}
					echo $productinfo['weight'].'&nbsp;'.$type;?><br/>
					<!----->
					<hr>
					<strong>Height&nbsp;:&nbsp;</strong>
					<?php
						$type=mysql_query("SELECT * FROM manage_length_type WHERE id='$productinfo[length_type_id]'")or die(mysql_error());
						if(mysql_num_rows($type)>=1)
						{
							$type=mysql_fetch_array($type);
							$type=$type['name'];
						}
						else
						{
							$type='';
						}
					echo $productinfo['height'].'&nbsp;'.$type;?><br/>
					<!----->
					<strong>Width&nbsp;:&nbsp;</strong>
					<?php
						$type=mysql_query("SELECT * FROM manage_length_type WHERE id='$productinfo[length_type_id]'")or die(mysql_error());
						if(mysql_num_rows($type)>=1)
						{
							$type=mysql_fetch_array($type);
							$type=$type['name'];
						}
						else
						{
							$type='';
						}
					echo $productinfo['width'].'&nbsp;'.$type;?><br/>
					<!----->
				</div>
				<!--REVIEWS-->
				<div class="col-xs-12 col-sm-8 col-md-12" style=" margin-top:20px; border-radius:8px; padding:10px; border:#CCCCCC solid 1px;">
					<h5><strong>Reviews</strong></h5>
					<?php
					$review=mysql_query("SELECT * FROM product_review WHERE productid='$productinfo[id]'")or die(mysql_error());
					if(mysql_num_rows($review)>=1)
					{
						while($reviewrow=mysql_fetch_array($review))
						{
							$customerinfo=mysql_query("SELECT fname,lname FROM customer_master WHERE id='$reviewrow[customerid]'")or die(mysql_error());
							$customerinfo=mysql_fetch_array($customerinfo);
							$customerinfo=$customerinfo['fname'].' '.$customerinfo['lname'];
							echo '<h4>'.$customerinfo.'</h4><p>'.$reviewrow['review'].'</p>
							<!----->
							<hr>';
						}
					}
					if(isset($_SESSION['user']))
					{
						echo '<div class="row">
						<form action="reviewsubmission.php?productid='.$_GET['id'].'" method="post">
							<div class="col-md-10">
								<textarea class="form-control" name="review" placeholder="Product Review..."></textarea>
							</div>
							<div class="col-md-2">
								<input type="submit" class="btn btn-info" name="submission" value="Submit">
							</div>
						</form>
						</div>';
					}
					?>
				</div>
				<!--END OF REVIEWS-->
			</div>
		</div>
			
			
		</div>
	</div>
	<!-- footer -->
	<footer id="footer">
		<div class="footer-top">
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