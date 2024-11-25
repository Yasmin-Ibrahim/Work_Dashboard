<?php
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../core/config.php';

auth();

if(isset($_GET['view'])){
    $id = $_GET['view'];
    $select = "SELECT * FROM users_data WHERE id = $id";
    $row = mysqli_query($connect, $select);
    $data = mysqli_fetch_assoc($row);
    $numRows = mysqli_num_rows($row);
    if($numRows == 0){
        redirect('pages/error404.php');
    }
}else{
    redirect('pages/error404.php');
}

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>List Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <img class="img-fluid img-top w-100" src="<?= url('app/users/upload/') . $data['image'] ?>" width="500">
                    <div class="card-body mt-3">
                        <h6>ID: <?= $data['id'] ?></h6>
                        <hr>
                        <h6>Name: <?= $data['name'] ?></h6>
                        <hr>
                        <h6>Email: <?= $data['email'] ?></h6>
                        <hr>
                            <?php if($data['created_by'] != null): ?>
                                <h6>Created_By: <a href="<?=url('app/users/view.php')?>?view=<?= $data['created_by_id'] ?>">
                                        <?= $data['created_by'] ?>
                                    </a>
                                </h6>
                            <?php else: ?>
                                <h6 class="text-success">Super Admin</h6>
                            <?php endif; ?>
                        <hr>
                        <h6>Rule_Number: <?= $data['rule_number'] ?></h6>
                        <hr>
                        <h6>Description: <?= $data['description'] ?></h6>
                        <hr>
                    </div>
                    <a class="btn btn-primary" href="<?= url('app/users/index.php') ?>">Back</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include_once '../../shared/footer.php';
include_once '../../shared/script.php';
?>