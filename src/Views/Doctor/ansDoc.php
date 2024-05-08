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
    <h1>Welcome, Dr. [Doctor's Name]</h1>
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
  <section id="questions">
    <h2>Answer Patient Questions</h2>
    <ul>
      <li>
        <strong>Patient Name:</strong> [Patient's Name]<br><br>
        <strong>Question:</strong> [Patient's Question]<br><br>
        <form action="#" method="POST">
          <label for="answer">Your Answer:</label><br>
          <textarea id="answer" name="answer" required></textarea><br>
          <button type="submit">Submit Answer</button>
        </form>
      </li>
      <li>
        <strong>Patient Name:</strong> [Patient's Name]<br><br>
        <strong>Question:</strong> [Patient's Question]<br><br>
        <form action="#" method="POST">
          <label for="answer">Your Answer:</label><br>
          <textarea id="answer" name="answer" required></textarea><br>
          <button type="submit">Submit Answer</button>
        </form>
      </li>
      <!-- Repeat for each question -->
    </ul>
  </section>
  </main>
</body>

</html>