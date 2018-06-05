<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
include '../connect.php';
include 'require_extra/company_title.php';
/*LOGIN VALIDATION*/
if($_SESSION['storename']=='')
{
	header("location:../index.php?msg=Session expired");
}
if(!isset($_GET['orderno']))
{
	header("location:sales.php");
}
$orderno=mysql_real_escape_string($_GET['orderno']);
$orderinfo=mysql_query("SELECT * FROM sale_order WHERE order_no='$orderno'")or die(mysql_error());
if(mysql_num_rows($orderinfo)>=1)
{
	$orderinfo=mysql_fetch_array($orderinfo);
	$seller=mysql_query("SELECT * FROM store_master WHERE id='$orderinfo[store_id]'")or die(mysql_error());
	if(mysql_num_rows($seller)>=1)
	{
		$seller=mysql_result($seller,0,"storename");
	}
	else
	{
		$seller='My Avasar';
	}
	$customerinfo=mysql_query("SELECT * FROM customer_master WHERE id='$orderinfo[customer_id]'")or die(mysql_error());
	$customerinfo=mysql_fetch_array($customerinfo);
	if($orderinfo['invoice_no']=='')
	{/*CREATE MODE*/
		$invoiceno=mysql_query("SELECT order_id FROM sale_order WHERE invoice_no!=''")or die(mysql_error());
		$invoiceno=mysql_num_rows($invoiceno)+1;
		$invoicedate=date('Y-m-d');
		$billing=mysql_query("UPDATE sale_order SET invoice_no='$invoiceno',invoicedate='$invoicedate' WHERE order_no='$orderinfo[order_no]'")or die(mysql_error());
		/*============COMMISION WALLET CREATION============*/
		$totalbillamount=0;
		$itemsinfo=mysql_query("SELECT * FROM sale_order_products WHERE order_id='$orderinfo[order_no]' AND status='DISPATCH'")or die(mysql_error());
		if(mysql_num_rows($itemsinfo)>=1)
		{
			while($itemrow=mysql_fetch_array($itemsinfo))
			{
				$totalbillamount=$totalbillamount+$itemrow['total'];
			}
		}
		$commission=($totalbillamount*0.25)/100;
		$friendinfo=mysql_query("SELECT * FROM customer_master WHERE reference_code='$customerinfo[friend_reference]'")or die(mysql_error());
		if(mysql_num_rows($friendinfo)>=1)
		{
			$friendinfo=mysql_fetch_array($friendinfo);
			$datetime=date('Y-m-d H:i:s A');
			$query=mysql_query("INSERT INTO sale_wallet VALUES('','$friendinfo[id]','$datetime','$orderinfo[order_no]','$commission')")or die(mysql_error());
		}
		/*========END OF COMMISION WALLET CREATION=========*/
		header("location:bill.php?bill=true&orderno=".$orderno);
	}
	else
	{/*VIEW MODE*/
	}
}
else
{/*ORDER NOT FOUND IN DATABASE*/
	header("location:sales.php?msg=order not found");
}
?>
<html>
<head>
	<title><?php echo $companytitle['company_name'];?></title>
	<style>
	table {
    border-collapse: collapse;
}
/* style sheet for "A4" printing */
 @media print and (width: 21cm) and (height: 40.7cm) {
    @page {
       margin: 3cm;
    }
 }

 /* style sheet for "letter" printing */
 @media print and (width: 8.5in) and (height: 11in) {
    @page {
        margin: 1in;
    }
 }
