<?php
include_once '../core/config.php';
include_once '../core/functions.php';

$numRows = null;
$profile_id = $_SESSION['admin']['id'];
$select = "SELECT * FROM `users` WHERE id = $profile_id";
$rows = mysqli_query($connect, $select);
$data_row = mysqli_fetch_assoc($rows);

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];

    // echo $data_row['email'] ;
    if($data_row['email'] != $email){
        $checkEmail = "SELECT * FROM `users` WHERE email = '$email'";
        $rows = mysqli_query($connect, $checkEmail);
        $numRows= mysqli_num_rows($rows) ;
    }

    if($numRows > 0){
        $_SESSION['message'] = "Email already exists";
        redirect("pages/profile.php");
    }else{
        if(empty($_FILES['image']['name'])){
            $image_name = $data_row['image'];
        }else{
            $old_image = $data_row['image'];
            if($old_image != "default.jpg"){
                unlink("../app/users/upload/$old_image");
            }
            $image_name = rand(0,255) . rand(0,255) . $_FILES['image']['name'];
            $_SESSION['admin']['image'] = $image_name;
            $image_tmp = $_FILES['image']['tmp_name'];
            $location = "../app/users/upload/$image_name";
            move_uploaded_file($image_tmp, $location);
        }
        $_SESSION['admin']['name'] = $name;
        $_SESSION['admin']['email'] = $email;
        $update = "UPDATE users SET name = '$name', email = '$email', image = '$image_name' WHERE id = $profile_id";
        mysqli_query($connect, $update);
        $_SESSION['message'] = "Update Successfully";
        redirect("pages/profile.php");
    }
}

if(isset($_POST['change_password'])){
    $current_password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirm_password = $_POST['confirm_password'];

    $database_password = $data_row['password'];
    $isTrue = password_verify($current_password, $database_password);

    if($isTrue){
        if($newpassword == $confirm_password){
            $hash_newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $update = "UPDATE users SET password = '$hash_newpassword' WHERE id = $profile_id";
            mysqli_query($connect, $update);
            $_SESSION['message'] = "update password successfully";
            redirect("pages/profile.php");
        }else{
            $_SESSION['message'] = "Confirmation password is incorrect";
            redirect("pages/profile.php");
        }
    }else{
        $_SESSION['message'] = "Current password is incorrect";
        redirect("pages/profile.php");
    }
}
?>