<?php
require_once '../../Models/Product.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/ProductController.php';
session_start();
//print_r($_SESSION);
//error_reporting(0);
$db = new DBController;
$pharmacy = new ProductController;
$products = $pharmacy->getAllProducts();
//$db->openConnection();
if (strlen($_SESSION['userId'] == 0)) {
	header('location: logout.php');
} else {


	if(isset($_POST['del'])){
		
		//print_r($_POST);
		
		  if ($pharmacy->deleteProduct($_POST['i'])) {
			$deleteMsg = true;
			
			$products = $pharmacy->getAllProducts();
			 header('Location: edit-products.php');
		  }
	}

	if(isset($_POST['edit'])){
		
				$_SESSION['Ei'] =  $_POST["i"];
        $_SESSION['En'] = $_POST['n'];
        $_SESSION['Ep'] = $_POST['p'];
        $_SESSION['Eq'] = $_POST['q'];
        $_SESSION['Eim'] = $_POST['im'];
		header('Location: edit.php');
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
									<h1 class="mainTitle">Admin | View Products</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>View Products</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">


							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Products</span></h5>
									<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
										<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">ID</th>
												<th class="hidden-xs">Name</th>
												<th>Price </th>
												<th>Quantity </th>
												<th>Image </th>
												<th>Action</th>

											</tr>
										</thead>
										<tbody>
											<?php
											$cnt = 0;
											   foreach($products as $product ){
											?>

												<tr>
													<td class="center"><?php echo $product['prodId']; ?>.</td>
													<td><?php echo $product['prodName']; ?></td>
													<td><?php echo $product['prodPrice']; ?></td>
													<td><?php echo $product['quantity']; ?></td>
													<td><?php echo $product['image']; ?>
													</td>

													<td>
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															
															<form action="" method="post">
																<input type="submit" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit" value="delete" name = "del">
																<input type="submit" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit" value="edit" name="edit">
																<input type="hidden" value="<?php echo $product['prodId'] ?>" name="i">
																<input type="hidden" value="<?php echo $product['prodName'] ?>" name="n">
																<input type="hidden" value="<?php echo $product['prodPrice'] ?>" name="p">
																<input type="hidden" value="<?php echo $product['quantity'] ?>" name="q">
																<input type="hidden" value="<?php echo $product['image'] ?>" name="im">
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
										<button class="lll" onclick="window.location.href='add-products.php'">Add Product</button>
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