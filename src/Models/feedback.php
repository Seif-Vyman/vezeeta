

<?php
class Feedback{
  private $content;
  private $date; 
  private $doctorName; 
  private $drId;
  private $patientId; 
  private $patientName; 
  private $rate;


// Setter methods
    public function setContent($content) {
        $this->content = $content;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setDoctorName($doctorName) {
        $this->doctorName = $doctorName;
    }

    public function setDrId($drId) {
        $this->drId = $drId;
    }

    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setPatientName($patientName) {
        $this->patientName = $patientName;
    }

    public function setRate($rate) {
        $this->rate = $rate;
    }

    // Getter methods
    public function getContent() {
        return $this->content;
    }

    public function getDate() {
        return $this->date;
    }

    public function getDoctorName() {
        return $this->doctorName;
    }

    public function getDrId() {
        return $this->drId;
    }

    public function getPatientId() {
        return $this->patientId;
    }

    public function getPatientName() {
        return $this->patientName;
    }

    public function getRate() {
        return $this->rate;
    }
}
?>