<?php 

require_once '../../Models/product.php';
require_once '../../Controllers/DBController.php';
class ProductController
{
    protected $db;

    //1. Open connection.
    //2. Run query & logic.
    //3. Close connection
    public function getCategories()
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="select * from categories";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }
    public function addProduct(Product $product)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="insert into products values ('','$product->name','$product->description','$product->price','$product->quantity','$product->image',$product->categoryid)";
            return $this->db->insert($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }
    public function getAllProducts()
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="select products.id,products.name,price,quantity,categories.name as 'category' from products,categories where products.categoryid=categories.id;";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }
    public function deleteProduct( $id)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="delete from products where id = $id";
            return $this->db->delete($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }

    public function getAllProductsWithImages()
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="select products.id,products.name,price,quantity,categories.name as 'category',image from products,categories where products.categoryid=categories.id;";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }
    
    
    public function getCategoryProducts($id)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="select products.id,products.name,price,quantity,categories.name as 'category',image from products,categories where products.categoryid=categories.id and categories.id=$id;";
            return $this->db->select($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }
    
    
}

?>