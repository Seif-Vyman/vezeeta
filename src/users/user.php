<?php

class User{
  private $firstName;
  private $lastName; 
  private $password; 
  private $email;
  private $userRole; 
  private $phoneNum; 
  private $country;
  private $userId;

  // setrs and geters - start
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
  /////////////////////////////////////////////////
  public function getFirstName(){
    return $this->firstName;
  }
  public function getLastName($LName){
    return $this->lastName;
  }
  public function getPassword($pass){
    return $this->password;
  }
  public function getEmail($email){
    return $this->email;
  }
  public function getUserRole($role){
    return $this->userRole;
  }
  public function getCountry($country){
    return $this->country;
  }
  public function getUserId($id){
    return $this->userId;
  }
  // setrs and geters - end

  

}

?>