<?php
session_start();
error_reporting(0);
include "timeout.php";

if ($_SESSION[login] == 1) {
	if (!cek_login()) {
		$_SESSION[login] = 0;
	}
}
if ($_SESSION[login] == 0) {
	header('location:logout.php');
} else {
	if (empty($_SESSION['username']) and empty($_SESSION['passuser']) and $_SESSION['login'] == 0) {
		echo "<link href=css/style.css rel=stylesheet type=text/css>";
		echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
	} else {
		if ($_SESSION['leveluser'] == 'siswa') {
			echo "<link href=css/style.css rel=stylesheet type=text/css>";
			echo "<div class='error msg'>Anda tidak diperkenankan mengakses halaman ini.</div>";
		} else {

?>
			<html>

			<head>
				<title>SPK SAW Siswa Terbaik</title>

				<!-- Bootstrap -->
				<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

				<!-- Font Awesome -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

				<!-- Ionicons -->
				<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

				<!-- Theme style -->
				<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

				<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

				<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

				<!-- iCheck -->
				<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">

				<!-- Morris chart -->
				<link rel="stylesheet" href="plugins/morris/morris.css">
				<!-- jvectormap -->
				<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
				<!-- Date Picker -->
				<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
				<!-- Daterange picker -->
				<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
				<!-- bootstrap wysihtml5 - text editor -->
				<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
				<!-- DataTables -->
				<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

				<link rel="stylesheet" href="plugins/css/dataTables.bootstrap4.min.css">
				<link rel="stylesheet" href="plugins/css/buttons.bootstrap4.min.css">
				<link rel="stylesheet" href="plugins/css/responsive.bootstrap4.min.css">






				<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
				<!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
				<script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>


				<!--/.fluid-container-->
				<script src="vendors/jquery-1.9.1.min.js"></script>
				<script src="bootstrap/js/bootstrap.min.js"></script>

				<script src="assets/scripts.js"></script>







				<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
				<script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
				<script type="text/javascript" src="js/jquery.validate.min.js"></script>
				<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
				<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
				<script type="text/javascript" src="js/superfish.js"></script>
				<script type="text/javascript" src="js/cufon-yui.js"></script>
				<script type="text/javascript" src="js/Delicious_500.font.js"></script>
				<script type="text/javascript" src="js/jquery.flot.min.js"></script>
				<script type="text/javascript" src="js/custom.js"></script>
				<script type="text/javascript" src="js/facebox.js"></script>
				<script type="text/javascript" src="../js/clock.js"></script>

				<script type="text/javascript" src="js/jquery.cookie.js"></script>
				<script type="text/javascript" src="js/switcher.js"></script>
				<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
				<script type="text/javascript" src="js/jquery-ui.js"></script>
				<script type="text/javascript" src="js/tabcontent.js"></script>



				<script>
					$(function() {
						$("#tabs").tabs();
					});
				</script>


				<link rel="shortcut icon" type="image/x-icon" href="dist/img/islamik.jpg">

				<style>
					.rangkingg tr:first-child {
						background-color: yellow;
					}
				</style>

			</head>

			<body onload="startclock()" class="hold-transition skin-red sidebar-mini">

				<?php
				if ($_SESSION[leveluser] == 'admin') {
				?>
					<div class="wrapper">

						<header class="main-header">
							<!-- Logo -->
							<a href="?module=home" class="logo" style="background-color: #333333">

								<!-- mini logo for sidebar mini 50x50 pixels -->
								<span class="logo-mini"><img src="dist/img/islamik.jpg" alt="User Image" width="49px"></span>

								<!-- logo for regular state and mobile devices -->
								<span class="logo-lg" style="margin-top: -22px"><img src="dist/img/isvl.png" alt="User Image" width="150px"></span>
							</a>

							<!-- Header Navbar: style can be found in header.less -->
							<nav class="navbar navbar-static-top" role="navigation">

								<!-- Sidebar toggle button-->
								<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="background-color: #333333">
									<span class="sr-only">Toggle navigation</span>
								</a>

								<div class="navbar-custom-menu">
									<ul class="nav navbar-nav">
										<li class="dropdown user user-menu">
											<a href="#">
												<i class="fa fas fa-user"></i></span><?php echo "$_SESSION[namalengkap]"; ?>
											</a>
										</li>
										<li class="dropdown user user-menu">
											<a href="logout.php">
												Keluar
											</a>
										</li>
									</ul>
								</div>
							</nav>

						</header>
						<!-- Left side column. contains the logo and sidebar -->
						<aside class="main-sidebar">
							<!-- sidebar: style can be found in sidebar.less -->
							<section class="sidebar">
								<ul class="sidebar-menu">

									<li>
										<a href="?module=home">
											<i class="fa fa-th"></i> <span>Dashboard</span>
										</a>
									</li>
									<li class="active treeview">
										<a href="#">
											<i class="fa far fa-edit"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<?php include "menu.php"; ?>
										</ul>
									</li>

									<li class="active treeview">
										<a href="#">
											<i class="fa far fa-file"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<?php include "report.php"; ?>
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
											<i class="fa fa-wrench"></i>
											<span>Pengaturan</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="?module=admin"><i class="fa fa-circle-o"></i> Manajemen Pengguna</a></li>
											<!-- <li><a href="?module=modul"><i class="fa fa-circle-o"></i> Module</a></li> -->

										</ul>
									</li>
								</ul>
							</section>
							<!-- /.sidebar -->
						</aside>
						<div class="content-wrapper">
							<section class="content-header">
								<h1>
									Dashboard
									<small>Control panel</small>
								</h1>
							</section>

							<section class="content">
								<div class="box box-default color-palette-box">
									<div class="box-body">
										<?php include "content_admin.php"; ?>
									</div>
								</div>
							</section>
						</div>
					</div>


				<?php
				} elseif ($_SESSION[leveluser] == 'pengajar') {
				?>

				<?php
				}
				?>






			</body>

			</html>
<?php
		}
	}
}
?>
<!--/.fluid-container-->
<!-- jQuery 2.1.4 -->

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/ckeditor/ckeditor.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script src="plugins/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/js/datatables.init.js"></script>
<script src="plugins/js/dataTables.buttons.min.js"></script>
<script src="plugins/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/js/jszip.min.js"></script>
<script src="plugins/js/pdfmake.min.js"></script>
<script src="plugins/js/vfs_fonts.js"></script>
<script src="plugins/js/buttons.html5.min.js"></script>
<script src="plugins/js/buttons.print.min.js"></script>
<script src="plugins/js/buttons.colVis.min.js"></script>
<script src="plugins/js/dataTables.responsive.min.js"></script>
<script src="plugins/js/responsive.bootstrap4.min.js"></script>

<!-- page script -->
<script>
	$(function() {
		$(".example1").DataTable({
			bLengthChange: false
		});
		$("#example3").DataTable();
		$("#example4").DataTable({
				"buttons": ["copy", "excel", "pdf", "colvis"]
			})
			.buttons()
			.container()
			.appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true
		});
		$("#example_matrik_awal").DataTable();
		// $("#example_matrik_awal").DataTable();
	});
</script>



<script>
	$(function() {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace('editor1');
		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5();
	});
</script>