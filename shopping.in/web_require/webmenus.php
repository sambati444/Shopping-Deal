<nav class="navbar" id="main-menu">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="#">MENU</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Home</a></li>
				<?php
				$menu=mysql_query("SELECT * FROM manage_menu WHERE deleted='0'")or die(mysql_error());
				if(mysql_num_rows($menu)>=1)
				{
					while($menurow=mysql_fetch_array($menu))
					{/*====================MENUS=====================*/
						$menuinfo=mysql_query("SELECT * FROM manage_category WHERE menu_id='$menurow[id]'")or die(mysql_error());
						if(mysql_num_rows($menuinfo)>=1)
						{
							echo '<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$menurow['name'].'</a>
									<ul class="dropdown-menu mega_dropdown" role="menu" style="width: 900px;">';
									$category=mysql_query("SELECT * FROM manage_category WHERE menu_id='$menurow[id]' AND deleted='0'")or die(mysql_error());
									if(mysql_num_rows($category)>=1)
									{
										while($caterow=mysql_fetch_array($category))
										{/*====================CATEGORIES=====================*/
											$categoryinfo=mysql_query("SELECT * FROM manage_subcategory WHERE category_id='$caterow[id]'")or die(mysql_error());
											if(mysql_num_rows($categoryinfo)>=1)
											{
												echo '<li class="block-container col-sm-3 border">
													<ul class="block-megamenu-link">
														<li class="link_container group_header">
															<a href="category.php?category='.$caterow['id'].'">'.$caterow['name'].'</a>
														</li>';
														$subcategory=mysql_query("SELECT * FROM manage_subcategory WHERE category_id='$caterow[id]' AND deleted='0'")or die(mysql_error());
														if(mysql_num_rows($subcategory)>=1)
														{
															while($subrow=mysql_fetch_array($subcategory))
															{/*====================SUB CATEGORIES=====================*/
																echo '<li class="link_container"><a href="category.php?subcategory='.$subrow['id'].'">'.$subrow['name'].'</a></li>';
															}
														}
													echo '</ul>
												</li>';
											}
										}
									}
							echo '</ul></li>';
						}/*END OF VALIDATION IF CATEGORY NOT FOUND IN MENU*/
					}
				}
				?>
				<li><a href="#">Contact Us</a></li>
			</ul>
			<?php
			if(!isset($_SESSION['item']))
			{
				echo '<ul class="nav navbar-nav navbar-right">
					<li>
						<div class="block-wrap-cart">
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
						</div>
					</li>
				</ul>';
			}
			else
			{
				$maxitems=count($_SESSION['item']['id']);
				$totalamount=0;
				echo '<ul class="nav navbar-nav navbar-right" id="refreshCartUL">
					<li>
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
													<a href="javascript:removeFromSessionViaMenu('.$i.')" class="remove_link"><i class="fa fa-close" style="color:#ff0000;"></i></a>
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
					</li>
				</ul>';
			}
			?>
		</div><!--/.nav-collapse -->
	</div>
</nav><!--END OF MENU-->