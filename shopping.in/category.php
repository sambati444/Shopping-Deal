<?php
session_start();
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
	<div class="container">
		<div class="row">
			<div class="block block-breadcrumbs">
				<ul>
					<li class="home">
						<a href="#"><i class="fa fa-home"></i></a>
						<span></span>
					</li>
					<?php
					if(isset($_GET['category']))
					{
						$id=mysql_real_escape_string($_GET['category']);
						$categorydetail=mysql_query("SELECT name FROM manage_category WHERE id='$id'")or die(mysql_error());
						if(mysql_num_rows($categorydetail)>=1)
						{
							$categorydetail=mysql_fetch_array($categorydetail);
							echo '<li><a href="#">'.$categorydetail['name'].'</a><span></span></li>';
						}
					}
					else if(isset($_GET['subcategory']))
					{
						$id=mysql_real_escape_string($_GET['subcategory']);
						$subcategorydetail=mysql_query("SELECT category_id,name FROM manage_subcategory WHERE id='$id'")or die(mysql_error());
						if(mysql_num_rows($subcategorydetail)>=1)
						{
							$subcategorydetail=mysql_fetch_array($subcategorydetail);
							$categoryname=mysql_query("SELECT name FROM manage_category WHERE id='$subcategorydetail[category_id]'")or die(mysql_error());
							echo '<li><a href="#">'.mysql_result($categoryname,0,"name").'</a><span></span></li>
							<li>'.$subcategorydetail['name'].'</li>';
						}
					}
					else
					{
						echo '<li><a href="#">'.$companytitle['company_name'].'</a><span></span></li>
						<li>All Products</li>';
					}
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
								<div class="block-filter-inner" style="height:200px;overflow:auto;">
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
															echo '</li>';
														}
													}
												}
											/*END OF CATEGORIES LINK*/
											?>
	                                </ul>
								</div>
							</div>
							<form action="">
								<div class="block-filter">
									<div class="block-sub-title">Price</div>
									<div class="block-filter-inner">
										<div class="amount-range-price">Range: $50 - $350</div>
										<div data-label-reasult="Range:" data-min="0" data-max="500" data-unit="$" class="slider-range-price" data-value-min="50" data-value-max="350"></div>
									</div>
								</div>
								<div class="block-filter">
									<div class="block-sub-title">Color</div>
									<div class="block-filter-inner">
										<ul class="check-box-list corlor">
											<li>
												<input type="checkbox" id="corlor1" name="cc">
												<label for="corlor1">
												<span class="button" style=" background:#4d6dbd;"></span>
												Blue<span class="count">(20)</span>
												</label>
											</li>
											<li>
												<input type="checkbox" id="corlor2" name="cc">
												<label for="corlor2">
												<span class="button" style=" background:#2fbcda;"></span>
												Cyan<span class="count">(1)</span>
												</label>
											</li>
											<li>
												<input type="checkbox" id="corlor3" name="cc">
												<label for="corlor3">
												<span class="button" style=" background:#ffe00c;"></span>
												Yellow  <span class="count">(31)</span>
												</label>
											</li>
											<li>
												<input type="checkbox" id="corlor4" name="cc">
												<label for="corlor4">
												<span class="button" style=" background:#72b226;"></span>
												Green  <span class="count">(21)</span>
												</label>
											</li>
											<li>
												<input type="checkbox" id="corlor5" name="cc">
												<label for="corlor5">
												<span class="button" style=" background:#fb5d5d;"></span>
												Red  <span class="count">(12)</span>
												</label>
											</li>
										</ul>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="block block-specail3">
						<div class="block-head">
							<h5 class="widget-title">Special</h5>
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
															<a class="product-img" href="product_details.php?id='.mysql_result($special,$i,'id').'"><img src="login/product/'.mysql_result($special,$i,'imgpath1').'"></a>
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
															<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.mysql_result($special,$i,"id").')">Add Compare</a>
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
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9">
				<?php
					if(isset($_GET['category']))
					{
						$category=mysql_real_escape_string($_GET['category']);
						$categoryinfo=mysql_query("SELECT * FROM manage_category WHERE id='$category' AND status='1' AND deleted='0'")or die(mysql_error());
						if(mysql_num_rows($categoryinfo)>=1)
						{
							echo '<div class="block block-categories-slider">
								<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">
									<a href="#"><img src="login/category/'.mysql_result($categoryinfo,0,"imagepath").'" style="height:280px;"></a>
									<a href="#"><img src="login/category/'.mysql_result($categoryinfo,0,"imagepath").'"  style="height:280px;"></a>
								</div>
							</div>
							<h3 class="page-title">
								<span>'.mysql_result($categoryinfo,0,"name").'</span>
								<a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a>
							</h3>';
							$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE category_id='$category' AND status='1' AND deleted='0'")or die(mysql_error());
							if(mysql_num_rows($productinfo)>=1)
							{
								echo '<div class="category-products">
										<ul class="products row">';
								while($productrow=mysql_fetch_array($productinfo))
								{
									
									echo '<li class="product col-xs-12 col-sm-6 col-md-4">
										<div class="product-container">
											<div class="inner">
												<div class="product-left">
													<div class="product-thumb">
														<a class="product-img" href="product_details.php?id='.$productrow['id'].'"><img src="login/product/'.$productrow['imgpath1'].'"></a>
														<a title="Quick View" href="product_details.php?id='.$productrow['id'].'" class="btn-quick-view">Quick View</a>
													</div>
												</div>
												<div class="product-right">
													<div class="product-name">
														<a href="product_details.php?id='.$productrow['id'].'">'.$productrow['product_name'].'</a>
													</div>
													<div class="price-box">
														<span class="product-price">Rs.'.round($productrow['sale_price']+(($productrow['sale_price']*$productrow['tax'])/100)).'</span>
														<span class="product-price-old"><!--OLD PRICE--></span>
													</div>
													<div class="product-button">
														<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.$productrow['id'].')">Add Compare</a>
														<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.$productrow['id'].'">Buy<span class="icon"></span></a>
													</div>
												</div>
											</div>
										</div>
									</li>';
								}
								echo '</ul>
										</div>';
							}
						}
					}
					else if(isset($_GET['subcategory']))
					{
						$subcategory=mysql_real_escape_string($_GET['subcategory']);
						$subcategoryinfo=mysql_query("SELECT * FROM manage_subcategory WHERE id='$subcategory' AND status='1' AND deleted='0'")or die(mysql_error());
						if(mysql_num_rows($subcategoryinfo)>=1)
						{
							echo '<div class="block block-categories-slider">
								<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">
									<a href="#"><img src="login/subcategory/'.mysql_result($subcategoryinfo,0,"imagepath").'" style="height:280px;"></a>
									<a href="#"><img src="login/subcategory/'.mysql_result($subcategoryinfo,0,"imagepath").'"  style="height:280px;"></a>
								</div>
							</div>
							<h3 class="page-title">
								<span>'.mysql_result($subcategoryinfo,0,"name").'</span>
								<a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a>
							</h3>';
							$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE sub_category_id='$subcategory' AND status='1' AND deleted='0'")or die(mysql_error());
							if(mysql_num_rows($productinfo)>=1)
							{
								echo '<div class="category-products">
										<ul class="products row">';
								while($productrow=mysql_fetch_array($productinfo))
								{
									
									echo '<li class="product col-xs-12 col-sm-6 col-md-4">
										<div class="product-container">
											<div class="inner">
												<div class="product-left">
													<div class="product-thumb">
														<a class="product-img" href="product_details.php?id='.$productrow['id'].'"><img src="login/product/'.$productrow['imgpath1'].'"></a>
														<a title="Quick View" href="product_details.php?id='.$productrow['id'].'" class="btn-quick-view">Quick View</a>
													</div>
												</div>
												<div class="product-right">
													<div class="product-name">
														<a href="product_details.php?id='.$productrow['id'].'">'.$productrow['product_name'].'</a>
													</div>
													<div class="price-box">
														<span class="product-price">Rs.'.round($productrow['sale_price']+(($productrow['sale_price']*$productrow['tax'])/100)).'</span>
														<span class="product-price-old"><!--OLD PRICE--></span>
													</div>
													<div class="product-button">
														<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.$productrow['id'].')">Add Compare</a>
														<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.$productrow['id'].'">Buy<span class="icon"></span></a>
													</div>
												</div>
											</div>
										</div>
									</li>';
								}
								echo '</ul>
										</div>';
								echo '<div class="sortPagiBar">
											<ul class="display-product-option">
												<li class="view-as-grid selected">
													<span>grid</span>
												</li>
												<li class="view-as-list">
													<span>list</span>
												</li>
											</ul>
											<div class="sortPagiBar-inner">
												<nav>
												  <ul class="pagination">
													<li class="active"><a href="#">1</a></li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#">5</a></li>
													<li>
													  <a href="#" aria-label="Next">
														<span aria-hidden="true">Next »</span>
													  </a>
													</li>
												  </ul>
												</nav>
												<div class="show-product-item">
													<select class="">
														<option value="1">Show 6</option>
														<option value="1">Show 12</option>
													</select>
												</div>
												
												<div class="sort-product">
													<select>
														<option value="1">Postion</option>
														<option value="1">Product name</option>
													</select>
													<div class="icon"><i class="fa fa-sort-alpha-asc"></i></div>
												</div>
											</div>
										</div>';
							}
						}
					}
					else if(isset($_GET['grandcate'])&&isset($_GET['productname']))
					{
						$grandcate=mysql_real_escape_string($_GET['grandcate']);
						$productname=mysql_real_escape_string($_GET['productname']);
						if(empty($grandcate)&&!empty($productname))
						{
							$categoryinfo=mysql_query("SELECT imagepath FROM manage_category WHERE status='1' AND deleted='0'")or die(mysql_error());
							if(mysql_num_rows($categoryinfo)>=1)
							{
								echo '<div class="block block-categories-slider">
									<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">';
										while($row=mysql_fetch_array($categoryinfo))
										{
											echo '<a href="#"><img src="login/category/'.$row['imagepath'].'" style="height:280px;"></a>';
										}
									echo '</div>
								</div>';
								$categoryinfo=mysql_query("SELECT * FROM manage_category WHERE status='1' AND deleted='0'")or die(mysql_error());
								while($row=mysql_fetch_array($categoryinfo))
								{
									$products=mysql_query("SELECT id FROM manage_product_master WHERE category_id='$row[id]' AND (product_name LIKE '%$productname%' OR model_no LIKE '%$productname%')")or die(mysql_error());
									$products=mysql_num_rows($products);
									if($products>=1)
									{
										echo '<h3 class="page-title">
										<span>'.$row['name'].'</span>
										<a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a>
										</h3>';
									}
									$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE category_id='$row[id]' AND (product_name LIKE '%$productname%' OR model_no LIKE '%$productname%') AND status='1' AND deleted='0'")or die(mysql_error());
									if(mysql_num_rows($productinfo)>=1)
									{
										echo '<div class="category-products">
												<ul class="products row">';
										while($productrow=mysql_fetch_array($productinfo))
										{
											
											echo '<li class="product col-xs-12 col-sm-6 col-md-4">
												<div class="product-container">
													<div class="inner">
														<div class="product-left">
															<div class="product-thumb">
																<a class="product-img" href="product_details.php?id='.$productrow['id'].'"><img src="login/product/'.$productrow['imgpath1'].'"></a>
																<a title="Quick View" href="product_details.php?id='.$productrow['id'].'" class="btn-quick-view">Quick View</a>
															</div>
														</div>
														<div class="product-right">
															<div class="product-name">
																<a href="product_details.php?id='.$productrow['id'].'">'.$productrow['product_name'].'</a>
															</div>
															<div class="price-box">
																<span class="product-price">Rs.'.round($productrow['sale_price']+(($productrow['sale_price']*$productrow['tax'])/100)).'</span>
																<span class="product-price-old"><!--OLD PRICE--></span>
															</div>
															<div class="product-button">
																<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.$productrow['id'].')">Add Compare</a>
																<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.$productrow['id'].'">Buy<span class="icon"></span></a>
															</div>
														</div>
													</div>
												</div>
											</li>';
										}
									echo '</ul>
											</div>';
									}
								}
							}
						}
						else if(!empty($grandcate)&&!empty($productname))
						{
							$categoryinfo=mysql_query("SELECT imagepath FROM manage_category WHERE menu_id='$grandcate' AND status='1' AND deleted='0'")or die(mysql_error());
							if(mysql_num_rows($categoryinfo)>=1)
							{
								echo '<div class="block block-categories-slider">
									<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">';
										while($row=mysql_fetch_array($categoryinfo))
										{
											echo '<a href="#"><img src="login/category/'.$row['imagepath'].'" style="height:280px;"></a>';
										}
									echo '</div>
								</div>';
								$categoryinfo=mysql_query("SELECT * FROM manage_category WHERE menu_id='$grandcate' AND status='1' AND deleted='0'")or die(mysql_error());
								while($row=mysql_fetch_array($categoryinfo))
								{
									$products=mysql_query("SELECT id FROM manage_product_master WHERE category_id='$row[id]' AND (product_name LIKE '%$productname%' OR model_no LIKE '%$productname%')")or die(mysql_error());
									$products=mysql_num_rows($products);
									if($products>=1)
									{
										echo '<h3 class="page-title">
										<span>'.$row['name'].'</span>
										<a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a>
										</h3>';
									}
									$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE category_id='$row[id]' AND (product_name LIKE '%$productname%' OR model_no LIKE '%$productname%') AND status='1' AND deleted='0'")or die(mysql_error());
									if(mysql_num_rows($productinfo)>=1)
									{
										echo '<div class="category-products">
												<ul class="products row">';
										while($productrow=mysql_fetch_array($productinfo))
										{
											
											echo '<li class="product col-xs-12 col-sm-6 col-md-4">
												<div class="product-container">
													<div class="inner">
														<div class="product-left">
															<div class="product-thumb">
																<a class="product-img" href="product_details.php?id='.$productrow['id'].'"><img src="login/product/'.$productrow['imgpath1'].'"></a>
																<a title="Quick View" href="product_details.php?id='.$productrow['id'].'" class="btn-quick-view">Quick View</a>
															</div>
														</div>
														<div class="product-right">
															<div class="product-name">
																<a href="product_details.php?id='.$productrow['id'].'">'.$productrow['product_name'].'</a>
															</div>
															<div class="price-box">
																<span class="product-price">Rs.'.round($productrow['sale_price']+(($productrow['sale_price']*$productrow['tax'])/100)).'</span>
																<span class="product-price-old"><!--OLD PRICE--></span>
															</div>
															<div class="product-button">
																<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.$productrow['id'].')">Add Compare</a>
																<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.$productrow['id'].'">Buy<span class="icon"></span></a>
															</div>
														</div>
													</div>
												</div>
											</li>';
										}
									echo '</ul>
											</div>';
									}
								}
							}
						}
						else if(empty($grandcate)&&empty($productname))
						{
							$categoryinfo=mysql_query("SELECT imagepath FROM manage_category WHERE status='1' AND deleted='0'")or die(mysql_error());
							if(mysql_num_rows($categoryinfo)>=1)
							{
								echo '<div class="block block-categories-slider">
									<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">';
										while($row=mysql_fetch_array($categoryinfo))
										{
											echo '<a href="#"><img src="login/category/'.$row['imagepath'].'" style="height:280px;"></a>';
										}
									echo '</div>
								</div>';
								$categoryinfo=mysql_query("SELECT * FROM manage_category WHERE status='1' AND deleted='0'")or die(mysql_error());
								while($row=mysql_fetch_array($categoryinfo))
								{
									$products=mysql_query("SELECT id FROM manage_product_master WHERE category_id='$row[id]' AND (product_name LIKE '%$productname%' OR model_no LIKE '%$productname%')")or die(mysql_error());
									$products=mysql_num_rows($products);
									if($products>=1)
									{
										echo '<h3 class="page-title">
										<span>'.$row['name'].'</span>
										<a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a>
										</h3>';
									}
									$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE category_id='$row[id]' AND status='1' AND deleted='0'")or die(mysql_error());
									if(mysql_num_rows($productinfo)>=1)
									{
										echo '<div class="category-products">
												<ul class="products row">';
										while($productrow=mysql_fetch_array($productinfo))
										{
											
											echo '<li class="product col-xs-12 col-sm-6 col-md-4">
												<div class="product-container">
													<div class="inner">
														<div class="product-left">
															<div class="product-thumb">
																<a class="product-img" href="product_details.php?id='.$productrow['id'].'"><img src="login/product/'.$productrow['imgpath1'].'"></a>
																<a title="Quick View" href="product_details.php?id='.$productrow['id'].'" class="btn-quick-view">Quick View</a>
															</div>
														</div>
														<div class="product-right">
															<div class="product-name">
																<a href="product_details.php?id='.$productrow['id'].'">'.$productrow['product_name'].'</a>
															</div>
															<div class="price-box">
																<span class="product-price">Rs.'.round($productrow['sale_price']+(($productrow['sale_price']*$productrow['tax'])/100)).'</span>
																<span class="product-price-old"><!--OLD PRICE--></span>
															</div>
															<div class="product-button">
																<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.$productrow['id'].')">Add Compare</a>
																<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.$productrow['id'].'">Buy<span class="icon"></span></a>
															</div>
														</div>
													</div>
												</div>
											</li>';
										}
									echo '</ul>
											</div>';
									}
								}
							}
						}
						else if(!empty($grandcate)&&empty($productname))
						{
							$categoryinfo=mysql_query("SELECT imagepath FROM manage_category WHERE menu_id='$grandcate' AND status='1' AND deleted='0'")or die(mysql_error());
							if(mysql_num_rows($categoryinfo)>=1)
							{
								echo '<div class="block block-categories-slider">
									<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">';
										while($row=mysql_fetch_array($categoryinfo))
										{
											echo '<a href="#"><img src="login/category/'.$row['imagepath'].'" style="height:280px;"></a>';
										}
									echo '</div>
								</div>';
								$categoryinfo=mysql_query("SELECT * FROM manage_category WHERE menu_id='$grandcate' AND status='1' AND deleted='0'")or die(mysql_error());
								while($row=mysql_fetch_array($categoryinfo))
								{
									$products=mysql_query("SELECT id FROM manage_product_master WHERE category_id='$row[id]' AND (product_name LIKE '%$productname%' OR model_no LIKE '%$productname%')")or die(mysql_error());
									$products=mysql_num_rows($products);
									if($products>=1)
									{
										echo '<h3 class="page-title">
										<span>'.$row['name'].'</span>
										<a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a>
										</h3>';
									}
									$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE category_id='$row[id]' AND status='1' AND deleted='0'")or die(mysql_error());
									if(mysql_num_rows($productinfo)>=1)
									{
										echo '<div class="category-products">
												<ul class="products row">';
										while($productrow=mysql_fetch_array($productinfo))
										{
											
											echo '<li class="product col-xs-12 col-sm-6 col-md-4">
												<div class="product-container">
													<div class="inner">
														<div class="product-left">
															<div class="product-thumb">
																<a class="product-img" href="product_details.php?id='.$productrow['id'].'"><img src="login/product/'.$productrow['imgpath1'].'"></a>
																<a title="Quick View" href="product_details.php?id='.$productrow['id'].'" class="btn-quick-view">Quick View</a>
															</div>
														</div>
														<div class="product-right">
															<div class="product-name">
																<a href="product_details.php?id='.$productrow['id'].'">'.$productrow['product_name'].'</a>
															</div>
															<div class="price-box">
																<span class="product-price">Rs.'.round($productrow['sale_price']+(($productrow['sale_price']*$productrow['tax'])/100)).'</span>
																<span class="product-price-old"><!--OLD PRICE--></span>
															</div>
															<div class="product-button">
																<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.$productrow['id'].')">Add Compare</a>
																<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.$productrow['id'].'">Buy<span class="icon"></span></a>
															</div>
														</div>
													</div>
												</div>
											</li>';
										}
									echo '</ul>
											</div>';
									}
								}
							}
						}
						else
						{
							$categoryinfo=mysql_query("SELECT imagepath FROM manage_category WHERE status='1' AND deleted='0'")or die(mysql_error());
							if(mysql_num_rows($categoryinfo)>=1)
							{
								echo '<div class="block block-categories-slider">
									<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">';
										while($row=mysql_fetch_array($categoryinfo))
										{
											echo '<a href="#"><img src="login/category/'.$row['imagepath'].'" style="height:280px;"></a>';
										}
									echo '</div>
								</div>';
								$categoryinfo=mysql_query("SELECT * FROM manage_category WHERE status='1' AND deleted='0'")or die(mysql_error());
								while($row=mysql_fetch_array($categoryinfo))
								{
									$products=mysql_query("SELECT id FROM manage_product_master WHERE category_id='$row[id]' AND (product_name LIKE '%$productname%' OR model_no LIKE '%$productname%')")or die(mysql_error());
									$products=mysql_num_rows($products);
									if($products>=1)
									{
										echo '<h3 class="page-title">
										<span>'.$row['name'].'</span>
										<a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a>
										</h3>';
									}
									$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE category_id='$row[id]' AND status='1' AND deleted='0'")or die(mysql_error());
									if(mysql_num_rows($productinfo)>=1)
									{
										echo '<div class="category-products">
												<ul class="products row">';
										while($productrow=mysql_fetch_array($productinfo))
										{
											
											echo '<li class="product col-xs-12 col-sm-6 col-md-4">
												<div class="product-container">
													<div class="inner">
														<div class="product-left">
															<div class="product-thumb">
																<a class="product-img" href="product_details.php?id='.$productrow['id'].'"><img src="login/product/'.$productrow['imgpath1'].'"></a>
																<a title="Quick View" href="product_details.php?id='.$productrow['id'].'" class="btn-quick-view">Quick View</a>
															</div>
														</div>
														<div class="product-right">
															<div class="product-name">
																<a href="product_details.php?id='.$productrow['id'].'">'.$productrow['product_name'].'</a>
															</div>
															<div class="price-box">
																<span class="product-price">Rs.'.round($productrow['sale_price']+(($productrow['sale_price']*$productrow['tax'])/100)).'</span>
																<span class="product-price-old"><!--OLD PRICE--></span>
															</div>
															<div class="product-button">
																<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.$productrow['id'].')">Add Compare</a>
																<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.$productrow['id'].'">Buy<span class="icon"></span></a>
															</div>
														</div>
													</div>
												</div>
											</li>';
										}
									echo '</ul>
											</div>';
									}
								}
							}
						}
					}
					else
					{
						echo '<div class="block block-categories-slider">
									<div class="list kt-owl-carousel" data-animateout="fadeOut" data-animateIn="fadeIn" data-items="1" data-autoplay="true" data-margin="0" data-loop="true" data-nav="true">
										<a href="#"><img src="setting/data/option1/slider-cat.jpg" alt="slider-cat.jpg"></a>
										<a href="#"><img src="setting/data/option1/slider-cat2.jpg" alt="slider-cat2.jpg"></a>
									</div>
								</div>';
						$subcategoryinfo=mysql_query("SELECT * FROM manage_subcategory WHERE status='1' AND deleted='0'")or die(mysql_error());
						if(mysql_num_rows($subcategoryinfo)>=1)
						{
							$maxitem=mysql_num_rows($subcategoryinfo);
							for($k=0;$k<$maxitem;$k++)
							{
								$subcategoryid=mysql_result($subcategoryinfo,$k,"id");
								echo '<h3 class="page-title">
									<span>'.mysql_result($subcategoryinfo,$k,"name").'</span>
									<a href="#" class="button-radius compare-link">Compare<span class="icon"></span></a>
								</h3>';
								$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE sub_category_id='$subcategoryid' AND status='1' AND deleted='0'")or die(mysql_error());
								if(mysql_num_rows($productinfo)>=1)
								{
									echo '<div class="category-products">
											<ul class="products row">';
									while($productrow=mysql_fetch_array($productinfo))
									{
										
										echo '<li class="product col-xs-12 col-sm-6 col-md-4">
											<div class="product-container">
												<div class="inner">
													<div class="product-left">
														<div class="product-thumb">
															<a class="product-img" href="product_details.php?id='.$productrow['id'].'"><img src="login/product/'.$productrow['imgpath1'].'"></a>
															<a title="Quick View" href="product_details.php?id='.$productrow['id'].'" class="btn-quick-view">Quick View</a>
														</div>
													</div>
													<div class="product-right">
														<div class="product-name">
															<a href="product_details.php?id='.$productrow['id'].'">'.$productrow['product_name'].'</a>
														</div>
														<div class="price-box">
															<span class="product-price">Rs.'.round($productrow['sale_price']+(($productrow['sale_price']*$productrow['tax'])/100)).'</span>
															<span class="product-price-old"><!--OLD PRICE--></span>
														</div>
														<div class="product-button">
															<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.$productrow['id'].')">Add Compare</a>
															<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.$productrow['id'].'">Buy<span class="icon"></span></a>
														</div>
													</div>
												</div>
											</div>
										</li>';
									}
									echo '</ul>
										</div>';
								}
							}
						}
					}
				?>
				</div>
				<div class="container">
		<div class="row">
			
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