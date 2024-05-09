<!doctype html>
<html class="no-js" lang="zxx">
<?php
session_start();
require_once '../../Models/pharmacy.php';
require_once('../../Models/user.php');
$pharmacy = Pharmacy::singleton();

if(isset($_GET['searchButton'])){
  if(!empty($_GET['search'])){
    $products = $pharmacy->searchProduct($_GET['search']);
  }
  else{
    $products = $pharmacy->getAllProducts();
  }
}
else{
  $products = $pharmacy->getAllProducts();

}

if (isset($_POST['add'])){
  if(!isset($_SESSION['userId'])){
    
    header("Location: ../Auth/login.php");
  }

  $product = new Product;
  $user = new User;
  $product->setId($_POST['prodId']);
  $user->setFirstName($_SESSION['firstName']);
  $user->setLastName($_SESSION['lastName']);
  $user->setEmail($_SESSION['email']);
  $user->setUserId($_SESSION['userId']);
  $product->setName($_POST['prodName']);
  $product->setPrice($_POST['prodPrice']);
  $product->setImage($_POST['prodImage']);
  $user->addToCart($product);
}
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Docmed</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- <link rel="manifest" href="site.webmanifest"> -->
  <link rel="shortcut icon" type="../assets/images/x-icon" href="../assets/images/favicon.png">
  <link rel="icon" href="../assets/images/media/search/round_search_white_24dp.png" type="image/icon type">
  <!-- Place favicon.ico in the root directory -->

  <!-- CSS here -->
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../../css/magnific-popup.css">
  <link rel="stylesheet" href="../../css/font-awesome.min.css">
  <link rel="stylesheet" href="../../css/themify-icons.css">
  <link rel="stylesheet" href="../../css/nice-select.css">
  <link rel="stylesheet" href="../../css/flaticon.css">
  <link rel="stylesheet" href="../../css/gijgo.css">
  <link rel="stylesheet" href="../../css/animate.css">
  <link rel="stylesheet" href="../../css/slicknav.css">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- <link rel="stylesheet" href="../../css/searchbar.css"> -->
  <style>
    .breadcam_bg_3 {
      background-image: url(../assets/images/banner/bradcam4.jpg);
    }

    .cart_button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      color: #ffffff;
      background-color: #6db4ff;
      border: 2px solid #74aeec;
      border-radius: 5px;
      cursor: pointer;
    }

    .cart_button:hover {
      background-color: rgb(0, 156, 255);

      border-color: rgb(0, 156, 255);
    }

    /* search style start */
    

    .nemoStyle {
      margin-top: 15px;
      display: flex;
      justify-content: center;
    }


    /* div#hideall {
      position: fixed;
      top: 0%;
      height: 100%;
      width: 100%;
    } */

    .searchbutton {
      background: none;
      appearance: none;
      border: none;
    }

    div.middle {
      display: flex;
      justify-content: center;
    }

    .changeposition {
      order: -1;
    }


    /* XXX Small screens (320px and up) */
    @media only screen and (min-width: 320px) {

      .searchsection {
        position: relative;
        border: 1px solid lightgray;
        border-radius: 20px;
        display: flex;
        width: 300px;
        flex-direction: column;
      }

      .search {
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #81D4FA;
      }

      .searchbar {
        font-size: 10px;
        padding: 10px;
        border: none;
        width: 310px;
        margin-left: 10px;
        margin-top: 6px;
        margin-bottom: 6px;
        outline: none;
        border-radius: 30px;
        color: black;
        font-family: 'Roboto', sans-serif;
        cursor: pointer;
      }

      .searchbar:focus {
        background-color: #edf2fb;
        cursor: text;
      }

      .searchbar:hover {
        background-color: #edf2fb;
      }

      .searchimg {
        border-radius: 30px;
        padding: 5px;
        margin-top: 5px;
        margin-bottom: 2px;
        margin-right: 8px;
        cursor: pointer;
      }

      .searchimg:hover {
        background-color: #edf2fb;
      }

      .closeimg {
        display: none;
        outline: none;
        padding: 5px;
        margin-top: 5px;
        margin-bottom: 2px;
        margin-left: 8px;
        border-radius: 30px;
        cursor: pointer;
      }

      .closeimg:focus {
        background-color: #edf2fb;
      }

      .closeimg:hover {
        background-color: #edf2fb;
      }

      .list {
        display: none;
        position: relative;
        flex-wrap: wrap;
        font-size: 10px;
        padding: 0px;
        overflow: auto;
        max-height: 120px;
        width: 100%;
        opacity: 0;
        list-style-type: none;
        color: rgb(255, 255, 255);
      }

      .list:focus {
        background-color: #edf2fb;
      }

      .borderbetween {
        display: none;
        border-top: 1px rgb(224, 222, 222) dashed;
        margin-top: 10px;
        margin-bottom: 5px;
        width: 80%;
      }

      .section {
        padding-left: 5px;
        padding-right: 5px;
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
        cursor: pointer;
        color: black;
        font-family: 'Roboto', sans-serif;
      }

      .section:hover {
        background-color: rgb(235, 222, 222);
      }

      .noresult {
        display: none;
        padding-left: 5px;
        padding-right: 5px;
        padding-top: 10px;
        padding-bottom: 10px;
        color: #9c9a97;
        text-align: center;
        cursor: default;
        border-radius: 10px;
        font-family: 'Roboto', sans-serif;
      }

    }

    /* X Small screens (425px and up) */
    @media only screen and (min-width: 425px) {}

    /* Small screens (640px and up) */
    @media only screen and (min-width: 640px) {
      .searchbar {
        font-size: 12px;
      }

      .list {
        font-size: 12px;
        max-height: 180px;
      }

      .searchsection {
        width: 400px;
      }

      .searchimg {
        margin-right: 8px;
      }

      .closeimg {
        margin-left: 8px;
      }
    }

    /* Medium screens (768px and up) */
    @media only screen and (min-width: 768px) {
      .searchbar {
        font-size: 14px;
      }

      .list {
        font-size: 14px;
      }
    }

    /* Large screens (1024px and up) */
    @media only screen and (min-width: 1024px) {}

    /* X Large screens (1280px and up) */
    @media only screen and (min-width: 1280px) {}

    /* XX Large screens (1536px and up) */
    @media only screen and (min-width: 1536px) {

      .searchbar {
        font-size: 16px;
      }

      .list {
        font-size: 16px;
      }
    }

    /* XXX Large screens (2560px and up) */
    @media only screen and (min-width: 2560px) {

      .list {
        max-height: 240px;
      }
    }

    .hide {
      visibility: hidden;
      opacity: 0;
      transition: visibility 0.5s, opacity 0.5s;
    }

    .show {
      display: initial;
      visibility: visible;
      opacity: 1;
      transition: visibility 0.5s, opacity 0.5s;
    }

    .remove {
      display: none;
    }

    .add {
      display: initial;
    }

    input[type="search"]::-webkit-search-decoration,
    input[type="search"]::-webkit-search-cancel-button,
    input[type="search"]::-webkit-search-results-button,
    input[type="search"]::-webkit-search-results-decoration {
      display: none;
    }

    /* search style end */
  </style>
  <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
  <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

  <!-- header-start -->
  <?php require_once('../include/header.php'); ?>
  <!-- header-end -->

  <!-- body-start -->

  <!-- bradcam_area_start  -->
  <div class="bradcam_area breadcam_bg_3 bradcam_overlay">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="bradcam_text">
            <h3>Pharmacy</h3>
            <p><a href="index.html">Home /</a> Pharmacy</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- bradcam_area_end  -->
  <div class= "nemoStyle">

    <div onclick="hideallfunction()" id="hideall"></div>

    <div id="search-section-js" class="searchsection">
      <div role="search" class="search">
        <form action="" method="get">
        <input tabindex="1" id="search-bar-js" class="searchbar" type="search" aria-label="Search text" placeholder="Search..." name="search">
        <button tabindex="-1" class="searchbutton" id="close-img-js" aria-label="Cancel"><img src="../assets/images/media/close/round_close_black_24dp.png" alt="cancel" class="closeimg globalsearchremove" class="searchbutton" id="close-img-js" aria-label="Cancel"></button>
        <button tabindex="2" class="searchbutton" name = "searchButton" id="search-img-js" aria-label="Search"><img src="../assets/images/media/search/round_search_black_24dp.png" alt="search" class="searchimg"></button>
      </div>
        </form>
        
      <div class="middle">
        <div class="borderbetween globalsearchremove"></div>
      </div>
      <div class="middle">
        <ul tabindex="3" class="list globalsearchremove">
          <li class="section" role="option">Content 1</li>
          <li class="section" role="option">Content 2</li>
          <li class="section" role="option">Content 3</li>
          <li class="section" role="option">Content 4</li>
          <li class="section" role="option">Content 5</li>
          <li class="section" role="option">Content 6</li>
          <li class="noresult">No Result</li>
        </ul>
      </div>
    </div>
  </div>

  <script src="../../js/searchbar.js" defer></script>
  <!-- expert_doctors_area_start -->
  <div class="expert_doctors_area doctor_page">
    <div class="container">
      <div class="row">
        <!-- start  -->
        <?php
        foreach ($products as $product) {
        ?>
          <div class="col-md-6 col-lg-3">
            <form action="" method="post">
              <div class="single_expert mb-40">
                <div class="expert_thumb">
                  <img src="../assets/images/pharmacy/detol.jpg" alt="">
                </div>
                <div class="experts_name text-center">
                  <h3><?php echo $product['prodName'] . " $" . $product['prodPrice']; ?></h3>
                  <input type="hidden" value="<?php echo $product['prodName']; ?>" name="prodName">
                  <input type="hidden" value="<?php echo $product['prodPrice']; ?>" name="prodPrice">
                  <input type="hidden" value="<?php echo $product['image']; ?>" name="prodImage">
                  <input type="hidden" value="<?php echo $product['prodId']; ?>" name="prodId">
                  <input type="submit" class="cart_button" value="add to cart" name="add">
                </div>
              </div>
            </form>
          </div>        
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <!-- expert_doctors_area_end -->

  <!-- body-end -->

  <!-- footer start -->
  <?php require_once('../include/footer.php'); ?>
  <!-- footer end  -->
</body>

</html>