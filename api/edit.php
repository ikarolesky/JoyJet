<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../Controllers/Api/UsersController.php';

    $user = new UsersController;

    $data = json_decode(file_get_contents("php://input"));

    $users = $user->updateUser($data);

?>