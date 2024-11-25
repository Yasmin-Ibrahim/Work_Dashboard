<?php
include_once '../../shared/head.php';
include_once '../../shared/header.php';
include_once '../../shared/aside.php';
include_once '../../core/config.php';

auth(2,3);

$select = "SELECT * FROM users";
$row = mysqli_query($connect, $select);

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM users WHERE id = $id";
    mysqli_query($connect, $delete);
    $_SESSION['message'] = "User deleted successfully";
    redirect('app/users/index.php');
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>List Users
            <a class="btn btn-info float-end" href="<?= url('app/users/create.php') ?>">Create New</a>
        </h1>
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
            <div class="col-lg-12">
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'] ?>
                        <form action="/yasmin/Nice_Admin/core/functions.php" method="POST">
                            <input type="hidden" value="<?="http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" name="old_path">
                            <button type="submit" name="delete_message" class="btn-close"></button>
                        </form>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p>

                    <!-- Table with stripped rows -->
                    <table class="table datatable text-center">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($row as $item): ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td><a href="./view.php?view=<?= $item['id'] ?>">View</a></td>
                                    <td><a class="text-danger" href="./index.php?delete=<?= $item['id'] ?>">Delete</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>

            </div>
        </div>
    </section>
</main>

<?php
include_once '../../shared/footer.php';
include_once '../../shared/script.php';
?>