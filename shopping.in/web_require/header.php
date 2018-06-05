<script>
function removeFromSessionViaMenu(id)
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
			document.getElementById('loaderAjax').style.display="none";
			refreshCart();
		}
	}
	xmlhttp.open("GET","web_require/web_ajax/ajax_removeitem.php?id="+id, true);
	xmlhttp.send();
}
function refreshCart()
{
	var xmlhttp2;
	document.getElementById('loaderAjax').style.display="block";
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp2=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
	}
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
<?php
	$mainbackground=mysql_query("SELECT * FROM ais_indexshutter ORDER BY rand()")or die(mysql_error());
	if(mysql_num_rows($mainbackground)>=1)
	{
		$mainbackground=mysql_fetch_array($mainbackground);
		echo '<header id="header" style="background:url(login/setting/images/indexshutter/'.$mainbackground['indexbanner'].');">';
	}
	else
	{
		echo '<header id="header">';
	}
?>
		<div class="top-bar box-header">
			<div class="container">
				<div class="row">
					<ul class="top-bar-link top-bar-link-left">
						<li><font style="font-family: 'Playball', cursive;color:maroon;" size="6"><?php echo $companytitle['company_name'];?></font></li>
					</ul>
					<ul class="top-bar-link top-bar-link-right dot">
						<?php
							if(isset($_SESSION['user']['name']))
							{
								echo '<li><a href="myprofile.php">My Profile</a></li>';
								echo '<li><a href="myaccount.php">'.$_SESSION['user']['refcode'].'(My Account)</a></li>';
								echo '<li><a href="logout.php">'.$_SESSION['user']['name'].'<span>(Logout)</span></a></li>';
							}
							else
							{
								echo '<li><a href="login.php">Hello Guest</a></li>';
								echo '<li><a href="login.php">Sign Up/Sign In</a></li>';
							}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<!-- main header -->
			<div class="row">
				<div class="main-header">
					<div class="row">
						<div class="col-sm-12 col-md-4 col-lg-4">
							<div class="logo">
								<a href="index.php"><img src="login/setting/images/companylogo/<?php echo $companytitle['logo'];?>" alt="My Avasar" style="height:80px;width:123px;"></a>
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-7">
							<div class="advanced-search box-radius">
								<form action="category.php" class="form-inline" method="get">
									<div class="form-group search-category">
										<select name="grandcate" id="category-select" class="search-category-select">
											<option value="">All Categories</option>
											<?php
												$grandcate=mysql_query("SELECT * FROM manage_menu WHERE deleted='0'")or die(mysql_error());
												if(mysql_num_rows($grandcate)>=1)
												{
													while($row=mysql_fetch_array($grandcate))
													{
														echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
													}
												}
											?>
										</select>
									</div>
									<div class="form-group search-input">
										<input type="text" name="productname" placeholder="What are you looking for?">
									</div>
									<button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
								</form>
							</div>
						</div>
						
						<div class="col-sm-5 cart-mobile">
						<?php
			if(!isset($_SESSION['item']))
			{
				echo '<div class="block-wrap-cart">
							<div class="iner-block-cart">
								<a href="cart.php">
									<span class="total">Rs.0.00</span>
								</a>
							</div>
							<div class="block-mini-cart">
								<div class="mini-cart-content">
								<h5 class="mini-cart-head">0 Items in my cart</h5>
								<div class="mini-cart-list">
									<ul>
									</ul>
									</div>
									<div class="toal-cart">
										<span>Total</span>
										<span class="toal-price pull-right">Rs.0.00</span>
									</div>
								</div>
							</div>
					</div>';
			}
			else
			{
				$maxitems=count($_SESSION['item']['id']);
				$totalamount=0;
				echo '<li>
						<div class="block-wrap-cart">
							<div class="iner-block-cart">
								<a href="cart.php">
									<span class="total">'.$maxitems.' items in cart</span>
								</a>
							</div>
							<div class="block-mini-cart">
								<div class="mini-cart-content">
								<h5 class="mini-cart-head">'.$maxitems.' Items in my cart</h5>
								<div class="mini-cart-list">
									<ul>';
									for($i=0;$i<$maxitems;$i++)
									{
										$session_productid=$_SESSION['item']['id'][$i];
										$session_productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$session_productid'")or die(mysql_error());
										if(mysql_num_rows($session_productinfo)>=1)
										{
											$session_productinfo=mysql_fetch_array($session_productinfo);
											$subtotal=$session_productinfo['sale_price']*$_SESSION['item']['qty'][$i];
											echo '<li class="product-info">
												<div class="p-left">
													<a href="#" class="remove_link"></a>
													<a href="#">
													<img class="img-responsive" src="aisEcommerce/product/'.$session_productinfo['imgpath1'].'" alt="Product">
													</a>
												</div>
												<div class="p-right">
													<p class="p-name">'.$session_productinfo['product_name'].'</p>
													<p class="product-price">Rs.'.$subtotal.'</p>
													<p>Qty: '.$_SESSION['item']['qty'][$i].'</p>
												</div>
											</li>';
											$totalamount=$subtotal+$totalamount;
										}
									}
									echo '</ul>
									</div>
									<div class="toal-cart">
										<span>Total</span>
										<span class="toal-price pull-right">Rs.'.$totalamount.'</span>
									</div>
									<div class="cart-buttons">
										<a href="step2.php" class="button-radius btn-check-out">Checkout<span class="icon"></span></a>
									</div>
								</div>
							</div>
						</div>
					</li>';
			}
			?>
						</div>
					</div>
				</div>
			</div>
			<!-- ./main header -->
		</div>
		<div class="container">
			<div class="row">
				<!-- main menu-->
				<div class="main-menu">
					<div class="container">
						<div class="row">
							<?php include 'web_require/webmenus.php';?>
						</div>
					</div>
				</div>
				<!-- ./main menu-->
			</div>
		</div>
	</header>