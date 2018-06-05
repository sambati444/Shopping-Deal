<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
include '../connect.php';
include 'require_extra/company_title.php';
/*LOGIN VALIDATION*/
if($_SESSION['myusername']=='')
{
	header("location:../index.php");
}
$userinfo=mysql_query("SELECT * FROM ais_users WHERE id='$_SESSION[myuserid]'")or die(mysql_error());
if(mysql_num_rows($userinfo)>=1)
{
	$userinfo=mysql_fetch_array($userinfo);
}
/*=================PROFILE UPDATION=================*/
if(isset($_POST['profile']))
{
	$username=mysql_real_escape_string(strip_tags($_POST['username']));
	$fullname=mysql_real_escape_string(strip_tags($_POST['fullname']));
	$fathername=mysql_real_escape_string(strip_tags($_POST['fathername']));
	$contactno=mysql_real_escape_string(strip_tags($_POST['contactno']));
	$emailid=mysql_real_escape_string(strip_tags($_POST['emailid']));
	$perm_address=mysql_real_escape_string(strip_tags($_POST['perm_address']));
	$resi_address=mysql_real_escape_string(strip_tags($_POST['resi_address']));
	$country=mysql_real_escape_string(strip_tags($_POST['country']));
	$state=mysql_real_escape_string(strip_tags($_POST['state']));
	$city=mysql_real_escape_string(strip_tags($_POST['city']));
	$pincode=mysql_real_escape_string(strip_tags($_POST['pincode']));
	/*==UPDATION QUERY IM MYSQL==*/
	$query=mysql_query("UPDATE ais_users SET username='$username',name='$fullname',fathername='$fathername',contactno='$contactno',emailid='$emailid',permanent_address='$perm_address',residential_address='$resi_address',country='$country',state='$state',city='$city',pincode='$pincode' WHERE id='$_SESSION[myuserid]'")or die(mysql_error().'Error in profile updation');
	header("location:user.php");
}
/*=================PROFILE UPDATION=================*/
/*=================PASSWORD UPDATION=================*/
if(isset($_POST['password']))
{
	$old=md5(mysql_real_escape_string($_POST['old']));
	$new=md5(mysql_real_escape_string($_POST['new']));
	$re=md5(mysql_real_escape_string($_POST['re']));
	if($old==$userinfo['password'])
	{
		if($new==$re)
		{
			$passwordupdation=mysql_query("UPDATE ais_users SET password='$new' WHERE id='$_SESSION[myuserid]'")or die(mysql_error());
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
/*=================PASSWORD UPDATION=================*/
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

</head>
<body class=" theme-blue">
<!--LOADER AJAX-->
	<script>
		function onLoad()
		{
			document.getElementById("loaderAjax").style.display="none";
		}
	</script>
	<div id="loaderAjax" style="display:none;background:#000;z-index:1000;opacity:0.7;position:fixed;height:100%;width:100%;">
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
            
            <h1 class="page-title"><?php if($_SESSION['usertype']=='ADMIN'){ echo 'Administrator Profile';}else{ echo 'User Profile';}?></h1>
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
	  <?php
		if($_SESSION['usertype']!='ADMIN')
		{
			echo '<div class="form-group">
				<div class="contentAIS">User Name</div>
				<div class="contentAIS"><b>'.$userinfo['username'].'</b></div>
			</div>
			<div class="form-group">
				<div class="contentAIS">Full Name</div>
				<div class="contentAIS"><b>'.$userinfo['name'].'</b></div>
			</div>
			<div class="form-group">
				<div class="contentAIS">Father Name</div>
				<div class="contentAIS"><b>'.$userinfo['fathername'].'</b></div>
			</div>
			<div class="form-group">
				<div class="contentAIS">Contact No.</div>
				<div class="contentAIS"><b>'.$userinfo['contactno'].'</b></div>
			</div>
			<div class="form-group">
				<div class="contentAIS">E-mail ID</div>
				<div class="contentAIS"><b>'.$userinfo['emailid'].'</b></div>
			</div>
			<div class="form-group">
				<div class="contentAIS">Residential Address</div>
				<div class="contentAIS"><b>'.$userinfo['residential_address'].'</b></div>
			</div>
			<div class="form-group">
				<div class="contentAIS">Permanent Address</div>
				<div class="contentAIS"><b>'.$userinfo['permanent_address'].'</b></div>
			</div>
			<div class="form-group">
				<div class="contentAIS">Current City/State/Country/Pincode</div>
				<div class="contentAIS"><b>'.$userinfo['city'].'&nbsp;/&nbsp;'.$userinfo['state'].'&nbsp;/&nbsp;'.$userinfo['country'].'&nbsp;/&nbsp;'.$userinfo['pincode'].'</b></div>
			</div>';
		}
		else
		{
			echo '<form id="tab1" action="" method="post">
				  <div class="form-group">
						<label>User Name
						<input type="text" name="username" id="username" class="form-control" value="'.$userinfo['username'].'" readonly/>
						</label>
				  </div>
				  <div class="form-group">
						<label>Full Name
						<input type="text" name="fullname" id="fullname" value="'.$userinfo['name'].'" class="form-control">
						</label>
				  </div>
				  <div class="form-group">
						<label>Father Name
						<input type="text" name="fathername" id="fathername" value="'.$userinfo['fathername'].'" class="form-control">
						</label>
				  </div>
				  <div class="form-group">
						<label>Contact No.
						<input type="text" name="contactno" id="contactno" value="'.$userinfo['contactno'].'" class="form-control">
						</label>
				  </div>
				  <div class="form-group">
						<label>E-Mail ID
						<input type="text" name="emailid" id="emailid" value="'.$userinfo['emailid'].'" class="form-control">
						</label>
				  </div>
				  <div class="form-group">
						<label>Permanent Address
						<textarea name="perm_address" id="perm_address" class="form-control">'.$userinfo['permanent_address'].'</textarea>
						</label>
				  </div>
				  <div class="form-group">
						<label>Residential Address
						<textarea name="resi_address" id="resi_address" class="form-control">'.$userinfo['residential_address'].'</textarea>
						</label>
				  </div>
				  <div class="form-group">
						<label>Country
						<select name="country" id="country" class="form-control" onchange="selectState(this.value)">
							<option value="">Select</option>';
							$countryinfo=mysql_query("SELECT DISTINCT(country) FROM pre_area")or die(mysql_error());
							if(mysql_num_rows($countryinfo)>=1)
							{
								while($row=mysql_fetch_array($countryinfo))
								{
									if($row['country']==$userinfo['country'])
									echo '<option value="'.$row['country'].'" selected>'.$row['country'].'</option>';
									else
									echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
								}
							}
				 echo '</select>
						</label>
				  </div>
				  <div class="form-group">
						<label>State
						<select name="state" id="state" class="form-control" onchange="selectCity(this.value)">
							<option value="'.$userinfo['state'].'">'.$userinfo['state'].'</option>
						</select>
						</label>
				  </div>
				  <div class="form-group">
						<label>City
						<select name="city" id="city" class="form-control">
							<option value="'.$userinfo['city'].'">'.$userinfo['city'].'</option>
						</select>
						</label>
				  </div>
				  <div class="form-group">
						<label>Pincode
						<input type="text" name="pincode" id="pincode" value="'.$userinfo['pincode'].'" class="form-control">
						</label>
				  </div>
				  <div class="toolbar list-toolbar">
					  <input type="submit" class="btn btn-primary" name="profile" value="Change Profile">
				  </div>
				 </form>';
		}
		?>
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
