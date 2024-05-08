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
  public function getPhone(){
    return $this->phoneNum;
  }
  // setrs and geters - end

  

}

?>