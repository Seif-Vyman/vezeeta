<?php

require_once '../../Models/product.php';
require_once '../../Controllers/DBController.php';
class ProductController
{
   protected $db;
   private static $instance;
   private function __construct(){}
   public static function singleton(){
      if(!isset(self::$instance)){
          self::$instance = new self();
      }
      return self::$instance;;
  }

   public function getAllProductsWithImages()
   {
      $this->db = DBController::singleton();
      if ($this->db->openConnection()) {
         $query = "select products.id,products.name,price,quantity,categories.name as 'category',image from products,categories where products.categoryid=categories.id;";
         return $this->db->select($query);
      } else {
         echo "Error in Database Connection";
         return false;
      }
   }


   public function getCategoryProducts($id)
   {
      $this->db = DBController::singleton();
      if ($this->db->openConnection()) {
         $query = "select products.id,products.name,price,quantity,categories.name as 'category',image from products,categories where products.categoryid=categories.id and categories.id=$id;";
         return $this->db->select($query);
      } else {
         echo "Error in Database Connection";
         return false;
      }
   }
   /* 
         ---------   start editing -------------
    */
   public function addToCart(User $user, Product $product)
   { // userId , productId , productName , productPrice , productImage
      $this->db = DBController::singleton();
      if ($this->db->openConnection()) {

         $id = $user->getUserID();
         $query = "insert into cart values('$id' ,'" . $product->getId() . "' ,'" . $product->getName() . "', '" . $product->getPrice() . "' , '" . $product->getImage() . "','" . $product->getQuantity() . "')";
         return $this->db->insert($query);
         
      } else {
         echo "Error in Database Connection";
         return false;
      }
   }
   public function removeFromCart($name)
   { // userId , productId , productName , productPrice , productImage
      $this->db = DBController::singleton();
      if ($this->db->openConnection()) {
         $query = "DELETE from cart where productName = '$name'";
         return $this->db->delete($query);
      } else {
         echo "Error in Database Connection";
         return false;
      }
   }

   
   
   public function getAllCartProducts($id) // 
   {
      $this->db = DBController::singleton();
      if ($this->db->openConnection()) {
         $query = "select * from cart where userId = '$id'";
         return $this->db->select($query);
      } else {
         echo "Error in Database Connection";
         return false;
      }
   }
   public function removeCart()
   {
      $this->db = DBController::singleton();
      if ($this->db->openConnection()) {
         $query = "DELETE from cart";
         return $this->db->delete($query);
      } else {
         echo "Error in Database Connection";
         return false;
      }
   }
   public function searchProduct($name)
   {
      $this->db = DBController::singleton();
      if ($this->db->openConnection()) {
         $query = "SELECT * FROM pharmacy WHERE CONCAT(prodName) LIKE '%$name%' ";
         return $this->db->select($query);
      } else {
         echo "Error in Database Connection";
         return false;
      }
   }
   public function deleteProduct($prodId)
   {
      $this->db = DBController::singleton();
      if ($this->db->openConnection()) {
         $query = "delete from pharmacy where prodid = $prodId";
         return $this->db->delete($query);
      } else {
         echo "Error in Database Connection";
         return false;
      }
   }
   public function UpdateProduct(Product $product){
      $this->db=DBController::singleton();
     // session_start();
      if($this->db->openConnection()){
          $sql = "UPDATE pharmacy SET prodName='".$product->getName()."', prodPrice='".$product->getPrice()."', quantity='".$product->getQuantity()."', image='".$product->getImage()."'
          WHERE prodId='".$product->getId()."'";
         return $this->db->update($sql);
      // $result = $this->db->update($sql);
   
      }else return false;
   }
   public function addProduct(Product $product){ // id , name , price , quantity , image
      $this->db = DBController::singleton();
		if($this->db->openConnection()){
         $qry = "INSERT INTO pharmacy VALUES ('' , '".$product->getName()."', '".$product->getPrice()."', '".$product->getQuantity()."', '".$product->getImage()."')";
         $result = $this->db->insert($qry);
         return $result;
  
     }else return false;
      
   }
   public function getAllProducts() // 
   {
      $this->db = DBController::singleton();
      if ($this->db->openConnection()) {
         $query = "select * from pharmacy";
         return $this->db->select($query);
      } else {
         echo "Error in Database Connection";
         return false;
      }
   }
   
}
