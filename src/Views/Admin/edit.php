<?php
require_once '../../Models/Product.php';
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/ProductController.php';
session_start();
//print_r($_SESSION);
//error_reporting(0);
$db = DBController::singleton();
$product = new Product;
$product->setId($_SESSION['Ei']);
$product->setName($_SESSION['En']);
$product->setPrice($_SESSION['Ep']);
$product->setQuantity($_SESSION['Eq']);
$product->setImage($_SESSION['Eim']);
//print_r($_SESSION);	
//$pharmacy = ProductController::singleton();
//$products = $pharmacy->addProduct(Product $product);
//include('include/config.php');
if (strlen($_SESSION['userId'] == 0)) {
	header('location:logout.php');
} else {

	if (isset($_POST['save'])) {
    $productss = ProductController::singleton();
		$product->setName($_POST['name']);
		$product->setPrice($_POST['price']);
		$product->setQuantity($_POST['quantity']);
		$product->setImage($_POST['image']);
    $productss->UpdateProduct($product);
		header('Location: edit-products.php');
		print_r($_SESSION);
    }
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | Edit Product</title>

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
									<h1 class="mainTitle">Admin | Edit Product</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Edit Product</span>
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
													<h5 class="panel-title">Edit Product</h5>
												</div>
												<div class="panel-body">

													<form role="form" name="adddoc" method="post" onSubmit="return valid();">


														<div class="form-group">
															<label for="productname">
																Product Name
															</label>
															<input type="text" name="name" class="form-control" value=<?php echo $product->getName() ?>>
														</div>

														<div class="form-group">
															<label for="productprice">
																Product Price
															</label>
															<input type="text" name="price" class="form-control" value=<?php echo $product->getPrice() ?>>
														</div>

														<div class="form-group">
															<label for="productquantity">
																Quantity
															</label>
															<input type="text" name="quantity" class="form-control" value=<?php echo $product->getQuantity() ?>>
														</div>

														<div class="form-group">
															<label for="productimage">
																Image
															</label>
															<input name="image" class="form-control" type="file" name="image" id="image" accept="image/*" value=<?php echo $product->getImage() ?>>
														</div>


														<button type="submit" name="save" id="save" class="btn btn-o btn-primary">
                                                            Save
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
<?php } ?>