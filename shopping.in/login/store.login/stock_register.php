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
?>
<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title><?php echo $companytitle['company_name'].'&nbsp;||&nbsp;'.$_SESSION['storename'];?></title>
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
		function actionProduct(action,id)
		{
			if(action=='status')
			{
				var ans=confirm("Are you want to change status");
				if(ans)
				{
					window.location="product_status.php?id="+id;
				}
			}
			else if(action=='edit')
			{
				var ans=confirm("Are you want to edit this product");
				if(ans)
				{
					window.location="product_edit.php?id="+id;
				}
			}
			else if(action=='delete')
			{
				var ans=confirm("Are you want to delete this product");
				if(ans)
				{
					window.location="product_delete.php?id="+id;
				}
			}
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
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span><?php echo $_SESSION['ownername'];?>
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
                <li><a href="user.php">My Account</a></li>
                <li class="divider"></li>
				<li><a href="#"><?php echo $_SESSION['storename'];?></a></li>
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

            <h1 class="page-title">Products</h1>
                    <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li class="active">Product Management</li>
        </ul>

        </div>
        <div class="main-content">
			<table class="table">
				<tr>
					<th width="5%">S.No.</th>
					<th width="10%">Model No.</th>
					<th width="10%">Category</th>
					<th width="15%">Sub-Category</th>
					<th width="40%">Product</th>
					<th width="20%">Availability</th>
				</tr>
				<?php
					$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE store_id='$_SESSION[storeid]' AND deleted='0'")or die(mysql_error());
					if(mysql_num_rows($productinfo)>=1)
					{
						$s_no=1;
						while($row=mysql_fetch_array($productinfo))
						{
							echo '<tr>
								<td width="5%">'.$s_no.'</td>
								<td width="10%">'.$row['model_no'].'</td>';
								$category=mysql_query("SELECT * FROM manage_category WHERE id='$row[category_id]'")or die(mysql_error().'category');
								$category=mysql_fetch_array($category);
								$category=$category['name'];
								echo '<td width="10%">'.$category.'</td>';
								$subcategory=mysql_query("SELECT * FROM manage_subcategory WHERE id='$row[sub_category_id]'")or die(mysql_error().'category');
								$subcategory=mysql_fetch_array($subcategory);
								$subcategory=$subcategory['name'];
								echo '<td width="15%">'.$subcategory.'</td>';
								echo '<td width="40%">'.$row['product_name'].'</td>';
								/*CALCULATION OF AVAILABILITY*/
								$totalpurchase=0;
								$totalsale=0;
									/*PURCHASE*/
								$purchase=mysql_query("SELECT quantity FROM purchase_record WHERE product_id='$row[id]'")or die(mysql_error());
								if(mysql_num_rows($purchase)>=1)
								{
									while($purchaserow=mysql_fetch_array($purchase))
									{
										$totalpurchase=$totalpurchase+$purchaserow['quantity'];
									}
								}
									/*SALE*/
								$sale=mysql_query("SELECT * FROM sale_order_products WHERE product_id='$row[id]' AND status='DISPATCH'")or die(mysql_error());
								if(mysql_num_rows($sale)>=1)
								{
									while($salerow=mysql_fetch_array($sale))
									{
										$billrecord=mysql_query("SELECT invoice_no FROM sale_order WHERE order_no='$salerow[order_id]' AND invoice_no!=''")or die(mysql_error());
										if(mysql_num_rows($billrecord)>=1)
										{
											$totalsale=$totalsale+$salerow['quantity'];
										}
									}
								}
								$availability=$totalpurchase-$totalsale;
								/*END OF CALCULATION OF AVAILABILITY*/
								echo '<td width="20%">'.$availability.'</td>
							</tr>';
							$s_no=$s_no+1;
						}
					}
				?>
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