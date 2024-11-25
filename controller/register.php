<?php
include_once '../core/config.php';
include_once '../core/functions.php';

// there is a problem with count columns to table users in database

if(isset($_POST['send'])){
    $name = $_POST['name'];
    $email = $_POST['email'];

    $checkEmail = "SELECT * FROM `users` WHERE email = '$email'";
    $rows = mysqli_query($connect, $checkEmail);
    if(mysqli_num_rows($rows) > 0){
        $_SESSION['message'] = "Email already exists";
        redirect("pages/register.php");
    }else{
        $password = $_POST['password'];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $image_name = "default.jpg";
    
        if(!empty($_FILES['image']['name'])){
            $image_name = rand(0,255) . rand(0,255) . $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $location = "../app/users/upload/$image_name";
            move_uploaded_file($image_tmp, $location);
        }
        $insert = "INSERT INTO `users` VALUES (NULL, '$name', '$email', '$hash_password', '$image_name')";
        $i = mysqli_query($connect, $insert);
        redirect("pages/login.php");
    }
}


?>