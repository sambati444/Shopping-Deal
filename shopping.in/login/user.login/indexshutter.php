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
/*USERS CAN NOT OPEN THIS PAGE. ONLY ADMIN CAN ACCESS*/
if($_SESSION['usertype']=='' || $_SESSION['usertype']!='ADMIN')
{
	header("location:../index.php?msg=Illegal entry");
}
if(isset($_GET['action']))
{
	if($_GET['action']=="delete")
	{
		$id=mysql_real_escape_string($_GET['id']);
		$verification=mysql_query("SELECT * FROM ais_indexshutter WHERE id='$id'")or die(mysql_error().'verification');
		if(mysql_num_rows($verification)>=1)
		{
			$verification=mysql_fetch_array($verification);
			if(unlink('../setting/images/indexshutter/'.$verification['indexbanner']))
			{
				$deletion=mysql_query("DELETE FROM ais_indexshutter WHERE id='$id'")or die(mysql_error().'deletion');
				header("location:indexshutter.php?msg=Successfully deleted");
			}
			else
			{
				$deletion=mysql_query("DELETE FROM ais_indexshutter WHERE id='$id'")or die(mysql_error().'deletion');
				header("location:indexshutter.php?msg=error Occured");
			}
		}
		else
		{
			header("location:indexshutter.php?msg=Banner not found");
		}
	}
}
if(isset($_POST['submission']))
{
	if(isset($_FILES['indexbanner']['tmp_name']))
	{
		$extension=explode('.',$_FILES['indexbanner']['name']);
		$extension=$extension[1];
		if($extension=='jpg'||$extension=='JPG'||$extension=='png'||$extension=='PNG'||$extension=='gif'||$extension=='GIF'||$extension=='jpeg'||$extension=='JPEG')
		{
			if(move_uploaded_file($_FILES['indexbanner']['tmp_name'],'../setting/images/indexshutter/'.$_FILES['indexbanner']['name']))
			{
				$filename=$_FILES['indexbanner']['name'];
				$insertion=mysql_query("INSERT INTO ais_indexshutter VALUES ('','$filename')")or die(mysql_error());
				header("location:indexshutter.php?msg=success");
			}
		}
		else
		{
			header("location:indexshutter.php?msg=Only image allowed");
		}
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
		function deleteBanner(id)
		{
			var ans=confirm("Are you want to delete this image");
			if(ans)
			{
				window.location="indexshutter.php?action=delete&id="+id;
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

            <h1 class="page-title">Index Banners</h1>
                    <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li class="active">Index Banners</li>
        </ul>

        </div>
        <div class="main-content">
			<?php
				if(isset($_GET['msg']))
				{
					echo '<font color="red" size="2">'.$_GET['msg'].'</font>';
				}
			?>
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table">
					<tr>
						<th>Banner Image</th>
						<td><input type="file" class="form-control" name="indexbanner" accept="image/*" autofocus required/></td>
						<td><input type="submit" class="btn btn-info" name="submission" value="Upload"></td>
					</tr>
				</table>
				<hr>
				<table class="table">
					<tr>
						<th>S.No.</th>
						<th>Image</th>
						<th>&nbsp;</th>
					</tr>
					<?php
						$image=mysql_query("SELECT * FROM ais_indexshutter")or die(mysql_error());
						if(mysql_num_rows($image)>=1)
						{
							$s_no=1;
							while($row=mysql_fetch_array($image))
							{
								echo '<tr>
										<td>'.$s_no.'</td>
										<td><img src="../setting/images/indexshutter/'.$row['indexbanner'].'" style="width:400px;height:260px;"></td>
										<td><a href="javascript:deleteBanner('.$row['id'].')" class="btn btn-danger">DELETE</a></td>
										</tr>';
									$s_no+$s_no+1;
							}
						}
					?>
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