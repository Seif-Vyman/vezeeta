<?php
require_once '../../Models/user.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/UsersController.php';
session_start();
// print_r($_SESSION);
//error_reporting(0);
$db = DBController::singleton();
$new = UsersController::singleton();
$users = $new->getAllUsers();
//$db->openConnection();

if (strlen($_SESSION['userId'] == 0)) {
	header('location:logout.php');
} else {


	if (isset($_POST['del'])) {

		

		if ($new->deleteUser($_POST['i'] , $_POST['r'])) {
			$deleteMsg = true;

			$users = $new->getAllUsers();
			header('Location: view-users.php');
		}
	}
	if(isset($_POST['edit'])){
				$_SESSION['Ei'] =  $_POST["i"];
        $_SESSION['Ef'] = $_POST['f'];
        $_SESSION['El'] = $_POST['l'];
        $_SESSION['Ee'] = $_POST['e'];
        $_SESSION['Ep'] = $_POST['p'];
        $_SESSION['Eph'] = $_POST['ph'];
        $_SESSION['Ec'] = $_POST['c'];
        $_SESSION['Eci'] = $_POST['ci'];
		header('Location: editu.php');
	 }
}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | View Products</title>

		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="../assets/admin-assets/css/styles.css">
		<link rel="stylesheet" href="../assets/admin-assets/css/plugins.css">
		<link rel="stylesheet" href="../assets/admin-assets/css/themes/theme-1.css" id="skin_color" />
	</head>

	<body>
		<div id="app">
			<?php include('../include/admin-sidebar.php'); ?>
			<div class="app-content">

			<?php include('../include/admin-header.php'); ?>

				<!-- end: TOP NAVBAR -->
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | View Users</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>View Users</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">


							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">View <span class="text-bold">Users</span></h5>
									
									<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
										<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">User ID</th>
												<th>firstName</th>
												<th>lastName</th>
												<th>email </th>
												<th>password </th>
												<th>phoneNum </th>
												<th>country </th>
												<th>city </th>
												<th>userRole </th>
												<th>Action</th>

											</tr>
										</thead>
										<tbody>
											<?php
											$cnt = 0;
											foreach ($users as $user) {
											?>

												<tr>
													<td class="center"><?php echo $user['userId']; ?></td>
													<td><?php echo $user['firstName']; ?></td>
													<td><?php echo $user['lastName']; ?></td>
													<td><?php echo $user['email']; ?></td>
													<td><?php echo $user['password']; ?></td>
													<td><?php echo $user['phoneNum']; ?></td>
													<td><?php echo $user['country']; ?></td>
													<td><?php echo $user['city']; ?></td>
													<td><?php echo $user['userRole']; ?></td>

													<td>
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<form action="" method="post">
																<input type="submit" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit" value="delete" name="del">
																<input type="submit" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit" value="edit" name="edit">
																<input type="hidden" value="<?php echo $user['userId'] ;?>" name="i">
																<input type="hidden" value="<?php echo $user['firstName'] ;?>" name="f">
																<input type="hidden" value="<?php echo $user['lastName'] ;?>" name="l">
																<input type="hidden" value="<?php echo $user['email'] ;?>" name="e">
																<input type="hidden" value="<?php echo $user['password'] ;?>" name="p">
																<input type="hidden" value="<?php echo $user['phoneNum'] ;?>" name="ph">
																<input type="hidden" value="<?php echo $user['country'] ;?>" name="c">
																<input type="hidden" value="<?php echo $user['city'] ;?>" name="ci">
																<input type="hidden" value="<?php echo $user['userRole'] ;?>" name="r">
															</form>
														</div>

													</td>
												</tr>

											<?php
												$cnt = $cnt + 1;
											} ?>


										</tbody>
									</table>
									<div class="kkk" style="text-align: right; margin-top: 10px;">
										<button class="lll" onclick="window.location.href='add-user.php'">Add User</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end: BASIC EXAMPLE -->
				<!-- end: SELECT BOXES -->

			</div>
		</div>
		</div>
		<!-- start: FOOTER -->
		<!-- end: FOOTER -->

		<!-- start: SETTINGS -->

		<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="../assets/admin-assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="../assets/admin-assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>

	</html>
<?php  ?>