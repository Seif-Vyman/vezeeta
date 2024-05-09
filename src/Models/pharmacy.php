<?php

class Pharmacy{
  private $db;
  private static $instance;

  private function __construct(){}
  public static function singleton(){
    if(!isset(self::$instance)){
      self::$instance = new Pharmacy();
    }
    return self::$instance;
  }
  public function deleteProduct($prodId)
   {
      $this->db = ProductController::singleton();
      return $this->db->deleteProduct($prodId);
   }
   public function UpdateProduct(Product $product){
    $this->db = ProductController::singleton();
    return $this->db->updateProduct($product);
   }
   public function addProduct(Product $product){ // id , name , price , quantity , image
      $this->db = ProductController::singleton();
      return $this->db->addProduct($product);
   }
   public function getAllProducts() // 
   {
      $this->db = ProductController::singleton();
      return $this->db->getAllProducts();
   }
   public function searchProduct($name)
   {
    $this->db = ProductController::singleton();
    return $this->db->searchProduct($name);
   }
}