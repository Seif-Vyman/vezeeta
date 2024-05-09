<?php
require_once('../../Controllers/DBController.php');
require_once('../../Models/Doctor.php');
session_start();
$doc = new Doctor;

if (isset($_SESSION["userName"])) {
  if ($_SESSION['userRole'] != "Doctor") {
    header("Location: ../Auth/login.php");
  }
} else {
  echo "shit";
  header("Location: ../Auth/login.php");
}

$db = DBController::singleton();
$doc = new Doctor;
$appointments = $doc->getAppointments("available");

if(isset($_POST["delete"])){
  if (!empty($_POST["scheduleId"])) {
    if ($doc->deleteSchedule($_POST["scheduleId"])) {
      $deleteMsg = true;
      $appoitments = $doc->getAppointments("available");
    }
  }
}
if(isset($_GET['add'])){
  if(!empty($_GET['date']) && !empty($_GET['time'])){
    // $_SESSION['date'] =  $_GET['date'];
    // $_SESSION['time'] =  $_GET['time'];
    $app = new Schedule($_GET['date'], $_GET['time']);
    if ($doc->addSchedule($app)) {
      header("location: updateAppointments.php");
  } else {
      $errMsg = "Something went wrong... try again";
  }
  }
}
// $doc->setEmail($_SESSION['email']);

// kamel el ba2y b2a
/*
   te3mel form ta5od menha mwa3ed el schedule w te3mel class esmo schdule w tb3to lel db controller tem3mel feha function add schedule
   $db -> addSchedule("object mn el schedule" , $me);
   
   */



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/docDraft2.css" />
  <title>UpdateApp</title>



  <style>
    /* UPDATE APPOINTMENTS */
    input[type=submit] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      /* align-self: flex-end; */
    }


    .search-container {
      position: relative;
    }

    .search-btn,
    .del-btn {
      padding: 10px 20px;
      margin-top: 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 25rem;
      /* position:fixed;
  right:0; */
    }

    .popup-container {
      width: fit-content;
      padding: 20px;
      margin: 20px;
      height: 300px;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #fff;
      border: 2px solid #007bff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      z-index: 999;
    }

    .popup-content {
      padding: 20px;
      margin: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100% - 50px);
    }

    .popup-content input,
    .popup-content select {
      /* margin: 20px; */
      display: flex;
      flex-direction: column;
      border: 2px solid #007bff;
      border-radius: 5px;

    }


    .exit-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: transparent;
      border: none;
      font-size: 20px;
      cursor: pointer;
      color: #333;
    }

    .appointment-btn-container {
      margin-left: auto;
    }
  </style>

</head>



<body>
  <header>
    <h1>Welcome, Dr. <?php echo $_SESSION['userName']?></h1>
    <nav>
      <ul>
        <li><a href="docDraft.php">Profile</a></li>
        <li><a href="updateDoc.php">Update Details</a></li>
        <li><a href="ansDoc.php">Answer Questions</a></li>
        <li><a href="schedDoc.php">Scheduled Appointments</a></li>
        <li><a href="updateAppointments.php">Update Appointments</a></li>
        <li><a href="blog.php">Post Blog</a></li>
        <li><a href="../Auth/logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>





  <section id="appointments">
    <h2>Available Appointments</h2>
    <div class="container">
      <div class="appointment-btn-container">
        <button class="search-btn">Add Appointments</button>
      </div>
      <!-- <button class="search-btn" onclick="toggleAdd()">Add Appointments</button> -->
      <div class="popup-container" id="popupContainer">
        <div class="popup-content">
          <button class="exit-btn" onclick="closeAdd()">✕</button>
          <form method="GET">
            <input type="text" id="datepicker" name="date" placeholder="Choose Date" autocomplete="off">
            <input type="text" id="timepicker" name="time" style="margin-top:20px; margin-bottom:20px" placeholder="Choose Time" autocomplete="off">
            <input type="submit" name = "add" value="Add">
          </form>
        </div>
      </div>

    </div>




    <ul>
      <?php
      foreach ($appointments as $appointment) {
      ?>
        <form action = "updateAppointments.php" method="post">
        <li>
        <input type="hidden" name="scheduleId" value="<?php echo $appointment["id"] ?>">
          <button class="del-btn" name = "delete">Delete Appointments</button>
          <span>
            <strong>Date:</strong> <?php echo $appointment['date'] ?><br>
          </span><br>
          <span>
            <strong>Time:</strong><?php echo $appointment['time'] ?><br>
          </span><br>
        </li>
        </form>
      <?php
      }
      ?>

    </ul>
  </section>





  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>


  <script>
    $(document).ready(function() {
      $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoHide: true
      });
      $('#timepicker').timepicker({
        timeFormat: 'H:i', // Set time format to 24-hour (hours:minutes)
        interval: 60,
        scrollbar: true
      });
    });



    function toggleAdd() {
      var popupContainer = document.getElementById("popupContainer");
      if (popupContainer.style.display === "none" || popupContainer.style.display === "") {
        popupContainer.style.display = "block";
      } else {
        popupContainer.style.display = "none";
      }
    }
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelector('.search-btn').addEventListener('click', toggleAdd);
    });

    function closeAdd() {
      var popupContainer = document.getElementById("popupContainer");
      popupContainer.style.display = "none";
    }
  </script>


</body>

</html>