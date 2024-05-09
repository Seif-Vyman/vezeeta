
<?php
require_once('../../Models/user.php');
require_once('../../Controllers/DBController.php');

class Doctor
{
  private $speciality;
  private $fees;
  private $city;
  private $address;
  private $rating;
  private $description;
  protected $db;

  //geters and seters - start
  public function setSpeciality($speciality)
  {
    $this->speciality = $speciality;
  }
  public function setFees($fees)
  {
    $this->fees = $fees;
  }
  public function setCity($city)
  {
    $this->city = $city;
  }
  public function setAddress($address)
  {
    $this->address = $address;
  }
  public function setRating($rating)
  {
    $this->rating = $rating;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }
  ////////////////////////////////////////
  public function getSpeciality()
  {
    return $this->speciality;
  }
  public function getFees()
  {
    return $this->fees;
  }
  public function getCity()
  {
    return $this->city;
  }
  public function getAddress()
  {
    return $this->address;
  }
  public function getRating()
  {
    return $this->rating;
  }
  public function getDescription()
  {
    return $this->description;
  }

  //geters and seters - end
  public function getAppointments($status)
  {
    $this->db = DBController::singleton();
    $docId = $_SESSION['userId'];
    if ($this->db->openConnection()) {
      if($status == 'booked')
        $query = "select * FROM schedule JOIN user ON schedule.patientId = user.userId where schedule.doctorId = '$docId' and status = '$status' ";
      else
        $query = "select * from schedule where doctorId = '$docId' and status = '$status'";
        return $this->db->select($query);
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }
  public function deleteSchedule($id)
  {
    $this->db = DBController::singleton();
    if ($this->db->openConnection()) {
      $query = "delete from schedule where id = $id";
      return $this->db->delete($query);
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  public function addSchedule()
  {
    $this->db = DBController::singleton();
    if ($this->db->openConnection()) {
      $date = date($_SESSION['date']);
      $time = date($_SESSION['time']);

      $query = "insert into schedule values (''," . $_SESSION['userId'] . ",'$date', '$time','available', NULL)";
      return $this->db->insert($query);
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }
  public function postBlog($header, $content)
  {
    $this->db = DBController::singleton();
    if ($this->db->openConnection()) {
      // $content = text($blog);
      // $content = mysqli_real_escape_string($this->db->openConnection(), $blog);
      //echo $_SESSION['firstName'];
      // print_r($_SESSION);
      // echo $blog;
      $curDate = date("Y-m-d");


      $query = "insert into blog values (" . $_SESSION['userId'] . ",'" . $_SESSION['userName'] . "', '$curDate','$header','$content')";
      return $this->db->insert($query);
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }
  public function displayAppointments($doctorId)
  {
    $this->db = DBController::singleton();
    // $doctorId = $_SESSION['userId'];
    $this->db->openConnection();
    $query = "SELECT * FROM schedule WHERE doctorId = '$doctorId'";
    $result = $this->db->select($query);

    return $result;
  }
}
