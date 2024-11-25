<?php 
include_once '../shared/head.php'; 

// $_SERVER['HTTP_HOST'] // = localhost
// $_SERVER['REQUEST_URI'] // = path

// $_SESSION['sosa'] = "i sosa";
// print_r($_SESSION);
auth(2);
?>

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">NiceAdmin</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">
                    <?php if(isset($_SESSION['message'])): ?>
                        <div id="alert-msg" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message']; ?>
                            <form action="<?= url('core/functions.php') ?>" method="POST">
                                <input type="hidden" value="<?= "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" name="">
                                <button name="delete_message" type="submit" class="btn-close" data-bs-dismiss="alert"></button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">

                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                        <p class="text-center small">Enter your personal details to create account</p>
                    </div>

                    <form class="row g-3 needs-validation" action="<?= url("controller/register.php") ?>" method="POST" enctype="multipart/form-data">
                        <div class="col-12">
                            <label for="yourName" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" id="yourName" required>
                        </div>

                        <div class="col-12">
                            <label for="yourEmail" class="form-label">Your Email</label>
                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                        </div>

                        <div class="col-12">
                            <label for="yourImage" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="yourImage" accpet="image/*">
                        </div>

                        <div class="col-12 mt-4 mb-2">
                        <button class="btn btn-primary w-100" name="send" type="submit">Create Account</button>
                        </div>
                        <div class="col-12">
                        <p class="small mb-0">Already have an account? <a href="<?= url("pages/login.php") ?>">Login</a></p>
                        </div>
                    </form>

                    </div>
                </div>

                <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>

                </div>
            </div>
            </div>

        </section>
    </div>
</main>

<?php include_once '../shared/script.php'; ?>