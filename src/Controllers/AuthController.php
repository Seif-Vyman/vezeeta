<?php 

require_once '../../Models/user.php';
require_once '../../Controllers/DBController.php';
class AuthController
{
    protected $db;

    //1. Open connection.
    //2. Run query & logic.
    //3. Close connection
    public function login(User $user)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        { 
            
            $email=$user->getEmail();
            $pass=hash('sha256',$user->getPassword());
           //print_r($user);
            $query="select * from user where email ='$email' and password ='$pass'";
            $result=$this->db->select($query);
            if($result===false)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
                if(count($result)==0)
                {
                    header("location: ../Auth/error.php");
                    //print_r($result);
                     $_SESSION["errMsg"]="You have entered wrong email or password";
                    // echo $_SESSION["errMsg"];
                    $this->db->closeConnection();
                    return false;
                }
                else
                {
             
                    //session_start();
                    $_SESSION = array();
                    $_SESSION["userId"]=$result[0]["userId"];
                    //$docid = $_SESSION["userId"];
                    $_SESSION["userName"]=$result[0]["firstName"] ." " . $result[0]["lastName"] ;
                    if($result[0]["userRole"]=="Doctor")
                    {
                        $_SESSION["userRole"]="Doctor";
                    }
                    if($result[0]["userRole"]=="Patient")
                    {
                        $_SESSION["userRole"]="Patient";
                      
                    }
                    if($result[0]["userRole"]=="Admin")
                    {
                        $_SESSION["userRole"]="Admin";
                      
                    }
                    $this->db->closeConnection();
                    return true;
                }
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }
    public function register(User $user)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {   
            //print_r($user);
            $firstName=$user->getFirstName();
            $lastName=$user->getLastName();
            $email=$user->getEmail();
            $pass=hash('sha256',$user->getPassword());
            $role = $user->getUserRole();
            $phone = $user->getPhoneNum();
            $country = $user->getCountry();
            $check="select * from user where email ='$email'";
            $result1 = $this->db->select($check);
            if(count($result1)>0)
            {
                // header("location: ../Auth/error.php");

                // $_SESSION["errMsg"]="You have entered wrong email or password";
                // echo $_SESSION["errMsg"];
                $this->db->closeConnection();
                return false;
            }            
            $query="insert into user values ('','$firstName','$lastName','$pass','$email','$role', 
            '$phone' , 'Egypt' , 'Cairo' )";
            $result=$this->db->insert($query);
            if($result!=false)
            {
                session_start();
                $_SESSION["userId"]=$result[0]["userId"];
                $fullName = $firstName . " " . $lastName;
                $_SESSION["userName"]=$fullName;
                $_SESSION["userRole"]="Patient";
                $this->db->closeConnection();
                return true;
            }
            else
            {
                $_SESSION["errMsg"]="Something went wrong... try again later";
                $this->db->closeConnection();
                return false;
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }
    
}

?>