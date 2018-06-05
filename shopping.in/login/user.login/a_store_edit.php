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
if($_SESSION['permission_administrator']==0)
{
	header("location:home.php?prohibited");
}
$id=mysql_real_escape_string($_GET['id']);
$storeinfo=mysql_query("SELECT * FROM store_master WHERE id='$id'")or die(mysql_error());
if(mysql_num_rows($storeinfo)>=1)
{
	$storeinfo=mysql_fetch_array($storeinfo);
}
else
{
	header("location:a_store.php?msg=store not found");
}
if(isset($_POST['submission']))
{
	$storename=mysql_real_escape_string(strip_tags($_POST['storename']));
	$owner=mysql_real_escape_string(strip_tags($_POST['owner']));
	$contact=mysql_real_escape_string(strip_tags($_POST['contact']));
	$mobile=mysql_real_escape_string(strip_tags($_POST['mobile']));
	$email=mysql_real_escape_string(strip_tags($_POST['email']));
	$address=mysql_real_escape_string(strip_tags($_POST['address']));
	$username=$email;
	$password=md5($mobile);
	$query=mysql_query("UPDATE store_master SET username='$username',password='$password',storename='$storename',ownername='$owner',address='$address',contactno='$contact',mobileno='$mobile',emailid='$email' WHERE id='$id'")or die(mysql_error());
	header("location:a_store.php?msg=Store is successfully registered");
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
	function selectState(myvalue)
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
				document.getElementById("state").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","ajax/state.php?country="+myvalue, true);
		xmlhttp.send();
	}
	function selectCity(myvalue)
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
				document.getElementById("city").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","ajax/district.php?state="+myvalue, true);
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

            <h1 class="page-title">Store Management</h1>
                    <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li class="active">Store Management</li>
        </ul>

        </div>
        <div class="main-content">
			<?php
				if(isset($_GET['referencecode']))
				{
					echo '<font color="#FF0000">Customer is registered successfully. Reference ID is '.$_GET['referencecode'].'</font>';
				}
			?>
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table">
					<tr>
						<th>Store Name</th>
						<td colspan="3"><input type="text" name="storename" class="form-control" value="<?php echo $storeinfo['storename'];?>" autofocus required/></td>
					</tr>
					<tr>
						<th>Owner Name</th>
						<td><input type="text" name="owner" class="form-control" value="<?php echo $storeinfo['ownername'];?>" autofocus required/></td>
						<th>Contact No.</th>
						<td><input type="number" name="contact" class="form-control" value="<?php echo $storeinfo['contactno'];?>" autofocus required/></td>
					</tr>
					<tr>
						<th>Mobile No.</th>
						<td><input type="number" name="mobile" class="form-control" value="<?php echo $storeinfo['mobileno'];?>" autofocus required/></td>
						<th>E-Mail ID</th>
						<td><input type="email" name="email" class="form-control" value="<?php echo $storeinfo['emailid'];?>" autofocus required/></td>
					</tr>
					<tr>
						<th>Address</th>
						<td colspan="3"><textarea name="address" class="form-control" autofocus required/><?php echo $storeinfo['address'];?></textarea></td>
					</tr>
					<tr>
						<td colspan="4"><input type="submit" name="submission" class="btn btn-info pull-right" value="UPDATE"></td>
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