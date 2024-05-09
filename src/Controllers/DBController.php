<?php

class DBController
{

    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "";
    private $dbName = "hcc";
    private $connection;
    private static $instance;
    private function __construct(){}


    public static function singleton(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;;
    }
    public function openConnection()
    {
        $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
        if ($this->connection->connect_error) {
            echo " Error in Connection : " . $this->connection->connect_error;
            return false;
        } else {
            return true;
        }
    }

    public function closeConnection()
    {
        if ($this->connection) {
            $this->connection->close();
        } else {
            echo "Connection is not opened";
        }
    }

    public function select($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            //echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
    public function insert($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $this->connection->insert_id;
        }
    }
    public function delete($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result;
        }
    }

    public function update($qry)
    {
        $result = $this->connection->query($qry);
        print_r($result);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return true;
        }
    }
    //////////////////////////////////////////

public function getConnection() {
    return $this->connection;
}

public function getDoctorById($doctorId) {

    $sql = "SELECT * FROM doctor WHERE userId = $doctorId";
    $result = $this->connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $doctor = new Doctor;
        // $doctor->setuserId($row['userId']);
            // $row['first_name'],
            // $row['last_name'],
        $doctor->setSpeciality($row['speciality']);                
        $doctor->setFees($row['fees']);
        // $row['city'],
        $doctor->setAddress($row['address']);
        $doctor->setRating($row['rating']);
        $doctor->setDescription($row['description']);
        return $doctor;
    } else {
        return null;
    }
}
public function getUserById($doctorId) {

    $sql = "SELECT * FROM user WHERE userId = $doctorId";
    $result = $this->connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user = new User;
        $user->setphoneNum($row['phoneNum']);
        $user->setFirstName($row['firstName']);
        $user->setLastName($row['lastName']);
        $user->setCity($row['city']);
        return $user;
    } else {
        return null;
    }
}

public function getFeedbacksById($doctorId) {

    $sql = "SELECT * FROM feedback WHERE drId = $doctorId";
    $result = $this->connection->query($sql);
    $feedbacks = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc())
        {
            $row = $result->fetch_assoc();
            $feedback = new Feedback;
            $feedback->setContent($row['content']);
            $feedback->setDate($row['date']);
            $feedback->setPatientName($row['patientName']);
            $feedback->setDoctorName($row['doctorName']);
            $feedback->setRate($row['rate']);
            $feedbacks[] = $feedback;
        }
        return $feedbacks; 
    } 
    
    else {
        return null;
    }
}

}
?>