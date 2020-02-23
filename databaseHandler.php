<?php

class DbHandler {
    // Define database information
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $dbName = 'cafteria';
    // private $conn;

    public function connect(){
        try{
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
            $conn = new PDO($dsn, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            return $conn;
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            die();
            }
    }

    public function disConnect(){
            $conn = null;
    }

    // Inserting  New User
    public function addUser($username , $password , $email , $room , $picPath , $ext , $isAdmin ){
        try {
            // Establishing Connection
            $conn = $this->connect();

            $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
            // echo $hashedPassword;
            // prepare and bind
            $stmt = $conn->prepare("INSERT INTO cafteria.user (username, password, email,room,profile_pic,ext,is_admin) VALUES (:username,:password, :email,:room,:profile_pic,:ext,:is_admin)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':room', $room);
            $stmt->bindParam(':profile_pic', $picPath);
            $stmt->bindParam(':ext', $ext);
            $stmt->bindParam(':is_admin', $isAdmin);
            $result = $stmt->execute();  

            $this->disConnect();

            }catch(PDOException $e)
            {
            echo $conn . "<br>" . $e->getMessage();
            }
    
    }

    // Inserting Product "TO DO"

    public function addProduct($name , $price , $pic , $category){
        try {
            // Establishing Connection
            $conn = $this->connect();

            $this->disConnect();
            }
        catch(PDOException $e)
            {
                echo $conn . "<br>" . $e->getMessage();
            }
    
    }
    
    public function addCategory($categoryName){
        try {
            // Establishing Connection
            $conn = $this->connect();

            //  TO DO

            $this->disConnect();
            }
        catch(PDOException $e)
            {
            echo $conn . "<br>" . $e->getMessage();
            }
    
    }

    public function addOrder(){}

    public function selectAllUsers(){}
    public function selectAllproducts(){}
    public function selectAllCategories(){}
    public function selectElement($table,$key){}
    public function deleteUser(){}
    public function deleteProduct(){}
    public function updateUserData(){}
    public function updateProduct(){}

}



?>
