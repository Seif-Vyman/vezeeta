<!--Website: wwww.codingdung.com-->
<?php
require_once '../../Controllers/DBController.php';
require_once '../../Controllers/AuthController.php';
require_once '../../Controllers/UsersController.php';
require_once '../../Models/user.php';
require_once '../../Models/patient.php';
$err = "";
$dbController = DBController::singleton();

session_start();
if (empty($_SESSION['userId']))
    header("location: ../Auth/login.php");
if (isset($_POST['save'])) {
    $Userss = UsersController::singleton();
    $user = new User;
    $_SESSION['firstName'] = $_POST['FName'];
    $_SESSION['lastName'] = $_POST['LName'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['phoneNum'] = $_POST['phone'];
    /////////////////////
    $user->setUserId($_SESSION['userId']);
    $user->setFirstName($_SESSION['firstName']);
    $user->setlastName($_SESSION['lastName']);
    $user->setEmail($_SESSION['email']);
    $user->setPassword($_SESSION['password']);
    $user->setPhoneNum($_SESSION['phoneNum']);
    $user->setCountry($_SESSION['country']);
    $user->setCity($_SESSION['city']);
    $user->setUserRole($_SESSION['userRole']);
    //print_r($user);
    $userInfo = $Userss->UpdateUser($user);
}


if (isset($_POST['save']) && hash('sha256',$_POST['pass']) == $_SESSION['password']) {
    $userchangepass = UsersController::singleton();
    $userchangepass->ChangePassword($_SESSION["userId"], hash('sha256',$_POST['password']));
} else {
    if (isset($_POST['save']) && $_POST['pass'] != null) {
        $err = "Wrong password try again";
    }
}

if (isset($_POST['save'])) {
    $addinsurance = UsersController::singleton();
    $addinsurance->AddInsurance($_SESSION["userId"], $_POST['Insurance'], $_POST['IDNumber'], $_POST['birthdate'], $_POST['ExpiryDate']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingDung | Profile Template</title>
    <link rel="stylesheet" href="../../css/user_profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

</head>

<body>
    <!-- header-start -->
    <?php include('../include/header.php'); ?>
    <!-- header-end -->
    <form method="post">
        <div class="container light-style flex-grow-1 container-p-y">
            <h4 class="font-weight-bold py-3 mb-4">
                My Profile
            </h4>
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Manage Profile</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change Password</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Insurance</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-notifications">Notifications</a>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                                <div class="card-body media align-items-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="d-block ui-w-80">
                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary">
                                            Upload new photo
                                            <input type="file" class="account-settings-fileinput">
                                        </label> &nbsp;
                                        <button type="button" class="btn btn-default md-btn-flat">Reset</button>
                                        <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control mb-1" name="FName" value=<?php if ($_SESSION['firstName'] != null) {
                                                                                                            echo $_SESSION['firstName'];
                                                                                                        } else if (isset($_POST['save']) && $_POST['FName'] != null) {
                                                                                                            echo $_POST['FName'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control mb-1" name="LName" value=<?php if ($_SESSION['lastName'] != null) {
                                                                                                            echo $_SESSION['lastName'];
                                                                                                        } else if (isset($_POST['save']) && $_POST['LName'] != null) {
                                                                                                            echo $_POST['LName'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        }
                                                                                                        ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" name="email" value=<?php if ($_SESSION['email'] != null) {
                                                                                                            echo $_SESSION['email'];
                                                                                                        } else if (isset($_POST['save']) && $_POST['email'] != null) {
                                                                                                            echo $_POST['email'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        }  ?>>

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <input type="text" class="form-control mb-1" name="country" value=<?php if ($_SESSION['country'] != null) {
                                                                                                                echo $_SESSION['country'];
                                                                                                            } else if (isset($_POST['save']) && $_POST['country'] != null) {
                                                                                                                echo $_POST['country'];
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control mb-1" name="city" value=<?php if ($_SESSION['city'] != null) {
                                                                                                                echo $_SESSION['city'];
                                                                                                            } else if (isset($_POST['save']) && $_POST['city'] != null) {
                                                                                                                echo $_POST['city'];
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>>
                                    </div>
                                    <h6 class="mb-4">Contacts</h6>
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" value=<?php if ($_SESSION['phoneNum'] != null) {
                                                                                                        echo $_SESSION['phoneNum'];
                                                                                                    } else if (isset($_POST['save']) && $_POST['phone'] != null) {
                                                                                                        echo $_POST['phone'];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    }  ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-change-password">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Current password</label>
                                        <input type="password" class="form-control" name="pass">
                                    </div>
                                    <?php

                                    if ($err != "") {
                                    ?>

                                        <div class="alert alert-danger" role="alert"><?php echo $err; ?></div>
                                    <?php
                                    }

                                    ?>
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Repeat new password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="account-info">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Add Insurance</label>
                                        <select class="custom-select" name="Insurance">
                                            <option>Select Insurance</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Egymed') echo 'selected'; ?>>Egymed</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Prime Health') echo 'selected'; ?>>Prime Health</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Egycare') echo 'selected'; ?>>Egycare</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Medright') echo 'selected'; ?>>Medright</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Medcom') echo 'selected'; ?>>Medcom</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Medi Gold') echo 'selected'; ?>>Medi Gold</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Axa') echo 'selected'; ?>>Axa</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'INAYA Egypt') echo 'selected'; ?>>INAYA Egypt</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Wadi El Nile') echo 'selected'; ?>>Wadi El Nile</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'MedSure') echo 'selected'; ?>>MedSure</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Tristar') echo 'selected'; ?>>Tristar</option>
                                            <option <?php if (isset($_POST['Insurance']) && $_POST['Insurance'] == 'Bupa') echo 'selected'; ?>>Bupa</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="FullName" value=<?php if ($_SESSION['firstName'] != null && $_SESSION['lastName'] != null) {
                                                                                                            echo $_SESSION['firstName'] . "" . $_SESSION['lastName'];
                                                                                                        } else if (isset($_POST['save']) && $_POST['FullName'] != null) {
                                                                                                            echo $_POST['FullName'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Birth Date</label>
                                        <input type="date" class="form-control" name="birthdate" value=<?php if (isset($_POST['save']) && $_POST['birthdate'] != null) {
                                                                                                            echo $_POST['birthdate'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>>
                                    </div>

                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body pb-2">

                                    <div class="form-group">
                                        <label class="form-label">ID Number</label>
                                        <input type="text" class="form-control" name="IDNumber" value=<?php if (isset($_POST['save']) && $_POST['IDNumber'] != null) {
                                                                                                            echo $_POST['IDNumber'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control" name="ExpiryDate" value=<?php if (isset($_POST['save']) && $_POST['ExpiryDate'] != null) {
                                                                                                            echo $_POST['ExpiryDate'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>>
                                    </div>
                                </div>
                            </div>



                            <div class="tab-pane fade" id="account-notifications">
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">Activity</h6>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked>
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Email me when someone comments on my article</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked>
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Email me when someone answers on my forum
                                                thread</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input">
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Email me when someone follows me</span>
                                        </label>
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">Application</h6>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked>
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">News and announcements</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input">
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Weekly product updates</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="switcher">
                                            <input type="checkbox" class="switcher-input" checked>
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                            <span class="switcher-label">Weekly blog digest</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
            <div class="text-right mt-3">
                <input type="submit" class="btn btn-primary" name="save" value="save changes">&nbsp;
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </form>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
    <br>
    <br>
    <br>
    <br>

    <!-- footer start -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="img/footer_logo.png" alt="">
                                </a>
                            </div>
                            <p>
                                Firmament morning sixth subdue darkness
                                creeping gathered divide.
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 offset-xl-1 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Departments
                            </h3>
                            <ul>
                                <li><a href="#">Eye Care</a></li>
                                <li><a href="#">Skin Care</a></li>
                                <li><a href="#">Pathology</a></li>
                                <li><a href="#">Medicine</a></li>
                                <li><a href="#">Dental</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Useful Links
                            </h3>
                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#"> Contact</a></li>
                                <li><a href="#"> Appointment</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Address
                            </h3>
                            <p>
                                200, D-block, Green lane USA <br>
                                +10 367 467 8934 <br>
                                docmed@contact.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end  -->



</body>

</html>