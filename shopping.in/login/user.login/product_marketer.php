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
/*CHANGE TAX STATUS*/
if(isset($_GET['action'])&&$_GET['action']=="status")
{
	$lengthid=mysql_real_escape_string(strip_tags($_GET['id']));
	$taxinfo=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE id='$lengthid'")or die(mysql_error().'cant fetch tax info');
	if(mysql_num_rows($taxinfo)>=1)
	{
		$taxinfo=mysql_fetch_array($taxinfo);
		if($taxinfo['status']==0)
		{
			$updation=mysql_query("UPDATE manage_product_marketing_head_master SET status='1' WHERE id='$lengthid'")or die(mysql_error().'1');
		}
		else
		{
			$updation=mysql_query("UPDATE manage_product_marketing_head_master SET status='0' WHERE id='$lengthid'")or die(mysql_error().'1');
		}
		header("location:product_marketer.php?msg=Marketer status changed");
	}
}
/*DELETE TAX INFORMATION*/
if(isset($_GET['action'])&&$_GET['action']=="delete")
{
	$lengthid=mysql_real_escape_string(strip_tags($_GET['id']));
	$taxinfo=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE id='$lengthid'")or die(mysql_error().'cant fetch tax info');
	if(mysql_num_rows($taxinfo)>=1)
	{
		$taxinfo=mysql_fetch_array($taxinfo);
		$updation=mysql_query("UPDATE manage_product_marketing_head_master SET deleted='1' WHERE id='$lengthid'")or die(mysql_error().'1');
		header("location:product_marketer.php?msg=Marketer deleted successfully");
	}
}
/*EDIT TAX INFORMATION*/
if(isset($_POST['submission'])&&$_POST['submission']=='EDIT')
{
	$lengthid=mysql_real_escape_string(strip_tags($_GET['id']));
	$name=mysql_real_escape_string(strip_tags($_POST['name']));
	$desc=mysql_real_escape_string(strip_tags($_POST['desc']));
	if(isset($_FILES['imgfile']['tmp_name']))
	{
		$imgfile=addslashes($_FILES['imgfile']['name']);
		if(move_uploaded_file($_FILES['imgfile']['tmp_name'],'../product_marketer/'.$imgfile))
		{
			$taxinfo=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE deleted='0' AND name='$name' AND id!='$lengthid'")or die(mysql_error());
			if(mysql_num_rows($taxinfo)>=1)
			{
				header("location:product_marketer.php?msg=Marketer is already exist");
			}
			else
			{
				$updation=mysql_query("UPDATE manage_product_marketing_head_master SET name='$name',description='$desc',imagepath='$imgfile' WHERE id='$lengthid'")or die(mysql_error().'updation');
				header("location:product_marketer.php?msg=Marketer updated successfully");
			}
		}
		else
		{
			$taxinfo=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE deleted='0' AND name='$name' AND id!='$lengthid'")or die(mysql_error());
			if(mysql_num_rows($taxinfo)>=1)
			{
				header("location:product_marketer.php?msg=Marketer is already exist");
			}
			else
			{
				$updation=mysql_query("UPDATE manage_product_marketing_head_master SET name='$name',description='$desc' WHERE id='$lengthid'")or die(mysql_error().'updation');
				header("location:product_marketer.php?msg=Marketer updated successfully");
			}
		}
	}
	else
	{
		$taxinfo=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE deleted='0' AND name='$name' AND id!='$lengthid'")or die(mysql_error());
		if(mysql_num_rows($taxinfo)>=1)
		{
			header("location:product_marketer.php?msg=Marketer is already exist");
		}
		else
		{
			$updation=mysql_query("UPDATE manage_product_marketing_head_master SET name='$name',description='$desc' WHERE id='$lengthid'")or die(mysql_error().'updation');
			header("location:product_marketer.php?msg=Marketer updated successfully");
		}
	}
}
/*CREATE NEW TAX*/
if(isset($_POST['submission'])&&$_POST['submission']=='CREATE')
{
	$name=mysql_real_escape_string(strip_tags($_POST['name']));
	$desc=mysql_real_escape_string(strip_tags($_POST['desc']));
	if(isset($_FILES['imgfile']['tmp_name']))
	{
		$imgfile=addslashes($_FILES['imgfile']['name']);
		if(move_uploaded_file($_FILES['imgfile']['tmp_name'],'../product_marketer/'.$imgfile))
		{
			$taxinfo=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE deleted='0' AND name='$name'")or die(mysql_error());
			if(mysql_num_rows($taxinfo)>=1)
			{
				header("location:product_marketer.php?msg=Marketer is already exist");
			}
			else
			{
				/*INSERTION QUERY FOR TAX*/
				$lengthid=mysql_query("SELECT MAX(id) FROM manage_product_marketing_head_master")or die(mysql_error());
				$lengthid=mysql_fetch_array($lengthid);
				$lengthid=$lengthid[0]+1;
				$insertion=mysql_query("INSERT INTO manage_product_marketing_head_master VALUES('$lengthid','$name','$desc','$imgfile','1','0')")or die(mysql_error());
				header("location:product_marketer.php?msg=Marketer added successfully");
			}
		}
		else
		{
			$taxinfo=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE deleted='0' AND name='$name'")or die(mysql_error());
			if(mysql_num_rows($taxinfo)>=1)
			{
				header("location:product_marketer.php?msg=Marketer is already exist");
			}
			else
			{
				/*INSERTION QUERY FOR TAX*/
				$lengthid=mysql_query("SELECT MAX(id) FROM manage_product_marketing_head_master")or die(mysql_error());
				$lengthid=mysql_fetch_array($lengthid);
				$lengthid=$lengthid[0]+1;
				$insertion=mysql_query("INSERT INTO manage_product_marketing_head_master VALUES('$lengthid','$name','$desc','','1','0')")or die(mysql_error());
				header("location:product_marketer.php?msg=Marketer added successfully");
			}
		}
	}
	else
	{
		$taxinfo=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE deleted='0' AND name='$name'")or die(mysql_error());
		if(mysql_num_rows($taxinfo)>=1)
		{
			header("location:product_marketer.php?msg=Marketer is already exist");
		}
		else
		{
			/*INSERTION QUERY FOR TAX*/
			$lengthid=mysql_query("SELECT MAX(id) FROM manage_product_marketing_head_master")or die(mysql_error());
			$lengthid=mysql_fetch_array($lengthid);
			$lengthid=$lengthid[0]+1;
			$insertion=mysql_query("INSERT INTO manage_product_marketing_head_master VALUES('$lengthid','$name','$desc','','1','0')")or die(mysql_error());
			header("location:product_marketer.php?msg=Marketer added successfully");
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
		.m_logo{width:100px;height:80px;}
    </style>
    <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
		function actionForTax(action,id)
		{
			if(action=='status')
			{
				var ans=confirm("Are you want to change status of this manufacturer");
				if(ans)
				{
					window.location="product_marketer.php?id="+id+"&action=status";
				}
			}
			else if(action=='edit')
			{
				var ans=confirm("Are you want to edit this manufacturer");
				if(ans)
				{
					window.location="product_marketer.php?id="+id+"&action=edit";
				}
			}
			else if(action=='delete')
			{
				var ans=confirm("Are you want to delete this manufacturer");
				if(ans)
				{
					window.location="product_marketer.php?id="+id+"&action=delete";
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

            <h1 class="page-title">Products</h1>
                    <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li class="active">Manage Marketer</li>
        </ul>
        </div>
        <div class="main-content">
			<?php
			if(isset($_GET['msg']))
			{
				echo '<font color="red" size="2">'.$_GET['msg'].'</font>';
			}
			?>
			<?php
			if(!isset($_GET['action']))
			{
				echo '<form action="" method="post" enctype="multipart/form-data">
				<table class="table">
					<tr>
						<th>Name</th>
						<td><input type="text" class="form-control" name="name" autofocus required/></td>
						<th>Image Path</th>
						<td><input type="file" class="form-control" name="imgfile" accept="image/*"></td>
					</tr>
					<tr>
						<th>Description</th>
						<td colspan="3"><input type="text" class="form-control" name="desc"></td>
					</tr>
					<tr>
						<td colspan="4"><input type="submit" class="btn btn-primary pull-right" name="submission" value="CREATE"></td>
					</tr>
				</table>
				</form>';
			}
			else if(isset($_GET['action'])&&$_GET['action']=='edit')
			{
				$lengthid=mysql_real_escape_string(strip_tags($_GET['id']));
				$taxinfo=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE id='$lengthid'");
				if(mysql_num_rows($taxinfo)>=1)
				{
					$taxinfo=mysql_fetch_array($taxinfo);
				}
				else
				{
					echo '<script>window.location="product_marketer.php?msg=Bad request";</script>';
				}
				echo '<form action="" method="post" enctype="multipart/form-data">
				<table class="table">
					<tr>
						<th>Name</th>
						<td><input type="text" class="form-control" name="name" value="'.$taxinfo['name'].'" autofocus required/></td>
						<th>Image Path</th>
						<td><input type="file" class="form-control" name="imgfile" accept="image/*"></td>
					</tr>
					<tr>
						<th>Description</th>
						<td colspan="3"><input type="text" class="form-control" name="desc" value="'.$taxinfo['description'].'"></td>
					</tr>
					<tr>
						<td colspan="4"><input type="submit" class="btn btn-primary pull-right" name="submission" value="EDIT"></td>
					</tr>
				</table>
				</form>';
			}
			?>
			<table id="myTable" class="display table">
				<thead>
				<tr>
					<th>S.No.</th>
					<th>Logo</th>
					<th>Name</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$taxtype=mysql_query("SELECT * FROM manage_product_marketing_head_master WHERE deleted='0'")or die(mysql_error());
				if(mysql_num_rows($taxtype)>=1)
				{
					$s_no=1;
					while($taxrow=mysql_fetch_array($taxtype))
					{
						echo '<tr>
							<td>'.$s_no.'</td>';
							if($taxrow['imagepath']!='')
							echo '<td><img src="../product_marketer/'.$taxrow['imagepath'].'" class="m_logo"></td>';
							else
							echo '<td>&nbsp;</td>';
							echo '<td>'.$taxrow['name'].'</td>
							<td>'.$taxrow['description'].'</td>
							<td>';
							if($taxrow['status']==0)
							{
								echo '<input type="button" style="height:34px;width:90px;background:#FF0000;color:#FFFFFF;border-radius:4px;" value="De-Activate" onclick="actionForTax(\'status\','.$taxrow['id'].')">&nbsp;';
							}
							else
							{
								echo '<input type="button" style="height:34px;width:90px;background:#08C000;color:#FFFFFF;border-radius:4px;" value="Activate" onclick="actionForTax(\'status\','.$taxrow['id'].')">&nbsp;';
							}
								echo '<input type="button" class="btn btn-primary" value="Edit" onclick="actionForTax(\'edit\','.$taxrow['id'].')">
								<input type="button" class="btn btn-danger" value="Delete" onclick="actionForTax(\'delete\','.$taxrow['id'].')">
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