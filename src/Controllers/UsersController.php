<?php

require_once '../../Models/patient.php';
require_once 'DBController.php';

class UsersController
{
    protected $db;

    // public function UpdateUser($userId, $firstName, $lastName, $email, $country, $phoneNum)
    // {
    //     $this->db = new DBController;
    //     // session_start();
    //     if ($this->db->openConnection()) {
    //         $sql = "UPDATE user SET firstName='$firstName', lastName='$lastName', email='$email', country='$country' , phoneNum='$phoneNum'
    //         WHERE userId=$userId";
    //         if ($this->db->update($sql)) {
    //             $_SESSION['firstName'] = $firstName;
    //             $_SESSION['lastName'] = $lastName;
    //             $_SESSION['email'] = $email;
    //             $_SESSION['country'] = $country;
    //             $_SESSION['phoneNum'] = $phoneNum;
    //         } else {
    //             echo 'Error';
    //         }
    //         // $result = $this->db->update($sql);

    //     }
    // }

    public function ChangePassword($userId, $pass)
    {
        $this->db = new DBController;

        if ($this->db->openConnection()) {
            $sql = "UPDATE user SET password='$pass'  WHERE userId='$userId'";
            return $this->db->Update($sql);
        }
    }

    public function AddInsurance($userId, $insurance, $IDNumber, $birthdate, $expiryDate)
    {
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $sql = "UPDATE patient SET insurance ='$insurance' , IDNumber='$IDNumber' , birthdate='$birthdate' , expiryDate='$expiryDate' WHERE userId='$userId'";
            return $this->db->Update($sql);
        }
    }
    public function getAllUsers() // 
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="select * from user";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }
    public function deleteUser($userId)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="delete from user where userId = $userId";
            return $this->db->delete($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }
    
    public function UpdateUser(User $user){
        $this->db=new DBController;
       // session_start();
        if($this->db->openConnection()){
            $sql = "UPDATE user SET firstName='".$user->getFirstName()."', lastName='".$user->getLastName()."', email='".$user->getEmail()."', password='".$user->getPassword()."' , phoneNum='".$user->getPhoneNum()."', country='".$user->getCountry()."', city='".$user->getCity()."'
            WHERE userId='".$user->getUserId()."'";
        return $this->db->update($sql);
        // $result = $this->db->update($sql);
        }

    }
}
