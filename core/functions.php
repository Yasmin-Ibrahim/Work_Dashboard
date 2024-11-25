<?php
session_start();
define("BASE_URL", "http://localhost/yasmin/Nice_Admin/");

function url($var = null){
    return BASE_URL . $var;
}

function redirect($var = null){
    echo "<script>
            window.location.replace('http://localhost/yasmin/Nice_Admin/$var')
        </script>";
}

if(isset($_POST['delete_message'])){
    $old_path = $_POST['old_path'];
    unset($_SESSION['message']);
    unset($_SESSION['otherMessage']);
    echo "<script>
            window.location.replace('$old_path');
        </script>";
    }

// Authentication function
function auth($rule2=null, $rule3=null){
    if($_COOKIE['isAdmin']){
        $rule = $_SESSION['admin']['rule_number'];
        if($rule == 1 || $rule == $rule2 || $rule == $rule3){
        }else{
            redirect("pages/error404.php");
        }
    }else{
        redirect("pages/login.php");
    }
}

if(isset($_GET['logout'])){
    setcookie('isAdmin', 'anyvalue', time() - 3600, '/');
    session_unset();
    session_destroy();
    redirect('pages/login.php'); 
}

function filterValidation($input){
    $input = ltrim($input);
    $input = rtrim($input);
    $input = strip_tags($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function stringValidation($input, $max=20, $min=5){
    $isEmpty = empty($input);
    $is_max_len = strlen($input) > $max; 
    $is_min_len = strlen($input) < $min;
    if($isEmpty || $is_max_len || $is_min_len){
        return true;
    }else{
        return false;
    }
}

function emailValidation($input, $max=30, $min=11){
    $isEmpty = empty($input);
    $is_max_len = strlen($input) > $max; 
    $is_min_len = strlen($input) < $min;
    $isNotEmail = !filter_var($input, FILTER_VALIDATE_EMAIL);
    if($isEmpty || $is_max_len || $is_min_len || $isNotEmail){
        return true;
    }else{
        return false;
    }
}

function numberValidation($input){
    $isEmpty = empty($input);
    $isNegative = $input < 0;
    $isNotNumber = !filter_var($input, FILTER_VALIDATE_FLOAT);
    if($isEmpty || $isNegative || $isNotNumber){
        return true;
    }else{
        return false;
    }
}

function rule_id_Validation($input){
    $isEmpty = empty($input);
    $isNotNumber = !filter_var($input, FILTER_VALIDATE_INT);
    if($isEmpty || $isNotNumber){
        return true;
    }else{
        return false;
    }
}

function file_size_validation($file_size, $req_size = 2){
    $file_size = ($file_size / 1024) / 1024;
    // convert from bytes to kilobytes to migabytes
    $is_max_size = $file_size > $req_size;
    if($is_max_size){
        return true;
    }else{
        return false;
    }
}

function file_type_validation($file_type, $type1=null, $type2=null, $type3=null, $type4=null, $type5=null){
    if($file_type == $type1 || $file_type == $type2 || $file_type == $type3 || $file_type == $type4 || $file_type == $type5){
        return false;
    }else{
        return true;
    }
}

?>