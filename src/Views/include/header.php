<?php
require_once '../../Controllers/ProductController.php';
$prod = ProductController::singleton();

if (isset($_GET["logout"])) {
  if(!isset($_SESSION))
    session_start();  
  session_destroy();
  header("location: index.php");

  // session_destroy();
}
?>
<header>
  <div class="header-area ">
    <div class="header-top_area">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-md-6 ">
            <div class="social_media_links">
              <a href="#">
                <i class="fa fa-linkedin"></i>
              </a>
              <a href="#">
                <i class="fa fa-facebook"></i>
              </a>
              <a href="#">
                <i class="fa fa-google-plus"></i>
              </a>
            </div>
          </div>            
            <div class="col-xl-6 col-md-6">
              <div class="short_contact_list">
                <ul>
                  <li><a href="contact.html"> <i class="fa fa-envelope"></i>Contact Support</a></li>
                  <li><a href="#"> <i class="fa fa-phone"></i> 160160</a></li>
                  <?php if(isset($_SESSION['userId'])){?>
                  <li>
                    <form action="" method="GET">
                      <input type="hidden" name="logout" value="Login" />
                      <button type="submit" name="logout" style="font-family: Arial, sans-serif; font-size: 13px; background-color: #007bff; color: #fff; padding: 5px 6px 7px 6px; border: none; border-radius: 5px; cursor: pointer; margin-left: 25px;">Logout</button>
                    </form>
                  </li>
                  <?php }?>
                  <?php if(!isset($_SESSION['userId'])) { ?>
                    <li><a class="active" href="../Auth/login.php">Sign Up</a></li>
                  
                  <?php }?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="sticky-header" class="main-header-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-xl-3 col-lg-2">
              <div class="logo">
                <a href="index.php">
                  <img src="../images/logo.png" alt="">
                </a>
              </div>
            </div>
            <div class="col-xl-6 col-lg-7">
              <div class="main-menu  d-none d-lg-block">
                <nav>
                  <ul id="navigation">
                    <li><a class="active" href="index.php">home</a></li>
                    <li><a href="pharmacy.php">Pharmacy</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="#">Ask</a></li>
                    <li><a href="Doctors.php">Doctors</a></li>
                    <li><a href="user_profile.php">Profile</a></li>
                    <li><a href="cart-page.php">Cart</a></li>
                  </ul>
                </nav>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
            <div class="Appointment">
              <div class="book_btn d-none d-lg-block">
                <a href="../Patient/search.php">Search</a>
               </div>
            </div>
            <div class="col-12">
              <div class="mobile_menu d-block d-lg-none"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
</header>