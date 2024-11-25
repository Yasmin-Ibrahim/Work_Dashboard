<?php
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../core/config.php';

auth(2);

$select = "SELECT * FROM rules";
$rows = mysqli_query($connect, $select);
$profile_id = $_SESSION['admin']['id'];

$validation_error = [];

if(isset($_POST['send'])){
    $name = filterValidation($_POST['name']);
    $email = filterValidation($_POST['email']);
    $password = '12345678';
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $rule_id = $_POST['rule_id'];
    $image_name = "default.jpg";

    if(stringValidation($name)){
        $validation_error[] = "validation error Enter The Name or check size max = 30, min = 3";
    }
    
    if(emailValidation($email)){
        $validation_error[] = "validation error Enter The Valide Email or check size max = 40, min = 11";
    }

    if(rule_id_Validation($rule_id)){
        $validation_error[] = "You Must Choose a Rule";
    }

    $checkEmail = "SELECT * FROM `users` WHERE email = '$email'";
    $rows = mysqli_query($connect, $checkEmail);
    if(mysqli_num_rows($rows) > 0){
        $_SESSION['otherMessage'] = "Email already exists";
        redirect("app/users/create.php");
    }else{
        if(!empty($_FILES['image']['name'])){
            $image_size = $_FILES['image']['size'];
            $image_type = $_FILES['image']['type'];
            $image_name = rand(0,255) . rand(0,255) . $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $location = "./upload/$image_name";
            
            if(file_size_validation($image_size) || file_type_validation($image_type, "image/jpeg", "image/jpg", "image/png", "image/gif")){
                $validation_error[] = "The file is more than 2 migabytes <br> or the type must be jpeg / jpg / png / gif";
            }else{
                move_uploaded_file($image_tmp, $location);
            }
        }
        if(empty($validation_error)){
            $insert = "INSERT INTO `users` VALUES (NULL, '$name', '$email', '$hash_password', '$image_name', $profile_id, $rule_id)";
            $i = mysqli_query($connect, $insert);
            $_SESSION['message'] = "Create Admin Done";
            redirect("app/users/create.php");
        }
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Form Layouts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Layouts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card col-lg-7">
                    <?php if(isset($_SESSION['message'])): ?>
                        <div id="alert-msg" class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            <?= $_SESSION['message']; ?>
                            <form action="/yasmin/Nice_Admin/core/functions.php" method="POST">
                                <input type="hidden" value="<?= "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" name="old_path">
                                <button name="delete_message" type="submit" class="btn-close" ></button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['otherMessage'])): ?>
                        <div id="alert-msg" class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            <?= $_SESSION['otherMessage']; ?>
                            <form action="/yasmin/Nice_Admin/core/functions.php" method="POST">
                                <input type="hidden" value="<?= "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" name="old_path">
                                <button name="delete_message" type="submit" class="btn-close" ></button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($validation_error)): ?>
                        <div id="alert-msg" class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            <ul>
                                <?php foreach($validation_error as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <form action="/yasmin/Nice_Admin/core/functions.php" method="POST">
                                <input type="hidden" value="<?= "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" name="old_path">
                                <button name="delete_message" type="submit" class="btn-close" ></button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">Vertical Form</h5>
                    <!-- Vertical Form -->
                        <form method="post" class="row g-3" enctype="multipart/form-data">
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control" id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail4">
                            </div>
                            <div class="col-12">
                                <label for="yourImage" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="yourImage" accpet="image/*">
                            </div>
                            <div class="col-12">
                                <select name="rule_id" class="form-control">
                                    <option selected disabled value="">-- Select Rule --</option>
                                    <?php foreach($rows as $item): ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['description'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="send" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->
                    </div>
                </div>  
            </div>
        </div>
    </section>
</main>

<?php
include_once '../../shared/footer.php';
include_once '../../shared/script.php';
?>
