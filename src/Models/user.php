<?php
require_once '../../Controllers/ProductController.php';
class User{
  protected $db;
  private $firstName;
  private $lastName; 
  private $password; 
  private $email;
  private $userRole; 
  private $phoneNum; 
  private $country;
  private $city;
  private $userId;


  // setrs and geters - start
  // public function __construct($firstName , $lastName , $password , $email , $userRole , $phoneNum , $country , $city)
  // {
  //   $this->$firstName = $firstName;
  //   $this->$lastName = $lastName; 
  //   $this->$password = $password; 
  //   $this->$email = $email;
  //   $this->$userRole = $userRole; 
  //   $this->$phoneNum = $phoneNum; 
  //   $this->$country = $country;
  //   $this->$city = $city;
  // }
  public function setFirstName($fName){
    $this->firstName = $fName;
  }
  public function setLastName($LName){
    $this->lastName = $LName;
  }
  public function setPassword($pass){
    $this->password = $pass;
  }
  public function setEmail($email){
    $this->email = $email;
  }
  public function setUserRole($role){
    $this->userRole = $role;
  }
  public function setCountry($country){
    $this->country = $country;
  }
  public function setUserId($id){
    $this->userId = $id;
  }
  public function setPhoneNum($phoneNum){
    $this->phoneNum = $phoneNum;
  }
  public function setCity($city){
    $this->city = $city;
  }
  /////////////////////////////////////////////////
  public function getFirstName(){
    return $this->firstName;
  }
  public function getLastName(){
    return $this->lastName;
  }
  public function getPassword(){
    return $this->password;
  }
  public function getEmail(){
    return $this->email;
  }
  public function getUserRole(){
    return $this->userRole;
  }
  public function getCountry(){
    return $this->country;
  }
  public function getUserId(){
    return $this->userId;
  }
  public function getPhoneNum(){
    return $this->phoneNum;
  }
  public function getCity(){
    return $this->city;
  }
  // setrs and geters - end
  public function addToCart(Product $product){
    $this->db = ProductController::singleton();
    $this->db->addtoCart($this , $product);

  }
  

}

?>