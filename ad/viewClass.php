<?php
	require '../config.php';
	if(empty($_SESSION['pUsername']))
		header('Location: login.php');
	
	if(isset($_POST['deleteClass'])) {
		$errMsg = '';

		// Get data from FROM
		$classID = $_POST['classID'];

		if($classID == '')
			$errMsg = 'Enter class ';
		
		if($errMsg == ''){
			try {
				
				$sql = 'DELETE FROM class WHERE classID = :classID';
				$stmt = $connect->prepare($sql);
				$stmt->execute([':classID' => $classID]);
				
				header('Location: viewClass.php');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		
	}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SPP | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../node_modules/admin-lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../node_modules/admin-lte/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../node_modules/admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../node_modules/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>MRSM</b> BATU PAHAT</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../node_modules/admin-lte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $_SESSION['pUsername']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="../node_modules/admin-lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                    <?php echo $_SESSION['pUsername']; ?>
                                        <small><?php echo $_SESSION['pRole']; ?></small>
                                    </p>
                                </li>
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="../node_modules/admin-lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $_SESSION['pUsername']; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li >
                        <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
					</li>
                   
					<li  class="treeview">
                        <a href="#">
                            <i class="fa fa-user"></i> <span>Student</span>
                            <span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="allStudent.php"><i class="fa fa-circle-o"></i> All Student</a></li>
                            <li><a href="regStudent.php"><i class="fa fa-circle-o"></i> Register Student</a></li>
                            
                        </ul>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fa fa-folder-open-o"></i> <span>Class</span>
                            <span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="viewClass.php"><i class="fa fa-circle-o"></i> All Class</a></li>
                            <li><a href="registerClass.php"><i class="fa fa-circle-o"></i> Register Class</a></li>
                            
                        </ul>
                    </li>
					
					<li class="treeview">
                        <a href="#">
                            <i class="fa fa-folder-open-o"></i> <span>Course</span>
                            <span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> All Course</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Register Course</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Edit Course</a></li>
                        </ul>
                    </li>
					<li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i> <span>Documentation</span>
                            <span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> PGG Schedule</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Food Schedule</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> CLass Schedule</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Class
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Class</a></li>
                    <li class="active">All Class</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
				<div class="box box-primary">
					
					<div class="box-header">
					  <h3 class="box-title">All Class</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
					  <table class="table table-hover">
						<tr>
						  <th class="col-sm-1">No</th>
						  <th class="col-sm-6">Class Name</th>
						  <th class="col-sm-2">Form</th>
						  <th class="col-sm-2">No. of Student</th>
						  <th class="col-sm-1"></th>
						  <th class="col-sm-1"></th>
						</tr>
						
						<?php
						$stmt = $connect->prepare("SELECT * FROM class");
						$stmt->execute();
						
						$a = 1;
						// fetching rows into array
						$data = $stmt->fetchAll();
						
						foreach($data as $row): ?>
						
						<tr>
							<td><?=$a ?></td>
							<td><?=$row['className']?></td>
							<td><?=$row['form']?></td>
							<td></td>
							<td>
								<form action="editClass.php" method="post">
									<input type="hidden" name="classID" value="<?=$row['classID'] ?>">
									<input type="hidden" name="editClass" value="editClass">							
									<button type="submit" class="btn btn-primary">Edit</button>
								</form>
							</td>
							<td>
								<form method="post">
									<input type="hidden" name="classID" value="<?=$row['classID'] ?>">
									<input type="hidden" name="deleteClass" value="deleteClass">							
									<button type="submit" class="btn btn-danger" onclick="return showConfirm()";>Delete</button>
								</form>
							</td>
						</tr>
						
						<?php 
						$a = $a + 1;
						endforeach 
						?>
						
						
						
					  </table>
					</div>
					<!-- /.box-body -->
				</div>
				  <!-- /.box -->
		
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2019-2020.</strong> All rights reserved.
        </footer>

        
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="../node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../node_modules/admin-lte/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="../node_modules/admin-lte/bower_components/raphael/raphael.min.js"></script>
    <script src="../node_modules/admin-lte/bower_components/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../node_modules/admin-lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../node_modules/admin-lte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../node_modules/admin-lte/bower_components/moment/min/moment.min.js"></script>
    <script src="../node_modules/admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../node_modules/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../node_modules/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../node_modules/admin-lte/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../node_modules/admin-lte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../node_modules/admin-lte/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../node_modules/admin-lte/dist/js/demo.js"></script>
	
	<script type="text/javascript" >
	
		function showConfirm(){
			
			var answer = confirm("Are you sure you want to delete?.")
			if(!answer){
				return false;
			}
		}
		
      </script>
</body>



</html>