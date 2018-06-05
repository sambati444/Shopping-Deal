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
if($_SESSION['permission_management']==0)
{
	header("location:home.php?prohibited");
}
$productid=mysql_real_escape_string($_GET['id']);
$productinfo=mysql_query("SELECT * FROM manage_product_master WHERE id='$productid'")or die(mysql_error());
if(mysql_num_rows($productinfo)>=1)
{
	$productinfo=mysql_fetch_array($productinfo);
}
else
{
	header("location:product_view.php?msg=Product not found");
}
if(isset($_POST['submission']))
{
	$category=mysql_real_escape_string(strip_tags($_POST['category']));
	$subcategory=mysql_real_escape_string(strip_tags($_POST['subcategory']));
	$modelno=mysql_real_escape_string(strip_tags($_POST['modelno']));
	$productname=mysql_real_escape_string(strip_tags($_POST['productname']));
	$manufacturer=mysql_real_escape_string(strip_tags($_POST['manufacturer']));
	$marketer=mysql_real_escape_string(strip_tags($_POST['marketer']));
	$shippingprice=mysql_real_escape_string(strip_tags($_POST['shippingprice']));
	$saleprice=mysql_real_escape_string(strip_tags($_POST['saleprice']));
	$oldprice=mysql_real_escape_string(strip_tags($_POST['oldprice']));
	$quantity=mysql_real_escape_string(strip_tags($_POST['quantity']));
	$tax=mysql_real_escape_string(strip_tags($_POST['tax']));
	$purchaseprice=mysql_real_escape_string(strip_tags($_POST['purchaseprice']));
	$weight=mysql_real_escape_string(strip_tags($_POST['weight']));
	$weighttype=mysql_real_escape_string(strip_tags($_POST['weighttype']));
	$width=mysql_real_escape_string(strip_tags($_POST['width']));
	$height=mysql_real_escape_string(strip_tags($_POST['height']));
	$lengthtype=mysql_real_escape_string(strip_tags($_POST['lengthtype']));
	$description=mysql_real_escape_string($_POST['description']);
	$special=mysql_real_escape_string($_POST['special']);
	$modifiedAt=date('Y-m-d H:i:s');
	if(isset($_FILES['photo1']['tmp_name'])&&isset($_FILES['photo2']['tmp_name'])&&isset($_FILES['photo3']['tmp_name'])&&isset($_FILES['photo4']['tmp_name']))
	{
		$photo1=$productid.'_1.jpg';
		$photo2=$productid.'_2.jpg';
		$photo3=$productid.'_3.jpg';
		$photo4=$productid.'_4.jpg';
		if(!move_uploaded_file($_FILES['photo1']['tmp_name'],'../product/'.$photo1)&&!move_uploaded_file($_FILES['photo2']['tmp_name'],'../product/'.$photo2)&&!move_uploaded_file($_FILES['photo3']['tmp_name'],'../product/'.$photo3)&&!move_uploaded_file($_FILES['photo4']['tmp_name'],'../product/'.$photo4))
		{
			$query=mysql_query("UPDATE manage_product_master SET category_id='$category',sub_category_id='$subcategory',model_no='$modelno',product_name='$productname',manufactured_by='$manufacturer',marketed_by='$marketer',quantity='$quantity',shipping_price='$shippingprice',sale_price='$saleprice',old_sale_price='$oldprice',tax='$tax',purchase_price='$purchaseprice',weight='$weight',weight_type_id='$weighttype',width='$width',height='$height',length_type_id='$lengthtype',description='$description',lastModifiedAt='$modifiedAt',special='$special' WHERE id='$productid'")or die(mysql_error().'updation 2');
			header("location:product_view.php?msg=success&trigger=2");
		}
		else
		{
			$query=mysql_query("UPDATE manage_product_master SET category_id='$category',sub_category_id='$subcategory',model_no='$modelno',product_name='$productname',manufactured_by='$manufacturer',marketed_by='$marketer',quantity='$quantity',shipping_price='$shippingprice',sale_price='$saleprice',old_sale_price='$oldprice',tax='$tax',purchase_price='$purchaseprice',weight='$weight',weight_type_id='$weighttype',width='$width',height='$height',length_type_id='$lengthtype',description='$description',imgpath1='$photo1',imgpath2='$photo2',imgpath3='$photo3',imgpath4='$photo4',lastModifiedAt='$modifiedAt',special='$special' WHERE id='$productid'")or die(mysql_error().'updation 1');
			header("location:product_view.php?msg=success&trigger=1");
		}
	}
	else
	{
		$query=mysql_query("UPDATE manage_product_master SET category_id='$category',sub_category_id='$subcategory',model_no='$modelno',product_name='$productname',manufactured_by='$manufacturer',marketed_by='$marketer',quantity='$quantity',shipping_price='$shippingprice',sale_price='$saleprice',old_sale_price='$oldprice',tax='$tax',purchase_price='$purchaseprice',weight='$weight',weight_type_id='$weighttype',width='$width',height='$height',length_type_id='$lengthtype',description='$description',lastModifiedAt='$modifiedAt',special='$special' WHERE id='$productid'")or die(mysql_error().'updation 2');
		header("location:product_view.php?msg=success&trigger=2");
	}
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
<body class=" theme-blue" onload="onLoad()">
<!--LOADER AJAX-->
	<script>
		function onLoad()
		{
			document.getElementById("loaderAjax").style.display="none";
		}
	</script>
	<div id="loaderAjax" style="background:#000;z-index:1000;opacity:0.7;position:fixed;height:100%;width:100%;">
		<img src="../setting/images/loading-icons/loading5.gif" style="position:fixed;z-index:3000;top:45%;left:45%;">
	</div>
	<!--END OF LOADER AJAX-->
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
		#abhinav
		{
			color:#FFFFFF;
			padding-top:10px;
			width:200px;
			height:110px;
			border-radius:100px;
			border:1px solid;
			text-align:center;
			text-decoration:none;
		}
		#abhinav:hover
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
	<script>
	function selectSubCategory(myvalue)
	{
		var xmlhttp;
		document.getElementById('loaderAjax').style.display="block";
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}	
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("subcategory").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","ajax/ajax_product_subcategory.php?categoryid="+myvalue, true);
		xmlhttp.send();
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

            <h1 class="page-title">Product</h1>
                    <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li class="active">Add New Product</li>
        </ul>

        </div>
        <div class="main-content">
			<?php
				if(isset($_GET['msg']))
				{
					echo '<font color="#FF0000">Product added successfully!!!</font>';
				}
			?>
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table">
					<tr>
						<th>Category</th>
						<td>
							<select name="category" id="category" class="form-control" onchange="selectSubCategory(this.value)" autofocus required/>
								<option value="">--Select--</option>
								<?php
									$category=mysql_query("SELECT * FROM manage_category WHERE deleted='0'")or die(mysql_error());
									if(mysql_num_rows($category)>=1)
									{
										while($row=mysql_fetch_array($category))
										{
											$menuname=mysql_query("SELECT name FROM manage_menu WHERE id='$row[menu_id]'")or die(mysql_error());
											$menuname=mysql_result($menuname,0,"name");
											if($row['id']==$productinfo['category_id'])
											echo '<option value="'.$row['id'].'" selected/>'.$menuname.'/'.$row['name'].'</option>';
											else
											echo '<option value="'.$row['id'].'">'.$menuname.'/'.$row['name'].'</option>';
										}
									}
								?>
							</select>
						</td>
						<th>Sub-Category</th>
						<td>
							<select name="subcategory" id="subcategory" class="form-control" autofocus required/>
								<?php
								$subcategory=mysql_query("SELECT * FROM manage_subcategory WHERE id='$productinfo[sub_category_id]'")or die(mysql_error());
								if(mysql_num_rows($subcategory))
								{
									while($row=mysql_fetch_array($subcategory))
									{
										$categoryname=mysql_query("SELECT name FROM manage_category WHERE id='$row[category_id]'")or die(mysql_error());
										$categoryname=mysql_result($categoryname,0,"name");
										echo '<option value="'.$row['id'].'">'.$categoryname.'/'.$row['name'].'</option>';
									}
								}
								?>
								<!--DYNAMIC CONTENT-->
							</select>
						</td>
					</tr>
					<tr>
						<th>Product Name</th>
						<td colspan="3"><input type="text" name="productname" class="form-control" value="<?php echo $productinfo['product_name'];?>" autofocus required/></td>
					</tr>
					<tr>
						<th>Model No.</th>
						<td><input type="text" name="modelno" class="form-control" value="<?php echo $productinfo['model_no'];?>" autofocus required/></td>
						<th>Quantity</th>
						<td><input type="number" name="quantity" class="form-control" value="<?php echo $productinfo['quantity'];?>" autofocus required/></td>
					</tr>
					<tr>
						<th>Manufactured By</th>
						<td>
							<select name="manufacturer" class="form-control" autofocus required/>
								<?php
									$manufacturer=mysql_query("SELECT * FROM manage_manufacturer_master WHERE deleted='0'")or die(mysql_error());
									if(mysql_num_rows($manufacturer)>=1)
									{
										echo '<option value="">Select</option>';
										while($row=mysql_fetch_array($manufacturer))
										{
											if($row['id']==$productinfo['manufactured_by'])
											echo '<option value="'.$row['id'].'" selected/>'.$row['name'].'</option>';
											else
											echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
										}
									}
								?>
							</select>
						</td>
						<th>Marketed By</th>
						<td>
							<select name="marketer" class="form-control" autofocus required/>
								<?php
									$manufacturer=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE deleted='0'")or die(mysql_error());
									if(mysql_num_rows($manufacturer)>=1)
									{
										echo '<option value="">Select</option>';
										while($row=mysql_fetch_array($manufacturer))
										{
											if($row['id']==$productinfo['marketed_by'])
											echo '<option value="'.$row['id'].'" selected/>'.$row['name'].'</option>';
											else
											echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>Old Sale Price</th>
						<td><input type="text" name="oldprice" class="form-control" value="<?php echo $productinfo['old_sale_price'];?>" autofocus required/></td>
						<th>Sale Price</th>
						<td><input type="text" name="saleprice" class="form-control" value="<?php echo $productinfo['sale_price'];?>" autofocus required/></td>
					</tr>
					<tr>
						<th>Shipping Price</th>
						<td><input type="text" name="shippingprice" class="form-control" value="<?php echo $productinfo['shipping_price'];?>" autofocus required/></td>
						<th>Tax</th>
						<td>
							<select name="tax" class="form-control" autofocus required/>
								<option value="">--Select--</option>
								<?php
									$tax=mysql_query("SELECT * FROM manage_tax_type WHERE deleted='0'")or die(mysql_error().'tax type');
									if(mysql_num_rows($tax)>=1)
									{
										while($row=mysql_fetch_array($tax))
										{
											if($row['tax']==$productinfo['tax'])
											echo '<option value="'.$row['tax'].'" selected/>'.$row['name'].'('.$row['tax'].'%)</option>';
											else
											echo '<option value="'.$row['tax'].'">'.$row['name'].'('.$row['tax'].'%)</option>';
										}
									}
								?>
							</select>
						</td>
					<tr>
						<th>Purchase Price</th>
						<td><input type="text" name="purchaseprice" class="form-control" value="<?php echo $productinfo['purchase_price'];?>" autofocus required/></td>
						<th>Weight</th>
						<td><input type="text" name="weight" class="form-control" value="<?php echo $productinfo['weight'];?>" autofocus required/></td>
					</tr>
					<tr>
						<th>Weight type</th>
						<td>
							<select name="weighttype" class="form-control" autofocus required/>
								<option value="">Select</option>
								<?php
									$weighttype=mysql_query("SELECT * FROM manage_weight_type WHERE deleted='0'")or die(mysql_error());
									if(mysql_num_rows($weighttype)>=1)
									{
										while($row=mysql_fetch_array($weighttype))
										{
											if($row['id']==$productinfo['weight_type_id'])
											echo '<option value="'.$row['id'].'" selected/>'.$row['name'].'</option>';
											else
											echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
										}
									}
								?>
							</select>
						</td>
						<th>Width</th>
						<td><input type="text" name="width" class="form-control" value="<?php echo $productinfo['width'];?>" autofocus required/></td>
					</tr>
					<tr>
						<th>Height</th>
						<td><input type="text" name="height" class="form-control" value="<?php echo $productinfo['height'];?>" autofocus required/></td>
						<th>Length type</th>
						<td>
							<select name="lengthtype" class="form-control" autofocus required/>
								<option value="">Select</option>
								<?php
									$weighttype=mysql_query("SELECT * FROM manage_length_type WHERE deleted='0'")or die(mysql_error());
									if(mysql_num_rows($weighttype)>=1)
									{
										while($row=mysql_fetch_array($weighttype))
										{
											if($row['id']==$productinfo['weight_type_id'])
											echo '<option value="'.$row['id'].'" selected/>'.$row['name'].'</option>';
											else
											echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>Description</th>
						<td><textarea class="form-control" name="description"><?php echo $productinfo['description'];?></textarea></td>
						<th>Special</th>
						<td>
							<select class="form-control" name="special">
								<?php
								if($productinfo['special']==0)
								{
									echo '<option value="0" selected/>No</option>
									<option value="1">Yes</option>';
								}
								else
								{
									echo '<option value="0">No</option>
									<option value="1" selected/>Yes</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>Photo (1)</th>
						<th><input type="file" class="form-control" name="photo1" accept="image/*"></th>
						<th>Photo (2)</th>
						<th><input type="file" class="form-control" name="photo2" accept="image/*"></th>
					</tr>
					<tr>
						<th>Photo (3)</th>
						<th><input type="file" class="form-control" name="photo3" accept="image/*"></th>
						<th>Photo (4)</th>
						<th><input type="file" class="form-control" name="photo4" accept="image/*"></th>
					</tr>
					<tr>
						<td colspan="4"><input type="submit" name="submission" class="btn btn-info pull-right" value="EDIT PRODUCT"></td>
					</tr>
				</table>
			</form>
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