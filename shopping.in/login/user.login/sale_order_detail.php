<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
include '../connect.php';
include 'require_extra/company_title.php';
/*LOGIN VALIDATION*/
if($_SESSION['myusername']=='')
{
	header("location:../index.php?msg=Session expired");
}
$orderno=mysql_real_escape_string($_GET['orderno']);
$orderinfo=mysql_query("SELECT * FROM sale_order WHERE order_no='$orderno'")or die(mysql_error());
if(mysql_num_rows($orderinfo)>=1)
{
	$orderinfo=mysql_fetch_array($orderinfo);
}
else
{
	header("locaation:sales.php?msg=Order not found");
}
$customerinfo=mysql_query("SELECT * FROM customer_master WHERE id='$orderinfo[customer_id]'")or die(mysql_error());
$customerinfo=mysql_fetch_array($customerinfo);
?>
<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title><?php echo $companytitle['company_name'].'&nbsp;||&nbsp;'.$_SESSION['myname'];?></title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../setting/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../setting/lib/font-awesome/css/font-awesome.css">
    <script src="../setting/lib/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="../setting/lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>
    <link rel="stylesheet" type="text/css" href="../setting/stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="../setting/stylesheets/premium.css">
	 <link rel="stylesheet" type="text/css" href="../setting/stylesheets/reveal.css">
</head>
<body class=" theme-blue">
    <!-- Demo page code -->
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
            color: #fff;
        }
    </style>
    <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
		function changeStatus(orderno,id,status)
		{
			window.location="changeorderstatus.php?orderno="+orderno+"&id="+id+"&status="+status;
		}
    </script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
   
  <!--<![endif]-->

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="javascript:void()"><span class="navbar-brand"><font style="font-family: 'Playball', cursive;color:#fff;" size="6"><?php echo $companytitle['company_name'];?></font></span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span><?php echo $_SESSION['myname'];?>
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
                <li><a href="user.php">My Account</a></li>
                <li class="divider"></li>
                <li class="dropdown-header"><?php echo $_SESSION['usertype'];?> PANEL</li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="../logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </div>
    

    <div class="sidebar-nav">
		<?php	include 'require_extra/sidemenu.php';?>
    </div>

    <div class="content">
        <div class="header">
            <div class="stats">
    <!--<p class="stat"><span class="label label-info">5</span> Tickets</p>
    <p class="stat"><span class="label label-success">27</span> Tasks</p>
    <p class="stat"><span class="label label-danger">15</span> Overdue</p>-->
