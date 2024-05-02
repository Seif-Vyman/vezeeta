
<?php
  require_once('user.php');

class Doctor
{
  private $specialty;
  private $fees;
  private $city;
  private $address;
  private $rating;
  private $schedule;

  //geters and seters - start
  public function setSpecialty($specialty)
  {
    $this->specialty = $specialty;
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
  public function setSchedule($schedule)
  {
    $this->schedule = $schedule;
  }
  ////////////////////////////////////////
  public function getSpecialty($specialty)
  {
    return $this->specialty;
  }
  public function getFees($fees)
  {
    return $this->fees;
  }
  public function getCity($city)
  {
    return $this->city;
  }
  public function getAddress($address)
  {
    return $this->address;
  }
  public function getRating($rating)
  {
    return $this->rating;
  }
  public function getSchedule($schedule)
  {
    return $this->schedule;
  }
    //geters and seters - end

}
