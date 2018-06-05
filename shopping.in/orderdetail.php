<?php
session_start();
include 'login/connect.php';
$companytitle=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
if(mysql_num_rows($companytitle)>=1)
{
	$companytitle=mysql_fetch_array($companytitle);
}
if(!isset($_SESSION['user']))
{
	header("location:index.php?session expired");
}
if(isset($_GET['orderno']))
{
	$orderno=mysql_real_escape_string($_GET['orderno']);
	$orderinfo=mysql_query("SELECT * FROM sale_order WHERE order_no='$orderno'")or die(mysql_error());
	if(mysql_num_rows($orderinfo))
	{
		$orderinfo=mysql_fetch_array($orderinfo);
	}
	else
	{
		header("location:myaccount.php?not found");
	}
}
else
{
	header("location:myaccount.php?error");
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
	<style>
	.fa-close{color:#FF0000;font-size:10px;}
	</style>
	<?php include 'web_require/step2_javascript.php';?>
</head>
<body class="option3" onload="onLoad()">
	<input type="hidden" value="0" id="trigger">
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
	<script>
	function changeStatus(orderno,id)
	{
		var ans=confirm("Are you want to cancel this item");
		if(ans)
		{
			window.location="cancelorder.php?orderno="+orderno+"&id="+id;
		}
	}
	</script>
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
					<li>Order Detail</li>
				</ul>
			</div>
			<div class="main-page">
				<h1 class="page-title">Order Detail</h1>
				<div class="page-content page-order">
					<!--------------------------------MAIN CONTENT DATA----------------------------->
		            <div class="order-detail-content">
		                <div class="row">
							<div class="col-sm-12">
								<div class="box-border">
									<div class="row">
										<div class="col-md-6">
											<strong>Order No.</strong>
											<?php echo $orderinfo['order_no'];?>
										</div>
										<div class="col-md-6">
											<strong>Order Date &amp; Time</strong>
											<?php echo date('d-M-Y h:i:s A',strtotime($orderinfo['orderdate'])); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<strong>Shipping Name</strong>
											<?php echo $orderinfo['shipping_firstname'].'&nbsp;'.$orderinfo['shipping_lastname'];?>
										</div>
										<?php
										if($orderinfo['shipping_company']!='')
										{
										echo '<div class="col-md-6">
											<strong>Shipping Company Name</strong>
											'.$orderinfo['shipping_company'].'
										</div>';
										}
										?>
									</div>
									<div class="row">
										<div class="col-md-12">
											<strong>Address</strong>
											<?php echo $orderinfo['shipping_address'].'&nbsp;'.$orderinfo['shipping_city'].'&nbsp;'.$orderinfo['shipping_state'].'&nbsp;'.$orderinfo['shipping_country'].'&nbsp;-'.$orderinfo['shipping_postcode'];?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-10">
											<strong>Comment</strong>
											<?php echo $orderinfo['comment'];?>
										</div>
									</div>
									<table class="table">
										<tr>
											<th>S.No.</th>
											<th>Product Name</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Shipping Charge</th>
											<th>Total Amount</th>
											<th>Status</th>
											<th>Cancel</th>
										</tr>
								<?php
									$myorders=mysql_query("SELECT * FROM sale_order_products WHERE order_id='$orderinfo[order_no]'")or die(mysql_error());
									if(mysql_num_rows($myorders)>=1)
									{
										$s_no=1;
										while($row=mysql_fetch_array($myorders))
										{
											$imagepath=mysql_query("SELECT imgpath1 FROM manage_product_master WHERE id='$row[product_id]'")or die(mysql_error());
											$imagepath=mysql_result($imagepath,0,"imgpath1");
											echo '<tr>
													<td>'.$s_no.'</td>
													<td><a href="product_details.php?id='.$row['product_id'].'" style="color:#FF9966;">'.$row['name'].'<img src="'.$_SERVER['SERVER_NAME'].'/login/product/'.$imagepath.'" style="width:100px;height:82px;"></td>
													<td>'.$row['price'].'</td>
													<td>'.$row['quantity'].'</td>
													<td>'.($row['total']-($row['price']*$row['quantity'])).'</td>
													<td>'.$row['total'].'</td>';
													if($row['status']=='NEW')
													{
														echo '<td><font color="#FF9900" size="2">New</font></td>';
														echo '<td><a href="javascript:changeStatus(\''.$orderinfo['order_no'].'\','.$row['id'].')"><i class="fa fa-close">Cancel</i></a></td>';
													}
													else if($row['status']=='PENDING')
													{
														echo '<td><font color="#CC33CC" size="2">Pending</td>';
														echo '<td><a href="javascript:changeStatus(\''.$orderinfo['order_no'].'\','.$row['id'].')"><i class="fa fa-close">Cancel</i></a></td>';
													}
													else if($row['status']=='CANCEL')
													{
														echo '<td><font color="red" size="2">Cancelled</font></td>';
														echo '<td><a href="#"><i class="fa fa-close">Cancelled</i></a></td>';
													}
													else if($row['status']=='DISPATCH')
													{
														echo '<td><font color="#08C000" size="2">Dispatched</font></td>';
														echo '<td><a href="#"><i class="fa fa-close">Cancelled</i></a></td>';
													}
												echo '</tr>';
											$s_no=$s_no+1;
										}
									}
									else
									{
										echo '<tr><td colspan="7"><center><h2>No Orders Found</h2></center></td></tr>';
									}
								?>
									</table>
								</div>
							</div>
			            </div>
		            </div>
					<!----------------------------END OF MAIN CONTENT DATA-------------------------->
		        </div>
			</div><!--MAIN DIV-->
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