<?php 
include_once '../shared/head.php'; 
include_once '../core/config.php';
include_once '../core/functions.php';
$email = null;

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select = "SELECT * FROM `users_data` WHERE email = '$email'";
    $row = mysqli_query($connect ,$select);

    if(mysqli_num_rows($row) == 1){
        $data_row = mysqli_fetch_assoc($row);
        $hash_password_from_database = $data_row['password'];
        $ifpasswordequltrue = password_verify($password, $hash_password_from_database);
        if($ifpasswordequltrue){
            setcookie("isAdmin", $email, time() + 86400*365, '/');
            $_SESSION['admin'] = [
                "id" => $data_row['id'],
                "email" => $email,
                "name" => $data_row['name'],
                "image" => $data_row['image'],
                "rule_number" => $data_row['rule_number'],
            ];
            redirect("");
        }else{
            $_SESSION['message'] = "The Password is Wrong";
        }
    }else{
        $_SESSION['message'] = "The Admin Of Not Found";
    }
}

?>

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">NiceAdmin</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">
                <?php if(isset($_SESSION['message'])): ?>
                        <div id="alert-msg" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message'] ?>
                            <form action="<?= url('core/functions.php') ?>" method="POST">
                                <input type="hidden" value="<?= "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" name="old_path">
                                <button name="delete_message" type="submit" class="btn-close" aria-label="Close"></button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">

                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                        <p class="text-center small">Enter your email & password to login</p>
                    </div>

                    <form class="row g-3 needs-validation" method="post" action="">

                        <div class="col-12">
                            <label for="yourEmail" class="form-label">Email</label>
                            <div class="input-group has-validation">
                                <input type="email" name="email" class="form-control" id="yourEmail" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                        </div>

                        <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        </div>
                        <div class="col-12">
                        <button class="btn btn-primary w-100" name="login" type="submit">Login</button>
                        </div>
                        <div class="col-12">
                        <p class="small mb-0">Don't have account? <a href="<?= url("pages/register.php") ?>">Create an account</a></p>
                        </div>
                    </form>

                    </div>
                </div>

                <div class="credits">
                    Designed by <a href="https://yasmin.net/">Yasmin Ibrahim</a>
                </div>

                </div>
            </div>
            </div>

        </section>
    </div>
</main>

<?php include_once '../shared/script.php'; ?>