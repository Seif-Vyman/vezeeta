<?php
 require_once('../include/headLinks.php'); 
require_once('../include/header.php'); 
require_once('../../Models/cart.php');
$controller = Cart::singleton();
if(isset($_POST['buy'])){
  $controller->removeCart();
  header('Location: sucessful-order.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/checkout-style2.css">
    <title>Complete your purchase</title>
</head>

<body class="body1">

    <!-- <header>
        <h1 class="logo">Shopping</h1>
        <ul class="menu-container">
            <li class="menu-item">Home</li>
            <li class="menu-item">Collections</li>
            <li class="menu-item">Products</li>
            <li class="menu-item red">For Sale</li>
        </ul>
        <div class="menu-icons-container">
           <img src="Resources/Search.svg" alt="" class="icon"> 
           <img src="Resources/Profile.svg" alt="" class="icon"> 
           <img src="Resources/Cart.svg" alt="" class="icon"> 
        </div>
    </header> -->
    
    <div class="inner-checkout">
    <div class="progress-checkout-container">
        <div class="progress-step-container">
            <div class="step-check"></div>
            <span class="step-title">Shipping</span>
        </div>
        <div class="progress-step-container">
            <div class="step-check"></div>
            <span class="step-title">Payment</span>
        </div>
        <div class="progress-step-container">
            <div class="step-check"></div>
            <span class="step-title">Review</span>
        </div>
    </div>
    
    <div class="form-container">
        <h2 class="form-title">Payment Details</h2>
        <form action="" class="checkout-form" method="post">
            <div class="input-line">
                <label for="name">Name on card</label>
                <input type="text" name="name" id="name" placeholder="Your name and surname" required>
            </div>
            <div class="input-line">
                <label for="name">Card number</label>
                <input type="text" name="name2" id="name" placeholder="1111-2222-3333-4444" required>
            </div>
            <div class="input-container">
                <div class="input-line">
                    <label for="name">Expiring Date</label>
                    <input type="text" name="name3" id="name" placeholder="09-21" required>
                </div>
                <div class="input-line">
                    <label for="name">CVC</label>
                    <input type="text" name="name4" id="name" placeholder="***" required>
                </div>
            </div>
            <input type="submit" value="Complete purchase" name="buy">
        </form>
    </div>
    </div>

</body>
<?php require_once('../include/footer.php'); ?>
</html>