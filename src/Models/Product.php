<?php 

class Product
{
    
    private $id;
    private $name;
    private $price;
    private $image;
    private $quantity = 1;

  
    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price)
    {
        $this->price = $price;
    }

 
    public function getImage()
    {
        return $this->image;
    }

  
    public function setImage($image)
    {
        $this->image = $image;
    }

    
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    
}
