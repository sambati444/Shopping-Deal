<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
include '../connect.php';
include 'require_extra/company_title.php';
/*LOGIN VALIDATION*/
if($_SESSION['storename']=='')
{
	header("location:../index.php");
}
$userinfo=mysql_query("SELECT * FROM store_master WHERE id='$_SESSION[storeid]'")or die(mysql_error());
if(mysql_num_rows($userinfo)>=1)
{
	$userinfo=mysql_fetch_array($userinfo);
}
if(isset($_POST['password']))
{
	$old=md5(mysql_real_escape_string($_POST['old']));
	$new=md5(mysql_real_escape_string($_POST['new']));
	$re=md5(mysql_real_escape_string($_POST['re']));
	if($old==$userinfo['password'])
	{
		if($new==$re)
		{
			$passwordupdation=mysql_query("UPDATE store_master SET password='$new' WHERE id='$_SESSION[storeid]'")or die(mysql_error());
			if($passwordupdation)
			{
				header("location:user.php?msg=Password changed successfully!!!");
			}
			else
			{
				header("location:user.php?msg=Sorry!!!Password not changed.");
			}
		}
		else
		{
			header("location:user.php?msg=Password not matched! Try again.");
		}
	}
	else
	{
		header("location:user.php?msg=Wrong old password!!!");
	}
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
            
            <h1 class="page-title">Edit Administrator Profile</h1>
                    <ul class="breadcrumb">
            <li><a href="home.php">Home</a> </li>
            <li class="active">Profile</li>
        </ul>
<?php if(isset($_GET['msg'])){echo '<font color="red">'.$_GET['msg'].'</font>';}?>
        </div>
        <div class="main-content">
            
<ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
  <li><a href="#profile" data-toggle="tab">Password</a></li>
</ul>

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
		<div class="form-group">
			<div class="contentAIS">User Name</div>
			<div class="contentAIS"><b><?php echo $userinfo['username'];?></b></div>
        </div>
        <div class="form-group">
			<div class="contentAIS">Store Name</div>
			<div class="contentAIS"><b><?php echo $userinfo['storename'];?></b></div>
        </div>
		<div class="form-group">
			<div class="contentAIS">Owner Name</div>
			<div class="contentAIS"><b><?php echo $userinfo['ownername'];?></b></div>
        </div>
        <div class="form-group">
			<div class="contentAIS">Contact No.</div>
			<div class="contentAIS"><b><?php echo $userinfo['contactno'];?></b></div>
        </div>
 		<div class="form-group">
			<div class="contentAIS">E-mail ID</div>
			<div class="contentAIS"><b><?php echo $userinfo['emailid'];?></b></div>
        </div>
		<div class="form-group">
			<div class="contentAIS">Address</div>
			<div class="contentAIS"><b><?php echo $userinfo['address']?></b></div>
        </div>
      </div>

      <div class="tab-pane fade" id="profile">

        <form id="tab2" action="user.php" method="post">
          <div class="form-group">
            <label>Old Password</label>
            <input type="password" name="old" class="form-control" placeholder="********">
          </div>
		  <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new" class="form-control" placeholder="********">
          </div>
		  <div class="form-group">
            <label>Re-Enter New Password</label>
            <input type="password" name="re" class="form-control" placeholder="********">
          </div>
          <div class="toolbar list-toolbar">
              <input type="submit" class="btn btn-primary" name="password" value="Change Password">
			<input type="reset" class="btn btn-danger" name="reset" value="Reset">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
      </div>
      <div class="modal-body">
        
        <p class="error-text"><i class="fa fa-warning modal-icon"></i>Are you sure you want to delete the user?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>


            <footer style="margin-top:240px;">
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
    
  
</body></html>
