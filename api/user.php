<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../Controllers/Api/UsersController.php';

    $user = new UsersController;

    $users = $user->readOne();

?>