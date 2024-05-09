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
    header("Location: ../Auth/login.php");
  }

  if(isset($_POST['post'])){
    if(!empty($_POST['header']) && !empty($_POST['content'])){
      //echo $_SESSION['firstName'];
      if($doc->postBlog($_POST['header'],$_POST['content'])){
        header("refresh: blog.php");
      }
      else{
        $errMsg = "Something went wrong... try again";
      }  
    }
    else{


    }
  }



  $db = DBController::singleton();
  $doc = new Doctor; 
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
  <title>Doctor Dashboard</title>
</head>

<body>
  <header>
    <h1>Welcome, Dr. [Doctor's Name]</h1>
    <nav>
    <ul>
        <li><a href="docDraft.php">Profile</a></li>
        <li><a href="updateDoc.php">Update Details</a></li>
        <li><a href="ansDoc.php">Answer Questions</a></li>
        <li><a href="schedDoc.php">Scheduled Appointments</a></li>
        <li><a href="updateAppointments.php">Update Appointments</a></li>
        <li><a href="#postblog">Post Blog</a></li>
        <li><a href="../Auth/logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  <section id="questions">
    <h2>Post Blog</h2>
    <ul>
      <li>
        
        <form action="#" method="POST">
        <label for="header">Your Header:</label><br>
          <textarea id="header" name="header" required></textarea><br>
          <label for="answer">Your Content:</label><br>
          <textarea id="answer" name="content" required></textarea><br>
          <button type="submit" name="post">Post</button>
        </form>
      </li>
      <!-- Repeat for each question -->
    </ul>
  </section>
  </main>
</body>

</html>