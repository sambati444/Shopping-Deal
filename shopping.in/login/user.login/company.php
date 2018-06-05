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
if(isset($_POST['submission']))
{
	$companyname=mysql_real_escape_string($_POST['companyname']);
	$managingdirector=mysql_real_escape_string($_POST['managingdirector']);
	$mobileno=mysql_real_escape_string($_POST['mobileno']);
	$contactno=mysql_real_escape_string($_POST['contactno']);
	$faxno=mysql_real_escape_string($_POST['faxno']);
	$emailid=mysql_real_escape_string($_POST['emailid']);
	$add_line1=mysql_real_escape_string($_POST['add_line1']);
	$add_line2=mysql_real_escape_string($_POST['add_line2']);
	$city=mysql_real_escape_string($_POST['city']);
	$state=mysql_real_escape_string($_POST['state']);
	$pincode=mysql_real_escape_string($_POST['pincode']);
	$country=mysql_real_escape_string($_POST['country']);
	/****COADING ACCORDING TO LOGO***/
	if(isset($_FILES['companylogo']['tmp_name']))
	{/*IF LOGO IS UPLOADED BY ADMINISTRATOR*/
		$logopath=addslashes('../setting/images/companylogo/'.$_FILES['companylogo']['name']);
		$companylogo=$_FILES['companylogo']['name'];
		if(move_uploaded_file($_FILES['companylogo']['tmp_name'],$logopath))
		{
			$existdata=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
			if(mysql_num_rows($existdata)<1)
			{
				$query=mysql_query("INSERT INTO ais_company_info VALUES('$companyname','$managingdirector','$mobileno','$contactno','$faxno','$emailid','$add_line1','$add_line2','$city','$state','$pincode','$country','$companylogo')")or die(mysql_error().'CAN\'T INSERT COMPANY DATA');
			}
			else
			{
				$query=mysql_query("UPDATE ais_company_info SET company_name='$companyname',managing_director='$managingdirector',mobile_no='$mobileno',contact_no='$contactno',fax_no='$faxno',email_id='$emailid',address_line1='$add_line1',address_line2='$add_line2',city='$city',state='$state',pincode='$pincode',country='$country',logo='$companylogo'")or die(mysql_error().'CAN\'T UPDATE COMPANY DATA');
			}
		}
		else
		{
			$existdata=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
			if(mysql_num_rows($existdata)<1)
			{
				$query=mysql_query("INSERT INTO ais_company_info VALUES('$companyname','$managingdirector','$mobileno','$contactno','$faxno','$emailid','$add_line1','$add_line2','$city','$state','$pincode','$country','')")or die(mysql_error().'CAN\'T INSERT COMPANY DATA');
			}
			else
			{
				$query=mysql_query("UPDATE ais_company_info SET company_name='$companyname',managing_director='$managingdirector',mobile_no='$mobileno',contact_no='$contactno',fax_no='$faxno',email_id='$emailid',address_line1='$add_line1',address_line2='$add_line2',city='$city',state='$state',pincode='$pincode',country='$country'")or die(mysql_error().'CAN\'T UPDATE COMPANY DATA');
			}
		}
	}
	else
	{/*IF FILES ARE NOT UPLOADED*/
		$existdata=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
		if(mysql_num_rows($existdata)<1)
		{
			$query=mysql_query("INSERT INTO ais_company_info VALUES('$companyname','$managingdirector','$mobileno','$contactno','$faxno','$emailid','$add_line1','$add_line2','$city','$state','$pincode','$country','')")or die(mysql_error().'CAN\'T INSERT COMPANY DATA');
		}
		else
		{
			$query=mysql_query("UPDATE ais_company_info SET company_name='$companyname',managing_director='$managingdirector',mobile_no='$mobileno',contact_no='$contactno',fax_no='$faxno',email_id='$emailid',address_line1='$add_line1',address_line2='$add_line2',city='$city',state='$state',pincode='$pincode',country='$country'")or die(mysql_error().'CAN\'T UPDATE COMPANY DATA');
		}
	}/*END OF FILES ARE NOT UPLOADED*/
	header("location:company.php?success");
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

            <h1 class="page-title">Company Information</h1>
                    <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li class="active">Update Company Information</li>
        </ul>

        </div>
        <div class="main-content">
			<form action="" method="post" enctype="multipart/form-data">
			<?php
				$companyinfo=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error().'CANT FETCH COMPANY DATA');
				if(mysql_num_rows($companyinfo)<1)
				{
					echo '<table class="table">
						<tr>
							<th>Company Name</th>
							<td><input type="text" class="form-control" name="companyname"></td>
							<th>Managing Director Name</th>
							<td><input type="text" class="form-control" name="managingdirector"></td>
						</tr>
						<tr>
							<th>Company Logo</th>
							<td><input type="file" class="form-control" name="companylogo" accept="image/*"></td>
							<td colspan="2" style="height:100px;width:100px;"></td>
						</tr>
						<tr>
							<th>Mobile No.</th>
							<td><input type="text" class="form-control" name="mobileno"></td>
							<th>Contact No.</th>
							<td><input type="text" class="form-control" name="contactno"></td>
						</tr>
						<tr>
							<th>Fax no.</th>
							<td><input type="text" class="form-control" name="faxno"></td>
							<th>E-mail ID</th>
							<td><input type="text" class="form-control" name="emailid"></td>
						</tr>
						<tr>
							<th>Address Line-1</th>
							<td><input type="text" class="form-control" name="add_line1"></td>
							<th>Address Line-2</th>
							<td><input type="text" class="form-control" name="add_line2"></td>
						</tr>
						<tr>
							<th>City</th>
							<td><input type="text" class="form-control" name="city"></td>
							<th>State</th>
							<td><input type="text" class="form-control" name="state"></td>
						</tr>
						<tr>
							<th>Pincode</th>
							<td><input type="text" class="form-control" name="pincode"></td>
							<th>Country</th>
							<td><input type="text" class="form-control" name="country"></td>
						</tr>
						<tr>
							<td><input type="submit" name="submission" class="btn btn-primary" value="Update"></td>
						</tr>
					</table>';
				}
				else/*IF RECORD FOUND IN DATABASE*/
				{
					$companyinfo=mysql_fetch_array($companyinfo);
					echo '<table class="table">
						<tr>
							<th>Company Name</th>
							<td><input type="text" class="form-control" name="companyname" value="'.$companyinfo['company_name'].'"></td>
							<th>Managing Director Name</th>
							<td><input type="text" class="form-control" name="managingdirector" value="'.$companyinfo['managing_director'].'"></td>
						</tr>
						<tr>
							<th>Company Logo</th>
							<td><input type="file" class="form-control" name="companylogo" accept="image/*"></td>';
							if($companyinfo['logo']!='')
							{
								echo '<td colspan="2" style="height:100px;"><img src="../setting/images/companylogo/'.$companyinfo['logo'].'" style="height:100%;width:100;"></td>';
							}
						echo '</tr>
						<tr>
							<th>Mobile No.</th>
							<td><input type="text" class="form-control" name="mobileno" value="'.$companyinfo['mobile_no'].'"></td>
							<th>Contact No.</th>
							<td><input type="text" class="form-control" name="contactno" value="'.$companyinfo['contact_no'].'"></td>
						</tr>
						<tr>
							<th>Fax no.</th>
							<td><input type="text" class="form-control" name="faxno" value="'.$companyinfo['fax_no'].'"></td>
							<th>E-mail ID</th>
							<td><input type="text" class="form-control" name="emailid" value="'.$companyinfo['email_id'].'"></td>
						</tr>
						<tr>
							<th>Address Line-1</th>
							<td><input type="text" class="form-control" name="add_line1" value="'.$companyinfo['address_line1'].'"></td>
							<th>Address Line-2</th>
							<td><input type="text" class="form-control" name="add_line2" value="'.$companyinfo['address_line2'].'"></td>
						</tr>
						<tr>
							<th>City</th>
							<td><input type="text" class="form-control" name="city" value="'.$companyinfo['city'].'"></td>
							<th>State</th>
							<td><input type="text" class="form-control" name="state" value="'.$companyinfo['state'].'"></td>
						</tr>
						<tr>
							<th>Pincode</th>
							<td><input type="text" class="form-control" name="pincode" value="'.$companyinfo['pincode'].'"></td>
							<th>Country</th>
							<td><input type="text" class="form-control" name="country" value="'.$companyinfo['country'].'"></td>
						</tr>
						<tr>
							<td><input type="submit" name="submission" class="btn btn-primary" value="Update"></td>
						</tr>
					</table>';
				}
				?>
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