</div>
            <h1 class="page-title">Order Detail</h1>
            <ul class="breadcrumb">
				<li><a href="home.php">Home</a></li>
				<li class="active">Detailed Information for <strong><?php echo $orderinfo['order_no'];?></strong></li>
			</ul>
        </div>
        <div class="main-content">
			<table class="table" style="font-size:12px;">
				<tr>
					<td colspan="4"><h3>Customer Information</h3></td>
				</tr>
				<tr>
					<td><strong>Friend's Reference Code</strong></td>
					<td><?php echo $customerinfo['friend_reference'];?></td>
					<td><strong>Reference Code</strong></td>
					<td><?php echo $customerinfo['reference_code'];?></td>
				</tr>
				<tr>
					<td><strong>Name</strong></td>
					<td><?php echo $customerinfo['fname'].' '.$customerinfo['lname'];?></td>
					<td><strong>Date of Registration</strong></td>
					<td><?php echo date('d-M-Y h:i:s A',strtotime($customerinfo['dateOfRegistration']));?></td>
				</tr>
				<tr>
					<td><strong>Mobile No.</strong></td>
					<td><?php echo $customerinfo['mobileno'];?></td>
					<td><strong>E-mail ID</strong></td>
					<td><?php echo $customerinfo['emailid'];?></td>
				</tr>
				<tr>
					<td><strong>Landline No.</strong></td>
					<td><?php echo $customerinfo['landlineno'];?></td>
					<td><strong>Fax No.</strong></td>
					<td><?php echo $customerinfo['faxno'];?></td>
				</tr>
				<tr>
					<td><strong>Residential Address</strong></td>
					<td colspan="3"><?php echo $customerinfo['residential_address'];?></td>
				</tr>
				<tr>
					<td><strong>City</strong></td>
					<td><?php echo $customerinfo['city'];?></td>
					<td><strong>State</strong></td>
					<td><?php echo $customerinfo['state'];?></td>
				</tr>
				<tr>
					<td><strong>Country</strong></td>
					<td><?php echo $customerinfo['country'];?></td>
					<td><strong>Pincode</strong></td>
					<td><?php echo $customerinfo['pincode'];?></td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td colspan="4"><h3>Order Information</h3></td>
				</tr>
				<tr>
					<td><strong>Order No.</strong></td>
					<td><?php echo $orderinfo['order_no'];?></td>
					<td><strong>Order Date</strong></td>
					<td>
						<?php echo date('d-M-Y h:i:s A',strtotime($orderinfo['orderdate']));?>
					</td>
				</tr>
				<tr>
					<td><strong>Invoice No.</strong></td>
					<td>
						<?php
							if($orderinfo['invoice_no']=='')
							echo '<font color="red" size="1">Not Generated</font>';
							else
							echo $orderinfo['invoice_no'];
						?>
					</td>
					<td><strong>Invoice Date</strong></td>
					<td>
						<?php
							if($orderinfo['invoicedate']=='0000-00-00')
							echo '<font color="red" size="1">Not Generated</font>';
							else
							echo date('d-M-Y',strtotime($orderinfo['invoicedate']));
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Name</strong></td>
					<td><?php echo $orderinfo['shipping_firstname'].' '.$orderinfo['shipping_lastname'];?></td>
					<td><strong>Company Name</strong></td>
					<td><?php echo $orderinfo['shipping_company'];?></td>
				</tr>
				<tr>
					<td><strong>Address</strong></td>
					<td colspan="3"><?php echo $orderinfo['shipping_address'];?></td>
				</tr>
				<tr>
					<td><strong>City</strong></td>
					<td><?php echo $orderinfo['shipping_city'];?></td>
					<td><strong>State</strong></td>
					<td><?php echo $orderinfo['shipping_state'];?></td>
				</tr>
				<tr>
					<td><strong>Country</strong></td>
					<td><?php echo $orderinfo['shipping_country'];?></td>
					<td><strong>Pincode</strong></td>
					<td><?php echo $orderinfo['shipping_postcode'];?></td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<th>S.No.</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Shipping Charge</th>
					<th>Total Amount</th>
					<th>Status</th>
				</tr>
				<?php
					$myorders=mysql_query("SELECT * FROM sale_order_products WHERE order_id='$orderinfo[order_no]'")or die(mysql_error());
					if(mysql_num_rows($myorders)>=1)
					{
						$s_no=1;
						while($row=mysql_fetch_array($myorders))
						{
							echo '<tr>
									<td>'.$s_no.'</td>
									<td>'.$row['name'].'</td>
									<td>'.$row['price'].'</td>
									<td>'.$row['quantity'].'</td>
									<td>'.($row['total']-($row['price']*$row['quantity'])).'</td>
									<td>'.$row['total'].'</td>';
							  echo '<td>
										<select name="status" style="font-size:10px;" onchange="changeStatus(\''.$orderinfo['order_no'].'\','.$row['id'].',this.value)">';
											$preorderstatus=mysql_query("SELECT * FROM pre_orderstatus")or die(mysql_error());
											if(mysql_num_rows($preorderstatus)>=1)
											{
												while($starow=mysql_fetch_array($preorderstatus))
												{
													if($starow['status']==$row['status'])
													echo '<option value="'.$starow['status'].'" selected>'.$starow['name'].'</option>';
													else
													echo '<option value="'.$starow['status'].'">'.$starow['name'].'</option>';
												}
											}
									echo '</select>
									</td>
								</tr>';
							$s_no=$s_no+1;
						}
					}
					else
					{
						echo '<tr><td colspan="7"><center><h2>No Orders Found</h2></center></td></tr>';
					}
				?>
			</table>
			<a href="bill.php?orderno=<?php echo $orderinfo['order_no']?>" class="btn btn-info pull-right">Generate Bill</a>
		</div>
           <footer>
				<?php include 'require_extra/footer.php';?>
            </footer>
        </div>
    </div>
    <script src="../setting/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    <script>
    	$(document).ready(function(){
        $('#modal_has').reveal();
		});
    </script>
</body></html>