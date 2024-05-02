
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/search.css">
</head>
<body>

<?php 
include 'header.php'; 

// include 'connect.php';
// $database = new Database();
// $connection = $database->conn;

 
 ?>


<div class="search-container">
    <h1>Doctor Search</h1>
    <form method="GET">
        <input type="text" name="query" placeholder="Name">
        <select name="speciality">
            <option value="">Select Speciality</option>
            <option value="Cardiologist">Cardiologist</option>
            <option value="Dermatologist">Dermatologist</option>
            <option value="dentist">Dentist</option>
            <!-- Add more specialities-->
        </select>
        <select name="city">
            <option value="">Select City</option>
            <option value="Cairo">Cairo</option>
            <option value="Alexandria">Alexandria</option>
            <!-- Add more cities-->
        </select>
        <input type="submit" name="submit" value="search">
    </form>
</div>

<div class="resultsCont">
    <table class="table">
        <?php
        include 'connect.php';
        class DoctorSearch {
            private $connection;
            public function __construct() {
                $db = new Database();
                $this->connection = $db->getConnection();
            }

            public function searchDoctors($query, $speciality, $city) {
                $query = $this->sanitizeInput($query);
                $speciality = $this->sanitizeInput($speciality);
                $city = $this->sanitizeInput($city);

                $sql = "SELECT * FROM doctor WHERE 1=1";
            // change table name and add user role condition
                if (!empty($query)) {
                    $sql .= " AND (CONCAT(firstName, ' ', lastName) LIKE '%$query%')";
                } else if (!empty($query)) {
                    $sql .= " AND (firstName LIKE '%$query%' OR lastName LIKE '%$query%')";
                }
                if (!empty($speciality)) {
                    $sql .= " AND speciality = '$speciality'";
                }
                if (!empty($city)) {
                    $sql .= " AND city = '$city'";
                }

                $result = $this->connection->query($sql);
                return $result;
            }

            private function sanitizeInput($input) {
                return $this->connection->real_escape_string($input);
            }

            public function close() {
                $this->connection->close();
            }
        }
    
    $search = new DoctorSearch();
    if (isset($_GET['query']) || isset($_GET['speciality']) || isset($_GET['city'])){
        $result = $search->searchDoctors($_GET['query'], $_GET['speciality'], $_GET['city']);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                    // echo '<a href="doctor_profile.php?id=' . $row['userId'] . '">';
                    echo '<a href="doctor_profile.php">';
                    echo '<div class="doctor-info">';
                    echo "<div class='profile-pic'><img src='" . $row['profilePic'] . "' alt='Profile Picture'></div>";
                    $fullName = ucfirst($row['firstName']) . ' ' . ucfirst($row['lastName']);
                    echo '<h2>' . $fullName . '</h2>';
                    echo '<p><strong>Speciality:</strong> ' . ucfirst($row['speciality']) . '</p>';
                    echo '<p><strong>City:</strong> ' . ucfirst($row['city']) . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
            } 
        else {
            echo "No results found.";
        }
    }
    // $result = $search->searchDoctors($_GET['query'], $_GET['speciality'], $_GET['city']);
    // if(mysqli_num_rows($result) > 0) {
    //     while($row = mysqli_fetch_assoc($result)) {
    //             // echo '<a href="doctor_profile.php?id=' . $row['userId'] . '">';
    //             echo '<a href="doctor_profile.php">';
    //             echo '<div class="doctor-info">';
    //             echo "<div class='profile-pic'><img src='" . $row['profilePic'] . "' alt='Profile Picture'></div>";
    //             $fullName = ucfirst($row['firstName']) . ' ' . ucfirst($row['lastName']);
    //             echo '<h2>' . $fullName . '</h2>';
    //             echo '<p><strong>Speciality:</strong> ' . ucfirst($row['speciality']) . '</p>';
    //             echo '<p><strong>City:</strong> ' . ucfirst($row['city']) . '</p>';
    //             echo '</div>';
    //             echo '</a>';
    //         }
    //     } 
    // else {
    //     echo "No results found.";
    // }

         ?>
    </table>
</div>


</body>
<style>
    .resultsCont a{
        margin:auto;
        /* width:70%; */
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
    }
    .doctor-info {
        background-color: #ffffff;
        border: 1px solid #cccccc;
        width:70%;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .doctor-info h2 {
        color: #007bff;
        font-size:1.5rem;
    }

    .doctor-info p {
        margin-bottom: 10px;
    }
    .profile-pic {
        margin-right: 20px;
    }

    .profile-pic img {
        width: 100px;
        height: 100px; 

    }

</style>


</html>