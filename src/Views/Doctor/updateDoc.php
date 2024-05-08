


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
        <li><a href="blog.php">Post Blog</a></li>
        <li><a href="../Auth/logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  <section id="update-details">
    <h2 style="margin-bottom: 20px">Update Your Details</h2>
    <form action="#" method="POST">
      <label for="firstName">First Name:</label>
      <input type="text" id="name" name="firstName" required>

      <label for="lastName">Last Name:</label>
      <input type="text" id="name" name="lastName" required>

      <label for="speciality">Speciality:</label>
      <input type="text" id="speciality" name="speciality" required>

      <label for="about">About:</label>
      <input type="text" id="about" name="about" required>

      <label for="location">Location:</label>
      <input type="text" id="location" name="location" required>

      <label for="insurance">Insurance Accepted:</label>
      <textarea id="insurance" name="insurance" required></textarea>

      <button type="submit">Update Details</button>
    </form>
  </section>
  </main>
</body>

</html>