
<?php
        require_once '../../Models/patient.php';
        require_once '../../Controllers/DBController.php'; 
        require_once '../../Models/doctor.php';
        require_once '../../Models/user.php';
        require_once '../../Models/feedback.php';
        $patient = new Patient();
        $db= new DBController();
        session_start(); 
        if($db->openConnection())
        {
            $doctorId = isset($_GET['id']) ? $_GET['id'] : 3;
            $doctor = $db->getDoctorById($doctorId);
            $user = $db->getUserById($doctorId);
        }
        else
        {
           echo "Error in Database Connection";
           return false; 
        }
        if (isset($_POST['book_button'])) {
            if (!isset($_SESSION['userId']) || ($_SESSION['userRole']!='Patient')){
                echo "Please <a href='../Auth/login.php'>log in</a> to book appointments.";  

                // FIX LOGIN CHECK

                header("Location: ../Auth/login.php");
                exit(); 
            }
            if (isset($_POST['appointment_id'])) {
                $appointmentId = $_POST['appointment_id'];
                $patient->bookAppointment($appointmentId,$_SESSION['userId']);
            }
            else {
                echo "Issue Occurred";
            }
        }
        
        ?>


<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Doctor Profile</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="../assets/images/x-icon" href="img/favicon.png">
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
    <link rel="stylesheet" href="../assets/css/doctor_profile.css">

    <style>
        .book-appointment {
        margin-top: 10px; 
        text-align: center;
    }

        .book-appointment a {
        background-color: #009DFF; 
        color: #fff; 
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
    }


    </style>
</head>
<body>
    <header>
        <?php 
         
         require_once '../include/headLinks.php'; 
         require_once '../include/header.php'; 
        //  require_once '../../connect.php';
         
        
        // $db = new Database();
        
        // $doctorId = isset($_GET['id']) ? $_GET['id'] : 3;
        // $doctor = $db->getDoctorById($doctorId);
        // $user = $db->getUserById($doctorId);
        ?>






        
    </header>

    <main>
    
    <section class="doctor-profile">
        <div class="container">
            <div class="profile-header">
            <div class="profile-info">
                <h1><?php echo $user->getFirstName().' '.$user->getLastName(); ?></h1>
                <p class="speciality"><?php echo $doctor->getSpeciality(); ?></p>
                    <div class="ratings">
                    <span class="rating"><?php echo $doctor->getRating(); ?></span>
                    <span class="stars">★★★★★</span>
                    </div>
                </div>
            </div>
        </div>
</section>


                <div class="profile-body">
                    
                    <ul class="details">
                        <p><?php echo $doctor->getDescription(); ?></p>                        
                        <!-- <li><strong>Phone:</strong><?php echo $user->getphoneNum(); ?></li> -->
                        <br>
                        <div class="line"></div>
                        <br>
                        <h3>Feedback</h3><br>
                        <?php
                        $feedbacks = $db->getFeedbacksById($doctorId);
                        if ($feedbacks) {
                            echo '<div class="feedback-container">';
                            foreach ($feedbacks as $feedback) {
                                echo '<li>';
                                echo '<strong>Patient Name:</strong> ' . $feedback->getPatientName() . '<br>';
                                echo '<strong>Feedback:</strong> ' . $feedback->getContent() . '<br>';
                                echo '</li><br>';
                            }
                            echo '</div>';
                        } else {
                            echo "No feedback found for doctor ";
                        }
                        ?>
                        <div class="feedback-container">
                        <!-- <li>
                            <strong>Patient Name:</strong> [Patient's Name]<br>
                            <strong>Feedback:</strong> [Patient's feedback]<br>
                        </li>
                        <br>
                        <li>
                            <strong>Patient Name:</strong> [Patient's Name]<br>
                            <strong>Feedback:</strong> [Patient's feedback]<br>
                        </li>
                        <br>
                        <li> -->
                            <strong>Patient Name:</strong> [Patient's Name]<br>
                            <form action="#" method="POST">
                              <strong>Feedback:</strong><br>
                              <textarea id="answer" name="answer" required></textarea><br>
                              <button type="submit">Submit Feedback</button>
                            </form>
                          </li>
                        </div>
                    </ul>
                    <div class="bookinginfo">
                        <div class="booking-title"><h3>Booking Information</h3></div>
                        
                    <ul>
                        <ul>
                        
                            <li><strong>Fees:</strong> <?php echo $doctor->getFees(); ?> </li>
                            <li><strong>Phone:</strong><?php echo $user->getphoneNum(); ?></li>
                            <li><strong>Location:</strong> <?php echo $doctor->getAddress(); ?></li>
                            <?php
                            $doc=new Doctor();
                            $appointments = $doc->displayAppointments($doctorId);
                            if (isset($appointments) && !(empty($appointments)))
                            {
                                foreach ($appointments as $appointment) {
                                    if ($appointment['status'] === 'available'){
                            ?>
                            <li style="margin: 20px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                                <strong>Date:</strong> <?php echo $appointment['date']; ?><br>
                                <strong>Time:</strong> <?php echo $appointment['time']; ?><br>
                                <div class="book-appointment" style="padding-bottom:20px; margin:5px;">
                                    <form method="POST">
                                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                        <button type="submit" class="book-appointment" style="cursor:pointer;" name="book_button">Book</button>
                                    </form>
                                </div>
                            </li>
                            <?php
                                    }
                                }
                            }
                            else{
                                echo "No appointments available.";
                            }
                            ?>
                        </ul>
                        <br>
                    </ul>
                    
                    </div>
                </div>
            </div>
    
        </section>

        
        
    </main>

    

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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <form id="test-form" class="white-popup-block mfp-hide">
        <div class="popup_box ">
            <div class="popup_inner">
                <h3>Make an Appointment</h3>
                <form action="#">
                    <div class="row">
                        <div class="col-xl-6">
                            <input id="datepicker" placeholder="Pick date">
                        </div>
                        <div class="col-xl-6">
                            <input id="datepicker2" placeholder="Suitable time">
                        </div>
                        <div class="col-xl-6">
                            <select class="form-select wide" id="default-select" class="">
                                <option data-display="Select Department">Department</option>
                                <option value="1">2</option>
                                <option value="2">3</option>
                                <option value="3">4</option>
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <select class="form-select wide" id="default-select" class="">
                                <option data-display="Doctors">Doctors</option>
                                <option value="1">2</option>
                                <option value="2">3</option>
                                <option value="3">4</option>
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <input type="text"  placeholder="Name">
                        </div>
                        <div class="col-xl-6">
                            <input type="text"  placeholder="Phone no.">
                        </div>
                        <div class="col-xl-12">
                            <input type="email"  placeholder="Email">
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="boxed-btn3">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
    <!-- form itself end -->

    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/gijgo.min.js"></script>
    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>

    <script src="js/main.js"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }

        });
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
    </script>

    
</body>
</html>



