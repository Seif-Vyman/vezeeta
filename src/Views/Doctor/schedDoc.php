<?php 
session_start();
require_once('../../Controllers/DBController.php');
require_once('../../Models/Doctor.php');

$db = DBController::singleton();
$doc = new Doctor;
$appointments = $doc->getAppointments("booked");


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/docDraft2.css" />
  <title>Doctor Dashboard</title>
</head>

<body>
  <header>
    <h1>Welcome, Dr. <?php echo $_SESSION['userName']; ?></h1>
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
    <h2>Scheduled Appointments</h2>
    <ul>
      <?php 
        foreach($appointments as $appointment){
      ?>
      <li>
        <span>
          <strong>Date:</strong><?php echo $appointment['date'] ?><br>
        </span><br>
        <span>
          <strong>Time:</strong><?php echo $appointment['time'] ?> <br>
        </span><br>
        <span>
          <strong>Patient Name:</strong><?php echo $appointment['firstName']." ".$appointment['lastName'] ?><br>
        </span><br>
      </li>
      <?php } ?>
      
      <!-- Repeat for each appointment -->
    </ul>
  </section>
  </main>
</body>

</html>