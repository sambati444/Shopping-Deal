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
if($_SESSION['permission_sales']==0)
{
	header("location:home.php?prohibited");
}
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
		<script src="../setting/gridtable/jquery.min.js"></script>
	<link rel="stylesheet" href="../setting/gridtable/jquery.dataTables.min.css">
	<script type="text/javascript" src="../setting/gridtable/jquery.dataTables.min.js"></script>
	<script>
	$(document).ready(function(){
		$('#myTable').dataTable();
	});
	</script>
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
		.sear{width:200px;height:28px;border-radius:3px;}
    </style>
    <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
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

            <h1 class="page-title">Sales</h1>
                    <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li class="active">Sales Management</li>
        </ul>

        </div>
        <div class="main-content">
			<div id="advanceDiv" style="padding-bottom:40px;">
				<form action="" method="get">
					<table>
						<tr>
							<th>Order No.</th>
							<td><input type="text" class="sear" name="orderno"></td>
							<th>Order Status</th>
							<td>
								<select class="sear" name="status">
									<option value="">--Select--</option>
									<option value="DISPATCH">Dispatched</option>
								</select>
							</td>
							<th>City</th>
							<td>
								<select name="city" class="sear">
									<option value="">--Select--</option>
									<?php
										$city=mysql_query("SELECT DISTINCT(district) FROM pre_area ORDER BY district")or die(mysql_error());
										if(mysql_num_rows($city)>=1)
										{
											while($row=mysql_fetch_array($city))
											{
												echo '<option value="'.$row['district'].'">'.$row['district'].'</option>';
											}
										}
									?>
								</select>
							</td>
							<th>State</th>
							<td>
								<select name="state" class="sear">
									<option value="">--Select--</option>
									<?php
										$city=mysql_query("SELECT DISTINCT(state) FROM pre_area ORDER BY state")or die(mysql_error());
										if(mysql_num_rows($city)>=1)
										{
											while($row=mysql_fetch_array($city))
											{
												echo '<option value="'.$row['state'].'">'.$row['state'].'</option>';
											}
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<th>Start Date</th>
							<td><input type="text" name="sdate" class="sear"></td>
							<th>End Date</th>
							<td><input type="text" name="edate" class="sear"></td>
							<th>&nbsp;</th>
							<td><input type="submit" name="search" class="btn btn-info" value="Search"></td>
							<td colspan="2">&nbsp;</td>
						</tr>
					</table>
				</form>
			</div>
			<table id="myTable" class="display table">
				<thead>
				<tr>
					<th>S.No.</th>
					<th>Order No.</th>
					<th>Order Date</th>
					<th>Shipping City</th>
					<th>Shipping State</th>
					<th>Total Amount</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				</tbody>
				<?php
				if(isset($_GET['search']))
				{
					$orderno=mysql_real_escape_string(strip_tags($_GET['orderno']));
					$status=mysql_real_escape_string(strip_tags($_GET['status']));
					$city=mysql_real_escape_string(strip_tags($_GET['city']));
					$state=mysql_real_escape_string(strip_tags($_GET['state']));
					/*================*/
					if($_GET['sdate']!='')
					$sdate=date('Y-m-d H:i:s',strtotime($_GET['sdate']));
					else
					$sdate='';
					/*================*/
					if($_GET['edate']!='')
					$edate=date('Y-m-d H:i:s',strtotime($_GET['edate']));
					else
					$edate='';
					/*================*/
					if(!empty($orderno)&&empty($status)&&empty($city)&&empty($state)&&empty($sdate)&&empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND order_no='$orderno' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}
					else if(empty($orderno)&&!empty($status)&&empty($city)&&empty($state)&&empty($sdate)&&empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								$orderproduct=mysql_query("SELECT id FROM sale_order_products WHERE status='$status' AND order_id='$row[order_no]'")or die(mysql_error());
								if(mysql_num_rows($orderproduct))
								{
									echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
								}
							}
						}
					}
					else if(empty($orderno)&&empty($status)&&!empty($city)&&empty($state)&&empty($sdate)&&empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND shipping_city='$city' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}
					else if(empty($orderno)&&empty($status)&&empty($city)&&!empty($state)&&empty($sdate)&&empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND shipping_state='$state' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}
					else if(empty($orderno)&&empty($status)&&empty($city)&&empty($state)&&!empty($sdate)&&empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND orderdate='$sdate' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}
					else if(empty($orderno)&&empty($status)&&empty($city)&&empty($state)&&!empty($sdate)&&!empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND orderdate BETWEEN '$sdate' AND '$edate' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}
					else if(empty($orderno)&&!empty($status)&&empty($city)&&empty($state)&&!empty($sdate)&&empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND orderdate='$sdate' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								$orderproduct=mysql_query("SELECT id FROM sale_order_products WHERE status='$status' AND order_id='$row[order_no]'")or die(mysql_error());
								if(mysql_num_rows($orderproduct))
								{
									echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
								}
							}
						}
					}
					else if(empty($orderno)&&!empty($status)&&empty($city)&&empty($state)&&!empty($sdate)&&!empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND orderdate BETWEEN '$sdate' AND '$edate' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								$orderproduct=mysql_query("SELECT id FROM sale_order_products WHERE status='$status' AND order_id='$row[order_no]'")or die(mysql_error());
								if(mysql_num_rows($orderproduct))
								{
									echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
								}
							}
						}
					}
					else if(empty($orderno)&&empty($status)&&!empty($city)&&empty($state)&&!empty($sdate)&&empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND shipping_city='$city' AND orderdate='$sdate' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}
					else if(empty($orderno)&&empty($status)&&!empty($city)&&empty($state)&&!empty($sdate)&&!empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND shipping_city='$city' AND orderdate BETWEEN '$sdate' AND '$edate' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}
					else if(empty($orderno)&&empty($status)&&empty($city)&&!empty($state)&&!empty($sdate)&&empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND shipping_state='$state' AND orderdate='$sdate' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}
					else if(empty($orderno)&&empty($status)&&empty($city)&&!empty($state)&&!empty($sdate)&&!empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' AND shipping_state='$state' AND orderdate BETWEEN '$sdate' AND '$edate' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}
					else if(empty($orderno)&&empty($status)&&empty($city)&&empty($state)&&empty($sdate)&&empty($edate))
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}/*END FULL SEARCH WITH CONDITION*/
					else
					{
						$query=mysql_query("SELECT * FROM sale_order WHERE invoice_no!='' ORDER BY orderdate")or die(mysql_error());
						if(mysql_num_rows($query)>=1)
						{
							$sno=1;
							while($row=mysql_fetch_array($query))
							{
								echo '<tr>
										<td>'.$sno.'</td>
										<td>'.$row['order_no'].'</td>
										<td>'.date('d-M-Y h:i:s A',strtotime($row['orderdate'])).'</td>
										<td>'.$row['shipping_city'].'</td>
										<td>'.$row['shipping_state'].'</td>
										<td>'.$row['total'].'</td>
										<td><a href="bill.php?orderno='.$row['order_no'].'" target="_blank" class="btn btn-info">Bill</a></td>
									</tr>';
									$sno=$sno+1;
							}
						}
					}/*END FULL SEARCH WITH OUT CONDITION*/
				}/*END OF SEARCH BUTTON*/
				?>
				</tbody>
			</table>
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