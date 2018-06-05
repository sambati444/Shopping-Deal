<?php
session_start();
include '../../login/connect.php';
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
											$saleprice=$session_productinfo['sale_price']+(($session_productinfo['sale_price']*$session_productinfo['tax'])/100);
											$subtotal=$saleprice*$_SESSION['item']['qty'][$i];
											echo '<li class="product-info">
												<div class="p-left">
													<a href="javascript:removeFromSessionViaMenu('.$i.')" class="remove_link"><i class="fa fa-close" style="color:#ff0000;"></i></a>
													<a href="#">
													<img class="img-responsive" src="login/product/'.$session_productinfo['imgpath1'].'" alt="Product">
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
				?>