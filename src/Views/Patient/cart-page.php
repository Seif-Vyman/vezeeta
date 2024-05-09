<?php
session_start();
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/ProductController.php';
if(!isset($_SESSION['userId'])){
    header("location: ../Auth/login.php");
}
//           -------------------------- check names --------------------
// if (!isset($_SESSION["role"])) {

//   header("location:../Auth/login.php ");
// } else {
//   if ($_SESSION["userRole"] != "Patient") {
//     header("location:../Auth/login.php ");
//   }
// }
$controller = ProductController::singleton();

$products = $controller->getAllCartProducts($_SESSION['userId']);
//print_r($products);
$sum = 0;
foreach($products as $product){
    $sum += $product['productPrice'];
}
if(isset($_POST['remove'])){
    $controller->removeFromCart($_POST['name']);
    header("Location: cart-page.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../assets/css/cart-page.css">
        <script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- <div class="header">
            <p>LOGO</p>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div> -->
        <?php require_once('../include/headLinks.php'); ?>
        <?php require_once('../include/header.php'); ?>
        <div class="container-cart">
            <div class="cart">
                <div class="top-cart">
                    <h2>Shopping Cart</h2>
                    <h2><?php echo count($products) ?> Items</h2>
                </div>
                <table cellspacing="0" class="table-head ">
                    <tr>
                        <th width="150" class="head-img">Image</th>
                        <th width="210">Name</th>
                        <th width="150">Price</th>
                        <th width="150">quantity</th>
                        <th width="70">Delete</th>
                    </tr>
                </table>
                <table cellspacing="0">
                    <!-- start Products -->
                <?php 
                    $map = array("" => "");
                foreach($products as $product){
                    $id = $product["productId"];
                    if(isset($map[$id]))continue;
                    $quantity = 0;
                    foreach($products as $tmp){
                        if($tmp['productId'] == $id){
                            $quantity++;
                        }
                    }     
                    $map[$id] = "done";
                ?>    
                <tr>
                    <form method="post">
                        <td width="150"><div class="img-box"><img class="img" src="../Admin/assets/images/default-user.png"></div></td> <!--add product image-->
                        <input type="hidden" name="name" value="<?php echo $product['productName'];?>">
                        <td width="210"><p style='font-size:15px;'><?php echo $product['productName'];?></p></td>
                        <td width="150"><h2 style='font-size:15px; color:red; '>$<?php echo $product['productPrice'];?></h2></td>
                        <td width="150"><h2 style='font-size:15px; color:red; '><?php echo $quantity?></h2></td>
                        <td width="70"><button name="remove" style="border: none;" class='fa-solid fa-trash'></button></td>
                    </form>
                </tr>
                <?php } ?>
                </table>
                <hr>
            </div>

            <div class="summary">
                <div class="top-cart">
                    <h2>Order Summary</h2>
                </div>
                <div class="detail">
                    <h2 id="itemB"><?php echo count($products) ?> Items</h2>
                </div>
             
                <hr>
                <div class="top-cart">
                    <h2>Total</h2>
                    <h2 id="totalB">$ <?php echo $sum ?></h2>
                </div>
                <div style="padding: 0 10px; margin-bottom: 20px;">
                    <a href="checkout.php"><button class="checkout button-cart">Check out</button></a>
                </div>
            </div>
        </div>
        <!-- <script src="../assets/js/cart_page.js"></script> -->
    </body>
    
    <?php require_once('../include/footer.php'); ?>
</html>
   <!-- <div style="margin-top: 30px; padding: 0 30px;" >
                    <h2>Shipping</h2>
                    <input class="input-cart" type="text" placeholder="Standard deilivery">
                    <h2>Promo Code</h2>
                    <input class="input-cart" type="text" placeholder="Enter your code" id="promocode">
                    <button class="first-btn button-cart" id="promo" onclick="promo()">Apply</button>
                </div> -->