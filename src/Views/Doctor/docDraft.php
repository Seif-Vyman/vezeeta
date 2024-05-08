<?php
  require_once ('../../Controllers/DBController.php');
  require_once ('../../Models/Doctor.php');
  session_start();
  $doc = new Doctor;
  if(isset($_SESSION["userName"])){
    if($_SESSION['userRole'] != "Doctor"){
      header("Location: ../Auth/login.php");  
    }
  }else{
    echo"shit";
    header("Location: ../Auth/login.php");
  }



  $db = new DBController;
  $doc = new Doctor; 
 

   

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="docDraft2.css" />
  <title>Doctor Dashboard</title>
</head>
<body>
  <header>
    <h1>Welcome, Dr. <?php echo $_SESSION["userName"]?></h1>
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
  <main>
    <section id="doctor-details">
      <h2>Your Details</h2>
      <p><strong>Name:</strong><?php echo $_SESSION['userName']?></p>
      <p><strong>Speciality:</strong> <?php echo $_SESSION['speciality'] ?></p>
      <p><strong>About:</strong> <?php echo $_SESSION['description'] ?></p>
      <p><strong>Location:</strong> <?php echo $_SESSION['address'] ?></p>
      <p><strong>Insurance Accepted:</strong> [List of Accepted Insurances]</p>
    </section>
  </main>
</body>
</html>