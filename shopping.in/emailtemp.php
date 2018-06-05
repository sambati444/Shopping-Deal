<?php
include 'login/connect.php';
$companytitle=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
if(mysql_num_rows($companytitle)>=1)
{
	$companytitle=mysql_fetch_array($companytitle);
}
$orderno=mysql_real_escape_string($_GET['orderno']);
$orderinfo=mysql_query("SELECT * FROM sale_order WHERE order_no='$orderno'")or die(mysql_error());
$orderinfo=mysql_fetch_array($orderinfo);
$customerinfo=mysql_query("SELECT * FROM customer_master WHERE id='$orderinfo[customer_id]'")or die(mysql_error());
$customerinfo=mysql_fetch_array($customerinfo);
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$companytitle['company_title'].'::'.$orderinfo['order_no'].'</title>
</head>

<body>
<table width="70%" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td align="left" valign="top" bgcolor="#F9F9F9"><p><strong>Hi Customer,</strong><br />
        </p>
        <p>Thank you for your order!<br />
        </p>
        <p>We will send you another email once the items in your order have been shipped. Meanwhile, you can check the status of your order on<a alt="'.$companytitle['company_name'].'" href="'.$_SERVER['SERVER_NAME'].'" target="_blank">&nbsp;'.$companytitle['company_name'].'</a><br />
        </p>
        <p align="center"><a align="center" href="'.$_SERVER['SERVER_NAME'].'/login.php" target="_blank">TRACK ORDER</a></p></td>
    </tr>
  </tbody>
</table>
<table width="70%" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td align="left" valign="top" bgcolor="">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td colspan="4" width="80%" align="center" valign="top"><p>Please find below, the summary of your order<a href="'.$_SERVER['SERVER_NAME'].'/login.php" target="_blank">'.$orderinfo['order_no'].'</a><br />
            </p>
              </td>
          </tr>
          <tr>
            <td colspan="4" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td width="83%" align="left" valign="middle">
                  <hr/></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
<table width="70%" align="center" cellpadding="0" cellspacing="0">
  <tbody>';
  <?php
	$sale_product=mysql_query("SELECT * FROM sale_order_products WHERE order_id='$orderinfo[order_no]'")or die(mysql_error());
	$grandtotal=0;
	$courier=0;
	if(mysql_num_rows($sale_product)>=1)
	{
		while($saleprorow=mysql_fetch_array($sale_product))
		{
			$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$saleprorow[product_id]'")or die(mysql_error());
			$productinfo=mysql_fetch_array($productinfo);
			$total=$saleprorow['price']*$saleprorow['quantity'];
			echo '<tr>
			  <td valign="top" align="center" width="350"><table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tbody>
				  <tr>
					<td width="40%" valign="middle" align="center"><a href="'.$_SERVER['SERVER_NAME'].'/product_details.php?id='.$saleprorow['product_id'].'" target="_blank"><img src="'.$_SERVER['SERVER_NAME'].'/login/product/'.$productinfo['imgpath1'].'" alt="" border="0" style="width:140px;height:110px;"/></a></td>
					<td width="60%" align="center" valign="top"><p><a href="'.$_SERVER['SERVER_NAME'].'/product_details.php?id='.$saleprorow['product_id'].'" target="_blank">'.$productinfo['product_name'].'</a></p></td>
				  </tr>
				</tbody>
			  </table></td>
			  <td valign="top" align="center" width="250"><table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tbody>
				  <tr>
					<td width="33%" valign="top" align="center"><p>Item Price</p>
						  <p>Rs.'.$saleprorow['price'].'</p></td>
					<td width="33%" valign="top" align="center"><p>Qty</p>
						  <p>'.$saleprorow['quantity'].'</p></td>
					<td width="33%" valign="top" align="center"><p>Sub-Total</p>
						  <p>Rs.'.$total.'</p></td>
				  </tr>
				</tbody>
			  </table></td>
			</tr>';
			$courier=$saleprorow['total']-($saleprorow['price']*$saleprorow['quantity']);
			$grandtotal=$grandtotal+$total;
		}
	}
  ?>
  </tbody>
</table>
<table width="70%" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td valign="top" align="center" bgcolor="#fff"><table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tbody>
			 <tr>
				<td valign="top" align="right"><p><strong>Delivery Charge Rs.<?php echo $courier;?></strong></p></td>
			</tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
<table width="70%" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td valign="top" align="right" bgcolor=""><table cellspacing="0" cellpadding="0" width="100%">
        <tbody>
          <tr>
            <td valign="top" align="right"><p><strong>Total Rs.<?php echo $grandtotal+$courier;?></strong></p></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
<table width="70%" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td valign="top" align="left" bgcolor="#ffffff"><p>Outstanding Amount Payable on Delivery:<strong>Rs.<?php echo $grandtotal+$courier;?></strong></p></td>
    </tr>
  </tbody>
</table>
<table width="70%" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td valign="top" align="left" bgcolor="#ffffff"><table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td valign="top" align="left"><p>DELIVERY ADDRESS</p>
              <p><strong><?php echo $orderinfo['shipping_firstname'].'&nbsp;'.$orderinfo['shipping_lastname'];?></strong></p>
              <p><?php echo $orderinfo['shipping_address'];?><br />
                <?php echo $orderinfo['shipping_city'].'-'.$orderinfo['shipping_postcode'];?><br />
                <?php echo $orderinfo['shipping_state'];?><br />
                <?php echo $orderinfo['shipping_country']?></p></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>




</body>
</html>
