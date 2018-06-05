<?php
/*************************************************************************/
	$ch = curl_init('http://crazyshopping.co/index.php?route=product/product&path=61_372&product_id=53');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = '';
if( ($json = curl_exec($ch) ) === false)
{
    echo 'Curl error: ' . curl_error($ch);
}
else
{
    $first_step = explode( '<h1 class="product-title">' ,$json);
	$first_step = explode( '</h1>' ,$first_step[1]);
	echo $first_step[0];
	/*==END OF SUPREME BAZAR==*/
}

// Close handle
curl_close($ch);
?>