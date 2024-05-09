<?php

class Cart{

  private $db;
  private static $instance;

  private function __construct(){}

  public static function singleton(){
    if(!isset(self::$instance)){
      self::$instance = new Cart();
    }
    return self::$instance;
  }
  public function addToCart(User $user, Product $product)
   { // userId , productId , productName , productPrice , productImage
      $this->db = ProductController::singleton();
      return $this->db->addToCart($user, $product);
   }
   public function removeFromCart($name)
   { // userId , productId , productName , productPrice , productImage
      $this->db = ProductController::singleton();
      return $this->db->removeFromCart($name);
   }

   
   
   public function getAllCartProducts($id) // 
   {
      $this->db = ProductController::singleton();
      return $this->db->getAllCartProducts($id);
   }
   public function removeCart()
   {
      $this->db = ProductController::singleton();
      return $this->db->removeCart();
   }

}