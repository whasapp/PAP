<?php
session_start();
$title = "Administration section";
require_once "./template/header.php";
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2>Admin Login</h2>
            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
            <form class="form-horizontal" method="post" action="admin_verify.php">
                <div class="form-group">
                    <label for="name" class="control-label col-md-4">Name</label>
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pass" class="control-label col-md-4">Password</label>
                    <div class="col-md-4">
                        <input type="password" name="pass" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" name="submit" class="btn btn-primary" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once "./template/footer.php";
?>
