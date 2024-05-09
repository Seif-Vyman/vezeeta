
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/search.css">
</head>
<body>

<?php 
include '../include/headLinks.php'; 
include '../include/header.php'; 

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
        // include '../../connect.php';
        require_once '../../Controllers/DBController.php'; 
        class DoctorSearch {
            private $connection;
            public function __construct() {
                // $db = new Database();
                $db = DBController::singleton();
                $db->openConnection();
                $this->connection = $db->getConnection();
            }

            public function searchDoctors($query, $speciality, $city) {
                $query = $this->sanitizeInput($query);
                $speciality = $this->sanitizeInput($speciality);
                $city = $this->sanitizeInput($city);
                $sql = "SELECT * FROM user JOIN doctor ON user.userId = doctor.userId
                        WHERE user.userRole = 'Doctor'";
            // change table name and add user role condition [DONE]
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
                    echo '<a href="../../Views/Patient/doctor_profile.php?id='. $row['userId'] .'">';
                    // echo '<a href="../doctor_profile.php">';
                    echo '<div class="doctor-info">';
                    // echo "<div class='profile-pic'><img src='" . $row['profilePic'] . "' alt='Profile Picture'></div>";
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
    body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

.search-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #007bff;
}

input[type="text"],
select,
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #ffffff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }



</style>


</html>