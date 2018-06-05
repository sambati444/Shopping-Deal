<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
include 'connect.php';
include 'user.login/require_extra/company_title.php';
if(isset($_POST['submit']))
{
	$username=mysql_real_escape_string(strip_tags($_POST['user']));
	$password=mysql_real_escape_string(md5($_POST['password']));
	$find=mysql_query("SELECT * FROM ais_users WHERE username='$username' AND password='$password' AND status='1' AND deleted='0'");
	if(mysql_num_rows($find))
	{
		$_SESSION['myuserid']=mysql_result($find,0,"id");
		$_SESSION['myusername']=mysql_result($find,0,"username");
		$_SESSION['myname']=mysql_result($find,0,"name");
		$_SESSION['mymailid']=mysql_result($find,0,"emailid");
		$_SESSION['usertype']=mysql_result($find,0,"usertype");
		/*ACCESS PERMISSION*/
		if($_SESSION['usertype']=='ADMIN')
		{
			$_SESSION['permission_administrator']=1;
			$_SESSION['permission_management']=1;
			$_SESSION['permission_sales']=1;
			$_SESSION['permission_purchase']=1;
			$_SESSION['permission_stock']=1;
			$_SESSION['permission_account']=1;
		}
		else if($_SESSION['usertype']=='USER')
		{
			$userpermission=mysql_query("SELECT * FROM ais_users_permissions WHERE id='$_SESSION[myuserid]'")or die(mysql_error().'Cant fetch user permissions');
			if(mysql_num_rows($userpermission)>=1)
			{
				$_SESSION['permission_administrator']=mysql_result($userpermission,0,"administrator");
				$_SESSION['permission_management']=mysql_result($userpermission,0,"management");
				$_SESSION['permission_sales']=mysql_result($userpermission,0,"sales");
				$_SESSION['permission_purchase']=mysql_result($userpermission,0,"purchase");
				$_SESSION['permission_stock']=mysql_result($userpermission,0,"stock");
				$_SESSION['permission_account']=mysql_result($userpermission,0,"account");
			}
			else
			{
				session_destroy();
				header("location:index.php?msg=Error generated");
			}
		}
		$date=date('Y-m-d H:i:s');
		$ipaddress=$_SERVER['REMOTE_ADDR'];
		$browser=$_SERVER['HTTP_USER_AGENT'];
		$loginrecordid=mysql_query("SELECT MAX(id) FROM ais_login_record")or die(mysql_error());
		$loginrecordid=mysql_fetch_array($loginrecordid);
		$loginrecordid=$loginrecordid[0]+1;
		$loginrecord=mysql_query("INSERT INTO ais_login_record VALUES('$loginrecordid','$_SESSION[myuserid]','LOGIN','$date','$ipaddress','$browser')")or die(mysql_error());
		header("location:user.login/home.php?success");
	}
	else
	{
		$find=mysql_query("SELECT * FROM store_master WHERE username='$username' AND password='$password' AND deleted='0'");
		if(mysql_num_rows($find))
		{
			if(mysql_result($find,0,"status")==1)	
			{
				$_SESSION['storeid']=mysql_result($find,0,"id");
				$_SESSION['storename']=mysql_result($find,0,"storename");
				$_SESSION['ownername']=mysql_result($find,0,"ownername");
				$_SESSION['storeusername']=mysql_result($find,0,"username");
				header("location:store.login/");
			}
			else
			{
				header("location:index.php?msg=Store is inactive. Please contact your administrator");
			}
		}
		else
		{
			header("location:index.php?User does not exist");
		}
	}
}
?>
<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title><?php echo $companytitle['company_name'];?>||E-Commerce</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="setting/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="setting/lib/font-awesome/css/font-awesome.css">

    <script src="setting/lib/jquery-1.11.1.min.js" type="text/javascript"></script>

    

    <link rel="stylesheet" type="text/css" href="setting/stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="setting/stylesheets/premium.css">

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
          <a class="" href="#"><span class="navbar-brand"><font style="font-family: 'Playball', cursive;color:#fff;" size="6"><?php echo $companytitle['company_name'];?></font></span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">

        </div>
      </div>
    </div>
    


        <div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Sign In</p><?php if(isset($_GET['msg'])){echo '<font color="red">'.$_GET['msg'].'</font>';}?>
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="user" class="form-control span12">
                </div>
                <div class="form-group">
                <label>Password</label>
                    <input type="password" name="password" class="form-controlspan12 form-control">
                </div>
                <input type="submit" name="submit" value="Login" class="btn btn-primary pull-right">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
	
    <p class="pull-right" style=""><a href="javascript:void()" style="font-size: 1.1em; margin-top: .25em;">Forgot Password</a></p>
</div>



    <script src="setting/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  
</body></html>
