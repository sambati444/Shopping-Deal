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
		function actionForUser(action,id)
		{
			if(action=='access')
			{
				var ans=confirm("Are you want to change access permission");
				if(ans)
				{
					window.location="a_user_permission.php?id="+id;
				}
			}
			if(action=='status')
			{
				var ans=confirm("Are you want to change status");
				if(ans)
				{
					window.location="a_user_status.php?id="+id;
				}
			}
			else if(action=='edit')
			{
				var ans=confirm("Are you want to edit user information");
				if(ans)
				{
					window.location="a_user_edit.php?id="+id;
				}
			}
			else if(action=='delete')
			{
				var ans=confirm("Are you want to delete user");
				if(ans)
				{
					window.location="a_user_delete.php?id="+id;
				}
			}
		}
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

            <h1 class="page-title">User</h1>
                    <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li class="active">View Users</li>
        </ul>

        </div>
        <div class="main-content">
			<?php
			if(isset($_GET['msg']))
			{
				echo '<font color="red" size="2">'.$_GET['msg'].'</font>';
			}
			?>
			<table id="myTable" class="display table">
				<thead>
				<tr>
					<th>S.No.</th>
					<th>Username</th>
					<th>Name</th>
					<th>Contact No.</th>
					<th>E-mail ID</th>
					<th>City</th>
					<th>&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$userinfo=mysql_query("SELECT * FROM ais_users WHERE usertype='USER' AND deleted='0'")or die(mysql_error());
				$s_no=1;
				if(mysql_num_rows($userinfo)>=1)
				{
					while($userrow=mysql_fetch_assoc($userinfo))
					{
						echo '<tr>
							<td>'.$s_no.'</td>
							<td>'.$userrow['username'].'</td>
							<td>'.$userrow['name'].'</td>
							<td>'.$userrow['contactno'].'</td>
							<td>'.$userrow['emailid'].'</td>
							<td>'.$userrow['city'].'</td>
							<td>
								<input type="button" class="btn btn-info" value="Permission" onclick="actionForUser(\'access\','.$userrow['id'].')">';
								if($userrow['status']==0)
								echo '&nbsp;<input type="button" style="width:80px;height:34px;border-radius:4px;color:#FF0000;" value="Inactive" onclick="actionForUser(\'status\','.$userrow['id'].')">&nbsp;';
								else
								echo '&nbsp;<input type="button" style="width:80px;height:34px;border-radius:4px;color:#08C000;" value="Active" onclick="actionForUser(\'status\','.$userrow['id'].')">&nbsp;';
								echo '<input type="button" class="btn btn-primary" value="Edit" onclick="actionForUser(\'edit\','.$userrow['id'].')">
								<input type="button" class="btn btn-danger" value="Delete" onclick="actionForUser(\'delete\','.$userrow['id'].')">
							</td>
						</tr>';
						$s_no=$s_no+1;
					}
				}
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