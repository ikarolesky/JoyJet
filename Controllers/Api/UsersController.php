<?php


include_once '../Model/User.php';

class UsersController {

    public function read(){
        
        $user = new User();
        $stmt = $user->getUsers();
        $userCount = $stmt->rowCount();
    
        echo json_encode($userCount);
    
        if($userCount > 0){
    
            $userArray = array();

            $userArray["response"] = http_response_code(200);
            
            $userArray["body"] = array();
    
            $userArray["userCount"] = $userCount;
    
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    "id" => $id,
                    "username" => $username,
                    "email" => $email,
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "status" => $status,
                );
                array_push($userArray["body"], $e);
            }
            echo json_encode($userArray);
        }
        else{
            $status = http_response_code(200);
            echo json_encode(array(
                "status" => $status,
                "message" => "No record found."));
        }
    }

    public function readOne(){

        $user = new User();

        $user->id = isset($_GET['id']) ? $_GET['id'] : die();

        $user->getSingleUser();

        if($user->firstname != null){
            $userArray = array(
                'id' => $user->id,
                'name' => $user->firstname,
                'lastname' => $user->lastname,
                'status' => $user->status,
                'email' => $user->email,
                'username' => $user->username
            );

            http_response_code(200);
            echo json_encode($userArray);
        }
        else{
            http_response_code(200);
            echo json_encode("User not found.");
        }
    }

    public function createUser($data){
        
        $user = new User();

        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname;
        $user->username = $data->username;
        $user->email = $data->email;
        $user->status = 0;

        if($user->createUser($user)){
            echo 'User created successfully.';
        }
        else{
            echo 'User not created verify info';
        }

    }

    public function updateUser($data){
        
        $user = new User();

        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname;
        $user->username = $data->username;
        $user->email = $data->email;
        $user->status = 0;

        if($user->updateUser($user)){
            echo 'User updated successfully.';
        }
        else{
            echo 'User not updated verify info';
        }

    }
}

?>