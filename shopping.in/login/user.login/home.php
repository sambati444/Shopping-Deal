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
		#row1,#row2{height:124px;}
		.abhinav
		{
			color:#FFFFFF;
			padding-top:10px;
			width:33%;
			height:110px;
			border:1px solid;
			text-align:center;
			text-decoration:none;
			float:left;
		}
		.abhinav2
		{
			color:#FFFFFF;
			padding-top:10px;
			width:20%;
			height:110px;
			border:1px solid;
			text-align:center;
			text-decoration:none;
			float:left;
		}
		.abhinav:hover,.abhinav2:hover
		{
			box-shadow:2px 10px 20px #333;
		}
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
            <h1 class="page-title"></h1>
            <ul class="breadcrumb">
				<li><a href="home.php"></a></li>
				<li class="active"></li>
			</ul>
        </div>
        <div class="main-content" style="margin-bottom:140px;">
			<?php
				$totalcustomer=mysql_query("SELECT id FROM customer_master WHERE deleted='0'")or die(mysql_error());
				$totalcustomer=mysql_num_rows($totalcustomer);
				$activecustomer=mysql_query("SELECT id FROM customer_master WHERE deleted='0' AND status='1'")or die(mysql_error());
				$activecustomer=mysql_num_rows($activecustomer);
				$inactivecustomer=mysql_query("SELECT id FROM customer_master WHERE deleted='0' AND status='0'")or die(mysql_error());
				$inactivecustomer=mysql_num_rows($inactivecustomer);
				/*================================================*/
				$totalorder=mysql_query("SELECT order_id FROM sale_order")or die(mysql_error());
				$totalorder=mysql_num_rows($totalorder);
				$neworder=mysql_query("SELECT order_id FROM sale_order_products WHERE status='NEW'")or die(mysql_error());
				$neworder=mysql_num_rows($neworder);
				$waitingorder=mysql_query("SELECT order_id FROM sale_order_products WHERE status='PENDING'")or die(mysql_error());
				$waitingorder=mysql_num_rows($waitingorder);
				$dispatchedorder=mysql_query("SELECT order_id FROM sale_order_products WHERE status='DISPATCH'")or die(mysql_error());
				$dispatchedorder=mysql_num_rows($dispatchedorder);
				$cancelledorder=mysql_query("SELECT order_id FROM sale_order_products WHERE status='CANCEL'")or die(mysql_error());
				$cancelledorder=mysql_num_rows($cancelledorder);
				$inactiveproduct=mysql_query("SELECT id FROM manage_product_master WHERE status='0' AND deleted='0'")or die(mysql_error());
				$inactiveproduct=mysql_num_rows($inactiveproduct);
				$ownproduct=mysql_query("SELECT id FROM manage_product_master WHERE store_id='0' AND deleted='0'")or die(mysql_error());
				$ownproduct=mysql_num_rows($ownproduct);
				$storeproduct=mysql_query("SELECT id FROM manage_product_master WHERE store_id!='0' AND deleted='0'")or die(mysql_error());
				$storeproduct=mysql_num_rows($storeproduct);
			?>
			<div id="dashboard">
				<div id="row1">
					<a href="customerinfo.php?"><div class="abhinav" style="background:#FF99CC;">Total Customers<h3><?php echo $totalcustomer;?></h3></div></a>
					<a href="customerinfo.php?"><div class="abhinav" style="background:#08C000;">Active Customers<h3><?php echo $activecustomer;?></h3></div></a>
					<a href="customerinfo.php?"><div class="abhinav" style="background:#FF0000;">Inactive Customers<h3><?php echo $inactivecustomer;?></h3></div></a>
				</div>
				<div id="row2">
					<a href="sales.php?orderno=&status=&city=&state=&sdate=&edate=&search=Search"><div class="abhinav2" style="background:#FF99CC;">Total Orders<h3><?php echo $totalorder;?></h3></div></a>
					<a href="sales.php?orderno=&status=NEW&city=&state=&sdate=&edate=&search=Search"><div class="abhinav2" style="background:#FF9900;">New Orders<h3><?php echo $neworder;?></h3></div></a>
					<a href="sales.php?orderno=&status=PENDING&city=&state=&sdate=&edate=&search=Search"><div class="abhinav2" style="background:#CC33CC;">Waiting Orders<h3><?php echo $waitingorder;?></h3></div></a>
					<a href="sales.php?orderno=&status=DISPATCH&city=&state=&sdate=&edate=&search=Search"><div class="abhinav2" style="background:#08C000;">Dispatched Orders<h3><?php echo $dispatchedorder;?></h3></div></a>
					<a href="saels.php?orderno=&status=CANCEL&city=&state=&sdate=&edate=&search=Search"><div class="abhinav2" style="background:#FF0000;">Cancelled Orders<h3><?php echo $cancelledorder;?></h3></div></a>
				</div>
				<div id="row1">
					<a href="product_viewinactive.php?"><div class="abhinav" style="background:#FF99CC;">Total Inctive Products<h3><?php echo $inactiveproduct;?></h3></div></a>
					<a href="product_viewown.php?"><div class="abhinav" style="background:#08C000;">Own Products<h3><?php echo $ownproduct;?></h3></div></a>
					<a href="product_viewstore.php?"><div class="abhinav" style="background:#FF0000;">Store Products<h3><?php echo $storeproduct;?></h3></div></a>
				</div>
			</div>
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
<?php mysql_close();?>