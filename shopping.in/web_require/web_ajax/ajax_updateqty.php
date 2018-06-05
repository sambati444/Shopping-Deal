<?php
session_start();
include '../../login/connect.php';
$sessionid=mysql_real_escape_string($_GET['id']);
$quantity=mysql_real_escape_string($_GET['qty']);
$_SESSION['item']['qty'][$sessionid]=$quantity;
?>
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
							$maxitems=count($_SESSION['item']['id']);
							$totalamount=0;
							for($i=0;$i<$maxitems;$i++)
							{
								$pid=$_SESSION['item']['id'][$i];
								$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$pid' AND status='1' AND deleted='0'")or die(mysql_error());
								if(mysql_num_rows($productinfo)>=1)
								{
									$productinfo=mysql_fetch_array($productinfo);
									echo '<tr>
										<td class="cart_product">
											<a href="#"><img class="img-responsive" src="login/product/'.$productinfo['imgpath1'].'" alt="Product"></a>
										</td>
										<td class="cart_description">
											<p class="product-name"><a href="#">'.$productinfo['product_name'].'</a></p>
											<small class="cart_ref">SKU : #123654999</small><br>
											<small><a href="#">Color : Beige</a></small><br>   
											<small><a href="#">Size : S</a></small>
										</td>
										<td class="cart_avail"><span class="label label-success">In stock</span></td>
										<td class="price"><span>Rs.'.($productinfo['sale_price']+(($productinfo['sale_price']*$productinfo['tax'])/100)).'</span></td>
										<td class="qty">
											<input class="form-control input-sm" type="text" value="'.$_SESSION['item']['qty'][$i].'" id="'.$i.'" onkeyup="updateQuantity(this.id,this.value)">
										</td>';
										$price=((($productinfo['sale_price']*$productinfo['tax'])/100)+($productinfo['sale_price'])*$_SESSION['item']['qty'][$i]);
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