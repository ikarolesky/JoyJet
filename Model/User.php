<?php

include_once '../config/database.php';

class User {
    private $conn;

    private $db_table = "users";

    public $id;
    public $username;
    public $email;
    public $firstname;
    public $lastname;
    public $status;


    public function __construct(){

        $database = new Database();
        $db = $database->getConnection();

        $this->conn = $db;
    }

    public function getUsers(){
        $sqlQuery = " SELECT * FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        
        return $stmt;
    }

    public function createUser($user){

        $usedEmail = $this->getSingleUserEmail($user->email);
        $usedUser = $this->getSingleUserUserName($user->username);

        if($usedEmail && $usedUser){
            echo "This e-mail and username are already in use";
            die;
        }

        if($usedUser) {
            echo "This username is already in use";
            die;
        }

        if($usedEmail) {
            echo "This e-mail is already in use";
            die;
        }

        $sqlQuery = "INSERT INTO " . $this->db_table .
                    " SET 
                        username = :username,
                        firstname = :name,
                        lastname = :lastname,
                        email = :email";
        
        $stmt = $this->conn->prepare($sqlQuery);

        $user->username=htmlspecialchars(strip_tags($user->username));
        $user->email=htmlspecialchars(strip_tags($user->email));
        $user->firstname=htmlspecialchars(strip_tags($user->firstname));
        $user->lastname=htmlspecialchars(strip_tags($user->lastname));

        $stmt->bindParam(":username", $user->username);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":name", $user->firstname);
        $stmt->bindParam(":lastname", $user->lastname);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function updateUser($user){

        $currentInfo = $this->getUserData($user->id);

        if($currentInfo['email'] == $user->email && $currentInfo['username'] == $user->username) {
            $sqlQuery = "UPDATE "
                    . $this->db_table .
                    " SET 
                        firstname = :name,
                        lastname = :lastname,
                        status = :status
                    WHERE
                        ID = :id";
            $stmt = $this->conn->prepare($sqlQuery);

            $user->id=htmlspecialchars(strip_tags($user->id));        
            $user->firstname=htmlspecialchars(strip_tags($user->firstname));
            $user->lastname=htmlspecialchars(strip_tags($user->lastname));
            $user->status=htmlspecialchars(strip_tags($user->status));
            

            $stmt->bindParam(":id", $user->id);
            $stmt->bindParam(":name", $user->firstname);
            $stmt->bindParam(":lastname", $user->lastname);
            $stmt->bindParam(":status", $user->status);

            if($stmt->execute()){
                return true;
            }

            return false;
        }

        if($currentInfo['email'] == $user->email) {

            $usedUser = $this->getSingleUserUserName($user->username);

            if($usedUser) {
                echo "This username is already in use";
                die;
            }

            $sqlQuery = "UPDATE "
                    . $this->db_table .
                    " SET 
                        firstname = :name,
                        lastname = :lastname,
                        status = :status,
                        username = :username
                    WHERE
                        ID = :id";
            $stmt = $this->conn->prepare($sqlQuery);

            $user->id=htmlspecialchars(strip_tags($user->id));        
            $user->firstname=htmlspecialchars(strip_tags($user->firstname));
            $user->username=htmlspecialchars(strip_tags($user->username));
            $user->lastname=htmlspecialchars(strip_tags($user->lastname));
            $user->status=htmlspecialchars(strip_tags($user->status));
            

            $stmt->bindParam(":id", $user->id);
            $stmt->bindParam(":name", $user->firstname);
            $stmt->bindParam(":username", $user->username);
            $stmt->bindParam(":lastname", $user->lastname);
            $stmt->bindParam(":status", $user->status);

            if($stmt->execute()){
                return true;
            }

            return false;
        }

        if($currentInfo['username'] == $user->username) {

            $usedEmail = $this->getSingleUserEmail($user->email);

            if($usedEmail) {
                echo "This email is already in use";
                die;
            }

            $sqlQuery = "UPDATE "
                    . $this->db_table .
                    " SET 
                        firstname = :name,
                        lastname = :lastname,
                        status = :status,
                        email = :email
                    WHERE
                        ID = :id";
            $stmt = $this->conn->prepare($sqlQuery);

            $user->id=htmlspecialchars(strip_tags($user->id));        
            $user->email=htmlspecialchars(strip_tags($user->email));
            $user->firstname=htmlspecialchars(strip_tags($user->firstname));
            $user->lastname=htmlspecialchars(strip_tags($user->lastname));
            $user->status=htmlspecialchars(strip_tags($user->status));
            

            $stmt->bindParam(":id", $user->id);
            $stmt->bindParam(":name", $user->firstname);
            $stmt->bindParam(":lastname", $user->lastname);
            $stmt->bindParam(":status", $user->status);
            $stmt->bindParam(":email", $user->email);

            if($stmt->execute()){
                return true;
            }

            return false;
        }

        $usedEmail = $this->getSingleUserEmail($user->email);
        $usedUser = $this->getSingleUserUserName($user->username);

        if($usedEmail && $usedUser){
            echo "This e-mail and username are already in use";
            die;
        }

        if($usedUser) {
            echo "This username is already in use";
            die;
        }

        if($usedEmail) {
            echo "This e-mail is already in use";
            die;
        }

        $sqlQuery = "UPDATE "
                    . $this->db_table .
                    " SET 
                        username = :username,
                        firstname = :name,
                        lastname = :lastname,
                        email = :email,
                        status = :status
                    WHERE
                        ID = :id";
        $stmt = $this->conn->prepare($sqlQuery);

        $user->id=htmlspecialchars(strip_tags($user->id));        
        $user->username=htmlspecialchars(strip_tags($user->username));
        $user->email=htmlspecialchars(strip_tags($user->email));
        $user->firstname=htmlspecialchars(strip_tags($user->firstname));
        $user->lastname=htmlspecialchars(strip_tags($user->lastname));
        $user->status=htmlspecialchars(strip_tags($user->status));
        

        $stmt->bindParam(":id", $user->id);
        $stmt->bindParam(":username", $user->username);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":name", $user->firstname);
        $stmt->bindParam(":lastname", $user->lastname);
        $stmt->bindParam(":status", $user->status);

        if($stmt->execute()){
            return true;
        }

        return false;


    }

    public function getSingleUser(){
        $sqlQuery = "SELECT * FROM "
                    . $this->db_table .
                    " WHERE ID = ? LIMIT 0,1 ";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if($dataRow){
            $this->id = $dataRow['id'];
            $this->username = $dataRow['username'];
            $this->email = $dataRow['email'];
            $this->firstname = $dataRow['firstname'];
            $this->lastname = $dataRow['lastname'];
            $this->status = $dataRow['status'];
        }
    }

    public function getUserData($id){
        $sqlQuery = "SELECT * FROM "
                    . $this->db_table .
                    " WHERE ID = :id LIMIT 0,1 ";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":id", $id);

        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        return $dataRow;
    }

    public function getSingleUserEmail($email){
        $sqlQuery = "SELECT * FROM "
                    . $this->db_table .
                    " WHERE email = ? LIMIT 0,1 ";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if($dataRow){
            return true;
        }
        return false;
    }

    public function getSingleUserUserName($username){
        $sqlQuery = "SELECT * FROM "
                    . $this->db_table .
                    " WHERE username = ? LIMIT 0,1 ";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if($dataRow){
            return true;
        }
        return false;


    }
}