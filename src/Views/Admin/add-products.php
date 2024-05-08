<?php
require_once '../../Models/Product.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/ProductController.php';
session_start();
//print_r($_SESSION);
//error_reporting(0);
$db = new DBController;
//$pharmacy = new ProductController;
//$products = $pharmacy->addProduct(Product $product);
//include('include/config.php');
if (strlen($_SESSION['userId'] == 0)) {
	//header('location:logout.php');
	print_r($_SESSION);
} else {

	if (isset($_POST['submit'])) {
		$prodName = $_POST['prodName'];
		$prodPrice = $_POST['prodPrice'];
		$quantity = $_POST['quantity'];
		$image = $_POST['image'];

		$db->openConnection();

		$result = $db->insert("INSERT INTO pharmacy (prodName, prodPrice, quantity, image) VALUES ('$prodName', '$prodPrice', '$quantity', '$image')");
		if ($result !== false) {
			echo "<script>alert('Product info added Successfully');</script>";
			echo "<script>window.location.href ='edit-products.php'</script>";
		} else {
			echo "Error: " . mysqli_error($db->connection);
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | Add Product</title>

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
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<script type="text/javascript">
			function valid() {
				if (document.adddoc.npass.value != document.adddoc.cfpass.value) {
					alert("Password and Confirm Password Field do not match  !!");
					document.adddoc.cfpass.focus();
					return false;
				}
				return true;
			}
		</script>


		<script>
			function checkemailAvailability() {
				$("#loaderIcon").show();
				jQuery.ajax({
					url: "check_availability.php",
					data: 'emailid=' + $("#docemail").val(),
					type: "POST",
					success: function(data) {
						$("#email-availability-status").html(data);
						$("#loaderIcon").hide();
					},
					error: function() {}
				});
			}
		</script>
	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">

				<?php include('include/header.php'); ?>

				<!-- end: TOP NAVBAR -->
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Add Product</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Add Product</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">

									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Add Product</h5>
												</div>
												<div class="panel-body">

													<form role="form" name="adddoc" method="post" onSubmit="return valid();">


														<div class="form-group">
															<label for="productname">
																Product Name
															</label>
															<input type="text" name="prodName" class="form-control" placeholder="Enter Product Name" required="true">
														</div>

														<div class="form-group">
															<label for="productprice">
																Product Price
															</label>
															<input type="text" name="prodPrice" class="form-control" placeholder="Enter Product Price" required="true">
														</div>

														<div class="form-group">
															<label for="productquantity">
																Quantity
															</label>
															<input type="text" name="quantity" class="form-control" placeholder="Enter Product Quantity" required="true">
														</div>

														<div class="form-group">
															<label for="productimage">
																Image
															</label>
															<input  name="image" class="form-control"  type="file" name="image" id="image" accept="image/*" required required="true">
														</div>

											
														<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
															Submit
														</button>
													</form>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="panel panel-white">


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
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
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
<?php } ?>