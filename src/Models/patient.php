<?php
require_once('../../Models/user.php'); // edit it as we in login file 
require_once '../../Controllers/DBController.php';

class Patient extends User
{

  private $appoitments;

  public function bookAppointment($appointmentId, $id)
  {
    $this->db = DBController::singleton();
    if ($this->db->openConnection()) {
      $id = $_SESSION['userId'];
      $updateQuery = "UPDATE schedule SET status = 'booked' , patientId = '$id' WHERE id = '$appointmentId'";
      if($this->db->update($updateQuery)){    
        return true;
      }
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }
  public function getAllBlogs(){
    $this->db=DBController::singleton();
         if($this->db->openConnection())
         {
            $query="select * from blog";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
  }
}
