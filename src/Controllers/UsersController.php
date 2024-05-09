<?php

require_once '../../Models/patient.php';
require_once 'DBController.php';

class UsersController
{
    protected $db;
    private static $instance;

    private function __construct(){}


    public static function singleton(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function ChangePassword($userId, $pass)
    {
        $this->db = DBController::singleton();

        if ($this->db->openConnection()) {
            $sql = "UPDATE user SET password='$pass'  WHERE userId='$userId'";
            return $this->db->Update($sql);
        }
    }

    public function AddInsurance($userId, $insurance, $IDNumber, $birthdate, $expiryDate)
    {
        $this->db = DBController::singleton();
        if ($this->db->openConnection()) {
            $sql1 = "select * from patient where userId = $userId";
            $result = $this->db->select($sql1);
            if($result){
                $sql2 = "UPDATE patient SET insurance ='$insurance' , IDNumber='$IDNumber' , birthdate='$birthdate' , expiryDate='$expiryDate' WHERE userId='$userId'";
                return $this->db->update($sql2);
            }else{
                $sql3 = "insert into patient values('$userId', '$insurance', '$IDNumber', '$birthdate', '$expiryDate')";
                return $this->db->insert($sql3);
            }
            
    
            
        }
    }
    public function getAllUsers() // 
    {
         $this->db=DBController::singleton();
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
         $this->db=DBController::singleton();
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
        $this->db=DBController::singleton();
       // session_start();
        if($this->db->openConnection()){
            //print_r($user);
            $sql = "UPDATE user SET userId = '".$user->getUserId()."',firstName='".$user->getFirstName()."', lastName='".$user->getLastName()."', email='".$user->getEmail()."', password='".$user->getPassword()."' , phoneNum='".$user->getPhoneNum()."', country='".$user->getCountry()."', city='".$user->getCity()."'
            WHERE userId='".$user->getUserId()."'";
            //print_r($sql);
            return $this->db->update($sql);
        // $result = $this->db->update($sql);
        }

    }
    public function addUser(User $user){ // id , fn , ln , pass , email , role , phone , country , city
        $this->db = DBController::singleton();
        // session_start();
        $user->setPassword(hash('sha256',$user->getPassword()));
         if($this->db->openConnection()){
             $sql = "INSERT INTO user VALUES ('', '".$user->getFirstName()."', '".$user->getLastName()."',  
             '".$user->getPassword()."','".$user->getEmail()."','".$user->getUserRole()."' ,'".$user->getPhoneNum()."', '".$user->getCountry()."', '".$user->getCity()."')";
            $ret = $this->db->insert($sql);
            
            return $ret;
         }else return false;
        
     }
     public function addDoctor(Doctor $doctor){ // userId , speciality , fees , address , rating  , description
        $this->db = DBController::singleton();
        // session_start();
         if($this->db->openConnection()){
             $sql = "INSERT INTO doctor VALUES ('".$doctor->getUserId()."' , '".$doctor->getSpeciality()."', '".$doctor->getFees()."',  
             '".$doctor->getAddress()."','".$doctor->getRating()."','".$doctor->getDescription()."' ) ";
            $ret = $this->db->insert($sql);
            return $ret;
         }else return false;
        
     }
}
