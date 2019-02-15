<?php
	require '../config.php';
	if(empty($_SESSION['pUsername']))
		header('Location: login.php');
	
	if(isset($_POST['trans'])) {
		$errMsg = '';

		// Get data from FROM
		$courseID = $_POST['courseID'];
		$courseName = $_POST['courseName'];
		$enrollID = $_POST['enrollID'];
		
		if($enrollID == '')
			$errMsg = 'enroll ID missing';
		if($courseID == '')
			$errMsg = 'course missing';
		if($courseName == '')
			$errMsg = 'course name missing';
		
	}
	
	if(isset($_POST['homeworkTaskSubmission'])) {
		$errMsg = '';

		// Get data from FROM 
		$enrollID = $_POST['enrollID'];
		$homeworkID = $_POST['homeworkID'];
		$submitDate = $_POST['submitDate'];
		$submitTime = $_POST['submitTime'];
		
		$dbLink = new mysqli('localhost', 'root', '', 'spp');
		$fileName = $dbLink->real_escape_string($_FILES['file']['name']);
        $mime = $dbLink->real_escape_string($_FILES['file']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES['file']['tmp_name']));
        $size = intval($_FILES['file']['size']);
		
		if($enrollID == '')
			$errMsg = 'enroll ID missing';
		if($homeworkID == '')
			$errMsg = 'homework ID missing';
		if($submitDate == '')
			$errMsg = 'date missing';
		if($submitTime == '')
			$errMsg = 'time  missing';
		
		// Create the SQL query
        $query = "INSERT INTO submit (homeworkID, enrollID, fileName, file, submitDate,  submitTime)
            VALUES ({$homeworkID}, '{$enrollID}', '{$fileName}', '{$data}', '{$submitDate}', '{$submitTime}')";
 
        // Execute the query
        $result = $dbLink->query($query);
		
		
		
		
		// Check if it was successfull
        if($result) {
			//echo '<script type="text/javascript">alert("Success! Your file was successfully added!");</script>';
			//header('Location: listCourse.php');
			
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Success! Your file was successfully added!')
			window.location.href='listCourse.php';
			</SCRIPT>");
			exit;
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
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
	 <!-- Select2 -->
  <link rel="stylesheet" href="../../../bower_components/select2/dist/css/select2.min.css">

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
                                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
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
                    <li>
                        <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
					</li>
					<li class="active treeview">
                        <a href="#">
                            <i class="fa fa-folder-open-o"></i> <span>Course</span>
                            <span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="listCourse.php"><i class="fa fa-circle-o"></i> All Course</a></li>
                        </ul>
                    </li>
					<li>
                        <a href="http://www.mrsmbpj.com/e-keputusan/login.asp" target="_blank"><i class="fa fa-dashboard"></i> <span>Result</span></a>
					</li>
					<li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i> <span>Documentation</span>
                            <span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../document/Jadual PGG.pdf"><i class="fa fa-circle-o"></i> PGG Schedule</a></li>
                            <li><a href="../document/Menu Makan.pdf"><i class="fa fa-circle-o"></i> Food Schedule</a></li>
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
                    Homework
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Course</li>
					<li class="active">Homework</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
				<!-- Main row -->
                <div class="row">
                    <!--  col -->
                    <section class="col-lg-12 connectedSortable">
						
						
						<!-- Course widget -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <i class="fa fa-clone"></i>
                                <h3 class="box-title">Homework <b>( <?=$courseName ?> ) </b></h3>
                            </div>
                            <div class="box-body">
							
								<?php
								$stmt = $connect->prepare("SELECT * FROM homework WHERE courseID = '$courseID'");
								$stmt->execute();
								
								
								$data = $stmt->fetchAll();
								
								foreach($data as $row): ?>
                                <!-- Schedule here -->
								
								<div class="panel box box-warning">
								  <div class="box-header with-border">
									<h4 class="box-title">
									  <a data-toggle="collapse" data-parent="#accordion" href="#<?=$row['homeworkID'] ?>">
										<?=$row['hmTitle'] ?>
									  </a>
									</h4>
								  </div>
								  <div id="<?=$row['homeworkID'] ?>" class="panel-collapse collapse in">
									<div class="box-body">
										<p>Description : <?=$row['hmDesc'] ?></p>
										<p>End Date : <?=$row['hmEndDate'] ?></p>
										<table class="table table-bordered table-striped">
											<tr>
												<td>File Name</td>
												<td>Download</td>
											</tr>
												
											<tr>
												<td><?=$row['fileName'] ?></td>
												<td><a href='get_file.php?id=<?=$row['homeworkID'] ?>'>Download</a></td>
											</tr>
										</table>
										<hr>
										<!-- -->
										<div class="box ">
											<div class="box-header with-border">
												<h4 class="box-title">
												  Submit Your Assignment <b><?=$row['hmTitle'] ?> </b>Here!..
												</h4>
											</div>
											<!-- /.box-header -->
											<!-- form start -->
											<form method="post" enctype="multipart/form-data">
												<div class="box-body">
													<input type="hidden" class="form-control" name="homeworkID"  value="<?=$row['homeworkID'] ?>">
													<input type="hidden" class="form-control" name="enrollID"  value="<?=$enrollID ?>">
													<div class="form-group">
													  <label>Date: </label>
													  <input class="form-control" name="submitDate" type="date">
													</div>
													<div class="form-group">
													  <label>Time: </label>
													  <input class="form-control" name="submitTime" type="time">
													</div>
													<div class="form-group">
													  <label>Submit File: </label>
													  <input type="file" name="file">
													  
													</div>
													
													<table class="table table-bordered table-striped">
														<tr>
															<td>File Name</td>
															<td>Date</td>
															<td>Time</td>
															<td>Download</td>
														</tr>
														<?php
														$HA = $row['homeworkID'];
														$stmt = $connect->prepare("SELECT * FROM submit  WHERE homeworkID = '$HA' AND enrollID = '$enrollID' ");
														$stmt->execute();
														
														
														$data = $stmt->fetchAll();
														
														foreach($data as $row): ?>	
														<tr>
															<td><?=$row['fileName'] ?></td>
															<td><?=$row['submitDate'] ?></td>
															<td><?=$row['submitTime'] ?></td>
															<td><a href='get_file_submitted.php?id=<?=$row['submitID'] ?>'>Click me..</a></td>
														</tr>
														<?php endforeach ?>
													</table>
													
												</div>
											  <!-- /.box-body -->

												<div class="box-footer">
													<input type="hidden" class="form-control pull-center" value="homeworkTaskSubmission" name="homeworkTaskSubmission">
													<button type="submit" class="btn btn-primary pull-center">Submit</button>
												</div>
											</form>
										</div>
										<!-- -->
										
									</div>
								  </div>
								</div>
								<!-- /.row -->
								<?php endforeach ?>
                            </div>
                        </div>
						<!-- /. Course widget -->
						
                    </section>
                    <!-- /. col -->
                    
                </div>
                <!-- /.row (main row) -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2019.</strong> All rights reserved.
        </footer>

      
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="../node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../node_modules/admin-lte/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<!-- Select2 -->
<script src="../../../bower_components/select2/dist/js/select2.full.min.js"></script>
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
	
<!-- bootstrap color picker -->
<script src="../node_modules/admin-lte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../node_modules/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js"></script>


	<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
  
	n =  new Date();
	y = n.getFullYear();
	m = n.getMonth() + 1;
	d = n.getDate();
	document.getElementById("date").innerHTML = d  + "/" + m + "/" + y;
  
today = new Date().;
document.querySelector("#today").value = today;

document.querySelector("#today2").valueAsDate = new Date();


</script>
</body>

</html>