.watermark
{
	color:#d0d0d0;
	font-size:120pt;
	-webkit-transform:rotate(-32deg);
	-moz-transform:rotate(-32deg);
	position:absolute;
	width:100%;
	opacity:0.20;
	height:100%;
	margin:0;
	z-index:-1;
	text-align:center;
	left:600px;
	top:400px;
}
</style>
</head>
<body>
<?php
$totalrows=mysql_query("SELECT * FROM sale_order_products WHERE order_id='$orderinfo[order_no]' AND status='DISPATCH'")or die(mysql_error());
$total_item_in_order=mysql_num_rows($totalrows);
$blankspace=0;
$total=0;
$vat=0;
if($total_item_in_order<1)
{
	echo '<script>window.close();</script>';
}
$item_per_page=60;
$start_point_in_page=0;
while($start_point_in_page<$total_item_in_order)
{
	$max_item_in_page=$start_point_in_page+$item_per_page;
	if($max_item_in_page>$total_item_in_order)
	{
		/*VALUES TO PRINT 60 ROWS IN BILL*/
		$avoid_extra_looping=$max_item_in_page-$total_item_in_order;
		$max_item_in_page=$max_item_in_page-$avoid_extra_looping;
		/*VALUES TO PRINT BLANK ROWS IN BILL*/
		$blankspace=$start_point_in_page;
	}
?>
<!-------------------------------------------------------------------------------------------------->
<div id="maincontainer" style="margin-left:0px;margin-right:0px;margin-top:10px;margin-bottom:10px;height:40.7cm;">
	<div id="headerdiv" style="height:30px;">
		<center><strong>INVOICE</strong></center>
	</div><!----------END OF HEADER DIV-------->
	<div id="corporate" style="text-align:center;">
	<div style="padding-left:5px;float:left;text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="padding-right:5px;float:right;text-align:right;">Tin No.:23524803944</div>
		<font size="4"><?php echo $companytitle['company_name'];?></font><br/>
		<font size="2"><strong>Reg.Office:</strong><?php echo $companytitle['address_line1'];?></font><br/>
		<font size="2"><strong></strong><?php echo $companytitle['address_line2'];?></font><br/>
		<font size="2"><strong></strong><?php echo $companytitle['city'].',&nbsp;'.$companytitle['state'].',&nbsp;'.$companytitle['country'].'-&nbsp;'.$companytitle['pincode'];?></font><br/>
		<font size="3"><strong>Contact No.:</strong><?php echo $companytitle['contact_no'].',&nbsp;'.$companytitle['mobile_no'];?><strong><br/>Email id:</strong><?php echo $companytitle['email_id'];?></font><br/>
	</div><!----------CORPORATE DIV-------->
		<div id="party" style="width:100%;border-radius:5px;border:1px solid;font-size:14px;">
			<table border="1" width="100%">
				<tr>
					<td style="height:100px;width:35%;padding-left:5px;padding-right:5px;">
						<table width="100%" style="font-size:13px;">
							<tr>
								<td>Invoice No.:</td>
								<td><?php echo $orderinfo['invoice_no'];?></td>
							</tr>
							<tr>
								<td>Date:</td>
								<td><?php echo date("d-m-Y",strtotime($orderinfo['invoicedate']));?></td>
							</tr>
							<tr>
								<td>Seller:</td>
								<td><?php echo $seller;?></td>
							</tr>
							<tr>
								<td>Order No.:</td>
								<td><?php echo $orderinfo['order_no'];?></td>
							</tr>
						</table><!----------ORDER TABLE DATA-------------->
					</td>
					<td style="height:100px;width:65%;padding-left:5px;padding-right:5px;font-size:14px;">
						<table width="100%" style="font-size:13px;">
							<tr>
								<td width="30%">Receiver Name</td>
								<td width="70%"><?php echo $orderinfo['shipping_firstname'].'&nbsp;'.$orderinfo['shipping_lastname'];?></td>
							</tr>
							<tr>
								<td width="30%">Address</td>
								<td width="70%"><?php echo $orderinfo['shipping_address'].'<br/>'.$orderinfo['shipping_city'].'&nbsp;'.$orderinfo['shipping_state'].'<br/>'.$orderinfo['shipping_country'].'- '.$orderinfo['shipping_postcode'];?></td>
							</tr>
							<tr>
								<td width="30%">Reg.Mobile No.:</td>
								<td width="70%"><?php echo $customerinfo['mobileno'];?></td>
							</tr>
						</table><!----------PARTY TABLE DATA-------------->
					</td>
				</tr>
			</table><!----------CORPORATE TABLE DATA-------------->
		</div><!----------PARTY DIV-------->
		<!----------------------------WATERMARK---------------------------->
			<div class="watermark">
				<!--<p>www.suryanshtd.in</p>-->
			</div>
		<!----------------------------END OF WATERMARK---------------------------->
	<!--------------------------------MAIN DATA------------------------------>
	<table width="100%" style="margin-top:10px;border-radius:5px;font-size:14px;">
		<tr style="text-align:center;">
			<th width="2%" style="border-left:1px solid;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;">S.No.</th>
			<th width="10%" style="border-right:1px solid;border-top:1px solid;border-bottom:1px solid;">Model No.</th>
			<th width="65%" style="border-right:1px solid;border-top:1px solid;border-bottom:1px solid;">Part Name</th>
			<th width="5%" style="border-right:1px solid;border-top:1px solid;border-bottom:1px solid;">MRP</th>
			<th width="5%" style="border-right:1px solid;border-top:1px solid;border-bottom:1px solid;">Qty.</th>
			<th width="8%" style="border-right:1px solid;border-top:1px solid;border-bottom:1px solid;">Amount</th>
		</tr>
		<?php
		if(mysql_num_rows($totalrows)>=1)
		{	
			for($i=$start_point_in_page;$i<$max_item_in_page;$i++)
			{
				$productid=mysql_result($totalrows,$i,'product_id');
				$productid=mysql_real_escape_string($productid);
				$productlist=mysql_query("SELECT * FROM manage_product_master WHERE id='$productid'") or die(mysql_error());
				$s_no=$i+1;
				/*VARIABLES*/
				$productid=mysql_result($productlist,0,'model_no');
				$productname=mysql_result($productlist,0,"product_name");
				$price=mysql_result($totalrows,$i,'price');
				$quantity=mysql_result($totalrows,$i,'quantity');
				$totalamount=mysql_result($totalrows,$i,'total');
				/*END OF VARIABLES*/
				echo'<tr>
					<th style="border-right:1px solid;border-left:1px solid;">'.$s_no.'</th>
					<th style="border-right:1px solid;">'.$productid.'</th>
					<th style="border-right:1px solid;">'.$productname.'</th>
					<th style="border-right:1px solid;">'.$price.'</th>
					<th style="border-right:1px solid;">'.$quantity.'</th>';
					$total=$total+$totalamount;
					echo '<th style="border-right:1px solid;text-align:right;padding-right:10px;">'.$totalamount.'</th>';
					echo '</tr>';
				$vat=$total*5/100;
				$start_point_in_page=$start_point_in_page+1;
			}
			$remainrows=$max_item_in_page-$blankspace;
			$remainspace=$item_per_page-$remainrows;
			if($remainspace>=1)
			{
				for($i=0;$i<$remainspace;$i++)
				{
					echo '<tr>
					<th style="border-right:1px solid;border-left:1px solid;">&nbsp;</th>
					<th style="border-right:1px solid;">&nbsp;</th>
					<th style="border-right:1px solid;">&nbsp;</th>
					<th style="border-right:1px solid;">&nbsp;</th>
					<th style="border-right:1px solid;">&nbsp;</th>
					<th style="border-right:1px solid;">&nbsp;</th>
					</tr>';
				}
				echo '<table width="100%" style="margin-top:10px;border-radius:5px;font-size:14px;">
				<tr>
			<td colspan="5" style="text-align:center;border-top:1px solid;border-bottom:1px solid;">Total Amount</td>
			<th style="text-align:right;padding-right:10px;border-top:1px solid;border-bottom:1px solid;">'.number_format($total,2).'</th>
		</tr>
		<tr>
			<td colspan="5" style="text-align:center;border-bottom:1px solid;">Final Amount</td>
			<th style="text-align:right;padding-right:10px;border-bottom:1px solid;">'.round($total).'</th>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td width="33%"><div id="footer" style="float:left;margin-left:40px;margin-top:20px;"><strong>Branch Head</strong></div></td>
			<td width="14%"><input type="button" style="margin-left:50%;border-radius:30px;" value="Print" onclick="window.print()" align="center"></td>
			<td width="53%"><div id="footer" style="float:right;margin-right:20px;margin-top:20px;"><strong>'.$companytitle['company_name'].'</strong></div></td>
		</tr>
	</table>';
			}
		}
		?>
		</table>
		</div><!--------------------------------MAIN CONTAINER------------------------------>
<!---------------------------------------------------------------------------------->
<?php
}
/* --------------------END OF MAIN LOOPING--------------------- */
?>
</BODY>
</HTML>